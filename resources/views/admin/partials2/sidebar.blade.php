<div class="sidebar-wrapper">
    <div id="sidebarEffect"><canvas width="800" height="711"></canvas></div>
    <div>
        <div class="logo-wrapper logo-wrapper-center">
            <a href="/" data-bs-original-title="" title="">
                @if(isset($companyData) && $companyData && $companyData->logo)
                
                    <img class="img-fluid for-white mb-2" src="{{ asset('storage/' . $companyData->logo) }}" alt="{{ $companyData->name }}">
                @else
                    <img class="img-fluid for-white" src="assets/images/logo/full-white.png" alt="logo">
                @endif
            </a>
            <div class="back-btn">
                <i class="fa fa-angle-left"></i>
            </div>
        </div>
  

        <nav class="sidebar-main">
            <div class="left-arrow disabled" id="left-arrow">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            </div>

            {{-- Sidebar-Menu --}}
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar" data-simplebar="init" style="display: block;">
                    <li class="back-btn"></li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav active" href="/" data-bs-original-title="" title="">
                            <i class="ri-home-line"></i>
                            <span>Dashboard</span>
                            <div class="according-menu"><i class="ri-arrow-right-s-line"></i></div>
                        </a>
                    </li>

                    {{-- Categorias --}}
                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)" data-bs-original-title="" title="">
                            <i class="ri-list-check-2"></i>
                            <span>Categorias</span>
                            <div class="according-menu"><i class="ri-arrow-right-s-line"></i></div>
                        </a>
                        <ul class="sidebar-submenu" style="display: none;">
                            <li><a href="{{ route('categories.index') }}">Listado de Categorias</a></li>
                            <li><a href="{{ route('categories.create') }}">Nueva Categoria</a></li>
                        </ul>
                    </li>

                    {{-- Productos --}}
                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)" data-bs-original-title="" title="">
                            <i class="ri-barcode-line"></i>
                            <span>Productos</span>
                            <div class="according-menu"><i class="ri-arrow-right-s-line"></i></div>
                        </a>
                        <ul class="sidebar-submenu" style="display: none;">
                            <li><a href="{{ route('products.index') }}">Listado de Productos</a></li>
                            <li><a href="{{ route('products.create') }}">Nuevo Producto</a></li>
                        </ul>
                    </li>

                    {{-- Mesas --}}
                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)" data-bs-original-title="" title="">
                            <i class="ri-list-settings-line"></i>
                            <span>Mesas</span>
                            <div class="according-menu"><i class="ri-arrow-right-s-line"></i></div>
                        </a>
                        <ul class="sidebar-submenu" style="display: none;">
                            <li><a href="{{ route('tables.index') }}">Listado de Mesas</a></li>
                            <li><a href="{{ route('tables.gestion') }}">Gestión de Mesas</a></li>
                            <li><a href="{{ route('tables.create') }}">Nueva Mesa</a></li>
                        </ul>
                    </li>

                    {{-- Ciudades-Zonas --}}
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title" href="javascript:void(0)" data-bs-original-title="" title="">
                            <i class="ri-building-line"></i>
                            <span>Ciudades-Zonas</span>
                            <div class="according-menu"><i class="ri-arrow-right-s-line"></i></div>
                        </a>
                        <ul class="sidebar-submenu" style="display: none;">
                            <li><a href="{{ route('cities.index') }}">Listado de Ciudades</a></li>
                            <li><a href="{{ route('zones.index') }}">Listado de Zonas</a></li>
                           {{--  <li><a href="#">Nueva Ciudad</a></li> --}}
                        </ul>
                    </li>

                    {{-- Usuarios --}}
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title" href="javascript:void(0)" data-bs-original-title="" title="">
                            <i class="fa fa-users"></i>
                            <span>Usuarios</span>
                            <div class="according-menu"><i class="ri-arrow-right-s-line"></i></div>
                        </a>
                        <ul class="sidebar-submenu" style="display: none;">
                            <li><a href="{{ route('users.index') }}">Listado de Usuarios</a></li>
                            <li><a href="{{ route('users.create') }}">Nuevo Usuario</a></li>
                        </ul>
                    </li>

                    {{-- Roles y Permisos --}}
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title" href="javascript:void(0)" data-bs-original-title="" title="">
                            <i class="ri-flag-line"></i>
                            <span>Roles y Permisos</span>
                            <div class="according-menu"><i class="ri-arrow-right-s-line"></i></div>
                        </a>
                        <ul class="sidebar-submenu" style="display: none;">
                            <li><a href="#">Usuarios</a></li>
                            <li><a href="#">Roles</a></li>
                            <li><a href="#">Permisos</a></li>
                        </ul>
                    </li>

                    {{-- Cuentas x Cobrar --}}
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title" href="javascript:void(0)" data-bs-original-title="" title="">
                            <i class="ri-refund-2-fill"></i>
                            <span>Cuentas x Cobrar</span>
                            <div class="according-menu"><i class="ri-arrow-right-s-line"></i></div>
                        </a>
                        <ul class="sidebar-submenu" style="display: none;">
                            <li><a href="{{ route('receivables.index') }}">Listado de Cuentas</a></li>
                            <li><a href="#">Detalles de CxC</a></li>
                            <li><a href="#">Seguimiento de CxC</a></li>
                        </ul>
                    </li>

                    {{-- Ordenes --}}
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title" href="javascript:void(0)" data-bs-original-title="" title="">
                            <i class="ri-restaurant-2-line"></i>
                            <span>Ordenes</span>
                            <div class="according-menu"><i class="ri-arrow-right-s-line"></i></div>
                        </a>
                        <ul class="sidebar-submenu" style="display: none;">
                            <li><a href="{{ route('orders.index') }}">Listado de Ordenes</a></li>
                            <li><a href="#">Detalles de Ordenes</a></li>
                            <li><a href="#">Seguimiento de Ordenes</a></li>
                        </ul>
                    </li>

                    {{-- Configuraciones --}}
                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)" data-bs-original-title="" title="">
                            <i class="ri-settings-line"></i>
                            <span>Configuraciones</span>
                            <div class="according-menu"><i class="ri-arrow-right-s-line"></i></div>
                        </a>
                        <ul class="sidebar-submenu" style="display: none;">
                            <li><a href="{{ route('companies.index') }}">Datos de la Empresa</a></li>
                        </ul>
                    </li>

                    {{-- Reportes --}}
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="#" data-bs-original-title="" title="">
                            <i class="ri-file-chart-line"></i>
                            <span>Reportes</span>
                            <div class="according-menu"><i class="ri-arrow-right-s-line"></i></div>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="right-arrow" id="right-arrow">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
            </div>
        </nav>
    </div>
</div>

<style>
    .company-info {
        padding: 15px;
        margin: 10px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        text-align: center;
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    }

    .company-info h5 {
        color: white;
        font-size: 16px;
        margin-bottom: 8px;
        font-weight: 600;
    }

    .company-info div {
        color: rgba(255, 255, 255, 0.8);
        font-size: 12px;
        margin-bottom: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
    }

    .company-info i {
        font-size: 12px;
    }

    /* Sidebar colapsado - ocultar información de compañía */
    .sidebar-compact .company-info {
        display: none;
    }

    /* Sidebar mini - mostrar solo iconos */
    .sidebar-mini .company-info {
        display: none;
    }
</style>