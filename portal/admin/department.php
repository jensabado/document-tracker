<?php
require_once('../../backend/config/database.php');
require_once('../../backend/config/connection.php');
$page_title = 'Department';
ob_start();

?>

<div class="modal fade" tabindex="-1" role="dialog" id="add_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Department</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="add_department_form">
                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="">Department</label>
                            <input type="text" name="add_department_name" id="add_department_name" class="form-control"
                                placeholder="Enter Department" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="">Code</label>
                            <input type="text" name="add_code" id="add_code" class="form-control"
                                placeholder="Enter Code" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="">Username</label>
                            <input type="text" name="add_username" id="add_username" class="form-control"
                                placeholder="Enter Username" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" name="add_password" id="add_password"
                                    placeholder="Enter Password" required>
                                <span class="input-group-text" id="togglePassword">
                                    <i class="fa-solid fa-eye"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="add_department_form"
                    id="add_document_btn">Add</button>
                <a href="#" class="btn disabled btn-primary btn-progress d-none spinner">Progress</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="edit_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="edit_department_form">
                    <div class="row mb-3 d-none">
                        <div class="col-12">
                            <label for="">Department ID</label>
                            <input type="text" name="edit_department_id" id="edit_department_id" class="form-control"
                                placeholder="Enter Department ID" readonly required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="">Department</label>
                            <input type="text" name="edit_department_name" id="edit_department_name"
                                class="form-control" placeholder="Enter Department" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="">Code</label>
                            <input type="text" name="edit_code" id="edit_code" class="form-control"
                                placeholder="Enter Code" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="">Username</label>
                            <input type="text" name="edit_username" id="edit_username" class="form-control"
                                placeholder="Enter Username" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" name="edit_password" id="edit_password"
                                    placeholder="Enter Password">
                                <span class="input-group-text" id="togglePasswordEdit">
                                    <i class="fa-solid fa-eye"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="edit_department_form" id="edit_room_btn">Save
                    changes</button>
                <a href="#" class="btn disabled btn-primary btn-progress d-none spinner">Progress</a>
            </div>
        </div>
    </div>
</div>

