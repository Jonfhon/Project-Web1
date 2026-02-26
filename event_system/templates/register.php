<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>สมัครสมาชิก - Event Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;600&display=swap');
        body { font-family: 'Sarabun', sans-serif; }
    </style>
</head>
<body class="bg-slate-100 flex justify-center items-center min-h-screen m-0 py-5 antialiased">
    <div class="bg-white p-10 rounded-2xl shadow-lg w-full max-w-[500px]">
        <h2 class="text-center text-slate-800 text-2xl font-bold mt-0 mb-6">สร้างบัญชีใหม่</h2>
        <form action="register" method="POST">
            <div class="mb-4 w-full">
                <label class="font-semibold text-slate-500 block mb-2 text-sm">ชื่อ-นามสกุล</label>
                <input type="text" name="name" required class="w-full p-3 border border-slate-300 rounded-lg text-base outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
            </div>
            <div class="mb-4 w-full">
                <label class="font-semibold text-slate-500 block mb-2 text-sm">อีเมล</label>
                <input type="email" name="email" required class="w-full p-3 border border-slate-300 rounded-lg text-base outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
            </div>
            <div class="mb-4 w-full">
                <label class="font-semibold text-slate-500 block mb-2 text-sm">รหัสผ่าน</label>
                <input type="password" name="password" required class="w-full p-3 border border-slate-300 rounded-lg text-base outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
            </div>
            <div class="flex gap-4 mb-4">
                <div class="flex-1">
                    <label class="font-semibold text-slate-500 block mb-2 text-sm">เพศ</label>
                    <select name="gender" required class="w-full p-3 border border-slate-300 rounded-lg text-base outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all bg-white">
                        <option value="" disabled selected>เลือกเพศ</option>
                        <option value="Male">ชาย</option><option value="Female">หญิง</option><option value="Other">อื่นๆ</option>
                    </select>
                </div>
                <div class="flex-1">
                    <label class="font-semibold text-slate-500 block mb-2 text-sm">วันเกิด</label>
                    <input type="date" name="date_of_birth" required class="w-full p-3 border border-slate-300 rounded-lg text-base outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                </div>
            </div>
            <div class="mb-4 w-full">
                <label class="font-semibold text-slate-500 block mb-2 text-sm">จังหวัด</label>
                <input type="text" name="province" required class="w-full p-3 border border-slate-300 rounded-lg text-base outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
            </div>
            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white p-3.5 mt-2 rounded-lg cursor-pointer text-base font-bold shadow-md transition-colors">สมัครสมาชิก</button>
        </form>
        <div class="text-center mt-6 text-sm text-slate-500">
            มีบัญชีอยู่แล้ว? <a href="login" class="text-indigo-600 font-bold no-underline hover:underline">เข้าสู่ระบบที่นี่</a>
        </div>
    </div>
</body>
</html>