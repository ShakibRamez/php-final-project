<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = $pdo->prepare("INSERT INTO users (fullname, email, password, created_at) VALUES (?, ?, ?, NOW())");
    try {
        $stmt->execute([$fullname, $email, $password]);
        header("Location: index.php");
    } catch (PDOException $e) {
        $error = "The email entered is already registered.";
    }
}
?>

<!DOCTYPE html>
<html lang="fa">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right, #eef2f3, #8e9eab);
      font-family: 'Tahoma', sans-serif;
    }
    .card {
      border-radius: 1rem;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body>
<div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
  <div class="col-md-6">
    <div class="card p-4">
      <h4 class="text-center mb-4">Register</h4>
      <?php if (!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
      <form method="POST">
        <div class="mb-3">
          <label>Full Name:</label>
          <input type="text" name="fullname" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Email:</label>
          <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Password:</label>
          <input type="password" name="password" class="form-control" required>
        </div>
        <div class="d-grid">
          <button class="btn btn-success">Register</button>
        </div>
        <div class="text-center mt-3">
          <a href="index.php">Login to your account</a>
        </div>
      </form>
    </div>
  </div>
</div>
</body>
</html>
