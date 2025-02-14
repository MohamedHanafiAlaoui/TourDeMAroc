<?php $titlePage = "Manage Stages" ?>
<!-- Load Sortable.js for drag-and-drop functionality -->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.14.0/Sortable.min.js"></script>
<!-- Load SweetAlert2 for custom alerts -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Manage Stages</h1>
        <span id="stagesCounter" class="bg-emerald-100 text-emerald-800 text-sm font-semibold px-3 py-1 rounded-full"></span>
    </div>

    <!-- Add New Stage Form -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8 transition-all duration-300 hover:shadow-xl">
        <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            Add New Stage
        </h2>
        <form action="<?= url('stage/store') ?>" class="space-y-4" method="post" >
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <!-- Stage Name -->
                <div class="group">
                    <label for="stageName" class="block text-sm font-medium text-gray-700 mb-1">Stage Name</label>
                    <div class="relative">
                        <input type="text" id="stageName" name="stageName" required placeholder="Enter stage name"
                               class="w-full rounded-md border-gray-300 shadow-md focus:border-emerald-300 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 pl-3 py-2 text-gray-900 transition-all duration-200 group-hover:border-emerald-200">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                            <span class="text-emerald-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- Start City -->
                <div class="group">
                    <label for="startCity" class="block text-sm font-medium text-gray-700 mb-1">Start City</label>
                    <div class="relative">
                        <input type="text" id="startCity" name="startCity" required placeholder="Enter start city"
                               class="w-full rounded-md border-gray-300 shadow-md focus:border-emerald-300 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 pl-3 py-2 text-gray-900 transition-all duration-200 group-hover:border-emerald-200">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                            <span class="text-emerald-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- End City -->
                <div class="group">
                    <label for="endCity" class="block text-sm font-medium text-gray-700 mb-1">End City</label>
                    <div class="relative">
                        <input type="text" id="endCity" name="endCity" required placeholder="Enter end city"
                               class="w-full rounded-md border-gray-300 shadow-md focus:border-emerald-300 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 pl-3 py-2 text-gray-900 transition-all duration-200 group-hover:border-emerald-200">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                            <span class="text-emerald-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- photo -->
                <div class="group">
                    <label for="photo" class="block text-sm font-medium text-gray-700 mb-1">photo</label>
                    <div class="relative">
                        <input type="text" id="photo" name="photo" required placeholder="Enter end photoURl"
                               class="w-full rounded-md border-gray-300 shadow-md focus:border-emerald-300 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 pl-3 py-2 text-gray-900 transition-all duration-200 group-hover:border-emerald-200">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                            <span class="text-emerald-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- Distance -->
                <div class="group">
                    <label for="distance" class="block text-sm font-medium text-gray-700 mb-1">Distance (km)</label>
                    <div class="relative">
                        <input type="number" id="distance" name="distance" required min="1" placeholder="Enter distance in km"
                               class="w-full rounded-md border-gray-300 shadow-md focus:border-emerald-300 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 pl-3 py-2 text-gray-900 transition-all duration-200 group-hover:border-emerald-200">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                            <span class="text-emerald-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- Start Date (Icon removed) -->
                <div class="group">
                    <label for="startDate" class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
                    <div class="relative">
                        <input type="date" id="startDate" name="startDate" required placeholder="Select start date"
                               class="w-full rounded-md border-gray-300 shadow-md focus:border-emerald-300 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 pl-3 py-2 text-gray-900 transition-all duration-200">
                    </div>
                </div>
                <!-- End Date (Icon removed) -->
                <div class="group">
                    <label for="endDate" class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                    <div class="relative">
                        <input type="date" id="endDate" name="endDate" required placeholder="Select end date"
                               class="w-full rounded-md border-gray-300 shadow-md focus:border-emerald-300 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 pl-3 py-2 text-gray-900 transition-all duration-200">
                    </div>
                </div>
                <!-- Category (Select, icon removed) -->
                <div class="group">
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                    <div class="relative">
                        <select id="category" name="category" 
                                class="w-full rounded-md border-gray-300 shadow-md focus:border-emerald-300 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 pl-3 py-2 text-gray-900 transition-all duration-200">
                            <option value="">Select a category</option>
                            <?php foreach ($data["categories"] as $categories) :?>
                            <option value="<?=$categories->getId()?>"><?=$categories->getName()?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                <!-- Region (Select, icon removed) -->
                <div class="group">
                    <label for="region" class="block text-sm font-medium text-gray-700 mb-1">Region</label>
                    <div class="relative">
                        <select id="region" name="region" 
                                class="w-full rounded-md border-gray-300 shadow-md focus:border-emerald-300 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 pl-3 py-2 text-gray-900 transition-all duration-200">
                            <option value="">Select a region</option>
                            <?php foreach ($data["ragions"] as $categories) :?>
                            <option value="<?=$categories->getId()?>"><?=$categories->getName()?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
            </div>
            <!-- Description -->
            <div class="group">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea id="description" name="description" rows="3" placeholder="Enter stage description"
                          class="w-full rounded-md border-gray-300 shadow-md focus:border-emerald-300 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 pl-3 py-2 text-gray-900 transition-all duration-200"></textarea>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-2 px-4 rounded-md transition duration-300 ease-in-out flex items-center shadow-md hover:shadow-lg transform hover:-translate-y-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Add Stage
                </button>
            </div>
        </form>
    </div>

    <!-- Minimum Stages Warning -->
    <div id="minimumStagesWarning" class="hidden bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-8 rounded-md">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm text-yellow-700">
                    <strong>Note:</strong> A race requires at least 2 stages. Please add more stages to complete the race setup.
                </p>
            </div>
        </div>
    </div>

    <!-- Stages List -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8 transition-all duration-300 hover:shadow-xl">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
                Existing Stages
            </h2>
            <div>
                <button id="saveOrderBtn" class="bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-2 px-4 rounded-md transition duration-300 ease-in-out flex items-center hidden shadow-md hover:shadow-lg transform hover:-translate-y-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Save Order
                </button>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stage</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Route</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Distance</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dates</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Region</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="stagesList">
                    <!-- Stages will be dynamically inserted here -->
                    <?php foreach ($data["stages"] as $stage) : ?>
                        <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                        <button class="handle text-gray-400 hover:text-gray-600 mr-2 cursor-move">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                            </svg>
                        </button>
                        <span class="text-sm text-gray-900"><?=$stage->getId()?></span>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900"><?=$stage->getName()?></div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900"><?=$stage->getStLocation()?>to <?=$stage->getEnLocation()?></div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900"><?=$stage->getDistance()?> km</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900"><?=$stage->getStDate()?></div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${getCategoryClass(stage.category)}">
                        <?=$stage->getNameCategory()?>
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900"><?=$stage->getNameRegion()?></div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <button onclick="viewStage(<?=$stage->getId()?>)" class="text-indigo-600 hover:text-indigo-900 mr-2">View</button>
                    <button onclick="deleteStage(<?=$stage->getId()?>)" class="text-red-600 hover:text-red-900">Delete</button>
                </td>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Stage Details Modal -->
