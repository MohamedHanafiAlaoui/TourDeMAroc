<!-- Signup Form -->
<main class="py-20"> 
    <div class="sm:mx-auto sm:w-full sm:max-w-xl">
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Login to your account</h2>
    </div>
    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-xl"> 
        <div class="bg-white py-8 px-4 shadow-lg sm:rounded-xl sm:px-10">
            <form class="space-y-6" action="<?= url('login') ?>" method="POST">
                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                    <input type="email" name="email" id="email" class="block w-full mt-1 px-4 py-2 border outline-none border-gray-300 rounded-lg focus:ring-1 focus:ring-emerald-500 focus:border-emerald-500" placeholder="Enter your email">
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" id="password" class="block w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg outline-none focus:ring-1 focus:ring-emerald-500 focus:border-emerald-500" placeholder="Create password">
                    <a href="<?= url("forget-password") ?>" class="text-sm text-emerald-500 hover:underline mt-2 block">Forgot password?</a>
                </div>
                <!-- Submit Button -->
                <button type="submit" class="w-full py-3 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600 transition">Create account</button>

                <!-- Already have an account? -->
                <p class="text-center text-sm text-gray-600">Don't have an account? <a href="<?= url('signup') ?>" class="text-emerald-500 hover:underline">Signup</a></p>
            </form>
        </div>
    </div>
</main>