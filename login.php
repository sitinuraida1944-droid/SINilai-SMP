<?php
include 'config.php';
session_start();

// Baris pengecekan auto-login otomatis dihapus/dimatikan 
// agar user wajib memasukkan username dan password terlebih dahulu!

$error = '';

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Menggunakan enkripsi md5 sesuai struktur database sistem Anda
    $password_md5 = md5($password);

    $query = "SELECT * FROM admin WHERE username='$username' AND password='$password_md5'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        
        // Mendaftarkan data ke dalam session login
        $_SESSION['login'] = true;
        $_SESSION['id_admin'] = $row['id_admin'];
        $_SESSION['nama'] = $row['nama'];
        $_SESSION['level'] = $row['level'];
        
        // Setelah sukses validasi, barulah dilempar ke dashboard utama
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Username atau password Anda salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SiNilai SMP</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        /* Pergerakan Gradasi Latar Belakang disamakan dengan Beranda */
        @keyframes meshFluid {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .mesh-bg {
            background: linear-gradient(-45deg, #22d3ee, #0ea5e9, #818cf8, #ec4899, #2dd4bf);
            background-size: 400% 400%;
            animation: meshFluid 15s ease infinite;
        }
    </style>
</head>
<body class="mesh-bg h-screen flex flex-col items-center justify-center font-sans px-4 overflow-hidden relative">
    
    <div class="animate__animated animate__backInUp bg-slate-950/40 backdrop-blur-xl p-8 rounded-3xl shadow-2xl w-full max-w-md border border-white/20 text-white transform transition duration-300 hover:scale-[1.01]">
        
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-gradient-to-br from-pink-400 to-rose-500 rounded-2xl mx-auto flex items-center justify-center shadow-xl shadow-pink-500/30 mb-3 animate__animated animate__pulse animate__infinite">
                <span class="text-2xl">🔑</span>
            </div>
            <h2 class="text-3xl font-black tracking-wide text-white drop-shadow-md">Verifikasi Akses</h2>
            <p class="text-cyan-50/70 text-xs mt-1 font-medium tracking-wide">Silakan masukkan akun autentikasi Anda</p>
        </div>
        
        <?php if($error): ?>
            <div class="animate__animated animate__shakeX bg-red-500/20 border border-red-500/30 text-red-200 px-4 py-3 rounded-2xl mb-5 text-sm flex items-center gap-2 font-medium">
                <span>⚠️</span> <?= $error; ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST" class="space-y-5">
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-white/80 mb-1.5">Username</label>
                <input type="text" name="username" required autocomplete="off" class="w-full px-4 py-3 rounded-2xl bg-slate-950/50 border border-white/10 focus:border-pink-400 focus:ring-4 focus:ring-pink-500/10 focus:outline-none transition-all duration-300 text-sm text-white placeholder-white/30" placeholder="Masukkan username">
            </div>
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-white/80 mb-1.5">Password</label>
                <input type="password" name="password" required class="w-full px-4 py-3 rounded-2xl bg-slate-950/50 border border-white/10 focus:border-pink-400 focus:ring-4 focus:ring-pink-500/10 focus:outline-none transition-all duration-300 text-sm text-white placeholder-white/30" placeholder="••••••••">
            </div>
            
            <div class="pt-2">
                <button type="submit" name="login" class="w-full bg-[#F25C84] hover:bg-[#e04b73] text-white font-black py-4 rounded-2xl shadow-xl shadow-pink-950/20 transition-all duration-300 active:scale-95 cursor-pointer text-sm uppercase tracking-widest">
                    🔐 Validasi & Masuk
                </button>
            </div>
        </form>
        
        <div class="text-center mt-5">
            <a href="index.php" class="text-xs text-white/60 hover:text-white underline transition">
                ⬅️ Kembali ke Beranda
            </a>
        </div>
    </div>

    <div class="absolute bottom-4 text-center text-white/40 text-[10px] tracking-widest uppercase pointer-events-none">
        &copy; 2026 - Universitas Lampung
    </div>
</body>
</html>