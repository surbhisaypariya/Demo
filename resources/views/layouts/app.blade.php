<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    
    <!-- Styles -->
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">
    
    <link rel = "stylesheet"    href = "https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- JSTREE -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
    
    {{-- Validation --}}   
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
    
</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="#">Laravel Basics</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-info">Logout</button>
            </form>
            {{-- <button class="btn btn-info">Logout</button> --}}
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <a class="nav-link" href="{{ route('user.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                            Users
                        </a>
                        <a class="nav-link" href="{{ route('category.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-sitemap"></i></div>
                            Category
                        </a>
                        <a class="nav-link" href="{{ route('product.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-list-alt"></i></div>
                            Product
                        </a>
                        <a class="nav-link" href="{{ route('attachments') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                            Product Attatchment
                        </a>
                        <a class="nav-link" href="{{ route('country.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-globe"></i></div>
                            Country
                        </a>
                        <a class="nav-link" href="{{ route('country_group.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-globe"></i></div>
                            Country Group
                        </a>
                        <a class="nav-link" href="{{ route('region.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-list-alt"></i></div>
                            Region
                        </a>
                        <a class="nav-link" href="{{ route('organization_show') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-sitemap"></i></div>
                            Organization
                        </a>
                        <a class="nav-link" href="{{ route('location_show') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-location-circle"></i></div>
                            Location
                        </a>
                        <a class="nav-link" href="{{ route('donation_show') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-list-alt"></i></div>
                            Donation
                        </a>
                        <a class="nav-link" href="{{ route('carriers.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-list-alt"></i></div>
                            Carrier Method
                        </a>
                        <a class="nav-link" href="{{ route('shipment.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-list-alt"></i></div>
                            Shipment
                        </a>
                        <a class="nav-link" href="{{ route('stock.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-stocking"></i></div>
                            Stock
                        </a>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        @auth
                        <?php 
                        $username = Auth::user()->username;
                        echo $username;
                        ?>    
                        @endauth
                        
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main class="py-4">
                    @include('flash-message')
                    
                    @yield('content')
                </main>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2021</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
</body>
</html>
