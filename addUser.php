<?php
$page_title = 'User';
require_once './include/session.php';
require_once './config/config.php';
require_once './include/header.php';
if($session){
    require_once './include/navbar.php';
    require_once './include/sidebar.php';
    
    $userIDSQL = 'SELECT MAX(id) AS userid FROM tbl_user';
    $statement = $pdo->prepare($userIDSQL);
    $statement->execute();
    $maxValue = $statement->fetchColumn();;
    $lastId= intval($maxValue);

    // Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    require_once './snippets/addUser.php';
}

  ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add User</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="./index.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="./user.php">User</a></li>
                        <li class="breadcrumb-item active">Add User</li>
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
                    <div class="card-body">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h5 class="m-0 text-muted"><?="User Id = ". $lastId+1;?></h5>
                            </div>
                            <div class="card-body">
                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="name">Full Name</label>
                                            <input type="name" class="form-control" id="name" name="name" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="username">Username</label>
                                            <input type="username" class="form-control" id="username" name="username" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputState">Branch</label>
                                            <select id="inputState" class="form-control" name="branch" required>
                                                <option label="Choose..." value=""></option>
                                                <?php
                                                        $branchList = 'SELECT id,branch_name FROM tbl_branch';
                                                        if($result = $pdo->query($branchList)){
                                                            if($result->rowCount() > 0){
                                                                while ($row = $result->fetch()):
                                                        ?>
                                                <option value="<?= $row["id"]?>">
                                                    <?= $row["branch_name"]?></option>
                                                <?php 
                                                            endwhile; 
                                                            }
                                                        }?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col">
                                            <label for="role">Role</label>
                                            <input type="name" class="form-control" name="role" required>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Add User</button>
                                </form>
                            </div>
                        </div>
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
} else {
    require_once './pages/login.php';
}
require_once './include/script.php';
?>