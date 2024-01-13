
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        
        <title>SM Admin | {{auth()->user()->firstName}}</title>
        
        <!-- Custom fonts for this template-->
        <link
        href="/vendor/fontawesome-free/css/all.min.css"
        rel="stylesheet"
        type="text/css">
        <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
        
        <!-- Custom styles for this template-->
        <link href="/assets/css/sb-admin-2.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
        <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
        <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="/assets/vendor/ckeditor5/build/ckeditor.js"></script>
    </head>

    <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <ul
                class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion"
                id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <a
                    class="sidebar-brand d-flex align-items-center justify-content-center"
                    href="/dashboard">
                    <div class="sidebar-brand-icon rotate-n-15"></div>
                    <i class="fas fa-hand-sparkles"></i>
                    <div class="sidebar-brand-text mx-3">Welcome Back!</div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item {{ ($title === 'Dashboard') ? 'active' : ''}}">
                    <a class="nav-link" href="/dashboard">
                        <i class="fas fa-store-alt"></i>
                        <span>Dashboard</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Interface
                </div>

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item {{ ($title === 'Event') ? 'active' : ''}}">
                    <a class="nav-link collapsed" href="/dashboard/view-event">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Events</span>
                    </a>
                </li>

                <!-- Nav Item - Utilities Collapse Menu -->
                <li class="nav-item {{ ($title === 'Manage Event') ? 'active' : ''}}">
                    <a class="nav-link collapsed" href="/dashboard/manage-event">
                        <i class="fas fa-fw fa-wrench"></i>
                        <span>Manage Events</span>
                    </a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Addons
                </div>

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item {{ ($title === 'Manage Payment') ? 'active' : ''}}">
                    <a class="nav-link collapsed" href="/dashboard/manage-payment">
                        <i class="fas fa-dollar-sign"></i>
                        <span>Payment</span>
                    </a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>

                <!-- Sidebar Message -->

            </ul>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">
                <nav
                    class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button
                        id="sidebarToggleTop"
                        class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    @if($title === 'Manage Event')
                    <div>
                        <a href="/dashboard/manage-event/addEvent" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Add Event</a>
                    </div>
                    @endif
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                    

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">{{auth()->user()->firstName}} {{auth()->user()->lastName}}</button>
                            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="visually-hidden"><i class="fas fa-sort-down"></i></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="/" style="text-decoration: none;"><button class="dropdown-item" onclick="return confirm('Confirm Back Home?')"><i class="fas fa-home" style="margin-right: 10px"></i>Home</button></a></li>
                                <form action="/logout" method="post">
                                    @csrf
                                    <li><button class="dropdown-item" onclick="return confirm('Confirm Log Out?')"> <i class="fas fa-sign-out-alt" style="margin-right: 10px"></i>Log Out</button></li>
                                </form>
                            </ul>
                        </div>

                    </ul>

                </nav>
                @yield('main') @yield('view-event') @yield('manage-event') @yield('edit-event') @yield('manage-payment')
                <!-- Main Content -->
            </div>
        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Simposium Manado 2023</span>
                </div>
            </div>

            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Bootstrap core JavaScript-->
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="/assets/js/demo/chart-area-demo.js"></script>
    <script src="/assets/js/demo/chart-pie-demo.js"></script>
    
</body>

</html>