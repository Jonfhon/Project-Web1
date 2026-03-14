<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>แก้ไขกิจกรรม - Event Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;600&display=swap');
        body { font-family: 'Sarabun', sans-serif; background-color: #f8fafc; }
        
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
                    <a href="my_events" class="bg-indigo-700 px-3 py-2 rounded-md text-sm font-medium shadow-inner">กิจกรรมของฉัน</a>
                    <a href="add_event" class="text-indigo-100 hover:text-white hover:bg-indigo-700 px-3 py-2 rounded-md text-sm font-medium transition">สร้างกิจกรรม</a>
                    <a href="joined_events" class="text-indigo-100 hover:text-white hover:bg-indigo-700 px-3 py-2 rounded-md text-sm font-medium transition">กิจกรรมที่ลงทะเบียน</a>
                </div>
            </div>
            <a href="logout" class="bg-indigo-700 hover:bg-indigo-800 px-3 py-2 sm:px-4 sm:py-2 rounded-lg text-xs sm:text-sm font-semibold transition whitespace-nowrap">ออกจากระบบ</a>
        </div>

        <div class="md:hidden bg-indigo-700 px-4 py-2 flex overflow-x-auto space-x-2 hide-scroll-bar">
            <a href="dashboard" class="text-indigo-100 hover:text-white whitespace-nowrap px-3 py-1.5 rounded-md text-sm">หน้าหลัก</a>
            <a href="my_events" class="bg-indigo-800 text-white whitespace-nowrap px-3 py-1.5 rounded-md text-sm font-medium">กิจกรรมของฉัน</a>
            <a href="add_event" class="text-indigo-100 hover:text-white whitespace-nowrap px-3 py-1.5 rounded-md text-sm">สร้างกิจกรรม</a>
            <a href="joined_events" class="text-indigo-100 hover:text-white whitespace-nowrap px-3 py-1.5 rounded-md text-sm">ลงทะเบียนแล้ว</a>
        </div>
    </nav>

    <main class="max-w-xl mx-auto px-4 py-8 sm:py-12 pb-20">
        <div class="bg-white rounded-3xl sm:rounded-[2.5rem] shadow-2xl border border-indigo-50 p-6 sm:p-10">
            <div class="text-center mb-8 sm:mb-10">
                <h2 class="text-2xl sm:text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-purple-600">แก้ไขข้อมูลกิจกรรม</h2>
                <p class="text-sm sm:text-base text-slate-400 mt-2">ปรับปรุงรายละเอียดกิจกรรมของคุณ</p>
            </div>
            
            <form method="POST" enctype="multipart/form-data" class="space-y-5 sm:space-y-6">
                
                <div class="space-y-1">
                    <label class="block text-sm font-bold text-indigo-900 ml-1">ชื่อกิจกรรม</label>
                    <input type="text" name="title" value="<?= htmlspecialchars($data['event']['title']) ?>" required 
                           class="w-full px-4 py-3 sm:px-5 sm:py-4 rounded-xl sm:rounded-2xl border border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all text-sm sm:text-base">
                </div>
                
                <div class="space-y-1">
                    <label class="block text-sm font-bold text-indigo-900 ml-1">รายละเอียด</label>
                    <textarea name="description" rows="4" 
                              class="w-full px-4 py-3 sm:px-5 sm:py-4 rounded-xl sm:rounded-2xl border border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all text-sm sm:text-base"><?= htmlspecialchars($data['event']['description']) ?></textarea>
                </div>

                <div class="space-y-1">
                    <label class="block text-sm font-bold text-indigo-900 ml-1">สถานที่</label>
                    <input type="text" name="location" value="<?= htmlspecialchars($data['event']['location']) ?>" required 
                           class="w-full px-4 py-3 sm:px-5 sm:py-4 rounded-xl sm:rounded-2xl border border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all text-sm sm:text-base">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-5">
                    <div class="space-y-1">
                        <label class="block text-sm font-bold text-indigo-900 ml-1">เริ่มงาน</label>
                        <input type="datetime-local" name="start_event" value="<?= date('Y-m-d\TH:i', strtotime($data['event']['start_event'])) ?>" required 
                               class="w-full px-4 py-3 sm:px-5 sm:py-4 rounded-xl sm:rounded-2xl border border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all text-sm sm:text-base">
                    </div>
                    <div class="space-y-1">
                        <label class="block text-sm font-bold text-indigo-900 ml-1">สิ้นสุดงาน</label>
                        <input type="datetime-local" name="end_event" value="<?= date('Y-m-d\TH:i', strtotime($data['event']['end_event'])) ?>" required 
                               class="w-full px-4 py-3 sm:px-5 sm:py-4 rounded-xl sm:rounded-2xl border border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all text-sm sm:text-base">
                    </div>
                </div>

                <div class="space-y-1">
                    <label class="block text-sm font-bold text-indigo-900 ml-1">จำนวนคนที่รับ (ท่าน)</label>
                    <input type="number" name="max_participants" value="<?= $data['event']['max_participants'] ?>" required min="1" 
                           class="w-full px-4 py-3 sm:px-5 sm:py-4 rounded-xl sm:rounded-2xl border border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all text-sm sm:text-base">
                </div>

                <div class="pt-6 border-t border-slate-100 space-y-4">
                    <label class="block text-sm font-bold text-indigo-900 ml-1"><i class="fa-solid fa-images mr-1"></i> จัดการรูปภาพประกอบ</label>
                    
                    <?php if (!empty($data['event']['images'])): ?>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                            <?php foreach ($data['event']['images'] as $img): ?>
                                <div class="relative group rounded-xl overflow-hidden border border-slate-200 shadow-sm aspect-video bg-slate-100">
                                    <img src="assets/uploads/<?= htmlspecialchars($img) ?>" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity duration-200 flex items-center justify-center">
                                        <label class="cursor-pointer text-white flex flex-col items-center p-2">
                                            <input type="checkbox" name="delete_images[]" value="<?= htmlspecialchars($img) ?>" class="w-5 h-5 mb-1 accent-rose-500 cursor-pointer">
                                            <span class="text-[10px] sm:text-xs font-bold">เลือกลบ</span>
                                        </label>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <p class="text-[11px] sm:text-xs text-rose-500 font-medium">* ติ๊กถูกที่รูปภาพหากต้องการลบออก (จะถูกลบเมื่อกดบันทึก)</p>
                    <?php endif; ?>

                    <div class="mt-4">
                        <label class="block text-xs sm:text-sm font-semibold text-slate-500 ml-1 mb-2">เพิ่มรูปภาพใหม่ (เลือกได้หลายรูป)</label>
                        <input type="file" name="new_images[]" multiple accept="image/*"
                               class="w-full text-xs sm:text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 sm:file:py-3 sm:file:px-6 file:rounded-xl file:border-0 file:text-xs sm:file:text-sm file:font-bold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 cursor-pointer border-2 border-dashed border-slate-200 rounded-xl sm:rounded-2xl p-3 sm:p-4 transition-all hover:border-indigo-300">
                    </div>
                </div>
                <div class="pt-4 flex flex-col sm:flex-row gap-3 sm:gap-4 mt-8">
                    <a href="my_events" class="w-full sm:w-1/3 py-4 sm:py-4 bg-slate-100 text-slate-500 font-bold rounded-xl sm:rounded-2xl hover:bg-slate-200 transition-all text-center text-base">
                        ยกเลิก
                    </a>
                    <button type="submit" class="w-full sm:w-2/3 py-4 sm:py-4 bg-gradient-to-br from-indigo-600 to-purple-700 text-white font-bold rounded-xl sm:rounded-2xl shadow-xl shadow-indigo-200 hover:shadow-indigo-300 hover:-translate-y-1 active:scale-[0.98] transition-all duration-200 text-base">
                        บันทึกการแก้ไข
                    </button>
                </div>
                
            </form>
        </div>
    </main>
</body>
</html>