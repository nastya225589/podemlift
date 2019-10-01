<h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
    <span>Контент</span>
</h6>

<ul class="nav flex-column mb-2">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('page.index') }}">
            <i class="far fa-list-alt"></i>
            Страницы
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('news.index') }}">
            <i class="far fa-list-alt"></i>
            Новости
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('story.index') }}">
            <i class="far fa-list-alt"></i>
            История
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('product.index') }}">
            <i class="fas fa-box-open"></i>
            Продукция
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('product-property.index') }}">
            <i class="fas fa-box-open"></i>
            Параметры продукции
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('product-category.index') }}">
            <i class="fas fa-box-open"></i>
            Категории продукции
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('application-sphere.index') }}">
            <i class="fas fa-dolly"></i>
            Сферы применения
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('service.index') }}">
            <i class="fas fa-dolly"></i>
            Услуги
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('service-category.index') }}">
            <i class="fas fa-dolly"></i>
            Категории услуг
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('work.index') }}">
            <i class="fas fa-truck-loading"></i>
            Работы
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('work-category.index') }}">
            <i class="fas fa-truck-loading"></i>
            Категории работ
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('client.index') }}">
            <i class="fas fa-users"></i>
            Клиенты
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('project-request.index') }}">
            <i class="fas fa-comment-dots"></i>
            Заявки на проект
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('form-question.index') }}">
            <i class="fas fa-comment-dots"></i>
            Вопросы
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('questionnaire.index') }}">
            <i class="fas fa-comment-dots"></i>
            Опросные листы
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('back-call.index') }}">
            <i class="fas fa-comment-dots"></i>
            Обратный звонок
        </a>
    </li>
</ul>

<h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
    <span>Администрирование</span>
</h6>

<ul class="nav flex-column mb-2">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('user.index') }}">
            <i class="fas fa-users"></i>
            Пользователи
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('seo-data.index') }}">
            <i class="fas fa-users"></i>
            SEO описания
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('log.index') }}">
            <i class="far fa-eye"></i>
            Лог изменений
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('settings.index') }}">
            <i class="fas fa-cogs"></i>
            Настройки
        </a>
    </li>
</ul>

<h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
    <span>{{ Auth::user()->name }}</span>
</h6>

<ul class="nav flex-column mb-2">

    @includeIf('admin.block.left_menu_user')

    <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i>
            Выйти</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </li>
</ul>
