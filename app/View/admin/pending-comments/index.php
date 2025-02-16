<?php
$titlePage = "Pending Comments" ;
?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Pending Comments</h1>

    <!-- Comments Table -->
    <section class="bg-white rounded-xl shadow-lg overflow-hidden">
        <?php if (!empty($date["comments"])): ?>
            <div class="p-6">
                <div class="text-center">
                    <div class="flex justify-center mb-6">
                        <div class="h-24 w-24 bg-emerald-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-comments text-4xl text-emerald-500"></i>
                        </div>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">All Clear!</h3>
                    <p class="text-gray-500 max-w-md mx-auto">
                        There are no pending comments to review at the moment.
                    </p>
                </div>
            </div>
        <?php else: ?>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-emerald-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-emerald-700 uppercase tracking-wider">
                            Author
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-emerald-700 uppercase tracking-wider">
                            Stage
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-emerald-700 uppercase tracking-wider">
                            Comment
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-emerald-700 uppercase tracking-wider">
                            Date
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-emerald-700 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach ($data["comments"] as $comment): ?>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="h-10 w-10 flex-shrink-0">
                                    <img class="h-10 w-10 rounded-full object-cover" src="<?= $comment->getAuthor()->getPhoto() ?? 'https://placehold.co/40x40' ?>" alt="Author">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900"><?= $comment->getAuthor()->getFullName() ?></div>
                                    <div class="text-sm text-gray-500"><?= $comment->getAuthor()->getEmail() ?></div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900"><?= $comment->getStage()->getName() ?></div>
                            <div class="text-xs text-gray-500">Stage <?= $comment->getStage()->getOrder() ?></div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900 max-w-xs truncate"><?= htmlspecialchars($comment->getContent()) ?></div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900"><?= (new DateTime($comment->getCreatedAt()))->format('F d, Y') ?></div>
                            <div class="text-sm text-gray-500"><?= getTimeAgoFromDate($comment->getCreatedAt()) ?></div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <div class="flex space-x-2">
                                <form action="<?= URLROOT . 'comments/publish'  ?>" method="POST">
                                    <input type="hidden" name="id" value="<?=$comment->getId()?>">
                                    <button class="bg-emerald-500 hover:bg-emerald-600 text-white px-3 py-1 rounded-lg transition-colors duration-200 flex items-center space-x-1">
                                        <i class="fas fa-check"></i>
                                        <span>Publish</span>
                                    </button>
                                </form>
                                <form action="<?= URLROOT . 'comments/delete'?>" method="POST">
                                    <input type="hidden" name="id" value="<?=$comment->getId()?>">
                                    <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg transition-colors duration-200 flex items-center space-x-1">
                                        <i class="fas fa-trash"></i>
                                        <span>Delete</span>
                                    </button>
                                </form>
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

<!-- Comment Details Modal -->
<div id="commentDetailsModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 w-full max-w-2xl mx-4">
        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Comment Details</h3>
        <div id="commentDetails" class="space-y-4">
            <!-- Comment details will be populated here -->
        </div>
        <div class="mt-6 flex justify-end space-x-2">
            <button onclick="closeCommentModal()" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-colors duration-200">
                Close
            </button>
            <form id="publishForm" method="POST">
                <button type="submit" class="px-4 py-2 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600 transition-colors duration-200">
                    Publish
                </button>
            </form>
            <form id="deleteForm" method="POST" onsubmit="return confirm('Are you sure you want to delete this comment?');">
                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors duration-200">
                    Delete
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function viewComment(commentId) {
        // Fetch comment details and populate the modal
        // This is a placeholder. You'll need to implement the actual data fetching.
        document.getElementById('commentDetails').innerHTML = `
            <p><strong>Author:</strong> John Doe</p>
            <p><strong>Stage:</strong> Mountain Challenge (Stage 3)</p>
            <p><strong>Date:</strong> June 15, 2023</p>
            <p><strong>Comment:</strong></p>
            <p class="bg-gray-100 p-4 rounded-lg">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam auctor, nisl nec ultricies lacinia, nisl nisl aliquam nisl, nec aliquam nisl nisl sit amet nisl.</p>
        `;
        document.getElementById('publishForm').action = `<?= URLROOT ?>comments/publish/${commentId}`;
        document.getElementById('deleteForm').action = `<?= URLROOT ?>comments/delete/${commentId}`;
        document.getElementById('commentDetailsModal').classList.remove('hidden');
        document.getElementById('commentDetailsModal').classList.add('flex');
    }

    function closeCommentModal() {
        document.getElementById('commentDetailsModal').classList.remove('flex');
        document.getElementById('commentDetailsModal').classList.add('hidden');
    }

    document.getElementById('commentDetailsModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeCommentModal();
        }
    });
</script>