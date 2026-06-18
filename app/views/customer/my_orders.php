<?php require_once "../app/views/layouts/header.php"; ?>
<?php require_once "../app/views/layouts/sidebar.php"; ?>

<main class="flex-1 p-6">

    <h1 class="text-3xl font-bold mb-6">
        Pesanan Saya
    </h1>

    <div class="bg-white rounded-xl shadow overflow-hidden">

        <table class="w-full">

            <thead class="bg-orange-500 text-white">
                <tr>
                    <th class="p-3">Produk</th>
                    <th class="p-3">Jumlah</th>
                    <th class="p-3">Total</th>
                    <th class="p-3">Status</th>
                </tr>
            </thead>

            <tbody>

            <?php foreach($orders as $order): ?>

                <tr class="border-b">

                    <td class="p-3">
                        <?= $order['product_name']; ?>
                    </td>

                    <td class="p-3">
                        <?= $order['quantity']; ?>
                    </td>

                    <td class="p-3">
                        Rp <?= number_format($order['total_price'],0,',','.'); ?>
                    </td>

                    <td class="p-3">

                        <?php if($order['status']=='pending'): ?>
                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded">
                                Pending
                            </span>

                        <?php elseif($order['status']=='processing'): ?>
                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded">
                                Diproses
                            </span>

                        <?php elseif($order['status']=='completed'): ?>
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded">
                                Selesai
                            </span>

                        <?php endif; ?>

                    </td>

                </tr>

            <?php endforeach; ?>

            </tbody>

        </table>

    </div>

</main>

<?php require_once "../app/views/layouts/footer.php"; ?>