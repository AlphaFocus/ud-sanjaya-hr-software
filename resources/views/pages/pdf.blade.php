{{-- <x-app-layout> --}}
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        {{-- <title>Document</title> --}}
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        {{-- <style>
            table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
            }
        </style> --}}
    </head>
    <body class="flex flex-col space-y-2">
        <div class="flex items-center justify-center">
            <img class="h-16" src="{{ asset("img/logo.svg") }}" alt="">

            <div class="flex flex-col flex-auto text-center">
                <span class="text-3xl font-bold mb-2">UD. Sanjaya</span>
                <span class="text-md text-sm">Banjar Anyar, Kediri, Tabanan, Bali 82123</span>
                <span class="text-md text-sm">Telpon: 085 739 203 332, e-mail: ud_sanjaya@gmail.com</span>
            </div>

        </div>
        <div class="space-y-1">
            <hr class="border border-black">
            <hr class="border-2 border-black">
        </div>

        <div class="flex flex-row justify-between text-sm">
            <div class="flex flex-col w-56">
                <table>
                    <tr>
                        <td>ID Pegawai</td>
                        <td class="px-4">:</td>
                        <td>{{ sprintf('%04d',$user->id) }}</td>
                    </tr>
                    <tr>
                        <td>Nama Pegawai</td>
                        <td class="px-4">:</td>
                        <td>{{ $user->name }}</td>
                    </tr>
                </table>
            </div>
            <div class="flex flex-col w-96">
                <table>
                    <tr>
                        <td>Jabatan</td>
                        <td class="px-4">:</td>
                        <td>{{ $user->role == 0 ? "Pegawai" : "Admin" }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Bergabung</td>
                        <td class="px-4">:</td>
                        <td>{{ $user->created_at->translatedFormat('l, d F Y') }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="flex justify-center pt-8 pb-4">
            <span class="text-3xl font-semibold">Laporan Produksi Mingguan</span>
        </div>

        <span class="italic text-sm">Per tanggal: {{ Carbon\Carbon::now()->subWeek()->format('d/m/Y') }} - {{ Carbon\Carbon::now()->format('d/m/Y') }}</span>
        <table class="">
            <thead>
                <tr>
                    <th class="px-4 py-1 border border-black">No.</th>
                    <th class="px-4 py-1 border border-black">ID</th>
                    <th class="px-4 py-1 border border-black">Jumlah</th>
                    <th class="px-4 py-1 border border-black">Pendapatan</th>
                    <th class="px-4 py-1 border border-black">Hari</th>
                    <th class="px-4 py-1 border border-black">Tanggal</th>
                    <th class="px-4 py-1 border border-black">Keterangan</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($productions as $prod)
                    <tr>
                        <td class="text-center px-4 py-1 border border-black">{{ $loop->iteration }}</td>
                        <td class="text-right px-4 py-1 border border-black">{{ sprintf('%08d',$prod->id) }}</td>
                        <td class="text-right px-4 py-1 border border-black">{{ $prod->quantity }}</td>
                        <td class="flex justify-between px-4 py-1 border border-black">
                            <span>Rp.</span>
                            <span>{{ number_format($prod->quantity*500, '0', '', '.') }}</span>
                        </td>
                        <td class="px-4 py-1 border border-black">{{ $prod->created_at->translatedFormat('l') }}</td>
                        <td class="px-4 py-1 border border-black">{{ $prod->created_at->translatedFormat('d/F/Y') }}</td>
                        <td class="px-20 py-1 border border-black"></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <script type="text/javascript">
            window.print();

        </script>
    </body>
</html>
    
{{-- </x-app-layout> --}}