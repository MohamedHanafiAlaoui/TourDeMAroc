<main class="max-w-7xl mx-auto px-4 pt-28 pb-20">
  <!-- Enhanced Profile Section -->
  <section class="bg-white rounded-2xl shadow-xl p-8 mb-12 transition-all duration-300 hover:shadow-2xl">
    <div class="flex flex-col md:flex-row items-center gap-8">
      <!-- Profile Image with Hover Effect -->
      <div class="relative group flex-shrink-0">
        <div class="absolute inset-0 bg-emerald-500/10 rounded-full blur-lg animate-pulse"></div>
        <img src="<?= $cyclist->getPhoto() ?>" 
             alt="Cyclist Profile" 
             class="w-48 h-48 rounded-full border-4 border-emerald-500/30 shadow-xl transform transition-transform duration-300 hover:scale-105">
      </div>
      
      <!-- Profile Info with Icon Grid -->
      <div class="space-y-4">
        <h1 class="text-4xl font-bold bg-gradient-to-r from-emerald-600 to-cyan-600 bg-clip-text text-transparent">
          John Doe
        </h1>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div class="flex items-center space-x-3 bg-gray-50 px-4 py-3 rounded-lg">
            <div class="p-2 bg-emerald-500/10 rounded-lg">
              <i class="fas fa-users text-emerald-600"></i>
            </div>
            <div>
              <p class="text-sm text-gray-500">Team</p>
              <p class="font-medium text-gray-800"><?= $cyclist->getTeam() ?></p>
            </div>
          </div>
          <div class="flex items-center space-x-3 bg-gray-50 px-4 py-3 rounded-lg">
            <div class="p-2 bg-emerald-500/10 rounded-lg">
              <i class="fas fa-flag text-emerald-600"></i>
            </div>
            <div>
              <p class="text-sm text-gray-500">Nationality</p>
              <p class="font-medium text-gray-800"><?= $cyclist->getNationality() ?></p>
            </div>
          </div>
          <div class="flex items-center space-x-3 bg-gray-50 px-4 py-3 rounded-lg">
            <div class="p-2 bg-emerald-500/10 rounded-lg">
              <i class="fas fa-birthday-cake text-emerald-600"></i>
            </div>
            <div>
              <p class="text-sm text-gray-500">Birthday</p>
              <p class="font-medium text-gray-800"><?= $cyclist->getBirthDate() ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- Experiences Section -->
  <div class="mt-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Racing Experience</h2>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php if (!empty($experiences)): ?>
        <?php foreach ($experiences as $experience): ?>
          <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <img src="<?= $experience->getPhoto() ?>" 
                  alt="<?= htmlspecialchars($experience->getTour()) ?>" 
                  class="w-full h-48 object-cover">
            
            <div class="p-4">
              <h3 class="font-semibold text-lg mb-2"><?= htmlspecialchars($experience->getTour()) ?></h3>
              
              <div class="flex items-center space-x-2 text-sm text-gray-600 mb-2">
                <i class="fas fa-calendar"></i>
                <span><?= htmlspecialchars($experience->getStartDate()) ?> - <?= htmlspecialchars($experience->getEndDate()) ?></span>
              </div>
              
              <div class="flex items-center space-x-2 text-sm text-gray-600 mb-3">
                <i class="fas fa-trophy text-yellow-500"></i>
                <span>Rank: <?= htmlspecialchars($experience->getRank()) ?></span>
              </div>
              
              <p class="text-gray-600 text-sm">
                <?= htmlspecialchars($experience->getDescription()) ?>
              </p>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-span-full text-center py-8 bg-gray-50 rounded-lg">
          <p class="text-gray-500">No racing experience available.</p>
        </div>
      <?php endif; ?>
    </div>
  </div>
</main>