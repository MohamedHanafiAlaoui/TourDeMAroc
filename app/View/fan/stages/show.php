<div class="pt-20 max-w-7xl mx-auto px-4 py-10">
  <div class="bg-white rounded-2xl shadow-xl p-8">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
      <div> 
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Stage 1: <?php echo $stage->getStLocation(); ?> → <?php echo $stage->getEnLocation(); ?></h1>
        <p class="text-xl text-gray-600">
          <?php
          $startDate = (new DateTime($stage->getStDate()))->format("F j, Y");
          $endDate = (new DateTime($stage->getEnDate()))->format("F j, Y");
          echo "$startDate → $endDate";
          ?>
        </p>
      </div>


      <div class="mt-4 md:mt-0 flex items-center space-x-4">
        <form action="<?= url("like") ?>" method="POST" class="flex items-center space-x-2">
          <button type="submit" class="flex gap-2">
            <span class="<?= $isLiked ? 'text-red-500' : 'text-gray-500 hover:text-red-500' ?> transition">
              <i class="<?= $isLiked ? 'fas' : 'far' ?> fa-heart text-xl"></i>
            </span>
            <span id="likeCount" class="<?= $isLiked ? 'text-red-500' : 'text-gray-500' ?>"><?= $likes ?></span>
          </button>
          <input type="hidden" name="stage_id" value="<?= $stage->getId() ?>">
        </form>

        <?php
        $currentDate = date("Y-m-d");
        $stageStartDate = $stage->getStDate();
        $stageEndDate = $stage->getEnDate();

        if ($currentDate > $stageEndDate) {
          echo '<div class="flex items-center bg-emerald-100 text-emerald-700 px-4 py-2 rounded-full">
                  <i class="fas fa-flag-checkered mr-2"></i>
                  <span class="font-semibold">Stage Completed</span>
                </div>';
        } elseif ($currentDate >= $stageStartDate && $currentDate <= $stageEndDate) {
          echo '<div class="flex items-center bg-blue-100 text-blue-700 px-4 py-2 rounded-full">
                  <i class="fas fa-running mr-2"></i>
                  <span class="font-semibold">Stage In Progress</span>
                </div>';
        } else {
          echo '<div class="flex items-center bg-gray-100 text-gray-700 px-4 py-2 rounded-full">
                  <i class="fas fa-hourglass-start mr-2"></i>
                  <span class="font-semibold">Upcoming Stage</span>
                </div>';
        }
        ?>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
      <div class="bg-gray-100 p-4 rounded-lg">
        <h3 class="text-lg font-semibold mb-2">Distance</h3>
        <p class="text-2xl font-bold text-emerald-600"><?php echo $stage->getDistance(); ?> km</p>
      </div>
      <div class="bg-gray-100 p-4 rounded-lg">
        <h3 class="text-lg font-semibold mb-2">Type</h3>
        <p class="text-2xl font-bold text-emerald-600"><?php echo $stage->getNameRegion(); ?></p>
      </div>
      <div class="bg-gray-100 p-4 rounded-lg">
        <h3 class="text-lg font-semibold mb-2">Reached Players</h3>
        <p class="text-2xl font-bold text-emerald-600">11</p>
      </div>
    </div>

    <div class="mb-8">
      <h2 class="text-2xl font-bold text-gray-800 mb-4">Stage Description</h2>
      <p class="text-gray-600 leading-relaxed">
        <?php echo $stage->getDescription(); ?>
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

    <!-- Social Interaction Buttons -->
    <div class="flex justify-between mt-6 border-t pt-4">
      <div class="flex items-center space-x-4">
        <button id="reportButton" class="flex items-center space-x-2 text-gray-500 hover:text-yellow-500 transition">
          <i class="fas fa-flag text-xl"></i>
          <span>Report Stage</span>
        </button>
      </div>

      <!-- Notify Button -->
      <form action="<?= url('stages/notify/' . $stage->getId()) ?>" method="POST">
        <button id="notifyButton" class="flex items-center space-x-2 text-white bg-blue-500 hover:bg-blue-600 transition px-4 py-2 rounded-full">
          <i class="fas fa-bell text-xl"></i>
          <span>Notify Me</span>
        </button>
      </form>
    </div>
  </div>
