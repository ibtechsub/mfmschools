<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Student Registration - MFM Standard School</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Internal CSS -->
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f8fc;
      margin: 0;
      padding: 0;
    }
    header {
      background: #0a2a43;
      color: white;
      padding: 15px;
      text-align: center;
    }
    .container {
      width: 90%;
      max-width: 900px;
      margin: 30px auto;
      background: white;
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
    }
    h2 {
      text-align: center;
      color: #0a2a43;
      margin-bottom: 20px;
    }
    form label {
      font-weight: bold;
      display: block;
      margin: 10px 0 5px;
    }
    form input, form select, form textarea {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
      margin-bottom: 15px;
      font-size: 14px;
    }
    form input[type="file"] {
      padding: 5px;
    }
    button {
      background: #0a2a43;
      color: white;
      padding: 12px;
      width: 100%;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
      transition: 0.3s ease;
    }
    button:hover {
      background: #14558a;
    }
    .error {
      color: red;
      font-size: 13px;
    }
    @media (max-width: 600px) {
      .container {
        padding: 15px;
      }
      form label, form input, form select, form textarea, button {
        font-size: 14px;
      }
    }
  </style>
</head>
<body>

  <header>
    <h1>MFM Standard School</h1>
    <p>Student Admission Form</p>
  </header>

  <div class="container">
    <h2>Student Registration</h2>
    <form id="studentForm" action="processRegistration.php" method="POST" enctype="multipart/form-data">
      <!-- Personal Info -->
      <label>Full Name</label>
      <input type="text" name="fullname" id="fullname" required>

      <label>Date of Birth</label>
      <input type="date" name="dob" id="dob" required>

      <label>Gender</label>
      <select name="gender" required>
        <option value="">-- Select Gender --</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
      </select>

      <label>Class Applying For</label>
      <select name="class" id="class" required>
        <option value="">-- Select Class --</option>
        <option value="Nursery">Nursery</option>
        <option value="Primary">Primary</option>
      </select>

      <label>Parent/Guardian Name</label>
      <input type="text" name="parent_name" required>

      <label>Parent/Guardian Phone</label>
      <input type="tel" name="parent_phone" required pattern="[0-9]{11}" placeholder="08123456789">

      <label>Email Address</label>
      <input type="email" name="email" required>

      <label>Home Address</label>
      <textarea name="address" rows="3" required></textarea>

      <!-- Login Credentials -->
      <label>Create Password</label>
      <input type="password" name="password" id="password" required minlength="6">

      <label>Confirm Password</label>
      <input type="password" id="confirmPassword" required>

      <!-- Document Upload -->
      <label>Upload Passport Photo</label>
      <input type="file" name="passport" accept="image/*" required>

      <label>Upload Birth Certificate</label>
      <input type="file" name="birth_cert" accept="image/*,application/pdf" required>

      <label>Upload Previous Result (if any)</label>
      <input type="file" name="prev_result" accept="image/*,application/pdf">

      <button type="submit">Submit Application</button>
      <p id="errorMsg" class="error"></p>
    </form>
  </div>

  <!-- Internal JavaScript -->
  <script>
    document.getElementById("studentForm").addEventListener("submit", function(e) {
      let password = document.getElementById("password").value;
      let confirmPassword = document.getElementById("confirmPassword").value;
      let errorMsg = document.getElementById("errorMsg");

      if (password !== confirmPassword) {
        e.preventDefault();
        errorMsg.textContent = "Passwords do not match!";
        return false;
      } else {
        errorMsg.textContent = "";
      }
    });
  </script>

</body>
</html>
