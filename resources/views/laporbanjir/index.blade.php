<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Laporan Banjir</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: { extend: { colors: { babyBlue: '#89CFF0', softCream: '#F9F3DC', softBrown: '#BCA38F' } } }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-softCream font-sans text-slate-800 antialiased min-h-screen">

    <header class="bg-babyBlue text-slate-800 shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <div class="font-bold text-lg flex items-center gap-2">
                <i class="fa-solid fa-shield-halved"></i> Panel Petugas BPBD
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-sm font-semibold bg-white/50 px-4 py-1.5 rounded-lg hover:bg-white transition">Logout</button>
            </form>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 py-8">
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm font-medium">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="bg-slate-50 text-slate-600 uppercase text-[11px] font-semibold border-b border-slate-200">
                            <th class="py-3 px-4">Tanggal</th>
                            <th class="py-3 px-4">Pelapor</th>
                            <th class="py-3 px-4">Lokasi</th>
                            <th class="py-3 px-4 text-center">Air (cm)</th>
                            <th class="py-3 px-4 text-center">Foto</th>
                            <th class="py-3 px-4 text-center">Status</th>
                            <th class="py-3 px-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($laporan as $item)
                            <tr class="hover:bg-softCream/30">
                                <td class="py-3 px-4 text-xs font-mono text-slate-500">{{ $item->created_at->format('d/m/Y') }}</td>
                                <td class="py-3 px-4 font-bold">{{ $item->nama_pelapor }}</td>
                                <td class="py-3 px-4 text-xs">{{ $item->kecamatan }}</td>
                                <td class="py-3 px-4 text-center font-bold text-red-500">{{ $item->tinggi_air }}</td>
                                <td class="py-3 px-4 text-center">
                                    <img src="{{ asset('storage/' . $item->foto) }}" class="h-10 w-10 object-cover rounded mx-auto border" alt="Bukti">
                                </td>
                                <td class="py-3 px-4 text-center">
                                    <span class="px-2 py-1 rounded text-[10px] font-bold 
                                        {{ $item->status == 'Menunggu' ? 'bg-slate-100 text-slate-600' : ($item->status == 'Diproses' ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700') }}">
                                        {{ $item->status }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-center flex justify-center gap-2">
                                    <a href="{{ route('laporan.show', $item->id) }}" class="bg-babyBlue text-slate-800 p-1.5 rounded text-xs"><i class="fa-solid fa-eye"></i></a>
                                    <a href="{{ route('laporan.edit', $item->id) }}" class="bg-softBrown text-white p-1.5 rounded text-xs"><i class="fa-solid fa-pen"></i></a>
                                    <form action="{{ route('laporan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus laporan?');">
                                        @csrf @method('DELETE')
                                        <button class="bg-red-500 text-white p-1.5 rounded text-xs"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="py-6 text-center text-slate-400">Belum ada data.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- Pagination (Ketentuan d) -->
            <div class="p-4 border-t border-slate-100">{{ $laporan->links() }}</div>
        </div>
    </main>
</body>
</html>