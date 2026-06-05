<!DOCTYPE html>
<html>
<head>
    <title>Sweet Cookies Shop</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-rose-50 min-h-screen">

<div class="max-w-7xl mx-auto px-8 py-10">

    <!-- Header -->
    <div class="text-center mb-12">

        <div class="text-6xl mb-4">
            🍪
        </div>

        <h1 class="text-5xl font-bold text-rose-600">
            Sweet Cookies Shop
        </h1>

        <p class="text-gray-500 mt-3 text-lg">
            Temukan cookies dan cake favoritmu hari ini
        </p>

    </div>

    <!-- Produk -->
    <div class="grid md:grid-cols-3 gap-8">

        <?php while($row = mysqli_fetch_assoc($products)): ?>

        <div class="bg-white rounded-3xl shadow-md overflow-hidden hover:shadow-xl transition duration-300">

            <?php if(!empty($row['image'])): ?>

                <img
                    src="<?= $row['image']; ?>"
                    class="w-full h-64 object-cover"
                >

            <?php endif; ?>

            <div class="p-6">

                <h2 class="text-2xl font-bold text-slate-800">
                    <?= $row['name']; ?>
                </h2>

                <p class="text-rose-600 font-bold text-xl mt-3">
                    Rp <?= number_format($row['price'],0,',','.'); ?>
                </p>

                <p class="text-gray-500 mt-2">
                    Stok: <?= $row['stock']; ?>
                </p>

                <?php if($row['stock'] > 0): ?>

                    <a
                        href="index.php?url=order/create&id=<?= $row['id']; ?>"
                        class="block text-center mt-5 bg-rose-500 hover:bg-rose-600 text-white py-3 rounded-xl font-semibold transition"
                    >
                        🛒 Pesan Sekarang
                    </a>

                <?php else: ?>

                    <button
                        class="w-full mt-5 bg-gray-300 text-gray-500 py-3 rounded-xl cursor-not-allowed"
                        disabled
                    >
                        Tidak Tersedia
                    </button>

                <?php endif; ?>

            </div>

        </div>

        <?php endwhile; ?>

    </div>

</div>

</body>
</html>