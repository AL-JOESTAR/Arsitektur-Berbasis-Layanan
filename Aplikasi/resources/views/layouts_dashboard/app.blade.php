<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard</title>
        <!-- Favicon-->
        <!-- <link rel="icon" type="image/x-icon" href="assets/favicon.ico" /> -->
        <!-- Core theme CSS (includes Bootstrap)-->
        <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

        <style>
            :root{
                --bg:#F4F5FA;
                --surface:#FFFFFF;
                --ink:#191D2E;
                --ink-soft:#6B7080;
                --border:#E7E8F1;

                --sidebar:#171B2E;
                --sidebar-elev:#20253D;
                --sidebar-text:#B9BDD4;
                --sidebar-text-active:#FFFFFF;

                --brass:#D9A54A;
                --brass-soft:#F6E7C8;
                --teal:#3C8C82;
                --coral:#E2684C;

                --radius-lg:18px;
                --radius-md:12px;
                --radius-sm:8px;
                --shadow-sm:0 1px 2px rgba(15,17,33,.05);
                --shadow-md:0 10px 30px rgba(15,17,33,.08);
            }

            *{box-sizing:border-box;}

            html,body{
                height:100%;
            }

            body{
                font-family:'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
                background:var(--bg);
                color:var(--ink);
                -webkit-font-smoothing:antialiased;
            }

            h1,h2,h3,h4,h5,h6,.brand,.sidebar-heading{
                font-family:'Sora', sans-serif;
            }

            a{ text-decoration:none; }

            /* ---------- Layout shell ---------- */
            #wrapper{
                min-height:100vh;
            }

            #sidebar-wrapper{
                width:270px;
                min-width:270px;
                background:var(--sidebar) !important;
                border:none !important;
                display:flex;
                flex-direction:column;
                transition:margin-left .25s ease;
                position:relative;
                z-index:20;
            }

            #wrapper.toggled #sidebar-wrapper{
                margin-left:-270px;
            }

            #page-content-wrapper{
                flex:1;
                min-width:0;
            }

            /* ---------- Sidebar ---------- */
            .sidebar-heading{
                background:var(--sidebar) !important;
                border:none !important;
                padding:28px 24px 22px !important;
                display:flex;
                align-items:center;
                gap:12px;
            }

            .brand-mark{
                width:42px;
                height:42px;
                border-radius:12px;
                background:linear-gradient(145deg, var(--brass), #B9822F);
                display:flex;
                align-items:center;
                justify-content:center;
                flex-shrink:0;
                box-shadow:0 6px 14px rgba(217,165,74,.35);
            }

            .brand-mark svg{ width:22px; height:22px; }

            .brand-text{
                display:flex;
                flex-direction:column;
                line-height:1.2;
                min-width:0;
            }

            .brand-text .eyebrow{
                font-size:11px;
                letter-spacing:.08em;
                text-transform:uppercase;
                color:var(--brass);
                font-weight:600;
            }

            .brand-text .name{
                color:#fff;
                font-size:15px;
                font-weight:600;
                white-space:nowrap;
                overflow:hidden;
                text-overflow:ellipsis;
                max-width:170px;
            }

            .sidebar-nav{
                padding:10px 14px;
                display:flex;
                flex-direction:column;
                gap:4px;
                flex:1;
            }

            .sidebar-nav .nav-label{
                font-size:11px;
                letter-spacing:.08em;
                text-transform:uppercase;
                color:#5D6284;
                font-weight:600;
                padding:16px 12px 8px;
            }

            .list-group-item{
                background:transparent !important;
                border:none !important;
                color:var(--sidebar-text) !important;
                border-radius:var(--radius-sm) !important;
                padding:12px 14px !important;
                display:flex !important;
                align-items:center;
                gap:12px;
                font-size:14.5px;
                font-weight:500;
                transition:background .15s ease, color .15s ease;
            }

            .list-group-item svg{
                width:18px;
                height:18px;
                flex-shrink:0;
                opacity:.85;
            }

            .list-group-item:hover{
                background:var(--sidebar-elev) !important;
                color:var(--sidebar-text-active) !important;
            }

            .list-group-item.active-nav{
                background:var(--brass) !important;
                color:#1D1707 !important;
                font-weight:600;
            }

            .list-group-item.active-nav svg{
                opacity:1;
            }

            .sidebar-footer{
                padding:16px 24px 22px;
                border-top:1px solid rgba(255,255,255,.06);
            }

            .sidebar-footer small{
                color:#5D6284;
                font-size:12px;
            }

            /* ---------- Top navbar ---------- */
            .navbar{
                background:var(--surface) !important;
                border-bottom:1px solid var(--border) !important;
                padding:14px 26px !important;
                position:sticky;
                top:0;
                z-index:10;
            }

            #sidebarToggle{
                background:var(--bg);
                border:1px solid var(--border);
                color:var(--ink);
                width:42px;
                height:42px;
                border-radius:var(--radius-sm);
                display:inline-flex;
                align-items:center;
                justify-content:center;
                padding:0;
            }

            #sidebarToggle:hover{
                background:#EDEEF6;
                border-color:var(--border);
                color:var(--ink);
            }

            #sidebarToggle svg{ width:19px; height:19px; }

            .btn-qr{
                background:var(--ink) !important;
                border:none !important;
                color:#fff !important;
                border-radius:var(--radius-sm) !important;
                font-weight:600;
                font-size:13.5px;
                padding:10px 18px !important;
                display:inline-flex;
                align-items:center;
                gap:8px;
            }

            .btn-qr svg{ width:16px; height:16px; }

            .btn-qr:hover{ background:#2A2F49 !important; }

            .navbar-nav .nav-link{
                color:var(--ink-soft) !important;
                font-weight:500;
                font-size:14.5px;
                padding:8px 14px !important;
            }

            .navbar-nav .nav-item.active .nav-link{
                color:var(--ink) !important;
                font-weight:600;
            }

            #navbarDropdown{
                display:flex;
                align-items:center;
                gap:10px;
            }

            .avatar-chip{
                width:34px;
                height:34px;
                border-radius:50%;
                background:var(--brass-soft);
                color:#8A6420;
                display:inline-flex;
                align-items:center;
                justify-content:center;
                font-weight:700;
                font-size:13px;
                font-family:'Sora', sans-serif;
            }

            .dropdown-menu{
                border:1px solid var(--border);
                border-radius:var(--radius-md);
                box-shadow:var(--shadow-md);
                padding:8px;
                margin-top:10px !important;
            }

            .dropdown-item{
                border-radius:var(--radius-sm);
                padding:9px 12px;
                font-size:14px;
                color:var(--ink);
            }

            .dropdown-item:hover{
                background:var(--bg);
            }

            .dropdown-divider{ margin:6px 4px; }

            /* ---------- Content area ---------- */
            .container-fluid{
                padding:28px 30px 40px !important;
            }

            /* Gentle, generic polish for whatever @yield('konten') contains */
            .card{
                border:1px solid var(--border);
                border-radius:var(--radius-lg);
                box-shadow:var(--shadow-sm);
            }

            .card-header{
                background:transparent;
                border-bottom:1px solid var(--border);
                font-family:'Sora', sans-serif;
                font-weight:600;
            }

            .table{
                --bs-table-bg:transparent;
            }

            .table thead th{
                text-transform:uppercase;
                font-size:11.5px;
                letter-spacing:.05em;
                color:var(--ink-soft);
                border-bottom:1px solid var(--border);
                font-weight:700;
            }

            .table td, .table th{
                vertical-align:middle;
                padding:14px 12px;
            }

            .btn-primary{
                background:var(--brass) !important;
                border-color:var(--brass) !important;
                color:#1D1707 !important;
                font-weight:600;
                border-radius:var(--radius-sm) !important;
            }

            .btn-primary:hover{
                background:#C6953F !important;
                border-color:#C6953F !important;
            }

            .btn-outline-primary{
                color:var(--brass) !important;
                border-color:var(--brass) !important;
                border-radius:var(--radius-sm) !important;
            }

            .badge.bg-success{ background:var(--teal) !important; }
            .badge.bg-danger{ background:var(--coral) !important; }
            .badge.bg-warning{ background:var(--brass) !important; color:#1D1707 !important; }

            /* ---------- Responsive ---------- */
            @media (max-width: 991.98px){
                #sidebar-wrapper{
                    position:fixed;
                    left:0;
                    top:0;
                    bottom:0;
                    margin-left:-270px;
                }
                #wrapper.toggled #sidebar-wrapper{
                    margin-left:0;
                }
                .container-fluid{ padding:20px 16px 32px !important; }
            }
        </style>
    </head>
    <body>
        <div class="d-flex" id="wrapper">
            <!-- Sidebar-->
            <div class="border-end bg-white" id="sidebar-wrapper">
                <div class="sidebar-heading border-bottom bg-light">
                    <div class="brand-mark">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14.5 8.5a3.5 3.5 0 1 0-3.916 3.478L4 18.56V21h3l3.5-3.5.94.94 2.06-2.06-.94-.94L14.5 12.5A3.5 3.5 0 0 0 14.5 8.5Z" stroke="#1D1707" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                            <circle cx="15.5" cy="7.5" r="1.1" fill="#1D1707"/>
                        </svg>
                    </div>
                    <div class="brand-text">
                        <span class="eyebrow">Wellcome</span>
                        <span class="name">{{ Auth::user()->name }}</span>
                    </div>
                </div>
                <div class="sidebar-nav list-group list-group-flush">
                    <span class="nav-label">Menu</span>
                    <a class="list-group-item list-group-item-action list-group-item-light {{ request()->is('dashboard') ? 'active-nav' : '' }}" href="/dashboard">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 13h6V4H4v9Zm0 7h6v-5H4v5Zm10 0h6V11h-6v9Zm0-16v5h6V4h-6Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg>
                        Dashboard
                    </a>
                    <a class="list-group-item list-group-item-action list-group-item-light {{ request()->is('laporan') ? 'active-nav' : '' }}" href="/laporan">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5 20V10M12 20V4M19 20v-7" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
                        laporan
                    </a>
                    <a class="list-group-item list-group-item-action list-group-item-light {{ request()->is('kamar') ? 'active-nav' : '' }}" href="/kamar">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6 21V4.6c0-.55.42-1 .95-1.08l9-1.4A1 1 0 0 1 17 3.1V21M6 21h11M6 21H4M17 21h2M13 12h.01" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        Kamar
                    </a>
                    <a class="list-group-item list-group-item-action list-group-item-light {{ request()->is('door-access') ? 'active-nav' : '' }}" href="/door-access">
                        <i class="bi bi-qr-code"></i>
                        Door Access
                    </a>
                    <a class="list-group-item list-group-item-action list-group-item-light {{ request()->is('parents') ? 'active-nav' : '' }}" href="/parents">
                        <i class="bi bi-person-standing-dress"></i>
                        Parent
                    </a>
                    <a class="list-group-item list-group-item-action list-group-item-light {{ request()->is('pembayaran') ? 'active-nav' : '' }}" href="/pembayaran">
                        <i class="bi bi-wallet2"></i>
                        Pembayaran
                    </a>
                </div>
                <div class="sidebar-footer">
                    <small>&copy; {{ date('Y') }} &middot; E-Kos</small>
                </div>
            </div>
            <!-- Page content wrapper-->
            <div id="page-content-wrapper">
                <!-- Top navigation-->
                <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                    <div class="container-fluid">
                        <button class="btn btn-primary" id="sidebarToggle">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 6h16M4 12h16M4 18h16" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                        </button>
                        @auth
                        @if (auth()->check() && auth()->user()->email == 'admin@admin.com')
                        <a class="btn btn-qr m-2" href="/dashboard/qr">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="3" y="3" width="7" height="7" rx="1" stroke="currentColor" stroke-width="1.6"/><rect x="14" y="3" width="7" height="7" rx="1" stroke="currentColor" stroke-width="1.6"/><rect x="3" y="14" width="7" height="7" rx="1" stroke="currentColor" stroke-width="1.6"/><path d="M14 14h3v3h-3zM19 14h2v2h-2zM14 19h2v2h-2zM19 19h2v2h-2z" fill="currentColor"/></svg>
                            QR
                        </a>
                        @endif
                        @endauth
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mt-2 mt-lg-0 align-items-lg-center">
                                <li class="nav-item active"><a class="nav-link" href="#!">Home</a></li>
                                <li class="nav-item"><a class="nav-link" href="#!">Link</a></li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="avatar-chip">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="#!">Action</a>
                                        <a class="dropdown-item" href="#!">Another action</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#!">Something else here</a>

                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button type="submit" class="dropdown-item">
                                                    Logout
                                                </button>
                                            </form>

                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <!-- Page content-->
                <div class="container-fluid">
                    @yield('konten')
        </div>
        @yield('script')
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{ asset('assets/js/scripts.js') }}"></script>
    </body>
</html>