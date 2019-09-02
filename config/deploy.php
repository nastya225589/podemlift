<?php

return [
    /**
     * The name of the application.
     */
    'name' => 'pob',

    /**
     * The environment to use by default.
     */
    'default' => 'staging',

    /**
     * Environments/servers definitions
     */
    'environments' => [
        'staging' => [
            /**
             * SSH url to the server.
             */
            'server' => 'pob.molinos.dev',

            /**
             * The path on the remote server where the application should be deployed.
             */
            'deploy_to' => '/home/app/laravel/pob',

            /**
             * URL to the repository.
             */
            'repo_url' => 'git@gitlab.molinos.ru:support/p-ob.ru.git',

            /**
             * The branch name to be deployed from SCM.
             */
            'repo_branch' => 'master',

            /**
             * Default commit hash
             */
            'commit_hash' => 'HEAD',

            /**
             * The subtree of the repository to deploy.
             */
            'repo_tree' => '',

            /**
             * Listed files will be symlinked into each release directory during deployment.
             */
            'linked_files' => ['.env'],

            /**
             * Listed directories will be symlinked into the release directory during deployment.
             */
            'linked_dirs' => ['storage/logs', 'storage/app/public'],

            /**
             * The last n releases are kept for possible rollbacks.
             */
            'keep_releases' => 5,

            /**
             * Temporary directory used during deployments to store data.
             */
            'tmp_dir' => '/tmp',
        ]
    ],
];
