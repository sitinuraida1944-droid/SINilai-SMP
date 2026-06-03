<?php
include 'config.php';
session_start();
if (!isset($_SESSION['login'])) { header("Location: login.php"); exit; }

if (isset($_POST['tambah'])) {
    $nip = mysqli_real_escape_string($conn, $_POST['nip']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama_guru']);
    $no_hp = mysqli_real_escape_string($conn, $_POST['no_hp']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    mysqli_query($conn, "INSERT INTO guru (nama_guru, nip, alamat, no_hp) VALUES ('$nama', '$nip', '$alamat', '$no_hp')");
    header("Location: guru.php");
}
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM guru WHERE id_guru=$id");
    header("Location: guru.php");
}
$guru_list = mysqli_query($conn, "SELECT * FROM guru ORDER BY id_guru DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><title>Data Guru - SiNilai SMP</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
</head>
<body class="bg-slate-900 text-slate-100 flex font-sans min-h-screen overflow-x-hidden">
    <?php include 'sidebar.php'; ?>
    <div class="flex-1 p-8 grid grid-cols-1 xl:grid-cols-3 gap-8 overflow-y-auto">
        
        <div class="animate__animated animate__fadeInLeft bg-slate-950 p-6 rounded-3xl border border-slate-800 shadow-xl h-fit">
            <h3 class="text-lg font-bold mb-4 bg-gradient-to-r from-white to-slate-400 bg-clip-text text-transparent">Tambah Data Guru</h3>
            <form action="" method="POST" class="space-y-4">
                <div><label class="block text-xs font-bold text-slate-400 mb-1">NIP</label>
                <input type="text" name="nip" required class="w-full px-4 py-2.5 bg-slate-900 border border-slate-800 rounded-xl focus:border-indigo-500 text-sm text-white"></div>
                <div><label class="block text-xs font-bold text-slate-400 mb-1">Nama Lengkap</label>
                <input type="text" name="nama_guru" required class="w-full px-4 py-2.5 bg-slate-900 border border-slate-800 rounded-xl focus:border-indigo-500 text-sm text-white"></div>
                <div><label class="block text-xs font-bold text-slate-400 mb-1">No. HP/WhatsApp</label>
                <input type="text" name="no_hp" required class="w-full px-4 py-2.5 bg-slate-900 border border-slate-800 rounded-xl focus:border-indigo-500 text-sm text-white"></div>
                <div><label class="block text-xs font-bold text-slate-400 mb-1">Alamat</label>
                <textarea name="alamat" rows="2" required class="w-full px-4 py-2.5 bg-slate-900 border border-slate-800 rounded-xl focus:border-indigo-500 text-sm text-white"></textarea></div>
                <button type="submit" name="tambah" class="w-full bg-gradient-to-r from-indigo-500 to-blue-600 text-white font-bold py-3 rounded-xl shadow-lg cursor-pointer text-sm">Simpan Guru</button>
            </form>
        </div>
        
        <div class="animate__animated animate__fadeInRight xl:col-span-2 bg-slate-950 p-6 rounded-3xl border border-slate-800 shadow-xl overflow-hidden">
            <h3 class="text-lg font-bold mb-4 bg-gradient-to-r from-white to-slate-400 bg-clip-text text-transparent">Daftar Guru</h3>
            <div class="overflow-x-auto"><table class="w-full text-left border-collapse text-sm">
                <thead><tr class="bg-slate-900 text-slate-400 font-bold text-xs border-b border-slate-800"><th class="p-4">NIP</th><th class="p-4">Nama Guru</th><th class="p-4">No HP</th><th class="p-4 text-center">Aksi</th></tr></thead>
                <tbody class="divide-y divide-slate-900">
                    <?php while($g = mysqli_fetch_assoc($guru_list)): ?>
                    <tr class="hover:bg-slate-900/70 transition duration-200"><td class="p-4 font-mono text-slate-400"><?= $g['nip']; ?></td><td class="p-4 font-semibold text-white"><?= $g['nama_guru']; ?></td><td class="p-4 text-slate-300"><?= $g['no_hp']; ?></td>
                    <td class="p-4 text-center"><a href="guru.php?hapus=<?= $g['id_guru']; ?>" onclick="return confirm('Hapus?')" class="text-red-400 bg-red-500/10 px-3 py-1.5 rounded-xl text-xs font-bold hover:bg-red-500/30 transition">Hapus</a></td></tr>
                    <?php endwhile; ?>
                </tbody>
            </table></div>
        </div>
    </div>
</body>
</html>