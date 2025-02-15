<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Stage Reports</h1>

    <!-- Reports Table -->
    <section class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-emerald-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-emerald-700 uppercase tracking-wider">
                            Fan
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-emerald-700 uppercase tracking-wider">
                            Stage
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-emerald-700 uppercase tracking-wider">
                            Report Message
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-emerald-700 uppercase tracking-wider">
                            Date
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-emerald-700 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="reportsList">
                    <?php foreach ($data["allReports"] as $report): ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 flex-shrink-0">
                                        <img class="h-10 w-10 rounded-full object-cover" src="https://placehold.co/40x40"
                                            alt="Fan">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900"><?=$report["reporter"]->getFirstName()?></div>
                                        
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900"><?=$report["stage"]->getName()?></div>
                                <div class="text-xs text-gray-500"><?=$report["stage"]->getDescription()?></div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900 max-w-xs truncate"><?=$report["report"]->getMessage()?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900"><?=$report["report"]->getCreatedAt()?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <div class="flex space-x-2">
                                    <button 
                                        class="bg-emerald-500 hover:bg-emerald-600 text-white px-3 py-1 rounded-lg transition-colors duration-200 flex items-center space-x-1">
                                        <i class="fas fa-check"></i>
                                        <span>Resolve</span>
                                    </button>
                                    <form action="" method="post">
                                        <input type="hidden" name="reportId" value="<?=$report["report"]->getId()?>">
                                        <button
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg transition-colors duration-200 flex items-center space-x-1">
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
    </section>
</div>

<!-- Report Details Modal -->
<div id="reportDetailsModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 w-full max-w-2xl mx-4">
        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Report Details</h3>
        <div id="reportDetails" class="space-y-4">
            <!-- Report details will be populated here -->
        </div>
        <div class="mt-6 flex justify-end space-x-2">
            <button onclick="closeReportModal()"
                class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-colors duration-200">
                Close
            </button>
            <button onclick="markAsResolved()"
                class="px-4 py-2 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600 transition-colors duration-200">
                Mark as Resolved
            </button>
            <button onclick="deleteReport()"
                class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors duration-200">
                Delete Report
            </button>
        </div>
    </div>
</div>

<script>
    // Sample data (replace with actual data fetching)
    const reports = [
        { id: 1, fanName: "John Doe", stageName: "Mountain Challenge", stageNumber: 3, message: "The distance for this stage seems incorrect.", date: "2023-06-15" },
        { id: 2, fanName: "Jane Smith", stageName: "Coastal Sprint", stageNumber: 5, message: "The start city is listed wrong for this stage.", date: "2023-06-16" },
        { id: 3, fanName: "Mike Johnson", stageName: "Desert Endurance", stageNumber: 7, message: "The stage description doesn't match the route.", date: "2023-06-17" },
    ];

    function renderReports() {
        const reportsList = document.getElementById('reportsList');
        // reportsList.innerHTML = '';

    //     reports.forEach(report => {
    //         const row = document.createElement('tr');
    //         row.innerHTML = `
    //             <td class="px-6 py-4 whitespace-nowrap">
    //                 <div class="flex items-center">
    //                     <div class="h-10 w-10 flex-shrink-0">
    //                         <img class="h-10 w-10 rounded-full object-cover" src="https://placehold.co/40x40" alt="Fan">
    //                     </div>
    //                     <div class="ml-4">
    //                         <div class="text-sm font-medium text-gray-900">${report.fanName}</div>
    //                     </div>
    //                 </div>
    //             </td>
    //             <td class="px-6 py-4 whitespace-nowrap">
    //                 <div class="text-sm text-gray-900">${report.stageName}</div>
    //                 <div class="text-xs text-gray-500">Stage ${report.stageNumber}</div>
    //             </td>
    //             <td class="px-6 py-4">
    //                 <div class="text-sm text-gray-900 max-w-xs truncate">${report.message}</div>
    //             </td>
    //             <td class="px-6 py-4 whitespace-nowrap">
    //                 <div class="text-sm text-gray-900">${report.date}</div>
    //             </td>
    //             <td class="px-6 py-4 whitespace-nowrap text-sm">
    //                 <div class="flex space-x-2">
    //                     <button onclick="markAsResolved(${report.id})" class="bg-emerald-500 hover:bg-emerald-600 text-white px-3 py-1 rounded-lg transition-colors duration-200 flex items-center space-x-1">
    //                         <i class="fas fa-check"></i>
    //                         <span>Resolve</span>
    //                     </button>
    //                     <button onclick="deleteReport(${report.id})" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg transition-colors duration-200 flex items-center space-x-1">
    //                         <i class="fas fa-trash"></i>
    //                         <span>Delete</span>
    //                     </button>
    //                 </div>
    //             </td>
    //         `;
    //         reportsList.appendChild(row);
    //     });
    }

    function closeReportModal() {
        document.getElementById('reportDetailsModal').classList.remove('flex');
        document.getElementById('reportDetailsModal').classList.add('hidden');
    }

    function markAsResolved(reportId) {
        // Implement the logic to mark the report as resolved
        console.log(`Marking report ${reportId} as resolved`);
        closeReportModal();
    }

    function deleteReport(reportId) {
        if (confirm('Are you sure you want to delete this report?')) {
            // Implement the logic to delete the report
            console.log(`Deleting report ${reportId}`);
            closeReportModal();
        }
    }

    document.getElementById('reportDetailsModal').addEventListener('click', function (e) {
        if (e.target === this) {
            closeReportModal();
        }
    });

    // Initial render
    renderReports();
</script>