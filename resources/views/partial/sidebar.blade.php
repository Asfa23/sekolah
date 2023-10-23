<aside class="w-[39vh] h-[92vh] p-6 rounded-lg m-8 bg-gradient-to-t from-purple-600 to-purple-400 flex flex-col items-center space-y-7">         
    <div class="bg-gradient-to-r from-purple-700 to-purple-500 rounded-2xl flex items-center justify-center mt-4 p-[2.2rem]">
        <img src="{{ URL::asset("img/student.svg")}}" alt="Student Icon" class="w-20 h-20">
    </div>

    <ul class="space-y-6">        
        <li>
            <a href="/dashboard" class="text-white hover:underline flex items-center">
                <img src="{{ URL::asset("img/i.svg")}}" alt="Payment Icon" class="w-6 h-6 mr-2 font-bold">
                About
            </a>
        </li>
        {{-- Siswa --}}
        @if (Auth::user()->role == 'siswa')
        <li>
            <a href="/dashboard/pembayaran" class="text-white hover:underline flex items-center">
                <img src="{{ URL::asset("img/payment.svg") }}" alt="Payment Icon" class="w-6 h-6 mr-2 font-bold">
                Pembayaran
            </a>
        </li>
        <li>
            <a href="/dashboard/history_pembayaran" class="text-white hover:underline flex items-center">
                <img src="{{ URL::asset("img/history.svg") }}" alt="Payment Icon" class="w-6 h-6 mr-2 font-bold">
                History
            </a>
        </li>
        @endif
       {{-- End Siswa --}}

       {{-- Staff --}}
       @if (Auth::user()->role == 'staff')
       <li>
            <a href="/dashboard/pembayaran" class="text-white hover:underline flex items-center">
                <img src="{{ URL::asset("img/input_pembayaran.svg") }}" alt="Payment Icon" class="w-6 h-6 mr-2 font-bold">
                Input Pembayaran
            </a>
        </li>
        <li>
            <a href="/dashboard/lihat_pembayaran_siswa" class="text-white hover:underline flex items-center">
                <img src="{{ URL::asset("img/data_pembayaran.svg") }}" alt="Payment Icon" class="w-6 h-6 mr-2 font-bold">
                Data Pembayaran
            </a>
        </li>
        <li>
            <a href="/dashboard/pengeluaran" class="text-white hover:underline flex items-center">
                <img src="{{ URL::asset("img/input_pengeluaran.svg") }}" alt="Payment Icon" class="w-6 h-6 mr-2 font-bold">
                Input Pengeluaran
            </a>
        </li>            
        <li>
            <a href="/dashboard/lihat_pengeluaran" class="text-white hover:underline flex items-center">
                <img src="{{ URL::asset("img/data_pengeluaran.svg") }}" alt="Payment Icon" class="w-6 h-6 mr-2 font-bold">
                Data Pengeluaran
            </a>
        </li>
        @endif
       {{-- End Staff --}}

       {{-- Super --}}
       @if (Auth::user()->role == 'superAdmin')
       <li>
        <a href="{{ route('manajemen_user') }}" class="text-white hover:underline flex items-center">
            <img src="{{ URL::asset("img/user.svg") }}" alt="Payment Icon" class="w-6 h-6 mr-2 font-bold">
            Manajemen User
        </a>
        </li>
       <li>
            <a href="/dashboard/pembayaran" class="text-white hover:underline flex items-center">
                <img src="{{ URL::asset("img/input_pembayaran.svg") }}" alt="Payment Icon" class="w-6 h-6 mr-2 font-bold">
                Input Pembayaran
            </a>
        </li>
        <li>
            <a href="/dashboard/lihat_pembayaran_siswa" class="text-white hover:underline flex items-center">
                <img src="{{ URL::asset("img/data_pembayaran.svg") }}" alt="Payment Icon" class="w-6 h-6 mr-2 font-bold">
                Data Pembayaran
            </a>
        </li>
        <li>
            <a href="/dashboard/pengeluaran" class="text-white hover:underline flex items-center">
                <img src="{{ URL::asset("img/input_pengeluaran.svg") }}" alt="Payment Icon" class="w-6 h-6 mr-2 font-bold">
                Input Pengeluaran
            </a>
        </li>            
        <li>
            <a href="/dashboard/lihat_pengeluaran" class="text-white hover:underline flex items-center">
                <img src="{{ URL::asset("img/data_pengeluaran.svg") }}" alt="Payment Icon" class="w-6 h-6 mr-2 font-bold">
                Data Pengeluaran
            </a>
        </li>
        @endif
       {{-- End Super --}}

        <li>
            <a href="/calculate_totals" class="text-white hover:underline flex items-center">
                <img src="{{ URL::asset("img/report.svg")}}" alt="Money Report Icon" class="w-6 h-6 mr-2 font-bold">
                Money Report
            </a>
        </li>
        <li>
            <a href="/logout" class="text-white hover:underline flex items-center">
                <img src="{{ URL::asset("img/logout.svg")}}" alt="Logout Icon" class="w-6 h-6 mr-2 font-bold">
                Logout
            </a>
        </li>
    </ul>
</aside>