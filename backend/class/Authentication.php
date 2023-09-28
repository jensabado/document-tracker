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
        $stmt = $this->conn->prepare("SELECT id, password, username FROM users WHERE username = ? AND is_deleted = 0");
        $stmt->execute([$username]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && password_verify($password, $row['password'])) {
            if (isset($_POST['rem'])) {
                setcookie('dt_username', $username, time() + 86400 * 30, "/");
                setcookie('dt_password', $password, time() + 86400 * 30, "/");
            } else {
                setcookie('dt_username', '', time() - 3600, '/');
                setcookie('dt_password', '', time() - 3600, '/');
            }

            $_SESSION['dt_admin_id'] = $row['id'];
            $_SESSION['dt_admin_username'] = $row['username'];
            $result = [
                'status' => 'success',
                'type' => 'admin',
            ];
        } else {
            $result = [
                'status' => 'failed',
                'message' => 'Invalid credentials.',
            ];
        }

        echo json_encode($result);
    }


    public function login_dept($username, $password)
    {
        $stmt = $this->conn->prepare("SELECT id, password, username FROM department WHERE username = ? AND is_deleted = 0");
        $stmt->execute([$username]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && password_verify($password, $row['password'])) {
            if (isset($_POST['rem'])) {
                setcookie('dt_username', $username, time() + 86400 * 30, "/");
                setcookie('dt_password', $password, time() + 86400 * 30, "/");
            } else {
                setcookie('dt_username', '', time() - 3600, '/');
                setcookie('dt_password', '', time() - 3600, '/');
            }

            $_SESSION['dt_dept_id'] = $row['id'];
            $_SESSION['dt_dept_username'] = $row['username'];
            $result = [
                'status' => 'success',
                'type' => 'dept',
            ];
        } else {
            $result = [
                'status' => 'failed',
                'message' => 'Invalid credentials.',
            ];
        }

        echo json_encode($result);
    }


    public function logout($id, $username)
    {
        foreach ($_SESSION as $key => $val) {
            if ($key !== $id || $key !== $username) {
                unset($_SESSION[$key]);
            }
        }

        $result = array(
            'status' => 'success'
        );

        echo json_encode($result);
    }

    public function update_account($id, $username, $current_password, $new_password, $confirm_password) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = :username AND id != :id");
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            $result = array(
                'status' => 'failed',
                'message' => 'Username already exist',
            );
        } else {
            if(!empty($new_password)) {
                if($new_password == $confirm_password) {
                    $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = :id");
                    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                    $stmt->execute();
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
                    $db_password = $row['password'];
    
                    if(password_verify($current_password, $db_password)) {
                        $hash = 
                        $stmt = $this->conn->prepare("UPDATE users SET username = :username, password = :new_password WHERE id = :id");
                        $hash = password_hash($new_password, PASSWORD_DEFAULT);
                        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
                        $stmt->bindParam(":new_password", $hash, PDO::PARAM_STR);
                        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    
                        if($stmt->execute()) {
                            $_SESSION['dt_admin_username'] = $username;
                            $result = array(
                                'status' => 'success',
                                'message' => 'Account updated successfully.',
                            );
                        }
                    } else {
                        $result = array(
                            'status' => 'failed',
                            'message' => 'Password incorrect',
                        );
                    }
                } else {
                    $result = array(
                        'status' => 'failed',
                        'message' => 'Password confirmation does not match',
                    );
                }
            } else {
                $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = :id");
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                $db_password = $row['password'];

                if(password_verify($current_password, $db_password)) {
                    $stmt = $this->conn->prepare("UPDATE users SET username = :username WHERE id = :id");
                    $stmt->bindParam(":username", $username, PDO::PARAM_STR);
                    $stmt->bindParam(":id", $id, PDO::PARAM_INT);

                    if($stmt->execute()) {
                        $_SESSION['dt_admin_username'] = $username;
                        $result = array(
                            'status' => 'success',
                            'message' => 'Account updated successfully.',
                        );
                    }
                } else {
                    $result = array(
                        'status' => 'failed',
                        'message' => 'Password incorrect',
                    );
                }

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
    $id = $_POST['id'];
    $username = $_POST['username'];
    $Auth->logout($id, $username);
}

if(isset($_POST['update_account'])) {
    $Auth->update_account($_SESSION['dt_admin_id'], $_POST['username'], $_POST['current_password'], $_POST['new_password'], $_POST['confirm_password']);
}