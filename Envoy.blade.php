@setup

	$configFile = __DIR__ . '/config/deploy.php';
	$localDir = __DIR__;

	if ( ! file_exists($configFile)) {
		throw new Exception('Config file '. $configFile .' not found.');
	}

	$deployConfig = include($configFile);
	$environment  = isset($env) ? $env : array_get($deployConfig, 'default');
	$beginOn      = microtime(true);

	$db_remote = isset($db_remote) ? $db_remote : 'app_' . $environment;
	$db_user_remote = isset($db_user_remote) ? $db_user_remote : 'app_dbu';

	$db_local = trim(explode('=', `cat .env | grep DB_DATABASE`)[1]);
	$db_user_local = trim(explode('=', `cat .env | grep DB_USERNAME`)[1]);

	$name   = array_get($deployConfig, 'name', 'untitled');
	$slack  = array_get($deployConfig, 'slack');
	$config = array_get($deployConfig['environments'], $environment);

	// Get configuration
	$server       = array_get($config, 'server');
	$sshOptions   = array_get($config, 'ssh_options', '');
	$deployTo     = array_get($config, 'deploy_to', '');
	$repoUrl      = array_get($config, 'repo_url');
	$repoTree     = '/'. trim(array_get($config, 'repo_tree'));
	$repoBranch   = array_get($config, 'repo_branch');
	$commitHash   = isset($commit) ? $commit : array_get($config, 'commit_hash');
	$linkedFiles  = array_get($config, 'linked_files', []);
	$linkedDirs   = array_get($config, 'linked_dirs', []);
	$keepReleases = array_get($config, 'keep_releases', 5);
	$tmp_dir      = array_get($config, 'tmp_dir', '/tmp');
	$cmdGit       = array_get($config, 'cmd_git', 'git');
	$cmdNpm       = array_get($config, 'cmd_npm', 'npm');
	$cmdYarn      = array_get($config, 'cmd_npm', 'yarn');
	$cmdBower     = array_get($config, 'cmd_bower', 'bower');
	$cmdGrunt     = array_get($config, 'cmd_grunt', 'grunt');
	$cmdWget      = array_get($config, 'cmd_wget', 'wget');
	$cmdPhp       = array_get($config, 'cmd_php', 'php');

	if ( ! $server) {
		throw new Exception('Server URL is not defined for environment '. $environment .'.');
	} elseif ( ! $repoUrl) {
		throw new Exception('Repository URL is not defined for environment '. $environment .'.');
	}

	// Define paths
	$deployTo     = rtrim($deployTo, '/');
	$repoPath     = $deployTo .'/repo';
	$currentPath  = $deployTo .'/current';
	$releasesPath = $deployTo .'/releases';
	$sharedPath   = $deployTo .'/shared';
	$backupsPath  = $deployTo .'/backups';

	$releasePath  = $releasesPath .'/'. (isset($release) ? $release : date('YmdHis'));
@endsetup

@servers(['web' => '-q -A '. $sshOptions .' "'. $server .'"', 'localhost' => '127.0.0.1'])

@task('deploy:setup', ['on' => 'web'])
	if [ ! -d "{{ $deployTo }}" ]; then
		mkdir "{{ $deployTo }}";
	fi

	if [ ! -d "{{ $releasesPath }}" ]; then
		mkdir "{{ $releasesPath }}";
	fi

	if [ ! -d "{{ $sharedPath }}" ]; then
		mkdir "{{ $sharedPath }}";
	fi

	if [ ! -d "{{ $backupsPath }}" ]; then
		mkdir "{{ $backupsPath }}";
	fi
@endtask

@task('deploy:check', ['on' => 'web'])
	if [ ! -d "{{ $releasesPath }}" ]; then
		echo "Releases path not found." 1>&2;
		exit 1
	fi

	if [ ! -d "{{ $sharedPath }}" ]; then
		echo "Shared path not found." 1>&2;
		exit 1
	fi

	if [ ! -d "{{ $backupsPath }}" ]; then
		echo "Backups path not found." 1>&2;
		exit 1
	fi
@endtask

@macro('deploy')
	deploy:assert_commit
	deploy:starting
	deploy:check
	deploy:started
	deploy:updating
	deploy:update_code
	deploy:release
	deploy:shared
	deploy:vendors
	deploy:compile_assets
	deploy:updated
	deploy:publishing
	deploy:symlink
	deploy:published
	deploy:finishing
	deploy:cleanup
	deploy:migrate
	{{--deploy:restart_services--}}
	deploy:finished
