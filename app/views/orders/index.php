<?php require_once "../app/views/layouts/header.php"; ?>
<?php require_once "../app/views/layouts/sidebar.php"; ?>

<main class="flex-1 p-6">

    <div class="flex min-h-screen">

        <main class="flex-1 p-10">

            <div class="flex justify-between items-center mb-8">
                <h1 class="text-4xl font-bold">
                    Kelola Pesanan
                </h1>
            </div>

            <div class="bg-white rounded-xl shadow overflow-hidden">

                <table class="w-full">

                    <thead class="bg-rose-100">
                        <tr>
                            <th class="p-4 text-left">ID</th>
                            <th class="p-4 text-left">Pelanggan</th>
                            <th class="p-4 text-left">Produk</th>
                            <th class="p-4 text-left">Jml</th>
                            <th class="p-4 text-left">Total</th>
                            <th class="p-4 text-left">Status</th>
                            <th class="p-4 text-left">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php foreach ($orders as $order): ?>
                    <tr class="border-b hover:bg-rose-50">

                        <td class="p-4">
                            <?= $order['id']; ?>
                        </td>

                        <td class="p-4">
                            <?= $order['customer_name']; ?>
                        </td>

                        <td class="p-4">
                            <?= $order['product_name']; ?>
                        </td>

                        <td class="p-4">
                            <?= $order['quantity']; ?>
                        </td>

                        <td class="p-4 font-semibold">
                            Rp <?= number_format($order['total_price'], 0, ',', '.'); ?>
                        </td>

                        <td class="p-4">

                            <?php if ($order['status'] == 'pending'): ?>

                                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
                                    Pending
                                </span>

                            <?php elseif ($order['status'] == 'processing'): ?>

                                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">
                                    Diproses
                                </span>

                            <?php elseif ($order['status'] == 'completed'): ?>

                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                    Selesai
                                </span>

                            <?php else: ?>

                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                                    Dibatalkan
                                </span>

                            <?php endif; ?>

                        </td>

                        <td class="p-4">

                            <form action="index.php?url=order/updateStatus" method="POST">

                                <input
                                    type="hidden"
                                    name="id"
                                    value="<?= $order['id']; ?>">

                                <select
                                    name="status"
                                    onchange="this.form.submit()"
                                    class="border rounded px-3 py-1">

                                    <option
                                        value="pending"
                                        <?= $order['status'] == 'pending' ? 'selected' : ''; ?>>
                                        Pending
                                    </option>

                                    <option
                                        value="processing"
                                        <?= $order['status'] == 'processing' ? 'selected' : ''; ?>>
                                        Diproses
                                    </option>

                                    <option
                                        value="completed"
                                        <?= $order['status'] == 'completed' ? 'selected' : ''; ?>>
                                        Selesai
                                    </option>

                                    <option
                                        value="cancelled"
                                        <?= $order['status'] == 'cancelled' ? 'selected' : ''; ?>>
                                        Dibatalkan
                                    </option>

                                </select>

                            </form>

                        </td>

                    </tr>
                    <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        </main>

    </div>

</main>

<?php require_once "../app/views/layouts/footer.php"; ?>