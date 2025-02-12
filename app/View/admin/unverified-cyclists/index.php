<?php $titlePage = "Unverified Cyclists" ?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Unverified Cyclists</h1>

    <!-- Verification Table -->
    <section class="bg-white rounded-xl shadow-lg overflow-hidden">
        <?php if (empty($unverifiedCyclists)): ?>
            <div class="p-6">
                <div class="text-center">
                    <div class="flex justify-center mb-6">
                        <div class="h-24 w-24 bg-emerald-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-check-circle text-4xl text-emerald-500"></i>
                        </div>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">All Caught Up!</h3>
                    <p class="text-gray-500 max-w-md mx-auto">
                        There are no pending cyclist verification requests at the moment.
                    </p>
                </div>
            </div>
        <?php else: ?>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-emerald-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-emerald-700 uppercase tracking-wider">
                            Cyclist
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-emerald-700 uppercase tracking-wider">
                            Team
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-emerald-700 uppercase tracking-wider">
                            Registration Date
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-emerald-700 uppercase tracking-wider">
                            Status
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-emerald-700 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach ($unverifiedCyclists as $cyclist): ?>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="h-10 w-10 flex-shrink-0">
                                    <img class="h-10 w-10 rounded-full object-cover" src="<?= $cyclist->getProfileImage() ?? 'https://placehold.co/40x40' ?>" alt="Cyclist">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900"><?= $cyclist->getFullName() ?></div>
                                    <div class="text-sm text-gray-500"><?= $cyclist->getEmail() ?></div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900"><?= $cyclist->getTeam() ?? 'Not Specified' ?></div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900"><?= (new DateTime($cyclist->getCreatedAt()))->format('F d, Y') ?></div>
                            <div class="text-sm text-gray-500"><?= getTimeAgoFromDate($cyclist->getCreatedAt()) ?></div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Pending Review
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <div class="flex space-x-2">
                                <form action="<?= URLROOT . 'cyclists/verify/' . $cyclist->getId() ?>" method="POST">
                                    <button class="bg-emerald-500 hover:bg-emerald-600 text-white px-3 py-1 rounded-lg transition-colors duration-200 flex items-center space-x-1">
                                        <i class="fas fa-check"></i>
                                        <span>Verify</span>
                                    </button>
                                </form>
                                <button onclick="viewDetails(<?= $cyclist->getId() ?>)" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg transition-colors duration-200 flex items-center space-x-1">
                                    <i class="fas fa-eye"></i>
                                    <span>View</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </section>
</div>

<!-- Cyclist Details Modal -->
<div id="cyclistDetailsModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 w-full max-w-2xl mx-4">
        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Cyclist Details</h3>
        <div id="cyclistDetails" class="space-y-4">
            <!-- Cyclist details will be populated here -->
        </div>
        <div class="mt-6 flex justify-end">
            <button onclick="closeDetailsModal()" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-colors duration-200">
                Close
            </button>
        </div>
    </div>
</div>

<script>
    function viewDetails(cyclistId) {
        // Fetch cyclist details and populate the modal
        // This is a placeholder. You'll need to implement the actual data fetching.
        document.getElementById('cyclistDetails').innerHTML = `
            <p><strong>Name:</strong> John Doe</p>
            <p><strong>Email:</strong> john.doe@example.com</p>
            <p><strong>Team:</strong> Team Awesome</p>
            <p><strong>Registration Date:</strong> June 1, 2023</p>
            <p><strong>Additional Info:</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        `;
        document.getElementById('cyclistDetailsModal').classList.remove('hidden');
        document.getElementById('cyclistDetailsModal').classList.add('flex');
    }

    function closeDetailsModal() {
        document.getElementById('cyclistDetailsModal').classList.remove('flex');
        document.getElementById('cyclistDetailsModal').classList.add('hidden');
    }

    document.getElementById('cyclistDetailsModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeDetailsModal();
        }
    });
</script>