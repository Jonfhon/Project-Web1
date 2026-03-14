<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <title>หน้าหลัก - Event Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;600&display=swap');

        body {
            font-family: 'Sarabun', sans-serif;
        }
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>

<body class="bg-slate-100 antialiased">
    <nav class="bg-indigo-600 shadow-md">
        <div class="max-w-5xl mx-auto px-4 h-16 flex justify-between items-center text-white">
            <div class="flex items-center gap-4 md:gap-8">
                <div class="text-lg sm:text-xl font-bold whitespace-nowrap">จัดการกิจกรรม</div>
                
                <div class="hidden md:flex items-center space-x-2">
                    <a href="dashboard" class="bg-indigo-700 px-3 py-2 rounded-md text-sm font-medium shadow-inner">หน้าหลัก</a>
                    <a href="my_events" class="text-indigo-100 hover:text-white hover:bg-indigo-700 px-3 py-2 rounded-md text-sm font-medium transition">กิจกรรมของฉัน</a>
                    <a href="add_event" class="text-indigo-100 hover:text-white hover:bg-indigo-700 px-3 py-2 rounded-md text-sm font-medium transition">สร้างกิจกรรม</a>
                    <a href="joined_events" class="text-indigo-100 hover:text-white hover:bg-indigo-700 px-3 py-2 rounded-md text-sm font-medium transition">กิจกรรมที่ลงทะเบียน</a>
                </div>
            </div>
            <a href="logout" class="bg-indigo-700 hover:bg-indigo-800 px-3 py-2 sm:px-4 sm:py-2 rounded-lg text-xs sm:text-sm font-semibold transition whitespace-nowrap">ออกจากระบบ</a>
        </div>

        <div class="md:hidden bg-indigo-700 px-4 py-2 flex overflow-x-auto space-x-2 hide-scrollbar">
            <a href="dashboard" class="bg-indigo-800 text-white whitespace-nowrap px-3 py-1.5 rounded-md text-sm font-medium">หน้าหลัก</a>
            <a href="my_events" class="text-indigo-100 hover:text-white whitespace-nowrap px-3 py-1.5 rounded-md text-sm">กิจกรรมของฉัน</a>
            <a href="add_event" class="text-indigo-100 hover:text-white whitespace-nowrap px-3 py-1.5 rounded-md text-sm">สร้างกิจกรรม</a>
            <a href="joined_events" class="text-indigo-100 hover:text-white whitespace-nowrap px-3 py-1.5 rounded-md text-sm">ลงทะเบียนแล้ว</a>
        </div>
    </nav>

    <main class="max-w-5xl mx-auto px-4 py-6 sm:py-8 pb-20">
        <div class="bg-gradient-to-r from-indigo-500 to-purple-600 rounded-2xl shadow-lg p-6 sm:p-8 text-white mb-8">
            <h2 class="text-2xl sm:text-3xl font-bold mb-2 sm:mb-3">ยินดีต้อนรับ!</h2>
            <p class="text-indigo-100 text-base sm:text-lg">ค้นหากิจกรรมที่น่าสนใจ หรือสร้างกิจกรรมของคุณเองได้เลย</p>

            <form method="GET" action="dashboard" class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                
                <div class="flex flex-col">
                    <label class="text-sm text-white font-semibold mb-1">ชื่อกิจกรรม</label>
                    <input type="text" name="keyword" value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>" placeholder="ค้นหาชื่อกิจกรรม..." 
                        class="px-4 py-3 rounded-xl text-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-300 text-sm sm:text-base">
                </div>

                <div class="flex flex-col">
                    <label class="text-sm text-white font-semibold mb-1">วันที่เริ่ม</label>
                    <input type="date" name="start_date" value="<?= htmlspecialchars($_GET['start_date'] ?? '') ?>" 
                        class="px-4 py-3 rounded-xl text-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-300 text-sm sm:text-base">
                </div>

                <div class="flex flex-col">
                    <label class="text-sm text-white font-semibold mb-1">วันที่สิ้นสุด</label>
                    <input type="date" name="end_date" value="<?= htmlspecialchars($_GET['end_date'] ?? '') ?>" 
                        class="px-4 py-3 rounded-xl text-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-300 text-sm sm:text-base">
                </div>

                <div class="md:col-span-3 flex flex-col sm:flex-row gap-3 mt-2 sm:mt-4">
                    <button type="submit" class="w-full sm:w-auto bg-white text-indigo-600 px-6 py-3 rounded-xl font-bold hover:bg-indigo-100 transition shadow-sm text-center">
                        ค้นหา
                    </button>
                    <a href="dashboard" class="w-full sm:w-auto bg-indigo-700/50 text-white px-6 py-3 rounded-xl font-bold hover:bg-indigo-700 transition shadow-sm border border-indigo-400 text-center">
                        ล้างค่า
                    </a>
                </div>
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php if(empty($data['events'])): ?>
                <div class="col-span-full py-20 bg-white rounded-2xl text-center shadow-sm">
                    <p class="text-slate-500 font-medium text-lg">ไม่พบกิจกรรมที่คุณค้นหา</p>
                </div>
            <?php else: ?>
                <?php foreach ($data['events'] as $event): ?>
                    <div class="bg-white rounded-2xl shadow-md overflow-hidden border border-gray-100 group flex flex-col h-full">

                        <div class="h-48 sm:h-52 bg-slate-200 relative group/slider shrink-0">
                            <?php if (!empty($event['images'])): ?>
                                
                                <div id="slider-<?= $event['event_id'] ?>" class="flex overflow-x-auto snap-x snap-mandatory h-full hide-scrollbar scroll-smooth">
                                    <?php foreach ($event['images'] as $img): ?>
                                        <div class="min-w-full h-full snap-center shrink-0 relative">
                                            <img src="assets/uploads/<?= htmlspecialchars($img) ?>" class="w-full h-full object-cover">
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                
                                <?php if(count($event['images']) > 1): ?>
                                    <button type="button" onclick="document.getElementById('slider-<?= $event['event_id'] ?>').scrollBy({ left: -300, behavior: 'smooth' })" 
                                        class="absolute left-2 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white text-slate-800 w-8 h-8 rounded-full flex items-center justify-center shadow-md opacity-0 group-hover/slider:opacity-100 transition-opacity z-10 cursor-pointer">
                                        &#10094;
                                    </button>
                                    <button type="button" onclick="document.getElementById('slider-<?= $event['event_id'] ?>').scrollBy({ left: 300, behavior: 'smooth' })" 
                                        class="absolute right-2 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white text-slate-800 w-8 h-8 rounded-full flex items-center justify-center shadow-md opacity-0 group-hover/slider:opacity-100 transition-opacity z-10 cursor-pointer">
                                        &#10095;
                                    </button>
                                    <div class="absolute bottom-2 left-1/2 -translate-x-1/2 bg-black/50 text-white text-[10px] px-3 py-1 rounded-full font-bold tracking-widest backdrop-blur-sm pointer-events-none">
                                        <?= count($event['images']) ?> รูป
                                    </div>
                                <?php endif; ?>

                            <?php else: ?>
                                <div class="w-full h-full flex items-center justify-center text-slate-400">
                                    <span class="text-sm">ไม่มีรูปภาพ</span>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="p-5 sm:p-6 flex-1 flex flex-col">
                            <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-2 line-clamp-2"><?= htmlspecialchars($event['title']) ?></h3>
                            <p class="text-xs sm:text-sm text-gray-500 mb-3 flex items-start gap-1">
                                <span>📍</span> <span class="line-clamp-2"><?= htmlspecialchars($event['location']) ?></span>
                            </p>

                            <div class="text-[11px] sm:text-xs text-slate-500 mb-4 flex flex-col gap-1 bg-slate-50 p-2.5 sm:p-3 rounded-lg border border-slate-100">
                                <span class="text-indigo-600 font-semibold">เริ่ม: <?= date('d M Y H:i', strtotime($event['start_event'])) ?></span>
                                <span class="text-rose-500 font-semibold">สิ้นสุด: <?= date('d M Y H:i', strtotime($event['end_event'])) ?></span>
                            </div>

                            <div class="mt-auto pt-2">
                                <?php if (isset($_SESSION['user_id']) && $event['organizer_id'] == $_SESSION['user_id']): ?>
                                    <button disabled class="w-full bg-indigo-50 text-indigo-400 py-2.5 sm:py-3 rounded-xl font-bold cursor-not-allowed border border-indigo-100 text-sm sm:text-base">
                                        กิจกรรมของคุณ
                                    </button>
                                    
                                <?php elseif (!empty($event['is_registered']) && $event['is_registered'] > 0): ?>
                                    <button disabled class="w-full bg-slate-200 text-slate-500 py-2.5 sm:py-3 rounded-xl font-bold cursor-not-allowed border border-slate-300 text-sm sm:text-base">
                                        ลงทะเบียนแล้ว
                                    </button>
                                    
                                <?php else: ?>
                                    <form action="join_event" method="POST">
                                        <input type="hidden" name="event_id" value="<?= $event['event_id'] ?>">
                                        <button type="submit" class="w-full bg-indigo-600 text-white py-2.5 sm:py-3 rounded-xl font-bold shadow-lg shadow-indigo-100 hover:bg-indigo-700 hover:shadow-indigo-200 active:scale-[0.98] transition-all text-sm sm:text-base">
                                            เข้าร่วมกิจกรรม
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </main>
</body>

</html>