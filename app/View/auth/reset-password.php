<main class="py-20">
    <div class="sm:mx-auto sm:w-full sm:max-w-xl">
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Reset Password</h2>
        <p class="mt-2 text-center text-sm text-gray-600">
            Enter your new password below.
        </p>
    </div>
    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-xl">
        <div class="bg-white py-8 px-4 shadow-lg sm:rounded-xl sm:px-10">
            <form class="space-y-6" action="<?= url("reset-password") ?>" method="POST">
                <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
                <!-- New Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
                    <input type="password" name="password" id="password" required class="block w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg outline-none focus:ring-1 focus:ring-emerald-500 focus:border-emerald-500" placeholder="Enter new password">
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="confirm-password" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input type="password" name="confirm_password" id="confirm-password" required class="block w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg outline-none focus:ring-1 focus:ring-emerald-500 focus:border-emerald-500" placeholder="Confirm new password">
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full py-3 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600 transition">Reset Password</button>

                <!-- Back to Login -->
                <p class="text-center text-sm text-gray-600">Remember your password? <a href="login.html" class="text-emerald-500 hover:underline">Back to Login</a></p>
            </form>
        </div>
    </div>
</main>