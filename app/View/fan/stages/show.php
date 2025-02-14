<div class="pt-20 max-w-7xl mx-auto px-4 py-10">
  <div class="bg-white rounded-2xl shadow-xl p-8">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
      <div>
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Stage 1: Casablanca → Rabat</h1>
        <p class="text-xl text-gray-600">May 1, 2025 -> May 15, 2025</p>
      </div>


      <div class="mt-4 md:mt-0 inline-flex items-center gap-2">
        <button id="likeButton" class="inline-flex items-center gap-1 text-gray-500 hover:text-red-500 transition-colors duration-200">
          <i id="heartIcon" class="far fa-heart text-lg"></i>
          <span id="likeCount" class="text-base">64</span>
        </button>
        <div class="bg-emerald-50 text-emerald-700 px-4 py-2 rounded-full inline-flex items-center gap-2">
          <i class="fas fa-flag-checkered"></i>
          <span class="font-medium">Stage Complete</span>
        </div>
      </div>


        
      <div> 
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Stage 1:   <?php echo $detail->getStLocation() ; ?> →  <?php echo $detail->getEnLocation() ; ?></h1>
        <p class="text-xl text-gray-600"><?php
                                          $date = (new DateTime( $detail->getStDate()))->format("F j, Y");
                                         echo $date ; ?>  → 
                                         
                                         <?php

                                            $date = (new DateTime( $detail->getEnDate()))->format("F j, Y");
                                            echo $date ; ?>
                                          </p>
      </div>


        <?php
        

        if (( $detail->getStLocation()) >= (date("Y-m-d"))  ) {
       

           echo '
        <div class="mt-4 md:mt-0 flex items-center bg-emerald-100 text-emerald-700 px-4 py-2 rounded-full">
           <i class="fas fa-flag-checkered mr-2"></i>
           <span class="font-semibold">Stage Complete1</span>
        </div>';
        }elseif (( $detail->getEnDate()) <= (date("Y-m-d"))) {
          echo '
          <div class="mt-4 md:mt-0 flex items-center bg-emerald-100 text-emerald-700 px-4 py-2 rounded-full">
             <i class="fas fa-flag-checkered mr-2"></i>
             <span class="font-semibold">Stage Complete2</span>
          </div>';
        }else {
          echo '
          <div class="mt-4 md:mt-0 flex items-center bg-emerald-100 text-emerald-700 px-4 py-2 rounded-full">
             <i class="fas fa-flag-checkered mr-2"></i>
             <span class="font-semibold">Stage Complete"</span>
          </div>';
        }

        ?>
        
 
      
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
      <div class="bg-gray-100 p-4 rounded-lg">
        <h3 class="text-lg font-semibold mb-2">Distance</h3>
        <p class="text-2xl font-bold text-emerald-600"><?php 
        echo $detail->getDistance() ; ?> km</p>
      </div>
      <div class="bg-gray-100 p-4 rounded-lg">
        <h3 class="text-lg font-semibold mb-2">Type</h3>
        <p class="text-2xl font-bold text-emerald-600"><?php echo $detail->getNameRegion() ; ?></p>
      </div>
      <div class="bg-gray-100 p-4 rounded-lg">
        <h3 class="text-lg font-semibold mb-2">Reached Players</h3>
        <p class="text-2xl font-bold text-emerald-600">11</p>
      </div>
    </div>
    <div class="mb-8">
      <h2 class="text-2xl font-bold text-gray-800 mb-4">Stage Description</h2>
      <p class="text-gray-600 leading-relaxed">
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
  });


  document.addEventListener('DOMContentLoaded', function() {
    const likeButton = document.getElementById('likeButton');
    const heartIcon = document.getElementById('heartIcon');
    const likeCount = document.getElementById('likeCount');
    let isLiked = false;
    let likes = 64;

    likeButton.addEventListener('click', function() {
      if (isLiked) {
        likes--;
        heartIcon.classList.remove('fas', 'text-red-500');
        heartIcon.classList.add('far');
        likeButton.classList.remove('text-red-500');
        likeButton.classList.add('text-gray-500');
      } else {
        likes++;
        heartIcon.classList.remove('far');
        heartIcon.classList.add('fas', 'text-red-500');
        likeButton.classList.remove('text-gray-500');
        likeButton.classList.add('text-red-500');
      }
      isLiked = !isLiked;
      likeCount.textContent = likes;
    });
  });
</script>

<style>
  .animate-pulse-slow {
    animation: pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite;
  }

  @keyframes pulse {

    0%,
    100% {
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