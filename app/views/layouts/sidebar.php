<aside class="w-72 min-h-screen bg-gradient-to-b from-rose-500 to-pink-600 text-white flex flex-col">

    <!-- Header Sidebar -->
    <div class="p-8 border-b border-white/20">

        <h1 class="text-3xl font-bold">
            🍪 Cookies Shop
        </h1>

        <p class="text-rose-100 mt-2">
            Bakery Management
        </p>

    </div>

    <!-- Menu -->
  <nav class="p-5 space-y-3 flex-1">

<?php if($_SESSION['role'] == 'admin'): ?>

    <a href="index.php?url=dashboard/index" class="block p-4 rounded-xl hover:bg-white/20 transition">
        🏠 Dashboard
    </a>

    <a href="index.php?url=product/index" class="block p-4 rounded-xl hover:bg-white/20 transition">
        📦 Products
    </a>

    <a href="index.php?url=order/index" class="block p-4 rounded-xl hover:bg-white/20 transition">
        🛒 Orders
    </a>

    <a href="index.php?url=report/index" class="block p-4 rounded-xl hover:bg-white/20 transition">
        📊 Reports
    </a>

<?php else: ?>

    <a href="index.php?url=catalog/index" class="block p-4 rounded-xl hover:bg-white/20 transition">
        🍪 Catalog Kue
    </a>

    <a href="index.php?url=order/myOrders" class="block p-4 rounded-xl hover:bg-white/20 transition">
        🛒 Pesanan Saya
    </a>

<?php endif; ?>

    <a href="index.php?url=auth/logout" class="block p-4 rounded-xl hover:bg-red-400 transition">
        🚪 Logout
    </a>

</nav>

    <!-- Gambar Bawah Sidebar -->
    <div class="p-4">

        <div class="p-4 mt-auto">

<img
    src="assets/cookies.png"
    alt="Cookies"
    class="w-full rounded-2xl shadow-lg">

</div>
        <p class="text-center text-sm text-rose-100 mt-3">
            Fresh Cookies Everyday 🍪
        </p>

    </div>

</aside>