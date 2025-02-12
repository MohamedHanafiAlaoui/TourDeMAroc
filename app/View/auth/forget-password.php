<main class="py-20">
    <div class="sm:mx-auto sm:w-full sm:max-w-xl">
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Forgot Password</h2>
        <p class="mt-2 text-center text-sm text-gray-600">
            Enter your email address and we'll send you a link to reset your password.
        </p>
    </div>
    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-xl">
        <div class="bg-white py-8 px-4 shadow-lg sm:rounded-xl sm:px-10">
            <form class="space-y-6" action="#" method="POST">
                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                    <input type="email" name="email" id="email" required class="block w-full mt-1 px-4 py-2 border outline-none border-gray-300 rounded-lg focus:ring-1 focus:ring-emerald-500 focus:border-emerald-500" placeholder="Enter your email">
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full py-3 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600 transition">Send Reset Link</button>

                <!-- Back to Login -->
                <p class="text-center text-sm text-gray-600">Remember your password? <a href="<?= url("login") ?>" class="text-emerald-500 hover:underline">Back to Login</a></p>
            </form>
        </div>
    </div>
</main>