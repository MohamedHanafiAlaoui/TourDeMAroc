<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href=<?= URLASSETS ."css/all.min.css"?> rel="stylesheet" />
    <link href=<?= URLASSETS ."css/fontawesome.min.css"?> rel="stylesheet" />
    <link href=<?= URLASSETS ."css/output.css"?> rel="stylesheet" />
</head>
<body class="bg-gray-100">
    <!-- Sidebar -->
    <aside id="sidebar" class="fixed overflow-y-scroll no-scrollbar top-0 left-0 h-screen w-64 bg-white shadow-lg transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out z-40">
        <!-- Logo -->
        <div class="flex items-center justify-center h-16 border-b">
            <span class="text-emerald-600 font-bold text-2xl">Tour de Maroc Admin</span>
        </div>
    
        <!-- Navigation Menu -->
        <nav class="py-4">
            <?php
                function isActive($path)
                {
                    return (URLROOT . $path) == baseUrl() ? 'text-emerald-600 bg-emerald-50' : 'text-gray-600 hover:bg-gray-100';
                }
            ?>

            <!-- Admin Info -->
            <div class="px-4 mb-3">
                <div class="flex items-center gap-3 px-4 py-2 text-gray-600">
                    <i class="fas fa-user-shield text-xl"></i>
                    <span class="font-medium"><?= user()->getFullName() ?></span>
                </div>
            </div>
    
            <!-- Sidebar Links -->
            <div class="px-4 space-y-1">
                <!-- Dashboard -->
                <a href="<?= URLROOT ?>" class="<?= isActive("") ?> flex items-center gap-3 px-4 py-2 rounded-lg">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
    
                <!-- Content Management -->
                <div class="space-y-1 pt-2">
                    <p class="px-4 text-xs font-semibold text-gray-400 uppercase">Content Management</p>
                    <a href="<?= URLROOT . 'categories' ?>" class="<?= isActive("categories") ?> flex items-center gap-3 px-4 py-2 rounded-lg">
                        <i class="fas fa-folder"></i>
                        <span>Categories</span>
                    </a>
                    <a href="<?= URLROOT . 'regions' ?>" class="<?= isActive("regions") ?> flex items-center gap-3 px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                        <i class="fas fa-tags"></i>
                        <span>Regions</span>
                    </a>
                </div>

                <!-- Course Management Section -->
                <div class="space-y-1 pt-2">
                    <p class="px-4 text-xs font-semibold text-gray-400 uppercase">Races</p>
                    <a href="<?= URLROOT . 'courses' ?>" class="<?= isActive("courses") ?> flex items-center gap-3 px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                        <i class="fas fa-flag-checkered"></i>
                        <span>Manage Races</span>
                    </a>
                </div>
    
                <!-- Cyclist Management -->
                <div class="space-y-1 pt-2">
                    <p class="px-4 text-xs font-semibold text-gray-400 uppercase">Cyclist Management</p>
                    <a href="<?= URLROOT . 'teachers' ?>" class="<?= isActive("teachers") ?> flex items-center gap-3 px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                        <i class="fas fa-biking"></i>
                        <span>Verified Cyclists</span>
                    </a>
                    <a href="<?= URLROOT . 'unverified-teachers' ?>" class="<?= isActive("unverified-teachers") ?> flex items-center gap-3 px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                        <i class="fas fa-user-clock"></i>
                        <span>Pending Verification</span>
                    </a>
                </div>
    
                <!-- Fan Management -->
                <div class="space-y-1 pt-2">
                    <p class="px-4 text-xs font-semibold text-gray-400 uppercase">Fan Management</p>
                    <a href="<?= URLROOT . 'students' ?>" class="<?= isActive("students") ?> flex items-center gap-3 px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                        <i class="fas fa-users"></i>
                        <span>Active Fans</span>
                    </a>
                    <a href="<?= URLROOT . 'banned-students' ?>" class="<?= isActive("banned-students") ?> flex items-center gap-3 px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                        <i class="fas fa-user-slash"></i>
                        <span>Banned Users</span>
                    </a>
                </div>
    
                <!-- Logout Section -->
                <form action="<?= URLROOT . 'logout' ?>" method="POST" class="space-y-1 pt-2">
                    <p class="px-4 text-xs font-semibold text-gray-400 uppercase">Account</p>
                    <button class="flex w-full items-center gap-3 px-4 py-2 text-red-600 hover:bg-red-50 rounded-lg">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </nav>
    </aside>
    <main class="lg:ml-64 min-h-screen flex flex-col-reverse">
    <div class="p-4 bg-gray-100 min-h-screen">