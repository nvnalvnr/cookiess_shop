<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Cookies Shop</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-orange-50 min-h-screen flex items-center justify-center">

    <div class="bg-white w-full max-w-md p-8 rounded-2xl shadow-xl">

        <div class="text-center mb-6">
            <h1 class="text-4xl font-bold text-orange-500">
                🍪 Cookies Shop
            </h1>

            <p class="text-gray-500 mt-2">
                Login ke akun kamu
            </p>
        </div>

        <form
            action="/cookies-shop/public/index.php?url=auth/processLogin"
            method="POST"
            class="space-y-4"
        >

            <div>
                <label class="block mb-2 font-semibold text-gray-700">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    placeholder="Masukkan email"
                    class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-orange-400"
                >
            </div>

            <div>
                <label class="block mb-2 font-semibold text-gray-700">
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    placeholder="Masukkan password"
                    class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-orange-400"
                >
            </div>

            <button
                type="submit"
                class="w-full bg-orange-500 hover:bg-orange-600 text-white py-3 rounded-xl font-bold transition"
            >
                Login
            </button>

        </form>

        <p class="text-center mt-6 text-gray-500">
            Belum punya akun?

            <a
                href="/cookies-shop/public/index.php?url=auth/register"
                class="text-orange-500 font-semibold"
            >
                Register
            </a>
        </p>

    </div>

</body>
</html>