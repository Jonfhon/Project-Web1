<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>หน้าหลัก - Event Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>@import url('https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;600&display=swap'); body { font-family: 'Sarabun', sans-serif; }</style>
</head>
<body class="bg-slate-100 antialiased">
<nav class="bg-indigo-600 shadow-md">
        <div class="max-w-5xl mx-auto px-4 h-16 flex justify-between items-center text-white">
            <div class="flex items-center gap-8">
                <div class="text-xl font-bold">จัดการกิจกรรม</div>
                <div class="hidden sm:flex items-center space-x-2">
                    <a href="dashboard" class="bg-indigo-700 px-3 py-2 rounded-md text-sm font-medium">หน้าหลัก</a>
                    <a href="my_events" class="text-indigo-100 hover:text-white hover:bg-indigo-700 px-3 py-2 rounded-md text-sm font-medium transition">กิจกรรมของฉัน</a>
                    <a href="add_event" class="text-indigo-100 hover:text-white hover:bg-indigo-700 px-3 py-2 rounded-md text-sm font-medium transition">สร้างกิจกรรม</a>
                    <a href="joined_events" class="text-indigo-100 hover:text-white hover:bg-indigo-700 px-3 py-2 rounded-md text-sm font-medium transition">กิจกรรมที่ลงทะเบียน</a>
                </div>
            </div>
            <a href="logout" class="bg-indigo-700 hover:bg-indigo-800 px-4 py-2 rounded-lg text-sm font-semibold transition">ออกจากระบบ</a>
        </div>
    </nav>

    <main class="max-w-5xl mx-auto px-4 py-8">
        <div class="bg-gradient-to-r from-indigo-500 to-purple-600 rounded-2xl shadow-lg p-8 text-white mb-8">
            <h2 class="text-3xl font-bold mb-3">ยินดีต้อนรับ!</h2>
            <p class="text-indigo-100 text-lg">ค้นหากิจกรรมที่น่าสนใจ หรือสร้างกิจกรรมของคุณเองได้เลย</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php foreach ($data['events'] as $event): ?>
    <div class="bg-white rounded-2xl shadow-md overflow-hidden border border-gray-100 group">
        
        <div class="h-48 bg-slate-200 overflow-hidden">
            <?php if (!empty($event['image_path'])): ?>
                <img src="assets/uploads/<?= htmlspecialchars($event['image_path']) ?>" 
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
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

            <form action="join_event" method="POST">
                <input type="hidden" name="event_id" value="<?= $event['event_id'] ?>">
                <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-xl font-bold shadow-lg shadow-indigo-100 hover:bg-indigo-700 hover:shadow-indigo-200 active:scale-[0.98] transition-all">
                    JOIN เข้าร่วมกิจกรรม
                </button>
            </form>
        </div>
    </div>
    <?php endforeach; ?>
</div>
    </main>
</body>
</html>