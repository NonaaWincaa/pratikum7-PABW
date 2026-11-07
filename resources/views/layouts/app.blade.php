<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BPBD LaporBanjir</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        softBluePrimary: '#2563EB',
                        softBlueHeader: '#1E3A8A',
                        softBlueBg: '#F0F7FF',
                        softBlueBadge: '#E0F2FE',
                        softBlueText: '#0369A1',
                    }
                }
            }
        }
    </script>
    <!-- FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-softBlueBg font-sans text-slate-800 antialiased min-h-screen flex flex-col justify-between overflow-x-hidden">

    <!-- Header / Navbar Soft Blue -->
    <header class="bg-softBlueHeader text-white shadow-sm sticky top-0 z-50">
        <div class="max-w-5xl mx-auto px-4 py-3 flex justify-between items-center">
            <a href="{{ route('laporan.create') }}" class="flex items-center gap-2 font-bold text-sm tracking-wide hover:opacity-90 transition">
                <i class="fa-solid fa-triangle-exclamation text-sky-300 text-lg"></i>
                <span>BPBD LaporBanjir</span>
            </a>

            <nav class="flex items-center gap-2 text-xs font-medium">
                <!-- Menu Publik (Bisa diakses tanpa login) -->
                <a href="{{ route('laporan.create') }}" class="px-3 py-1.5 rounded-md hover:bg-blue-800 transition flex items-center gap-1.5">
                    <i class="fa-solid fa-pen-to-square text-sky-300"></i> Buat Laporan
                </a>
                <a href="{{ route('students.index') }}" class="px-3 py-1.5 rounded-md hover:bg-blue-800 transition flex items-center gap-1.5 border border-sky-400/30">
                    <i class="fa-solid fa-graduation-cap text-sky-300"></i> Mahasiswa
                </a>

                @auth
                    <!-- Tampil HANYA jika Petugas SUDAH Login -->
                    <a href="{{ route('laporan.index') }}" class="px-3 py-1.5 rounded-md hover:bg-blue-800 transition flex items-center gap-1.5">
                        <i class="fa-solid fa-list-check text-sky-300"></i> Daftar Laporan
                    </a>
                    <a href="{{ route('petugas.profil') }}" class="px-3 py-1.5 rounded-md hover:bg-blue-800 transition flex items-center gap-1.5">
                        <i class="fa-solid fa-user-gear text-sky-300"></i> Profil Petugas
                    </a>

                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="px-3 py-1.5 bg-red-600/80 hover:bg-red-700 text-white rounded-md transition flex items-center gap-1.5 ms-1">
                            <i class="fa-solid fa-right-from-bracket"></i> Logout ({{ Auth::user()->name }})
                        </button>
                    </form>
                @else
                    <!-- Tampil HANYA jika BELUM Login -->
                    <a href="{{ route('login') }}" class="px-3 py-1.5 bg-sky-500 hover:bg-sky-600 text-white rounded-md transition flex items-center gap-1.5 ms-2">
                        <i class="fa-solid fa-right-to-bracket"></i> Login
                    </a>
                    <a href="{{ route('register') }}" class="px-3 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-md transition flex items-center gap-1.5">
                        <i class="fa-solid fa-user-plus"></i> Register
                    </a>
                @endauth
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-5xl mx-auto px-4 py-6 flex-grow w-full">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-400 py-3 text-center text-xs border-t border-slate-800">
        <p>&copy; {{ date('Y') }} BPBD Kabupaten Bandung. wincarlinn.</p>
    </footer>

</body>
</html>