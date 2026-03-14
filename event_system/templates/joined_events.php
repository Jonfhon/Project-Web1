<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>หน้าหลัก - Event Management</title>
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
                    <a href="dashboard" class="text-indigo-100 hover:text-white hover:bg-indigo-700 px-3 py-2 rounded-md text-sm font-medium transition">หน้าหลัก</a>
                    <a href="my_events" class="text-indigo-100 hover:text-white hover:bg-indigo-700 px-3 py-2 rounded-md text-sm font-medium transition">กิจกรรมของฉัน</a>
                    <a href="add_event" class="text-indigo-100 hover:text-white hover:bg-indigo-700 px-3 py-2 rounded-md text-sm font-medium transition">สร้างกิจกรรม</a>
                    <a href="joined_events" class="bg-indigo-700 px-3 py-2 rounded-md text-sm font-medium shadow-inner">กิจกรรมที่ลงทะเบียน</a>
                </div>
            </div>
            <a href="logout" class="bg-indigo-700 hover:bg-indigo-800 px-3 py-2 sm:px-4 sm:py-2 rounded-lg text-xs sm:text-sm font-semibold transition whitespace-nowrap">ออกจากระบบ</a>
        </div>

        <div class="md:hidden bg-indigo-700 px-4 py-2 flex overflow-x-auto space-x-2 hide-scrollbar">
            <a href="dashboard" class="text-indigo-100 hover:text-white whitespace-nowrap px-3 py-1.5 rounded-md text-sm">หน้าหลัก</a>
            <a href="my_events" class="text-indigo-100 hover:text-white whitespace-nowrap px-3 py-1.5 rounded-md text-sm">กิจกรรมของฉัน</a>
            <a href="add_event" class="text-indigo-100 hover:text-white whitespace-nowrap px-3 py-1.5 rounded-md text-sm">สร้างกิจกรรม</a>
            <a href="joined_events" class="bg-indigo-800 text-white whitespace-nowrap px-3 py-1.5 rounded-md text-sm font-medium">ลงทะเบียนแล้ว</a>
        </div>
    </nav>

    <main class="max-w-5xl mx-auto px-4 py-6 sm:py-8 pb-20">
        <div class="bg-gradient-to-r from-emerald-500 to-teal-600 rounded-2xl shadow-lg p-6 sm:p-8 text-white mb-6 sm:mb-8">
            <h2 class="text-2xl sm:text-3xl font-bold mb-2 sm:mb-3">กิจกรรมที่คุณลงทะเบียนไว้</h2>
            <p class="text-emerald-100 text-sm sm:text-lg">เตรียมตัวให้พร้อมสำหรับกิจกรรมที่คุณกำลังจะเข้าร่วม</p>
        </div>

        <?php if (empty($data['events'])): ?>
            <div class="bg-white rounded-2xl shadow-sm p-8 sm:p-12 text-center border border-slate-200 flex flex-col items-center">
                <div class="text-slate-300 mb-4">
                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                </div>
                <h3 class="text-lg sm:text-xl font-bold text-slate-700 mb-2">คุณยังไม่ได้ลงทะเบียนกิจกรรมใดๆ</h3>
                <p class="text-sm sm:text-base text-slate-500 mb-6">ลองไปค้นหากิจกรรมที่น่าสนใจที่หน้าหลักดูสิครับ</p>
                <a href="dashboard" class="inline-block bg-indigo-600 text-white px-5 py-2.5 sm:px-6 sm:py-3 rounded-xl font-bold hover:bg-indigo-700 transition text-sm sm:text-base">
                    ไปดูหน้ากิจกรรม
                </a>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6">
                <?php foreach ($data['events'] as $event): ?>
                    <div class="bg-white rounded-2xl shadow-md overflow-hidden border border-gray-100 group flex flex-col h-full">

                        <div class="h-44 sm:h-48 bg-slate-200 relative group/slider shrink-0">
                            <?php if (!empty($event['images'])): ?>
                                <div id="slider-join-<?= $event['event_id'] ?>" class="flex overflow-x-auto snap-x snap-mandatory h-full hide-scrollbar scroll-smooth">
                                    <?php foreach ($event['images'] as $img): ?>
                                        <div class="min-w-full h-full snap-center shrink-0 relative">
                                            <img src="assets/uploads/<?= htmlspecialchars($img) ?>" class="w-full h-full object-cover">
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                
                                <?php if(count($event['images']) > 1): ?>
                                    <button type="button" onclick="document.getElementById('slider-join-<?= $event['event_id'] ?>').scrollBy({ left: -300, behavior: 'smooth' })" 
                                        class="absolute left-2 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white text-slate-800 w-8 h-8 rounded-full flex items-center justify-center shadow-md opacity-0 group-hover/slider:opacity-100 transition-opacity z-10 cursor-pointer">
                                        &#10094;
                                    </button>
                                    <button type="button" onclick="document.getElementById('slider-join-<?= $event['event_id'] ?>').scrollBy({ left: 300, behavior: 'smooth' })" 
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
                            <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-2 truncate"><?= htmlspecialchars($event['title']) ?></h3>
                            <p class="text-xs sm:text-sm text-gray-500 mb-3 flex items-start gap-1">
                                <svg class="w-4 h-4 text-gray-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <span class="line-clamp-2"><?= htmlspecialchars($event['location']) ?></span>
                            </p>

                            <div class="text-[11px] sm:text-xs text-slate-500 mb-4 flex flex-col gap-1 bg-slate-50 p-2.5 sm:p-3 rounded-lg border border-slate-100">
                                <span class="text-indigo-600 font-semibold">เริ่ม: <?= date('d M Y H:i', strtotime($event['start_event'])) ?></span>
                                <span class="text-rose-500 font-semibold">สิ้นสุด: <?= date('d M Y H:i', strtotime($event['end_event'])) ?></span>
                            </div>

                            <div class="mt-auto">
                                <?php if (isset($event['is_checked_in']) && $event['is_checked_in'] == 1): ?>
                                    <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-3 sm:p-4 rounded-xl flex items-center justify-center gap-3 shadow-sm">
                                        <svg class="w-6 h-6 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        <div class="flex flex-col text-left">
                                            <span class="font-bold text-sm sm:text-md">เข้าร่วมงานแล้ว</span>
                                            <?php if (!empty($event['checkin_time'])): ?>
                                                <span class="text-[10px] sm:text-xs text-emerald-600 font-semibold">
                                                    เวลา: <?= date('H:i น.', strtotime($event['checkin_time'])) ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                <?php elseif ($event['status'] === 'pending'): ?>
                                    <div class="bg-amber-50 border border-amber-200 text-amber-700 p-3 sm:p-4 rounded-xl flex flex-col items-center justify-center gap-2 sm:gap-3">
                                        <div class="flex flex-col text-center">
                                            <span class="font-bold text-xs sm:text-sm">รอผู้จัดงานอนุมัติ</span>
                                            <span class="text-[9px] sm:text-[10px] text-amber-600 opacity-80">เมื่อ <?= date('d M Y', strtotime($event['registered_at'])) ?></span>
                                        </div>
                                    </div>
                                    
                                <?php elseif ($event['status'] === 'approved'): ?>
                                    <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 p-3 sm:p-4 rounded-xl flex flex-col items-center justify-center gap-2 sm:gap-3">
                                        <div class="flex flex-col text-center">
                                            <span class="font-bold text-xs sm:text-sm">อนุมัติการเข้าร่วมแล้ว</span>
                                            <span class="text-[9px] sm:text-[10px] text-emerald-600 opacity-80">พร้อมสแกนเข้างานด้วยรหัสนี้</span>
                                        </div>
                                        <div class="bg-white border-2 border-dashed border-emerald-300 rounded-lg px-3 py-2 sm:px-4 sm:py-3 text-center w-full shadow-sm">
                                            <span class="block text-[9px] sm:text-[10px] font-semibold text-emerald-600 mb-1 uppercase tracking-wider">รหัสเข้างาน (OTP)</span>
                                            <span class="text-xl sm:text-2xl font-mono font-bold tracking-[0.2em] text-emerald-700">
                                                <?= htmlspecialchars($event['otp_code'] ?? '------') ?>
                                            </span>
                                            <span class="block text-[9px] sm:text-[10px] text-emerald-500 mt-1">*รหัสจะสุ่มใหม่ทุก 30 นาที</span>
                                        </div>
                                    </div>
                                    
                                <?php elseif ($event['status'] === 'rejected'): ?>
                                    <div class="bg-rose-50 border border-rose-200 text-rose-700 p-3 rounded-xl flex items-center justify-center gap-2">
                                        <div class="flex flex-col text-center">
                                            <span class="font-bold text-xs sm:text-sm">ไม่ได้รับสิทธิ์เข้าร่วม</span>
                                            <span class="text-[9px] sm:text-[10px] text-rose-600 opacity-80">เมื่อ <?= date('d M Y', strtotime($event['registered_at'])) ?></span>
                                        </div>
                                    </div>
                                    
                                <?php else: ?>
                                    <div class="bg-gray-50 border border-gray-200 text-gray-700 p-3 rounded-xl flex items-center justify-center gap-2">
                                        <svg class="w-5 h-5 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        <div class="flex flex-col text-center">
                                            <span class="font-bold text-xs sm:text-sm">สถานะไม่ทราบแน่ชัด</span>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>
</body>

</html>