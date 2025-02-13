<!-- Hero Section -->
<section class="relative pt-16">
    <div class="absolute inset-0 bg-gradient-to-r from-emerald-500 to-green-600 opacity-10"></div>
    <div class="relative container mx-auto px-6 py-32">
        <div class="max-w-3xl">
            <h1 class="text-5xl md:text-6xl font-bold text-gray-900 mb-6">Experience the Thrill of Tour de Maroc</h1>
            <p class="text-xl text-gray-700 mb-12">Follow the race through Morocco's magnificent landscapes, support your favorite cyclists, and be part of the action!</p>
            <div class="flex flex-wrap gap-4">
                <a href="#" class="bg-emerald-500 text-white py-3 px-8 rounded-full text-lg font-semibold hover:bg-emerald-600 transition duration-300">Explore Tour Stages</a>
                <a href="#" class="bg-white text-emerald-500 py-3 px-8 rounded-full text-lg font-semibold hover:bg-gray-50 transition duration-300 border-2 border-emerald-500">View Schedule</a>
            </div>
        </div>
    </div>
</section>

<!-- Stage History -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Race Stages</h2>
        <p class="text-gray-600 max-w-2xl mx-auto">Explore each stage of the Tour de Maroc – from start to finish.</p>
        </div>
        <?php 
            $color = [
                'facile' => "bg-emerald-100 text-emerald-700",
                'medium' => "bg-yellow-100 text-yellow-700",
                'difficile' => "bg-red-100 text-red-700",
            ] 
        ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Stage Card -->
        <?php if (!$nextStages) { ?>
            <div class="h-80 text-red-500 flex justify-center ">
                <p>No Stage exists</p>
            </div>
        <?php } else { foreach ($nextStages as $key => $stage): ?>
            <div class="bg-gray-50 rounded-2xl overflow-hidden shadow-lg transition duration-300 hover:shadow-xl">
                <img src="/api/placeholder/600/400" alt="Stage: <?= htmlspecialchars($stage->getStLocation()) ?> → <?= htmlspecialchars($stage->getEnLocation()) ?>" class="w-full h-48 object-cover">
                <div class="p-6">
                <h3 class="font-bold text-xl mb-2"><?= htmlspecialchars($stage->getStLocation()) ?> → <?= htmlspecialchars($stage->getEnLocation()) ?></h3>
                <p class="text-gray-600"><?= htmlspecialchars($stage->getStDate()) ?> - <?= htmlspecialchars($stage->getEnDate()) ?></p>
                <div class="flex items-center mt-2">
                    <span class="px-3 py-1 <?= htmlspecialchars($color[$stage->getDiffcLevel()]) ?> rounded-full text-sm"><?= htmlspecialchars($stage->getDiffcLevel()) ?></span>
                </div>
                <a href="#" class="mt-4 inline-block text-emerald-500 hover:text-emerald-600">View Stage Details →</a>
                </div>
            </div>
        <?php endforeach;} ?>
    </div>
</section>


<!-- Featured Cyclists -->
<section class="py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Featured Cyclists</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Meet the talented athletes who make Tour de Maroc an unforgettable experience.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

            <?php if (!$TopCyclists) { ?>
                <div class="h-40 text-red-500 flex justify-center ">
                    <p>No Cyclist exists</p>
                </div>
            <?php } else { foreach ($TopCyclists as $key => $cyclist): ?>
                <div class="bg-white rounded-2xl overflow-hidden shadow-lg transition duration-300 hover:shadow-xl">
                    <img src="/api/placeholder/400/500" alt="<?= htmlspecialchars($cyclist->getFullName()) ?>" class="w-full h-64 object-cover">
                    <div class="p-6 text-center">
                        <h3 class="font-bold text-xl mb-2"><?= htmlspecialchars($cyclist->getFullName()) ?></h3>
                        <p class="text-emerald-500">Team : <?= htmlspecialchars($cyclist->getTeam()) ?></p>
                    </div>
                </div>
            <?php endforeach;} ?>
        </div>
    </div>
</section>

<!-- Latest News -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Latest News</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Stay updated with the latest developments from Tour de Maroc.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="bg-gray-50 rounded-2xl overflow-hidden shadow-lg transition duration-300 hover:shadow-xl">
                <img src="/api/placeholder/600/400" alt="News 1" class="w-full h-48 object-cover">
                <div class="p-6">
                    <span class="text-emerald-500 text-sm font-semibold">News</span>
                    <h3 class="font-bold text-xl mt-2 mb-4">2024 Tour Highlights: Unexpected Turn of Events</h3>
                    <p class="text-gray-600 mb-4">Experience the most thrilling moments from last year's tour, featuring unexpected victories and remarkable achievements.</p>
                    <a href="#" class="inline-flex items-center text-emerald-500 hover:text-emerald-600">
                        Read More
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
            <div class="bg-gray-50 rounded-2xl overflow-hidden shadow-lg transition duration-300 hover:shadow-xl">
                <img src="/api/placeholder/600/400" alt="News 2" class="w-full h-48 object-cover">
                <div class="p-6">
                    <span class="text-emerald-500 text-sm font-semibold">Interview</span>
                    <h3 class="font-bold text-xl mt-2 mb-4">Interview with the 2024 Tour Winner</h3>
                    <p class="text-gray-600 mb-4">An exclusive interview with last year's champion, sharing insights into their victory and future aspirations.</p>
                    <a href="#" class="inline-flex items-center text-emerald-500 hover:text-emerald-600">
                        Read More
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
            <div class="bg-gray-50 rounded-2xl overflow-hidden shadow-lg transition duration-300 hover:shadow-xl">
                <img src="/api/placeholder/600/400" alt="News 3" class="w-full h-48 object-cover">
                <div class="p-6">
                    <span class="text-emerald-500 text-sm font-semibold">Updates</span>
                    <h3 class="font-bold text-xl mt-2 mb-4">Preparations for the 2025 Tour de Maroc</h3>
                    <p class="text-gray-600 mb-4">Get a sneak peek into the preparations and exciting changes coming to this year's Tour de Maroc.</p>
                    <a href="#" class="inline-flex items-center text-emerald-500 hover:text-emerald-600">
                        Read More
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>