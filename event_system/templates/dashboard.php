<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>หน้าหลัก - Event Management</title>
    <style>
        * { box-sizing: border-box; font-family: 'Segoe UI', Tahoma, sans-serif; }
        body { background-color: #f0f2f5; margin: 0; }
        .navbar { background-color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
        .nav-brand { font-size: 20px; font-weight: bold; color: #1877f2; }
        .user-info { display: flex; align-items: center; gap: 15px; }
        .btn-logout { background-color: #e4e6eb; color: #050505; text-decoration: none; padding: 8px 16px; border-radius: 6px; font-weight: 600; font-size: 14px; }
        .container { max-width: 1000px; margin: 40px auto; padding: 0 20px; }
        .welcome-card { background-color: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="nav-brand">จัดการกิจกรรม</div>
        <div class="user-info">
            <span style="font-weight: 600;">คุณ <?php echo htmlspecialchars($_SESSION['name'] ?? ''); ?></span>
            <a href="logout" class="btn-logout">ออกจากระบบ</a>
        </div>
    </div>
    <div class="container">
        <div class="welcome-card">
            <h2>ยินดีต้อนรับเข้าสู่ระบบ!</h2>
            <p>คุณสามารถค้นหากิจกรรมที่น่าสนใจเพื่อเข้าร่วม หรือสร้างกิจกรรมของคุณเองเพื่อชวนเพื่อนๆ มาร่วมสนุกได้เลย</p>
        </div>
    </div>
</body>
</html>