<!-- Signup Form -->
<main class="py-20">
    <div class="sm:mx-auto sm:w-full sm:max-w-xl">
        <div class="flex justify-center">
            <div class="h-12 w-12 rounded-xl bg-emerald-500 flex items-center justify-center">
                <i class="fas fa-user-plus text-white text-xl"></i>
            </div>
        </div>
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Create your account</h2>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-xl">
        <div class="bg-white py-8 px-4 shadow-lg sm:rounded-xl sm:px-10">
            <form class="space-y-6" action="<?= url('signup') ?>" method="POST">
                <div class="flex justify-center space-x-4 mb-8">
                    <label class="relative cursor-pointer">
                        <input type="radio" name="role" value="fan" class="peer sr-only">
                        <div class="w-40 px-4 py-3 bg-white border-2 border-gray-200 rounded-lg peer-checked:border-emerald-500 peer-checked:bg-emerald-50 transition-all duration-200">
                            <div class="flex items-center justify-center space-x-2">
                                <i class="fas fa-users text-xl text-gray-500 peer-checked:text-emerald-600"></i>
                                <span class="font-medium text-gray-700 peer-checked:text-emerald-600">Fan</span>
                            </div>
                        </div>
                    </label>
                    <label class="relative cursor-pointer">
                        <input type="radio" name="role" value="cyclist" class="peer sr-only">
                        <div class="w-40 px-4 py-3 bg-white border-2 border-gray-200 rounded-lg peer-checked:border-emerald-500 peer-checked:bg-emerald-50 transition-all duration-200">
                            <div class="flex items-center justify-center space-x-2">
                                <i class="fas fa-bicycle text-xl text-gray-500 peer-checked:text-emerald-600"></i>
                                <span class="font-medium text-gray-700 peer-checked:text-emerald-600">Cyclist</span>
                            </div>
                        </div>
                    </label>
                </div>
                
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">First name</label>
                        <input type="text" name="first_name" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-emerald-500 focus:border-emerald-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Last name</label>
                        <input type="text" name="last_name" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-emerald-500 focus:border-emerald-500">
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Email address</label>
                    <input type="email" name="email" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-emerald-500 focus:border-emerald-500">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-emerald-500 focus:border-emerald-500">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input type="password" name="confirm_password" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-emerald-500 focus:border-emerald-500">
                </div>
                
                <!-- Notification Checkbox -->
                <div class="flex items-center">
                    <input id="notifications" name="notifications" type="checkbox" class="h-4 w-4 text-emerald-600 border-gray-300 rounded">
                    <label for="notifications" class="ml-2 block text-sm text-gray-700">I want to receive notifications</label>
                </div>

                <div>
                    <button type="submit" class="w-full py-3 px-4 text-white bg-emerald-500 rounded-lg hover:bg-emerald-600 transition">Create account</button>
                </div>

                <!-- Already have an account? -->
                <p class="text-center text-sm text-gray-600">Already have an account? <a href="<?= url('login') ?>" class="text-emerald-500 hover:underline">Sign In</a></p>
            </form>
        </div>
    </div>
</main>