@endmacro

@macro('deploy:rollback')
	deploy:check
	deploy:revert_release
@endmacro

@task('deploy:assert_commit', ['on' => 'web'])
	@if (! $commitHash)
		echo "No commit hash/tag was provided. Please provide one using --commit." 1>&2;
		exit 1
	@else
		echo "Deploying commit {{ $commitHash }}..."
	@endif
@endtask

@task('deploy:update_code', ['on' => 'web'])
	export GIT_SSH_COMMAND="ssh -o PasswordAuthentication=no -o StrictHostKeyChecking=no"

	if [ -d "{{ $repoPath }}" ]; then
		cd "{{ $repoPath }}"
		echo "{{ $cmdGit }} fetch" 1>&2;
		{{ $cmdGit }} fetch
		echo "{{ $cmdGit }} pull" 1>&2;
		{{ $cmdGit }} pull
	else
		echo "{{ $cmdGit }} clone {{ $repoUrl }} \"{{ $repoPath }}\"" 1>&2;
		{{ $cmdGit }} clone {{ $repoUrl }} "{{ $repoPath }}"
	fi

	cd "{{ $repoPath }}"

	echo "{{ $cmdGit }} checkout -f {{ $repoBranch }}" 1>&2;
	{{ $cmdGit }} checkout -f {{ $repoBranch }}

	echo "{{ $cmdGit }} submodule update --init" 1>&2;
	{{ $cmdGit }} submodule update --init

	echo "{{ $cmdGit }} rev-list --max-count=1 --abbrev-commit HEAD > REVISION" 1>&2;
	{{ $cmdGit }} rev-list --max-count=1 --abbrev-commit HEAD > REVISION
@endtask

@task('deploy:revert_release', ['on' => 'web'])
	@if (isset($release))
		RELEASE="{{ $release }}"
	@else
		cd "{{ $releasesPath }}"
		RELEASE=`ls -1d */ | head -n -1 | tail -n 1 | sed "s/\/$//"`
	@endif

	if [ ! -d "{{ $repoPath }}" ]; then
		echo "Release $RELEASE not found. Could not rollback."
		exit 1
	fi

	echo "Rollback to release $RELEASE"
	echo "TODO — Rollback migrations"

	ln -sfn "{{ $releasesPath }}/$RELEASE" "{{ $currentPath }}"
@endtask

@task('deploy:release', ['on' => 'web'])
	rsync -avz --exclude .git/ "{{ $repoPath }}{{ $repoTree }}/" "{{ $releasePath }}"
@endtask

@task('deploy:shared', ['on' => 'web'])
	@run('deploy:shared:dirs')
	@run('deploy:shared:files')
@endtask

@task('deploy:shared:dirs', ['on' => 'web'])
	@foreach ($linkedDirs as $dir)

		echo "mkdir -p \"{{ $sharedPath }}/{{ $dir }}\"" 1>&2;
		mkdir -p "{{ $sharedPath }}/{{ $dir }}"

		echo "rm -Rf \"{{ $releasePath }}/{{ $dir }}\"" 1>&2;
		rm -Rf "{{ $releasePath }}/{{ $dir }}"

		echo "ln -nfs \"{{ $sharedPath }}/{{ $dir }}\" \"{{ $releasePath }}/{{ $dir }}\"" 1>&2;
		ln -nfs "{{ $sharedPath }}/{{ $dir }}" "{{ $releasePath }}/{{ $dir }}"

	@endforeach
@endtask

@task('deploy:shared:files', ['on' => 'web'])
	@foreach ($linkedFiles as $file)
		mkdir -p `dirname "{{ $sharedPath }}/{{ $file }}"`

		if [ -f "{{ $releasePath }}/{{ $file }}" ]; then
			if [ ! -f "{{ $sharedPath }}/{{ $file }}" ]; then
				cp "{{ $releasePath }}/{{ $file }}" "{{ $sharedPath }}/{{ $file }}"
			fi

			rm -f "{{ $releasePath }}/{{ $file }}"
		fi

		ln -nfs "{{ $sharedPath }}/{{ $file }}" "{{ $releasePath }}/{{ $file }}"
	@endforeach
@endtask

