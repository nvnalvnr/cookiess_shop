<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-lg mx-auto mt-10 bg-white p-6 rounded-lg shadow">

    <h1 class="text-2xl font-bold mb-5">
        Edit Produk
    </h1>

    <form action="index.php?url=product/update" method="POST">

        <input type="hidden"
               name="id"
               value="<?= $product['id']; ?>">

        <input type="text"
               name="name"
               value="<?= $product['name']; ?>"
               class="w-full border p-2 mb-3">

        <input type="number"
               name="price"
               value="<?= $product['price']; ?>"
               class="w-full border p-2 mb-3">

        <input type="number"
               name="stock"
               value="<?= $product['stock']; ?>"
               class="w-full border p-2 mb-3">

        <button
            class="bg-blue-500 text-white px-4 py-2 rounded">
            Update
        </button>

    </form>

</div>

</body>
</html>