<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
    <!-- Botón para abrir el menú en móvil -->
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)" id="toggle-menu">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center w-100 justify-content-end" id="navbar-collapse">
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
                    <span class="align-middle d-none d-sm-inline">Log Out</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</nav>
