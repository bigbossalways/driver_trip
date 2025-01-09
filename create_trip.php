<?php
include 'classes/Trip.class.php';
include 'views/layout/header.php';
// check if user is valid and logged in
if (empty($_SESSION['user_id'])) {
    header('location:login.php');
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data['license_plate_no'] = trim($_POST['inputLicense']);
    $data['departure'] = trim($_POST['inputDeparture']);
    $data['arrival'] = trim($_POST['inputArrival']);
    $data['init_km'] = trim($_POST['inputinitkm']);
    $data['end_km'] = trim($_POST['inputendkm']);
    $data['driver_id'] = $_SESSION['user_id'];

    $tripObj = new TripClass();
    $trip = $tripObj->createTrip($data);

    if (!$trip) {
        $error = "Cannot insert recrod ";
    } else {
        $error = "Record inserted Successfully ";
        header('Location:' . BASE_URL . '/dashboard.php');
        exit();
    }
}
?>
<style>
    .dateandtime {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        background-color: #fff;
        border-color: #6b7280;
        border-width: 1px;
        border-radius: 0;
        padding-top: 0.5rem;
        padding-right: 0.75rem;
        padding-bottom: 0.5rem;
        padding-left: 0.75rem;
        font-size: 1rem;
        line-height: 1.5rem;
    }
</style>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.html">Start Bootstrap</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <!-- <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form> -->
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="/logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <?php include 'views/layout/nav.php'; ?>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    <?php echo $_SESSION['user_name'] ?>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Tables</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Trips</li>
                    </ol>
                    <div class="card mb-4">

                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Trips Table
                        </div>
                        <div class="card-body">
                            <?php include "views/create_trip_form.php"; ?>
                        </div>
                    </div>
                </div>
            </main>
            <?php include 'views/layout/footer.php'; ?>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="<?php echo BASE_URL ?>/js/jquery.dateandtime.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
    <script>
        function DelTrip(id) {
            if (confirm('Are you sure ?')) {
                alert('yes');
            }

        }
        $('.dateandtime').dateAndTime();
    </script>
</body>

</html>