<?php

$page_title = 'User';
require_once './include/session.php';
// Check existence of id parameter before processing further
if(isset($_GET["userid"]) && !empty(trim($_GET["userid"]))){
    // Include config file
    require_once "./config/config.php";
    
    // Prepare a select statement
    $userinfo = "SELECT * FROM tbl_user WHERE id = :userid";

    if($stmt = $pdo->prepare($userinfo)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":userid", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["userid"]);
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            if($stmt->rowCount() == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                // Retrieve individual field value
                $id = $row["id"];
                $full_name = $row["full_name"];
                $username = $row["username"];
                $password = $row["password"];
                $branch_id = $row["branch_id"];
                $role = $row["role"];
                $user_status = $row["user_status"];
                $maker = $row["maker"];
                $created_at = $row["created_at"];
                $updated_by = $row["updated_by"];
                $updated_at = $row["updated_at"];
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: user.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
         
    // Close statement
    unset($stmt);
    
    // Close connection
    unset($pdo);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: user.php");
    exit();
}


require_once './include/header.php';
require_once './include/navbar.php';
require_once './include/sidebar.php';
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">User Information</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="./index.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="./user.php">User</a></li>
                        <li class="breadcrumb-item active">View User</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <section class="content">
            <div class="container-fluid">
                <div class="card-primary">
                    <div class="card-header">
                        <h3 class="card-title">User information</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body ">
                        <div class="card card-outline card-secondary col-lg-6 mx-auto">
                            <div class="card-header">
                                <h3 class="card-title"> <i class="fas fa-user"></i> <?php echo $full_name;?> </h3>
                                <div class="card-tools">
                                    <!-- Buttons, labels, and many other things can be placed here! -->
                                    <!-- Here is a label for example -->
                                    <span class="badge badge-primary">Active</span>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h5><?=$username;?></h5>
                                    </div>
                                    <div class="col-lg-6">
                                        <h5>Head Office</h5>
                                    </div>
                                    <br>
                                    <div class="col-lg-4">
                                        <p><?=$role;?></p>
                                    </div>
                                    <div class="col-lg-4">
                                        <p><?=$maker;?></p>
                                    </div>
                                    <div class="col-lg-4">
                                        <p><?=$created_at;?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            The footer of the card
                        </div>
                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.card-body -->
            </div>


    </div>
    </section>
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php
//require_once './pages/dashboard.php';
require_once './include/footer.php';
require_once './include/script.php';
?>