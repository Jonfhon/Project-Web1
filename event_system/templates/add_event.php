<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <title>สร้างกิจกรรม</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;600&display=swap');
        body { font-family: 'Sarabun', sans-serif; background-color: #f8fafc; }
        
        /* ซ่อน Scrollbar สำหรับเมนูบนมือถือ แต่ยังเลื่อนได้ */
        .hide-scroll-bar::-webkit-scrollbar { display: none; }
        .hide-scroll-bar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="antialiased text-slate-800">

    <nav class="bg-indigo-600 shadow-md">
        <div class="max-w-5xl mx-auto px-4 h-16 flex justify-between items-center text-white">
            <div class="flex items-center gap-4 md:gap-8">
                <div class="text-lg sm:text-xl font-bold whitespace-nowrap">จัดการกิจกรรม</div>
                
                <div class="hidden md:flex items-center space-x-2">
                    <a href="dashboard" class="text-indigo-100 hover:text-white hover:bg-indigo-700 px-3 py-2 rounded-md text-sm font-medium transition">หน้าหลัก</a>
                    <a href="my_events" class="text-indigo-100 hover:text-white hover:bg-indigo-700 px-3 py-2 rounded-md text-sm font-medium transition">กิจกรรมของฉัน</a>
                    <a href="add_event" class="bg-indigo-700 px-3 py-2 rounded-md text-sm font-medium shadow-inner">สร้างกิจกรรม</a>
                    <a href="joined_events" class="text-indigo-100 hover:text-white hover:bg-indigo-700 px-3 py-2 rounded-md text-sm font-medium transition">กิจกรรมที่ลงทะเบียน</a>
                </div>
            </div>
            <a href="logout" class="bg-indigo-700 hover:bg-indigo-800 px-3 py-2 sm:px-4 sm:py-2 rounded-lg text-xs sm:text-sm font-semibold transition whitespace-nowrap">ออกจากระบบ</a>
        </div>

        <div class="md:hidden bg-indigo-700 px-4 py-2 flex overflow-x-auto space-x-2 hide-scroll-bar">
            <a href="dashboard" class="text-indigo-100 hover:text-white whitespace-nowrap px-3 py-1.5 rounded-md text-sm">หน้าหลัก</a>
            <a href="my_events" class="text-indigo-100 hover:text-white whitespace-nowrap px-3 py-1.5 rounded-md text-sm">กิจกรรมของฉัน</a>
            <a href="add_event" class="bg-indigo-800 text-white whitespace-nowrap px-3 py-1.5 rounded-md text-sm font-medium">สร้างกิจกรรม</a>
            <a href="joined_events" class="text-indigo-100 hover:text-white whitespace-nowrap px-3 py-1.5 rounded-md text-sm">ลงทะเบียนแล้ว</a>
        </div>
    </nav>

    <main class="max-w-xl mx-auto px-4 py-8 sm:py-12 pb-20">
        <div class="bg-white rounded-3xl sm:rounded-[2.5rem] shadow-2xl border border-indigo-50 p-6 sm:p-10">
            <div class="text-center mb-8 sm:mb-10">
                <h2 class="text-2xl sm:text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-purple-600">สร้างกิจกรรมใหม่</h2>
                <p class="text-sm sm:text-base text-slate-400 mt-2">กรอกข้อมูลให้ครบเพื่อเริ่มสร้างกิจกรรม</p>
            </div>
            
            <form action="add_event" method="POST" enctype="multipart/form-data" class="space-y-5 sm:space-y-6">
                <div class="space-y-1">
                    <label class="block text-sm font-bold text-indigo-900 ml-1">ชื่อกิจกรรม</label>
                    <input type="text" name="title" required placeholder="เช่น งานวิ่งการกุศล" class="w-full px-4 py-3 sm:px-5 sm:py-4 rounded-xl sm:rounded-2xl border border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all text-sm sm:text-base">
                </div>
                
                <div class="space-y-1">
                    <label class="block text-sm font-bold text-indigo-900 ml-1">รายละเอียด</label>
                    <textarea name="description" rows="3" placeholder="บอกเล่าเรื่องราวกิจกรรมของคุณ..." class="w-full px-4 py-3 sm:px-5 sm:py-4 rounded-xl sm:rounded-2xl border border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all text-sm sm:text-base"></textarea>
                </div>

                <div class="space-y-1">
                    <label class="block text-sm font-bold text-indigo-900 ml-1">สถานที่</label>
                    <input type="text" name="location" required placeholder="ระบุสถานที่จัดงาน" class="w-full px-4 py-3 sm:px-5 sm:py-4 rounded-xl sm:rounded-2xl border border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all text-sm sm:text-base">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-5">
                    <div class="space-y-1">
                        <label class="block text-sm font-bold text-indigo-900 ml-1">เริ่มงาน</label>
                        <input type="datetime-local" name="start_event" required class="w-full px-4 py-3 sm:px-5 sm:py-4 rounded-xl sm:rounded-2xl border border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all text-sm sm:text-base">
                    </div>
                    <div class="space-y-1">
                        <label class="block text-sm font-bold text-indigo-900 ml-1">สิ้นสุดงาน</label>
                        <input type="datetime-local" name="end_event" required class="w-full px-4 py-3 sm:px-5 sm:py-4 rounded-xl sm:rounded-2xl border border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all text-sm sm:text-base">
                    </div>
                </div>

                <div class="space-y-1">
                    <label class="block text-sm font-bold text-indigo-900 ml-1">จำนวนคนที่รับ</label>
                    <input type="number" name="max_participants" required min="1" class="w-full px-4 py-3 sm:px-5 sm:py-4 rounded-xl sm:rounded-2xl border border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all text-sm sm:text-base">
                </div>

                <div class="space-y-1">
                    <label class="block text-sm font-bold text-indigo-900 ml-1">รูปภาพประกอบ (เลือกได้หลายรูป)</label>
                    <div class="relative group">
                        <input type="file" name="images[]" multiple accept="image/*" required 
                               class="w-full text-xs sm:text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 sm:file:py-3 sm:file:px-6 file:rounded-xl file:border-0 file:text-xs sm:file:text-sm file:font-bold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 cursor-pointer border-2 border-dashed border-slate-200 rounded-xl sm:rounded-2xl p-3 sm:p-4 transition-all group-hover:border-indigo-300">
                    </div>
                </div>

                <button type="submit" class="w-full py-4 sm:py-5 bg-gradient-to-br from-indigo-600 to-purple-700 text-white font-bold rounded-xl sm:rounded-2xl shadow-xl shadow-indigo-200 hover:shadow-indigo-300 hover:-translate-y-1 active:scale-[0.98] transition-all duration-200 text-base sm:text-lg mt-2">
                    สร้างกิจกรรม
                </button>
            </form>
        </div>
    </main>
</body>
</html>