<!-- {{-- @if (!$user->email_verified_at)
    <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme">
        <div class="card-body p-3">
            <form action="{{ route('user.verify') }}" method="POST"> -->
<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
  <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
      <i class="bx bx-menu bx-sm"></i>
    </a>
  </div>

<div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
  <!-- Search -->
  <div class="navbar-nav align-items-center">
    <div class="nav-item d-flex align-items-center">
      <i class="bx bx-search fs-4 lh-0"></i>
      <input
        type="text"
        class="form-control border-0 shadow-none ps-1 ps-sm-2"
        placeholder="Search..."
        aria-label="Search..." />
    </div>
  </div>
  <!-- /Search -->

  <ul class="navbar-nav flex-row align-items-center ms-auto">
    <!-- Place this tag where you want the button to render. -->


    <!-- User -->
    <li class="nav-item navbar-dropdown dropdown-user dropdown">
        <h1>hola</h1>
      <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
        <div class="avatar avatar-online">
          <!-- <img src="{{ Storage::url(Auth::user()->avatar) }}" alt class="w-px-40 h-px-40 rounded-circle" /> -->
          @if(url(Auth::user()->avatar) && Storage::exists('public/storage/avatars/'.url(Auth::user()->avatar)))
          <img src="{{ Storage::url('public/storage/avatars/'.url(Auth::user()->avatar)) }}" class="mt-2 img-circle elevation-2" width="80" height="80" alt="User Image">
          @else
          @endif
          <div
          <img src="{{ Storage::url(Auth::user()->avatar) }}" class="mt-2 img-circle elevation-2" width="80" height="80" alt="Default User Image">
              hola
              </div>
        </div>
      </a>
      <ul class="dropdown-menu dropdown-menu-end">
        <li>
          <a class="dropdown-item" href="#">
            <div class="d-flex">
              <div class="flex-shrink-0 me-3">
                <div class="avatar avatar-online">
                  <!-- <img src="{{ Storage::url(Auth::user()->avatar) }}" alt class="w-px-40 h-px-40 rounded-circle" /> -->
                  @if(url(Auth::user()->avatar) && Storage::exists('public/avatars/'.url(Auth::user()->avatar)))
                  <img src="{{ Storage::url('public/avatars/'.url(Auth::user()->avatar)) }}" class="mt-2 img-circle elevation-2" width="80" height="80" alt="User Image">
                  @else
                  <img src="{{ asset('avatar.png') }}" class="mt-2 img-circle elevation-2" width="80" height="80" alt="Default User Image">
                  @endif
                </div>
              </div>
              <div class="flex-grow-1">
                <span class="fw-medium d-block">{{Auth::user()->business}}</span>
                <small class="text-muted">{{Auth::user()->role->name}}</small>
              </div>
            </div>
          </a>
        </li>
        <li>
          <div class="dropdown-divider"></div>
        </li>
        <li>
          <a class="dropdown-item" href="{{ route('profile.edit') }}">
            <i class="bx bx-user me-2"></i>
            <span class="align-middle">Perfil</span>
          </a>
        </li>
        <li>
          <div class="dropdown-divider"></div>
        </li>
        <li>
            <a class="dropdown-item" href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bx bx-power-off me-2"></i>
                <span class="align-middle">Log Out</span>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf<div class="d-flex">
                    <h5 class="card-title mb-0 align-content-center" style="margin-right: 20px">Validar correo electrinico</h5>
                    <input type="hidden" name="email" value="{{ auth()->user()->email }}">
                    <input style="width: 70%" type="text" class="form-control-sm me-2" id="verification_code" name="verification_code"
                        placeholder="Ingrese su código de validación" required>
                    <button type="submit" class="btn btn-primary">Validar</button>
                </div>
            </form>

      </div>
    </nav>
<!-- @endif --}} -->
<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center w-100 justify-content-end" id="navbar-collapse">
        <ul class="navbar-nav ms-auto"> <!-- Cambiado a ms-auto para alinear a la derecha -->
            <!-- Perfil -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('profile.edit') }}">
                    <i class="bx bx-user me-2"></i>
                    <span class="align-middle">Perfil</span>
                </a>
            </li>

            <!-- Logout -->
            <li class="nav-item">
                <a class="nav-link" href="javascript:void(0);"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bx bx-power-off me-2"></i>
                    <span class="align-middle">Log Out</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</nav>

<div id="payment-alert" class="d-flex justify-content-center text-center"></div>



