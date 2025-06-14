<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (fullname, email, password) VALUES (?, ?, ?)");
    if ($stmt->execute([$fullname, $email, $password])) {
        header("Location: index.php?registered=1");
        exit();
    } else {
        $error = "خطا در ثبت‌نام.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>ثبت‌نام</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-5">
    <h2>فرم ثبت‌نام</h2>
    <?php if (!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
    <form method="POST">
      <div class="mb-3">
        <label>نام کامل:</label>
        <input type="text" name="fullname" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>ایمیل:</label>
        <input type="email" name="email" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>رمز عبور:</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <button class="btn btn-primary">ثبت‌نام</button>
      <a href="index.php" class="btn btn-secondary">ورود</a>
    </form>
  </div>
</body>
</html>
