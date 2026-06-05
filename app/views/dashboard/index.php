<?php require_once "../app/views/layouts/header.php"; ?>
<?php require_once "../app/views/layouts/sidebar.php"; ?>

<main class="flex-1 p-5">

    <!-- Header Dashboard -->
    <div class="bg-white rounded-2xl shadow-sm p-5 mb-4">

        <h1 class="text-3xl font-bold text-[#4A6073]">
            🍪 Cookies Shop Dashboard
        </h1>

        <p class="text-gray-500 mt-1">
            Welcome back, <?= $_SESSION['name']; ?> 👋
        </p>

    </div>

    <!-- Statistik -->
    <div class="grid grid-cols-3 gap-4 mb-4">

        <div class="bg-white rounded-2xl shadow-sm p-5">

            <div class="text-4xl">
                📦
            </div>

            <p class="text-gray-500 mt-2">
                Products
            </p>

            <h2 class="text-4xl font-bold text-[#4A6073]">
                <?= $totalProduk ?>
            </h2>

        </div>

        <div class="bg-white rounded-2xl shadow-sm p-5">

            <div class="text-4xl">
                🛒
            </div>

            <p class="text-gray-500 mt-2">
                Orders
            </p>

            <h2 class="text-4xl font-bold text-[#4A6073]">
                <?= $totalOrders ?>
            </h2>

        </div>

        <div class="bg-white rounded-2xl shadow-sm p-5">

            <div class="text-4xl">
                👥
            </div>

            <p class="text-gray-500 mt-2">
                Users
            </p>

            <h2 class="text-4xl font-bold text-[#4A6073]">
                <?= $totalUser ?>
            </h2>

        </div>

    </div>

    <!-- Bottom Section -->
    <div class="grid grid-cols-2 gap-4">

        <!-- Recent Orders -->
        <div class="bg-white rounded-2xl shadow-sm p-5">

            <h2 class="text-xl font-bold text-[#4A6073] mb-4">
                Recent Orders
            </h2>

            <div class="space-y-3">

                <div class="flex justify-between border-b pb-2">
                    <span>Chocolate Cookies</span>
                    <span class="text-yellow-600">
                        Pending
                    </span>
                </div>

                <div class="flex justify-between border-b pb-2">
                    <span>Matcha Cookies</span>
                    <span class="text-green-600">
                        Completed
                    </span>
                </div>

                <div class="flex justify-between">
                    <span>Red Velvet Cookies</span>
                    <span class="text-blue-600">
                        Processing
                    </span>
                </div>

            </div>

        </div>

        <!-- Latest Products -->
        <div class="bg-white rounded-2xl shadow-sm p-5">

            <h2 class="text-xl font-bold text-[#4A6073] mb-4">
                Latest Products
            </h2>

            <div class="space-y-3">

                <div class="flex justify-between border-b pb-2">
                    <span>Chocolate Cookies</span>
                    <span>Rp 25.000</span>
                </div>

                <div class="flex justify-between border-b pb-2">
                    <span>Matcha Cookies</span>
                    <span>Rp 30.000</span>
                </div>

                <div class="flex justify-between">
                    <span>Red Velvet Cookies</span>
                    <span>Rp 35.000</span>
                </div>

            </div>

        </div>

    </div>

</main>

<?php require_once "../app/views/layouts/footer.php"; ?>