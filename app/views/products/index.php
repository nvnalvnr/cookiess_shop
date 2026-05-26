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

            <!-- logout -->
            <a href="index.php?url=auth/logout"
               class="block p-3 rounded hover:bg-red-500">
                Logout
            </a>

        </nav>

    </aside>

    <!-- Content -->
    <main class="flex-1 p-10">

        <div class="flex justify-between items-center mb-8">

            <h1 class="text-4xl font-bold">
                Data Produk
            </h1>

            <a href="index.php?url=product/create"
               class="bg-orange-600 hover:bg-orange-700 text-white px-6 py-3 rounded-lg shadow">
                + Tambah Produk
            </a>

        </div>

        <div class="bg-white rounded-xl shadow overflow-hidden">

            <table class="w-full">

                <thead class="bg-orange-100">

                    <tr>
                        <th class="p-4 text-left">ID</th>
                        <th class="p-4 text-left">Nama Produk</th>
                        <th class="p-4 text-left">Harga</th>
                        <th class="p-4 text-left">Stok</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>

                </thead>

                <tbody>

                <?php $no = 1; while($row = mysqli_fetch_assoc($products)): ?>

                    <tr class="border-b hover:bg-orange-50">

                        <td class="p-4">
                            <?= $no++; ?>
                        </td>

                        <td class="p-4 font-medium">
                            <?= $row['name']; ?>
                        </td>

                        <td class="p-4">
                            Rp <?= number_format($row['price'], 0, ',', '.'); ?>
                        </td>

                        <td class="p-4">
                            <?= $row['stock']; ?>
                        </td>

                        <td class="p-4">

                            <div class="flex gap-2 justify-center">

                                <a
                                    href="index.php?url=product/edit&id=<?= $row['id']; ?>"
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded"
                                >
                                    Edit
                                </a>

                                <a
                                    href="index.php?url=product/delete&id=<?= $row['id']; ?>"
                                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded"
                                    onclick="return confirm('Yakin ingin menghapus produk ini?')"
                                >
                                    Hapus
                                </a>

                            </div>

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