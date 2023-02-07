<?php
$page_title = 'Member';
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
                    <h1 class="m-0">Members Managment</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="./index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Members</li>
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
                        <h3 class="card-title">Members List</h3>
                        <div class="d-flex justify-content-end">
                            <a href="./addMember.php" class="mr-2">
                                <i class="fas fa-plus"></i> Add
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <?php
                        $membersList = 'SELECT *, DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), date_of_birth)), "%Y") + 0 AS age from tbl_member';
                        if ($result = $pdo->query($membersList)) {
                            if ($result->rowCount() > 0) {
                        ?>
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Member ID</th>
                                            <th>Name</th>
                                            <th>Phone Number</th>
                                            <th>Branch</th>
                                            <th>Age</th>
                                            <th>Sub-City</th>
                                            <th>View</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($row = $result->fetch()) :
                                        ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($row['member_id']) ?></td>
                                                <td><?php echo htmlspecialchars($row['name']) ?></td>
                                                <td><?php echo htmlspecialchars($row['phone_number']) ?></td>
                                                <td><?php echo htmlspecialchars($row['branch']) ?></td>
                                                <td><?php echo htmlspecialchars($row['age']) ?></td>
                                                <td><?php echo htmlspecialchars($row['sub_city']) ?></td>
                                                <td class="text-center">
                                                    <?= '<a href="./viewUser.php?id=' . $row['uid'] . '" title="View User" data-toggle="tooltip"><i class="mx-1 text-success fas fa-eye"></i></a>' ?>
                                                </td>
                                            </tr>
                                        <?php
                                        endwhile;
                                    } else {
                                        ?>
                                        <div class="card card-primary card-outline">
                                            <div class="card-header">
                                                <h5 class="m-0">There is no registered member.</h5>
                                            </div>
                                            <div class="card-body">
                                                <h6 class="card-title">Please add a reliable member.</h6>

                                                <p class="card-text">By pressing the next button, you can enter the necessary
                                                    member information.</p>
                                                <a href="./addMember.php" class="btn btn-primary">Add new member</a>
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
require_once './include/script.php';
?>