<section class="section">
    <div class="section-header" style="position: fixed; top: 80px; width: 100%; z-index: 200;">
        <h1>Department</h1>
    </div>

    <div class="section-body" style="margin-top: 90px;">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-primary" id="add_btn"><i class="fa-solid fa-plus pr-1"></i> ADD
                    DEPARTMENT</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Code</th>
                                <th scope="col">Department</th>
                                <th scope="col">Username</th>
                                <th scope="col">Date Created</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                    </table>
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
$(document).ready(function() {
    function togglePasswordInput(passwordInput, toggleButton) {
        if (passwordInput.attr("type") === "password") {
            passwordInput.attr("type", "text");
            toggleButton.html('<i class="fa-solid fa-eye-slash"></i>'); // Change icon to hide
        } else {
            passwordInput.attr("type", "password");
            toggleButton.html('<i class="fa-solid fa-eye"></i>'); // Change icon to show
        }
    }

    // Cache the password input and the toggle button
    var passwordInput = $("#add_password");
    var passwordInputEdit = $("#edit_password");
    var toggleButton = $("#togglePassword");
    var toggleButtonEdit = $("#togglePasswordEdit");

    // Add a click event listener to the toggle buttons
    toggleButton.click(function() {
        togglePasswordInput(passwordInput, toggleButton);
    });

    toggleButtonEdit.click(function() {
        togglePasswordInput(passwordInputEdit, toggleButtonEdit);
    });


    // initializing datatables
    var dataTable = $('#table').DataTable({
        "serverSide": true,
        "paging": true,
        "searching": true,
        "pagingType": "simple_numbers",
        "scrollX": true,
        "sScrollXInner": "100%",
        "ajax": {
            url: "../../backend/datatables/admin/department",
            type: "POST",
            error: function(xhr, error, code) {
                console.log(xhr, code);
            }
        },
        "order": [
            [4, 'desc']
        ],
        "lengthMenu": [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "All"]
        ]
    });

    $($.fn.dataTable.tables(true)).DataTable().columns.adjust();

    setInterval(function() {
        dataTable.ajax.reload(null, false);
    }, 10000); // END DATATABLES

    $(document).on('click', '#add_btn', function(e) {
        e.preventDefault();

        $('#add_modal').modal('show');
    })

    // submit add_modal
    $(document).on('submit', '#add_department_form', function(e) {
        e.preventDefault();

        let form = new FormData(this);
        form.append('add_department', true);

        $.ajax({
            type: "POST",
            url: "../../backend/class/Department.php",
            data: form,
            processData: false,
            contentType: false,
            cache: false,
            success: function(response) {
                console.log(response);
                let data = JSON.parse(response);
                if (data.status == 'success') {
                    $('#add_modal').modal('hide');
                    dataTable.ajax.reload(null, false);
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: data.message,
                        iconColor: '#5D87FF',
                        confirmButtonColor: '#5D87FF',
                        showConfirmButton: false,
                        timer: 5000,
                        timerProgressBar: true,
                        color: '#000',
                        background: '#fff',
                    })
                } else if (data.status == 'failed') {
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

    $(document).on('click', '#get_edit', function(e) {
        e.preventDefault();

        let department_id = $(this).data('id');
        let form = new FormData();
        form.append('get_department_info', true);
        form.append('department_id', department_id);

        $.ajax({
            type: "POST",
            url: "../../backend/class/Department.php",
            data: form,
            processData: false,
            contentType: false,
            cache: false,
            success: function(response) {
                console.log(response);
                let data = JSON.parse(response);
                if (data.status == 'success') {
                    $('#show_modal').modal('hide');
                    $('#edit_modal').modal('show');
                    $('#edit_department_id').val(data.id);
                    $('#edit_department_name').val(data.department);
                    $('#edit_code').val(data.code);
                    $('#edit_username').val(data.username);
                } else if (data.status == 'failed') {
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

    $(document).on('submit', '#edit_department_form', function(e) {
        e.preventDefault();

        let form = new FormData(this);
        form.append('edit_department', true);

        $.ajax({
            type: "POST",
            url: "../../backend/class/Department.php",
            data: form,
            processData: false,
            contentType: false,
            cache: false,
            success: function(response) {
                console.log(response);
                let data = JSON.parse(response);
                if (data.status == 'success') {
                    $('#edit_modal').modal('hide');
                    dataTable.ajax.reload(null, false);
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
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

    $(document).on('click', '#get_delete', function(e) {
        e.preventDefault();

        let id = $(this).data('id');

        Swal.fire({
            icon: 'question',
            title: 'Hey!',
            text: 'Are you sure you want to delete this data?',
            iconColor: '#5D87FF',
            confirmButtonColor: '#5D87FF',
            showConfirmButton: true,
            showCancelButton: true,
            confirmButtonText: `Yes`,
            color: '#000',
            background: '#fff',
        }).then((result) => {
            if (result.isConfirmed) {
                let form = new FormData();
                form.append('id', id);
                form.append('delete_department', true);

                $.ajax({
                    type: "POST",
                    url: "../../backend/class/Department.php",
                    data: form,
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function(response) {
                        console.log(response);
                        let data = JSON.parse(response);
                        if (data.status == 'success') {
                            dataTable.ajax.reload(null, false);
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: data.message,
                                iconColor: '#5D87FF',
                                confirmButtonColor: '#5D87FF',
                                showConfirmButton: false,
                                timer: 5000,
                                timerProgressBar: true,
                                color: '#000',
                                background: '#fff',
                            })
                        } else if (data.status == 'failed') {
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
            }
        })
    })

    // hide modal reset 
    $('#add_modal').on('hidden.bs.modal', function() {
        $(this).find('form').trigger('reset');
    });

    $('#edit_modal').on('hidden.bs.modal', function() {
        $(this).find('form').trigger('reset');
    });
})
</script>
<?php
$script = ob_get_clean();
include('./layout/base.php');
?>