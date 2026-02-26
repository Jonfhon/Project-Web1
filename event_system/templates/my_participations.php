<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>รายการที่ขอเข้าร่วม - Event Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;600&display=swap');
        body { font-family: 'Sarabun', sans-serif; background-color: #f8fafc; }
    </style>
</head>
<body class="antialiased text-slate-800">

    <nav class="bg-indigo-600 shadow-md mb-10">
        <div class="max-w-5xl mx-auto px-4 h-16 flex justify-between items-center text-white">
            <h1 class="text-xl font-bold tracking-wide">รายการที่ขอเข้าร่วม</h1>
            <a href="dashboard" class="text-sm font-medium bg-indigo-700 hover:bg-indigo-800 px-4 py-2 rounded-xl transition">
                กลับหน้าหลัก
            </a>
        </div>
    </nav>

    <main class="max-w-5xl mx-auto px-4">
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-slate-800">ตรวจสอบสถานะการเข้าร่วม</h2>
            <p class="text-slate-500">ชื่อกิจกรรมที่คุณได้ส่งคำขอเข้าร่วมทั้งหมด</p>
        </div>

        <div class="bg-white rounded-[2rem] shadow-xl shadow-indigo-50 border border-indigo-50 overflow-hidden">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-indigo-50/50 text-indigo-700 border-b border-indigo-100">
                        <th class="p-6 text-sm font-bold uppercase tracking-wider">ชื่อกิจกรรมที่ขอเข้าร่วม</th>
                        <th class="p-6 text-sm font-bold uppercase tracking-wider text-center">วันที่จัดงาน</th>
                        <th class="p-6 text-sm font-bold uppercase tracking-wider text-center">สถานะการยืนยัน</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php if(!empty($data['participations'])): foreach ($data['participations'] as $row): ?>
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="p-6">
                            <span class="block font-bold text-slate-800 text-lg mb-1"><?= htmlspecialchars($row['title']) ?></span>
                            <span class="text-[10px] text-slate-400 uppercase tracking-widest font-semibold">Activity Request Sent</span>
                        </td>
                        <td class="p-6 text-center text-slate-600 font-medium">
                            <?= date('d/m/Y', strtotime($row['start_event'])) ?>
                        </td>
                        <td class="p-6 text-center">
                            <?php if($row['reg_status'] == 'pending'): ?>
                                <span class="inline-block bg-amber-50 text-amber-600 px-4 py-1.5 rounded-full text-xs font-bold ring-1 ring-amber-200">
                                    รอการอนุมัติ
                                </span>
                            <?php elseif($row['reg_status'] == 'approved'): ?>
                                <span class="inline-block bg-emerald-50 text-emerald-600 px-4 py-1.5 rounded-full text-xs font-bold ring-1 ring-emerald-200">
                                    อนุมัติแล้ว
                                </span>
                            <?php else: ?>
                                <span class="inline-block bg-rose-50 text-rose-600 px-4 py-1.5 rounded-full text-xs font-bold ring-1 ring-rose-200">
                                    ถูกปฏิเสธ
                                </span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; else: ?>
                    <tr>
                        <td colspan="3" class="p-20 text-center text-slate-400">ยังไม่มีรายการที่คุณส่งคำขอเข้าร่วม</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>