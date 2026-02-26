<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ข้อมูลผู้สมัคร</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 py-10">
    <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-md overflow-hidden">
        <div class="bg-indigo-600 px-6 py-4 text-white">
            <h2 class="text-xl font-bold">ประวัติผู้สมัคร</h2>
        </div>
        <div class="p-6 grid grid-cols-2 gap-4 text-lg">
            <div><span class="text-gray-500 text-sm block">ชื่อ-นามสกุล</span><span class="font-bold"><?= htmlspecialchars($data['user']['name']) ?></span></div>
            <div><span class="text-gray-500 text-sm block">อีเมล</span><span><?= htmlspecialchars($data['user']['email']) ?></span></div>
            <div><span class="text-gray-500 text-sm block">เพศ</span><span><?= htmlspecialchars($data['user']['gender']) ?></span></div>
            <div><span class="text-gray-500 text-sm block">วันเกิด</span><span><?= htmlspecialchars($data['user']['date_of_birth']) ?></span></div>
            <div class="col-span-2"><span class="text-gray-500 text-sm block">จังหวัด</span><span><?= htmlspecialchars($data['user']['province']) ?></span></div>
        </div>
        <div class="px-6 py-4 bg-gray-50 text-right border-t">
            <button onclick="window.history.back()" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">ย้อนกลับ</button>
        </div>
    </div>
</body>
</html>