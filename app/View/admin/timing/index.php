<div class="container mx-auto px-4 py-6 bg-gray-100">
    <!-- Page Title -->
    <h2 class="text-3xl font-bold mb-4">Enter Cyclist Stage Completion</h2>
    
    <!-- Stage Completion Form -->
    <div class="bg-white shadow-lg rounded-lg p-6 mb-8">
        <h4 class="text-xl font-semibold mb-4">Stage Completion Entry</h4>
        
        <form>
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <!-- Cyclist Selection -->
                <div>
                    <label for="cyclist-select" class="block text-sm font-medium text-gray-700 mb-2">Select Cyclist</label>
                    <div class="relative">
                        <select id="cyclist-select" class="block w-full bg-white border border-gray-300 rounded-md py-2 pl-3 pr-10 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            <option value="">-- Select Cyclist --</option>
                            <option value="cyclist1">John Doe (Team Morocco)</option>
                            <option value="cyclist2">Jane Smith (Team France)</option>
                            <option value="cyclist3">Ahmed Hassan (Team Egypt)</option>
                            <option value="cyclist4">Maria Rodriguez (Team Spain)</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                            </svg>
                        </div>
                    </div>
                </div>
                
                <!-- Stage Selection -->
                <div>
                    <label for="stage-select" class="block text-sm font-medium text-gray-700 mb-2">Select Stage</label>
                    <div class="relative">
                        <select id="stage-select" class="block w-full bg-white border border-gray-300 rounded-md py-2 pl-3 pr-10 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            <option value="">-- Select Stage --</option>
                            <option value="stage1">Stage 1: Tangier to Tetouan (120 km)</option>
                            <option value="stage2">Stage 2: Tetouan to Chefchaouen (150 km)</option>
                            <option value="stage3">Stage 3: Chefchaouen to Fez (180 km)</option>
                            <option value="stage4">Stage 4: Fez to Meknes (110 km)</option>
                            <option value="stage5">Stage 5: Meknes to Rabat (170 km)</option>
                            <option value="stage6">Stage 6: Marrakech to Agadir (250 km)</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Completion Time -->
            <div class="mt-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Completion Time</label>
                <div class="flex flex-wrap items-center gap-2">
                    <div class="flex-1 min-w-[100px]">
                        <label for="hours" class="block text-xs text-gray-500 mb-1">Hours</label>
                        <input type="number" id="hours" min="0" max="24"
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50"
                               placeholder="00" />
                    </div>
                    <div class="flex-1 min-w-[100px]">
                        <label for="minutes" class="block text-xs text-gray-500 mb-1">Minutes</label>
                        <input type="number" id="minutes" min="0" max="59"
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50"
                               placeholder="00" />
                    </div>
                    <div class="flex-1 min-w-[100px]">
                        <label for="seconds" class="block text-xs text-gray-500 mb-1">Seconds</label>
                        <input type="number" id="seconds" min="0" max="59"
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
                                Entered By
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Entry 1 -->
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-10 h-10">
                                        <img class="w-full h-full rounded-full" src="https://randomuser.me/api/portraits/men/1.jpg" alt="John Doe" />
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-gray-900 whitespace-no-wrap">John Doe</p>
                                        <p class="text-gray-500 text-xs">Team Morocco</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">Stage 6: Marrakech to Agadir</p>
                                <p class="text-gray-500 text-xs">250 km</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">04:15:22</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">Admin (You)</p>
                                <p class="text-gray-500 text-xs">15 Feb, 2025 14:30</p>
                            </td>
                        </tr>
                        
                        <!-- Additional entries can follow the same structure -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
