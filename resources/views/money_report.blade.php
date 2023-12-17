@extends('layout.main')

@section('contain')

@include('partial.sidebar')
<div class="flex flex-col w-3/4 p-8">
<main class="">
        <h1 class="text-5xl font-bold mb-6">Money Report</h1>

        @php
        $totalPemasukan = $totals->whereIn('KATEGORI', ['Pembayaran Siswa', 'Bantuan Pemerintah', 'Pemasukan Lainnya'])->sum('TOTAL_PERKATEGORI');
        $totalPengeluaran = $totals->whereNotIn('KATEGORI', ['Pembayaran Siswa', 'Bantuan Pemerintah', 'Pemasukan Lainnya'])->sum('TOTAL_PERKATEGORI');
        $sisa = $totalPemasukan - $totalPengeluaran;
        @endphp
        
        <div class="flex items-center justify-between text-lg font-semibold bg-gradient-to-l from-purple-700 to-purple-500 p-1 text-white rounded-md">
            <div class="flex items-center flex-grow">
                <span class="mx-auto">Alokasi Dana</span>
            </div>
            <button onclick="toggleVisualization()" class="p-1 px-1 h-[3.75vh] ml-1.5 rounded-lg bg-purple-700 hover:bg-purple-600">
                <img src="{{ URL::asset("img/switch.svg") }}" alt="">
            </button>            
        </div>

        <div class="mt-2 bg-white rounded-lg shadow-md p-6">
            <div id="visualization" style="display: none;">
                <canvas id="chart"></canvas>
            </div>
            <div id="table" style="display: block;">
                <table class="table-auto border w-full">
                    <tr class="border">
                        <td class="px-4 py-2 border font-semibold">Total Pemasukan</td>
                        <td class="px-4 py-2 border">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</td>
                    </tr>
                    <tr class="border">
                        <td class="px-4 py-2 border font-semibold ">Total Pengeluaran</td>
                        <td class="px-4 py-2 border">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</td>
                    </tr>
                    <tr class="border ">
                        <td class="px-4 py-2 border font-semibold ">Dana Tersisa</td>
                        <td class="px-4 py-2 border">Rp {{ number_format($sisa, 0, ',', '.') }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-6 mt-6">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="mb-3 text-lg font-semibold bg-gradient-to-l from-purple-700 to-purple-500 p-1 text-white rounded-md text-center">
                    Alokasi Pemasukan Perkategori
                </div>
                <table class="w-full border border-collapse">
                    <thead>
                        <tr>
                            <th class="border p-2">Kategori</th>
                            <th class="border p-2">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($totals as $total)
                            @if(in_array($total->KATEGORI, ['Pembayaran Siswa', 'Bantuan Pemerintah', 'Pemasukan Lainnya']))
                            <tr>
                                <td class="border p-2 text-center">{{ $total->KATEGORI }}</td>
                                <td class="border p-2 text-center">Rp {{ number_format($total->TOTAL_PERKATEGORI, 0, ',', '.') }}</td>
                            </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="mb-3 text-lg font-semibold bg-gradient-to-l from-purple-700 to-purple-500 p-1 text-white rounded-md text-center">
                    Alokasi Pengeluaran Perkategori
                </div>
                <table class="w-full border border-collapse">
                    <thead>
                        <tr>
                            <th class="border p-2">Kategori</th>
                            <th class="border p-2">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($totals as $total)
                            @if(!in_array($total->KATEGORI, ['Pembayaran Siswa', 'Bantuan Pemerintah', 'Pemasukan Lainnya']))
                            <tr>
                                <td class="border p-2 text-center">{{ $total->KATEGORI }}</td>
                                <td class="border p-2 text-center">Rp {{ number_format($total->TOTAL_PERKATEGORI, 0, ',', '.') }}</td>
                            </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Chart.js configuration
            var ctx = document.getElementById('chart').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Total Pemasukan', 'Total Pengeluaran', 'Dana Tersisa'],
                    datasets: [{
                        data: [
                            {{ $totalPemasukan }},
                            {{ $totalPengeluaran }},
                            {{ $sisa }}
                        ],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.6)',
                            'rgba(54, 162, 235, 0.6)',
                            'rgba(255, 205, 86, 0.6)'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                }
            });

            // Toggle function
            function toggleVisualization() {
                var visualization = document.getElementById('visualization');
                var table = document.getElementById('table');

                if (visualization.style.display === 'none') {
                    visualization.style.display = 'block';
                    table.style.display = 'none';
                } else {
                    visualization.style.display = 'none';
                    table.style.display = 'block';
                }
            }
        </script>
    </main>
</div>
@endsection
