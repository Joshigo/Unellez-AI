<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
    <!-- Botón para abrir el menú en móvil -->
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)" id="toggle-menu">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center w-100 justify-content-between" id="navbar-collapse">
        <!-- Nombre de Usuario / Perfil en Sesión (A la izquierda) -->
        <div class="d-flex align-items-center ms-2">
            <div class="d-flex flex-column align-items-end me-2">
                <span class="fw-semibold d-block text-dark" style="line-height: 1.2;">{{ auth()->user()->name ?? 'Usuario' }}</span>
                <small class="text-muted" style="font-size: 0.72rem; line-height: 1.2;">
                    {{ auth()->user()->program->name ?? 'Sin programa' }}
                </small>
            </div>
            <div class="avatar avatar-online" style="width: 38px; height: 38px;">
                <span class="avatar-initial rounded-circle bg-label-primary fw-bold text-uppercase d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; font-size: 0.9rem;">
                    {{ substr(auth()->user()->name ?? 'U', 0, 2) }}
                </span>
            </div>
        </div>

        <ul class="navbar-nav flex-row ms-auto">
            <!-- Perfil -->
            <li class="nav-item pe-3">
                <a class="nav-link d-flex align-items-center" href="{{ route('profile.edit') }}">
                    <i class="bx bx-user me-1"></i>
                    <span class="align-middle d-none d-sm-inline">Perfil</span>
                </a>
            </li>

            <!-- Logout -->
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center" href="javascript:void(0);"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bx bx-power-off me-1"></i>
                    <span class="align-middle d-none d-sm-inline">Cerrar Sesión</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</nav>
