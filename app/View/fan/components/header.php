<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour de Maroc - Experience the Thrill of Cycling</title>
    <link rel="stylesheet" href="<?= URLASSETS . 'css/output.css' ?>">
    <link rel="stylesheet" href="<?= URLASSETS . 'css/all.min.css' ?>">
    <link rel="stylesheet" href="<?= URLASSETS . 'css/fontawesome.css' ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Modern Navbar -->
    <nav class="bg-white shadow-lg backdrop-blur-md bg-opacity-90 fixed w-full z-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-8">
                    <div class="flex items-center">
                        <span class="text-2xl font-bold bg-gradient-to-r from-emerald-500 to-green-600 text-transparent bg-clip-text">Tour de Maroc</span>
                    </div>
                    <?php
                        function isActive($path)
                        {
                            return (URLROOT . $path) == baseUrl() ? 'text-emerald-600 font-semibold' : 'text-gray-600 hover:text-emerald-600';
                        }
                    ?>
                    <div class="hidden md:flex space-x-8">
                        <a href="<?= url() ?>" class="<?= isActive("") ?>">Home</a>
                        <a href="<?= url('tour') ?>" class="<?= isActive("tour") ?> transition">Tour</a>
                        <a href="<?= url('stages') ?>" class="<?= isActive("stages") ?> transition">Stages</a>
                        <a href="<?= url('cyclists') ?>" class="<?= isActive("cyclists") ?> transition">Cyclists</a>
                        <a href="<?= url('ranking') ?>" class="<?= isActive("ranking") ?> transition">Rankings</a>
                    </div>
                </div>
                <?php if (isLoggedIn()): ?>
                    <!-- Only Profile Icon -->
                    <a href="<?= url('profile') ?>" class="flex items-center justify-center w-10 h-10 bg-gray-100 rounded-full hover:bg-gray-200 transition">
                        <i class="fas fa-user text-gray-600 text-lg"></i>
                    </a>
                <?php else: ?>
                    <a href="<?= url('login') ?>" class="bg-emerald-500 text-white px-6 py-2 rounded-full hover:bg-emerald-600 transition">
                        Sign In
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
