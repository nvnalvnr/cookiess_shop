<?php require_once "../app/views/layouts/header.php"; ?>
<?php require_once "../app/views/layouts/sidebar.php"; ?>

<main class="flex-1 p-6">

    <!-- Header -->
    <div class="bg-white rounded-3xl shadow-sm p-6 mb-5">

        <h1 class="text-3xl font-bold text-rose-600">
            🍪 Add New Product
        </h1>

        <p class="text-gray-500 mt-1">
            Tambahkan produk baru ke katalog.
        </p>

    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-3xl shadow-sm p-8 max-w-2xl">

        <form
            action="index.php?url=product/store"
            method="POST"
            enctype="multipart/form-data"
        >

            <!-- Product Name -->
            <label class="block mb-2 font-medium">
                Product Name
            </label>

            <input
                type="text"
                name="name"
                class="w-full border rounded-xl p-3 mb-5"
                required
            >

            <!-- Price -->
            <label class="block mb-2 font-medium">
                Price
            </label>

            <input
                type="number"
                name="price"
                class="w-full border rounded-xl p-3 mb-5"
                required
            >

            <!-- Stock -->
            <label class="block mb-2 font-medium">
                Stock
            </label>

            <input
                type="number"
                name="stock"
                class="w-full border rounded-xl p-3 mb-5"
                required
            >

            <!-- Image -->
            <label class="block mb-2 font-medium">
                Image URL
            </label>

            <input
                type="text"
                name="image"
                placeholder="https://..."
                class="w-full border rounded-xl p-3 mb-5"
            >
            <!-- Button -->
            <button
                type="submit"
                class="bg-rose-500 hover:bg-rose-600 text-white px-6 py-3 rounded-xl"
            >
                Save Product
            </button>

        </form>

    </div>

</main>

<?php require_once "../app/views/layouts/footer.php"; ?>