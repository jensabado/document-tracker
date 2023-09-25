<?php
$page_title = 'Documents';
ob_start();

?>
<div class="modal fade" tabindex="-1" role="dialog" id="add_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Room</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="add_room_form">
                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="">Select Building</label>
                            <select style="width: 100% !important;" class="form-control" name="add_building_id"
                                id="add_building_id">
                                <option disabled value="" selected>SELECT</option>';
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="">Room Name</label>
                            <input class="form-control" type="text" name="add_room_name" id="add_room_name"
                                placeholder="Enter building name" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="add_room_form" id="add_room_btn">Add</button>
                <a href="#" class="btn disabled btn-primary btn-progress d-none spinner">Progress</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="edit_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Room</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="edit_room_form">
                    <div class="row mb-3 d-none">
                        <div class="col-12">
                            <label for="">Room ID</label>
                            <input class="form-control" type="text" name="edit_room_id" id="edit_room_id"
                                placeholder="Enter room id" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="">Building Name</label>
                            <select style="width: 100% !important;" class="form-control" name="edit_building_id"
                                id="edit_building_id" required>
                                <option disabled value="" selected>SELECT</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="">Room Name</label>
                            <input class="form-control" type="text" name="edit_room_name" id="edit_room_name"
                                placeholder="Enter room name" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="edit_room_form" id="edit_room_btn">Save
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
                        <select class="form-control" name="filter_building" id="filter_building">
                            <option selected value="">SELECT STATUS</option>
                            <option value="Ongoing">ONGOING</option>
                            <option value="Done">DONE</option>
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
        "pagingType": "simple",
        "scrollX": true,
        "sScrollXInner": "100%",
        "ajax": {
            url: "../../backend/datatables/admin/documents",
            type: "POST",
            data: function(d) {
                return $.extend({}, d, {
                    "filter_building": $('#filter_building').val()
                })
            },
            error: function(xhr, error, code) {
                console.log(xhr, code);
            }
        },
        "order": [
            [0, 'desc']
        ],
        "lengthMenu": [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "All"]
        ]
    });

    // Initialize a flag to check if the dropdown is open
    var dropdownOpen = false;

    // Initialize a timestamp for the last dropdown click
    var lastDropdownClick = 0;

    var id = 0;

    // Handle dropdown click to set the flag and update the timestamp
    $('#table').on('click', '.my-dropdown', function(event) {
        id = $(this).data('id');
        console.log(id);
        dropdownOpen = true;
        lastDropdownClick = Date.now();
    });

    // Handle document click to close the dropdown if it's open
    $(document).on('click', function() {
        if (dropdownOpen) {
            dropdownOpen = false;
        }
    });

    $($.fn.dataTable.tables(true)).DataTable().columns.adjust();

    setInterval(function() {
        if (dropdownOpen && Date.now() - lastDropdownClick >= 60000) {
            // Close the dropdown
            $('.my-dropdown[data-id="' + id + '"]').dropdown("toggle");
            dropdownOpen = false;
        }
    }, 10000); // END DATATABLES

    dataTable.draw();

    // select 2
    $('#filter_building').select2();
    $('#add_building_id').select2({
        dropdownParent: $('#add_modal')
    });
    $('#edit_building_id').select2({
        dropdownParent: $('#edit_modal')
    });

    $('#filter_building').bind("keyup change", function() {
        dataTable.draw();
    })

    // reset filter
    $('#reset_filter').on('click', function(e) {
        e.preventDefault();

        $('#filter_building').val('').trigger("change");
    })

    // modal function
    $(document).on('click', '#add_building', function(e) {
        e.preventDefault();

        $('#add_modal').modal('show');
    })

    // - submit add modal
    $(document).on('submit', '#add_room_form', function(e) {
        e.preventDefault();

        let form = new FormData(this);
        form.append('add_room', true);

        $.ajax({
            type: "POST",
            url: "./controller/function_class",
            data: form,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function() {
                $('#add_room_btn').addClass('d-none');
                $('.spinner').removeClass('d-none');
            },
            complete: function() {
                $('#add_room_btn').removeClass('d-none');
                $('.spinner').addClass('d-none');
            },
            success: function(response) {
                console.log(response);
                if (response.includes('success')) {
                    $('#add_modal').modal('hide');
                    dataTable.ajax.reload(null, false);
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Room added successfully!',
                        iconColor: '#274c43',
                        confirmButtonColor: '#274c43',
                        showConfirmButton: false,
                        timer: 5000,
                        timerProgressBar: true,
                        color: '#000',
                        background: '#fff',
                    })
                } else if (response.includes('already exist')) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Sorry!',
                        text: 'Room already exist!',
                        iconColor: '#274c43',
                        confirmButtonColor: '#274c43',
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
                        iconColor: '#274c43',
                        confirmButtonColor: '#274c43',
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

    // - get data edit modal
    $(document).on('click', '#get_edit', function(e) {
        e.preventDefault();

        let room_id = $(this).data('id');
        let form = new FormData();
        form.append('get_room_info', true);
        form.append('room_id', room_id);

        $.ajax({
            type: "POST",
            url: "./controller/function_class",
            data: form,
            processData: false,
            contentType: false,
            cache: false,
            success: function(response) {
                console.log(response);
                $('#edit_modal').modal('show');
                let data = JSON.parse(response);
                $('#edit_room_id').val(data.id);
                $('#edit_building_id').val(data.building_id).trigger('change');
                $('#edit_room_name').val(data.room_name);
            }
        })
    })

    // submit edit building
    $(document).on('submit', '#edit_room_form', function(e) {
        e.preventDefault();

        let form = new FormData(this);
        form.append('edit_room', true);

        $.ajax({
            type: "POST",
            url: "./controller/function_class",
            data: form,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function() {
                $('#edit_room_btn').addClass('d-none');
                $('.spinner').removeClass('d-none');
            },
            complete: function() {
                $('#edit_room_btn').removeClass('d-none');
                $('.spinner').addClass('d-none');
            },
            success: function(response) {
                console.log(response);
                if (response.includes('success')) {
                    $('#edit_modal').modal('hide');
                    dataTable.ajax.reload(null, false);
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Room updated successfully!',
                        iconColor: '#274c43',
                        confirmButtonColor: '#274c43',
                        showConfirmButton: false,
                        timer: 5000,
                        timerProgressBar: true,
                        color: '#000',
                        background: '#fff',
                    })
                } else if (response.includes('already exist')) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Sorry!',
                        text: 'Room already exist!',
                        iconColor: '#274c43',
                        confirmButtonColor: '#274c43',
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
                        iconColor: '#274c43',
                        confirmButtonColor: '#274c43',
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

    // delete info
    $(document).on('click', '#get_delete', function(e) {
        e.preventDefault();

        let id = $(this).data('id');

        Swal.fire({
            icon: 'question',
            title: 'Hey!',
            text: 'Are you sure you want to delete this data?',
            iconColor: '#274c43',
            confirmButtonColor: '#274c43',
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
                                iconColor: '#274c43',
                                confirmButtonColor: '#274c43',
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
                                iconColor: '#274c43',
                                confirmButtonColor: '#274c43',
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