<?php
// Define constants if they are not already defined
defined('server') ? null : define("server", "localhost");
defined('user') ? null : define("user", "root");
defined('pass') ? null : define("pass", "");
defined('database_name') ? null : define("database_name", "snhs_oes");

// Create connection using constants
$conn = new mysqli(server, user, pass, database_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to get the count of students
$studentQuery = "SELECT COUNT(*) AS total_students FROM tblstudent";
$studentResult = $conn->query($studentQuery);
$studentCount = $studentResult->fetch_assoc()['total_students'];

// Query to get the count of instructors
$instructorQuery = "SELECT COUNT(*) AS total_instructors FROM tblinstructor";
$instructorResult = $conn->query($instructorQuery);
$instructorCount = $instructorResult->fetch_assoc()['total_instructors'];

$accountsQuery = "SELECT COUNT(*) AS total_accounts FROM useraccounts";
$accountsResult = $conn->query($accountsQuery);
$accountsCount = $accountsResult->fetch_assoc()['total_accounts'];

?>

<!DOCTYPE html>
<html>
<head>
    <title>School Dashboard</title>
    <style>
        .col-md-4 {
            flex: 0 0 33.333333%;
            max-width: 33.333333%;
            padding-right: 15px;
            padding-left: 15px;
        }
        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        .card-body {
            padding: 20px;
            color: rgb(3, 4, 3);
            border-radius: 20px;
            background-color: white;
        }
        .card-total-sale {
            justify-content: space-between;
        }
        .icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .icon img {
            max-width: 100%;
            height: auto;
        }
        .mb-2 {
            margin-bottom: 10px;
        }
        .iq-progress-bar {
            height: 10px;
            background-color: #1e7cdb;
            border-radius: 5px;
            overflow: hidden;
        }
        .iq-progress {
            height: 100%;
            border-radius: 5px;
        }
        .progress-1 {
            width: 85%;
            background-color: #17a2b8;
        }
    </style>
</head>
<body>
    <h1>School Dashboard</h1>

    <div class="col-md-3 ">
        <div class="card card-block card-stretch card-height">
            <div class="card-body">
                <div class="d-flex align-items-center mb-4 card-total-sale">
                    <div class="icon iq-icon-box-2 bg-info-light">
                        <!-- Assuming you have an image for students here -->
                        <img src="<?php echo web_root; ?>img/student1.png" class="img-fluid" alt="image">
                    </div>
                    <div>
                        <p class="mb-2">Students</p>
                        <h4><?php echo $studentCount; ?></h4>
                    </div>
                </div>
                <div class="iq-progress-bar mt-2">
                    <span class="bg-danger iq-progress progress-1" style="width: <?php echo $studentCount; ?>%;">
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 ">
        <div class="card card-block card-stretch card-height">
            <div class="card-body">
                <div class="d-flex align-items-center mb-4 card-total-sale">
                    <div class="icon iq-icon-box-2 bg-info-light">
                        <!-- Assuming you have an image for instructors here -->
                        <img src="<?php echo web_root; ?>img/teacher1.png" class="img-fluid" alt="image">
                    </div>
                    <div>
                        <p class="mb-2">Teachers</p>
                        <h4><?php echo $instructorCount; ?></h4>
                    </div>
                </div>
                <div class="iq-progress-bar mt-2">
                    <span class="bg-info iq-progress progress-1" style="width: <?php echo $instructorCount; ?>%;">
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 ">
        <div class="card card-block card-stretch card-height">
            <div class="card-body">
                <div class="d-flex align-items-center mb-4 card-total-sale">
                    <div class="icon iq-icon-box-2 bg-info-light">
                        <!-- Assuming you have an image for instructors here -->
                        <img src="<?php echo web_root; ?>img/images.jpg" class="img-fluid" alt="image">
                    </div>
                    <div>
                        <p class="mb-2">Total User</p>
                        <h4><?php echo $accountsCount; ?></h4>
                    </div>
                </div>
                <div class="iq-progress-bar mt-2">
                    <span class="bg-info iq-progress progress-1" style="width: <?php echo $accountCount; ?>%;">
                    </span>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>