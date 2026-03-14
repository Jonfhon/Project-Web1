<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <title>รายการที่ขอเข้าร่วม - Event Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;600&display=swap');
        body { font-family: 'Sarabun', sans-serif; background-color: #f8fafc; }
        
        /* ปรับแต่ง Scrollbar สำหรับตารางบนมือถือให้ดูเรียบร้อยขึ้น */
        .custom-scrollbar::-webkit-scrollbar { height: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #f1f5f9; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>
<body class="antialiased text-slate-800">

    <nav class="bg-indigo-600 shadow-md mb-6 sm:mb-10">
        <div class="max-w-5xl mx-auto px-4 h-16 flex justify-between items-center text-white">
            <h1 class="text-lg sm:text-xl font-bold tracking-wide">รายการที่ขอเข้าร่วม</h1>
            <a href="dashboard" class="text-xs sm:text-sm font-medium bg-indigo-700 hover:bg-indigo-800 px-3 py-1.5 sm:px-4 sm:py-2 rounded-lg sm:rounded-xl transition whitespace-nowrap">
                กลับหน้าหลัก
            </a>
        </div>
    </nav>

    <main class="max-w-5xl mx-auto px-4 pb-20">
        <div class="mb-6 sm:mb-8">
            <h2 class="text-xl sm:text-2xl font-bold text-slate-800">ตรวจสอบสถานะการเข้าร่วม</h2>
            <p class="text-sm sm:text-base text-slate-500 mt-1">ชื่อกิจกรรมที่คุณได้ส่งคำขอเข้าร่วมทั้งหมด</p>
        </div>

        <div class="bg-white rounded-2xl sm:rounded-[2rem] shadow-xl shadow-indigo-50 border border-indigo-50 overflow-hidden">
            <div class="overflow-x-auto custom-scrollbar">
                <table class="w-full text-left min-w-[600px]">
                    <thead>
                        <tr class="bg-indigo-50/50 text-indigo-700 border-b border-indigo-100">
                            <th class="p-4 sm:p-6 text-xs sm:text-sm font-bold uppercase tracking-wider">ชื่อกิจกรรมที่ขอเข้าร่วม</th>
                            <th class="p-4 sm:p-6 text-xs sm:text-sm font-bold uppercase tracking-wider text-center">วันที่จัดงาน</th>
                            <th class="p-4 sm:p-6 text-xs sm:text-sm font-bold uppercase tracking-wider text-center">สถานะการยืนยัน</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <?php if(!empty($data['participations'])): foreach ($data['participations'] as $row): ?>
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="p-4 sm:p-6">
                                <span class="block font-bold text-slate-800 text-base sm:text-lg mb-1"><?= htmlspecialchars($row['title']) ?></span>
                                <span class="text-[9px] sm:text-[10px] text-slate-400 uppercase tracking-widest font-semibold">Activity Request Sent</span>
                            </td>
                            <td class="p-4 sm:p-6 text-center text-slate-600 font-medium text-sm sm:text-base whitespace-nowrap">
                                <?= date('d/m/Y', strtotime($row['start_event'])) ?>
                            </td>
                            <td class="p-4 sm:p-6 text-center whitespace-nowrap">
                                <?php if($row['reg_status'] == 'pending'): ?>
                                    <span class="inline-block bg-amber-50 text-amber-600 px-3 py-1 sm:px-4 sm:py-1.5 rounded-full text-[10px] sm:text-xs font-bold ring-1 ring-amber-200">
                                        รอการอนุมัติ
                                    </span>
                                <?php elseif($row['reg_status'] == 'approved'): ?>
                                    <span class="inline-block bg-emerald-50 text-emerald-600 px-3 py-1 sm:px-4 sm:py-1.5 rounded-full text-[10px] sm:text-xs font-bold ring-1 ring-emerald-200">
                                        อนุมัติแล้ว
                                    </span>
                                <?php else: ?>
                                    <span class="inline-block bg-rose-50 text-rose-600 px-3 py-1 sm:px-4 sm:py-1.5 rounded-full text-[10px] sm:text-xs font-bold ring-1 ring-rose-200">
                                        ถูกปฏิเสธ
                                    </span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr>
                            <td colspan="3" class="p-12 sm:p-20 text-center text-slate-400 text-sm sm:text-base">ยังไม่มีรายการที่คุณส่งคำขอเข้าร่วม</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>