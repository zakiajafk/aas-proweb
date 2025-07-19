@extends('layouts.app')

@section('content')
<div class="bg-gray-900 text-white min-h-screen">
   <!-- Booking Form -->
   <div class="max-w-2xl mx-auto mt-10 bg-white p-8 rounded text-black">
      <h2 class="text-2xl font-bold mb-6">Select a time</h2>

      @if(session('error'))
         <div class="bg-red-500 text-white p-3 rounded mb-4">
            {{ session('error') }}
         </div>
      @endif

      <form action="{{ route('booking') }}" method="POST">
          @csrf

          {{-- Tombol waktu booking --}}
          @php
              function renderTimeButtons($dayLabel, $offsetDays, $bookedSlots) {
                  $startHour = 10;
                  $endHour = 20;
                  echo "<div class='mb-4'><h3 class='font-semibold mb-2'>$dayLabel</h3><div class='flex flex-wrap gap-2'>";
                  for ($i = $startHour; $i <= $endHour; $i++) {
                      $time = sprintf("%02d:00", $i);
                      $date = now()->addDays($offsetDays)->format('Y-m-d');
                      $datetime = "$date $time";
                      if (in_array($datetime, $bookedSlots)) {
                          echo "<button type='button' class='time-btn px-3 py-2 bg-red-400 text-white rounded cursor-not-allowed' disabled>$time</button>";
                      } else {
                          echo "<button type='button' onclick=\"pilihWaktu('$datetime')\" class='time-btn px-3 py-2 bg-gray-200 rounded hover:bg-green-500'>$time</button>";
                      }
                  }
                  echo "</div></div>";
              }

              renderTimeButtons('Today', 0, $bookedSlots);
              renderTimeButtons('Tomorrow', 1, $bookedSlots);
          @endphp

          <input type="hidden" name="booking_time" id="booking_time" value="{{ old('booking_time') }}">

          <div class="mb-4">
              <label for="service" class="block mb-1 font-medium">Pilih Service</label>
              <select name="service" id="service" required class="w-full px-3 py-2 border rounded bg-gray-100">
                  <option value="">-- Pilih --</option>
                  <option value="Premium cut">Premium cut</option>
                  <option value="Barbetro cut">Barbetro cut</option>
                  <option value="Barbetro VIP">Barbetro VIP</option>
                  <option value="Kids cut">Kids cut</option>
                  <option value="Barbetro hair wash">Barbetro hair wash</option>
                  <option value="Professional shaving">Professional shaving</option>
                  <option value="Basic hair color">Basic hair color</option>
                  <option value="Fashion hair color">Fashion hair color</option>
                  <option value="Facial">Facial</option>
                  <option value="Barbetro VIP + Kid cut">Barbetro VIP + Kid cut</option>
                  <option value="Barbetro Adult + Kid cut">Barbetro Adult + Kid cut</option>
                  <option value="Premium Adult + Kid cut">Premium Adult + Kid cut</option>
              </select>
          </div>

          <div class="mb-4">
              <label for="location" class="block mb-1 font-medium">Pilih Lokasi</label>
              <select name="location" id="location" required class="w-full px-3 py-2 border rounded bg-gray-100">
                  <option value="">-- Pilih --</option>
                  <option value="Tiban">Tiban</option>
                  <option value="KDA">KDA</option>
                  <option value="Greendland">Greendland</option>
              </select>
          </div>

          <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 rounded">
              Booking Sekarang
          </button>
          <a href="{{ route('jadwal') }}" class="w-full inline-block bg-gray-600 hover:bg-gray-700 text-white text-center py-2 rounded mt-4">← Kembali</a>
      </form>
   </div>
</div>

<script>
  function pilihWaktu(waktu) {
      document.getElementById('booking_time').value = waktu;
      const buttons = document.querySelectorAll('.time-btn');
      buttons.forEach(btn => btn.classList.remove('bg-green-600', 'text-white'));
      event.target.classList.add('bg-green-600', 'text-white');
  }
</script>
@endsection
