<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>โปรไฟล์ของฉัน - Event Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100 font-sans text-gray-800 antialiased">

    <nav class="bg-indigo-600 shadow-md">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="text-xl font-bold text-white tracking-wide">
                    จัดการกิจกรรม
                </div>
                <a href="dashboard"
                    class="text-indigo-100 hover:text-white font-medium text-sm transition duration-150 ease-in-out">
                    &larr; กลับหน้าหลัก
                </a>
            </div>
        </div>
    </nav>

    <main class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="bg-white rounded-2xl shadow-md overflow-hidden border border-gray-100">

            <div class="bg-gradient-to-r from-indigo-500 to-indigo-600 px-8 py-5">
                <h2 class="text-2xl font-bold text-white">ข้อมูลส่วนตัว</h2>
                <p class="text-indigo-100 text-sm mt-1">รายละเอียดโปรไฟล์ของคุณ</p>
            </div>

            <div class="p-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-8 gap-x-10">

                    <div>
                        <p class="text-sm font-medium text-gray-400 mb-1">ชื่อ-นามสกุล</p>
                        <p class="text-lg font-semibold text-gray-800">
                            <?php echo htmlspecialchars($data['name'] ?? '-'); ?>
                        </p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-400 mb-1">อีเมล</p>
                        <p class="text-lg font-semibold text-gray-800">
                            <?php echo htmlspecialchars($data['email'] ?? '-'); ?>
                        </p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-400 mb-1">เพศ</p>
                        <p class="text-lg font-semibold text-gray-800">
                            <?php echo htmlspecialchars($data['gender'] ?? '-'); ?>
                        </p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-400 mb-1">วัน/เดือน/ปีเกิด</p>
                        <p class="text-lg font-semibold text-gray-800">
                            <?php echo htmlspecialchars($data['date_of_birth'] ?? '-'); ?>
                        </p>
                    </div>

                    <div class="sm:col-span-2">
                        <p class="text-sm font-medium text-gray-400 mb-1">จังหวัด</p>
                        <p class="text-lg font-semibold text-gray-800">
                            <?php echo htmlspecialchars($data['province'] ?? '-'); ?>
                        </p>
                    </div>

                </div>

                <div class="mt-10 pt-6 border-t border-gray-100 flex justify-end">
<a href="edit_profile" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold py-2.5 px-6 rounded-lg shadow-sm transition duration-200 inline-block text-center">
    แก้ไขข้อมูล
</a>
                </div>
            </div>

        </div>
    </main>

</body>

</html>