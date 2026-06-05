<?php require_once "../app/views/layouts/header.php"; ?>
<?php require_once "../app/views/layouts/sidebar.php"; ?>

<main class="flex-1 p-6">

    <!-- Header -->
    <div class="bg-white rounded-3xl shadow-sm p-6 mb-5">

        <h1 class="text-3xl font-bold text-rose-600">
            ✏️ Edit Product
        </h1>

        <p class="text-gray-500 mt-1">
            Perbarui informasi produk yang ada di katalog.
        </p>

    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-3xl shadow-sm p-8 max-w-3xl">

        <form
            action="index.php?url=product/update"
            method="POST"
        >

            <input
                type="hidden"
                name="id"
                value="<?= $product['id']; ?>"
            >

            <!-- Product Name -->
            <label class="block mb-2 font-medium">
                Product Name
            </label>

            <input
                type="text"
                name="name"
                value="<?= $product['name']; ?>"
                class="w-full border border-gray-200 rounded-xl p-3 mb-5 focus:outline-none focus:ring-2 focus:ring-rose-300"
            >

            <!-- Price -->
            <label class="block mb-2 font-medium">
                Price
            </label>

            <input
                type="number"
                name="price"
                value="<?= $product['price']; ?>"
                class="w-full border border-gray-200 rounded-xl p-3 mb-5 focus:outline-none focus:ring-2 focus:ring-rose-300"
            >

            <!-- Stock -->
            <label class="block mb-2 font-medium">
                Stock
            </label>

            <input
                type="number"
                name="stock"
                value="<?= $product['stock']; ?>"
                class="w-full border border-gray-200 rounded-xl p-3 mb-6 focus:outline-none focus:ring-2 focus:ring-rose-300"
            >
            <!-- Image URL -->
<label class="block mb-2 font-medium">
    Image URL
</label>

<input
    type="text"
    name="image"
    value="<?= $product['image']; ?>"
    class="w-full border rounded-xl p-3 mb-5"
>

<!-- PREVIEW GAMBAR -->
<?php if(!empty($product['image'])): ?>

    <img
        src="<?= $product['image']; ?>"
        class="w-40 h-40 object-cover rounded-xl mb-5"
    >

<?php endif; ?>

<!-- BUTTON -->
<button
    type="submit"
    class="bg-rose-500 hover:bg-rose-600 text-white px-6 py-3 rounded-xl"
>
    Update Product
</button>
            <a
                href="index.php?url=product/index"
                class="ml-3 bg-gray-200 hover:bg-gray-300 px-6 py-3 rounded-xl"
            >
                Cancel
            </a>

        </form>

    </div>

</main>

<?php require_once "../app/views/layouts/footer.php"; ?>