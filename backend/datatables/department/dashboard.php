<?php
require_once('../../config/database.php');
require_once('../../config/connection.php');
$code = $_SESSION['dt_dept_code'];

$column = array('id', 'building_name', 'room');

$query = "SELECT * FROM documents WHERE is_deleted = 0 AND hidden = 0 AND sender = '$code'";

if (isset($_POST['search']['value'])) {
    $query .= '
        AND (sender LIKE "%' . $_POST['search']['value'] . '%"
        OR reference LIKE "%' . $_POST['search']['value'] . '%" 
        OR document LIKE "%' . $_POST['search']['value'] . '%" 
        OR type LIKE "%' . $_POST['search']['value'] . '%" 
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
    $sub_array = array();
    $sub_array[] = $count++;
    $sub_array[] = ucwords($row['sender']);
    $sub_array[] = ucwords($row['reference']);
    $sub_array[] = ucwords($row['document']);
    $sub_array[] = ucwords($row['type']);
    $sub_array[] = $row['status'] == 'Ongoing' ? '<span class="bg-warning text-white px-2 py-1">Ongoing</span>' : '<span class="bg-primary text-white px-2 py-1">Done</span>';
    $data[] = $sub_array;
}

function count_all_data($pdo)
{
    global $code;
    $query = "SELECT * FROM documents WHERE is_deleted = 0 AND hidden = 0 AND sender = '$code'";
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
