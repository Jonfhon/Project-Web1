<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>รายชื่อผู้สมัคร - Event Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;600&display=swap');
        body { font-family: 'Sarabun', sans-serif; }
        
        .custom-scrollbar::-webkit-scrollbar { height: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #f8fafc; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>

<body class="bg-slate-100 font-sans text-gray-800 antialiased">

    <nav class="bg-indigo-600 shadow-md">
        <div class="max-w-6xl mx-auto px-4 h-16 flex justify-between items-center text-white">
            <div class="text-lg sm:text-xl font-bold tracking-wide">จัดการกิจกรรม</div>
            <a href="dashboard" class="text-indigo-100 hover:text-white font-medium text-xs sm:text-sm transition bg-indigo-700 sm:bg-transparent px-3 py-1.5 sm:p-0 rounded-lg sm:rounded-none">
                &larr; กลับหน้าหลัก
            </a>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto px-4 py-6 sm:py-10 pb-20">
        <div class="mb-6">
            <a href="my_events" class="text-indigo-600 hover:text-indigo-800 text-sm font-semibold flex items-center gap-1 mb-4 inline-block">
                &larr; กลับไปกิจกรรมของฉัน
            </a>
            <h2 class="text-xl sm:text-2xl font-bold text-slate-800">รายชื่อผู้ขอเข้าร่วม</h2>
            <p class="text-sm sm:text-base text-slate-500 mt-1">กิจกรรม: <span class="font-semibold text-indigo-600"><?php echo htmlspecialchars($data['event']['title'] ?? ''); ?></span></p>
        </div>

        <?php 
            $stat_total   = $data['stat_total'] ?? 0;
            $gender_male  = $data['gender_male'] ?? 0;
            $gender_female= $data['gender_female'] ?? 0;
            $gender_other = $data['gender_other'] ?? 0;
            
            $age_under_18 = $data['age_under_18'] ?? 0;
            $age_18_25    = $data['age_18_25'] ?? 0;
            $age_26_35    = $data['age_26_35'] ?? 0;
            $age_36_45    = $data['age_36_45'] ?? 0;
            $age_over_45  = $data['age_over_45'] ?? 0;
        ?>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 sm:gap-6 mb-8">
            
            <div class="bg-white p-6 sm:p-8 rounded-2xl sm:rounded-[2rem] shadow-sm border border-slate-100">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg sm:text-xl font-bold text-slate-800 flex items-center gap-2">
                        <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        สัดส่วนเพศ
                    </h3>
                    <span class="text-sm font-bold text-indigo-600 bg-indigo-50 px-3 py-1 rounded-full">รวม <?= $stat_total ?> คน</span>
                </div>

                <div class="space-y-5">
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="font-bold text-blue-600 flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                ชาย
                            </span>
                            <span class="font-bold text-slate-600"><?= $gender_male ?> คน</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-3 sm:h-4 overflow-hidden">
                            <div class="bg-blue-500 h-3 sm:h-4 rounded-full transition-all duration-500" style="width: <?= ($stat_total > 0) ? round(($gender_male / $stat_total) * 100) : 0 ?>%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="font-bold text-pink-600 flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                หญิง
                            </span>
                            <span class="font-bold text-slate-600"><?= $gender_female ?> คน</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-3 sm:h-4 overflow-hidden">
                            <div class="bg-pink-500 h-3 sm:h-4 rounded-full transition-all duration-500" style="width: <?= ($stat_total > 0) ? round(($gender_female / $stat_total) * 100) : 0 ?>%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="font-bold text-purple-600 flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                อื่นๆ
                            </span>
                            <span class="font-bold text-slate-600"><?= $gender_other ?> คน</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-3 sm:h-4 overflow-hidden">
                            <div class="bg-purple-500 h-3 sm:h-4 rounded-full transition-all duration-500" style="width: <?= ($stat_total > 0) ? round(($gender_other / $stat_total) * 100) : 0 ?>%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 sm:p-8 rounded-2xl sm:rounded-[2rem] shadow-sm border border-slate-100">
                <h3 class="text-lg sm:text-xl font-bold text-slate-800 flex items-center gap-2 mb-6">
                    <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    ช่วงอายุผู้เข้าร่วม
                </h3>

                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-20 text-xs sm:text-sm font-bold text-slate-500 text-right">ต่ำกว่า 18 ปี</div>
                        <div class="flex-1 bg-slate-100 rounded-full h-3 sm:h-4 overflow-hidden flex">
                            <div class="bg-emerald-400 h-full rounded-full transition-all duration-500" style="width: <?= ($stat_total > 0) ? round(($age_under_18 / $stat_total) * 100) : 0 ?>%"></div>
                        </div>
                        <div class="w-12 text-xs sm:text-sm font-bold text-slate-700"><?= $age_under_18 ?> <span class="text-slate-400 font-normal text-[10px]">คน</span></div>
                    </div>
                    
                    <div class="flex items-center gap-3">
                        <div class="w-20 text-xs sm:text-sm font-bold text-slate-500 text-right">18 - 25 ปี</div>
                        <div class="flex-1 bg-slate-100 rounded-full h-3 sm:h-4 overflow-hidden flex">
                            <div class="bg-teal-500 h-full rounded-full transition-all duration-500" style="width: <?= ($stat_total > 0) ? round(($age_18_25 / $stat_total) * 100) : 0 ?>%"></div>
                        </div>
                        <div class="w-12 text-xs sm:text-sm font-bold text-slate-700"><?= $age_18_25 ?> <span class="text-slate-400 font-normal text-[10px]">คน</span></div>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="w-20 text-xs sm:text-sm font-bold text-slate-500 text-right">26 - 35 ปี</div>
                        <div class="flex-1 bg-slate-100 rounded-full h-3 sm:h-4 overflow-hidden flex">
                            <div class="bg-cyan-500 h-full rounded-full transition-all duration-500" style="width: <?= ($stat_total > 0) ? round(($age_26_35 / $stat_total) * 100) : 0 ?>%"></div>
                        </div>
                        <div class="w-12 text-xs sm:text-sm font-bold text-slate-700"><?= $age_26_35 ?> <span class="text-slate-400 font-normal text-[10px]">คน</span></div>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="w-20 text-xs sm:text-sm font-bold text-slate-500 text-right">36 - 45 ปี</div>
                        <div class="flex-1 bg-slate-100 rounded-full h-3 sm:h-4 overflow-hidden flex">
                            <div class="bg-sky-500 h-full rounded-full transition-all duration-500" style="width: <?= ($stat_total > 0) ? round(($age_36_45 / $stat_total) * 100) : 0 ?>%"></div>
                        </div>
                        <div class="w-12 text-xs sm:text-sm font-bold text-slate-700"><?= $age_36_45 ?> <span class="text-slate-400 font-normal text-[10px]">คน</span></div>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="w-20 text-xs sm:text-sm font-bold text-slate-500 text-right">45 ปีขึ้นไป</div>
                        <div class="flex-1 bg-slate-100 rounded-full h-3 sm:h-4 overflow-hidden flex">
                            <div class="bg-indigo-400 h-full rounded-full transition-all duration-500" style="width: <?= ($stat_total > 0) ? round(($age_over_45 / $stat_total) * 100) : 0 ?>%"></div>
                        </div>
                        <div class="w-12 text-xs sm:text-sm font-bold text-slate-700"><?= $age_over_45 ?> <span class="text-slate-400 font-normal text-[10px]">คน</span></div>
                    </div>
                </div>
            </div>
            
        </div>

        <div class="bg-white rounded-xl sm:rounded-[2rem] shadow-sm border border-indigo-100 p-5 sm:p-8 mb-8 flex flex-col md:flex-row items-center justify-between gap-5 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-50 rounded-bl-[100px] -z-10 opacity-50"></div>
            
            <div class="w-full md:w-auto text-center md:text-left z-10">
                <h3 class="text-lg font-bold text-indigo-700 flex items-center justify-center md:justify-start gap-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    ระบบสแกนเข้างาน (Check-in)
                </h3>
                <p class="text-xs sm:text-sm text-gray-500 mt-1">กรอกรหัส OTP 6 หลักที่ผู้เข้าร่วมนำมาแสดงเพื่อบันทึกเวลาเข้างาน</p>
            </div>

            <form action="process_checkin" method="POST" class="flex flex-col sm:flex-row w-full md:w-auto gap-3 z-10">
                <input type="hidden" name="event_id" value="<?= htmlspecialchars($data['event']['event_id'] ?? '') ?>">
                
                <input type="text" name="otp_code" maxlength="6" pattern="\d{6}" placeholder="------" required autofocus
                    class="w-full sm:w-48 px-4 py-3 sm:py-4 border-2 border-gray-300 rounded-xl text-2xl text-center tracking-[0.3em] font-mono font-bold text-indigo-600 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '')" autocomplete="off">
                
                <button type="submit" class="w-full sm:w-auto bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 sm:py-4 px-6 rounded-xl transition shadow-md whitespace-nowrap">
                    ยืนยันรหัส
                </button>
            </form>
        </div>

        <div class="bg-white rounded-xl sm:rounded-2xl shadow-md border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto custom-scrollbar">
                <table class="w-full text-left border-collapse min-w-[800px]">
                    <thead>
                        <tr class="bg-gray-50 text-gray-600 border-b border-gray-200">
                            <th class="p-4 sm:p-5 text-xs sm:text-sm font-semibold pl-6">ลำดับ</th>
                            <th class="p-4 sm:p-5 text-xs sm:text-sm font-semibold">ชื่อ-นามสกุล</th>
                            <th class="p-4 sm:p-5 text-xs sm:text-sm font-semibold">ข้อมูลติดต่อ (อีเมล)</th>
                            <th class="p-4 sm:p-5 text-xs sm:text-sm font-semibold">เพศ / จังหวัด</th>
                            <th class="p-4 sm:p-5 text-xs sm:text-sm font-semibold text-center">วันที่ลงทะเบียน</th>
                            <th class="p-4 sm:p-5 text-xs sm:text-sm font-semibold text-center pr-6">สถานะ / เช็คอิน</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php if (!empty($data['participants'])): ?>
                            <?php foreach ($data['participants'] as $index => $p): ?>
                                <tr class="hover:bg-indigo-50/50 transition">
                                    <td class="p-4 sm:p-5 pl-6 text-gray-500 font-medium text-sm sm:text-base"><?php echo $index + 1; ?></td>

                                    <td class="p-4 sm:p-5 font-bold text-indigo-600 hover:underline text-sm sm:text-base">
                                        <a href="view_user?id=<?= $p['UID'] ?>"><?php echo htmlspecialchars($p['name']); ?></a>
                                    </td>

                                    <td class="p-4 sm:p-5 text-gray-600 text-sm"><?php echo htmlspecialchars($p['email']); ?></td>
                                    <td class="p-4 sm:p-5 text-gray-600 text-sm"><?php echo htmlspecialchars($p['gender']) . ' / ' . htmlspecialchars($p['province']); ?></td>
                                    <td class="p-4 sm:p-5 text-center text-gray-600 text-sm"><?php echo date('d/m/Y H:i', strtotime($p['registered_at'])); ?></td>

                                    <td class="p-4 sm:p-5 text-center pr-6">
                                        <?php if ($p['status'] === 'pending'): ?>
                                            <div class="flex justify-center gap-2">
                                                <a href="update_status?reg_id=<?= $p['reg_id'] ?>&status=approved&event_id=<?= $data['event']['event_id'] ?>"
                                                    class="bg-emerald-500 hover:bg-emerald-600 text-white px-3 py-1.5 rounded-lg text-xs font-bold shadow-sm transition active:scale-95">อนุมัติ</a>
                                                <a href="update_status?reg_id=<?= $p['reg_id'] ?>&status=rejected&event_id=<?= $data['event']['event_id'] ?>"
                                                    class="bg-rose-500 hover:bg-rose-600 text-white px-3 py-1.5 rounded-lg text-xs font-bold shadow-sm transition active:scale-95">ปฏิเสธ</a>
                                            </div>
                                        
                                        <?php elseif ($p['status'] === 'approved'): ?>
                                            <?php if (isset($p['is_checked_in']) && $p['is_checked_in'] == 1): ?>
                                                <div class="flex flex-col items-center gap-1">
                                                    <span class="inline-flex items-center gap-1 bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full text-xs font-bold border border-emerald-200">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                        เข้าร่วมงาน
                                                    </span>
                                                    <span class="text-[10px] sm:text-xs text-gray-500 font-semibold bg-gray-50 px-2 rounded">
                                                        เวลา: <?= date('H:i:s', strtotime($p['checkin_time'])) ?> น.
                                                    </span>
                                                </div>
                                            <?php else: ?>
                                                <div class="flex flex-col items-center gap-1">
                                                    <span class="inline-block bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-bold">อนุมัติแล้ว</span>
                                                    <span class="text-[10px] text-gray-400 font-medium">รอสแกนเข้างาน</span>
                                                </div>
                                            <?php endif; ?>

                                        <?php else: ?>
                                            <span class="inline-block bg-rose-100 text-rose-700 px-3 py-1 rounded-full text-xs font-bold">ปฏิเสธแล้ว</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="p-12 sm:p-16 text-center text-gray-400 font-medium text-sm sm:text-base">ยังไม่มีผู้ลงทะเบียนขอเข้าร่วมกิจกรรมนี้</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>

</html>