</div>

<!-- Report Modal -->
<div id="reportModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
  <div class="bg-white rounded-xl p-6 max-w-lg w-full mx-4">
    <div class="flex justify-between items-center mb-4">
      <h3 class="text-xl font-bold">Report Stage</h3>
      <button id="closeReportModal" class="text-gray-500 hover:text-gray-700">
        <i class="fas fa-times"></i>
      </button>
    </div>
    <form action="<?= url('reports/store') ?>" method="POST">
      <div class="mb-4">
        <label for="reportReason" class="block text-sm font-medium text-gray-700 mb-1">Reason</label>
        <textarea id="reportReason" name="message" rows="4" 
          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500"
          placeholder="Please explain why you're reporting this stage..."></textarea>
        <input type="hidden" name="stage_id" value="<?= $stage->getId() ?>">
      </div>
      <div class="flex justify-end">
        <button type="submit" class="bg-emerald-600 text-white px-4 py-2 rounded-md hover:bg-emerald-700 transition">
          Submit Report
        </button>
      </div>
    </form>
  </div>
</div>

<!-- Comments Section -->
<div class="max-w-7xl mx-auto px-4 py-8">
  <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
    <div class="px-8 py-6 border-b border-gray-200">
      <h2 class="text-2xl font-bold text-gray-800 flex items-center">
        <i class="fas fa-comments mr-3 text-emerald-500"></i>Comments
      </h2>
    </div>
    
    <!-- Add Comment Form -->
    <div class="p-6 border-b border-gray-200">
      <form action="<?= url('comments/store') ?>" method="POST">
        <div class="flex items-start space-x-4">
          <img src="<?= user()->getPhoto() ?>" alt="Your Avatar" class="w-10 h-10 rounded-full">
          <div class="flex-grow">
            <input type="hidden" name="stage_id" value="<?= $stage->getId() ?>">
            <textarea id="commentText" name="comment"
              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500"
              placeholder="Write a comment..." rows="3"></textarea>
            <div class="mt-2 flex justify-end">
              <button type="submit" class="bg-emerald-600 text-white px-4 py-2 rounded-md hover:bg-emerald-700 transition">
                Post Comment
              </button>
            </div>
          </div>
        </div>
      </form>
    </div>
    
    <!-- Comments List -->
    <div class="divide-y divide-gray-200" id="commentsList">
      
      <?php foreach($comments as $comment): ?>
        <div class="p-6">
          <div class="flex items-start space-x-4">
            <img src="<?= $comment->getAuthor()->getPhoto() ?>" alt="User Avatar" class="w-10 h-10 rounded-full">
            <div class="flex-grow">
              <div class="flex items-center space-x-2">
                <h4 class="font-semibold"><?= $comment->getAuthor()->getFullName() ?></h4>
                <span class="text-sm text-gray-500"><?= getTimeAgoFromDate($comment->getCreatedAt()) ?></span>
              </div>
              <p class="mt-1 text-gray-700"><?= $comment->getContent() ?></p>
              <div class="mt-2 flex items-center space-x-4 text-sm">
                <button class="text-gray-500 hover:text-emerald-500 transition">Reply</button>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
      
    </div>
  </div>
</div>

