<?php
require_once('../config/database.php');
require_once('../config/connection.php');

class Category
{
    private $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function add_category($category, $details, $max_time) {
        $stmt = $this->conn->prepare("SELECT * FROM category WHERE category = :category");
        $stmt->bindParam(":category", $category, PDO::PARAM_STR);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            $result = array(
                'status' => 'failed',
                'message' => ucwords($category) . ' already exist.'
            );
        } else {
            $stmt = $this->conn->prepare('INSERT INTO category (category, details, max_time) VALUES (:category, :details, :max_time)');
            $stmt->bindParam(':category', $category, PDO::PARAM_STR);
            $stmt->bindParam(':details', $details, PDO::PARAM_STR);
            $stmt->bindParam(':max_time', $max_time, PDO::PARAM_INT);
            
            if($stmt->execute()) {
                $result = array(
                    'status' => 'success',
                    'message' => ucwords($category) . ' category added successfully.'
                );
            }
        }

        echo json_encode($result);
    }

    public function delete_category($id) {
        $stmt = $this->conn->prepare("SELECT * FROM category WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        if($stmt->rowCount() <= 0) {
            $result = array(
                'status' => 'failed',
                'message' => 'No category found.',
            );
        } else {
            $stmt = $this->conn->prepare("DELETE FROM category WHERE id = :id");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);

            if($stmt->execute()) {
                $result = array(
                    'status' => 'success',
                    'message' => 'Category deleted successfully.',
                );
            }
        }

        echo json_encode($result);
    }

    public function get_category_info($id) {
        $stmt = $this->conn->prepare("SELECT * FROM category WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $result = array(
                'status' => 'success',
                'id' => $row['id'],
                'category' => $row['category'],
                'details' => $row['details'],
                'max_time' => $row['max_time'],
            );
        } else {
            $result = array(
                'status' => 'failed',
                'message' => 'No category found.',
            );
        }

        echo json_encode($result);
    }

    public function edit_document($id, $category, $details, $max_time) {
        $stmt = $this->conn->prepare("UPDATE category SET category = :category, details = :details, max_time = :max_time WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":category", $category, PDO::PARAM_STR);
        $stmt->bindParam(":details", $details, PDO::PARAM_STR);
        $stmt->bindParam(":max_time", $max_time, PDO::PARAM_INT);
    
        if($stmt->execute()) {
            $result = array(
                'status' => 'success',
                'message' => ucfirst($category) . ' category updated successfully.',
            );
        }

        echo json_encode($result);
    }
}

$Cat = new Category($pdo);

if(isset($_POST['add_category'])) {
    $Cat->add_category($_POST['add_category_name'], $_POST['add_details'], $_POST['add_max_time']);
}

if(isset($_POST['delete_category'])) {
    $Cat->delete_category($_POST['id']);
}

if(isset($_POST['get_category_info'])) {
    $Cat->get_category_info($_POST['category_id']);
}

if(isset($_POST['edit_category'])) {
    $Cat->edit_document($_POST['edit_category_id'], $_POST['edit_category_name'], $_POST['edit_details'], $_POST['edit_max_time']); 
}