<form action="index.php?url=order/store" method="POST">

    <input
        type="hidden"
        name="product_id"
        value="<?= $product['id']; ?>"
    >

    <div class="mb-4">

        <label>Nama Produk</label>

        <input
            type="text"
            value="<?= $product['name']; ?>"
            readonly
            class="w-full border p-2 rounded"
        >

    </div>

    <div class="mb-4">

        <label>Jumlah Pesanan</label>

        <input
            type="number"
            name="quantity"
            min="1"
            class="w-full border p-2 rounded"
        >

    </div>

    <button
        type="submit"
        class="bg-orange-500 text-white px-4 py-2 rounded"
    >
        Pesan Sekarang
    </button>

</form>