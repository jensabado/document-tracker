<?php
require_once('../../backend/config/database.php');
require_once('../../backend/config/connection.php');
$page_title = 'Documents';
ob_start();

?>

<div class="modal fade" tabindex="-1" role="dialog" id="add_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="add_category_form">
                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="">Category</label>
                            <input type="text" name="add_category_name" id="add_category_name" class="form-control"
                                placeholder="Enter Category">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="">Details</label>
                            <textarea class="form-control" name="add_details" id="add_details" rows="20"
                                style="height: 120px !important; resize: none;" placeholder="Enter Details"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="">Max Time</label>
                            <input type="text" name="add_max_time" id="add_max_time" class="form-control"
                                inputmode="numeric" placeholder="Enter Max Time">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="add_category_form"
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
                <form action="" id="edit_category_form">
                    <div class="row mb-3 d-none">
                        <div class="col-12">
                            <label for="">Category ID</label>
                            <input type="text" name="edit_category_id" id="edit_category_id" class="form-control"
                                placeholder="Enter Category">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="">Category</label>
                            <input type="text" name="edit_category_name" id="edit_category_name" class="form-control"
                                placeholder="Enter Category">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="">Details</label>
                            <textarea class="form-control" name="edit_details" id="edit_details" rows="20"
                                style="height: 120px !important; resize: none;" placeholder="Enter Details"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="">Max Time</label>
                            <input type="text" name="edit_max_time" id="edit_max_time" class="form-control"
                                inputmode="numeric" placeholder="Enter Max Time">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="edit_category_form" id="edit_room_btn">Save
                    changes</button>
                <a href="#" class="btn disabled btn-primary btn-progress d-none spinner">Progress</a>
            </div>
        </div>
    </div>
</div>

<section class="section">
    <div class="section-header" style="position: fixed; top: 80px; width: 100%; z-index: 200;">
        <h1>Category</h1>
    </div>

    <div class="section-body" style="margin-top: 90px;">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-primary" id="add_btn"><i class="fa-solid fa-plus pr-1"></i> ADD
                    CATEGORY</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Category</th>
                                <th scope="col">Details</th>
                                <th scope="col">Max Time</th>
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
    // initializing datatables
    var dataTable = $('#table').DataTable({
        "serverSide": true,
        "paging": true,
        "searching": true,
        "pagingType": "simple_numbers",
        "scrollX": true,
        "sScrollXInner": "100%",
        "ajax": {
            url: "../../backend/datatables/admin/category",
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

    const inputElement = document.getElementById('add_max_time');
    const inputElementEdit = document.getElementById('edit_max_time');

    inputElement.addEventListener('input', function() {
        // Get the input value
        let inputValue = this.value;

        // Remove leading zeros
        inputValue = inputValue.replace(/^0+/g, '');

        // Ensure the input is a number (optional)
        if (/^\d+$/.test(inputValue)) {
            this.value = inputValue; // Update the input value
        } else {
            this.value = ''; // Clear the input if it's not a valid number
        }
    });

    inputElementEdit.addEventListener('input', function() {
        // Get the input value
        let inputValue = this.value;

        // Remove leading zeros
        inputValue = inputValue.replace(/^0+/g, '');

        // Ensure the input is a number (optional)
        if (/^\d+$/.test(inputValue)) {
            this.value = inputValue; // Update the input value
        } else {
            this.value = ''; // Clear the input if it's not a valid number
        }
    });

    $(document).on('click', '#add_btn', function(e) {
        e.preventDefault();

        $('#add_modal').modal('show');
    })

    // submit add_modal
    $(document).on('submit', '#add_category_form', function(e) {
        e.preventDefault();

        let form = new FormData(this);
        form.append('add_category', true);

        $.ajax({
            type: "POST",
            url: "../../backend/class/Category.php",
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

        let document_id = $(this).data('id');
        let form = new FormData();
        form.append('get_category_info', true);
        form.append('category_id', document_id);

        $.ajax({
            type: "POST",
            url: "../../backend/class/Category.php",
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
                    $('#edit_category_id').val(data.id);
                    $('#edit_category_name').val(data.category);
                    $('#edit_details').val(data.details);
                    $('#edit_max_time').val(data.max_time);
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

    $(document).on('submit', '#edit_category_form', function(e) {
        e.preventDefault();

        let form = new FormData(this);
        form.append('edit_category', true);

        $.ajax({
            type: "POST",
            url: "../../backend/class/Category.php",
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

    $(document).on('submit', '#edit_category_form', function(e) {
        e.preventDefault();

        let form = new FormData(this);
        form.append('edit_document', true);

        $.ajax({
            type: "POST",
            url: "../../backend/class/Document.php",
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
                form.append('delete_category', true);

                $.ajax({
                    type: "POST",
                    url: "../../backend/class/Category.php",
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