<!-- resources/views/money_report.blade.php -->

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
                    <label for="selectYear" class="text-lg font-semibold">Pilih Tahun:</label>
                    <select id="selectYear" class="border rounded-md p-1">
                        @php
                            $currentYear = date('Y');
                        @endphp
                        @for ($year = $currentYear; $year >= 2020; $year--)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endfor
                    </select>
                    <button onclick="updateChart()">Tampilkan</button>
                    <div style="overflow-x: auto;">
                        <canvas id="chart"></canvas>
                    </div>
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
                    <div class="mb-3 text-lg font-semibold bg-gradient-to-l from-purple-700 to-purple-500 p-1 text-white rounded-md text-center flex items-center">
                        <span class="flex-grow">Alokasi Pemasukan Perkategori</span>
                        <button onclick="toggleVisualization2()" class="p-1 px-1 h-[3.75vh] ml-1.5 rounded-lg bg-purple-700 hover:bg-purple-600">
                            <img src="{{ URL::asset("img/switch.svg") }}" alt="">
                        </button> 
                    </div>
                    <div id="visualization2" style="display: none;">
                        <canvas id="chart2"></canvas>
                    </div>
                    <div id="table2" style="display: block;">
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
                </div>
            
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="mb-3 text-lg font-semibold bg-gradient-to-l from-purple-700 to-purple-500 p-1 text-white rounded-md text-center flex items-center">
                        <span class="flex-grow">Alokasi Pengeluaran Perkategori</span>
                        <button onclick="toggleVisualization3()" class="p-1 px-1 h-[3.75vh] ml-1.5 rounded-lg bg-purple-700 hover:bg-purple-600">
                            <img src="{{ URL::asset("img/switch.svg") }}" alt="">
                        </button> 
                    </div>
                    <div id="visualization3" style="display: none;">
                        <canvas id="chart3"></canvas>
                    </div>
                    <div id="table3" style="display: block;">
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
            </div>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                var ctx = document.getElementById('chart').getContext('2d');
                var chart;

                var ctx2 = document.getElementById('chart2').getContext('2d');
                var chart2;

                var ctx3 = document.getElementById('chart3').getContext('2d');
                var chart3;

                // Initialize data2 and data3 with default values
                var data2 = {
                    labels: [],
                    totalPemasukanPerkategori: [],
                    colors: [],
                };

                var data3 = {
                    labels: [],
                    totalPengeluaranPerkategori: [],
                    colors: [],
                };

                function updateChart() {
                    var selectedYear = document.getElementById('selectYear').value;

                    // Gunakan AJAX untuk mengambil data berdasarkan tahun yang dipilih
                    fetch('/getChartData/' + selectedYear)
                        .then(response => response.json())
                        .then(data => {
                            if (chart) {
                                chart.destroy(); // Hancurkan grafik yang ada jika ada
                            }

                            chart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: data.labels,
                                    datasets: [{
                                        label: 'Total Pemasukan',
                                        data: data.totalPemasukan,
                                        backgroundColor: 'rgba(255, 99, 132, 0.6)',
                                    }, {
                                        label: 'Total Pengeluaran',
                                        data: data.totalPengeluaran,
                                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                                    }, {
                                        label: 'Dana Tersisa',
                                        data: data.sisa,
                                        backgroundColor: 'rgba(255, 205, 86, 0.6)',
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    maintainAspectRatio: false,
                                }
                            });

                            // Inisialisasi chart2 dan chart3
                            chart2 = new Chart(ctx2, {
                                type: 'doughnut',
                                data: {
                                    labels: data.data2.labels,
                                    datasets: [{
                                        data: data.data2.totalPemasukanPerkategori,
                                        backgroundColor: data.data2.colors,
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    maintainAspectRatio: false,
                                }
                            });

                            chart3 = new Chart(ctx3, {
                                type: 'doughnut',
                                data: {
                                    labels: data.data3.labels,
                                    datasets: [{
                                        data: data.data3.totalPengeluaranPerkategori,
                                        backgroundColor: data.data3.colors,
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    maintainAspectRatio: false,
                                }
                            });
                        })
                        .catch(error => console.error('Error:', error));
                }

                function updateChart2(data) {
                    console.log('Data for chart2:', data);
                    if (chart2) {
                        chart2.destroy();
                    }

                    chart2 = new Chart(ctx2, {
                        type: 'doughnut',
                        data: {
                            labels: data.labels,
                            datasets: [{
                                data: data.totalPemasukanPerkategori,
                                backgroundColor: data.colors,
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                        }
                    });
                }

                function updateChart3(data) {
                     console.log('Data for chart3:', data);
                    if (chart3) {
                        chart3.destroy();
                    }

                    chart3 = new Chart(ctx3, {
                        type: 'doughnut',
                        data: {
                            labels: data.labels,
                            datasets: [{
                                data: data.totalPengeluaranPerkategori,
                                backgroundColor: data.colors,
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                        }
                    });
                }

                // Render grafik pertama kali
                updateChart();

                function toggleVisualization() {
                    console.log('Toggle Visualization called');
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

                function toggleVisualization2() {
                    var visualization2 = document.getElementById('visualization2');
                    var table2 = document.getElementById('table2');

                    if (visualization2.style.display === 'none') {
                        visualization2.style.display = 'block';
                        table2.style.display = 'none';
                        updateChart2(data2); // Use the data2 variable
                    } else {
                        visualization2.style.display = 'none';
                        table2.style.display = 'block';
                    }
                }

                function toggleVisualization3() {
                    var visualization3 = document.getElementById('visualization3');
                    var table3 = document.getElementById('table3');

                    if (visualization3.style.display === 'none') {
                        visualization3.style.display = 'block';
                        table3.style.display = 'none';
                        updateChart3(data3); // Use the data3 variable
                    } else {
                        visualization3.style.display = 'none';
                        table3.style.display = 'block';
                    }
                }
            </script>

        </main>
    </div>
@endsection
