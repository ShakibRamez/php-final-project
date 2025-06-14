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
        // ذخیره اطلاعات کاربر در سشن
        $_SESSION['user'] = $user;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "ایمیل یا رمز عبور نادرست است.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>ورود</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-5">
    <h2>ورود کاربر</h2>
    <?php
      if (!empty($_GET['registered'])) echo "<div class='alert alert-success'>ثبت‌نام موفق بود. لطفاً وارد شوید.</div>";
      if (!empty($error)) echo "<div class='alert alert-danger'>$error</div>";
    ?>
    <form method="POST">
      <div class="mb-3">
        <label>ایمیل:</label>
        <input type="email" name="email" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>رمز عبور:</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <button class="btn btn-success">ورود</button>
      <a href="register.php" class="btn btn-secondary">ثبت‌نام</a>
    </form>
  </div>
</body>
</html>
