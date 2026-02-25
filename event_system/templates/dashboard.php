<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>หน้าหลัก - Event Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 font-sans text-gray-800 antialiased">

    <nav class="bg-indigo-600 shadow-md">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                
                <div class="flex items-center gap-8">
                    <div class="text-xl font-bold text-white tracking-wide">
                        จัดการกิจกรรม
                    </div>
                    
                    <div class="hidden sm:flex items-center space-x-2">
                        <a href="#" class="text-indigo-100 hover:text-white hover:bg-indigo-700 px-3 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out">
                            กิจกรรมของฉัน
                        </a>
                        <a href="#" class="text-indigo-100 hover:text-white hover:bg-indigo-700 px-3 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out">
                            สร้างกิจกรรม
                        </a>
                        <a href="profile" class="text-indigo-100 hover:text-white hover:bg-indigo-700 px-3 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out">
                            โปรไฟล์
                        </a>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <a href="logout" class="bg-indigo-700 hover:bg-indigo-800 text-white text-sm font-semibold py-2 px-4 rounded-lg transition duration-200 ease-in-out shadow-sm">
                        ออกจากระบบ
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-gradient-to-r from-indigo-500 to-purple-600 rounded-2xl shadow-lg p-8 text-white mb-8">
            <h2 class="text-3xl font-bold mb-3">ยินดีต้อนรับเข้าสู่ระบบ! 🎉</h2>
            <p class="text-indigo-100 leading-relaxed text-lg max-w-2xl">
                คุณสามารถค้นหากิจกรรมที่น่าสนใจเพื่อเข้าร่วม หรือสร้างกิจกรรมของคุณเองเพื่อชวนเพื่อนๆ มาร่วมสนุกได้เลย
            </p>
        </div>
    </main>

</body>
</html>