<?php
include 'classes/Driver.class.php';
include 'views/layout/header.php';
if (isset($_SESSION['user_id'])) {
    header('location:dashboard.php');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['inputUsername']);
    $password = md5(trim($_POST['inputPassword']));

    $userObj = new driverClass();
    $user = $userObj->findByUsername($username);

    if (!$user) {
        $error = "User not found";
    } else {
        if ($password == $user['password']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_name'] = $user['name'];
            header('Location:dashboard.php');
            exit();
        } else {
            $error = "Invalid Username or password.";
        }
    }
}
?>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Login</h3>
                                </div>
                                <div class="card-body">
                                    <?php include 'views/loginForm.php'; ?>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="register.html">Need an account? Sign up!</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2023</div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>

</html>