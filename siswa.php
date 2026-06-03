<?php
include 'config.php';
session_start();
if (!isset($_SESSION['login'])) { header("Location: login.php"); exit; }

if (isset($_POST['tambah'])) {
    $nis = mysqli_real_escape_string($conn, $_POST['nis']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama_siswa']);
    $kelas = mysqli_real_escape_string($conn, $_POST['kelas']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    mysqli_query($conn, "INSERT INTO siswa (nama_siswa, nis, kelas, alamat) VALUES ('$nama', '$nis', '$kelas', '$alamat')");
    header("Location: siswa.php");
}
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM siswa WHERE id_siswa=$id");
    header("Location: siswa.php");
}
$siswa_list = mysqli_query($conn, "SELECT * FROM siswa ORDER BY id_siswa DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><title>Data Siswa - SiNilai SMP</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
</head>
<body class="bg-slate-900 text-slate-100 flex font-sans min-h-screen overflow-x-hidden">
    <?php include 'sidebar.php'; ?>
    <div class="flex-1 p-8 grid grid-cols-1 xl:grid-cols-3 gap-8 overflow-y-auto">
        <div class="animate__animated animate__fadeInLeft bg-slate-950 p-6 rounded-3xl border border-slate-800 shadow-xl h-fit">
            <h3 class="text-lg font-bold mb-4 bg-gradient-to-r from-white to-slate-400 bg-clip-text text-transparent">Tambah Data Siswa</h3>
            <form action="" method="POST" class="space-y-4">
                <div><label class="block text-xs font-bold text-slate-400 mb-1">NIS</label>
                <input type="text" name="nis" required class="w-full px-4 py-2.5 bg-slate-900 border border-slate-800 rounded-xl focus:border-indigo-500 text-sm text-white"></div>
                <div><label class="block text-xs font-bold text-slate-400 mb-1">Nama Siswa</label>
                <input type="text" name="nama_siswa" required class="w-full px-4 py-2.5 bg-slate-900 border border-slate-800 rounded-xl focus:border-indigo-500 text-sm text-white"></div>
                <div><label class="block text-xs font-bold text-slate-400 mb-1">Kelas</label>
                <input type="text" name="kelas" placeholder="Contoh: VII-A" required class="w-full px-4 py-2.5 bg-slate-900 border border-slate-800 rounded-xl focus:border-indigo-500 text-sm text-white"></div>
                <div><label class="block text-xs font-bold text-slate-400 mb-1">Alamat</label>
                <textarea name="alamat" rows="2" required class="w-full px-4 py-2.5 bg-slate-900 border border-slate-800 rounded-xl focus:border-indigo-500 text-sm text-white"></textarea></div>
                <button type="submit" name="tambah" class="w-full bg-gradient-to-r from-indigo-500 to-blue-600 text-white font-bold py-3 rounded-xl shadow-lg cursor-pointer text-sm">Simpan Siswa</button>
            </form>
        </div>
        <div class="animate__animated animate__fadeInRight xl:col-span-2 bg-slate-950 p-6 rounded-3xl border border-slate-800 shadow-xl overflow-hidden">
            <h3 class="text-lg font-bold mb-4 bg-gradient-to-r from-white to-slate-400 bg-clip-text text-transparent">Daftar Siswa Aktif</h3>
            <div class="overflow-x-auto"><table class="w-full text-left border-collapse text-sm">
                <thead><tr class="bg-slate-900 text-slate-400 font-bold text-xs border-b border-slate-800"><th class="p-4">NIS</th><th class="p-4">Nama Siswa</th><th class="p-4">Kelas</th><th class="p-4 text-center">Aksi</th></tr></thead>
                <tbody class="divide-y divide-slate-900">
                    <?php while($s = mysqli_fetch_assoc($siswa_list)): ?>
                    <tr class="hover:bg-slate-900/70 transition duration-200"><td class="p-4 font-mono text-slate-400"><?= $s['nis']; ?></td><td class="p-4 font-semibold text-white"><?= $s['nama_siswa']; ?></td><td class="p-4"><span class="px-2 py-0.5 bg-blue-500/10 text-blue-400 rounded-md font-bold text-xs border border-blue-500/20"><?= $s['kelas']; ?></span></td>
                    <td class="p-4 text-center"><a href="siswa.php?hapus=<?= $s['id_siswa']; ?>" onclick="return confirm('Hapus?')" class="text-red-400 bg-red-500/10 px-3 py-1.5 rounded-xl text-xs font-bold hover:bg-red-500/30 transition">Hapus</a></td></tr>
                    <?php endwhile; ?>
                </tbody>
            </table></div>
        </div>
    </div>
</body>
</html>