<?php
require_once('../../config/database.php');
require_once('../../config/connection.php');

$column = array('id', 'building_name', 'room');

$query = "SELECT * FROM documents WHERE is_deleted = 0 AND hidden = 0";

if (isset($_POST['search']['value'])) {
    $query .= '
        AND (sender LIKE "%' . $_POST['search']['value'] . '%"
        OR reference LIKE "%' . $_POST['search']['value'] . '%" 
        OR document LIKE "%' . $_POST['search']['value'] . '%" 
        OR type LIKE "%' . $_POST['search']['value'] . '%" 
        OR date LIKE "%' . $_POST['search']['value'] . '%" 
        OR status LIKE "%' . $_POST['search']['value'] . '%" )
        ';
}

if (isset($_POST['order'])) {
    $query .= 'ORDER BY ' . $column[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' ';
} else {
    $query .= 'ORDER BY id DESC ';
}

$query1 = '';

if ($_POST['length'] != -1) {
    $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $pdo->prepare($query);

$statement->execute();

$number_filter_row = $statement->rowCount();

$statement = $pdo->prepare($query . $query1);

$statement->execute();

$result = $statement->fetchAll();

$data = array();

$count = 1;

foreach ($result as $row) {
    $action = '<button class="btn btn-primary dropdown-toggle my-dropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-id="' . $row['id'] . '"><i class="fa-solid fa-caret-down"></i></button> <div class="dropdown-menu"> <a class="dropdown-item" href="javascript:void(0)" id="get_done" data-id="' . $row['id'] . '"><i class="fa-solid fa-check mr-3"></i>Done</a> <a class="dropdown-item" href="javascript:void(0)" id="get_edit" data-id="' . $row['id'] . '"><i class="fa-regular fa-pen-to-square mr-3"></i>Edit</a> <a class="dropdown-item" href="javascript:void(0)" id="get_print" data-id="' . $row['id'] . '"><i class="fa-solid fa-print mr-3"></i>Print QR</a><a class="dropdown-item" href="javascript:void(0)" id="get_track" data-id="' . $row['id'] . '"><i class="fa-solid fa-magnifying-glass-location mr-3"></i>Track</a> <a class="dropdown-item" href="javascript:void(0)" id="get_delete" data-id="' . $row['id'] . '"><i class="fa-regular fa-trash-can mr-3"></i>Delete</a> </div>';

    if($row['status'] == 'Done') {
        $action = '<button class="btn btn-primary dropdown-toggle my-dropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-id="' . $row['id'] . '"><i class="fa-solid fa-caret-down"></i></button> <div class="dropdown-menu"> <a class="dropdown-item" href="javascript:void(0)" id="get_hide" data-id="' . $row['id'] . '"><i class="fa-regular fa-eye-slash mr-3"></i></i>Hide</a> <a class="dropdown-item" href="javascript:void(0)" id="get_details" data-id="' . $row['id'] . '"><i class="fa-solid fa-circle-info mr-3"></i>Details</a> </div>';
    }
    $sub_array = array();
    $sub_array[] = $count++;
    $sub_array[] = ucwords($row['sender']);
    $sub_array[] = ucwords($row['reference']);
    $sub_array[] = ucwords($row['document']);
    $sub_array[] = ucwords($row['type']);
    $sub_array[] = $row['status'] == 'Ongoing' ? '<span class="bg-warning text-white px-2 py-1">Ongoing</span>' : '<span class="bg-primary text-white px-2 py-1">Done</span>';
    $sub_array[] = $row['date'];
    $sub_array[] = $action;
    $data[] = $sub_array;
}

function count_all_data($pdo)
{
    $query = "SELECT * FROM documents WHERE is_deleted = 0 AND hidden = 0";
    $statement = $pdo->prepare($query);
    $statement->execute();
    return $statement->rowCount();
}

$output = array(
    'draw' => intval($_POST['draw']),
    'recordsTotal' => count_all_data($pdo),
    'recordsFiltered' => $number_filter_row,
    'data' => $data,
);

echo json_encode($output);
