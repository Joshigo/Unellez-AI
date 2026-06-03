<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    
    <a href="{{ route('dashboard.index') }}" class="text-decoration-none d-block">
        <div class="sidebar-promo-card m-3 p-3 text-center border-0 rounded-3">
            <div class="promo-bg-glow"></div>
            <img src="{{ asset('bot-center_blue.png') }}" class="promo-bot-image mb-2" alt="Unellez AI Bot Mascot">
            <h5 class="fw-bold mb-1 text-primary" style="font-size: 0.95rem;">Unellez AI</h5>
            <p class="text-muted small mb-0" style="font-size: 0.75rem;">Tu Asistente Inteligente</p>
        </div>
    </a>
<!-- <div class="app-brand demo">
        <a href="{{ route('dashboard.index') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('logo_blue.png') }}" width="50" height="50" alt="">
            </span>
            <span class="demo menu-text fw-bold ms-2">Unellez AI</span>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div> -->
    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">

        @if(auth()->user() && (auth()->user()->role_id === 1 || auth()->user()->role_id === 2))
        <li class="menu-item ">
            <a href="{{ route('users.index') }}" class="menu-link">
                <i class="bx bx-cog me-2"></i>
                <div data-i18n="Fluid">Configuraciones</div>
            </a>
        </li>
        @endif

        @if(auth()->user() && (auth()->user()->role_id === 1 || auth()->user()->role_id === 2 || auth()->user()->role_id === 3))
            <li class="menu-item">
            <a href="{{ route('trainings.index') }}" class="menu-link">
                <i class="bx bx-brain me-2"></i>
                <div data-i18n="Fluid">Entrenar</div>
            </a>
            </li>
        @endif

        @if(auth()->user() && (auth()->user()->role_id === 1 || auth()->user()->role_id === 2 || auth()->user()->role_id === 3))
            <li class="menu-item">
                <a href="{{ route('chats.index') }}" class="menu-link">
                    <i class="bx bx-chat me-2"></i>
                    <div data-i18n="Fluid">Chats</div>
                </a>
            </li>
        @endif


        {{--  @if(auth()->user() && auth()->user()->role_id === 3)  --}}
            <li class="menu-item">
                <a href="{{ route('chats.create') }}" class="menu-link"> <!-- Cambiado a create -->
                    <i class="bx bx-message-square-add me-2"></i>
                    <div data-i18n="Fluid">Crear chat</div>
                </a>
            </li>
        {{--  @endif  --}}

        @foreach(App\Models\Chat::where('user_id', auth()->id())->latest()->get() as $chat)
            <li class="menu-item">
                <a href="{{ route('chats.show', $chat->id) }}" class="menu-link">
                    <i class="bx bx-message me-2"></i>
                    <div data-i18n="Fluid">{{ $chat->name }}</div>
                </a>
            </li>
        @endforeach
    </ul>

    <!-- Bot Mascot Promotion Card -->
    <!-- <div class="sidebar-promo-card m-3 p-3 text-center border-0 rounded-3">
        <div class="promo-bg-glow"></div>
        <img src="{{ asset('bot-center_blue.png') }}" class="promo-bot-image mb-2" alt="Unellez AI Bot Mascot">
        <h5 class="fw-bold mb-1 text-primary" style="font-size: 0.95rem;">Unellez AI</h5>
        <p class="text-muted small mb-0" style="font-size: 0.75rem;">Tu Asistente Inteligente</p>
    </div> -->
</aside>
