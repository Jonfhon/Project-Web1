<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>กิจกรรมที่ลงทะเบียน - Event Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;600&display=swap');

        body {
            font-family: 'Sarabun', sans-serif;
        }

        /* ซ่อนแถบเลื่อน (Scrollbar) แต่ยังเลื่อนได้ */
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>

<body class="bg-slate-100 antialiased">
    <nav class="bg-indigo-600 shadow-md">
        <div class="max-w-5xl mx-auto px-4 h-16 flex justify-between items-center text-white">
            <div class="flex items-center gap-8">
                <div class="text-xl font-bold">จัดการกิจกรรม</div>
                <div class="hidden sm:flex items-center space-x-2">
                    <a href="dashboard" class="text-indigo-100 hover:text-white hover:bg-indigo-700 px-3 py-2 rounded-md text-sm font-medium transition">หน้าหลัก</a>
                    <a href="my_events" class="text-indigo-100 hover:text-white hover:bg-indigo-700 px-3 py-2 rounded-md text-sm font-medium transition">กิจกรรมของฉัน</a>
                    <a href="add_event" class="text-indigo-100 hover:text-white hover:bg-indigo-700 px-3 py-2 rounded-md text-sm font-medium transition">สร้างกิจกรรม</a>
                    <a href="joined_events" class="bg-indigo-700 px-3 py-2 rounded-md text-sm font-medium">กิจกรรมที่ลงทะเบียน</a>
                </div>
            </div>
            <a href="logout" class="bg-indigo-700 hover:bg-indigo-800 px-4 py-2 rounded-lg text-sm font-semibold transition">ออกจากระบบ</a>
        </div>
    </nav>

    <main class="max-w-5xl mx-auto px-4 py-8">
        <div class="bg-gradient-to-r from-emerald-500 to-teal-600 rounded-2xl shadow-lg p-8 text-white mb-8">
            <h2 class="text-3xl font-bold mb-3">กิจกรรมที่คุณลงทะเบียนไว้</h2>
            <p class="text-emerald-100 text-lg">เตรียมตัวให้พร้อมสำหรับกิจกรรมที่คุณกำลังจะเข้าร่วม!</p>
        </div>

        <?php if (empty($data['events'])): ?>
            <div class="bg-white rounded-2xl shadow-sm p-12 text-center border border-slate-200">
                <div class="text-6xl mb-4">📭</div>
                <h3 class="text-xl font-bold text-slate-700 mb-2">คุณยังไม่ได้ลงทะเบียนกิจกรรมใดๆ</h3>
                <p class="text-slate-500 mb-6">ลองไปค้นหากิจกรรมที่น่าสนใจที่หน้าหลักดูสิครับ</p>
                <a href="dashboard" class="inline-block bg-indigo-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-indigo-700 transition">
                    ไปดูหน้ากิจกรรม
                </a>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($data['events'] as $event): ?>
                    <div class="bg-white rounded-2xl shadow-md overflow-hidden border border-gray-100 group">

                        <div class="h-48 bg-slate-200 relative group/slider">
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

                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-2 truncate"><?= htmlspecialchars($event['title']) ?></h3>
                            <p class="text-sm text-gray-500 mb-2 flex items-center gap-1">
                                📍 <?= htmlspecialchars($event['location']) ?>
                            </p>

                            <div class="text-xs text-slate-500 mb-4 flex flex-col gap-1 bg-slate-50 p-2 rounded-lg">
                                <span class="text-indigo-600 font-semibold">เริ่ม: <?= date('d M Y H:i', strtotime($event['start_event'])) ?></span>
                                <span class="text-rose-500 font-semibold">สิ้นสุด: <?= date('d M Y H:i', strtotime($event['end_event'])) ?></span>
                            </div>

                            <?php if ($event['status'] === 'pending'): ?>
                                <div class="bg-amber-50 border border-amber-200 text-amber-700 p-4 rounded-xl flex flex-col items-center justify-center gap-3">
                                    
                                    <div class="flex flex-col text-center">
                                        <span class="font-bold text-sm">รอผู้จัดงานอนุมัติ</span>
                                        <span class="text-[10px] text-amber-600 opacity-80">เมื่อ <?= date('d M Y', strtotime($event['registered_at'])) ?></span>
                                    </div>
                                    
                                    <div class="bg-white border-2 border-dashed border-amber-300 rounded-lg px-4 py-3 text-center w-full shadow-sm">
                                        <span class="block text-[10px] font-semibold text-amber-500 mb-1 uppercase tracking-wider">รหัสเข้างาน (OTP)</span>
                                        <span class="text-2xl font-mono font-bold tracking-[0.2em] text-amber-600">
                                            <?= htmlspecialchars($event['otp_code'] ?? '------') ?>
                                        </span>
                                        <span class="block text-[10px] text-amber-400 mt-1">*รหัสจะสุ่มใหม่ทุก 30 นาที</span>
                                    </div>

                                </div>
                            <?php elseif ($event['status'] === 'approved'): ?>
                                <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 p-3 rounded-xl flex items-center justify-center gap-2">
                                    <div class="flex flex-col text-center">
                                        <span class="font-bold text-sm">อนุมัติการเข้าร่วมแล้ว!</span>
                                        <span class="text-[10px] text-emerald-600 opacity-80">เมื่อ <?= date('d M Y', strtotime($event['registered_at'])) ?></span>
                                    </div>
                                </div>
                            <?php elseif ($event['status'] === 'rejected'): ?>
                                <div class="bg-rose-50 border border-rose-200 text-rose-700 p-3 rounded-xl flex items-center justify-center gap-2">
                                    <div class="flex flex-col text-center">
                                        <span class="font-bold text-sm">ไม่ได้รับสิทธิ์เข้าร่วม</span>
                                        <span class="text-[10px] text-rose-600 opacity-80">เมื่อ <?= date('d M Y', strtotime($event['registered_at'])) ?></span>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="bg-gray-50 border border-gray-200 text-gray-700 p-3 rounded-xl flex items-center justify-center gap-2">
                                    <span class="text-lg">❓</span>
                                    <div class="flex flex-col text-center">
                                        <span class="font-bold text-sm">สถานะไม่ทราบแน่ชัด</span>
                                    </div>
                                </div>
                            <?php endif; ?>
                            </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>
</body>

</html>