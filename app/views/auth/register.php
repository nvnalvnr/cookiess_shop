<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Cookies Shop</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-rose-50 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md">

        <div class="text-center mb-8">

            <h1 class="text-6xl mb-2">🍪</h1>

            <h2 class="text-3xl font-bold text-rose-600">
                Cookies Shop
            </h2>

            <p class="text-gray-500 mt-2">
                Create Your Account
            </p>

        </div>

        <div class="bg-white p-8 rounded-3xl shadow-lg">

            <h3 class="text-2xl font-bold mb-6 text-center">
                Register
            </h3>

            <form action="index.php?url=auth/processRegister" method="POST">

                <div class="mb-4">

                    <label class="block mb-2 text-gray-600">
                        Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        class="w-full border border-rose-200 rounded-xl p-3"
                        required
                    >

                </div>

                <div class="mb-4">

                    <label class="block mb-2 text-gray-600">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        class="w-full border border-rose-200 rounded-xl p-3"
                        required
                    >

                </div>

                <div class="mb-6">

                    <label class="block mb-2 text-gray-600">
                        Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        class="w-full border border-rose-200 rounded-xl p-3"
                        required
                    >

                </div>

                <button
                    type="submit"
                    class="w-full bg-rose-500 text-white py-3 rounded-xl hover:bg-rose-600 transition"
                >
                    Register
                </button>

            </form>

            <p class="text-center mt-6 text-gray-500">

                Sudah punya akun?

                <a
                    href="index.php?url=auth/login"
                    class="text-rose-500 font-semibold"
                >
                    Login
                </a>

            </p>

        </div>

    </div>

</body>
</html>