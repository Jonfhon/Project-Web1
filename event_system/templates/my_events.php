<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <title>กิจกรรมของฉัน - Event Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;600&display=swap');
        body { font-family: 'Sarabun', sans-serif; background-color: #f8fafc; }
        
        /* ซ่อนแถบเลื่อนของเมนูมือถือ */
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
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

        <div class="md:hidden bg-indigo-700 px-4 py-2 flex overflow-x-auto space-x-2 hide-scrollbar">
            <a href="dashboard" class="text-indigo-100 hover:text-white whitespace-nowrap px-3 py-1.5 rounded-md text-sm">หน้าหลัก</a>
            <a href="my_events" class="bg-indigo-800 text-white whitespace-nowrap px-3 py-1.5 rounded-md text-sm font-medium">กิจกรรมของฉัน</a>
            <a href="add_event" class="text-indigo-100 hover:text-white whitespace-nowrap px-3 py-1.5 rounded-md text-sm">สร้างกิจกรรม</a>
            <a href="joined_events" class="text-indigo-100 hover:text-white whitespace-nowrap px-3 py-1.5 rounded-md text-sm">ลงทะเบียนแล้ว</a>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto px-4 py-8 sm:py-12 pb-20">
        
        <div class="mb-8 sm:mb-10 flex flex-col sm:flex-row justify-between sm:items-end gap-4">
            <div>
                <h2 class="text-2xl sm:text-3xl font-bold text-slate-800">กิจกรรมที่ฉันสร้าง</h2>
                <p class="text-sm sm:text-base text-slate-500 mt-1">รายการกิจกรรมทั้งหมดที่คุณเป็นเจ้าของ</p>
            </div>
            <a href="add_event" class="w-full sm:w-auto text-center bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3.5 sm:py-3 rounded-xl font-bold text-sm transition shadow-lg shadow-indigo-100">
                สร้างกิจกรรมใหม่
            </a>
        </div>

        <?php if (!empty($success)): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6 text-sm sm:text-base">
                <?php echo $success; ?>
            </div>
        <?php endif; ?>
        <?php if (!empty($error)): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-6 text-sm sm:text-base">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6">
            <?php if(!empty($data['events'])): foreach($data['events'] as $event): ?>
            <div class="bg-white rounded-3xl sm:rounded-[2rem] border border-indigo-50 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col">
                
                <div class="p-6 sm:p-8 flex-1">
                    <div class="mb-4">
                        <span class="text-[9px] sm:text-[10px] uppercase font-bold tracking-widest text-indigo-500 bg-indigo-50 px-3 py-1 rounded-full border border-indigo-100">Organizer Account</span>
                    </div>
                    <h3 class="text-lg sm:text-xl font-bold text-slate-800 mb-4 line-clamp-2"><?= htmlspecialchars($event['title']) ?></h3>
                    
                    <div class="space-y-3 mb-4 sm:mb-8 text-xs sm:text-sm text-slate-500">
                        <div class="flex justify-between border-b border-slate-50 pb-2">
                            <span>สถานที่</span>
                            <span class="text-slate-700 font-medium text-right ml-4 truncate"><?= htmlspecialchars($event['location']) ?></span>
                        </div>
                        <div class="flex justify-between border-b border-slate-50 pb-2">
                            <span>จำนวนที่เปิดรับ</span>
                            <span class="text-slate-700 font-medium"><?= number_format($event['max_participants']) ?> ท่าน</span>
                        </div>
                    </div>
                </div>

                <div class="p-4 sm:p-6 bg-slate-50 rounded-b-3xl sm:rounded-b-[2rem] border-t border-slate-100 flex justify-between items-center mt-auto">
                    <a href="view_participants?id=<?= $event['event_id'] ?>" class="text-xs sm:text-sm font-bold text-indigo-600 hover:text-indigo-800 transition">
                        ดูผู้สมัคร
                    </a>
                    
                    <div class="flex items-center gap-3 sm:gap-4">
                        <a href="edit_event?id=<?= $event['event_id'] ?>" class="text-[10px] sm:text-xs font-bold text-slate-400 hover:text-indigo-600 uppercase tracking-wider transition">
                            แก้ไข
                        </a>
                        
                        <span class="text-slate-300">|</span>

                        <form method="POST" action="" onsubmit="return confirm('ยืนยันการลบกิจกรรม: <?= htmlspecialchars($event['title']) ?>?\n\nคำเตือน: ข้อมูลจะถูกลบถาวร!');" class="m-0 p-0 flex">
                            <input type="hidden" name="delete_event_id" value="<?= $event['event_id'] ?>">
                            <button type="submit" name="delete_event" class="text-[10px] sm:text-xs font-bold text-red-400 hover:text-red-600 uppercase tracking-wider transition">
                                ลบ
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach; else: ?>
            <div class="col-span-full py-16 sm:py-20 bg-white rounded-[2rem] border-2 border-dashed border-slate-200 text-center px-4">
                <p class="text-slate-400 font-medium text-sm sm:text-base">ไม่พบรายการกิจกรรมที่คุณสร้าง</p>
            </div>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>