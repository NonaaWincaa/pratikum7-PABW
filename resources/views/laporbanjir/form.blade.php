<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lapor Banjir - BPBD Kabupaten Bandung</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        babyBlue: '#89CFF0',
                        softCream: '#F9F3DC',
                        softBrown: '#BCA38F',
                        mutedGold: '#C69968'
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-softCream font-sans text-slate-800 antialiased min-h-screen flex items-center justify-center py-10 px-4">

    <div class="w-full max-w-2xl bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden">
        <!-- Header Baby Blue -->
        <div class="bg-babyBlue px-6 py-5 text-slate-800 flex items-center gap-3 border-b border-blue-200">
            <i class="fa-solid fa-water text-2xl text-slate-700"></i>
            <div>
                <h2 class="text-xl font-bold tracking-wide">Form Laporan Darurat Banjir</h2>
                <p class="text-xs font-medium text-slate-700">BPBD Kabupaten Bandung</p>
            </div>
        </div>

        <div class="p-6 md:p-8">
            <!-- Pesan Sukses -->
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg flex items-center gap-2 text-sm font-medium">
                    <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1">Nama Pelapor <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_pelapor" value="{{ old('nama_pelapor') }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-babyBlue focus:border-babyBlue outline-none transition text-sm bg-slate-50">
                        @error('nama_pelapor') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1">No. Handphone <span class="text-red-500">*</span></label>
                        <input type="text" name="no_hp" value="{{ old('no_hp') }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-babyBlue focus:border-babyBlue outline-none transition text-sm bg-slate-50">
                        @error('no_hp') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1">Kecamatan <span class="text-red-500">*</span></label>
                        <input type="text" name="kecamatan" value="{{ old('kecamatan') }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-babyBlue focus:border-babyBlue outline-none transition text-sm bg-slate-50">
                        @error('kecamatan') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1">Tinggi Air (cm) <span class="text-red-500">*</span></label>
                        <input type="number" name="tinggi_air" value="{{ old('tinggi_air') }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-babyBlue focus:border-babyBlue outline-none transition text-sm bg-slate-50">
                        @error('tinggi_air') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1">Lokasi Detail <span class="text-red-500">*</span></label>
                    <textarea name="lokasi" rows="2" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-babyBlue focus:border-babyBlue outline-none transition text-sm bg-slate-50">{{ old('lokasi') }}</textarea>
                    @error('lokasi') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1">Keterangan Tambahan</label>
                    <textarea name="keterangan" rows="3" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-babyBlue focus:border-babyBlue outline-none transition text-sm bg-slate-50">{{ old('keterangan') }}</textarea>
                    @error('keterangan') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1">Bukti Foto <span class="text-red-500">*</span></label>
                    <input type="file" name="foto" accept="image/jpeg, image/png" class="w-full px-4 py-2 rounded-lg border border-slate-300 focus:ring-2 focus:ring-babyBlue text-sm bg-white file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-softBrown/20 file:text-softBrown hover:file:bg-softBrown/30 transition">
                    <p class="text-[10px] text-slate-400 mt-1">Format JPG/PNG, maksimal 2MB.</p>
                    @error('foto') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full bg-babyBlue hover:bg-[#72bcdb] text-slate-800 font-bold py-3 px-4 rounded-xl transition duration-200 shadow-sm flex justify-center items-center gap-2">
                        <i class="fa-solid fa-paper-plane"></i> Kirim Laporan Darurat
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>