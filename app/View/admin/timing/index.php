<div class="container mx-auto px-4 py-6 bg-gray-100">
    <!-- Page Title -->
    <h2 class="text-3xl font-bold mb-4">Enter Cyclist Stage Completion</h2>
    
    <!-- Stage Completion Form -->
    <div class="bg-white shadow-lg rounded-lg p-6 mb-8">
        <h4 class="text-xl font-semibold mb-4">Stage Completion Entry</h4>
        
        <form action="<?= url('timing/store') ?>" method="POST">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <!-- Cyclist Selection -->
                <div>
                    <label for="cyclist-select" class="block text-sm font-medium text-gray-700 mb-2">Select Cyclist</label>
                    <div class="relative">
                        <select id="cyclist-select" name="cyclist_id" class="block w-full bg-white border border-gray-300 rounded-md py-2 pl-3 pr-10 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            <option value="">-- Select Cyclist --</option>
                            <?php foreach($cyclists as $cyclist): ?>
                                <option value="<?= $cyclist->getId() ?>"><?= $cyclist->getFullName() ?> (<?= $cyclist->getTeam() ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                
                <!-- Stage Selection -->
                <div>
                    <label for="stage-select" class="block text-sm font-medium text-gray-700 mb-2">Select Stage</label>
                    <div class="relative">
                        <select id="stage-select" name="stage_id" class="block w-full bg-white border border-gray-300 rounded-md py-2 pl-3 pr-10 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            <option value="">-- Select Stage --</option>
                            <?php foreach($stages as $stage): ?>
                                <option value="<?= $stage->getId() ?>">Stage <?= $stage->getOrder() ?>: <?= $stage->getStLocation() ?> to <?= $stage->getEnLocation() ?> (<?= number_format($stage->getDistance()) ?> km)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            
            <!-- Completion Time -->
            <div class="mt-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Completion Time</label>
                <div class="flex flex-wrap items-center gap-2">
                    <div class="flex-1 min-w-[100px]">
                        <label for="hours" class="block text-xs text-gray-500 mb-1">Hours</label>
                        <input type="number" name="hours" id="hours" min="0" max="24"
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50"
                               placeholder="00" />
                    </div>
                    <div class="flex-1 min-w-[100px]">
                        <label for="minutes" class="block text-xs text-gray-500 mb-1">Minutes</label>
                        <input type="number" name="minutes" id="minutes" min="0" max="59"
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50"
                               placeholder="00" />
                    </div>
                    <div class="flex-1 min-w-[100px]">
                        <label for="seconds" class="block text-xs text-gray-500 mb-1">Seconds</label>
                        <input type="number" name="seconds" id="seconds" min="0" max="59"
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50"
                               placeholder="00" />
                    </div>
                </div>
            </div>
            
            <!-- Submit Button -->
            <div class="mt-6 flex justify-end">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow transition duration-150 ease-in-out">
                    Save Stage Completion
                </button>
            </div>
        </form>
    </div>
    
    <!-- Recent Entries -->
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-green-50">
            <h4 class="text-lg font-semibold text-green-800">Recent Stage Entries</h4>
        </div>
        
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Cyclist
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Stage
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Time
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Points
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Entered By
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rankings as $rank): ?>
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-10 h-10">
                                        <img class="w-full h-full rounded-full" src="<?= $rank->getCyclist()->getPhoto() ?>" alt="Cyclist" />
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-gray-900 whitespace-no-wrap"><?= $rank->getCyclist()->getFullName() ?></p>
                                        <p class="text-gray-500 text-xs"><?= $rank->getCyclist()->getTeam() ?></p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">Stage <?= $rank->getStage()->getOrder() ?>: <?= $rank->getStage()->getStLocation() ?> to <?= $rank->getStage()->getEnLocation() ?></p>
                                <p class="text-gray-500 text-xs"><?= $rank->getStage()->getDistance() ?> km</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap"><?= $rank->getTotalTime() ?></p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap"><?= $rank->getPointsAwarded() ?></p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">Admin (You)</p>
                                <p class="text-gray-500 text-xs">
                                    <?= date('F j, Y, g:i A', strtotime($rank->getCreatedAt())) ?>
                                </p>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
