<header class="app-header navbar">

    <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" data-toggle="sidebar-show" type="button">
        <span class="navbar-toggler-icon">
        </span>
    </button>

    <a class="navbar-brand" href="#" style="width: 300px !important;">
        <img alt="Gestión Egsi" class="navbar-brand-full embed-responsive" height="auto" src="{{ url('img/mintel/logo_mintel_negro.png') }}" width="100%">
            <img alt="CoreUI Logo" class="navbar-brand-minimized" height="30" src="{{ url('img/brand/sygnet.svg') }}" width="30">
    </a>

    <button class="navbar-toggler sidebar-toggler d-md-down-none" data-toggle="sidebar-lg-show" type="button">
        <span class="navbar-toggler-icon">
        </span>
    </button>

    <ul class="nav navbar-nav ml-auto">

        <li class="nav-item dropdown">
            <a aria-expanded="false" aria-haspopup="true" class="nav-link" data-toggle="dropdown" href="#" role="button">
                <img alt="admin@bootstrapmaster.com" class="img-avatar" src="{{ url('img/mintel/boss_man.png')}}">
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header text-center">
                    <strong>
                        Cuenta
                    </strong>
                </div>

                <a class="dropdown-item" href="#">
                    <i class="fa fa-user">
                    </i>
                    Perfil
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fa fa-wrench">
                    </i>
                    Configuración
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ url('/logout') }}">
                    <i class="fa fa-sign-out">
                    </i>
                    Salir
                </a>
            </div>
        </li>
    </ul>

    <button class="navbar-toggler aside-menu-toggler d-md-down-none" data-toggle="aside-menu-lg-show" type="button">
        <span class="navbar-toggler-icon">
        </span>
    </button>
    <button class="navbar-toggler aside-menu-toggler d-lg-none" data-toggle="aside-menu-show" type="button">
        <span class="navbar-toggler-icon">
        </span>
    </button>
</header>
