<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>สร้างกิจกรรม</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;600&display=swap');
        body { font-family: 'Sarabun', sans-serif; background-color: #f8fafc; }
    </style>
</head>
<body class="antialiased text-slate-800">

    <nav class="bg-indigo-600 shadow-lg mb-10">
        <div class="max-w-5xl mx-auto px-4 h-16 flex justify-between items-center text-white">
            <div class="flex items-center gap-8">
                <div class="font-bold text-xl tracking-wider">สร้างกิจกรรม</div>
                <div class="hidden sm:flex items-center space-x-2">
                    <a href="dashboard" class="hover:bg-indigo-500/50 px-3 py-2 rounded-lg transition">หน้าหลัก</a>
                    <a href="my_events" class="hover:bg-indigo-500/50 px-3 py-2 rounded-lg transition">กิจกรรมของฉัน</a>
                    <a href="add_event" class="bg-white/20 px-3 py-2 rounded-lg font-semibold border border-white/30">สร้างกิจกรรม</a>
                </div>
            </div>
            <a href="logout" class="bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded-lg text-sm font-bold transition shadow-md">ออกจากระบบ</a>
        </div>
    </nav>

    <main class="max-w-xl mx-auto px-4 pb-20">
        <div class="bg-white rounded-[2.5rem] shadow-2xl border border-indigo-50 p-10">
            <div class="text-center mb-10">
                <h2 class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-purple-600">สร้างกิจกรรมใหม่</h2>
                <p class="text-slate-400 mt-2">กรอกข้อมูลให้ครบเพื่อเริ่มสร้างกิจกรรม</p>
            </div>
            
            <form action="add_event" method="POST" enctype="multipart/form-data" class="space-y-6">
                <div class="space-y-1">
                    <label class="block text-sm font-bold text-indigo-900 ml-1">ชื่อกิจกรรม</label>
                    <input type="text" name="title" required placeholder="เช่น งานวิ่งการกุศล" class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all">
                </div>
                
                <div class="space-y-1">
                    <label class="block text-sm font-bold text-indigo-900 ml-1">รายละเอียด</label>
                    <textarea name="description" rows="3" placeholder="บอกเล่าเรื่องราวกิจกรรมของคุณ..." class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all"></textarea>
                </div>

                <div class="space-y-1">
                    <label class="block text-sm font-bold text-indigo-900 ml-1">สถานที่</label>
                    <input type="text" name="location" required placeholder="ระบุสถานที่จัดงาน" class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label class="block text-sm font-bold text-indigo-900 ml-1">เริ่มงาน</label>
                        <input type="datetime-local" name="start_event" required class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all">
                    </div>
                    <div class="space-y-1">
                        <label class="block text-sm font-bold text-indigo-900 ml-1">สิ้นสุดงาน</label>
                        <input type="datetime-local" name="end_event" required class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all">
                    </div>
                </div>

                <div class="space-y-1">
                    <label class="block text-sm font-bold text-indigo-900 ml-1">จำนวนคนที่รับ</label>
                    <input type="number" name="max_participants" required min="1" class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all">
                </div>

                <div class="space-y-1">
                    <label class="block text-sm font-bold text-indigo-900 ml-1">รูปภาพประกอบ</label>
                    <div class="relative group">
                        <input type="file" name="images[]" multiple accept="image/*" required class="w-full text-sm text-slate-500 file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 cursor-pointer border-2 border-dashed border-slate-200 rounded-2xl p-4 transition-all group-hover:border-indigo-300">
                    </div>
                </div>

                <button type="submit" class="w-full py-5 bg-gradient-to-br from-indigo-600 to-purple-700 text-white font-bold rounded-2xl shadow-xl shadow-indigo-200 hover:shadow-indigo-300 hover:-translate-y-1 active:scale-[0.98] transition-all duration-200">
                    สร้างกิจกรรม
                </button>
            </form>
        </div>
    </main>
</body>
</html>