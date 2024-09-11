<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to YourBank</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- <link href="{{ asset('resources/css/app.css') }}" rel="stylesheet"> -->
    @vite('resources/css/app.css')
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #1d4ed8, #3b82f6);
        }
    </style>
</head>
<body class="gradient-bg text-white min-h-screen flex flex-col justify-between">

    <!-- Header Section -->
    <header class="py-6">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-3xl font-bold">YourBank</h1>
        </div>
    </header>

    <!-- Main Content Section -->
    <main class="container mx-auto flex flex-col md:flex-row items-center justify-between space-y-10 md:space-y-0 py-12">
        <!-- Text and Call to Action -->
        <div class="md:w-1/2 space-y-6">
            <h2 class="text-4xl md:text-5xl font-bold leading-tight">Simplifying Your Banking Experience</h2>
            <p class="text-lg font-light text-blue-200">
                Manage your finances easily, securely, and efficiently with YourBank. Join us and take control of your future.
            </p>
            <div class="space-x-4">
                <a href="{{ route('register') }}" class="px-6 py-3 bg-white text-blue-700 font-semibold rounded-lg hover:bg-gray-100">Get Started</a>
                <a href="{{ route('login') }}" class="px-6 py-3 bg-transparent border border-white font-semibold rounded-lg hover:bg-white hover:text-blue-700">Login</a>
            </div>
        </div>

        <!-- Image/Illustration -->
        <div class="md:w-1/2">
            <img src="https://cdn.dribbble.com/users/1355613/screenshots/10521469/media/7a8a59b0c68ec3a9e64e9a25884d9975.png?compress=1&resize=1000x750" alt="Banking illustration" class="w-full rounded-lg shadow-lg">
        </div>
    </main>

    <!-- Features Section -->
    <section class="py-12 bg-white text-blue-700">
        <div class="container mx-auto text-center">
            <h3 class="text-3xl font-semibold mb-8">Why Choose YourBank?</h3>
            <div class="flex flex-wrap justify-center space-x-6">
                <div class="w-64 bg-blue-100 p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <img src="https://img.icons8.com/external-justicon-lineal-color-justicon/64/000000/external-coin-finance-justicon-lineal-color-justicon.png" class="mx-auto mb-4" alt="Icon" />
                    <h4 class="text-xl font-bold mb-2">Low Fees</h4>
                    <p class="text-sm font-light">We provide the lowest transaction fees for every banking service.</p>
                </div>
                <div class="w-64 bg-blue-100 p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <img src="https://img.icons8.com/external-justicon-lineal-color-justicon/64/000000/external-security-finance-justicon-lineal-color-justicon.png" class="mx-auto mb-4" alt="Icon" />
                    <h4 class="text-xl font-bold mb-2">Secure Transactions</h4>
                    <p class="text-sm font-light">Your data and financial information are always secure with us.</p>
                </div>
                <div class="w-64 bg-blue-100 p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <img src="https://img.icons8.com/external-justicon-lineal-color-justicon/64/000000/external-credit-card-finance-justicon-lineal-color-justicon.png" class="mx-auto mb-4" alt="Icon" />
                    <h4 class="text-xl font-bold mb-2">Easy Access</h4>
                    <p class="text-sm font-light">Access your account anytime, anywhere, from any device.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="py-6 text-center">
        <div class="container mx-auto">
            <p class="text-sm text-blue-200">&copy; 2024 YourBank. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