@task('deploy:vendors', ['on' => 'web'])
	cd "{{ $releasePath }}"

	if [ -f "no-package.json" ]; then
		if [ -f "yarn.lock" ]; then
			echo "{{ $cmdYarn }} install --verbose --no-progress --non-interactive" 1>&2;
			{{ $cmdYarn }} install --verbose --no-progress --non-interactive 2>&1
		else
			echo "{{ $cmdNpm }} install" 1>&2;
			{{ $cmdNpm }} install 2>&1
		fi
	fi

	if [ -f "no-bower.json" ]; then
		echo "{{ $cmdBower }} install" 1>&2;
		{{ $cmdBower }} install 2>&1
	fi

	if [ -f "composer.json" ]; then
		if [ ! -f "composer.phar" ]; then
			echo "{{ $cmdWget }} -nc https://getcomposer.org/composer.phar" 1>&2;
			{{ $cmdWget }} -nc https://getcomposer.org/composer.phar 2>&1
		else
			echo "{{ $cmdPhp }} composer.phar self-update" 1>&2;
			{{ $cmdPhp }} composer.phar self-update 2>&1
		fi

		echo "{{ $cmdPhp }} composer.phar install --no-dev --verbose --prefer-dist --optimize-autoloader --no-progress --no-interaction" 1>&2;
		{{ $cmdPhp }} composer.phar install --no-dev --verbose --prefer-dist --optimize-autoloader --no-progress --no-interaction 2>&1
	fi
@endtask

@task('deploy:compile_assets', ['on' => 'web'])
	cd "{{ $releasePath }}"

	if [ -f "Gruntfile.js" ]; then
		echo "{{ $cmdGrunt }} build:release" 1>&2;
		{{ $cmdGrunt }} build:release
	fi
@endtask

@task('deploy:symlink', ['on' => 'web'])
	echo "ln -sfn \"{{ $releasePath }}\" \"{{ $currentPath }}\"" 1>&2;
	ln -sfn "{{ $releasePath }}" "{{ $currentPath }}"
@endtask

@task('deploy:releases', ['on' => 'web'])
	echo "ls \"{{ $releasesPath }}\"" 1>&2;
	ls "{{ $releasesPath }}"
@endtask

@task('deploy:cleanup', ['on' => 'web'])
	echo "cd \"{{ $releasesPath }}\"" 1>&2;
	cd "{{ $releasesPath }}"
	echo "ls -1d */ | head -n -{{ $keepReleases }} | xargs -d \"\n\" rm -Rf" 1>&2;
	ls -1d */ | head -n -{{ $keepReleases }} | xargs -d "\n" rm -Rf
@endtask

@task('backup:create', ['on' => 'web'])
@endtask

@task('backup:list', ['on' => 'web'])
	ls "{{ $backupsPath }}"
@endtask

@task('backup:restore', ['on' => 'web'])
@endtask

@task('deploy:starting', ['on' => 'web'])
	echo "deploy:starting"
@endtask

@task('deploy:started', ['on' => 'web'])
	echo "deploy:started"
@endtask

@task('deploy:updating', ['on' => 'web'])
	echo "deploy:updating"
@endtask

@task('deploy:updated', ['on' => 'web'])
	echo "deploy:updated"
@endtask

@task('deploy:publishing', ['on' => 'web'])
	echo "deploy:publishing"
	php {{ $releasePath }}/artisan storage:link
@endtask

@task('deploy:published', ['on' => 'web'])
	echo "deploy:published"
@endtask

@task('deploy:migrate', ['on' => 'web'])

	php {{ $releasePath }}/artisan migrate --force

@endtask

@task('deploy:restart_services', ['on' => 'web'])
	{{--sudo supervisorctl update--}}
	{{--sudo supervisorctl restart laravel-worker:*--}}
@endtask

@task('deploy:finishing', ['on' => 'web'])
	echo "deploy:finishing"
@endtask

@task('deploy:finished', ['on' => 'web'])
	echo "deploy:finished"
@endtask

@task('public:push', ['on' => 'localhost'])
	echo "rsync -czavP storage/app/public/ {{ $server }}:{{ $sharedPath }}/storage/app/public/" 1>&2;
	rsync -czavP storage/app/public/ {{ $server }}:{{ $sharedPath }}/storage/app/public/
@endtask

@task('public:pull', ['on' => 'localhost'])
	echo "rsync -czavP {{ $server }}:{{ $sharedPath }}/storage/app/public/ storage/app/public/" 1>&2;
	rsync -czavP {{ $server }}:{{ $sharedPath }}/storage/app/public/ storage/app/public/
