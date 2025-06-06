<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('dashboard.index') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('logo_blue.png') }}" width="50" height="50" alt="">
            </span>
            <span class="demo menu-text fw-bold ms-2">Unellez AI</span>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>
    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">

        @if(auth()->user() && (auth()->user()->role_id === 1 || auth()->user()->role_id === 2))
        <li class="menu-item ">
            <a href="{{ route('users.index') }}" class="menu-link">
                <i class="bx bx-user-circle me-2"></i>
                <div data-i18n="Training">Usuarios</div>
            </a>
        </li>
        @endif

        <li class="menu-item">
                <a href="#" class="menu-link">
                    <i class="bx bx-book-open me-2"></i>
                    <div data-i18n="Fluid">Programas</div>
                </a>
        </li>

        @if(auth()->user() && auth()->user()->role_id === 4)
            <li class="menu-item">
                <a href="{{ route('trainings.index') }}" class="menu-link">
                    <i class="bx bx-brain me-2"></i>
                    <div data-i18n="Fluid">Entrenar</div>
                </a>
            </li>
        @endif


        @if(auth()->user() && auth()->user()->role_id === 3)
            <li class="menu-item">
                <a href="{{ route('chats.create') }}" class="menu-link"> <!-- Cambiado a create -->
                    <i class="bx bx-message-square-add me-2"></i>
                    <div data-i18n="Fluid">Crear chat</div>
                </a>
            </li>
        @endif

        @foreach(App\Models\Chat::where('user_id', auth()->id())->latest()->get() as $chat)
            <li class="menu-item">
                <a href="{{ route('chats.show', $chat->id) }}" class="menu-link">
                    <i class="bx bx-message me-2"></i>
                    <div data-i18n="Fluid">{{ $chat->name }}</div>
                </a>
            </li>
        @endforeach
    </li>
</aside>
