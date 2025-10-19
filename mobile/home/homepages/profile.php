<?php
session_start();
if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit;
}

// Database connection
$conn = new mysqli("localhost", "root", "", "mfm_school");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$student_id = $_SESSION['student_id'];

// Fetch student data
$sql = "SELECT * FROM students WHERE id = '$student_id'";
$result = $conn->query($sql);
$student = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Profile - MFM Standard Schools</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      background: #f4f6f9;
      color: #333;
    }
    header {
      background: #0a4d29;
      padding: 15px;
      color: #fff;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    header a {
      color: #fff;
      background: #b8860b;
      padding: 8px 15px;
      border-radius: 6px;
      text-decoration: none;
    }
    .container {
      max-width: 900px;
      margin: 30px auto;
      background: #fff;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    h2 {
      color: #0a4d29;
      margin-bottom: 15px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }
    table td {
      padding: 10px;
      border-bottom: 1px solid #eee;
    }
    .docs a {
      display: inline-block;
      margin-right: 10px;
      padding: 6px 12px;
      background: #0a4d29;
      color: #fff;
      border-radius: 6px;
      text-decoration: none;
    }
    .docs a:hover {
      background: #b8860b;
    }
  </style>
</head>
<body>
  <header>
    <h1>My Profile</h1>
    <a href="studentDashboard.php">← Back to Dashboard</a>
  </header>

  <div class="container">
    <h2>Biodata</h2>
    <table>
      <tr><td><strong>Full Name:</strong></td><td><?php echo $student['fullname']; ?></td></tr>
      <tr><td><strong>Admission No:</strong></td><td><?php echo $student['admission_no']; ?></td></tr>
      <tr><td><strong>Class:</strong></td><td><?php echo $student['class']; ?></td></tr>
      <tr><td><strong>Email:</strong></td><td><?php echo $student['email']; ?></td></tr>
      <tr><td><strong>Phone:</strong></td><td><?php echo $student['phone']; ?></td></tr>
      <tr><td><strong>Address:</strong></td><td><?php echo $student['address']; ?></td></tr>
      <tr><td><strong>Date of Birth:</strong></td><td><?php echo $student['dob']; ?></td></tr>
      <tr><td><strong>Parent/Guardian:</strong></td><td><?php echo $student['parent_name']; ?></td></tr>
      <tr><td><strong>Parent Phone:</strong></td><td><?php echo $student['parent_phone']; ?></td></tr>
    </table>

    <h2>Uploaded Documents</h2>
    <div class="docs">
      <?php if (!empty($student['birth_cert'])): ?>
        <a href="uploads/<?php echo $student['birth_cert']; ?>" target="_blank">Birth Certificate</a>
      <?php endif; ?>
      <?php if (!empty($student['passport_photo'])): ?>
        <a href="uploads/<?php echo $student['passport_photo']; ?>" target="_blank">Passport Photo</a>
      <?php endif; ?>
      <?php if (!empty($student['last_result'])): ?>
        <a href="uploads/<?php echo $student['last_result']; ?>" target="_blank">Previous Result</a>
      <?php endif; ?>
    </div>
  </div>
</body>
</html>
