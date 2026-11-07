<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Laporan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#F9F3DC] p-8 flex justify-center">
    <div class="bg-white p-8 rounded-xl shadow-md w-full max-w-2xl border border-slate-200">
        <h2 class="text-2xl font-bold mb-6 text-slate-800 border-b pb-2">Detail Laporan Bencana</h2>
        
        <div class="grid grid-cols-2 gap-4 text-sm mb-6">
            <div><span class="font-bold text-slate-500 block">Nama Pelapor</span> {{ $laporan->nama_pelapor }}</div>
            <div><span class="font-bold text-slate-500 block">No. HP</span> {{ $laporan->no_hp }}</div>
            <div><span class="font-bold text-slate-500 block">Kecamatan</span> {{ $laporan->kecamatan }}</div>
            <div><span class="font-bold text-slate-500 block">Tinggi Air</span> <span class="text-red-500 font-bold">{{ $laporan->tinggi_air }} cm</span></div>
            <div class="col-span-2"><span class="font-bold text-slate-500 block">Lokasi Detail</span> {{ $laporan->lokasi }}</div>
            <div class="col-span-2"><span class="font-bold text-slate-500 block">Keterangan</span> {{ $laporan->keterangan ?? '-' }}</div>
            <div class="col-span-2"><span class="font-bold text-slate-500 block">Status Penanganan</span> 
                <span class="bg-[#89CFF0] px-3 py-1 rounded text-slate-800 font-bold text-xs">{{ $laporan->status }}</span>
            </div>
        </div>

        <div class="mb-6">
            <span class="font-bold text-slate-500 block mb-2 text-sm">Bukti Foto</span>
            <img src="{{ asset('storage/' . $laporan->foto) }}" class="w-full max-w-sm rounded-lg border border-slate-300">
        </div>

        <a href="{{ route('laporan.index') }}" class="bg-slate-200 hover:bg-slate-300 text-slate-800 px-4 py-2 rounded-lg font-semibold text-sm transition">Kembali</a>
    </div>
</body>
</html>