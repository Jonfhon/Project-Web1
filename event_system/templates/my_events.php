<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>กิจกรรมของฉัน - Event Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;600&display=swap');
        body { font-family: 'Sarabun', sans-serif; background-color: #f8fafc; }
    </style>
</head>
<body class="antialiased text-slate-800">

    <nav class="bg-indigo-600 shadow-md">
        <div class="max-w-6xl mx-auto px-4 h-16 flex justify-between items-center text-white">
            <div class="flex items-center gap-8">
                <div class="text-xl font-bold tracking-wide">จัดการกิจกรรม</div>
                <div class="hidden sm:flex items-center space-x-2">
                    <a href="dashboard" class="text-white hover:bg-indigo-700 px-3 py-2 rounded-md">หน้าหลัก</a>
                    <a href="my_events" class="bg-indigo-700 text-white px-3 py-2 rounded-md text-sm font-medium">กิจกรรมของฉัน</a>
                    <a href="add_event" class="text-white hover:bg-indigo-700 px-3 py-2 rounded-md">สร้างกิจกรรม</a>
                </div>
            </div>
            <a href="logout" class="bg-indigo-700 hover:bg-indigo-800 px-4 py-2 rounded-lg text-xs font-semibold transition">ออกจากระบบ</a>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto px-4 py-12">
        <div class="mb-10 flex justify-between items-end">
            <div>
                <h2 class="text-3xl font-bold text-slate-800">กิจกรรมที่ฉันสร้าง</h2>
                <p class="text-slate-500 mt-1">รายการกิจกรรมทั้งหมดที่คุณเป็นเจ้าของ</p>
            </div>
            <a href="add_event" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl font-bold text-sm transition shadow-lg shadow-indigo-100">
                สร้างกิจกรรมใหม่
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php if(!empty($data['events'])): foreach($data['events'] as $event): ?>
            <div class="bg-white rounded-[2rem] border border-indigo-50 shadow-sm hover:shadow-md transition-all duration-300">
                <div class="p-8">
                    <div class="mb-4">
                        <span class="text-[10px] uppercase font-bold tracking-widest text-indigo-500 bg-indigo-50 px-3 py-1 rounded-full border border-indigo-100">Organizer Account</span>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-4"><?= htmlspecialchars($event['title']) ?></h3>
                    
                    <div class="space-y-3 mb-8 text-sm text-slate-500">
                        <div class="flex justify-between border-b border-slate-50 pb-2">
                            <span>สถานที่</span>
                            <span class="text-slate-700 font-medium"><?= htmlspecialchars($event['location']) ?></span>
                        </div>
                        <div class="flex justify-between border-b border-slate-50 pb-2">
                            <span>จำนวนที่เปิดรับ</span>
                            <span class="text-slate-700 font-medium"><?= number_format($event['max_participants']) ?> ท่าน</span>
                        </div>
                    </div>

                    <div class="flex justify-between items-center">
                        <a href="view_participants?id=<?= $event['event_id'] ?>" class="text-sm font-bold text-indigo-600 hover:text-indigo-800 transition">
                            ดูรายชื่อผู้สมัคร
                        </a>
                        <a href="edit_event?id=<?= $event['event_id'] ?>" class="text-xs font-bold text-slate-400 hover:text-indigo-600 uppercase tracking-wider">
                            แก้ไขข้อมูล
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; else: ?>
            <div class="col-span-full py-20 bg-white rounded-[2rem] border-2 border-dashed border-slate-200 text-center">
                <p class="text-slate-400 font-medium">ไม่พบรายการกิจกรรมที่คุณสร้าง</p>
            </div>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>