<?php
require_once('../config/database.php');
require_once('../config/connection.php');

class Users
{
    private $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function add_user($username, $password)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $result = array(
                'status' => 'failed',
                'message' => ucwords($username) . ' username already exist.'
            );
        } else {
            $stmt = $this->conn->prepare('INSERT INTO users (username, password, created_at) VALUES (:username, :password, :created_at)');
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $created_at = date('Y-m-d h:i:s');
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':password', $hash, PDO::PARAM_STR);
            $stmt->bindParam(':created_at', $created_at, PDO::PARAM_STR);

            if ($stmt->execute()) {
                $result = array(
                    'status' => 'success',
                    'message' => ucwords($username) . ' user account added successfully.'
                );
            }
        }

        echo json_encode($result);
    }

    public function delete_user($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() <= 0) {
            $result = array(
                'status' => 'failed',
                'message' => 'No user account found.',
            );
        } else {
            $stmt = $this->conn->prepare("DELETE FROM users WHERE id = :id");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                $result = array(
                    'status' => 'success',
                    'message' => 'User account deleted successfully.',
                );
            }
        }

        echo json_encode($result);
    }

    public function get_user_info($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $result = array(
                'status' => 'success',
                'id' => $row['id'],
                'username' => $row['username'],
            );
        } else {
            $result = array(
                'status' => 'failed',
                'message' => 'No user account found.',
            );
        }

        echo json_encode($result);
    }

    public function edit_user($id, $username, $password)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = :username AND id != :id");
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            $result = array(
                'status' => 'failed',
                'message' => ucwords($username) . ' username already exist.',
            );
        } else {
            if(!empty($password)) {
                $stmt = $this->conn->prepare("UPDATE users SET username = :username, password = :password WHERE id = :id");
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $stmt->bindParam(":username", $username, PDO::PARAM_STR);
                $stmt->bindParam(":password", $hash, PDO::PARAM_STR);
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);

                if($stmt->execute()) {
                    $result = array(
                        'status' => 'success',
                        'message' => 'User account updated successfully.',
                    );
                }
            } else {
                $stmt = $this->conn->prepare("UPDATE users SET username = :username WHERE id = :id");
                $stmt->bindParam(":username", $username, PDO::PARAM_STR);
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);

                if($stmt->execute()) {
                    $result = array(
                        'status' => 'success',
                        'message' => 'User account updated successfully.',
                    );
                }
            }
        }

        echo json_encode($result);
    }
}

$User = new Users($pdo);

if (isset($_POST['add_user'])) {
    $User->add_user($_POST['add_username'], $_POST['add_password']);
}

if (isset($_POST['delete_user'])) {
    $User->delete_user($_POST['id']);
}

if (isset($_POST['get_user_info'])) {
    $User->get_user_info($_POST['user_id']);
}

if (isset($_POST['edit_user'])) {
    $User->edit_user($_POST['edit_user_id'], $_POST['edit_username'], $_POST['edit_password']);
}
