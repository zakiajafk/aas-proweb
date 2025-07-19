@extends('layouts.app')

@section('title', 'Home - Barbershop')

@section('content')
<!-- Hero Section -->
<section id="home">
    <div class="max-w-5xl mx-auto px-6 mt-16 text-center">
      @if(session('success'))
    <div 
        x-data="{ show: true }" 
        x-show="show" 
        x-init="setTimeout(() => show = false, 3000)" 
        class="bg-green-600 text-white px-4 py-2 rounded shadow mb-6 animate-fadeScaleUp"
    >
        {{ session('success') }}
    </div>
@endif
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Selamat Datang di Barbershop</h1>
        <p class="text-gray-300 text-lg md:text-xl mb-8">Tempat terbaik untuk potong rambut, styling, dan perawatan pria modern.</p>
        
             @auth
    <a href="{{ route('booking') }}" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded text-lg font-semibold shadow">
        Booking Sekarang
    </a>
@else
    <button @click="showLogin = true" class="bg-gray-600 text-white px-6 py-3 rounded text-lg font-semibold shadow opacity-50 cursor-not-allowed" disabled>
        Login untuk Booking
    </button>
@endauth

    </div>
</section>

<!-- Service Section -->
<section id="service">
  <div class="max-w-6xl mx-auto mt-20 px-6">
    <h2 class="text-3xl font-bold mb-8 text-center text-white">Layanan Kami</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center mb-16">
      <!-- Semua layanan individual -->
      <div class="bg-white/5 p-6 rounded-lg shadow hover:shadow-lg transition animate-fadeScaleUp">
        <h3 class="text-xl font-semibold mb-1 text-white">Premium Cut</h3>
        <p class="text-gray-400 mb-2">Potong Rambut, Pijat Pundak, Handuk Panas, Pomade Styling</p>
        <p class="text-yellow-400 font-semibold">Rp 50.000</p>
      </div>
      <div class="bg-white/5 p-6 rounded-lg shadow hover:shadow-lg transition animate-fadeScaleUp">
        <h3 class="text-xl font-semibold mb-1 text-white">Barbetro Cut</h3>
        <p class="text-gray-400 mb-2">Potong Rambut, Cuci Rambut, Hair Spa, Pijat + Minuman</p>
        <p class="text-yellow-400 font-semibold">Rp 75.000</p>
      </div>
      <div class="bg-white/5 p-6 rounded-lg shadow hover:shadow-lg transition animate-fadeScaleUp">
        <h3 class="text-xl font-semibold mb-1 text-white">Barbetro VIP</h3>
        <p class="text-gray-400 mb-2">Potong Rambut, Cuci Rambut, Perawatan Hair Spa, Pijat (Kepala, Pundak & Muka), Handuk Panas, Masker Wajah, Handuk dingin, Jeju Aloe Vera Gel, Eye gel, Pomade Styling + Minuman</p>
        <p class="text-yellow-400 font-semibold">Rp 100.000</p>
      </div>
      <div class="bg-white/5 p-6 rounded-lg shadow hover:shadow-lg transition animate-fadeScaleUp">
        <h3 class="text-xl font-semibold mb-1 text-white">Kids Cut</h3>
        <p class="text-gray-400 mb-2">Paket Premium Hair cut (anak < 12 tahun)</p>
        <p class="text-yellow-400 font-semibold">Rp 50.000</p>
      </div>
      <div class="bg-white/5 p-6 rounded-lg shadow hover:shadow-lg transition animate-fadeScaleUp">
        <h3 class="text-xl font-semibold mb-1 text-white">Barbetro Hair Wash</h3>
        <p class="text-gray-400 mb-2">Cuci Rambut & Pijat Kepala</p>
        <p class="text-yellow-400 font-semibold">Rp 10.000</p>
      </div>
      <div class="bg-white/5 p-6 rounded-lg shadow hover:shadow-lg transition animate-fadeScaleUp">
        <h3 class="text-xl font-semibold mb-1 text-white">Professional Shaving</h3>
        <p class="text-gray-400 mb-2">Perawatan Rambut Muka</p>
        <p class="text-yellow-400 font-semibold">Rp 30.000</p>
      </div>
      <div class="bg-white/5 p-6 rounded-lg shadow hover:shadow-lg transition animate-fadeScaleUp">
        <h3 class="text-xl font-semibold mb-1 text-white">Basic Hair Coloring</h3>
        <p class="text-gray-400 mb-2">Cat rambut warna black (hitam), dark brown (coklat), blue black (biru hitam)</p>
        <p class="text-yellow-400 font-semibold">Rp 100.000</p>
      </div>
      <div class="bg-white/5 p-6 rounded-lg shadow hover:shadow-lg transition animate-fadeScaleUp">
        <h3 class="text-xl font-semibold mb-1 text-white">Fashion Hair Coloring</h3>
        <p class="text-gray-400 mb-2">Cat rambut warna fashion</p>
        <p class="text-yellow-400 font-semibold">Rp 200.000</p>
      </div>
      <div class="bg-white/5 p-6 rounded-lg shadow hover:shadow-lg transition animate-fadeScaleUp">
        <h3 class="text-xl font-semibold mb-1 text-white">Facial</h3>
        <p class="text-gray-400 mb-2">Pembersihan muka</p>
        <p class="text-yellow-400 font-semibold">Rp 20.000</p>
      </div>
    </div>

    <!-- Paket Bundling -->
    <h2 class="text-2xl font-bold mb-6 text-center text-white">Paket Bundling</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
      <div class="bg-white/5 p-6 rounded-lg shadow hover:shadow-lg transition animate-fadeScaleUp">
        <h3 class="text-xl font-semibold mb-1 text-white">Barbetro VIP + Kid Cut</h3>
        <p class="text-gray-400 mb-2">Paket Barbetro VIP + Kid Cut dengan diskon 10k</p>
        <p class="text-yellow-400 font-bold">Rp 140.000</p>
      </div>
      <div class="bg-white/5 p-6 rounded-lg shadow hover:shadow-lg transition animate-fadeScaleUp">
        <h3 class="text-xl font-semibold mb-1 text-white">Barbetro Adult + Kid Cut</h3>
        <p class="text-gray-400 mb-2">Paket Barbetro Cut + Kid Cut dengan diskon 10k</p>
        <p class="text-yellow-400 font-bold">Rp 140.000</p>
      </div>
      <div class="bg-white/5 p-6 rounded-lg shadow hover:shadow-lg transition animate-fadeScaleUp">
        <h3 class="text-xl font-semibold mb-1 text-white">Premium Adult + Kid Cut</h3>
        <p class="text-gray-400 mb-2">Free Hair Wash<br>Paket Premium Cut + Kid Cut dengan diskon 10k</p>
        <p class="text-yellow-400 font-bold">Rp 90.000</p>
      </div>
    </div>
  </div>
