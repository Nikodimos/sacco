<?php
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}

// Define variables and initialize with empty values
$name = $branch = $username = $role = $maker = null;
$name_err = $branch_err = $username_err = $role_err = null;
$password = "123456";

// Validate username
if(empty(trim($_POST["username"]))){
    $username_err = "Please enter a username.";
} elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
    $username_err = "Username can only contain letters, numbers, and underscores.";
} else{
    // Prepare a select statement
    $sql = "SELECT id FROM tbl_user WHERE username = :username";
    
    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
        
        // Set parameters
        $param_username = trim($_POST["username"]);
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            if($stmt->rowCount() == 1){
                $username_err = "This username is already taken.";
            } else{
                $username = trim($_POST["username"]);
            }
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        unset($stmt);
    }
}

    
// Validate name
if(empty(trim($_POST["name"]))){
    $name_err = "Enter User full name.";     
} else{
    $name = trim($_POST["name"]);
}

    
// Validate role
if(empty(trim($_POST["role"]))){
    $role_err = "Please enter a role.";     
} else{
    $role = trim($_POST["role"]);
}

    
// Validate branch
if(empty(trim($_POST["branch"]))){
    $branch_err = "Please enter a Branch.";     
} else{
    $branch = trim($_POST["branch"]);
}

$maker = "1";

// Check input errors before inserting in database
if(empty($username_err) && empty($name_err) && empty($role_err) && empty($branch_err)){
    // Prepare an insert statement
    $sql = "INSERT INTO tbl_user(full_name, username, password, branch_id, role, maker) VALUES  (:name, :username, :password, :branch, :role, :maker)";
    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":name", $param_full_name, PDO::PARAM_STR);
        $stmt->bindParam(":branch", $param_branch, PDO::PARAM_STR);
        $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
        $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
        $stmt->bindParam(":role", $param_access, PDO::PARAM_STR);
        $stmt->bindParam(":maker", $param_maker, PDO::PARAM_STR);
        // Set parameters
        $param_full_name = $name;
        $param_branch = $branch;
        $param_username = $username;
        $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
        $param_access = $role;
        $param_maker = $maker;
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            // Redirect to login page
            header("location: user.php");
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }

            // Close statement
            unset($stmt);
    }
}
?>