@endtask

@task('public:push', ['on' => 'localhost'])
	echo "rsync -czavP {{ $localDir }}/storage/app/public/ {{ $server }}:{{ $sharedPath }}/storage/app/public/" 1>&2;
	rsync -czavP {{ $localDir }}/storage/app/public/ {{ $server }}:{{ $sharedPath }}/storage/app/public/
@endtask

@story('db:pull')
    db:dump
    db:dump-download
    db:dump-delete-remote
    db:clear
    db:import
    db:dump-delete
@endstory

@story('app:pull')
	db:dump
	db:dump-download
	db:dump-delete-remote
	db:clear
	db:import
	db:dump-delete
	public:pull
@endstory

@story('db:push')
	db:dump-create
	db:dump-load
	db:dump-delete
	db:clear-web
	db:import-web
	db:dump-delete-remote
@endstory

@story('app:push')
    db:dump-create
    db:dump-load
    db:dump-delete
    db:clear-web
    db:import-web
    db:dump-delete-remote
    public:push
@endstory

@task('db:dump', ['on' => 'web'])
	echo "db:dump";
	pg_dump --no-acl --no-owner -U {{ $db_user_remote }} {{ $db_remote }} > {{ $sharedPath }}/db.dump
@endtask

@task('db:dump-download', ['on' => 'localhost'])
	echo "db:dump-download";
	scp {{ $server }}:{{ $sharedPath }}/db.dump {{ $localDir }}/storage/db.dump
@endtask

@task('db:clear', ['on' => 'localhost'])
	echo "db:clear";
	psql -U {{ $db_user_local }} -c "SELECT pg_terminate_backend(pg_stat_activity.pid) FROM pg_stat_activity WHERE pg_stat_activity.datname = '{{ $db_local }}' AND pid <> pg_backend_pid();" {{ $db_local }}
	dropdb -U {{ $db_user_local }} {{ $db_local }}
	createdb -U {{ $db_user_local }} {{ $db_local }}
@endtask

@task('db:clear-web', ['on' => 'web'])
	echo "db:clear-web";
	psql -U {{ $db_user_remote }} -c "SELECT pg_terminate_backend(pg_stat_activity.pid) FROM pg_stat_activity WHERE pg_stat_activity.datname = '{{ $db_remote }}' AND pid <> pg_backend_pid();" {{ $db_remote }}
	dropdb -U postgres {{ $db_remote }}
	createdb -U postgres {{ $db_remote }}
	psql -U postgres -c "GRANT ALL PRIVILEGES ON ALL TABLES IN SCHEMA public TO {{ $db_user_remote }};"  {{ $db_remote }}
@endtask

@task('db:import', ['on' => 'localhost'])
	psql -d {{ $db_local }} < {{ $localDir }}/storage/db.dump
@endtask

@task('db:import-web', ['on' => 'web'])
	psql -d {{ $db_remote }} -U {{ $db_user_remote }} < {{ $sharedPath }}/db.dump
@endtask

@task('db:dump-delete', ['on' => 'localhost'])
	rm {{ $localDir }}/storage/db.dump
@endtask

@task('db:dump-delete-remote', ['on' => 'web'])
	echo "db:dump-delete-remote";
	rm {{ $sharedPath }}/db.dump
@endtask

@task('db:dump-create', ['on' => 'localhost'])
	pg_dump --no-acl --no-owner -U {{ $db_user_local }} {{ $db_local }} > {{ $localDir }}/storage/db.dump
@endtask

@task('db:dump-load', ['on' => 'localhost'])
	scp {{ $localDir }}/storage/db.dump {{ $server }}:{{ $sharedPath }}/db.dump
@endtask

@error
	if ($task === 'deploy:check') {
		throw new Exception('Unmet prerequisites to deploy. Have you run deploy:setup?');
	} else {
		throw new Exception('Whoops, looks like something went wrong');
	}
@enderror

@after
	$endOn     = microtime(true);
	$totalTime = $endOn - $beginOn;

	if ($task === 'deploy:symlink' && $slack) {
		$channel = array_get($slack, 'channel', '#deployments');

		@slack($slack['url'], $channel, $name . ' @ ' . $commitHash .' - Deployed to _'. $environment .'_ after '. round($totalTime, 1) .' sec.')
	}
@endafter
