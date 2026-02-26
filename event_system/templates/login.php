<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>เข้าสู่ระบบ - Event Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;600&display=swap');
        body { font-family: 'Sarabun', sans-serif; }
    </style>
</head>
<body class="bg-slate-100 flex justify-center items-center h-screen m-0 antialiased">
    <div class="bg-white p-10 rounded-2xl shadow-lg w-full max-w-[400px]">
        <h2 class="text-center text-slate-800 text-2xl font-bold mt-0 mb-6">เข้าสู่ระบบกิจกรรม</h2>
        <form action="login" method="POST">
            <div class="mb-5">
                <label class="font-semibold text-slate-500 block mb-2 text-sm">อีเมล</label>
                <input type="email" name="email" required class="w-full p-3 border border-slate-300 rounded-lg text-base outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
            </div>
            <div class="mb-5">
                <label class="font-semibold text-slate-500 block mb-2 text-sm">รหัสผ่าน</label>
                <input type="password" name="password" required class="w-full p-3 border border-slate-300 rounded-lg text-base outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
            </div>
            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white p-3.5 rounded-lg cursor-pointer text-base font-bold shadow-md transition-colors">เข้าสู่ระบบ</button>
        </form>
        <div class="text-center mt-6 text-sm text-slate-500">
            ยังไม่มีบัญชีผู้ใช้? <a href="register" class="text-indigo-600 font-bold no-underline hover:underline">สมัครสมาชิกใหม่</a>
        </div>
    </div>
</body>
</html>