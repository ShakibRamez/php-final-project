<?php
session_start();

// اگر کاربر وارد نشده بود، به صفحه ورود بره
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html>
<head>
  <title>پروفایل کاربر</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-5">
    <h2>به پروفایل خوش آمدید، <?php echo htmlspecialchars($user['fullname']); ?>!</h2>

    <div class="card mt-4">
      <div class="card-body">
        <p><strong>نام کامل:</strong> <?php echo htmlspecialchars($user['fullname']); ?></p>
        <p><strong>ایمیل:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        <p><strong>تاریخ عضویت:</strong> <?php echo $user['created_at']; ?></p>
        <a href="logout.php" class="btn btn-danger mt-3">خروج</a>
      </div>
    </div>
  </div>
</body>
</html>
