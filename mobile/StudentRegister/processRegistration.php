<?php
// Database connection
$host = "localhost";
$user = "root"; // change if needed
$pass = "";     // change if needed
$db   = "mfmschool"; // your database name

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("DB Connection failed: " . $conn->connect_error);
}

// Collect form data
$fullname     = $_POST['fullname'];
$dob          = $_POST['dob'];
$gender       = $_POST['gender'];
$class        = $_POST['class'];
$parent_name  = $_POST['parent_name'];
$parent_phone = $_POST['parent_phone'];
$email        = $_POST['email'];
$address      = $_POST['address'];
$password     = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Handle file uploads
$uploadDir = "uploads/";
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$passport = $uploadDir . time() . "_passport_" . basename($_FILES["passport"]["name"]);
$birth_cert = $uploadDir . time() . "_birth_" . basename($_FILES["birth_cert"]["name"]);
$prev_result = "";

if (move_uploaded_file($_FILES["passport"]["tmp_name"], $passport) &&
    move_uploaded_file($_FILES["birth_cert"]["tmp_name"], $birth_cert)) {
    if (!empty($_FILES["prev_result"]["name"])) {
        $prev_result = $uploadDir . time() . "_result_" . basename($_FILES["prev_result"]["name"]);
        move_uploaded_file($_FILES["prev_result"]["tmp_name"], $prev_result);
    }
} else {
    die("File upload failed!");
}

// Generate Admission Number
$year = date("y"); // last two digits of year
$prefix = ($class == "Nursery") ? "NRY" : "PRY";

// Count existing students in same year & class
$sqlCount = "SELECT COUNT(*) as total FROM students WHERE class='$class' AND YEAR(created_at)=YEAR(NOW())";
$resultCount = $conn->query($sqlCount);
$rowCount = $resultCount->fetch_assoc();
$serial = str_pad($rowCount['total'] + 1, 4, "0", STR_PAD_LEFT);

$admission_no = "MFM/$year/$prefix/$serial";

// Insert student into DB
$sql = "INSERT INTO students (fullname, dob, gender, class, parent_name, parent_phone, email, address, password, passport, birth_cert, prev_result, admission_no, created_at) 
VALUES ('$fullname','$dob','$gender','$class','$parent_name','$parent_phone','$email','$address','$password','$passport','$birth_cert','$prev_result','$admission_no',NOW())";

if ($conn->query($sql) === TRUE) {
    echo "<h2 style='text-align:center;color:green;'>Registration Successful!</h2>";
    echo "<p style='text-align:center;'>Your Admission Number is: <b>$admission_no</b></p>";
    echo "<p style='text-align:center;'><a href='login.php'>Click here to login</a></p>";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
