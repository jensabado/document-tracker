<?php
require_once('../../backend/config/database.php');
require_once('../../backend/config/connection.php');
$page_title = 'Documents';
ob_start();

?>
<div class="modal fade" tabindex="-1" role="dialog" id="show_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Show Document</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="add_document_form">
                    <div class="row">
                        <div class="col-12">
                            <label for="" class="font-weight-bold">Reference:</label>
                            <p id="show_reference">r86868we</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="" class="font-weight-bold">Document Title:</label>
                            <p id="show_document">Lorem, ipsum.</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="" class="font-weight-bold">Document Details:</label>
                            <p id="show_details">Lorem ipsum dolor sit amet.</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="" class="font-weight-bold">Document Type:</label>
                            <p id="show_type">Lorem, ipsum dolor.</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="" class="font-weight-bold">Status:</label>
                            <p id="show_status">Lorem.</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="" class="font-weight-bold">Date:</label>
                            <p id="show_date">2023-09-12 07:23:00</p>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-whitesmoke br" id="show_modal_footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a href="#" class="btn disabled btn-primary btn-progress d-none spinner">Progress</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="add_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Document</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="add_document_form">
                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="">Document</label>
                            <input class="form-control" type="text" name="add_document_name" id="add_document_name"
                                placeholder="Enter Document" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="">Details</label>
                            <textarea class="form-control" name="add_details" id="add_details" rows="20"
                                style="height: 120px !important; resize: none;" required></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="">Type</label>
                            <select style="width: 100% !important;" class="form-control" name="add_type" id="add_type"
                                required>
                                <option disabled value="" selected>SELECT</option>';
                                <?php
                                $stmt = $pdo->prepare("SELECT category FROM category");
                                $stmt->execute();
                                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            
                                if (count($result) > 0) {
                                    foreach ($result as $row) {
                                        echo '<option value="' . $row['category'] . '">' . $row['category'] . '</option>';
                                    }
                                } else {
                                    echo '<option value="">NO RESULT</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="add_document_form"
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
                <h5 class="modal-title">Edit Document</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="edit_document_form">
                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="">Reference</label>
                            <input type="text" name="edit_reference" id="edit_reference" class="form-control"
                                placeholder="Reference" readonly inputmode="number">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="">Document</label>
                            <input class="form-control" type="text" name="edit_document_name" id="edit_document_name"
                                placeholder="Enter Document" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="">Details</label>
                            <textarea class="form-control" name="edit_details" id="edit_details" rows="20"
                                style="height: 120px !important; resize: none;" required></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="">Type</label>
                            <select style="width: 100% !important;" class="form-control" name="edit_type" id="edit_type"
                                required>
                                <option disabled value="" selected>SELECT</option>';
                                <?php
                                $stmt = $pdo->prepare("SELECT category FROM category");
                                $stmt->execute();
                                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            
                                if (count($result) > 0) {
                                    foreach ($result as $row) {
                                        echo '<option value="' . $row['category'] . '">' . $row['category'] . '</option>';
                                    }
                                } else {
                                    echo '<option value="">NO RESULT</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="edit_document_form" id="edit_room_btn">Save
                    changes</button>
                <a href="#" class="btn disabled btn-primary btn-progress d-none spinner">Progress</a>
            </div>
        </div>
    </div>
</div>

<section class="section">
    <div class="section-header" style="position: fixed; top: 80px; width: 100%; z-index: 200;">
        <h1>Documents</h1>
    </div>

    <div class="section-body" style="margin-top: 90px;">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-primary" id="add_building"><i class="fa-solid fa-plus pr-1"></i> ADD
                    DOCUMENT</button>
            </div>
            <div class="card-body">
                <div class="row align-items-center justify-content-center mb-3">
                    <div class="col-sm-3 mb-3 mb-md-0">
                        <select class="form-control" name="filter_status" id="filter_status">
                            <option selected value="">SELECT STATUS</option>
                            <?php
                            $stmt = $pdo->prepare("SELECT status FROM documents WHERE is_deleted = 0 GROUP BY status");
                            $stmt->execute();
                            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        
                            if (count($result) > 0) {
                                foreach ($result as $row) {
                                    echo '<option value="' . $row['status'] . '">' . strtoupper($row['status']) . '</option>';
                                }
                            } else {
                                echo '<option value="">NO RESULT</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <button type="button" class="btn btn-warning" id="reset_filter">RESET FILTER</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table" id="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Department</th>
                                <th scope="col">Reference No.</th>
                                <th scope="col">Document Name</th>
                                <th scope="col">Details</th>
                                <th scope="col">Type</th>
                                <th scope="col">Status</th>
                                <th scope="col">Date</th>
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
            url: "../../backend/datatables/department/documents",
            type: "POST",
            data: function(d) {
                return $.extend({}, d, {
                    "filter_status": $('#filter_status').val()
                })
            },
            error: function(xhr, error, code) {
                console.log(xhr, code);
            }
        },
        "order": [
            [7, 'desc']
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

    dataTable.draw();

    // select 2
    $('#filter_status').select2();
    $('#add_code').select2({
        dropdownParent: $('#add_modal')
    });
    $('#add_type').select2({
        dropdownParent: $('#add_modal')
    });
    $('#edit_building_id').select2({
        dropdownParent: $('#edit_modal')
    });

    $('#filter_status').bind("keyup change", function() {
        dataTable.draw();
    })

    // reset filter
    $('#reset_filter').on('click', function(e) {
        e.preventDefault();

        $('#filter_status').val('').trigger("change");
    })

    // modal function
    $(document).on('click', '#add_building', function(e) {
        e.preventDefault();

        $('#add_modal').modal('show');
    })

    // show modal
    $(document).on('click', '#get_view', function(e) {
        e.preventDefault();

        let document_id = $(this).data('id');
        let form = new FormData();
        form.append('get_document_info_show', true);
        form.append('document_id', document_id);

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
                    $('#show_modal').modal('show');
                    $('#show_reference').text(data.reference);
                    $('#show_document').text(data.document);
                    $('#show_details').text(data.details);
                    $('#show_type').text(data.type);
                    $('#show_status').html(data.document_status == 'ONGOING' ?
                        '<span class="bg-warning text-white px-2 py-1">ONGOING</span>' :
                        '<span class="bg-primary text-white px-2 py-1">DONE</span>');
                    $('#show_date').text(data.date);

                    if (data.document_status == 'ONGOING') {
                        $('#show_modal_footer').append(
                            '<button type="button" class="btn btn-success" id="get_done" data-id="' +
                            data.id +
                            '"><i class="fa-solid fa-check mr-1"></i>Done</button>');
                        $('#show_modal_footer').append(
                            '<button type="button" class="btn btn-warning" id="get_edit" data-id="' +
                            data.id +
                            '"><i class="fa-regular fa-pen-to-square mr-1"></i>Edit</button>'
                        );

                        $('#show_modal_footer').append(
                            '<button type="button" class="btn btn-primary" id="get_print" data-id="' +
                            data.reference +
                            '"><i class="fa-solid fa-print mr-1"></i>Print QR</button>'
                        );

                        $('#show_modal_footer').append(
                            '<button type="button" class="btn btn-info" id="get_track" data-id="' +
                            data.reference +
                            '"><i class="fa-solid fa-magnifying-glass-location mr-1"></i>Track</button>'
                        );
                    } else {
                        $('#show_modal_footer').append(
                            '<button type="button" class="btn btn-danger" id="get_hide" data-id="' +
                            data.id +
                            '"><i class="fa-regular fa-eye-slash mr-1"></i></i>Hide</button>'
                        );

                        $('#show_modal_footer').append(
                            '<button type="button" class="btn btn-info" id="get_details" data-id="' +
                            data.id +
                            '"><i class="fa-solid fa-circle-info mr-1"></i>Details</button>'
                        );
                    }
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

    // - submit add modal
    $(document).on('submit', '#add_document_form', function(e) {
        e.preventDefault();

        let form = new FormData(this);
        form.append('add_document', true);
        form.append('dept', true);

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
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Sorry!',
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

    // Change status to "DONE" function
    $(document).on('click', '#get_done', function(e) {
        e.preventDefault();

        let id = $(this).data('id');

        Swal.fire({
            icon: 'question',
            title: 'Hey!',
            text: 'Are you sure you want to change status of this data to done?',
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
                form.append('change_status', true);

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
                            $('#show_modal').modal('hide');
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
                            dataTable.ajax.reload(null, false);
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

    // - get data edit modal
    $(document).on('click', '#get_edit', function(e) {
        e.preventDefault();

        let document_id = $(this).data('id');
        let form = new FormData();
        form.append('get_document_info', true);
        form.append('document_id', document_id);

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
                    $('#show_modal').modal('hide');
                    $('#edit_modal').modal('show');
                    $('#edit_reference').val(data.reference);
                    $('#edit_document_name').val(data.document);
                    $('#edit_details').val(data.details);
                    $('#edit_type').val(data.type).trigger('change');
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

    $(document).on('submit', '#edit_document_form', function(e) {
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

    // print qr
    $(document).on('click', '#get_print', function(e) {
        e.preventDefault();

        let reference = $(this).data('id');

        window.open('./document-details?reference=' + reference, '_blank');
        // console.log('./document-details?reference=' + reference);
    })

    // get track
    $(document).on('click', '#get_track', function(e) {
        e.preventDefault();

        let reference = $(this).data('id');

        window.open('./document-track?reference=' + reference, '_blank');
        // console.log('./document-details?reference=' + reference);
    })

    // delete info
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
                form.append('delete_room', true);

                $.ajax({
                    type: "POST",
                    url: "./controller/function_class",
                    data: form,
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function(response) {
                        console.log(response);
                        if (response.includes('success')) {
                            dataTable.ajax.reload(null, false);
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: 'Data deleted successfully!',
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
                                title: 'Sorry!',
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

    $('#show_modal').on('hidden.bs.modal', function() {
        // Remove all modal footer buttons except the close button
        $('#show_modal_footer button:not([data-dismiss="modal"])').remove();
    });

})
</script>
<?php
$script = ob_get_clean();
include('./layout/base.php');
?>