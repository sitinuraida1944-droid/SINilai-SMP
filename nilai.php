<?php
include 'config.php';
session_start();
if (!isset($_SESSION['login'])) { header("Location: login.php"); exit; }

if (isset($_POST['simpan_nilai'])) {
    $id_siswa = $_POST['id_siswa'];
    $id_mapel = $_POST['id_mapel'];
    $tugas    = $_POST['tugas'];
    $uts      = $_POST['uts'];
    $uas      = $_POST['uas'];
    $nilai_akhir = ($tugas * 0.30) + ($uts * 0.30) + ($uas * 0.40);

    $cek = mysqli_query($conn, "SELECT id_nilai FROM nilai WHERE id_siswa=$id_siswa AND id_mapel=$id_mapel");
    if(mysqli_num_rows($cek) > 0){
        mysqli_query($conn, "UPDATE nilai SET tugas=$tugas, uts=$uts, uas=$uas, nilai_akhir=$nilai_akhir WHERE id_siswa=$id_siswa AND id_mapel=$id_mapel");
    } else {
        mysqli_query($conn, "INSERT INTO nilai (id_siswa, id_mapel, tugas, uts, uas, nilai_akhir) VALUES ($id_siswa, $id_mapel, $tugas, $uts, $uas, $nilai_akhir)");
    }
    header("Location: nilai.php");
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM nilai WHERE id_nilai=$id");
    header("Location: nilai.php");
}

$siswa_opt = mysqli_query($conn, "SELECT id_siswa, nama_siswa FROM siswa ORDER BY nama_siswa ASC");
$mapel_opt = mysqli_query($conn, "SELECT id_mapel, nama_mapel FROM mapel ORDER BY nama_mapel ASC");
$nilai_list = mysqli_query($conn, "SELECT nilai.*, siswa.nama_siswa, siswa.kelas, mapel.nama_mapel FROM nilai 
    JOIN siswa ON nilai.id_siswa = siswa.id_siswa 
    JOIN mapel ON nilai.id_mapel = mapel.id_mapel ORDER BY nilai_akhir DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><title>Pengolahan Nilai - SiNilai SMP</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
</head>
<body class="bg-slate-900 text-slate-100 flex font-sans min-h-screen overflow-x-hidden">
    <?php include 'sidebar.php'; ?>
    <div class="flex-1 p-8 grid grid-cols-1 xl:grid-cols-3 gap-8 overflow-y-auto">
        <div class="animate__animated animate__fadeInLeft bg-slate-950 p-6 rounded-3xl border border-slate-800 shadow-xl h-fit">
            <h3 class="text-lg font-bold mb-4 bg-gradient-to-r from-white to-slate-400 bg-clip-text text-transparent">Input Nilai Rapor</h3>
            <form action="" method="POST" class="space-y-4">
                <div><label class="block text-xs font-bold text-slate-400 mb-1">Pilih Siswa</label>
                <select name="id_siswa" required class="w-full px-4 py-2.5 bg-slate-900 border border-slate-800 rounded-xl text-sm text-slate-300">
                    <option value="">-- Pilih Siswa --</option>
                    <?php while($s = mysqli_fetch_assoc($siswa_opt)): ?>
                        <option value="<?= $s['id_siswa']; ?>"><?= $s['nama_siswa']; ?></option>
                    <?php endwhile; ?>
                </select></div>
                <div><label class="block text-xs font-bold text-slate-400 mb-1">Mata Pelajaran</label>
                <select name="id_mapel" required class="w-full px-4 py-2.5 bg-slate-900 border border-slate-800 rounded-xl text-sm text-slate-300">
                    <option value="">-- Pilih Mapel --</option>
                    <?php while($m = mysqli_fetch_assoc($mapel_opt)): ?>
                        <option value="<?= $m['id_mapel']; ?>"><?= $m['nama_mapel']; ?></option>
                    <?php endwhile; ?>
                </select></div>
                <div class="grid grid-cols-3 gap-2">
                    <div><label class="block text-center text-xs font-bold text-slate-400 mb-1">Tugas</label>
                    <input type="number" name="tugas" required min="0" max="100" class="w-full py-2.5 bg-slate-900 border border-slate-800 rounded-xl text-center text-sm text-white"></div>
                    <div><label class="block text-center text-xs font-bold text-slate-400 mb-1">UTS</label>
                    <input type="number" name="uts" required min="0" max="100" class="w-full py-2.5 bg-slate-900 border border-slate-800 rounded-xl text-center text-sm text-white"></div>
                    <div><label class="block text-center text-xs font-bold text-slate-400 mb-1">UAS</label>
                    <input type="number" name="uas" required min="0" max="100" class="w-full py-2.5 bg-slate-900 border border-slate-800 rounded-xl text-center text-sm text-white"></div>
                </div>
                <button type="submit" name="simpan_nilai" class="w-full bg-gradient-to-r from-emerald-500 to-teal-600 text-white font-bold py-3 rounded-xl shadow-lg cursor-pointer text-sm">Kalkulasi & Simpan</button>
            </form>
        </div>
        <div class="animate__animated animate__fadeInRight xl:col-span-2 bg-slate-950 p-6 rounded-3xl border border-slate-800 shadow-xl overflow-hidden">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold bg-gradient-to-r from-white to-slate-400 bg-clip-text text-transparent">Daftar Nilai Akhir</h3>
                <button onclick="window.print()" class="px-4 py-2 bg-gradient-to-r from-indigo-500 to-blue-600 text-white rounded-xl text-xs font-bold shadow-lg cursor-pointer">Cetak Rapor</button>
            </div>
            <div class="overflow-x-auto"><table class="w-full text-left border-collapse text-sm">
                <thead><tr class="bg-slate-900 text-slate-400 font-bold text-xs border-b border-slate-800"><th class="p-4">Siswa</th><th class="p-4">Mapel</th><th class="p-4 text-center">Tgs</th><th class="p-4 text-center">UTS</th><th class="p-4 text-center">UAS</th><th class="p-4 text-center">Akhir</th><th class="p-4 text-center">Aksi</th></tr></thead>
                <tbody class="divide-y divide-slate-900">
                    <?php while($n = mysqli_fetch_assoc($nilai_list)): ?>
                    <tr class="hover:bg-slate-900/70 transition duration-200">
                        <td class="p-4 font-semibold text-white"><?= $n['nama_siswa']; ?> <span class="text-xs font-normal text-slate-500">(<?= $n['kelas']; ?>)</span></td>
                        <td class="p-4 text-slate-300"><?= $n['nama_mapel']; ?></td>
                        <td class="p-4 text-center text-slate-400"><?= $n['tugas']; ?></td>
                        <td class="p-4 text-center text-slate-400"><?= $n['uts']; ?></td>
                        <td class="p-4 text-center text-slate-400"><?= $n['uas']; ?></td>
                        <td class="p-4 text-center"><span class="px-3 py-1 rounded-xl text-xs font-black <?= $n['nilai_akhir'] >= 75 ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20' : 'bg-red-500/10 text-red-400 border border-red-500/20 animate-pulse'; ?>"><?= number_format($n['nilai_akhir'], 2); ?></span></td>
                        <td class="p-4 text-center"><a href="nilai.php?hapus=<?= $n['id_nilai']; ?>" onclick="return confirm('Hapus?')" class="text-red-400 hover:text-red-300 text-xs">Hapus</a></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table></div>
        </div>
    </div>
</body>
</html>