<!-- Enhanced Results Table -->
<div class="max-w-7xl mx-auto px-4 py-8">
  <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
    <div class="px-8 py-6 border-b border-gray-200">
      <h2 class="text-2xl font-bold text-gray-800 flex items-center">
        <i class="fas fa-medal mr-3 text-amber-400"></i>Stage Results
      </h2>
    </div>

    <div class="overflow-x-auto">
      <table class="w-full">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-4 text-left text-sm font-medium text-gray-700 w-20">Rank</th>
            <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">Player</th>
            <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">Team</th>
            <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">Time</th>
            <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">Points</th>
            <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">Trend</th>
          </tr>
        </thead>
        <tbody id="ranking-body" class="divide-y divide-gray-200">
          <!-- Results populated by JavaScript -->
        </tbody>
      </table>
    </div>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    // Rankings Data
    const rankings = [{
        rank: 1,
        name: "John Doe",
        team: "Morocco",
        time: "2h15m30s",
        points: 50,
        nationality: "ma",
        trend: "up"
      },
      {
        rank: 2,
        name: "Alice Smith",
        team: "France",
        time: "+0m15s",
        points: 40,
        nationality: "fr",
        trend: "down"
      },
      {
        rank: 3,
        name: "Carlos Rodriguez",
        team: "USA",
        time: "+0m32s",
        points: 30,
        nationality: "us",
        trend: "up"
      },
      {
        rank: 4,
        name: "Emma Wilson",
        team: "Morocco",
        time: "+0m45s",
        points: 20,
        nationality: "ma",
        trend: "neutral"
      },
      {
        rank: 5,
        name: "Liam Brown",
        team: "Canada",
        time: "+1m00s",
        points: 10,
        nationality: "ca",
        trend: "down"
      }
    ];

    // Populate Rankings Table
    const rankingBody = document.getElementById("ranking-body");
    rankings.forEach(player => {
      const row = document.createElement("tr");
      row.className = "hover:bg-gray-50 transition-colors";

      let trendIcon = "";
      switch (player.trend) {
        case "up":
          trendIcon = `<i class="fas fa-arrow-up text-emerald-500"></i>`;
          break;
        case "down":
          trendIcon = `<i class="fas fa-arrow-down text-red-500"></i>`;
          break;
        default:
          trendIcon = `<i class="fas fa-minus text-gray-400"></i>`;
      }

      row.innerHTML = `
        <td class="px-6 py-4 font-medium">
          ${player.rank <= 3 ? `<span class="medal-${player.rank}">${player.rank}</span>` : player.rank}
        </td>
        <td class="px-6 py-4 flex items-center">
          <img src="https://img.aso.fr/core_app/img-cycling-tdf-png/1/56074/0:0,400:400-300-0-70/8b05c" alt="${player.name}" class="w-12 h-12 rounded-full mr-3">
          ${player.name}
        </td>
        <td class="px-6 py-4">
          <span class="flex items-center gap-2">
            <img src="https://flagcdn.com/w320/${player.nationality}.png" class="w-6 h-4 rounded-sm"/>
            ${player.team}
          </span>
        </td>
        <td class="px-6 py-4">${player.time}</td>
        <td class="px-6 py-4 font-medium">${player.points}</td>
        <td class="px-6 py-4 text-xl">${trendIcon}</td>
      `;
      rankingBody.appendChild(row);
    });
    
    // Report Modal Functionality
    const reportButton = document.getElementById('reportButton');
    const reportModal = document.getElementById('reportModal');
    const closeReportModal = document.getElementById('closeReportModal');
    
    reportButton.addEventListener('click', function() {
      reportModal.classList.remove('hidden');
      reportModal.classList.add('flex');
    });
    
    closeReportModal.addEventListener('click', function() {
      reportModal.classList.remove('flex');
      reportModal.classList.add('hidden');
    });
  });
</script>

<style>
  .animate-pulse-slow {
    animation: pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite;
  }

  @keyframes pulse {
    0%, 100% {
      opacity: 1;
    }
    50% {
      opacity: 0.5;
    }
  }

  .medal-1::after {
    content: "🥇";
  }

  .medal-2::after {
    content: "🥈";
  }

  .medal-3::after {
    content: "🥉";
  }

  .team-flag::before {
    content: "";
    display: inline-block;
    width: 20px;
    height: 15px;
    background-size: cover;
    margin-right: 8px;
    border-radius: 2px;
  }

  .team-flag.morocco::before {
    background-image: url('https://flagcdn.com/ma.svg');
  }

  .team-flag.france::before {
    background-image: url('https://flagcdn.com/fr.svg');
  }

  .team-flag.usa::before {
    background-image: url('https://flagcdn.com/us.svg');
  }

  .team-flag.saudi-arabia::before {
    background-image: url('https://flagcdn.com/sa.svg');
  }
</style>