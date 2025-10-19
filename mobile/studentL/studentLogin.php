<?php
session_start();

// Database connection
$host = "localhost";
$user = "root"; // change if needed
$pass = "";     // change if needed
$db   = "mfmschool"; // your database name

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("DB Connection failed: " . $conn->connect_error);
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admission_no = $_POST['admission_no'];
    $password     = $_POST['password'];

    $sql = "SELECT * FROM students WHERE admission_no='$admission_no'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            // Set session variables
            $_SESSION['student_id'] = $row['id'];
            $_SESSION['admission_no'] = $row['admission_no'];
            $_SESSION['fullname'] = $row['fullname'];
            $_SESSION['class'] = $row['class'];

            header("Location: studentDashboard.php");
            exit;
        } else {
            $error = "Invalid Admission Number or Password.";
        }
    } else {
        $error = "Invalid Admission Number or Password.";
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Login - MFM School</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: #f4f6f9;
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .login-container {
      background: #fff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
      width: 100%;
      max-width: 400px;
    }
    .login-container h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #0a4d29;
    }
    .form-group {
      margin-bottom: 15px;
    }
    .form-group label {
      display: block;
      margin-bottom: 6px;
      font-weight: 600;
      color: #333;
    }
    .form-group input {
      width: 100%;
      padding: 10px;
      border-radius: 8px;
      border: 1px solid #ccc;
    }
    .btn {
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 8px;
      background: #0a4d29;
      color: #fff;
      font-size: 16px;
      font-weight: bold;
      cursor: pointer;
      transition: 0.3s;
    }
    .btn:hover {
      background: #b8860b;
    }
    .error {
      color: red;
      text-align: center;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h2>Student Login</h2>
    <?php if ($error != "") { echo "<p class='error'>$error</p>"; } ?>
    <form method="POST" action="">
      <div class="form-group">
        <label for="admission_no">Admission Number</label>
        <input type="text" id="admission_no" name="admission_no" placeholder="e.g. MFM/25/NRY/0001" required>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter your password" required>
      </div>
      <button type="submit" class="btn">Login</button>
    </form>
  </div>
</body>
</html>
