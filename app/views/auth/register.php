<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-orange-50 min-h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md">

        <h1 class="text-3xl font-bold text-center text-orange-500 mb-6">
            🍪 Register
        </h1>

        <form
            action="index.php?url=auth/processRegister"
            method="POST"
            class="space-y-4"
        >

            <input
                type="text"
                name="name"
                placeholder="Nama"
                class="w-full border p-3 rounded-xl"
            >

            <input
                type="email"
                name="email"
                placeholder="Email"
                class="w-full border p-3 rounded-xl"
            >

            <input
                type="password"
                name="password"
                placeholder="Password"
                class="w-full border p-3 rounded-xl"
            >

            <button
                type="submit"
                class="w-full bg-orange-500 text-white py-3 rounded-xl"
            >
                Register
            </button>

        </form>

    </div>

</body>
</html>