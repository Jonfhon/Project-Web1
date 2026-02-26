<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>แก้ไขกิจกรรม</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 p-10">
    <div class="max-w-3xl mx-auto bg-white p-8 rounded-xl shadow-md">
        <h2 class="text-2xl font-bold mb-6">แก้ไขข้อมูลกิจกรรม</h2>
        <form method="POST">
            <div class="space-y-4">
                <div><label class="font-bold">ชื่อกิจกรรม</label>
                <input type="text" name="title" value="<?= htmlspecialchars($data['event']['title']) ?>" class="w-full border p-2 rounded" required></div>
                <div><label class="font-bold">รายละเอียด</label>
                <textarea name="description" class="w-full border p-2 rounded"><?= htmlspecialchars($data['event']['description']) ?></textarea></div>
                <div><label class="font-bold">สถานที่</label>
                <input type="text" name="location" value="<?= htmlspecialchars($data['event']['location']) ?>" class="w-full border p-2 rounded" required></div>
                <div class="grid grid-cols-2 gap-4">
                    <div><label class="font-bold">เริ่ม</label>
                    <input type="datetime-local" name="start_event" value="<?= date('Y-m-d\TH:i', strtotime($data['event']['start_event'])) ?>" class="w-full border p-2 rounded" required></div>
                    <div><label class="font-bold">สิ้นสุด</label>
                    <input type="datetime-local" name="end_event" value="<?= date('Y-m-d\TH:i', strtotime($data['event']['end_event'])) ?>" class="w-full border p-2 rounded" required></div>
                </div>
                <div><label class="font-bold">จำนวนคนที่รับ</label>
                <input type="number" name="max_participants" value="<?= $data['event']['max_participants'] ?>" class="w-full border p-2 rounded" required></div>
            </div>
            <div class="mt-6 flex justify-end gap-3">
                <a href="my_events" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">ยกเลิก</a>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">บันทึกการแก้ไข</button>
            </div>
        </form>
    </div>
</body>
</html>