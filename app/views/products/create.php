<!DOCTYPE html>
<html>
<head>
    <title>Tambah Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-lg mx-auto mt-10 bg-white p-6 rounded-lg shadow">

    <h1 class="text-2xl font-bold mb-5">
        Tambah Produk Cookies
    </h1>

    <form action="/cookies-shop/public/index.php?url=product/store" method="POST">

        <div class="mb-4">
            <label>Nama Produk</label>
            <input
                type="text"
                name="name"
                class="w-full border p-2 rounded"
            >
        </div>

        <div class="mb-4">
            <label>Harga</label>
            <input
                type="number"
                name="price"
                class="w-full border p-2 rounded"
            >
        </div>

        <div class="mb-4">
            <label>Stok</label>
            <input
                type="number"
                name="stock"
                class="w-full border p-2 rounded"
            >
        </div>

        <button
            type="submit"
            class="bg-orange-500 text-white px-4 py-2 rounded"
        >
            Simpan
        </button>

    </form>

</div>

</body>
</html>