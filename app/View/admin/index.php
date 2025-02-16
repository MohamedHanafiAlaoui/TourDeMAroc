<div class="container mx-auto px-6">
    <!-- Stats Grid -->
    <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white shadow-lg rounded-lg p-4">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-emerald-500 rounded-md p-3">
                    <i class="fas fa-bicycle text-white text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-gray-500">Total Approved Cyclists</p>
                    <p class="text-2xl font-semibold text-gray-700"><?=$data["PlatfromStatistics"]["totalApprovedCyclests"]?></p>
                </div>
            </div>
        </div>
        <div class="bg-white shadow-lg rounded-lg p-4">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                    <i class="fas fa-road text-white text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-gray-500">Total Users</p>
                    <p class="text-2xl font-semibold text-gray-700"><?=$data['PlatfromStatistics']["totalUsers"]?></p>
                </div>
            </div>
        </div>
        <div class="bg-white shadow-lg rounded-lg p-4">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3">
                    <i class="fas fa-trophy text-white text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-gray-500">Current Leader</p>
                    <p class="text-2xl font-semibold text-gray-700"><?=$data["PlatfromStatistics"]["teamWithMostPlayers"]?></p>
                </div>
            </div>
        </div>
        <div class="bg-white shadow-lg rounded-lg p-4">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-red-500 rounded-md p-3">
                    <i class="fas fa-clock text-white text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-gray-500">Unresolved Reports</p>
                    <p class="text-2xl font-semibold text-gray-700"><?=$data["PlatfromStatistics"]["unresolvedReports"]?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Current Stage -->
    <div class="mt-8">
        <?php if($data["curentStage"]) : ?>
        <h4 class="text-gray-600 text-lg font-medium mb-4"><?=$data["curentStage"]->getName()?></h4>
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h5 class="text-xl font-semibold text-gray-700 mb-2">Stage <?=$data["curentStage"]->getId()?>: <?=$data["curentStage"]->getStLocation()?> to <?=$data["curentStage"]->getName()?></h5>
            <p class="text-gray-600 mb-4"><?=$data["curentStage"]->getDescription()?></p>
            <div class="flex justify-between items-center">
                <span class="text-sm text-gray-500"><i class="fas fa-map-marker-alt mr-2"></i><?=$data["curentStage"]->getDistance()?></span>
                <span class="text-sm text-gray-500"><i class="fas fa-mountain mr-2"></i>3500m elevation gain</span>
                <span class="text-sm text-emerald-500 font-semibold">In Progress</span>
            </div>
        </div>
        <?php endif;?>
    </div>

    <!-- Top Cyclists -->
    <div class="mt-8">
        <h4 class="text-gray-600 text-lg font-medium mb-4">Top Cyclists</h4>
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Cyclist
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Team
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Total ponits
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Stage Wins
                        </th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($data["TopCyclists"] as $cyclist) : ?>
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 w-10 h-10">
                                    <img class="w-full h-full rounded-full" src="https://randomuser.me/api/portraits/men/1.jpg" alt="" />
                                </div>
                                <div class="ml-3">
                                    <p class="text-gray-900 whitespace-no-wrap"><?=$cyclist->getFirstName()?> <?=$cyclist->getLastName()?></p>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap"><?=$cyclist->getTeam()?></p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap"><?=$cyclist->getPointsAwarded()?></p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">2</p>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Upcoming Stages -->
    <div class="mt-8">
        <h4 class="text-gray-600 text-lg font-medium mb-4">Upcoming Stages</h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <?php foreach ($data["nextStages"] as $stage) : ?>
            <div class="bg-white shadow-lg rounded-lg p-4">
                <h5 class="text-lg font-semibold text-gray-700 mb-2">Stage <?=$stage->getId()?>: <?=$stage->getStLocation()?> to <?=$stage->getName()?></h5>
                <p class="text-gray-600 mb-2"><?=$stage->getDescription()?></p>
                <div class="flex justify-between items-center text-sm text-gray-500">
                    <span><i class="fas fa-calendar mr-2"></i><?=$stage->getStDate()?></span>
                    <span><i class="fas fa-road mr-2"></i><?=$stage->getDistance()?></span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>