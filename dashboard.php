<?php
include 'config.php';
session_start();
if (!isset($_SESSION['login'])) { header("Location: login.php"); exit; }

$total_siswa = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM siswa"))['total'];
$total_guru  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM guru"))['total'];
$total_mapel = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM mapel"))['total'];
$total_nilai = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM nilai"))['total'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - SiNilai SMP</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
</head>
<body class="bg-slate-900 font-sans flex text-slate-100 min-h-screen overflow-x-hidden">
    <?php include 'sidebar.php'; ?>
    
    <div class="flex-1 p-8 lg:p-12 overflow-y-auto">
        <header class="animate__animated animate__fadeInDown mb-10 flex flex-col md:flex-row md:items-center md:justify-between gap-4 border-b border-slate-800 pb-6">
            <div>
                <h2 class="text-3xl font-black tracking-tight bg-gradient-to-r from-white to-slate-400 bg-clip-text text-transparent">Ringkasan Sistem</h2>
                <p class="text-slate-400 text-sm mt-1">Selamat datang, <span class="font-bold text-cyan-400"><?= $_SESSION['nama']; ?></span>. Berikut ringkasan data sekolah.</p>
            </div>
            <div class="bg-slate-950 px-4 py-2.5 rounded-2xl border border-slate-800 text-xs font-semibold text-slate-300 flex items-center gap-2">
                <span class="w-2.5 h-2.5 bg-emerald-500 rounded-full animate-ping"></span> Sistem Aktif
            </div>
        </header>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="animate__animated animate__zoomIn bg-gradient-to-br from-blue-600 to-indigo-800 p-6 rounded-3xl shadow-xl text-white relative overflow-hidden transform transition duration-300 hover:-translate-y-2 hover:shadow-blue-500/30 group">
                <p class="text-blue-200 text-xs uppercase font-extrabold tracking-wider">Total Siswa</p>
                <p class="text-4xl font-black mt-3"><?= $total_siswa; ?> <span class="text-sm font-medium opacity-70">Siswa</span></p>
                <div class="absolute -right-4 -bottom-6 text-white/10 text-8xl font-black group-hover:scale-125 transition duration-500 select-none pointer-events-none">🧑‍🎓</div>
            </div>
            <div class="animate__animated animate__zoomIn animate__delay-1s bg-gradient-to-br from-purple-600 to-pink-800 p-6 rounded-3xl shadow-xl text-white relative overflow-hidden transform transition duration-300 hover:-translate-y-2 hover:shadow-purple-500/30 group">
                <p class="text-purple-200 text-xs uppercase font-extrabold tracking-wider">Guru Pengajar</p>
                <p class="text-4xl font-black mt-3"><?= $total_guru; ?> <span class="text-sm font-medium opacity-70">Guru</span></p>
                <div class="absolute -right-4 -bottom-6 text-white/10 text-8xl font-black group-hover:scale-125 transition duration-500 select-none pointer-events-none">👨‍🏫</div>
            </div>
            <div class="animate__animated animate__zoomIn animate__delay-2s bg-gradient-to-br from-cyan-600 to-teal-800 p-6 rounded-3xl shadow-xl text-white relative overflow-hidden transform transition duration-300 hover:-translate-y-2 hover:shadow-cyan-500/30 group">
                <p class="text-cyan-200 text-xs uppercase font-extrabold tracking-wider">Mata Pelajaran</p>
                <p class="text-4xl font-black mt-3"><?= $total_mapel; ?> <span class="text-sm font-medium opacity-70">Bidang</span></p>
                <div class="absolute -right-4 -bottom-6 text-white/10 text-8xl font-black group-hover:scale-125 transition duration-500 select-none pointer-events-none">📚</div>
            </div>
            <div class="animate__animated animate__zoomIn animate__delay-3s bg-gradient-to-br from-emerald-600 to-green-800 p-6 rounded-3xl shadow-xl text-white relative overflow-hidden transform transition duration-300 hover:-translate-y-2 hover:shadow-emerald-500/30 group">
                <p class="text-emerald-200 text-xs uppercase font-extrabold tracking-wider">Nilai Terproses</p>
                <p class="text-4xl font-black mt-3"><?= $total_nilai; ?> <span class="text-sm font-medium opacity-70">Record</span></p>
                <div class="absolute -right-4 -bottom-6 text-white/10 text-8xl font-black group-hover:scale-125 transition duration-500 select-none pointer-events-none">📊</div>
            </div>
        </div>

        <div class="animate__animated animate__fadeInUp animate__delay-4s mt-10 bg-slate-950 p-6 rounded-3xl border border-slate-800 flex items-center gap-6 shadow-2xl">
            <div class="w-14 h-14 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center text-2xl shadow-lg animate-bounce">💡</div>
            <div>
                <h4 class="font-bold text-white text-base">Alur Cepat Pengisian Website:</h4>
                <p class="text-slate-400 text-xs mt-1">Isi berurutan: <span class="text-cyan-400 font-semibold">1. Data Guru</span> ➡️ <span class="text-cyan-400 font-semibold">2. Mata Pelajaran</span> ➡️ <span class="text-cyan-400 font-semibold">3. Data Siswa</span> ➡️ <span class="text-cyan-400 font-semibold">4. Input & Hitung Nilai Rapor</span>.</p>
            </div>
        </div>
    </div>
</body>
</html>