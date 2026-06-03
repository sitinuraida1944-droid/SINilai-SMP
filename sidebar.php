<?php
if (session_status() == PHP_SESSION_NONE) { session_start(); }
if (!isset($_SESSION['login'])) { header("Location: login.php"); exit; }
$current_page = basename($_SERVER['PHP_SELF']);
?>
<div class="animate__animated animate__slideInLeft w-64 bg-slate-950 text-white min-h-screen p-5 flex flex-col justify-between shadow-2xl border-r border-slate-900 shrink-0 z-10">
    <div>
        <div class="mb-8 text-center p-4 bg-gradient-to-br from-slate-900 to-indigo-950 rounded-2xl border border-indigo-950/40">
            <h1 class="text-2xl font-black tracking-wider bg-gradient-to-r from-cyan-400 to-indigo-400 bg-clip-text text-transparent">SiNilai SMP</h1>
            <p class="text-[10px] text-indigo-300/70 uppercase tracking-widest font-bold mt-1">Dashboard Portal</p>
        </div>
        <nav class="space-y-2">
            <a href="dashboard.php" class="flex items-center gap-3 py-3 px-4 rounded-xl font-semibold text-sm transition-all duration-300 hover:translate-x-2 <?= $current_page == 'dashboard.php' ? 'bg-gradient-to-r from-indigo-600 to-blue-600 text-white shadow-lg shadow-indigo-600/20 scale-105' : 'text-slate-400 hover:bg-slate-900 hover:text-white' ?>">📊 Dashboard</a>
            <a href="guru.php" class="flex items-center gap-3 py-3 px-4 rounded-xl font-semibold text-sm transition-all duration-300 hover:translate-x-2 <?= $current_page == 'guru.php' ? 'bg-gradient-to-r from-indigo-600 to-blue-600 text-white shadow-lg shadow-indigo-600/20 scale-105' : 'text-slate-400 hover:bg-slate-900 hover:text-white' ?>">👨‍🏫 Data Guru</a>
            <a href="mapel.php" class="flex items-center gap-3 py-3 px-4 rounded-xl font-semibold text-sm transition-all duration-300 hover:translate-x-2 <?= $current_page == 'mapel.php' ? 'bg-gradient-to-r from-indigo-600 to-blue-600 text-white shadow-lg shadow-indigo-600/20 scale-105' : 'text-slate-400 hover:bg-slate-900 hover:text-white' ?>">📚 Mata Pelajaran</a>
            <a href="siswa.php" class="flex items-center gap-3 py-3 px-4 rounded-xl font-semibold text-sm transition-all duration-300 hover:translate-x-2 <?= $current_page == 'siswa.php' ? 'bg-gradient-to-r from-indigo-600 to-blue-600 text-white shadow-lg shadow-indigo-600/20 scale-105' : 'text-slate-400 hover:bg-slate-900 hover:text-white' ?>">🧑‍🎓 Data Siswa</a>
            <a href="nilai.php" class="flex items-center gap-3 py-3 px-4 rounded-xl font-semibold text-sm transition-all duration-300 hover:translate-x-2 <?= $current_page == 'nilai.php' ? 'bg-gradient-to-r from-indigo-600 to-blue-600 text-white shadow-lg shadow-indigo-600/20 scale-105' : 'text-slate-400 hover:bg-slate-900 hover:text-white' ?>">📝 Kelola Nilai</a>
        </nav>
    </div>
    <div class="border-t border-slate-900 pt-4">
        <p class="text-[10px] text-slate-500 font-bold uppercase tracking-wider">User Login:</p>
        <p class="font-bold text-sm text-cyan-400 truncate mt-0.5 mb-3"><?= $_SESSION['nama']; ?></p>
        <a href="logout.php" class="block text-center py-2.5 px-4 bg-gradient-to-r from-red-500 to-pink-600 hover:from-red-600 hover:to-pink-700 rounded-xl text-white font-bold text-xs transition-all duration-300 shadow-lg shadow-red-500/10 active:scale-95">Keluar Sistem</a>
    </div>
</div>