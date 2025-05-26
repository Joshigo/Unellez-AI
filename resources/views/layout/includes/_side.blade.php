
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('dashboard.index') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('favicon_emi.png') }}" width="50" height="50" alt="">
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
        <li class="menu-item @if(request()->routeIs('analitics')) active @endif">
            <a href="#" class="menu-link">
                <div data-i18n="Training">Usuarios</div>
            </a>
        </li>
        @endif

        @if(auth()->user() && auth()->user()->role_id === 4)
            <li class="menu-item">
                {{--  <a href="{{route('clients.index')}}" class="menu-link">  --}}
                    <div data-i18n="Fluid">Entrenar</div>
                </a>
            </li>
        @endif


        @if(auth()->user() && auth()->user()->role_id === 3)
        <ul class="menu-sub">
            <li class="menu-item">
                {{--  <a href="{{route('clients.index')}}" class="menu-link">  --}}
                    <div data-i18n="Fluid">Crear chat</div>
                </a>
            </li>
        @endif
    </li>
      <!-- Components -->

      @if(auth()->user() && auth()->user()->role_id == 1)
       <li class="menu-header small text-uppercase"><span class="menu-header-text">Components</span></li>
            <li class="menu-item">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-cog"></i>
                    <div data-i18n="User interface">Settings</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        {{--  <a href="{{ route('roles.index') }}" class="menu-link">  --}}
                            <div data-i18n="Tooltips & Popovers">Roles</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        {{--  <a href="{{ route('users.index') }}" class="menu-link">  --}}
                            <div data-i18n="Typography">Users</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        {{--  <a href="{{ route('profile.edit') }}" class="menu-link">  --}}
                            <div data-i18n="Typography">Profile</div>
                        </a>
                    </li>
                </ul>
            </li>
        @endif

       <li class="menu-header small text-uppercase">
    <span class="menu-header-text">Payments</span>
