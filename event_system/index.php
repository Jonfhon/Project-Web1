<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบจัดการกิจกรรม - Event Hub</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 h-screen overflow-hidden">
    <nav class="bg-white border-b border-gray-200">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-14">
                <a href="index.php" class="text-xl font-bold text-blue-600 hover:text-blue-700 transition cursor-pointer">Event Hub</a>

                <div class="flex gap-3">
                    <a href="views/login.php" class="px-5 py-2 text-sm text-gray-700 hover:text-blue-600 font-medium transition">
                        เข้าสู่ระบบ
                    </a>
                    <a href="views/register.php" class="px-5 py-2 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium transition">
                        สมัครสมาชิก
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="h-[calc(100vh-56px)] overflow-auto">
        <section class="bg-gradient-to-b from-blue-50 to-transparent py-12">
            <div class="max-w-3xl mx-auto px-4 text-center">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">
                    ค้นหา สร้าง เข้าร่วมกิจกรรม
                </h1>
                <p class="text-base text-gray-600 mb-8">
                    เชื่อมต่อกับชุมชน และค้นพบกิจกรรมที่ตรงกับความสนใจของคุณ
                </p>
                <div class="flex gap-3 justify-center">
                    <a href="views/register.php" class="px-6 py-2 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium transition">
                        เริ่มใช้งาน
                    </a>
                    <a href="views/login.php" class="px-6 py-2 text-sm border border-gray-300 text-gray-900 rounded-lg hover:bg-white font-medium transition">
                        เข้าสู่ระบบ
                    </a>
                </div>
            </div>
        </section>
        <section class="py-12">
            <div class="max-w-5xl mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white p-6 rounded-lg border border-gray-200 hover:shadow-md transition">
                        <div class="text-3xl mb-3">🔍</div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">ค้นหากิจกรรม</h3>
                        <p class="text-sm text-gray-600">ค้นหาและกรองกิจกรรมตามสนใจของคุณ</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg border border-gray-200 hover:shadow-md transition">
                        <div class="text-3xl mb-3">📝</div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">สร้างกิจกรรม</h3>
                        <p class="text-sm text-gray-600">จัดทำกิจกรรมของคุณและเชิญเพื่อนได้ง่ายๆ</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg border border-gray-200 hover:shadow-md transition">
                        <div class="text-3xl mb-3">👥</div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">เชื่อมต่อชุมชน</h3>
                        <p class="text-sm text-gray-600">พบปะคนที่มีความสนใจเดียวกัน</p>
                    </div>
                </div>
            </div>
        </section>
</body>
</html>
