<?php
require_once('../config/database.php');
require_once('../config/connection.php');

class Department
{
    private $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function add_department($code, $department, $username, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM department WHERE department = :department AND code = :code AND is_deleted = 0");
        $stmt->bindParam(":department", $department, PDO::PARAM_STR);
        $stmt->bindParam(":code", $code, PDO::PARAM_STR);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            $result = array(
                'status' => 'failed',
                'message' => $department . ' already exist.'
            );
        } else {
            $stmt = $this->conn->prepare('INSERT INTO department (department, code, username, password) VALUES (:department, :code, :username, :password)');
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt->bindParam(':department', $department, PDO::PARAM_STR);
            $stmt->bindParam(':code', $code, PDO::PARAM_STR);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':password', $hash, PDO::PARAM_STR);
            
            if($stmt->execute()) {
                $result = array(
                    'status' => 'success',
                    'message' => $department . ' department added successfully.'
                );
            }
        }

        echo json_encode($result);
    }

    public function delete_department($id) {
        $stmt = $this->conn->prepare("SELECT * FROM department WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        if($stmt->rowCount() <= 0) {
            $result = array(
                'status' => 'failed',
                'message' => 'No department found.',
            );
        } else {
            $stmt = $this->conn->prepare("UPDATE department SET is_deleted = 1 WHERE id = :id");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);

            if($stmt->execute()) {
                $result = array(
                    'status' => 'success',
                    'message' => 'Department deleted successfully.',
                );
            }
        }

        echo json_encode($result);
    }

    public function get_department_info($id) {
        $stmt = $this->conn->prepare("SELECT * FROM department WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $result = array(
                'status' => 'success',
                'id' => $row['id'],
                'code' => $row['code'],
                'department' => $row['department'],
                'username' => $row['username'],
            );
        } else {
            $result = array(
                'status' => 'failed',
                'message' => 'No department found.',
            );
        }

        echo json_encode($result);
    }

    public function edit_department($id, $department, $code, $username, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM department WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            if(!empty($password)) {
                $stmt = $this->conn->prepare("UPDATE department SET department = :department, code = :code, username = :username, password = :password WHERE id = :id");
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $stmt->bindParam(":department", $department, PDO::PARAM_STR);
                $stmt->bindParam(":code", $code, PDO::PARAM_STR);
                $stmt->bindParam(":username", $username, PDO::PARAM_STR);
                $stmt->bindParam(":password", $hash, PDO::PARAM_STR);
                $stmt->bindParam(":id", $id, PDO::PARAM_STR);

                if($stmt->execute()) {
                    $result = array(
                        'status' => 'success',
                        'message' => 'Department updated successfully.',
                    );
                }
            } else {
                $stmt = $this->conn->prepare("UPDATE department SET department = :department, code = :code, username = :username WHERE id = :id");
                $stmt->bindParam(":department", $department, PDO::PARAM_STR);
                $stmt->bindParam(":code", $code, PDO::PARAM_STR);
                $stmt->bindParam(":username", $username, PDO::PARAM_STR);
                $stmt->bindParam(":id", $id, PDO::PARAM_STR);

                if($stmt->execute()) {
                    $result = array(
                        'status' => 'success',
                        'message' => 'Department updated successfully.',
                    );
                }
            }
        } else {
            $result = array(
                'status' => 'failed',
                'message' => 'Department not found.',
            );
        }

        echo json_encode($result);
    }
}

$Dept = new Department($pdo);

if(isset($_POST['add_department'])) {
    $code = strtoupper($_POST['add_code']);
    $department = strtoupper($_POST['add_department_name']);
    $username = $_POST['add_username'];
    $password = $_POST['add_password'];

    $Dept->add_department($code, $department, $username, $password);
}

if(isset($_POST['delete_department'])) {
    $Dept->delete_department($_POST['id']);
}

if(isset($_POST['get_department_info'])) {
    $Dept->get_department_info($_POST['department_id']);
}

if(isset($_POST['edit_department'])) {
    $id = $_POST['edit_department_id'];
    $department = strtoupper($_POST['edit_department_name']);
    $code = strtoupper($_POST['edit_code']);
    $username = $_POST['edit_username'];
    $password = $_POST['edit_password'];
    $Dept->edit_department($id, $department, $code, $username, $password); 
}