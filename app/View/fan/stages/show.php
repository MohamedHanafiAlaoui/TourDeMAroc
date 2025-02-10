<div class="pt-20 max-w-7xl mx-auto px-4 py-10">
  <div class="bg-white rounded-2xl shadow-xl p-8">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
      <div>
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Stage 1: Casablanca → Rabat</h1>
        <p class="text-xl text-gray-600">May 1, 2025 -> May 15, 2025</p>
      </div>
      <div class="mt-4 md:mt-0 flex items-center bg-emerald-100 text-emerald-700 px-4 py-2 rounded-full">
        <i class="fas fa-flag-checkered mr-2"></i>
        <span class="font-semibold">Stage Complete</span>
      </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
      <div class="bg-gray-100 p-4 rounded-lg">
        <h3 class="text-lg font-semibold mb-2">Distance</h3>
        <p class="text-2xl font-bold text-emerald-600">90 km</p>
      </div>
      <div class="bg-gray-100 p-4 rounded-lg">
        <h3 class="text-lg font-semibold mb-2">Type</h3>
        <p class="text-2xl font-bold text-emerald-600">Coastal</p>
      </div>
      <div class="bg-gray-100 p-4 rounded-lg">
        <h3 class="text-lg font-semibold mb-2">Reached Players</h3>
        <p class="text-2xl font-bold text-emerald-600">11</p>
      </div>
    </div>
    <div class="mb-8">
      <h2 class="text-2xl font-bold text-gray-800 mb-4">Stage Description</h2>
      <p class="text-gray-600 leading-relaxed">
        This coastal stage takes riders on a scenic journey from the bustling city of Casablanca to the historic capital of Rabat. 
        Cyclists will face gentle rolling hills and enjoy breathtaking views of the Atlantic Ocean. The route passes through 
        charming coastal towns, offering a mix of urban and natural landscapes. Expect potential crosswinds that could split 
        the peloton and create exciting racing conditions.
      </p>
    </div>
    <div class="mb-8">
      <h2 class="text-2xl font-bold text-gray-800 mb-4">Key Points</h2>
      <ul class="list-disc list-inside text-gray-600 space-y-2">
        <li>Sprint point at 45 km mark in Bouznika</li>
        <li>King of the Mountains climb at 70 km near Skhirat (Category 4)</li>
        <li>Technical finish with a slight uphill in the last 2 km</li>
      </ul>
    </div>
  </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-8">
  <h2 class="text-2xl font-bold text-gray-800 mb-4">Stage Results</h2>
  <div class="bg-white rounded-2xl shadow-xl p-8">
    <table class="w-full border-collapse">
      <thead>
        <tr class="bg-gray-100">
          <th class="py-3 px-4 text-left">Rank</th>
          <th class="py-3 px-4 text-left">Player</th>
          <th class="py-3 px-4 text-left">Team</th>
          <th class="py-3 px-4 text-left">Time</th>
          <th class="py-3 px-4 text-left">Points</th>
        </tr>
      </thead>
      <tbody id="ranking-body">
        <!-- Ranking data will be populated here -->
      </tbody>
    </table>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const rankings = [
      { rank: 1, name: "John Doe", team: "Morocco", time: "2h 15m 30s", points: 50 },
      { rank: 2, name: "Alice Smith", team: "France", time: "2h 15m 45s", points: 40 },
      { rank: 3, name: "Carlos Rodriguez", team: "USA", time: "2h 16m 02s", points: 30 },
      { rank: 4, name: "Emma Wilson", team: "Morocco", time: "2h 16m 15s", points: 20 },
      { rank: 5, name: "Liam Brown", team: "Saudi Arabia", time: "2h 16m 30s", points: 10 }
    ];

    const rankingBody = document.getElementById("ranking-body");
    rankings.forEach(player => {
      const row = document.createElement("tr");
      row.className = "border-b border-gray-200 hover:bg-gray-50";
      row.innerHTML = `
        <td class="py-3 px-4">${player.rank}</td>
        <td class="py-3 px-4 font-medium">${player.name}</td>
        <td class="py-3 px-4">${player.team}</td>
        <td class="py-3 px-4">${player.time}</td>
        <td class="py-3 px-4">${player.points}</td>
      `;
      rankingBody.appendChild(row);
    });
  });
</script>