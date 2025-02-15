<main class="max-w-7xl mx-auto px-4 pb-20 pt-28">
  <!-- Enhanced Title Section -->
  <div class="text-center mb-24">
    <h1 class="text-5xl font-bold bg-gradient-to-r from-emerald-600 to-cyan-600 bg-clip-text text-transparent mb-4">
      Podium Rankings
    </h1>
    <p class="text-gray-500 text-lg">Season 2025 Professional Cycling Standings</p>
  </div>

  <!-- Enhanced Podium Section -->
  <div class="flex flex-col md:flex-row justify-center items-end space-y-8 md:space-y-0 md:space-x-8 mb-16">
    <?php
    // Ensure there are at least 3 cyclists
    $TopCyclists = array_pad($Cyclists, 3, new Cyclist());

    // Assign each cyclist their correct place
    $firstPlace = $TopCyclists[0];
    $secondPlace = $TopCyclists[1];
    $thirdPlace = $TopCyclists[2];
    ?>
    <!-- 2nd Place -->
    <div class="flex flex-col items-center order-2 md:order-1 transform hover:scale-105 transition-transform duration-300">
      <div class="relative bg-gradient-to-b from-gray-200 to-white rounded-t-2xl shadow-xl w-32 h-48 flex flex-col justify-end">
        <div class="absolute -top-14 left-1/2 transform -translate-x-1/2">
          <div class="relative w-28 h-28">
            <img src="<?=  $secondPlace->getPhoto() ?>" alt="<?= $secondPlace->getFirstName() ?>"
              class="rounded-full border-4 border-silver shadow-lg w-28 h-28">
          </div>
        </div>
        <div class="text-center font-bold text-gray-800 py-3 bg-silver/20">
          <span class="text-2xl">🥈</span> 2nd
        </div>
      </div>
      <div class="mt-4 text-center">
        <h3 class="text-xl font-bold text-gray-800"><?= $secondPlace->getFullName(); ?></h3>
        <div class="flex items-center justify-center mt-1 space-x-2">
          <span class="text-sm text-gray-600">🏆 <?= $secondPlace->getPointsAwarded() ?> points</span>
        </div>
      </div>
    </div>

    <!-- 1st Place -->
    <div class="flex flex-col items-center order-1 md:order-2 transform hover:scale-110 transition-transform duration-300">
      <div class="relative bg-gradient-to-b from-amber-200 to-white rounded-t-2xl shadow-2xl w-40 h-64 flex flex-col justify-end">
        <div class="absolute -top-20 left-1/2 transform -translate-x-1/2">
          <div class="relative w-32 h-32">
            <img src="<?= $firstPlace->getPhoto() ?>" alt="<?= $firstPlace->getFirstName() ?>"
              class="rounded-full border-4 border-gold shadow-xl w-32 h-32">
          </div>
        </div>
        <div class="text-center font-bold text-gray-800 py-4 bg-amber-100">
          <span class="text-3xl">🥇</span> 1st
        </div>
      </div>
      <div class="mt-6 text-center">
        <h3 class="text-2xl font-bold text-gray-800"><?= $firstPlace->getFirstName() . " " . $firstPlace->getLastName() ?></h3>
        <div class="flex items-center justify-center mt-2 space-x-2">
          <span class="text-sm text-gray-600">🏆 <?=  $firstPlace->getPointsAwarded() ?> points</span>
        </div>
      </div>
    </div>

    <!-- 3rd Place -->
    <div class="flex flex-col items-center order-3 transform hover:scale-105 transition-transform duration-300">
      <div class="relative bg-gradient-to-b from-bronze-200 to-white rounded-t-2xl shadow-xl w-32 h-40 flex flex-col justify-end">
        <div class="absolute -top-12 left-1/2 transform -translate-x-1/2">
          <div class="relative w-28 h-28">
            <img src="<?= $thirdPlace->getPhoto() ?>" alt="<?= $thirdPlace->getFirstName() ?>"
              class="rounded-full border-4 border-bronze shadow-lg w-28 h-28">
          </div>
        </div>
        <div class="text-center font-bold text-gray-800 py-3 bg-bronze/20">
          <span class="text-2xl">🥉</span> 3rd
        </div>
      </div>
      <div class="mt-4 text-center">
        <h3 class="text-xl font-bold text-gray-800"><?= $thirdPlace->getFirstName() . " " . $thirdPlace->getLastName() ?></h3>
        <div class="flex items-center justify-center mt-1 space-x-2">
          <span class="text-sm text-gray-600">🏆 <?= $thirdPlace->getPointsAwarded() ?> points</span>
        </div>
      </div>
    </div>
  </div>

  <!-- Enhanced Rankings Table -->
  <section class="bg-white shadow-xl rounded-2xl p-6">
    <div class="flex flex-col md:flex-row justify-between items-center mb-6">
      <h2 class="text-2xl font-bold text-gray-800 flex items-center">
        <i class="fas fa-list-ol text-emerald-500 mr-3"></i>Full Standings
      </h2>
      <div class="mt-4 md:mt-0 flex space-x-4">
        <button class="px-4 py-2 bg-emerald-500 hover:bg-emerald-600 text-white rounded-lg transition-all">
          <i class="fas fa-download mr-2"></i>Export
        </button>
      </div>
    </div>

    <div class="overflow-x-auto rounded-lg border border-gray-100">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-4 text-left text-sm font-medium text-gray-700 w-20">Rank</th>
            <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">Cyclist</th>
            <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">Time</th>
            <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">Points</th>
            <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">Team</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 bg-white">
          <?php $index=1; foreach ($Cyclists as $cyclist): ?>
            <tr class="hover:bg-gray-50 transition-colors">
              <td class="px-6 py-4 whitespace-nowrap font-medium"><?= $index ?></td>
              <td class="px-6 py-4 whitespace-nowrap flex items-center">
                <img src="<?= $cyclist->getPhoto() ?>" alt="<?= $cyclist->getFirstName() ?>" class="w-12 h-12 rounded-full mr-3">
                <?= $cyclist->getFullName()?>
              </td>
              <td class="px-6 py-4 whitespace-nowrap"><?= $cyclist->getTotalTime() ?></td>
              <td class="px-6 py-4 whitespace-nowrap font-medium"><?= $cyclist->getPointsAwarded() ?></td>
              <td class="px-6 py-4 whitespace-nowrap text-emerald-500"><?= $cyclist->getTeam() ?></td>
            </tr>
          <?php $index++; endforeach; ?>
        </tbody>

      </table>
    </div>
  </section>
</main>

<style>
  .gold-gradient {
    background: linear-gradient(45deg, #FFD700, #FFEC8B);
  }

  .silver-gradient {
    background: linear-gradient(45deg, #C0C0C0, #E5E4E2);
  }

  .bronze-gradient {
    background: linear-gradient(45deg, #CD7F32, #E6B17E);
  }

  .border-gold {
    border-color: #FFD700;
  }

  .border-silver {
    border-color: #C0C0C0;
  }

  .border-bronze {
    border-color: #CD7F32;
  }

  .bg-gold-gradient {
    background: linear-gradient(45deg, rgba(255, 215, 0, 0.2), rgba(255, 236, 139, 0.2));
  }

  .bg-silver-gradient {
    background: linear-gradient(45deg, rgba(192, 192, 192, 0.2), rgba(229, 228, 226, 0.2));
  }

  .bg-bronze-gradient {
    background: linear-gradient(45deg, rgba(205, 127, 50, 0.2), rgba(230, 177, 126, 0.2));
  }
</style>