<div id="stageDetailsModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 transition-opacity duration-300 backdrop-blur-sm">
    <div class="bg-white rounded-lg p-6 w-full max-w-2xl mx-4 transform transition-all duration-300">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-2xl font-semibold text-gray-800">Stage Details</h3>
            <button onclick="closeStageModal()" class="text-gray-400 hover:text-gray-500 focus:outline-none">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div id="stageDetails" class="space-y-4">
            <!-- Stage details will be populated here -->
        </div>
        <div class="mt-6 flex justify-end space-x-2">
            <button onclick="closeStageModal()" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-colors duration-200 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                Close
            </button>
            <button id="deleteStageBtn" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors duration-200 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
                Delete
            </button>
        </div>
    </div>
</div>

<script>
    // Sample data (replace with actual data fetching)
    let stages = [
        { id: 1, name: "Mountain Challenge", startCity: "Marrakech", endCity: "Oukaïmeden", distance: 120, startDate: "2023-07-01", endDate: "2023-07-01", category: "mountain", region: "atlas", description: "A challenging mountain stage in the Atlas mountains." },
        { id: 2, name: "Sahara Sprint", startCity: "Ouarzazate", endCity: "Merzouga", distance: 180, startDate: "2023-07-03", endDate: "2023-07-03", category: "plain", region: "sahara", description: "A fast-paced stage through the Sahara desert." },
    ];

    // Initialize sortable for drag-and-drop reordering
    let sortable;
    function initSortable() {
        const el = document.getElementById('stagesList');
        sortable = Sortable.create(el, {
            handle: '.handle',
            animation: 150,
            onStart: function() {
                document.getElementById('saveOrderBtn').classList.remove('hidden');
            }
        });
    }

    function formatDateRange(startDate, endDate) {
        const options = { year: 'numeric', month: 'short', day: 'numeric' };
        const start = new Date(startDate).toLocaleDateString(undefined, options);
        const end = new Date(endDate).toLocaleDateString(undefined, options);
        
        if (startDate === endDate) {
            return start;
        } else {
            return `${start} to ${end}`;
        }
    }

    function renderStages() {
        const stagesList = document.getElementById('stagesList');
        stagesList.innerHTML = '';

        if (stages.length < 2) {
            document.getElementById('minimumStagesWarning').classList.remove('hidden');
        } else {
            document.getElementById('minimumStagesWarning').classList.add('hidden');
        }

        document.getElementById('stagesCounter').textContent = `${stages.length} ${stages.length === 1 ? 'Stage' : 'Stages'}`;

        stages.forEach((stage, index) => {
            const row = document.createElement('tr');
            row.dataset.id = stage.id;
            
            row.innerHTML = `
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                        <button class="handle text-gray-400 hover:text-gray-600 mr-2 cursor-move">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                            </svg>
                        </button>
                        <span class="text-sm text-gray-900">${index + 1}</span>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">${stage.name}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">${stage.startCity} to ${stage.endCity}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">${stage.distance} km</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">${formatDateRange(stage.startDate, stage.endDate)}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${getCategoryClass(stage.category)}">
                        ${stage.category}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">${stage.region}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <button onclick="viewStage(${stage.id})" class="text-indigo-600 hover:text-indigo-900 mr-2">View</button>
                    <button onclick="deleteStage(${stage.id})" class="text-red-600 hover:text-red-900">Delete</button>
                </td>
            `;
            stagesList.appendChild(row);
        });

        initSortable();
    }

    function getCategoryClass(category) {
        const classes = {
            'mountain': 'bg-purple-100 text-purple-800',
            'plain': 'bg-green-100 text-green-800',
            'terrain': 'bg-amber-100 text-amber-800',
            'velodrome': 'bg-blue-100 text-blue-800'
        };
        return classes[category] || 'bg-gray-100 text-gray-800';
    }

    let currentStageId = null;

    function viewStage(stageId) {
        const stage = stages.find(s => s.id === stageId);
        currentStageId = stageId;
        
        document.getElementById('stageDetails').innerHTML = `
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-sm font-medium text-gray-500">Name</p>
                    <p class="text-base font-semibold">${stage.name}</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Route</p>
                    <p class="text-base font-semibold">${stage.startCity} to ${stage.endCity}</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Distance</p>
                    <p class="text-base font-semibold">${stage.distance} km</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Dates</p>
                    <p class="text-base font-semibold">${formatDateRange(stage.startDate, stage.endDate)}</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Category</p>
                    <p class="text-base font-semibold">${stage.category}</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Region</p>
                    <p class="text-base font-semibold">${stage.region}</p>
                </div>
            </div>
            <div class="mt-4">
                <p class="text-sm font-medium text-gray-500">Description</p>
                <p class="text-base">${stage.description || 'No description provided'}</p>
            </div>
        `;

        // Set the delete button action to use SweetAlert2 in our custom deleteStage function
        document.getElementById('deleteStageBtn').onclick = () => deleteStage(stageId);
        
        document.getElementById('stageDetailsModal').classList.remove('hidden');
        document.getElementById('stageDetailsModal').classList.add('flex');
    }

    function closeStageModal() {
        document.getElementById('stageDetailsModal').classList.remove('flex');
        document.getElementById('stageDetailsModal').classList.add('hidden');
    }

    function deleteStage(stageId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you really want to delete this stage? This action cannot be undone.",
            icon: 'warning',
            showCancelButton: true,
            reverseButtons: false, // Cancel button on left, Delete (confirm) on right
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                stages = stages.filter(s => s.id !== stageId);
                renderStages();
                closeStageModal();
                Swal.fire({
                    title: 'Deleted!',
                    text: 'Stage deleted successfully!',
                    icon: 'success',
                    timer: 1500,
                    showConfirmButton: false
                });
            }
        });
    }

    function saveOrder() {
        // Get the new order from the DOM
        const newOrder = Array.from(document.querySelectorAll('#stagesList tr'))
            .map((row, index) => {
                const id = parseInt(row.dataset.id);
                return { id, index };
            });
        
        // Reorder the stages array
        stages = newOrder
            .map(item => {
                const stage = stages.find(s => s.id === item.id);
                return { ...stage };
            });
        
        renderStages();
        document.getElementById('saveOrderBtn').classList.add('hidden');
        // Show SweetAlert success notification
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Stage order updated successfully!',
            timer: 1500,
            showConfirmButton: false
        });
    }

    document.getElementById('addStageForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(e.target);
        const newStage = {
            id: stages.length > 0 ? Math.max(...stages.map(s => s.id)) + 1 : 1,
            name: formData.get('stageName'),
            startCity: formData.get('startCity'),
            endCity: formData.get('endCity'),
            distance: parseInt(formData.get('distance')),
            startDate: formData.get('startDate'),
            endDate: formData.get('endDate'),
            category: formData.get('category'),
            region: formData.get('region'),
            description: formData.get('description')
        };
        stages.push(newStage);
        renderStages();
        e.target.reset();
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Stage added successfully!',
            timer: 1500,
            showConfirmButton: false
        });
    });

    document.getElementById('saveOrderBtn').addEventListener('click', saveOrder);

    // Handle modal outside click
    document.getElementById('stageDetailsModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeStageModal();
        }
    });

    // Initial render
    renderStages();
</script>
