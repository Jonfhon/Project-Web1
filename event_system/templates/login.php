<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>เข้าสู่ระบบ - Event Management</title>
    <style>
        * { box-sizing: border-box; font-family: 'Segoe UI', Tahoma, sans-serif; }
        body { background-color: #f0f2f5; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .card { background-color: white; padding: 40px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); width: 100%; max-width: 400px; }
        h2 { text-align: center; color: #1c1e21; margin-top: 0; margin-bottom: 25px; }
        .form-group { margin-bottom: 20px; }
        label { font-weight: 600; color: #606770; display: block; margin-bottom: 8px; font-size: 14px; }
        input[type="email"], input[type="password"] { width: 100%; padding: 12px; border: 1px solid #dddfe2; border-radius: 6px; font-size: 16px; }
        .btn-primary { width: 100%; background-color: #1877f2; color: white; padding: 14px; border: none; border-radius: 6px; cursor: pointer; font-size: 16px; font-weight: bold; }
        .text-center { text-align: center; margin-top: 25px; font-size: 14px; }
        .text-center a { color: #1877f2; text-decoration: none; font-weight: 600; }
    </style>
</head>
<body>
    <div class="card">
        <h2>เข้าสู่ระบบกิจกรรม</h2>
        <form action="login" method="POST">
            <div class="form-group"><label>อีเมล</label><input type="email" name="email" required></div>
            <div class="form-group"><label>รหัสผ่าน</label><input type="password" name="password" required></div>
            <button type="submit" class="btn-primary">เข้าสู่ระบบ</button>
        </form>
        <div class="text-center">ยังไม่มีบัญชีผู้ใช้? <a href="register">สมัครสมาชิกใหม่</a></div>
    </div>
</body>
</html>