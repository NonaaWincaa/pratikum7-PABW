<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Status Laporan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: { colors: { emeraldCustom: '#0A6B52', goldCustom: '#C69968', creamCustom: '#F9F3DC' } }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-creamCustom/50 font-sans text-slate-800 antialiased min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-lg bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden">
        <div class="bg-goldCustom px-6 py-4 text-white flex items-center gap-3">
            <i class="fa-solid fa-pen-to-square text-xl"></i>
            <h2 class="text-lg font-bold">Update Status Laporan</h2>
        </div>

        <div class="p-6">
            <form action="{{ route('laporan.update', $laporan->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')
                
                <!-- Info Data Lama (Readonly) -->
                <div class="bg-slate-50 p-3 rounded border border-slate-200 text-sm mb-4">
                    <p><strong>Pelapor:</strong> {{ $laporan->nama_pelapor }} ({{ $laporan->no_hp }})</p>
                    <p><strong>Lokasi:</strong> {{ $laporan->kecamatan }} - {{ $laporan->lokasi }}</p>
                    <p><strong>Tinggi Air:</strong> <span class="text-red-600 font-bold">{{ $laporan->tinggi_air }} cm</span></p>
                </div>

                <!-- Input Hidden untuk field wajib agar tidak error saat update -->
                <input type="hidden" name="nama_pelapor" value="{{ $laporan->nama_pelapor }}">
                <input type="hidden" name="no_hp" value="{{ $laporan->no_hp }}">
                <input type="hidden" name="lokasi" value="{{ $laporan->lokasi }}">
                <input type="hidden" name="kecamatan" value="{{ $laporan->kecamatan }}">
                <input type="hidden" name="tinggi_air" value="{{ $laporan->tinggi_air }}">
                <input type="hidden" name="keterangan" value="{{ $laporan->keterangan }}">

                <!-- Update Status -->
                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1">Status Penanganan</label>
                    <select name="status" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-emeraldCustom outline-none text-sm">
                        <option value="Menunggu" {{ $laporan->status == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="Diproses" {{ $laporan->status == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="Selesai" {{ $laporan->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>

                <!-- Update Foto (Opsional) -->
                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1">Update Bukti Foto (Opsional)</label>
                    <input type="file" name="foto" accept="image/jpeg, image/png" class="w-full px-4 py-2 rounded border border-slate-300 text-sm">
                    <p class="text-[10px] text-slate-400 mt-1">Biarkan kosong jika foto tidak berubah.</p>
                </div>

                <div class="pt-4 flex gap-3">
                    <a href="{{ route('laporan.index') }}" class="w-1/3 text-center bg-slate-200 hover:bg-slate-300 text-slate-700 font-bold py-2.5 rounded-lg transition text-sm">
                        Batal
                    </a>
                    <button type="submit" class="w-2/3 bg-emeraldCustom hover:bg-[#085a44] text-white font-bold py-2.5 rounded-lg transition text-sm">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div><!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Laporan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#F9F3DC] p-8 flex justify-center">
    <div class="bg-white p-8 rounded-xl shadow-md w-full max-w-lg border border-slate-200">
        <h2 class="text-xl font-bold mb-6 text-slate-800 border-b pb-2">Update Status & Foto</h2>
        
        <form action="{{ route('laporan.update', $laporan->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf @method('PUT')
            
            <input type="hidden" name="nama_pelapor" value="{{ $laporan->nama_pelapor }}">
            <input type="hidden" name="no_hp" value="{{ $laporan->no_hp }}">
            <input type="hidden" name="lokasi" value="{{ $laporan->lokasi }}">
            <input type="hidden" name="kecamatan" value="{{ $laporan->kecamatan }}">
            <input type="hidden" name="tinggi_air" value="{{ $laporan->tinggi_air }}">
            <input type="hidden" name="keterangan" value="{{ $laporan->keterangan }}">

            <div>
                <label class="block text-xs font-bold text-slate-600 mb-1">Status Penanganan</label>
                <select name="status" class="w-full px-4 py-2 rounded border focus:ring-2 focus:ring-[#89CFF0] outline-none text-sm">
                    <option value="Menunggu" {{ $laporan->status == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                    <option value="Diproses" {{ $laporan->status == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                    <option value="Selesai" {{ $laporan->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-600 mb-1">Update Bukti Foto (Opsional)</label>
                <input type="file" name="foto" accept="image/jpeg, image/png" class="w-full px-4 py-2 rounded border text-sm">
                <p class="text-[10px] text-slate-400 mt-1">Kosongkan jika foto tidak diubah.</p>
                @error('foto') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div class="flex gap-2 pt-4">
                <a href="{{ route('laporan.index') }}" class="w-1/3 text-center bg-slate-200 text-slate-700 py-2 rounded-lg text-sm font-bold">Batal</a>
                <button type="submit" class="w-2/3 bg-[#89CFF0] text-slate-800 py-2 rounded-lg text-sm font-bold">Simpan</button>
            </div>
        </form>
    </div>
</body>
</html>
</body>
</html>