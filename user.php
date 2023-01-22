<?php
$page_title = 'User';
require_once './include/session.php';
require_once './config/config.php';
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
                    <h1 class="m-0">User Managment</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="./index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">User</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card-primary mb-5">
                            <div class="card-header">
                                <h3 class="card-title">Users List</h3>
                                <div class="d-flex justify-content-end">
                                    <a href="./addUser.php" class="mr-2">
                                        <i class="fas fa-plus"></i> Add
                                    </a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <?php
                        $userList = 'SELECT user.id AS uid,user.full_name, br.branch_name, user.username, user.role from tbl_user AS user, tbl_branch AS br WHERE user.branch_id = br.id';
                        if ($result = $pdo->query($userList)) {
                            if ($result->rowCount() > 0) {
                        ?>
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Branch</th>
                                            <th>Username</th>
                                            <th>Role</th>
                                            <th>View</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($row = $result->fetch()) :
                                        ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($row['full_name']) ?></td>
                                            <td><?php echo htmlspecialchars($row['branch_name']) ?></td>
                                            <td><?php echo htmlspecialchars($row['username']) ?></td>
                                            <td><?php echo htmlspecialchars($row['role']) ?></td>
                                            <td class="text-center">
                                                <?= '<a href="./viewUser.php?id=' . $row['uid'] . '" title="View User" data-toggle="tooltip"><i class="mx-1 text-success fas fa-eye"></i></a>' ?>
                                            </td>
                                        </tr>
                                        <?php
                                        endwhile;
                                    } else {
                                        ?>
                                    </tbody>
                                </table>
                                <div class="card card-primary card-outline">
                                    <div class="card-header">
                                        <h5 class="m-0">There is no registered user.</h5>
                                    </div>
                                    <div class="card-body">
                                        <h6 class="card-title">Please add a reliable user.</h6>

                                        <p class="card-text">By pressing the next button, you can enter the necessary
                                            user
                                            information.</p>
                                        <a href="#" class="btn btn-primary">Add user information</a>
                                    </div>
                                </div>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>

            </div>
        </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php
//require_once './pages/dashboard.php';
require_once './include/footer.php';
require_once './include/script.php';
?>