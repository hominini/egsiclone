<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">

            <li class="nav-item">
                <a class="nav-link" href="/">
                <i class="nav-icon icon-speedometer"></i> Panel de control
                </a>
            </li>

            <li class="nav-title">Administración</li>

            <li class="nav-item">
                <a class="nav-link {{ request()->is('users*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                <i class="nav-icon icon-people"></i> Usuarios</a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->is('institutions*') ? 'active' : '' }}" href="{{ route('institutions.index') }}">
                <i class="nav-icon icon-shield"></i> Instituciones</a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->is('roles*') ? 'active' : '' }}" href="{{ route('roles.index') }}">
                <i class="nav-icon cui-lock-unlocked"></i> Permisos</a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->is('milestones*') ? 'active' : '' }}" href="{{ route('milestones.index') }}">
                <i class="nav-icon cui-shield"></i> Hitos</a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->is('fulfillments*') ? 'active' : '' }}" href="{{ route('fulfillments.index') }}">
                <i class="nav-icon cui-check"></i> Cumplimiento</a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->is('fulfillment_activities*') ? 'active' : '' }}" href="{{ route('fulfillment_activities.index') }}">
                <i class="nav-icon cui-file"></i> Evidencia cumplimiento</a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->is('assessment*') ? 'active' : '' }}" href="{{ route('assessment.index') }}">
                <i class="nav-icon cui-file"></i> Evaluación</a>
            </li>

            <li class="divider"></li>

        </ul>

    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
