<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>สมัครสมาชิก - Event Management</title>
    <style>
        * { box-sizing: border-box; font-family: 'Segoe UI', Tahoma, sans-serif; }
        body { background-color: #f0f2f5; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; padding: 20px 0; }
        .card { background-color: white; padding: 40px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); width: 100%; max-width: 500px; }
        h2 { text-align: center; color: #1c1e21; margin-top: 0; margin-bottom: 25px; }
        .form-row { display: flex; gap: 15px; margin-bottom: 15px; }
        .form-group { flex: 1; margin-bottom: 15px; }
        .form-group.full { width: 100%; }
        label { font-weight: 600; color: #606770; display: block; margin-bottom: 8px; font-size: 14px; }
        input, select { width: 100%; padding: 12px; border: 1px solid #dddfe2; border-radius: 6px; font-size: 15px; }
        .btn-success { width: 100%; background-color: #42b72a; color: white; padding: 14px; border: none; border-radius: 6px; cursor: pointer; font-size: 16px; font-weight: bold; margin-top: 10px; }
        .text-center { text-align: center; margin-top: 20px; font-size: 14px; }
        .text-center a { color: #1877f2; text-decoration: none; font-weight: 600; }
    </style>
</head>
<body>
    <div class="card">
        <h2>สร้างบัญชีใหม่</h2>
        <form action="register" method="POST">
            <div class="form-group full"><label>ชื่อ-นามสกุล</label><input type="text" name="name" required></div>
            <div class="form-group full"><label>อีเมล</label><input type="email" name="email" required></div>
            <div class="form-group full"><label>รหัสผ่าน</label><input type="password" name="password" required></div>
            <div class="form-row">
                <div class="form-group"><label>เพศ</label>
                    <select name="gender" required>
                        <option value="" disabled selected>เลือกเพศ</option>
                        <option value="Male">ชาย</option><option value="Female">หญิง</option><option value="Other">อื่นๆ</option>
                    </select>
                </div>
                <div class="form-group"><label>วันเกิด</label><input type="date" name="date_of_birth" required></div>
            </div>
            <div class="form-group full"><label>จังหวัด</label><input type="text" name="province" required></div>
            <button type="submit" class="btn-success">สมัครสมาชิก</button>
        </form>
        <div class="text-center">มีบัญชีอยู่แล้ว? <a href="login">เข้าสู่ระบบที่นี่</a></div>
    </div>
</body>
</html>