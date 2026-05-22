<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
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
               class="block p-3 rounded bg-orange-500">
                Products
            </a>
 

        </nav>

    </aside>

    <!-- Content -->
    <main class="flex-1 p-8">

        <div class="flex justify-between items-center mb-6">

            <h1 class="text-3xl font-bold">
                Data Produk
            </h1>

            <a href="index.php?url=product/create"
               class="bg-orange-600 text-white px-5 py-3 rounded-lg">
                + Tambah Produk
            </a>

        </div>

        <div class="bg-white rounded-xl shadow overflow-hidden">

            <table class="w-full">

                <thead class="bg-orange-100">
                    <tr>
                        <th class="p-4 text-left">ID</th>
                        <th class="p-4 text-left">Nama</th>
                        <th class="p-4 text-left">Harga</th>
                        <th class="p-4 text-left">Stok</th>
                        <th class="p-4 text-left">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                <?php while($row = mysqli_fetch_assoc($products)): ?>

                    <tr class="border-b">

                        <td class="p-4"><?= $row['id']; ?></td>

                        <td class="p-4"><?= $row['name']; ?></td>

                        <td class="p-4">
                            Rp <?= number_format($row['price'], 0, ',', '.'); ?>
                        </td>

                        <td class="p-4"><?= $row['stock']; ?></td>

                        <td class="p-4">

                        <a href="index.php?url=product/edit&id=<?= $row['id']; ?>"
                        class="bg-blue-500 text-white px-3 py-1 rounded">
                        Edit
                        </a>

                            <button
                                class="bg-red-500 text-white px-3 py-1 rounded">
                                Hapus
                            </button>

                        </td>

                    </tr>

                <?php endwhile; ?>

                </tbody>

            </table>

        </div>

    </main>

</div>

</body>
</html>