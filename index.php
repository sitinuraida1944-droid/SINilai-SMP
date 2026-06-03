<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang - Sistem Nilai SMP</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        /* Animasi 1: Aliran Gradasi Latar Belakang (Mesh Gradient Fluid) */
        @keyframes meshFluid {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .mesh-bg {
            /* Kombinasi warna gradasi premium agar tidak polos */
            background: linear-gradient(-45deg, #22d3ee, #0ea5e9, #818cf8, #ec4899, #2dd4bf);
            background-size: 400% 400%;
            animation: meshFluid 15s ease infinite;
        }

        /* Animasi 2: Tangan Melambai Kontinu Menyapa Pengunjung */
        @keyframes wave {
            0% { transform: rotate( 0.0deg) }
            10% { transform: rotate(14.0deg) }
            20% { transform: rotate(-8.0deg) }
            30% { transform: rotate(14.0deg) }
            40% { transform: rotate(-4.0deg) }
            50% { transform: rotate(10.0deg) }
            60% { transform: rotate( 0.0deg) }
            100% { transform: rotate( 0.0deg) }
        }
        .animate-wave {
            animation: wave 2.5s infinite;
            transform-origin: 70% 70%;
            display: inline-block;
        }

        /* Animasi 3: Efek Mengetik Otomatis pada Sub-judul */
        @keyframes typing {
            from { width: 0 }
            to { width: 100% }
        }
        @keyframes blink-caret {
            from, to { border-color: transparent }
            50% { border-color: rgba(255,255,255,0.7) }
        }
        .typing-effect {
            overflow: hidden;
            border-right: 3px solid rgba(255,255,255,0.7);
            white-space: nowrap;
            margin: 0 auto;
            letter-spacing: 0.05em;
            animation: 
                typing 3.5s steps(40, end),
                blink-caret .75s step-end infinite;
        }

        /* Animasi 4: Cahaya Lentur Melayang di Background */
        @keyframes floatGlow {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.95); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        .glow-1 { animation: floatGlow 8s ease-in-out infinite; }
        .glow-2 { animation: floatGlow 12s ease-in-out infinite 2s; }
    </style>
</head>
<body class="mesh-bg min-h-screen font-sans relative overflow-hidden flex flex-col">

    <div class="absolute top-[-10%] left-[-10%] w-[50vw] h-[50vw] bg-fuchsia-400/20 rounded-full blur-[120px] glow-1 pointer-events-none"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-[45vw] h-[45vw] bg-teal-300/20 rounded-full blur-[120px] glow-2 pointer-events-none"></div>

    <header class="w-full bg-slate-950/40 backdrop-blur-xl px-6 py-4 flex justify-between items-center shadow-lg z-10 border-b border-white/10">
        <div class="flex items-center gap-3 group cursor-pointer">
            <span class="text-2xl transition-transform duration-500 group-hover:rotate-12">🎓</span>
            <h1 class="text-white font-extrabold tracking-wide text-base md:text-lg">
                Sistem Nilai <span class="bg-gradient-to-r from-pink-300 to-rose-300 bg-clip-text text-transparent">SMP</span>
            </h1>
        </div>
        
        <a href="login.php" class="bg-[#F25C84] hover:bg-[#e04b73] text-white font-bold px-6 py-2 rounded-xl text-sm shadow-lg shadow-pink-950/20 transition-all duration-300 hover:scale-105 active:scale-95">
            Login
        </a>
    </header>

    <main class="flex-1 flex flex-col justify-center items-center text-center px-4 z-10 relative select-none">
        
        <div class="bg-white/10 backdrop-blur-md p-8 md:p-12 rounded-3xl border border-white/20 shadow-2xl shadow-slate-950/20 max-w-2xl transform transition-all duration-500 hover:scale-[1.01] hover:bg-white/15">
            
            <h2 class="text-white text-4xl md:text-6xl font-black tracking-tight mb-4 drop-shadow-lg flex items-center justify-center gap-3">
                Selamat Datang <span class="animate-wave">👋</span>
            </h2>
            
            <div class="inline-block max-w-full mb-10">
                <p class="typing-effect text-white/90 text-sm md:text-lg font-semibold drop-shadow-md">
                    Sistem Pengolahan Nilai Siswa SMP berbasis Web
                </p>
            </div>
            
            <div class="relative group inline-block">
                <div class="absolute -inset-1.5 bg-gradient-to-r from-pink-500 via-purple-500 to-rose-500 rounded-2xl blur-md opacity-75 group-hover:opacity-100 transition duration-300 animate-pulse"></div>
                
                <a href="login.php" class="relative block bg-[#F25C84] hover:bg-[#e04b73] text-white font-black px-12 py-4 rounded-2xl text-base md:text-lg shadow-xl tracking-wider transition-all duration-300 transform group-hover:scale-105 active:scale-95">
                    🚀 Masuk Sekarang
                </a>
            </div>

        </div>

    </main>

    <footer class="w-full text-center py-4 text-white/60 text-xs font-semibold z-10 bg-slate-950/10 backdrop-blur-xs">
        &copy; 2026 Sistem Nilai SMP. All Rights Reserved.
    </footer>

</body>
</html>