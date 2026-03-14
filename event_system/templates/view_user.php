<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>ข้อมูลผู้สมัคร - Event Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;600&display=swap');
        body { font-family: 'Sarabun', sans-serif; }
    </style>
</head>
<body class="bg-slate-100 min-h-screen flex justify-center items-center py-10 px-4 antialiased">
    
    <div class="w-full max-w-2xl bg-white rounded-3xl sm:rounded-[2rem] shadow-xl shadow-slate-200/50 overflow-hidden border border-slate-50">
        
        <div class="bg-gradient-to-r from-indigo-600 to-indigo-800 px-6 sm:px-10 py-8 sm:py-10 text-white relative overflow-hidden flex flex-col sm:flex-row items-center gap-4 sm:gap-6 text-center sm:text-left">
            <div class="w-20 h-20 sm:w-24 sm:h-24 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center border-4 border-white/30 shadow-inner shrink-0 text-white">
                <svg class="w-10 h-10 sm:w-12 sm:h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            </div>
            <div>
                <h2 class="text-xs sm:text-sm font-bold tracking-widest text-indigo-200 uppercase mb-1">ประวัติผู้สมัคร</h2>
                <h3 class="text-2xl sm:text-3xl font-bold"><?= htmlspecialchars($data['user']['name']) ?></h3>
            </div>
        </div>

        <div class="p-6 sm:p-10 grid grid-cols-1 sm:grid-cols-2 gap-6 sm:gap-8">
            
            <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                <span class="text-indigo-500 text-[10px] sm:text-xs font-bold uppercase tracking-wider block mb-1">ชื่อ-นามสกุล</span>
                <span class="font-bold text-slate-800 text-base sm:text-lg"><?= htmlspecialchars($data['user']['name']) ?></span>
            </div>
            
            <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                <span class="text-indigo-500 text-[10px] sm:text-xs font-bold uppercase tracking-wider block mb-1">อีเมล</span>
                <span class="font-semibold text-slate-700 text-base sm:text-lg break-all"><?= htmlspecialchars($data['user']['email']) ?></span>
            </div>
            
            <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                <span class="text-indigo-500 text-[10px] sm:text-xs font-bold uppercase tracking-wider block mb-1">เพศ</span>
                <span class="font-semibold text-slate-700 text-base sm:text-lg flex items-center gap-1.5">
                    <?php 
                        $gender = htmlspecialchars($data['user']['gender']);
                        if ($gender === 'Male') {
                            echo '<svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg> ชาย';
                        } elseif ($gender === 'Female') {
                            echo '<svg class="w-4 h-4 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg> หญิง';
                        } else {
                            echo $gender; 
                        }
                    ?>
                </span>
            </div>
            
            <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                <span class="text-indigo-500 text-[10px] sm:text-xs font-bold uppercase tracking-wider block mb-1">วันเกิด</span>
                <span class="font-semibold text-slate-700 text-base sm:text-lg">
                    <?= date('d M Y', strtotime($data['user']['date_of_birth'])) ?>
                </span>
            </div>
            
            <div class="sm:col-span-2 bg-slate-50 p-4 rounded-2xl border border-slate-100">
                <span class="text-indigo-500 text-[10px] sm:text-xs font-bold uppercase tracking-wider block mb-1">จังหวัดที่พักอาศัย</span>
                <span class="font-semibold text-slate-700 text-base sm:text-lg flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    <?= htmlspecialchars($data['user']['province']) ?>
                </span>
            </div>
            
        </div>

        <div class="px-6 sm:px-10 py-5 sm:py-6 bg-white border-t border-slate-100 flex justify-center sm:justify-end">
            <button onclick="window.history.back()" 
                class="w-full sm:w-auto bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold px-8 py-3.5 sm:py-3 rounded-xl transition active:scale-95 text-sm sm:text-base">
                &larr; ย้อนกลับ
            </button>
        </div>
        
    </div>
</body>
</html>