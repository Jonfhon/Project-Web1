<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <title>สมัครสมาชิก - Event Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;600&display=swap');
        body { font-family: 'Sarabun', sans-serif; }
    </style>
</head>
<body class="bg-slate-100 min-h-screen flex justify-center items-center px-4 py-8 antialiased">
    
    <div class="bg-white p-6 sm:p-10 rounded-[2rem] shadow-2xl w-full max-w-[500px] border border-slate-50">
        
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-indigo-50 mb-4 text-indigo-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
            </div>
            <h2 class="text-2xl sm:text-3xl font-bold text-slate-800">สร้างบัญชีใหม่</h2>
            <p class="text-slate-500 mt-2 text-sm sm:text-base">กรอกข้อมูลด้านล่างเพื่อเริ่มต้นใช้งาน</p>
        </div>

        <?php if (!empty($error)): ?>
            <div class="bg-red-50 text-red-600 p-4 rounded-xl text-sm mb-6 border border-red-100 text-center font-medium">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form action="register" method="POST" class="space-y-4 sm:space-y-5">
            <div>
                <label class="font-bold text-slate-700 block mb-2 text-sm ml-1">ชื่อ-นามสกุล</label>
                <input type="text" name="name" required placeholder="เช่น สมชาย ใจดี" 
                       class="w-full px-4 py-3 sm:px-5 sm:py-3.5 border border-slate-200 rounded-xl sm:rounded-2xl text-sm sm:text-base outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all bg-slate-50 focus:bg-white">
            </div>
            
            <div>
                <label class="font-bold text-slate-700 block mb-2 text-sm ml-1">อีเมล</label>
                <input type="email" name="email" required placeholder="your@email.com" 
                       class="w-full px-4 py-3 sm:px-5 sm:py-3.5 border border-slate-200 rounded-xl sm:rounded-2xl text-sm sm:text-base outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all bg-slate-50 focus:bg-white">
            </div>
            
            <div>
                <label class="font-bold text-slate-700 block mb-2 text-sm ml-1">รหัสผ่าน</label>
                <input type="password" name="password" required placeholder="ตั้งรหัสผ่าน 8 ตัวอักษรขึ้นไป" 
                       class="w-full px-4 py-3 sm:px-5 sm:py-3.5 border border-slate-200 rounded-xl sm:rounded-2xl text-sm sm:text-base outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all bg-slate-50 focus:bg-white">
            </div>
            
            <div class="flex flex-col sm:flex-row gap-4 sm:gap-5">
                <div class="flex-1">
                    <label class="font-bold text-slate-700 block mb-2 text-sm ml-1">เพศ</label>
                    <select name="gender" required 
                            class="w-full px-4 py-3 sm:px-5 sm:py-3.5 border border-slate-200 rounded-xl sm:rounded-2xl text-sm sm:text-base outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all bg-slate-50 focus:bg-white">
                        <option value="" disabled selected>เลือกเพศ</option>
                        <option value="Male">ชาย</option>
                        <option value="Female">หญิง</option>
                        <option value="Other">อื่นๆ</option>
                    </select>
                </div>
                <div class="flex-1">
                    <label class="font-bold text-slate-700 block mb-2 text-sm ml-1">วันเกิด</label>
                    <input type="date" name="date_of_birth" required 
                           class="w-full px-4 py-3 sm:px-5 sm:py-3.5 border border-slate-200 rounded-xl sm:rounded-2xl text-sm sm:text-base outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all bg-slate-50 focus:bg-white">
                </div>
            </div>
            
            <div>
                <label class="font-bold text-slate-700 block mb-2 text-sm ml-1">จังหวัด</label>
                <input type="text" name="province" required placeholder="เช่น กรุงเทพมหานคร" 
                       class="w-full px-4 py-3 sm:px-5 sm:py-3.5 border border-slate-200 rounded-xl sm:rounded-2xl text-sm sm:text-base outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all bg-slate-50 focus:bg-white">
            </div>
            
            <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 text-white py-3.5 sm:py-4 rounded-xl sm:rounded-2xl cursor-pointer text-base font-bold shadow-lg shadow-indigo-200 hover:shadow-indigo-300 active:scale-[0.98] transition-all mt-4">
                สมัครสมาชิก
            </button>
        </form>
        
        <div class="text-center mt-8 text-sm text-slate-500">
            มีบัญชีอยู่แล้ว? <a href="login" class="text-indigo-600 font-bold no-underline hover:underline transition-colors">เข้าสู่ระบบที่นี่</a>
        </div>
    </div>
</body>
</html>