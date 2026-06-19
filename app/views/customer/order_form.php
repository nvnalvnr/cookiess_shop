<?php require_once "../app/views/layouts/header.php"; ?>
<?php require_once "../app/views/layouts/sidebar.php"; ?>

<main class="flex-1 p-10">

    <h1 class="text-3xl font-bold mb-6">
        Pesan Produk
    </h1>

    <div class="bg-white p-6 rounded-xl shadow max-w-lg">

        <!-- NAMA PRODUK -->
        <h2 class="text-xl font-bold">
            <?= $product['name']; ?>
        </h2>

        <!-- HARGA PRODUK -->
        <p class="text-orange-600 font-bold mt-2">
            Rp <?= number_format($product['price'], 0, ',', '.'); ?>
        </p>

        <!-- FORM ORDER -->
        <form action="/index.php?url=order/store" method="POST">

            <!-- hidden id produk -->
            <input type="hidden" name="product_id" value="<?= $product['id']; ?>">

            <!-- quantity -->
            <div class="mt-4">
                <label class="font-semibold">Jumlah</label>

                <input
                    type="number"
                    name="quantity"
                    min="1"
                    class="w-full border p-2 rounded mt-1"
                    required
                >
            </div>

            <!-- alamat -->
            <div class="mt-4">
                <label class="font-semibold">Alamat</label>

                <textarea
                    name="address"
                    class="w-full border p-2 rounded mt-1"
                    required
                ></textarea>
            </div>

            <!-- tombol submit -->
            <button
                type="submit"
                class="mt-5 bg-orange-500 hover:bg-orange-600 text-white px-5 py-2 rounded"
            >
                Buat Pesanan
            </button>

        </form>

    </div>

</main>

<?php require_once "../app/views/layouts/footer.php"; ?>