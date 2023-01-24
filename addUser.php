<?php
require_once './include/session.php';
// Include config file
require_once './config/config.php';
// Define variables and initialize with empty values
$name = $branch = $username = $role = $maker = $password = "";
$name_err = $branch_err = $username_err = $role_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))) {
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM tbl_user WHERE username = :username";

        if ($stmt = $pdo->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    $username_err = "This username is already taken.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }
    // Validate name
    if (empty(trim($_POST["name"]))) {
        $name_err = "Enter User full name.";
    } else {
        $name = trim($_POST["name"]);
    }


    // Validate role
    if (empty(trim($_POST["role"]))) {
        $role_err = "Please enter a role.";
    } else {
        $role = trim($_POST["role"]);
    }


    // Validate branch
    if (empty(trim($_POST["branch"]))) {
        $branch_err = "Please enter a Branch.";
    } else {
        $branch = trim($_POST["branch"]);
    }

    // Set Maker ID
    $maker = "1";

    // Set Default Password
    $password = "123456";

    // Check input errors before inserting in database
    if (empty($username_err) && empty($name_err) && empty($role_err) && empty($branch_err)) {
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
            // Redirect to user page
            header("location: user.php");
        }else{
            echo "Oops! Something went wrong. Please try again later.";
        }
            // Close statement
            unset($stmt);
        }
    }
    // Close connection
    unset($pdo);
}

$page_title = 'User';
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
                                <h5 class="m-0 text-muted">Temp</h5>
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
                                                if ($result = $pdo->query($branchList)) {
                                                    if ($result->rowCount() > 0) {
                                                        while ($row = $result->fetch()) :
                                                ?>
                                                            <option value="<?= $row["id"] ?>">
                                                                <?= $row["branch_name"] ?></option>
                                                <?php
                                                        endwhile;
                                                    }
                                                } ?>
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
require_once './include/script.php';
?>