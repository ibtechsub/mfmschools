<?php
session_start();

// Redirect if not logged in
if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit;
}

// Get session variables
$fullname = $_SESSION['fullname'];
$admission_no = $_SESSION['admission_no'];
$class = $_SESSION['class'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Dashboard - MFM Standard Schools</title>
  <style>
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background: #f4f6f9;
      color: #333;
    }

    header {
      background: #0a4d29;
      color: #fff;
      padding: 15px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    header h1 {
      margin: 0;
      font-size: 20px;
    }
    header a {
      color: #fff;
      text-decoration: none;
      background: #b8860b;
      padding: 8px 15px;
      border-radius: 8px;
      transition: 0.3s;
    }
    header a:hover {
      background: #fff;
      color: #0a4d29;
    }

    .container {
      max-width: 1100px;
      margin: 30px auto;
      padding: 20px;
    }

    .welcome {
      text-align: center;
      margin-bottom: 30px;
    }
    .welcome h2 {
      margin-bottom: 10px;
      color: #0a4d29;
    }

    .card-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
      gap: 20px;
    }

    .card {
      background: #fff;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      text-align: center;
      transition: transform 0.2s;
    }
    .card:hover {
      transform: translateY(-5px);
    }
    .card h3 {
      margin-bottom: 15px;
      color: #0a4d29;
    }
    .card a {
      display: inline-block;
      padding: 10px 18px;
      background: #0a4d29;
      color: #fff;
      border-radius: 6px;
      text-decoration: none;
      transition: 0.3s;
    }
    .card a:hover {
      background: #b8860b;
    }

    footer {
      margin-top: 40px;
      text-align: center;
      padding: 15px;
      background: #0a4d29;
      color: #fff;
    }
  </style>
</head>
<body>
  <header>
    <h1>MFM Standard Schools - Student Dashboard</h1>
    <a href="logout.php">Logout</a>
  </header>

  <div class="container">
    <div class="welcome">
      <h2>Welcome, <?php echo $fullname; ?> 👋</h2>
      <p>Admission No: <strong><?php echo $admission_no; ?></strong> | Class: <strong><?php echo $class; ?></strong></p>
    </div>

    <div class="card-grid">
      <div class="card">
        <h3>My Profile</h3>
        <a href="profile.php">View Profile</a>
      </div>
      <div class="card">
        <h3>Admission Letter</h3>
        <a href="admissionLetter.php">Download PDF</a>
      </div>
      <div class="card">
        <h3>Check Results</h3>
        <a href="results.php">View Results</a>
      </div>
      <div class="card">
        <h3>Assignments</h3>
        <a href="assignments.php">View Assignments</a>
      </div>
      <div class="card">
        <h3>School News</h3>
        <a href="news.php">View News</a>
      </div>
    </div>
  </div>

  <footer>
    <p>&copy; <?php echo date("Y"); ?> MFM Standard Schools. All Rights Reserved.</p>
  </footer>
</body>
</html>
