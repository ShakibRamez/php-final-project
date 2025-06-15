<?php
session_start();
session_unset(); // پاک کردن همه سشن‌ها
session_destroy(); // نابود کردن سشن
header("Location: index.php");
exit();