</section>

<!-- Gallery Section -->
<section id="gallery">
  <div class="max-w-6xl mx-auto mt-20 px-6 text-center">
    <h2 class="text-3xl font-bold mb-8 text-white">Galeri Kami</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
      <!-- Galeri 1 -->
      <div class="bg-white/5 rounded-lg overflow-hidden shadow hover:shadow-lg transition animate-fadeScaleUp">
        <img src="{{ asset('images/foto1.jpg') }}" alt="Galeri 1" class="w-full h-48 object-cover transition-transform duration-500 hover:scale-105">
        <div class="p-4">
          <h3 class="text-white font-semibold text-lg">Mood Cut</h3>
        </div>
      </div>
      <!-- Galeri 2 -->
      <div class="bg-white/5 rounded-lg overflow-hidden shadow hover:shadow-lg transition animate-fadeScaleUp">
        <img src="{{ asset('images/foto2.jpg') }}" alt="Galeri 2" class="w-full h-48 object-cover transition-transform duration-500 hover:scale-105">
        <div class="p-4">
          <h3 class="text-white font-semibold text-lg">Textured Fringe Taper Fade</h3>
        </div>
      </div>
      <!-- Galeri 3 -->
      <div class="bg-white/5 rounded-lg overflow-hidden shadow hover:shadow-lg transition animate-fadeScaleUp">
        <img src="{{ asset('images/foto3.jpg') }}" alt="Galeri 3" class="w-full h-48 object-cover transition-transform duration-500 hover:scale-105">
        <div class="p-4">
          <h3 class="text-white font-semibold text-lg">Burst Fade</h3>
        </div>
      </div>
      <!-- Galeri 4 -->
      <div class="bg-white/5 rounded-lg overflow-hidden shadow hover:shadow-lg transition animate-fadeScaleUp">
        <img src="{{ asset('images/foto4.jpg') }}" alt="Galeri 4" class="w-full h-48 object-cover transition-transform duration-500 hover:scale-105">
        <div class="p-4">
          <h3 class="text-white font-semibold text-lg">Low Taper Fade with Textured Fringe</h3>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Produk Unggulan -->
<section id="produk">
  <div class="max-w-4xl mx-auto mt-20 px-6 text-center">
    <h2 class="text-3xl font-bold mb-8 text-white">Product</h2>
    <div class="group bg-white/5 rounded-xl overflow-hidden shadow transition duration-500 max-w-sm mx-auto hover:shadow-2xl hover:scale-105 transform">
      <img src="{{ asset('images/pomade.jpg') }}" alt="Pomade Eksklusif"
           class="w-full max-h-64 object-cover transition-transform duration-500 group-hover:scale-105 rounded-lg mx-auto">
      <div class="p-6">
        <h3 class="text-2xl font-semibold mb-2 text-white">Pomade Eksklusif</h3>
        <p class="text-gray-400">
          Diformulasikan khusus untuk pria modern, pomade kami memberikan gaya tahan lama dengan kilau alami dan aroma maskulin khas barbershop profesional.
        </p>
        <div class="mt-4 flex justify-center">
      </div>
    </div>
  </div>
</section>

<!-- About Section -->
<section id="about">
  <div class="max-w-5xl mx-auto mt-20 px-6 text-center">
    <h2 class="text-3xl font-bold mb-8 text-white">Tentang Kami</h2>
    <p class="text-gray-300 text-lg leading-relaxed">
      Didirikan pada tahun 2022, Barbetro adalah tempat pangkas rambut premium yang berkomitmen untuk menyediakan layanan perawatan luar biasa bagi pria modern. Tim tukang cukur kami yang terampil berdedikasi untuk memberikan potongan rambut yang presisi dan pengalaman yang dipersonalisasi.
      <br><br>
      Di Barbetro, kami percaya bahwa potongan rambut yang bagus lebih dari sekadar layanan; ini adalah sebuah pengalaman. Itulah sebabnya kami menciptakan lingkungan yang menenangkan di mana Anda dapat bersantai sementara para profesional kami bekerja.
    </p>
  </div>
</section>

<style>
  html {
    scroll-behavior: smooth;
  }
  <style>
  html {
    scroll-behavior: smooth;
  }

  @keyframes fadeScaleUp {
    0% {
      opacity: 0;
      transform: scale(0.95);
    }
    100% {
      opacity: 1;
      transform: scale(1);
    }
  }

  .animate-fadeScaleUp {
    animation: fadeScaleUp 0.3s ease-out;
  }
</style>

</style>
@endsection