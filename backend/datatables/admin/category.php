<?php
require_once('../../config/database.php');
require_once('../../config/connection.php');

$column = array('id', 'category', 'details', 'max_time', 'created');

$query = "SELECT * FROM category";

if (isset($_POST['search']['value'])) {
    $query .= '
        WHERE (category LIKE "%' . $_POST['search']['value'] . '%"
        OR details LIKE "%' . $_POST['search']['value'] . '%" 
        OR max_time LIKE "%' . $_POST['search']['value'] . '%" 
        OR created LIKE "%' . $_POST['search']['value'] . '%" )
        ';
}

if (isset($_POST['order'])) {
    $query .= 'ORDER BY ' . $column[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' ';
} else {
    $query .= 'ORDER BY created DESC ';
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

$count = ($_POST['start'] / $_POST['length']) * $_POST['length'] + 1;

foreach ($result as $row) {

    if($row['max_time'] > 1) {
        $hour = ' hours';
    } else {
        $hour = ' hour';
    }

    $sub_array = array();
    $sub_array[] = $count++;
    $sub_array[] = ucwords($row['category']);
    $sub_array[] = ucwords($row['details']);
    $sub_array[] = ucwords($row['max_time']) . $hour;
    $sub_array[] = ucwords($row['created']);
    $sub_array[] = '<div class="btn-group" role="group">
    <button class="btn btn-warning mr-1" id="get_edit" data-id="'. $row['id'] .'"><i class="fa-solid fa-pen-to-square pr-1"></i> EDIT </button>
    <button class="btn btn-danger" id="get_delete" data-id="'. $row['id'] .'"><i class="fa-solid fa-trash pr-1"></i> DELETE </button>
    </div>';
    $data[] = $sub_array;
}

function count_all_data($pdo)
{
    $query = "SELECT * FROM category";
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