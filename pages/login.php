<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: dashboard.php");
    exit;
}

// Include config file
require_once './config/config.php';

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $usernamecheck = "SELECT * FROM tbl_user WHERE username = :username";
        if($stmt = $pdo->prepare($usernamecheck )){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Check if username exists, if yes then verify password
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                        $user_id = $row["id"];
                        $name = $row["full_name"];
                        $username = $row["username"];
                        $hashed_password = $row["password"];
                        $branch = $row["branch_id"];
                        $role = $row["role"];
                        $status = $row["user_status"];
                        $branchName = $pdo->query("SELECT branch_name FROM tbl_branch WHERE id ='$branch'")->fetch();
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION['full_name'] = $name;
                            $_SESSION["id"] = $user_id;
                            $_SESSION["username"] = $username;
                            $_SESSION["branch_id"] = $branch;
                            $_SESSION["role"] = $role;
                            $_SESSION["user_status"] = $status;
                            $_SESSION["branch_name"] = $branchName['branch_name'];                           
                            
                            // Redirect user to welcome page
                            header("location: dashboard.php");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.2";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password. 1";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }
    
    // Close connection
    unset($pdo);
}
?>