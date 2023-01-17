<?php
// Define variables and initialize with empty values
$branch_name = $branch_name_err = '';
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(!empty($_POST["branch_name"]))
    {
        // Validate branch name
        // Prepare a select statement
        $sql = "SELECT id FROM tbl_branch WHERE branch_name = :branch_name";
        
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":branch_name", $param_branch_name, PDO::PARAM_STR);
            
            // Set parameters
            $param_branch_name = trim($_POST["branch_name"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $branch_name_err = "This username is already taken.";
                } else{
                    $branch_name = trim($_POST["branch_name"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    //Insert Default Values
    $maker = "1";

    // Check input errors before inserting in database
    if(empty($branch_name_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO tbl_branch (branch_name, maker_id) VALUES (:branch_name, :maker)";
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":branch_name", $param_branch_name, PDO::PARAM_STR);
            $stmt->bindParam(":maker", $param_maker, PDO::PARAM_STR);

            // Set parameters
            $param_branch_name = $branch_name;
            $param_maker = $maker;

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                header("location: branch.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }
    }

}

?>