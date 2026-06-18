<?php require_once "../app/views/layouts/header.php"; ?>
<?php require_once "../app/views/layouts/sidebar.php"; ?>

<main class="flex-1 p-6">

    <!-- Header -->
    <div class="bg-white rounded-3xl shadow-sm p-6 mb-5">

        <div class="flex justify-between items-center">

            <div>

                <h1 class="text-3xl font-bold text-rose-600">
                    🍪 Products Management
                </h1>

                <p class="text-gray-500 mt-1">
                    Kelola seluruh produk Cookies Shop.
                </p>

            </div>

            <a
                href="index.php?url=product/create"
                class="bg-rose-500 hover:bg-rose-600 text-white px-5 py-3 rounded-xl transition"
            >
                + Add Product
            </a>

        </div>

    </div>

    <!-- Table -->
    <div class="bg-white rounded-3xl shadow-sm overflow-hidden">

        <table class="w-full">

            <thead class="bg-rose-100">

                <tr>

                    <th class="p-4 text-left">
                        No
                    </th>

                    <th class="p-4 text-left">
                        Image
                    </th>

                    <th class="p-4 text-left">
                        Product Name
                    </th>

                    <th class="p-4 text-left">
                        Price
                    </th>

                    <th class="p-4 text-left">
                        Stock
                    </th>

                    <th class="p-4 text-center">
                        Action
                    </th>

                </tr>

            </thead>

            <tbody>

            <?php $no = 1; while($row = mysqli_fetch_assoc($products)): ?>

                <tr class="border-b hover:bg-rose-50 transition">

                    <td class="p-4">
                        <?= $no++; ?>
                    </td>

                    <td class="p-4">

                        <?php if(!empty($row['image'])): ?>

                            <img
                                src="<?= $row['image']; ?>"
                                class="w-16 h-16 rounded-xl object-cover"
                            >

                        <?php else: ?>

                            <div class="w-16 h-16 bg-gray-200 rounded-xl flex items-center justify-center">
                                📦
                            </div>

                        <?php endif; ?>

                    </td>

                    <td class="p-4 font-semibold text-gray-700">
                        <?= $row['name']; ?>
                    </td>

                    <td class="p-4 font-bold text-rose-600">
                        Rp <?= number_format($row['price'], 0, ',', '.'); ?>
                    </td>

                    <td class="p-4">
                        <?= $row['stock']; ?>
                    </td>

                    <td class="p-4">

                        <div class="flex justify-center gap-2">

                            <a
                                href="index.php?url=product/edit&id=<?= $row['id']; ?>"
                                class="bg-sky-500 hover:bg-sky-600 text-white px-4 py-2 rounded-lg transition"
                            >
                                Edit
                            </a>

                            <a
                                href="index.php?url=product/delete&id=<?= $row['id']; ?>"
                                class="bg-rose-500 hover:bg-rose-600 text-white px-4 py-2 rounded-lg transition"
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

<?php require_once "../app/views/layouts/footer.php"; ?>