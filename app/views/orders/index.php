<?php require_once "../app/views/layouts/header.php"; ?>
<?php require_once "../app/views/layouts/sidebar.php"; ?>

<main class="flex-1 p-6">
<div class="flex min-h-screen">

    <main class="flex-1 p-10">

        <div class="flex justify-between items-center mb-8">
            <h1 class="text-4xl font-bold">
                Data Orders
            </h1>
        </div>

        <div class="bg-white rounded-xl shadow overflow-hidden">

            <table class="w-full">

                <thead class="bg-rose-100">
                    <tr>
                        <th class="p-4 text-left">ID</th>
                        <th class="p-4 text-left">Customer</th>
                        <th class="p-4 text-left">Produk</th>
                        <th class="p-4 text-left">Qty</th>
                        <th class="p-4 text-left">Total</th>
                        <th class="p-4 text-left">Status</th>
                    </tr>
                </thead>

                <tbody>

                <?php foreach ($orders as $order): ?>
                    <tr class="border-b hover:bg-rose-50">

                        <td class="p-4">
                            <?= $order['id']; ?>
                        </td>

                        <td class="p-4">
                            <?= $order['customer_id']; ?>
                        </td>

                        <td class="p-4">
                            <?= $order['product_name']; ?>
                        </td>

                        <td class="p-4">
                            <?= $order['quantity']; ?>
                        </td>

                        <td class="p-4">
                            Rp <?= number_format($order['total_price'], 0, ',', '.'); ?>
                        </td>

                        <td class="p-4">

                            <?php if($order['status'] == 'Pending'): ?>
                                <span class="bg-amber-100 text-amber-700 px-3 py-1 rounded-full text-sm">Pending</span>

                            <?php elseif($order['status'] == 'Processing'): ?>
                                <span class="bg-sky-100 text-sky-700 px-3 py-1 rounded-full text-sm">Processing</span>

                            <?php elseif($order['status'] == 'Completed'): ?>
                                <span class="bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full text-sm">Completed</span>

                            <?php else: ?>
                                <span class="bg-rose-100 text-rose-700 px-3 py-1 rounded-full text-sm">Cancelled</span>
                            <?php endif; ?>

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