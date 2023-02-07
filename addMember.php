<?php
$page_title = 'Member';
require_once './include/session.php';
require_once './config/config.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $gender = $date_of_birth = $marital_status = $region = $city = $sub_city = $woreda = $house_number = $phone_number = $educational_status = $type_of_working_company = $branch = $maker = "";
    $name = trim($_POST["name"]);
    $gender = trim($_POST["gender"]);
    $date_of_birth = trim($_POST["date_of_birth"]);
    $marital_status = trim($_POST["marital_status"]);
    $region = trim($_POST["region"]);
    $city = trim($_POST["city"]);
    $sub_city = trim($_POST["sub_city"]);
    $woreda = trim($_POST["woreda"]);
    $house_number = trim($_POST["house_number"]);
    $phone_number = trim($_POST["phone_number"]);
    $educational_status = trim($_POST["educational_status"]);
    $type_of_working_company = trim($_POST["type_of_working_company"]);
    $branch = $_SESSION["branch_id"];
    $maker = $_SESSION["id"];

    if(!empty("name") && !empty("gender") && !empty("date_of_birth") && !empty("marital_status") && !empty("region") && !empty("city") && !empty("sub_city") && !empty("woreda") && !empty("house_number") && !empty("phone_number") && !empty("educational_status") && !empty("type_of_working_company") && !empty("branch") && !empty("maker")){
        $sql = "INSERT INTO tbl_member(name, gender, date_of_birth, marital_status, region, city, sub_city, woreda, house_number, phone_number, educational_status, type_of_working_company, branch, maker) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$name, $gender, $date_of_birth, $marital_status, $region, $city, $sub_city, $woreda, $house_number, $phone_number, $educational_status, $type_of_working_company, $branch, $maker])){
                        // Redirect to loan page
                        header("location: ./memberApprove.php");
        }else {
            echo "Oops! Something went wrong. Please try again later.";
    }

}
}

require_once './include/header.php';
require_once './include/navbar.php';
require_once './include/sidebar.php';
$memberIDSQL = 'SELECT MAX(id) AS memberid FROM tbl_member';
$statement = $pdo->prepare($memberIDSQL);
$statement->execute();
$maxValue = $statement->fetchColumn();;
$lastId = intval($maxValue);

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add Member</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="./index.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="./members.php">Members</a></li>
                        <li class="breadcrumb-item active">Add Member</li>
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
                        <h3 class="card-title">Member information</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h5 class="m-0 text-muted"><?= $maxValue + 2000000001; ?></h5>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="name">Full Name</label>
                                            <input type="name" class="form-control" id="name">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="gender">Gender</label>
                                            <select id="gender" class="form-control">
                                                <option selected>Choose...</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="inputState">Date Of Birth</label>
                                            <input type="date" class="form-control" id="name">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="inputState">Marital Status</label>
                                            <select id="inputState" class="form-control">
                                                <option selected>Choose...</option>
                                                <option>Single</option>
                                                <option>Married</option>
                                                <option>Divorced</option>
                                                <option>Widowed</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="inputState">Region</label>
                                            <select id="inputState" class="form-control">
                                                <option selected>Choose...</option>
                                                <option>...</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputState">City</label>
                                            <select id="inputState" class="form-control">
                                                <option selected>Choose...</option>
                                                <option>...</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputState">Sub-City</label>
                                            <select id="inputState" class="form-control">
                                                <option selected>Choose...</option>
                                                <option>...</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="inputState">Woreda</label>
                                            <input type="name" class="form-control" id="name">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputState">House No.</label>
                                            <input type="name" class="form-control" id="name">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputState">Phone Number</label>
                                            <input type="name" class="form-control" id="name">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputState">Educational Status</label>
                                            <select id="inputState" class="form-control">
                                                <option selected>Choose...</option>
                                                <option>Illiterate</option>
                                                <option>Reading And Writing</option>
                                                <option>Primary School</option>
                                                <option>High School</option>
                                                <option>Certificate</option>
                                                <option>Diploma</option>
                                                <option>Degree</option>
                                                <option>Masters</option>
                                                <option>PHD & Above</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputState">Type of working company</label>
                                            <select id="inputState" class="form-control">
                                                <option selected>Choose...</option>
                                                <option>Government</option>
                                                <option>Private</option>
                                                <option>NGO</option>
                                                <option>Spiritual</option>
                                                <option>Cooprative</option>
                                                <option>Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Add Member</button>
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