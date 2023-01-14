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
                                <form>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="name">Full Name</label>
                                            <input type="name" class="form-control" id="name">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputState">Username</label>
                                            <input type="name" class="form-control" id="name">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputState">Branch</label>
                                            <select id="inputState" class="form-control">
                                                <option selected>Choose...</option>
                                                <option>...</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col">
                                            <label for="inputState">Role</label>
                                            <input type="name" class="form-control" id="name">
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