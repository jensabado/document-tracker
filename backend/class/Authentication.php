<?php
require_once('../config/database.php');
require_once('../config/connection.php');

class Authentication
{
    private $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function login_admin($username, $password)
    {
        // Sanitize input
        $username = filter_var($username, FILTER_SANITIZE_STRING);

        $stmt = $this->conn->prepare("SELECT id, password, username FROM users WHERE username = :username");
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && password_verify($password, $row['password'])) {
            $cookie_expiry = isset($_POST['rem']) ? time() + 86400 * 30 : time() - 3600;
            setcookie('dt_username', $username, $cookie_expiry, "/");
            setcookie('dt_password', $password, $cookie_expiry, "/");

            $_SESSION['dt_admin_id'] = $row['id'];
            $_SESSION['dt_admin_username'] = $row['username'];
            $result = ['status' => 'success', 'type' => 'admin'];
        } else {
            $result = ['status' => 'failed', 'message' => 'Invalid credentials.'];
        }

        echo json_encode($result);
    }




    public function login_dept($username, $password)
    {
        // Sanitize input
        $username = filter_var($username, FILTER_SANITIZE_STRING);

        $stmt = $this->conn->prepare("SELECT id, password, username, code FROM department WHERE username = :username AND is_deleted = 0");
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && password_verify($password, $row['password'])) {
            $cookie_expiry = isset($_POST['rem']) ? time() + 86400 * 30 : time() - 3600;
            setcookie('dt_username', $username, $cookie_expiry, "/");
            setcookie('dt_password', $password, $cookie_expiry, "/");

            $_SESSION['dt_dept_id'] = $row['id'];
            $_SESSION['dt_dept_username'] = $row['username'];
            $_SESSION['dt_dept_code'] = $row['code'];
            $result = ['status' => 'success', 'type' => 'dept'];
        } else {
            $result = ['status' => 'failed', 'message' => 'Invalid credentials.'];
        }

        echo json_encode($result);
    }




    public function logout($type)
    {
        // Sanitize input
        $type = filter_var($type, FILTER_SANITIZE_STRING);

        // Define the session variables you want to keep based on the $type
        $sessionVariablesToKeep = ($type == 'admin')
            ? ['dt_admin_id', 'dt_admin_username']
            : ['dt_dept_id', 'dt_dept_username', 'dt_dept_code'];

        // Unset all session variables except the ones to keep
        foreach ($_SESSION as $key => $value) {
            if (!in_array($key, $sessionVariablesToKeep)) {
                unset($_SESSION[$key]);
            }
        }

        // Clear the session data and destroy the session
        session_unset();
        session_destroy();

        $result = [
            'status' => 'success',
        ];

        echo json_encode($result);
    }


    public function update_account($id, $username, $current_password, $new_password, $confirm_password)
    {
        // Sanitize inputs
        $id = filter_var($id, FILTER_VALIDATE_INT);
        $username = filter_var($username, FILTER_SANITIZE_STRING);

        // Check if the new username already exists
        $stmt = $this->conn->prepare("SELECT 1 FROM users WHERE username = :username AND id != :id");
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->fetchColumn()) {
            $result = ['status' => 'failed', 'message' => 'Username already exists'];
        } else {
            // Retrieve the user's current password
            $stmt = $this->conn->prepare("SELECT password FROM users WHERE id = :id");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $db_password = $stmt->fetchColumn();

            if (password_verify($current_password, $db_password)) {
                if (!empty($new_password)) {
                    if ($new_password == $confirm_password) {
                        $hash = password_hash($new_password, PASSWORD_DEFAULT);
                        $stmt = $this->conn->prepare("UPDATE users SET username = :username, password = :new_password WHERE id = :id");
                        $stmt->bindParam(":new_password", $hash, PDO::PARAM_STR);
                    } else {
                        $result = ['status' => 'failed', 'message' => 'Password confirmation does not match'];
                    }
                } else {
                    $stmt = $this->conn->prepare("UPDATE users SET username = :username WHERE id = :id");
                }

                $stmt->bindParam(":username", $username, PDO::PARAM_STR);
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);

                if ($stmt->execute()) {
                    $_SESSION['dt_admin_username'] = $username;
                    $result = ['status' => 'success', 'message' => 'Account updated successfully.'];
                }
            } else {
                $result = ['status' => 'failed', 'message' => 'Password incorrect'];
            }
        }

        echo json_encode($result);
    }
}

$Auth = new Authentication($pdo);

if (isset($_POST['login'])) {
    if ($_POST['is_admin'] == 'true') {
        $Auth->login_admin($_POST['username'], $_POST['password']);
    } else {
        $Auth->login_dept($_POST['username'], $_POST['password']);
    }
}

if (isset($_POST['logout'])) {
    $type = $_POST['type'];
    $Auth->logout($type);
}

if (isset($_POST['update_account'])) {
    $Auth->update_account($_SESSION['dt_admin_id'], $_POST['username'], $_POST['current_password'], $_POST['new_password'], $_POST['confirm_password']);
}
