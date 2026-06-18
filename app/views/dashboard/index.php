<?php require_once "../app/views/layouts/header.php"; ?>
<?php require_once "../app/views/layouts/sidebar.php"; ?>

<main class="flex-1 p-5 bg-rose-50 min-h-screen">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">

        <div>
            <h1 class="text-3xl font-bold text-slate-700">
                Dashboard
            </h1>

            <p class="text-gray-500">
                Welcome back, <?= $_SESSION['name']; ?>!
            </p>
        </div>

        <div class="flex items-center gap-3">

            <div class="w-12 h-12 rounded-full bg-rose-100 flex items-center justify-center">
                👤
            </div>

            <div>
                <p class="font-semibold">
                    <?= $_SESSION['name']; ?>
                </p>

                <p class="text-sm text-gray-500">
                    Administrator
                </p>
            </div>

        </div>

    </div>

    <!-- Statistik -->
    <div class="grid grid-cols-4 gap-4 mb-5">

        <div class="bg-white rounded-2xl shadow-sm p-5">
            <div class="text-3xl mb-3">📦</div>

            <p class="text-gray-500">
                Products
            </p>

            <h2 class="text-3xl font-bold text-rose-500">
                <?= $totalProduk ?>
            </h2>
        </div>

        <div class="bg-white rounded-2xl shadow-sm p-5">
            <div class="text-3xl mb-3">🛒</div>

            <p class="text-gray-500">
                Orders
            </p>

            <h2 class="text-3xl font-bold text-blue-500">
                <?= $totalOrders ?>
            </h2>
        </div>

        <div class="bg-white rounded-2xl shadow-sm p-5">
            <div class="text-3xl mb-3">👥</div>

            <p class="text-gray-500">
                Users
            </p>

            <h2 class="text-3xl font-bold text-purple-500">
                <?= $totalUser ?>
            </h2>
        </div>

        <div class="bg-white rounded-2xl shadow-sm p-5">
            <div class="text-3xl mb-3">⏳</div>

            <p class="text-gray-500">
                Pending Orders
            </p>

            <h2 class="text-3xl font-bold text-yellow-500">
                <?= $totalPending ?>
            </h2>
        </div>

    </div>

    <!-- Revenue -->
    <div class="bg-white rounded-2xl shadow-sm p-5 mb-5">

        <div class="flex items-center gap-4">

            <div class="text-5xl">
                💰
            </div>

            <div>

                <p class="text-gray-500">
                    Revenue (Completed Orders)
                </p>

                <h2 class="text-3xl font-bold text-green-600">
                    Rp <?= number_format($totalRevenue, 0, ',', '.'); ?>
                </h2>

            </div>

        </div>

    </div>

    <!-- Bottom -->
    <div class="grid grid-cols-2 gap-4">

        <!-- Recent Orders -->
        <div class="bg-white rounded-2xl shadow-sm">

            <div class="p-5">

                <h2 class="text-xl font-bold text-slate-700 mb-4">
                    Recent Orders
                </h2>

                <?php foreach($recentOrders as $order): ?>

                    <div class="flex justify-between items-center border-b py-3">

                        <div>

                            <p class="font-semibold">
                                <?= $order['customer_name']; ?>
                            </p>

                            <p class="text-sm text-gray-500">
                                <?= $order['product_name']; ?>
                            </p>

                        </div>

                        <div>

                            <?php if($order['status']=='pending'): ?>
                                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-lg text-sm">
                                    Pending
                                </span>

                            <?php elseif($order['status']=='processing'): ?>
                                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-lg text-sm">
                                    Diproses
                                </span>

                            <?php elseif($order['status']=='completed'): ?>
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-lg text-sm">
                                    Selesai
                                </span>

                            <?php else: ?>
                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-lg text-sm">
                                    Dibatalkan
                                </span>
                            <?php endif; ?>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>

            <div class="border-t p-4 text-center">

                <a href="index.php?url=order/index"
                   class="text-rose-500 hover:text-rose-600">
                    View all orders →
                </a>

            </div>

        </div>

        <!-- Latest Products -->
        <div class="bg-white rounded-2xl shadow-sm">

            <div class="p-5">

                <h2 class="text-xl font-bold text-slate-700 mb-4">
                    Latest Products
                </h2>

                <?php foreach($latestProducts as $product): ?>

                    <div class="flex justify-between border-b py-3">

                        <span>
                            <?= $product['name']; ?>
                        </span>

                        <span>
                            Rp <?= number_format($product['price'],0,',','.'); ?>
                        </span>

                    </div>

                <?php endforeach; ?>

            </div>

            <div class="border-t p-4 text-center">

                <a href="index.php?url=product/index"
                   class="text-rose-500 hover:text-rose-600">
                    View all products →
                </a>

            </div>

        </div>

    </div>

</main>

<?php require_once "../app/views/layouts/footer.php"; ?>