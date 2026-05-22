<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-orange-600 text-white">

        <div class="p-6 text-2xl font-bold border-b border-orange-500">
            🍪 Cookies Shop
        </div>

        <nav class="p-4 space-y-2">

            <a href="index.php?url=dashboard/index"
               class="block p-3 rounded hover:bg-orange-500">
                Dashboard
            </a>

            <a href="index.php?url=product/index"
               class="block p-3 rounded hover:bg-orange-500">
                Products
            </a>

      
            <a href=""
               class="block p-3 rounded hover:bg-orange-500">
                Orders
            </a>

            <a href="#"
               class="block p-3 rounded hover:bg-red-500">
                Logout
            </a>


        </nav>

    </aside>

    <!-- Content -->
    <main class="flex-1 p-8">

        <h1 class="text-3xl font-bold mb-6">
            Dashboard Admin
        </h1>

        <div class="grid grid-cols-3 gap-6 mb-8">

            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-gray-500">Total Produk</h3>
                <p class="text-3xl font-bold mt-2">20</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-gray-500">Total Order</h3>
                <p class="text-3xl font-bold mt-2">15</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-gray-500">Total User</h3>
                <p class="text-3xl font-bold mt-2">5</p>
            </div>

        </div>

        <div class="bg-white rounded-xl shadow p-6">

            <h2 class="text-xl font-bold mb-4">
                Selamat Datang,
                <?= $_SESSION['name']; ?>
            </h2>

            <p class="text-gray-500">
                Kelola toko cookies dari dashboard ini.
            </p>

        </div>

    </main>

</div>

</body>
</html>