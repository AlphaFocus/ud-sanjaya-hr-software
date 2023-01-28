<div class="flex flex-col lg:flex-row w-full h-full space-y-4 lg:space-x-4 lg:space-y-0 p-2">

    {{-- {{ $prod2Week }} --}}

    {{-- Left Section --}}
    <div class="flex flex-col sm:flex-row lg:flex-col w-full lg:w-1/3 space-y-4 sm:space-x-4 lg:space-y-4 lg:space-x-0">
        {{-- Name Card --}}
        <div class="flex flex-col sm:w-1/2 lg:w-full p-4 space-y-4 overflow-hidden bg-white border border-gray-100 rounded-lg shadow-md">
            
            <div class="flex items-center justify-center mx-auto overflow-hidden rounded-full h-fit w-fit relative">
                <img style="object-fit: cover;height: 100px; width: 100px" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}">
            </div>

            <div class="flex flex-col justify-between flex-auto space-y-2">
                <div class="flex flex-row justify-between ">
                    <div class="text-xs text-gray-400">ID: {{ sprintf('%04d', $user->id) }}</div>
                    <div class="text-xs italic text-gray-400">Bergabung pada {{ $user->created_at->TranslatedFormat('d F Y') }}</div>
                </div>
                <div class="flex flex-col">
                    <span class="px-2 text-sm text-white {{ $user->role == 0 ? 'bg-gray-400' : 'bg-green-500' }} rounded-lg shadow-md w-fit">{{ $user->role == 0 ? 'Pegawai' : 'Admin' }}</span>
                    <span class="text-2xl font-semibold text-gray-800">{{ $user->name }}</span>
                    <span class="text-sm text-gray-500">{{ $user->email }}</span>
                </div>
                <div class="flex flex-row space-x-1">
                    <button class="flex items-center justify-center text-lg text-white bg-green-500 rounded-lg shadow-md w-7 h-7"><i class="fab fa-whatsapp"></i></button>
                    <button class="flex items-center justify-center text-white bg-blue-500 rounded-lg shadow-md w-7 h-7"><i class="fab fa-linkedin-in"></i></button>
                </div>
            </div>
        </div>

        {{-- Charts --}}
        <div class="flex flex-col flex-auto justify-between space-y-4">
            {{-- Sallary --}}
            <div class="flex flex-row flex-auto w-full bg-white border border-gray-100 rounded-lg shadow-md">
                <div class="flex flex-col w-1/2 p-4 justify-items-stretch">
                    <span class="text-xl font-semibold text-gray-800">Pendapatan</span>
                    <span class="text-sm text-gray-400">7 produksi terakhir</span>
                    @php
                        $prodTotal = $prod2Week == 0 ? ($prodWeek->sum('quantity') > 0 ? $prodWeek->sum('quantity') : 0) : number_format((($prodWeek->sum('quantity')-$prod2Week)/$prod2Week)*100,2);
                    @endphp
                    <span class="text-sm {{ $prodTotal == 0 ? 'text-gray-500' : ($prodTotal > 0 ? "text-green-500" : "text-red-500") }}">
                        {{ $prodTotal == 0 ? '--' : ($prodTotal > 0 ? "▲" : "▼") }}
                        {{ $prodTotal == 0 ? 0 : ($prodTotal > 0 ? "+".$prodTotal : $prodTotal) }}%
                    </span>
                    <span class="flex items-end flex-auto text-xl font-semibold text-gray-600">Rp. {{ number_format($prodWeek->sum('quantity')*500, '0', '', '.') }}</span>
                </div>
            
                <div wire:ignore class="relative w-1/2">
                    <canvas id="userSallary" class="pt-8"></canvas>
                </div>
            </div>

            {{-- Productions --}}
            <div class="flex flex-row flex-auto w-full bg-white border border-gray-100 rounded-lg shadow-md">
                <div class="flex flex-col w-1/2 p-4">
                    <span class="text-xl font-semibold text-gray-800">Produksi</span>
                    <span class="text-sm text-gray-400">7 produksi terakhir</span>
                    <span class="text-sm {{ $prodTotal >= 0 ? 'text-green-500' : 'text-red-500' }}">{{ $prodTotal >= 0 ? '▲' : '▼' }} {{ $prodTotal >= 0 ? '+'.$prodTotal : $prodTotal }}%</span>
                    <span class="flex items-end flex-auto text-xl font-semibold text-gray-600">{{ number_format($prodWeek->sum('quantity'), '0', '', '.') }}</span>
                </div>
            
                <div wire:ignore class="relative w-1/2">
                    <canvas id="userProductions" class="pt-8"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- Right Section --}}
    <div class="flex flex-col justify-between flex-auto p-4 bg-white rounded-lg shadow-md">
        <div class="flex flex-col space-y-4">
            {{-- Button Wrap --}}
            <div class="flex flex-row justify-between text-xs text-white">
                {{-- Search Bar --}}
                <div class="relative w-1/4 text-gray-600">
                    <input wire:model="search" class="h-10 px-5 pr-16 text-sm bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-0"
                        type="search" name="search" placeholder="Cari produksi...">
                </div>
                <div class="flex flex-row items-center justify-center space-x-1">
                    @if ($role == 1)
                        <button onclick="Livewire.emit('openModal', 'create-production', {{ json_encode(['user_id' => $user->id]) }})" class="flex items-center justify-center bg-blue-500 rounded-lg hover:bg-blue-600 h-7 w-7">
                            <i class="fas fa-plus"></i>
                        </button>
                        
                        <a href="export/{{ $user->id }}" target="_blank">
                            <button class="flex items-center justify-center bg-red-500 rounded-lg hover:bg-red-600 h-7 w-7">
                                <i class="fas fa-print"></i>
                            </button>
                        </a>
                    @endif
                </div>
            </div>
            
            {{-- Table --}}
            <table class="w-full divide-y divide-gray-200 rounded-lg table-auto h-fit">
                <thead class="sticky top-0 bg-gray-50">
                    <tr>
                        <td scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase hidden md:table-cell">ID</td>
                        <td scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">
                            <span class="hidden xl:inline">Jumlah</span>
                            Produksi
                        </td>
                        <td scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Pendapatan</td>
                        <td scope="col" class="hidden px-6 py-3 text-xs font-medium text-center text-gray-500 uppercase sm:table-cell">Tanggal</td>
                        @if ($role == 1)
                            <td scope="col" class="px-6 py-3 text-xs font-medium text-center text-gray-500 uppercase">Aksi</td>
                        @endif
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($productions as $prod)
                        <tr>
                            {{-- ID --}}
                            <td scope="col" class="px-6 py-4 text-sm text-gray-900 hidden md:table-cell">
                                {{ sprintf('%08d', $prod->id) }}
                            </td>
                            {{-- Qty --}}
                            <td scope="col" class="px-6 {{ $updateState == 0 ? 'py-4' : 'py0' }} text-sm text-right text-gray-900">
                                @if ($updateState == $prod->id)
                                    <form action="update" wire:submit.prevent="update({{ $prod->id }})" x-data x-init="$refs.answer.focus()">
                                        <input x-ref="answer" type="number" wire:model="prodModel" class="rounded-lg focus:outline-none focus:ring-0 text-right h-fit" name="quantity" autofocus required>
                                    </form>
                                @else
                                    {{ $prod->quantity }}
                                @endif
                            </td>
                            {{-- Pendapatan --}}
                            <td scope="col" class="px-6 py-4 text-sm text-gray-900">
                                Rp. {{ number_format($prod->quantity*500, '0', '', '.') }}
                            </td>
                            {{-- Dibuat --}}
                            <td scope="col" class="flex-col px-6 py-4 text-sm text-gray-900 hidden sm:table-cell">
                                {{ $prod->created_at->TranslatedFormat('d F Y') }}
                                <span class="text-xs text-gray-500 hidden md:block">{{ $prod->created_at->diffForHumans() }}</span>
                            </td>
                            {{-- Aksi --}}
                            @if ($role == 1)
                                <td scope="col" class="px-6 py-4 space-x-1 text-white">
                                    <div class="flex flex-row items-center justify-center space-x-1">
                                        @if ($updateState == $prod->id)
                                            <form action="update" wire:submit.prevent="update({{ $prod->id }})">
                                                <button type="submit" class="flex items-center justify-center text-xs transition duration-200 transform bg-blue-500 rounded-lg hover:bg-blue-600 h-7 w-7">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>

                                            <button wire:click="cancel" class="flex items-center justify-center text-xs transition duration-200 transform bg-gray-500 rounded-lg hover:bg-gray-600 h-7 w-7">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        @else
                                            <button wire:click="showUpdateForm({{ $prod->id }})" class="flex items-center justify-center text-xs transition duration-200 transform bg-blue-500 rounded-lg hover:bg-blue-600 h-7 w-7">
                                                <i class="fas fa-pen"></i>
                                            </button>
                                                
                                            <button wire:click="deleteModal({{ $prod->id }})" class="flex items-center justify-center text-xs transition duration-200 transform bg-red-500 rounded-lg hover:bg-red-600 h-7 w-7">
                                                <i class="fas fa-minus-square"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $productions->links() }}
    </div>

    {{-- Script Section --}}

        {{-- Chart Script --}}
        <script>
            const chartOptions = {
                maintainAspectRatio: false,
                legend: {
                    display: false,
                },
                tooltips: {
                    enabled: false,
                },
                elements: {
                    point: {
                        radius: 0
                    },
                },
                scales: {
                    xAxes: [{
                        gridLines: false,
                        scaleLabel: false,
                        ticks: {
                            display: false
                        }
                    }],
                    yAxes: [{
                        gridLines: false,
                        scaleLabel: false,
                        ticks: {
                            display: false,
                            suggestedMin: 0,
                            suggestedMax: 10
                        }
                    }]
                }
            };
            //
            ctx = document.getElementById('userSallary').getContext('2d');
            chart = new Chart(ctx, {
                type: "line",
                data: {
                    // labels: [0, 2, 1, 3, 5, 4, 7],
                    labels: [0,
                        @foreach ($prodWeek->latest()->get()->take(8)->reverse() as $sallary)
                            {{ $sallary->quantity }},
                        @endforeach
                    ],
                    datasets: [
                        {
                            backgroundColor: "rgba(101, 116, 205, 0.1)",
                            borderColor: "rgba(101, 116, 205, 0.8)",
                            borderWidth: 2,
                            // data: [0, 2, 1, 3, 5, 4, 7],
                            data: [0,
                                @foreach ($prodWeek->latest()->get()->take(8)->reverse() as $sallary)
                                    {{ $sallary->quantity }},
                                @endforeach
                            ],
                        },
                    ],
                },
                options: chartOptions
            });
            //
            ctx = document.getElementById('userProductions').getContext('2d');
            chart = new Chart(ctx, {
                type: "line",
                data: {
                    // labels: [0, 2, 1, 3, 5, 4, 7],
                    labels: [0,
                        @foreach ($prodWeek->latest()->get()->take(8)->reverse() as $production)
                            {{ $production->quantity }},
                        @endforeach
                    ],
                    datasets: [
                        {
                            backgroundColor: "rgba(246, 109, 155, 0.1)",
                            borderColor: "rgba(246, 109, 155, 0.8)",
                            borderWidth: 2,
                            // data: [0, 2, 1, 3, 5, 4, 7],
                            data: [0,
                                @foreach ($prodWeek->latest()->get()->take(8)->reverse() as $production)
                                    {{ $production->quantity }},
                                @endforeach
                            ],
                        },
                    ],
                },
                options: chartOptions
            });
        </script>

        <script>
            window.addEventListener('delete-confirmation', event=>{
                Swal.fire({
                    title: 'Hapus data produksi?',
                    // text: 'Pegawawai akan dihapus...',
                    footer: "Data yang telah dihapus tidak dapat dikembalikan",
                    icon: 'warning',

                    // width: '400px',

                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, saya yakin',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emit('deleteConfirmed')
                    }
                })
            })

            window.addEventListener('updated', event=>{
                Swal.fire({
                    title: 'Data produksi berhasil diupdate', 
                    toast: true,
                    position: 'top',
                    icon: 'success',
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                })
            })

            window.addEventListener('deleted', event=>{
                Swal.fire({
                    title: 'Data produksi telah dihapus', 
                    toast: true,
                    position: 'top',
                    icon: 'error',
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                })
            })
        </script>
</div>
