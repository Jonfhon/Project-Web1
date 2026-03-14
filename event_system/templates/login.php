<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <title>เข้าสู่ระบบ - Event Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;600&display=swap');
        body { font-family: 'Sarabun', sans-serif; }
    </style>
</head>
<body class="bg-slate-100 min-h-screen flex justify-center items-center px-4 py-8 antialiased">
    
    <div class="bg-white p-8 sm:p-10 rounded-[2rem] shadow-2xl w-full max-w-md border border-slate-50">
        
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-indigo-50 mb-4 text-indigo-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
            </div>
            <h2 class="text-2xl sm:text-3xl font-bold text-slate-800">เข้าสู่ระบบกิจกรรม</h2>
            <p class="text-slate-500 mt-2 text-sm sm:text-base">กรอกอีเมลและรหัสผ่านเพื่อเข้าใช้งาน</p>
        </div>

        <?php if (!empty($error)): ?>
            <div class="bg-red-50 text-red-600 p-4 rounded-xl text-sm mb-6 border border-red-100 text-center font-medium">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>
        <?php if (!empty($success)): ?>
            <div class="bg-emerald-50 text-emerald-600 p-4 rounded-xl text-sm mb-6 border border-emerald-100 text-center font-medium">
                <?= htmlspecialchars($success) ?>
            </div>
        <?php endif; ?>

        <form action="login" method="POST" class="space-y-5">
            <div>
                <label class="font-bold text-slate-700 block mb-2 text-sm ml-1">อีเมล</label>
                <input type="email" name="email" required placeholder="your@email.com" 
                       class="w-full px-4 py-3 sm:px-5 sm:py-4 border border-slate-200 rounded-xl sm:rounded-2xl text-sm sm:text-base outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all bg-slate-50 focus:bg-white">
            </div>
            
            <div>
                <label class="font-bold text-slate-700 block mb-2 text-sm ml-1">รหัสผ่าน</label>
                <input type="password" name="password" required placeholder="••••••••" 
                       class="w-full px-4 py-3 sm:px-5 sm:py-4 border border-slate-200 rounded-xl sm:rounded-2xl text-sm sm:text-base outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all bg-slate-50 focus:bg-white">
            </div>
            
            <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 text-white py-3.5 sm:py-4 rounded-xl sm:rounded-2xl cursor-pointer text-base font-bold shadow-lg shadow-indigo-200 hover:shadow-indigo-300 active:scale-[0.98] transition-all mt-2">
                เข้าสู่ระบบ
            </button>
        </form>
        
        <div class="text-center mt-8 text-sm text-slate-500">
            ยังไม่มีบัญชีผู้ใช้? <a href="register" class="text-indigo-600 font-bold no-underline hover:underline transition-colors">สมัครสมาชิกใหม่</a>
        </div>
    </div>
</body>
</html>