<?php
require_once('../config/database.php');
require_once('../config/connection.php');

class Document
{
    private $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function add_document($reference, $code, $document, $details, $type, $date) {
        $stmt = $this->conn->prepare("INSERT INTO documents (reference, sender, document, type, details, date) VALUES (:reference, :sender, :document, :type, :details, :date)");
        $stmt->bindParam(':reference', $reference, PDO::PARAM_STR);
        $stmt->bindParam(':sender', $code, PDO::PARAM_STR);
        $stmt->bindParam(':document', $document, PDO::PARAM_STR);
        $stmt->bindParam(':type', $type, PDO::PARAM_STR);
        $stmt->bindParam(':details', $details, PDO::PARAM_STR);
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);

        $stmt->execute();

        if($stmt) {
            $result = array(
                'status' => 'success',
                'message' => 'Document added successfully',
            );
        }

        echo json_encode($result);
    }

    public function change_status_to_done($id) {
        $stmt = $this->conn->prepare('SELECT * FROM documents WHERE id = :id AND is_deleted = 0');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(count($result) > 0) {
            $stmt = $this->conn->prepare('UPDATE documents SET status = "Done" WHERE id = :id');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            if($stmt) {
                $result = array(
                    'status' => 'success',
                    'message' => 'Status changed successfully'
                );
            }
        } else {
            $result = array(
                'status' => 'failed',
                'message' => 'Document not found'
            );
        }

        echo json_encode($result);
    }

    public function get_document_info($id) {
        $stmt = $this->conn->prepare("SELECT * FROM documents WHERE id = :id AND is_deleted = 0");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                $result = array(
                    'status' => 'success',
                    'id' => $row['id'],
                    'reference' => $row['reference'],
                    'department' => $row['sender'],
                    'document' => $row['document'],
                    'details' => $row['details'],
                    'type' => $row['type'],
                    'document_status' => strtoupper($row['status']),
                    'date' => $row['created'],
                );
            }
        } else {
            $result = array(
                'status' => 'failed',
                'message' => 'Document not found',
            );
        }

        echo json_encode($result);
    }
    
    public function edit_document($reference, $document, $details, $type) {
        $stmt = $this->conn->prepare('UPDATE documents SET document = :document, details = :details, type = :type WHERE reference = :reference');
        $stmt->bindParam(':reference', $reference, PDO::PARAM_STR);
        $stmt->bindParam(':document', $document, PDO::PARAM_STR);
        $stmt->bindParam(':details', $details, PDO::PARAM_STR);
        $stmt->bindParam(':type', $type, PDO::PARAM_STR);
        $stmt->execute();

        if($stmt) {
            $result = array(
                'status' => 'success',
                'message' => 'Document updated successfully',
            );
        }

        echo json_encode($result);
    }
}

$Doc = new Document($pdo);

if(isset($_POST['add_document'])) {
    $reference = rand(10000000, 99999999);
    $code = isset($_POST['dept']) ? $_SESSION['dt_dept_code'] : $_POST['add_code'];
    $document = $_POST['add_document_name'];
    $details = $_POST['add_details'];
    $type = $_POST['add_type'];
    $date = date('Y-m-d');
    $Doc->add_document($reference, $code, $document, $details, $type, $date);
}

if(isset($_POST['change_status'])) {
    $id = $_POST['id'];
    $Doc->change_status_to_done($id);
}

if(isset($_POST['get_document_info'])) {
    $id = $_POST['document_id'];
    $Doc->get_document_info($id);
}

if(isset($_POST['get_document_info_show'])) {
    $id = $_POST['document_id'];
    $Doc->get_document_info($id);
}

if(isset($_POST['edit_document'])) {
    $reference = $_POST['edit_reference'];
    $document = $_POST['edit_document_name'];
    $details = $_POST['edit_details'];
    $type = $_POST['edit_type'];
    $Doc->edit_document($reference, $document, $details, $type);
}