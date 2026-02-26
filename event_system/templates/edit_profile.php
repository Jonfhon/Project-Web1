<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>แก้ไขโปรไฟล์ - Event Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 font-sans text-gray-800 antialiased">

    <nav class="bg-indigo-600 shadow-md">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="text-xl font-bold text-white tracking-wide">จัดการกิจกรรม</div>
                <a href="profile" class="text-indigo-100 hover:text-white font-medium text-sm transition duration-150 ease-in-out">
                    &larr; ยกเลิก
                </a>
            </div>
        </div>
    </nav>

    <main class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="bg-white rounded-2xl shadow-md overflow-hidden border border-gray-100">
            
            <div class="bg-gradient-to-r from-indigo-500 to-indigo-600 px-8 py-5">
                <h2 class="text-2xl font-bold text-white">แก้ไขข้อมูลส่วนตัว</h2>
            </div>

            <form action="edit_profile" method="POST" class="p-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-10">
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">ชื่อ-นามสกุล</label>
                        <input type="text" name="name" value="<?php echo htmlspecialchars($data['name'] ?? ''); ?>" required 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">อีเมล</label>
                        <input type="email" name="email" value="<?php echo htmlspecialchars($data['email'] ?? ''); ?>" required 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">เพศ</label>
                        <select name="gender" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                            <option value="ชาย" <?php echo ($data['gender'] ?? '') == 'ชาย' ? 'selected' : ''; ?>>ชาย</option>
                            <option value="หญิง" <?php echo ($data['gender'] ?? '') == 'หญิง' ? 'selected' : ''; ?>>หญิง</option>
                            <option value="อื่นๆ" <?php echo ($data['gender'] ?? '') == 'อื่นๆ' ? 'selected' : ''; ?>>อื่นๆ</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">วัน/เดือน/ปีเกิด</label>
                        <input type="date" name="date_of_birth" value="<?php echo htmlspecialchars($data['date_of_birth'] ?? ''); ?>" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-600 mb-2">จังหวัด</label>
                        <input type="text" name="province" value="<?php echo htmlspecialchars($data['province'] ?? ''); ?>" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                    </div>

                </div>

                <div class="mt-8 pt-6 border-t border-gray-100 flex justify-end gap-4">
                    <a href="profile" class="px-6 py-2.5 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition">ยกเลิก</a>
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2.5 px-6 rounded-lg shadow-sm transition duration-200">
                        บันทึกข้อมูล
                    </button>
                </div>
            </form>
            
        </div>
    </main>

</body>
</html>