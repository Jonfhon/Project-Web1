<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>รายชื่อผู้สมัคร - Event Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100 font-sans text-gray-800 antialiased">

    <nav class="bg-indigo-600 shadow-md">
        <div class="max-w-6xl mx-auto px-4 h-16 flex justify-between items-center text-white">
            <div class="text-xl font-bold tracking-wide">จัดการกิจกรรม</div>
            <a href="dashboard" class="text-indigo-100 hover:text-white font-medium text-sm transition">
                &larr; กลับหน้าหลัก
            </a>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto px-4 py-10">
        <div class="mb-6">
            <a href="my_events" class="text-indigo-600 hover:text-indigo-800 text-sm font-semibold flex items-center gap-1 mb-4">
                &larr; กลับไปกิจกรรมของฉัน
            </a>
            <h2 class="text-2xl font-bold text-slate-800">รายชื่อผู้ขอเข้าร่วม</h2>
            <p class="text-slate-500 mt-1">กิจกรรม: <span class="font-semibold text-indigo-600"><?php echo htmlspecialchars($data['event']['title']); ?></span></p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-indigo-100 p-6 mb-8 flex flex-col md:flex-row items-center justify-between gap-4">
            <div>
                <h3 class="text-lg font-bold text-indigo-700 flex items-center gap-2">
                    <span class="text-2xl">📱</span> ระบบสแกนเข้างาน (Check-in)
                </h3>
                <p class="text-sm text-gray-500 mt-1">กรอกรหัส OTP 6 หลักที่ผู้เข้าร่วมนำมาแสดงเพื่อบันทึกเวลาเข้างาน</p>
            </div>

            <form action="process_checkin" method="POST" class="flex w-full md:w-auto gap-3">
                <input type="hidden" name="event_id" value="<?= htmlspecialchars($data['event']['event_id'] ?? '') ?>">
                
                <input type="text" name="otp_code" maxlength="6" pattern="\d{6}" placeholder="------" required autofocus
                    class="w-full md:w-48 px-4 py-3 border-2 border-gray-300 rounded-lg text-2xl text-center tracking-[0.3em] font-mono font-bold text-indigo-600 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '')" autocomplete="off">
                
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-lg transition shadow-md whitespace-nowrap">
                    ยืนยันรหัส
                </button>
            </form>
        </div>

        <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 text-gray-600 border-b border-gray-200">
                            <th class="p-4 text-sm font-semibold pl-6">ลำดับ</th>
                            <th class="p-4 text-sm font-semibold">ชื่อ-นามสกุล</th>
                            <th class="p-4 text-sm font-semibold">ข้อมูลติดต่อ (อีเมล)</th>
                            <th class="p-4 text-sm font-semibold">เพศ / จังหวัด</th>
                            <th class="p-4 text-sm font-semibold text-center">วันที่ลงทะเบียน</th>
                            <th class="p-4 text-sm font-semibold text-center pr-6">สถานะ / เช็คอิน</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php if (!empty($data['participants'])): ?>
                            <?php foreach ($data['participants'] as $index => $p): ?>
                                <tr class="hover:bg-indigo-50/50 transition">
                                    <td class="p-4 pl-6 text-gray-500 font-medium"><?php echo $index + 1; ?></td>

                                    <td class="p-4 font-bold text-indigo-600 hover:underline">
                                        <a href="view_user?id=<?= $p['UID'] ?>"><?php echo htmlspecialchars($p['name']); ?></a>
                                    </td>

                                    <td class="p-4 text-gray-600 text-sm"><?php echo htmlspecialchars($p['email']); ?></td>
                                    <td class="p-4 text-gray-600 text-sm"><?php echo htmlspecialchars($p['gender']) . ' / ' . htmlspecialchars($p['province']); ?></td>
                                    <td class="p-4 text-center text-gray-600 text-sm"><?php echo date('d/m/Y H:i', strtotime($p['registered_at'])); ?></td>

                                    <td class="p-4 text-center pr-6">
                                        <?php if ($p['status'] === 'pending'): ?>
                                            <div class="flex justify-center gap-2">
                                                <a href="update_status?reg_id=<?= $p['reg_id'] ?>&status=approved&event_id=<?= $data['event']['event_id'] ?>"
                                                    class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-xs font-bold shadow-sm">อนุมัติ</a>
                                                <a href="update_status?reg_id=<?= $p['reg_id'] ?>&status=rejected&event_id=<?= $data['event']['event_id'] ?>"
                                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs font-bold shadow-sm">ปฏิเสธ</a>
                                            </div>
                                        
                                        <?php elseif ($p['status'] === 'approved'): ?>
                                            <?php if (isset($p['is_checked_in']) && $p['is_checked_in'] == 1): ?>
                                                <div class="flex flex-col items-center gap-1">
                                                    <span class="inline-block bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full text-xs font-bold border border-emerald-200">
                                                        ✅ เข้าร่วมงาน
                                                    </span>
                                                    <span class="text-[10px] text-gray-500 font-semibold bg-gray-50 px-2 rounded">
                                                        เวลา: <?= date('H:i:s', strtotime($p['checkin_time'])) ?> น.
                                                    </span>
                                                </div>
                                            <?php else: ?>
                                                <div class="flex flex-col items-center gap-1">
                                                    <span class="inline-block bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-bold">อนุมัติแล้ว</span>
                                                    <span class="text-[10px] text-gray-400">รอสแกนเข้างาน</span>
                                                </div>
                                            <?php endif; ?>

                                        <?php else: ?>
                                            <span class="inline-block bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold">ปฏิเสธแล้ว</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="p-12 text-center text-gray-400 font-medium">ยังไม่มีผู้ลงทะเบียนขอเข้าร่วมกิจกรรมนี้</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>

</html>