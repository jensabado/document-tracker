<?php
require_once('../../backend/config/database.php');
require_once('../../backend/config/connection.php');
$page_title = 'Account Settings';
ob_start();
?>
<section class="section">
    <div class="section-header" style="position: fixed; top: 80px; width: 100%; z-index: 200;">
        <h1>Account Settings</h1>
    </div>

    <div class="section-body" style="margin-top: 90px;">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4 col-md-5">
                        <form action="" id="update_acc_form">
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label for="">Username</label>
                                    <input type="text" name="username" id="username" class="form-control"
                                        placeholder="Enter Username" value="<?= $_SESSION['dt_admin_username'] ?>"
                                        required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label for="">Current Password</label>
                                    <div class="input-group">
                                        <input type="password" name="current_password" id="current_password"
                                            class="form-control password-toggle" placeholder="Enter Current Password"
                                            data-toggle-target="#togglePassword" required>
                                        <span class="input-group-text toggle-button" id="togglePassword"
                                            data-toggle-target="#current_password">
                                            <i class="fa-solid fa-eye"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label for="">New Password</label>
                                    <div class="input-group">
                                        <input type="password" name="new_password" id="new_password"
                                            class="form-control password-toggle" placeholder="Enter New Password"
                                            data-toggle-target="#togglePasswordNew">
                                        <span class="input-group-text toggle-button" id="togglePasswordNew"
                                            data-toggle-target="#new_password">
                                            <i class="fa-solid fa-eye"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label for="">Confirm Password</label>
                                    <div class="input-group">
                                        <input type="password" name="confirm_password" id="confirm_password"
                                            class="form-control password-toggle" placeholder="Enter Confirm Password"
                                            data-toggle-target="#togglePasswordConfirm">
                                        <span class="input-group-text toggle-button" id="togglePasswordConfirm"
                                            data-toggle-target="#confirm_password">
                                            <i class="fa-solid fa-eye"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Update Account</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
$content = ob_get_clean();
ob_start();
?>
<script>
$(window).on('load', function() {
    if (localStorage.getItem('status') == 'success') {
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: localStorage.getItem('message'),
            iconColor: '#5D87FF',
            confirmButtonColor: '#5D87FF',
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true,
            color: '#000',
            background: '#fff',
        })

        localStorage.removeItem('status');
        localStorage.removeItem('message');
    }
})

$(document).ready(function() {
    $('.toggle-button').click(function() {
        var targetId = $(this).data('toggle-target');
        var passwordInput = $(targetId);
        togglePasswordInput(passwordInput, $(this));
    });

    function togglePasswordInput(passwordInput, toggleButton) {
        if (passwordInput.attr("type") === "password") {
            passwordInput.attr("type", "text");
            toggleButton.html('<i class="fa-solid fa-eye-slash"></i>'); // Change icon to hide
        } else {
            passwordInput.attr("type", "password");
            toggleButton.html('<i class="fa-solid fa-eye"></i>'); // Change icon to show
        }
    }

    $('#update_acc_form').on('submit', function(e) {
        e.preventDefault();

        let form = new FormData(this);
        form.append('update_account', true);

        $.ajax({
            type: "POST",
            url: "../../backend/class/Authentication.php",
            data: form,
            processData: false,
            contentType: false,
            cache: false,
            success: function(response) {
                console.log(response);
                let data = JSON.parse(response);
                if (data.status == 'success') {
                    localStorage.setItem('status', 'success');
                    localStorage.setItem('message', data.message);
                    window.location.reload();
                } else if(data.status == 'failed') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed!',
                        text: data.message,
                        iconColor: '#5D87FF',
                        confirmButtonColor: '#5D87FF',
                        showConfirmButton: false,
                        timer: 5000,
                        timerProgressBar: true,
                        color: '#000',
                        background: '#fff',
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed!',
                        text: 'Something went wrong!',
                        iconColor: '#5D87FF',
                        confirmButtonColor: '#5D87FF',
                        showConfirmButton: false,
                        timer: 5000,
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
<?php
$script = ob_get_clean();
include('./layout/base.php');
?>