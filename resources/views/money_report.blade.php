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

            <div class="overflow-y-scroll max-h-[80vh]">
                <div class="flex items-center justify-between text-lg font-semibold bg-gradient-to-l from-purple-700 to-purple-500 p-1 text-white rounded-md">
                    <div class="flex items-center flex-grow">
                        <span class="mx-auto">Alokasi Dana</span>
                    </div>
                    <button onclick="toggleVisualization()" class="p-1 px-1 h-[3.75vh] ml-1.5 rounded-lg bg-purple-700 hover:bg-purple-600">
                        <img src="{{ URL::asset("img/switch.svg") }}" alt="">
                    </button>
                </div>

                <div class="mt-2 bg-white rounded-lg shadow-md p-6">
                    <div id="visualization" style="display: none;" class="flex flex-col text-sm">
                        <span class="text-lg font-bold">Visualisasi Per-Bulan</span>
                        <div class="flex flex-row items-center mb-2 mt-2"> 
                            <select id="selectChartType" class="border rounded-md p-1 mr-2">
                                <option value="bar" disabled selected>Pilih Visualisasi</option>
                                <option value="bar">Bar Chart</option>
                                <option value="line">Line Chart</option>
                            </select>
                        
                            <select id="selectYear" class="border rounded-md p-1 mr-2">
                                <option value="2023" disabled selected>Pilih Tahun</option>
                                @php
                                    $currentYear = date('Y');
                                @endphp
                                @for ($year = $currentYear; $year >= 2020; $year--)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endfor
                            </select>
                        
                            <select id="selectSemester" class="border rounded-md p-1 mr-2">
                                <option value="Keseluruhan" disabled selected>Pilih Rentang</option>
                                <option value="Keseluruhan">Keseluruhan</option>
                                <option value="Ganjil">Semester Ganjil</option>
                                <option value="Genap">Semester Genap</option>
                            </select>
                        
                            <button onclick="updateChart()" class="p-1 px-2 bg-gradient-to-l from-purple-700 to-purple-500 text-white rounded-md">>></button>
                        </div>
                        <div style="overflow-x: auto;">
                            <canvas id="chart" class="!h-[50vh]"></canvas>
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

                <div id="visualization-semester" class="mt-2 bg-white rounded-lg shadow-md p-6" style="display: none;" class="flex flex-col">
                    <span class="text-lg font-bold">Visualisasi Per-Semester</span>
                    <div class="flex flex-row items-center mb-2 mt-2">
                        <select id="selectChartSemesterType" class="border rounded-md p-1 mr-2">
                            <option value="bar" disabled selected>Pilih Visualisasi</option>
                            <option value="bar">Bar Chart</option>
                            <option value="line">Line Chart</option>
                        </select>
                        <button onclick="updateChartSemester()" class="p-1 px-2 bg-gradient-to-l from-purple-700 to-purple-500 text-white rounded-md">>></button>
                    </div>
                    <div style="overflow-x: auto;">
                        <canvas id="chart-semester" class="!h-[50vh]"></canvas>
                    </div>
                </div>

                <div id="visualization-year" class="mt-2 bg-white rounded-lg shadow-md p-6" style="display: none;" class="flex flex-col">
                    <span class="text-lg font-bold">Visualisasi Per-Tahun</span>
                    <div class="flex flex-row items-center mb-2 mt-2">
                        <select id="selectChartYearType" class="border rounded-md p-1 mr-2">
                            <option value="bar" disabled selected>Pilih Visualisasi</option>
                            <option value="bar">Bar Chart</option>
                            <option value="line">Line Chart</option>
                        </select>
                        <button onclick="updateChartYear()" class="p-1 px-2 bg-gradient-to-l from-purple-700 to-purple-500 text-white rounded-md">>></button>
                    </div>
                    <div style="overflow-x: auto;">
                        <canvas id="chart-year" class="!h-[50vh]"></canvas>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-6 mt-6">
                    <div class="text-lg font-semibold bg-gradient-to-l from-purple-700 to-purple-500 p-1 text-white rounded-md text-center flex items-center">
                        <span class="flex-grow">Alokasi Pemasukan Perkategori</span>
                        <button onclick="toggleVisualization2()" class="p-1 px-1 h-[3.75vh] ml-1.5 rounded-lg bg-purple-700 hover:bg-purple-600">
                            <img src="{{ URL::asset("img/switch.svg") }}" alt="">
                        </button>
                    </div>

                    <div class="text-lg font-semibold bg-gradient-to-l from-purple-700 to-purple-500 p-1 text-white rounded-md text-center flex items-center">
                        <span class="flex-grow">Alokasi Pengeluaran Perkategori</span>
                        <button onclick="toggleVisualization3()" class="p-1 px-1 h-[3.75vh] ml-1.5 rounded-lg bg-purple-700 hover:bg-purple-600">
                            <img src="{{ URL::asset("img/switch.svg") }}" alt="">
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-6 mt-2">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div id="visualization2" style="display: none;" class="flex items-center justify-center flex-wrap">
                            <select id="selectVisualization2" class="border rounded-md p-1 mb-2 text-sm">
                                <option value="pie" disabled selected>Pilih Visualisasi</option>
                                <option value="pie">Pie Chart</option>
                                <option value="bar">Bar Chart</option>
                            </select>
                        
                            <select id="selectYear2" class="border rounded-md p-1 mb-2 text-sm">
                                <option value="2023" disabled selected>Pilih Tahun</option>
                                @php
                                    $currentYear = date('Y');
                                @endphp
                                @for ($year = $currentYear; $year >= 2020; $year--)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endfor
                            </select>
                        
                            <select id="selectSemester2" class="border rounded-md p-1 mb-2 text-sm">
                                <option value="Keseluruhan" disabled selected>Pilih Rentang</option>
                                <option value="Keseluruhan">Keseluruhan</option>
                                <option value="Ganjil">Semester Ganjil</option>
                                <option value="Genap">Semester Genap</option>
                            </select>
                        
                            <button onclick="updateChart2()" class="p-1 px-2 bg-gradient-to-l from-purple-700 to-purple-500 text-white rounded-md text-sm">>></button>
                        
                            <div style="overflow-x: auto;">
                                <canvas id="chart2" class="!h-[20vw] mt-5"></canvas>
                            </div>
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
                        <div id="visualization3" style="display: none;" class="text-sm">
                            <select id="selectVisualization3" class="border rounded-md p-1">
                                <option value="pie" disabled selected>Pilih Visualisasi</option>
                                <option value="pie">Pie Chart</option>
                                <option value="bar">Bar Chart</option>
                            </select>

                            <select id="selectYear3" class="border rounded-md p-1">
                                @php
                                    $currentYear = date('Y');
                                @endphp
                                @for ($year = $currentYear; $year >= 2020; $year--)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endfor
                            </select>

                            <select id="selectSemester3" class="border rounded-md p-1">
                                <option value="Keseluruhan" disabled selected>Pilih Rentang</option>
                                <option value="Keseluruhan">Keseluruhan</option>
                                <option value="Ganjil">Semester Ganjil</option>
                                <option value="Genap">Semester Genap</option>
                            </select>

                            <button onclick="updateChart3()" class="p-1 px-2 bg-gradient-to-l from-purple-700 to-purple-500 text-white rounded-md">>></button>
                            <div style="overflow-x: auto;">
                                <canvas id="chart3" class="!h-[20vw] mt-5"></canvas>
                            </div>
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
            </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('chart').getContext('2d');
        var chart;

        var ctx2 = document.getElementById('chart2').getContext('2d');
        var chart2;

        var ctx3 = document.getElementById('chart3').getContext('2d');
        var chart3;

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
            var selectedSemester = document.getElementById('selectSemester').value;
            var selectedChartType = document.getElementById('selectChartType').value;

            fetch(`/getChartData/${selectedYear}/${selectedSemester}`)
                .then(response => response.json())
                .then(data => {
                    if (chart) {
                        chart.destroy();
                    }

                    var ctx = document.getElementById('chart').getContext('2d');

                    chart = new Chart(ctx, {
                        type: selectedChartType,
                        data: {
                            labels: data.labels,
                            datasets: [
                                {
                                    label: 'Total Pemasukan',
                                    data: data.totalPemasukan,
                                    backgroundColor: '#4BC0C0', 
                                    borderColor: '#4BC0C0', 
                                    fill: false,
                                },
                                {
                                    label: 'Total Pengeluaran Rp',
                                    data: data.totalPengeluaran,
                                    backgroundColor: '#FF6384',
                                    borderColor: '#FF6384',
                                    fill: false,
                                },
                                {
                                    label: 'Dana Tersisa',
                                    data: data.sisa,
                                    backgroundColor: '#36A2EB',
                                    borderColor: '#36A2EB',
                                    fill: false,
                                },
                            ],
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    ticks: {
                                        callback: function (value) {
                                            return 'Rp ' + value.toLocaleString();
                                        }
                                    }
                                }
                            },
                            plugins: {
                                tooltip: {
                                    callbacks: {
                                        label: function (context) {
                                            var label = context.dataset.label || '';

                                            if (label) {
                                                label += ' ';
                                            }

                                            label += 'Rp ' + context.formattedValue;

                                            return label;
                                        }
                                    }
                                }
                            }
                        },
                    });
                });
        }

        function fetchChartData(url, callback) {
            fetch(url)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`Network response was not ok, status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    callback(data);
                })
                .catch(error => {
                    console.error(`Error fetching data from ${url}:`, error);
                });
        }

        function updateChart2() {
            var selectedYear2 = document.getElementById('selectYear2').value;
            var selectedSemester2 = document.getElementById('selectSemester2').value;
            var selectedVisualization2 = document.getElementById('selectVisualization2').value;

            fetch(`/getChartData2/${selectedYear2}/${selectedSemester2}`)
                .then(response => response.json())
                .then(data => {
                    if (chart2) {
                        chart2.destroy();
                    }

                    var ctx2 = document.getElementById('chart2').getContext('2d');
                    if (selectedVisualization2 === 'pie') {
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
                                plugins: {
                                    legend: {
                                        display: true,
                                        position: 'right',
                                    },
                                    tooltip: {
                                        callbacks: {
                                            label: function (context) {
                                                var value = context.formattedValue;

                                                if (context.parsed) {
                                                    value = `Rp ${Math.round(data.totalPemasukanPerkategori[context.dataIndex]).toLocaleString().replace(/(\.\d\d)\d*$/, '$1')} (${(context.parsed / context.dataset.data.reduce((a, b) => a + b, 0) * 100).toFixed(2)}%)`;
                                                }

                                                return value;
                                            }
                                        }
                                    }
                                }
                            }
                        });
                    } else if (selectedVisualization2 === 'bar') {
                        chart2 = new Chart(ctx2, {
                            type: 'bar',
                            data: {
                                labels: data.labels,
                                datasets: [{
                                    label: 'Total Pemasukan Rp', // Modify the legend label here
                                    data: data.totalPemasukanPerkategori,
                                    backgroundColor: data.colors,
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                scales: {
                                    x: { stacked: true },
                                    y: {
                                        stacked: true,
                                        ticks: {
                                            callback: function (value) {
                                                return 'Rp ' + value.toLocaleString().replace(/(\.\d\d)\d*$/, '$1');
                                            }
                                        }
                                    }
                                },
                                plugins: {
                                    legend: {
                                        display: false, // Hide the legend
                                    },
                                    tooltip: {
                                        callbacks: {
                                            label: function (context) {
                                                var value = context.formattedValue;
                                                if (context.parsed) {
                                                    value = `Rp ${Math.round(data.totalPemasukanPerkategori[context.dataIndex]).toLocaleString().replace(/(\.\d\d)\d*$/, '$1')}`;
                                                }
                                                return value;
                                            }
                                        }
                                    }
                                }
                            }
                        });
                    }
                })
                .catch(error => {
                    console.error('Error fetching data for chart 2:', error);
                });
        }

        // Fungsi untuk mengupdate Chart 3 (Alokasi Pengeluaran Perkategori)
        function updateChart3() {
            var selectedYear3 = document.getElementById('selectYear3').value;
            var selectedSemester3 = document.getElementById('selectSemester3').value;
            var selectedVisualization3 = document.getElementById('selectVisualization3').value;

            // Update chart3 based on the selected visualization type
            fetch(`/getChartData3/${selectedYear3}/${selectedSemester3}`)
                .then(response => response.json())
                .then(data => {
                    if (chart3) {
                        chart3.destroy();
                    }

                    var ctx3 = document.getElementById('chart3').getContext('2d');
                    if (selectedVisualization3 === 'pie') {
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
                                plugins: {
                                    legend: {
                                        display: true,
                                        position: 'right',
                                    },
                                    tooltip: {
                                        callbacks: {
                                            label: function (context) {
                                                var value = context.formattedValue;

                                                if (context.parsed && context.dataset.data.reduce((a, b) => a + b, 0) !== 0) {
                                                    value = `Rp ${Math.round(data.totalPengeluaranPerkategori[context.dataIndex]).toLocaleString().replace(/(\.\d\d)\d*$/, '$1')} (${(context.parsed / context.dataset.data.reduce((a, b) => a + b, 0) * 100).toFixed(2)}%)`;
                                                } else {
                                                    value = `Rp ${Math.round(data.totalPengeluaranPerkategori[context.dataIndex]).toLocaleString().replace(/(\.\d\d)\d*$/, '$1')} (0%)`;
                                                }

                                                return value;
                                            }
                                        }
                                    }
                                }
                            }
                        });
                    } else if (selectedVisualization3 === 'bar') {
                        chart3 = new Chart(ctx3, {
                            type: 'bar',
                            data: {
                                labels: data.labels,
                                datasets: [{
                                    label: 'Total Pengeluaran Rp', // Modify the legend label here
                                    data: data.totalPengeluaranPerkategori,
                                    backgroundColor: data.colors,
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                scales: {
                                    x: { stacked: true },
                                    y: {
                                        stacked: true,
                                        ticks: {
                                            callback: function (value) {
                                                return 'Rp ' + value.toLocaleString().replace(/(\.\d\d)\d*$/, '$1');
                                            }
                                        }
                                    }
                                },
                                plugins: {
                                    legend: {
                                        display: false, // Hide the legend
                                    },
                                    tooltip: {
                                        callbacks: {
                                            label: function (context) {
                                                var value = context.formattedValue;
                                                if (context.parsed && context.dataset.data.reduce((a, b) => a + b, 0) !== 0) {
                                                    value = `Rp ${Math.round(data.totalPengeluaranPerkategori[context.dataIndex]).toLocaleString().replace(/(\.\d\d)\d*$/, '$1')}`;
                                                } else {
                                                    value = `Rp ${Math.round(data.totalPengeluaranPerkategori[context.dataIndex]).toLocaleString().replace(/(\.\d\d)\d*$/, '$1')} (0%)`;
                                                }
                                                return value;
                                            }
                                        }
                                    }
                                }
                            }
                        });
                    }
                })
                .catch(error => {
                    console.error('Error fetching data for chart 3:', error);
                });
        }

        var chartSemester;  // Deklarasi variabel chartSemester di tingkat global

        document.addEventListener("DOMContentLoaded", function () {
            updateChartSemester();
        });

        function updateChartSemester() {
            var selectedChartType = document.getElementById('selectChartSemesterType').value;

            fetch(`/getChartDataSemester`)
                .then(response => response.json())
                .then(data => {
                    if (chartSemester) {
                        chartSemester.destroy();
                    }

                    var ctxSemester = document.getElementById('chart-semester').getContext('2d');

                    chartSemester = new Chart(ctxSemester, {
                        type: selectedChartType,
                        data: {
                            labels: data.labels,
                            datasets: [
                                {
                                    label: 'Total Pemasukan',
                                    data: data.totalPemasukan,
                                    backgroundColor: '#4BC0C0',
                                    borderColor: '#4BC0C0',
                                    fill: false,
                                },
                                {
                                    label: 'Total Pengeluaran Rp',
                                    data: data.totalPengeluaran,
                                    backgroundColor: '#FF6384',
                                    borderColor: '#FF6384',
                                    fill: false,
                                },
                                {
                                    label: 'Dana Tersisa',
                                    data: data.sisa,
                                    backgroundColor: '#36A2EB',
                                    borderColor: '#36A2EB',
                                    fill: false,
                                },
                            ],
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    ticks: {
                                        callback: function (value) {
                                            return 'Rp ' + value.toLocaleString();
                                        }
                                    }
                                }
                            },
                            plugins: {
                                tooltip: {
                                    callbacks: {
                                        label: function (context) {
                                            var label = context.dataset.label || '';

                                            if (label) {
                                                label += ' ';
                                            }

                                            label += 'Rp ' + context.formattedValue;

                                            return label;
                                        }
                                    }
                                }
                            }
                        },
                    });
                });
        }

        var chartYear; 

        document.addEventListener("DOMContentLoaded", function () {
            updateChartYear();
        });

        function updateChartYear() {
            var selectedChartType = document.getElementById('selectChartYearType').value;

            // Ganti URL sesuai dengan endpoint yang benar untuk data tahun
            fetch(`/getChartDataYear`)
                .then(response => response.json())
                .then(data => {
                    if (chartYear) {
                        chartYear.destroy();
                    }

                    var ctxYear = document.getElementById('chart-year').getContext('2d');

                    chartYear = new Chart(ctxYear, {
                        type: selectedChartType,
                        data: {
                            labels: data.labels,
                            datasets: [
                                {
                                    label: 'Total Pemasukan',
                                    data: data.totalPemasukan,
                                    backgroundColor: '#4BC0C0',
                                    borderColor: '#4BC0C0',
                                    fill: false,
                                },
                                {
                                    label: 'Total Pengeluaran Rp',
                                    data: data.totalPengeluaran,
                                    backgroundColor: '#FF6384',
                                    borderColor: '#FF6384',
                                    fill: false,
                                },
                                {
                                    label: 'Dana Tersisa',
                                    data: data.sisa,
                                    backgroundColor: '#36A2EB',
                                    borderColor: '#36A2EB',
                                    fill: false,
                                },
                            ],
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    ticks: {
                                        callback: function (value) {
                                            return 'Rp ' + value.toLocaleString();
                                        }
                                    }
                                }
                            },
                            plugins: {
                                tooltip: {
                                    callbacks: {
                                        label: function (context) {
                                            var label = context.dataset.label || '';

                                            if (label) {
                                                label += ' ';
                                            }

                                            label += 'Rp ' + context.formattedValue;

                                            return label;
                                        }
                                    }
                                }
                            }
                        },
                    });
                });
        }


        updateChart();

        function toggleVisualization() {
            var visualization = document.getElementById('visualization');
            var table = document.getElementById('table');
            var visualizationSemester = document.getElementById('visualization-semester');
            var visualizationYear = document.getElementById('visualization-year');

            if (visualization.style.display === 'none') {
                visualization.style.display = 'block';
                table.style.display = 'none';
                visualizationSemester.style.display = 'block';
                visualizationYear.style.display = 'block';
            } else {
                visualization.style.display = 'none';
                table.style.display = 'block';
                visualizationSemester.style.display = 'none';
                visualizationYear.style.display = 'none';
            }
        }

        function toggleVisualization2() {
            var visualization2 = document.getElementById('visualization2');
            var table2 = document.getElementById('table2');

            if (visualization2.style.display === 'none') {
                visualization2.style.display = 'block';
                table2.style.display = 'none';
                updateChart2();
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
                updateChart3();
            } else {
                visualization3.style.display = 'none';
                table3.style.display = 'block';
            }
        }

    </script>   
        </main>
    </div>
@endsection
