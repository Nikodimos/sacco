<?php
$page_title = 'Branch';
require_once './include/session.php';
require_once './config/config.php';
require_once './include/header.php';
if($session){
    require_once './snippets/addBranch.php';
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
                    <h1 class="m-0">Branch Managment</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="./index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Branch</li>
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
                        <h3 class="card-title">Branch List</h3>
                        <div class="d-flex justify-content-end">
                            <a href="#" class="mr-2" data-toggle="modal" data-target="#addBranch"
                                data-backdrop="static" data-keyboard="false">
                                <i class="fas fa-plus"></i> Add
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <?php                              
                                    $branchList = 'SELECT br.id, br.branch_name, user.full_name, br.created_at from tbl_branch AS br, tbl_user AS user WHERE user.id = br.maker_id;';
                                    if($result = $pdo->query($branchList)){
                                        if($result->rowCount() > 0){
                                            ?>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Branch Name</th>
                                    <th>Branch Created By</th>
                                    <th>Branch Created At</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = $result->fetch()):
                                ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['branch_name']) ?></td>
                                    <td><?php echo htmlspecialchars($row['full_name']) ?></td>
                                    <td><?php echo htmlspecialchars($row['created_at']) ?></td>
                                    <td class="text-center">
                                        <?= '<a href="./viewUser.php?id='. $row['id'] .'" title="View User" data-toggle="tooltip"><i class="mx-1 text-danger fas fa-trash"></i></a>'?>
                                    </td>
                                </tr>
                                <?php 
                                endwhile; 
                            } else {
                                ?>
                                <div class="card card-primary card-outline">
                                    <div class="card-header">
                                        <h5 class="m-0">There is no registered Branch.</h5>
                                    </div>
                                    <div class="card-body">
                                        <h6 class="card-title">Please add a reliable Branch.</h6>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                            ?>
                            </tbody>
                        </table>
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
    require_once './snippets/modal/modal_addBranch.php';
} else {
    require_once './pages/login.php';
}
require_once './include/script.php';
?>