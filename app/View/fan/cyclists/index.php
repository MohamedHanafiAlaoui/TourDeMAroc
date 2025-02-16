<!-- Main Content -->
<main class="max-w-6xl mx-auto px-4 pt-28 pb-10">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">Tour de Maroc 2025 Players</h1>

    <!-- Search and Filter Section -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-8">
        <form action="<?= url('cyclists') ?>" method="POST" class="w-full md:w-1/2 mb-4 md:mb-0">
            <div class="relative">
                <input type="text" id="search" name="search" placeholder="Search players..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            </div>
        </Form>
        <div class="w-full md:w-auto">
            <button id="filterBtn" class="w-full md:w-auto bg-emerald-500 text-white px-6 py-2 rounded-lg hover:bg-emerald-600 transition duration-300 flex items-center justify-center">
                <i class="fas fa-filter mr-2"></i> Filter
            </button>
        </div>
    </div>

    <!-- Players List -->
    <div id="playersList" class="space-y-4">
        <?php foreach ($cyclists as $cyclist): ?>
            <a href="<?= url('cyclists/' . $cyclist->getId()) ?>" class="bg-white rounded-lg shadow-md p-4 flex items-center space-x-4 hover:shadow-lg transition duration-300">
                <img src="<?= $cyclist->getPhoto() ?>" alt="<?= $cyclist->getFullName() ?>" class="w-16 h-16 rounded-full object-cover">
                <div class="flex-grow">
                    <h3 class="text-lg font-semibold text-gray-800"><?= $cyclist->getFullName() ?></h3>
                    <div class="flex flex-wrap mt-1 gap-1">
                        <span class="text-sm text-gray-600"><?= $cyclist->getNationality() ?></span>
                        <span class="text-sm text-gray-600">/</span>
                        <span class="text-sm text-gray-600"><?= $cyclist->getTeam() ?></span>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-500">Age: <?= $cyclist->getAge() ?></p>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</main>