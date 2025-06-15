<?php
session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "The email or password is incorrect.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User login</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
  <!-- Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      font-family: 'Tahoma', sans-serif;
      background: linear-gradient(135deg, #f2f2f2, #d0e0ff);
      min-height: 100vh;
    }
    .login-card {
      border-radius: 1rem;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
      background-color: #fff;
      padding: 2rem;
    }
    .form-control:focus {
      box-shadow: 0 0 5px #0d6efd;
    }
    .btn-primary {
      background-color: #0d6efd;
      border: none;
    }
    .btn-primary:hover {
      background-color: #0b5ed7;
    }
  </style>
</head>
<body>
  <div class="container d-flex justify-content-center align-items-center" style="min-height:100vh">
    <div class="col-12 col-md-6 col-lg-4">
      <div class="login-card">
        <h3 class="text-center mb-4"><i class="bi bi-person-circle"></i>Login</h3>

        <?php if (!empty($error)) echo "<div class='alert alert-danger text-center'>$error</div>"; ?>

        <form method="POST">
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Enter Your Email" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Enter Your Password" required>
          </div>
          <div class="d-grid mb-2">
            <button class="btn btn-primary">Login</button>
          </div>
          <p class="text-center">Don't have an account?<a href="register.php">Register</a></p>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