</li>

    <li class="menu-item">
        <a href="javascript:void(0)" class="menu-link menu-toggle">
            <i class="menu-icon fa-solid fa-credit-card"></i>
            <div data-i18n="User interface">Payment Plans</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item">
                <a href="#" class="menu-link payment-btn" data-amount="8900">
                    <div data-i18n="Typography">Power Start</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="#" class="menu-link payment-btn" data-amount="16900">
                    <div data-i18n="Typography">Startup Surge</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="#" class="menu-link payment-btn" data-amount="299000">
                    <div data-i18n="Typography">Scaleup Moment</div>
                </a>
            </li>
        </ul>
    </li>







      <!-- Extended components -->
      <li class="menu-item">
        @if(auth()->user() && auth()->user()->role_id === 3)
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-chip"></i>
                <div data-i18n="Extended UI" style="color: #d3d3d3;">
                    Integrations</i>
                </div>
            </a>
        @else
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-chip"></i>
                <div data-i18n="Extended UI">Integrations</div>
            </a>
        @endif
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="menu-icon fa-brands fa-whatsapp" style="
                    color: #25D366;"></i>
                    <div data-i18n="Extended UI">WhatsApp</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="javascript:void(0)" class="menu-link menu-toggle">
                            <div data-i18n="Extended UI">Activated</div>
                            </a>
                            <ul class="menu-sub">
                            <li class="menu-item">
                        <a href="" class="menu-link" data-bs-toggle="modal" data-bs-target="#ClientModal">
                        <div data-i18n="Text Divider">WhatsApp Agent</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="" class="menu-link" data-bs-toggle="modal" data-bs-target="#ClientIAModal">
                            <div data-i18n="Text Divider">WhatsApp IA</div>
                        </a>
                    </li>
                            </ul>
                        </li>
                        {{-- kasdkas --}}
                        <li class="menu-item">
                            <a href="javascript:void(0)" class="menu-link menu-toggle">
                            <div data-i18n="Extended UI">Chats</div>
                            </a>
                            <ul class="menu-sub">
                            <li class="menu-item">
                        {{--  <a href="{{route('chatviews.index')}}" class="menu-link">  --}}
                        <div data-i18n="Text Divider">Chat Agent</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        {{--  <a href="{{route('chat-ia')}}" class="menu-link">  --}}
                        <div data-i18n="Text Divider">Chat IA</div>
                        </a>
                    </li>

                    <li class="menu-item">
                        {{--  <a href="{{route('funnel.whatsapp')}}" class="menu-link">  --}}
                        <div data-i18n="Text Divider">Funnel WhatsApp</div>
                        </a>
                    </li>

                            </ul>
                        </li>

                    </ul>
                </li>

                <li class="menu-item">
                    @if(auth()->user() && auth()->user()->role_id === 3)
                        <a href="javascript:void(0)" class="menu-link menu-toggle" title="Acceso denegado">
                            <i class="menu-icon fa-brands fa-instagram" style="color:#E1306A"></i>
                            <div data-i18n="Extended UI" style="color: #d3d3d3;">
                                Instagram
                            </div>
                        </a>
                    @else
                        <a href="javascript:void(0)" class="menu-link menu-toggle">
                            <i class="menu-icon fa-brands fa-instagram" style="color:#E1306A"></i>
                            <div data-i18n="Extended UI">
                                Instagram
                            </div>
                        </a>
                    @endif
                    <ul class="menu-sub">
                    <li class="menu-item">
                        @if(auth()->user() && auth()->user()->role_id === 3)
                        <a href="javascript:void(0);" class="menu-link" stitle="Acceso denegado" class="menu-link" data-bs-toggle="modal" data-bs-target="#deniedAccessModal">
                            <div data-i18n="Text Divider" style="color: #d3d3d3;">
                            Chats
                            </div>
                        </a>
                        @else
                        <a href="extended-ui-text-divider.html" class="menu-link">
                            <div data-i18n="Text Divider">Chats</div>
                        </a>
                        @endif
                    </li>
                    </ul>
                </li>

                <li class="menu-item">
                    @if(auth()->user() && auth()->user()->role_id === 3)
                    <a href="javascript:void(0)" class="menu-link menu-toggle" title="Acceso denegado" >
                        <i class="menu-icon fa-brands fa-facebook" style="color: #1877F2"></i>
                        <div data-i18n="Extended UI" style="color: #d3d3d3;">
                            Facebook
                        </div>
                    </a>
                    @else
                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                        <i class="menu-icon fa-brands fa-facebook" style="color: #1877F2"></i>
                        <div data-i18n="Extended UI">Facebook</div>
                    </a>
                    @endif
                    <ul class="menu-sub">
                        <li class="menu-item">
                            @if(auth()->user() && auth()->user()->role_id === 3)
                            <a href="javascript:void(0);" class="menu-link" data-bs-toggle="modal" data-bs-target="#deniedAccessModal" title="Acceso denegado">
                                <div data-i18n="Text Divider" style="color: #d3d3d3;">
                                Pages
                                </div>
                            </a>
                            @else
                            {{--  <a href="{{route('facebook.data')}}" class="menu-link">  --}}
                                <div data-i18n="Text Divider">Pages</div>
                            </a>
                            @endif
                        </li>

                    <li class="menu-item">
                        @if(auth()->user() && auth()->user()->role_id === 3)
                        <a href="javascript:void(0);" class="menu-link" data-bs-toggle="modal" data-bs-target="#deniedAccessModal" title="Acceso denegado">
                            <div data-i18n="Text Divider" style="color: #d3d3d3;">
                            Create Post
                            </div>
                        </a>
                        @else
                        {{--  <a href="{{route('facebook_posts.create')}}" class="menu-link">  --}}
                            <div data-i18n="Text Divider">Create Post</div>
                        </a>
                        @endif
                    </li>

                    <li class="menu-item">
                        @if(auth()->user() && auth()->user()->role_id === 3)
                        <a href="javascript:void(0);" class="menu-link" data-bs-toggle="modal" data-bs-target="#deniedAccessModal" title="Acceso denegado">
                            <div data-i18n="Text Divider" style="color: #d3d3d3;">
                            Show Post
                            </div>
                        </a>
                        @else
                        {{--  <a href="{{route('facebook.post')}}" class="menu-link">  --}}
                            <div data-i18n="Text Divider">Show Post</div>
                        </a>
                        @endif
                    </li>

                    <li class="menu-item">
                        @if(auth()->user() && auth()->user()->role_id === 3)
                        <a href="javascript:void(0);" class="menu-link" data-bs-toggle="modal" data-bs-target="#deniedAccessModal" title="Acceso denegado">
                            <div data-i18n="Text Divider" style="color: #d3d3d3;">
                            Metrics Post
                            </div>
                        </a>
                        @else
                        {{--  <a href="{{route('facebook.post.stats')}}" class="menu-link">  --}}
                            <div data-i18n="Text Divider">Metrics Post</div>
                        </a>
                        @endif
                    </li>
                    </ul>
                </li>


            </ul>
      </li>

        <li class="menu-item">
            @if(auth()->user() && auth()->user()->role_id === 3)
            <a href="javascript:void(0);" class="menu-link" data-bs-toggle="modal" data-bs-target="#deniedAccessModal">
                <i class="menu-icon fa-solid fa-envelope-open-text"></i>
                <div data-i18n="User interface" style="color: #d3d3d3;">
                    Email Marketing
                </div>
            </a>
            @else
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon fa-solid fa-envelope-open-text"></i>
                <div data-i18n="User interface">Email Marketing</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                {{--  <a href="{{route('send.excel')}}" class="menu-link">  --}}
                    <div data-i18n="Typography">Email Image</div>
                </a>
                </li>
                <li class="menu-item">
                {{--  <a href="{{route('send.offert')}}" class="menu-link">  --}}
                    <div data-i18n="Typography">Email Offert</div>
                </a>
                </li>
            </ul>
            @endif
        </li>

        <li class="menu-item">
            @if(auth()->user() && auth()->user()->role_id === 3)
            <a href="javascript:void(0);" class="menu-link" data-bs-toggle="modal" data-bs-target="#deniedAccessModal" title="Acceso denegado">
                <i class="menu-icon tf-icons bx bx-trophy"></i>
                <div data-i18n="Boxicons" style="color: #d3d3d3;">
                Funnel
                </div>
            </a>
            @else
            {{--  <a href="{{route('embudos.index')}}" class="menu-link">  --}}
                <i class="menu-icon tf-icons bx bx-trophy"></i>
                <div data-i18n="Boxicons">Funnel</div>
            </a>
            @endif
        </li>

        <li class="menu-header small text-uppercase"><span class="menu-header-text">Emi - Sales</span></li>

        <li class="menu-item">
            @if(auth()->user() && auth()->user()->role_id === 3)
            <a href="javascript:void(0);" class="menu-link" title="Acceso denegado" data-bs-toggle="modal" data-bs-target="#deniedAccessModal">
                <i class="fa-solid fa-bell menu-icon"></i>
                <div data-i18n="User interface" style="color: #d3d3d3;">
                    Notifications
                </div>
                <span id="notification-badge" class="badge badge-danger" style="display:none;"></span>
            </a>
            @else
            <a href="#" class="menu-link">
                <i class="fa-solid fa-bell menu-icon"></i>
                <div data-i18n="User interface">Notifications</div>
                <span id="notification-badge" class="badge badge-danger" style="display:none;"></span>
            </a>
            @endif
        </li>
        <div id="notifications-container">

        </div>

        <li class="menu-item active">
            <a href="javascript:void(0)" class="menu-link">
                <i class="fa-solid fa-store menu-icon"></i>
                <div data-i18n="User interface">Emi Sales</div>
            </a>
        </li>

       @if (Auth::user()->catalog_token)
        <li class="menu-item">
            {{--  <a href="{{ route('catalogo.show', ['token' => Auth::user()->catalog_token]) }}" class="menu-link">  --}}
                <i class="fa-solid fa-table-list menu-icon"></i>
                <div data-i18n="User interface">Catalog</div>
            </a>
        </li>
        @endif
        <li class="menu-item">
            @if(auth()->user() && auth()->user()->role_id === 3)
            <a href="javascript:void(0);" class="menu-link" title="Acceso denegado" data-bs-toggle="modal" data-bs-target="#deniedAccessModal">
                <i class="fa-solid fa-tags menu-icon"></i>
                <div data-i18n="User interface" style="color: #d3d3d3;">
                    Categories
                </div>
            </a>
            @else
            {{--  <a href="{{route('categorias.index')}}" class="menu-link">  --}}
                <i class="fa-solid fa-tags menu-icon"></i>
                <div data-i18n="User interface">Categories</div>
            </a>
            @endif
        </li>

        <li class="menu-item">
            @if(auth()->user() && auth()->user()->role_id === 3)
            <a href="javascript:void(0);" class="menu-link" title="Acceso denegado" data-bs-toggle="modal" data-bs-target="#deniedAccessModal">
                <i class="fa-solid fa-qrcode menu-icon"></i>
                <div data-i18n="User interface" style="color: #d3d3d3;">
                    QR Generator
                </div>
            </a>
            @else
            {{--  <a href="{{ route('emi-sales.generateQr.index') }}" class="menu-link">  --}}
                <i class="fa-solid fa-qrcode menu-icon"></i>
                <div data-i18n="User interface">QR Generator</div>
            </a>
            @endif
        </li>
        <li class="menu-item">
            @if(auth()->user() && auth()->user()->role_id === 3)
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="fa-solid fa-boxes-stacked menu-icon"></i>
                <div data-i18n="User interface" style="color: #d3d3d3;">
                    Products
                </div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link" title="Acceso denegado" data-bs-toggle="modal" data-bs-target="#deniedAccessModal">
                        <div data-i18n="Tooltips & Popovers">
                            Products List <i class="fa-solid fa-ban text-danger ms-1"></i>
                        </div>
                    </a>
                </li>
            </ul>
            @else
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="fa-solid fa-boxes-stacked menu-icon"></i>
                <div data-i18n="User interface">Products</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    {{--  <a href="{{ route('productos.index') }}" class="menu-link">  --}}
                        <div data-i18n="Tooltips & Popovers">Products List</div>
                    </a>
                </li>
            </ul>
            @endif
        </li>
        <li class="menu-item">
            @if(auth()->user() && auth()->user()->role_id === 3)
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="fa-solid fa-cart-shopping menu-icon"></i>
                <div data-i18n="User interface" style="color: #d3d3d3;">
                    Shopping
                </div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link" title="Acceso denegado" data-bs-toggle="modal" data-bs-target="#deniedAccessModal">
                        <div data-i18n="Tooltips & Popovers" style="color: #d3d3d3;">
                            Stock movements
                        </div>
                    </a>
                </li>
            </ul>
            @else
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="fa-solid fa-cart-shopping menu-icon"></i>
                <div data-i18n="User interface">Shopping</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    {{--  <a href="{{ route('historial.compras') }}" class="menu-link">  --}}
                        <div data-i18n="Tooltips & Popovers">Stock movements</div>
                    </a>
                </li>
            </ul>
            @endif
        </li>

        <li class="menu-item">
            @if(auth()->user() && auth()->user()->role_id === 3)
            <a href="javascript:void(0);" class="menu-link" title="Acceso denegado" data-bs-toggle="modal" data-bs-target="#deniedAccessModal">
                <i class="fa-solid fa-sack-dollar menu-icon"></i>
                <div data-i18n="User interface" style="color: #d3d3d3;">
                    Sales
                </div>
            </a>
            @else
            {{--  <a href="{{ route('ventas.index') }}" class="menu-link">  --}}
                <i class="fa-solid fa-sack-dollar menu-icon"></i>
                <div data-i18n="User interface">Sales</div>
            </a>
            @endif
        </li>
</aside>
