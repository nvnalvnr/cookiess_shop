<?php require_once "../app/views/layouts/header.php"; ?>
<?php require_once "../app/views/layouts/sidebar.php"; ?>

<main class="flex-1 p-6">

    <h1 class="text-3xl font-bold mb-6">
        📊 Sales Report
    </h1>

    <div class="bg-white rounded-xl shadow overflow-hidden">

        <table class="w-full">

            <thead class="bg-rose-100">
                <tr>
                    <th class="p-4 text-left">Product</th>
                    <th class="p-4 text-left">Total Sold</th>
                    <th class="p-4 text-left">Revenue</th>
                </tr>
            </thead>

            <tbody>

                <?php while($row = mysqli_fetch_assoc($result)): ?>

                <tr class="border-b">

                    <td class="p-4">
                        <?= $row['name']; ?>
                    </td>

                    <td class="p-4">
                        <?= $row['total_sold']; ?>
                    </td>

                    <td class="p-4">
                        Rp <?= number_format($row['revenue'], 0, ',', '.'); ?>
                    </td>

                </tr>

                <?php endwhile; ?>

            </tbody>

        </table>

    </div>

</main>

<?php require_once "../app/views/layouts/footer.php"; ?>