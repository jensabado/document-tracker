<?php
session_start();

if(isset($_SESSION['dt_admin_id']) && isset($_SESSION['dt_dept_id'])) {
    if(isset($_SESSION['dt_admin_id'])) {
        echo '<script>
        window.location.href = "./portal/admin/dashboard";
        </script>';
    } else if(isset($_SESSION['dt_dept_id'])) {
        echo '<script>
        window.location.href = "./portal/department/dashboard";
        </script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title> Login </title>

    <!-- Favicons -->
    <link href="./assets/img/logos/favicon.png" rel="icon">
    <link href="./assets/img/logos/favicon.png" rel="apple-touch-icon">

    <!-- Google Font -->
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- General CSS Files -->
    <link rel="stylesheet" href="./assets/modules/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Template CSS -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/components.css">
    <link rel="stylesheet" href="./assets/css/admin-login.css">
</head>

<body>
    <div class="container">
        <div class="row align-items-center justify-content-center" style="min-height: 100vh;">
            <div class="col-md-5">
                <div class="card p-4 pb-5 shadow-md">
                    <form action="" id="login">
                        <div class="row g-3">
                            <div class="col-12 text-center">
                                <img src="./assets/img/logos/favicon.png" alt="" style="width: 80px;">
                            </div>
                            <div class="col-12 mb-3">
                                <label>Username</label>
                                <input type="text" class="form-control" name="username" id="username"
                                    value="<?php if(isset($_COOKIE['dt_username'])) { echo $_COOKIE['dt_username']; } ?>"
                                    placeholder="Enter Username" required>
                            </div>
                            <div class="col-12 mb-2">
                                <label>Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="password" id="password"
                                        value="<?php if(isset($_COOKIE['dt_password'])) { echo $_COOKIE['dt_password']; } ?>"
                                        placeholder="Enter Password" required>
                                    <span class="input-group-text" id="togglePassword">
                                        <i class="fa-solid fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" name="rem" id="rem"
                                        <?php if (isset($_COOKIE["dt_username"]) && isset ($_COOKIE["dt_password"])) { echo "checked"; } ?>>
                                    <span class="pl-1">Remember me</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary text-uppercase w-100" type="submit">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="./assets/modules/jquery.min.js"></script>
    <script src="./assets/modules/popper.js"></script>
    <script src="./assets/modules/tooltip.js"></script>
    <script src="./assets/modules/bootstrap/js/bootstrap.min.js"></script>

    <script src="./assets/modules/nicescroll/jquery.nicescroll.min.js"></script>

    <!-- JS Libraies -->
    <script src="./assets/modules/datatables/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- Page Specific JS File -->
    <script src="./assets/js/page/index.js"></script>

    <!-- Template JS File -->
    <script src="./assets/js/scripts.js"></script>
    <script src="./assets/js/custom.js"></script>

    <script>
    $(document).ready(function() {
        // Cache the password input and the toggle button
        var passwordInput = $("#password");
        var toggleButton = $("#togglePassword");

        // Add a click event listener to the toggle button
        toggleButton.click(function() {
            // Toggle the password input's type attribute between "text" and "password"
            if (passwordInput.attr("type") === "password") {
                passwordInput.attr("type", "text");
                toggleButton.html('<i class="fa-solid fa-eye-slash"></i>'); // Change icon to hide
            } else {
                passwordInput.attr("type", "password");
                toggleButton.html('<i class="fa-solid fa-eye"></i>'); // Change icon to show
            }
        });

        $('#login').on('submit', function(e) {
            e.preventDefault();

            let is_admin = <?php echo isset($_GET['admin']) ? 'true' : 'false'; ?>;

            let form = new FormData(this);
            form.append('is_admin', is_admin);
            form.append('login', true);

            $.ajax({
                type: "POST",
                url: "./backend/class/Authentication",
                data: form,
                processData: false,
                contentType: false,
                cache: false,
                success: function(response) {
                    console.log(response);
                    let data = JSON.parse(response);
                    if (data.status == 'success') {
                        if (data.type == 'admin') {
                            location.href = './portal/admin/dashboard';
                        } else {
                            location.href = './portal/department/dashboard';
                        }
                    } else if (data.status == 'failed') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Failed!',
                            text: data.message,
                            iconColor: '#5D87FF',
                            confirmButtonColor: '#5D87FF',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            color: '#000',
                            background: '#fff',
                        })
                    }
                }
            })
        })
    })
    </script>
</body>

</html>