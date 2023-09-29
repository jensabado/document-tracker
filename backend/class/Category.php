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

    public function add_category($category, $details, $max_time)
    {
        // Sanitize inputs
        $category = filter_var($category, FILTER_SANITIZE_STRING);
        $details = filter_var($details, FILTER_SANITIZE_STRING);
        $max_time = filter_var($max_time, FILTER_VALIDATE_INT);

        // Check if the category already exists
        $stmt = $this->conn->prepare("SELECT 1 FROM category WHERE category = :category");
        $stmt->bindParam(":category", $category, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->fetchColumn()) {
            $result = [
                'status' => 'failed',
                'message' => ucwords($category) . ' already exists.'
            ];
        } else {
            // Insert the category if it doesn't exist
            $stmt = $this->conn->prepare('INSERT INTO category (category, details, max_time) VALUES (:category, :details, :max_time)');
            $stmt->bindParam(':category', $category, PDO::PARAM_STR);
            $stmt->bindParam(':details', $details, PDO::PARAM_STR);
            $stmt->bindParam(':max_time', $max_time, PDO::PARAM_INT);

            if ($stmt->execute()) {
                $result = [
                    'status' => 'success',
                    'message' => ucwords($category) . ' category added successfully.'
                ];
            } else {
                $result = [
                    'status' => 'failed',
                    'message' => 'Error adding category.'
                ];
            }
        }

        echo json_encode($result);
    }


    public function delete_category($id)
    {
        // Sanitize input
        $id = filter_var($id, FILTER_VALIDATE_INT);

        // Prepare and execute the DELETE query
        $stmt = $this->conn->prepare("DELETE FROM category WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $rowCount = $stmt->rowCount();
            if ($rowCount > 0) {
                $result = [
                    'status' => 'success',
                    'message' => 'Category deleted successfully.',
                ];
            } else {
                $result = [
                    'status' => 'failed',
                    'message' => 'No category found.',
                ];
            }
        } else {
            $result = [
                'status' => 'failed',
                'message' => 'Error deleting category.',
            ];
        }

        echo json_encode($result);
    }


    public function get_category_info($id)
    {
        // Sanitize input
        $id = filter_var($id, FILTER_VALIDATE_INT);

        // Prepare and execute the SELECT query
        $stmt = $this->conn->prepare("SELECT id, category, details, max_time FROM category WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        // Use ternary operator to set the status and message
        $result = $stmt->rowCount() > 0
            ? [
                'status' => 'success',
                'data' => $stmt->fetch(PDO::FETCH_ASSOC),
            ]
            : [
                'status' => 'failed',
                'message' => 'No category found.',
            ];

        echo json_encode($result);
    }


    public function edit_document($id, $category, $details, $max_time)
    {
        // Sanitize inputs
        $id = filter_var($id, FILTER_VALIDATE_INT);
        $category = filter_var($category, FILTER_SANITIZE_STRING);
        $details = filter_var($details, FILTER_SANITIZE_STRING);
        $max_time = filter_var($max_time, FILTER_VALIDATE_INT);

        // Prepare and execute the UPDATE query
        $stmt = $this->conn->prepare("UPDATE category SET category = :category, details = :details, max_time = :max_time WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":category", $category, PDO::PARAM_STR);
        $stmt->bindParam(":details", $details, PDO::PARAM_STR);
        $stmt->bindParam(":max_time", $max_time, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $result = [
                'status' => 'success',
                'message' => ucfirst($category) . ' category updated successfully.',
            ];
        } else {
            $result = [
                'status' => 'failed',
                'message' => 'Error updating category.',
            ];
        }

        echo json_encode($result);
    }
}

$Cat = new Category($pdo);

if (isset($_POST['add_category'])) {
    $Cat->add_category($_POST['add_category_name'], $_POST['add_details'], $_POST['add_max_time']);
}

if (isset($_POST['delete_category'])) {
    $Cat->delete_category($_POST['id']);
}

if (isset($_POST['get_category_info'])) {
    $Cat->get_category_info($_POST['category_id']);
}

if (isset($_POST['edit_category'])) {
    $Cat->edit_document($_POST['edit_category_id'], $_POST['edit_category_name'], $_POST['edit_details'], $_POST['edit_max_time']);
}
