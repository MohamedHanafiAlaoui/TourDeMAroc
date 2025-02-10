<!-- Main Content -->
<main class="max-w-6xl mx-auto px-4 pt-28 pb-10">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">Tour de Maroc 2025 Players</h1>

    <!-- Search and Filter Section -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-8">
        <div class="w-full md:w-1/2 mb-4 md:mb-0">
            <div class="relative">
                <input type="text" id="search" placeholder="Search players..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            </div>
        </div>
        <div class="w-full md:w-auto">
            <button id="filterBtn" class="w-full md:w-auto bg-emerald-500 text-white px-6 py-2 rounded-lg hover:bg-emerald-600 transition duration-300 flex items-center justify-center">
                <i class="fas fa-filter mr-2"></i> Filter
            </button>
        </div>
    </div>

    <!-- Players List -->
    <div id="playersList" class="space-y-4">
        <!-- Player rows will be dynamically inserted here -->
    </div>

    <!-- Pagination -->
    <div class="flex justify-center items-center space-x-2 mt-8">
        <button id="prevPage" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-100 transition duration-300">Previous</button>
        <span id="currentPage" class="text-gray-600">Page 1 of 5</span>
        <button id="nextPage" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-100 transition duration-300">Next</button>
    </div>
</main>

<script>
    // Sample player data
    const players = [
        { name: "Mohammed El Amrani", nationality: "Morocco", team: "Team Morocco", age: 28, wins: 3, image: "https://example.com/player1.jpg" },
        { name: "Jean Dupont", nationality: "France", team: "Team France", age: 30, wins: 5, image: "https://example.com/player2.jpg" },
        { name: "Carlos Rodriguez", nationality: "Spain", team: "Team Spain", age: 25, wins: 2, image: "https://example.com/player3.jpg" },
        { name: "Giovanni Rossi", nationality: "Italy", team: "Team Italy", age: 27, wins: 4, image: "https://example.com/player4.jpg" },
        { name: "Jan Janssen", nationality: "Netherlands", team: "Team Netherlands", age: 29, wins: 3, image: "https://example.com/player5.jpg" },
        { name: "Ahmed Hassan", nationality: "Egypt", team: "Team Egypt", age: 26, wins: 1, image: "https://example.com/player6.jpg" },
        // Add more players as needed
    ];

    const playersPerPage = 10;
    let currentPage = 1;

    function renderPlayers(playersToRender) {
        const playersList = document.getElementById('playersList');
        playersList.innerHTML = '';

        playersToRender.forEach(player => {
            const playerRow = document.createElement('div');
            playerRow.className = 'bg-white rounded-lg shadow-md p-4 flex items-center space-x-4 hover:shadow-lg transition duration-300';
            playerRow.innerHTML = `
                <img src="${player.image}" alt="${player.name}" class="w-16 h-16 rounded-full object-cover">
                <div class="flex-grow">
                    <h3 class="text-lg font-semibold text-gray-800">${player.name}</h3>
                    <div class="flex flex-wrap gap-2 mt-1">
                        <span class="text-sm text-gray-600">${player.nationality}</span>
                        <span class="text-sm text-gray-600">${player.team}</span>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-500">Age: ${player.age}</p>
                    <p class="text-sm font-semibold text-emerald-600">Wins: ${player.wins}</p>
                </div>
            `;
            playersList.appendChild(playerRow);
        });
    }

    function updatePagination() {
        const totalPages = Math.ceil(players.length / playersPerPage);
        document.getElementById('currentPage').textContent = `Page ${currentPage} of ${totalPages}`;
        document.getElementById('prevPage').disabled = currentPage === 1;
        document.getElementById('nextPage').disabled = currentPage === totalPages;
    }

    function showPage(page) {
        const startIndex = (page - 1) * playersPerPage;
        const endIndex = startIndex + playersPerPage;
        const playersToShow = players.slice(startIndex, endIndex);
        renderPlayers(playersToShow);
        updatePagination();
    }

    document.getElementById('prevPage').addEventListener('click', () => {
        if (currentPage > 1) {
            currentPage--;
            showPage(currentPage);
        }
    });

    document.getElementById('nextPage').addEventListener('click', () => {
        const totalPages = Math.ceil(players.length / playersPerPage);
        if (currentPage < totalPages) {
            currentPage++;
            showPage(currentPage);
        }
    });

    document.getElementById('search').addEventListener('input', (e) => {
        const searchTerm = e.target.value.toLowerCase();
        const filteredPlayers = players.filter(player => 
            player.name.toLowerCase().includes(searchTerm) ||
            player.nationality.toLowerCase().includes(searchTerm) ||
            player.team.toLowerCase().includes(searchTerm)
        );
        currentPage = 1;
        renderPlayers(filteredPlayers.slice(0, playersPerPage));
        updatePagination();
    });

    document.getElementById('filterBtn').addEventListener('click', () => {
        // Implement filter functionality here
        alert('Filter functionality to be implemented');
    });

    // Initial render
    showPage(currentPage);
</script>