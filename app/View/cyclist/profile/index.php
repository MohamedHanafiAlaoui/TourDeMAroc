<main class="max-w-7xl mx-auto px-4 py-20">
  <!-- Enhanced Profile Section -->
  <section class="bg-white shadow-xl rounded-2xl p-8 mb-12 transition-all duration-300 hover:shadow-2xl">
    <div class="flex flex-col md:flex-row items-center space-y-8 md:space-y-0">
      <!-- Profile Image with Enhanced Styling -->
      <div class="relative group">
        <div class="absolute inset-0 bg-emerald-500/10 rounded-full blur-lg animate-pulse"></div>
        <img id="profileImagePreview" src="https://img.aso.fr/core_app/img-cycling-tdf-png/1/56074/0:0,400:400-300-0-70/8b05c" alt="Profile Image" 
             class="w-48 h-48 rounded-full border-4 border-emerald-500/30 object-cover transform transition-transform duration-300 hover:scale-105">
        <label for="profileImage" class="absolute bottom-3 right-3 bg-emerald-500 p-3 rounded-full cursor-pointer hover:bg-emerald-600 shadow-lg">
          <i class="fas fa-camera text-white text-lg"></i>
        </label>
        <input type="file" id="profileImage" name="profileImage" accept="image/*" class="hidden">
      </div>

      <!-- Profile Details with Improved Typography -->
      <div class="md:ml-12 space-y-2">
        <h1 class="text-4xl font-bold bg-gradient-to-r from-emerald-600 to-cyan-600 bg-clip-text text-transparent">
          <?= $cyclist->getFullName() ?>
        </h1>
        <div>
          <div class="grid grid-cols-2 gap-x-8 gap-y-2 mt-4">
            <div class="flex items-center">
              <i class="fas fa-users text-emerald-500 w-6"></i>
              <span class="ml-2 text-gray-600"><span class="font-medium text-gray-800">Team:</span> <?= $cyclist->getTeam() ?></span>
            </div>
            <div class="flex items-center">
              <i class="fas fa-flag text-emerald-500 w-6"></i>
              <span class="ml-2 text-gray-600"><span class="font-medium text-gray-800">Nationality:</span> <?= $cyclist->getNationality() ?></span>
            </div>
            <div class="flex items-center">
              <i class="fas fa-birthday-cake text-emerald-500 w-6"></i>    
              <span class="ml-2 text-gray-600"><span class="font-medium text-gray-800">Birthday:</span> <?= $cyclist->getBirthdate() ? $date = (new DateTime( $cyclist->getBirthdate()))->format("F j, Y") : '----- --, ----'; ?></span>
            </div>
            <div class="flex items-center">
              <i class="fas fa-envelope text-emerald-500 w-6"></i>
              <span class="ml-2 text-gray-600"><span class="font-medium text-gray-800">Email:</span> <?= $cyclist->getEmail() ?></span>
            </div>
            <div class="flex items-center">
              <i class="fas fa-phone text-emerald-500 w-6"></i>
              <span class="ml-2 text-gray-600"><span class="font-medium text-gray-800">Phone:</span> +212 600000000</span>
            </div>
          </div>
          <!-- Cool Logout Button -->
          <form action="<?= url('logout') ?>" method="POST" class="mt-4">
            <button class="flex items-center justify-center bg-emerald-500 text-white px-4 py-1.5 rounded-lg shadow-lg hover:bg-emerald-600 transition duration-300">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                <polyline points="16 17 21 12 16 7" />
                <line x1="21" y1="12" x2="9" y2="12" />
              </svg>
              Logout
            </button>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- Enhanced Experiences Section -->
  <section class="bg-white shadow-xl rounded-2xl p-8 transition-all duration-300 hover:shadow-2xl">
    <div class="flex flex-col md:flex-row justify-between items-center mb-8">
      <h2 class="text-3xl font-bold text-gray-800 mb-4 md:mb-0">
        <i class="fas fa-trophy mr-3 text-emerald-500"></i>My Experiences
      </h2>
      <button id="openExperienceModal" class="px-6 py-3 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl transition-all 
        duration-300 transform hover:scale-105 shadow-lg hover:shadow-emerald-200 flex items-center">
        <i class="fas fa-plus mr-3"></i>Add Experience
      </button>
    </div>

    <!-- Enhanced Experiences List -->
    <div id="experiencesList" class="space-y-4">
      <!-- Example Experience Card -->
      <div class="experience-card group bg-gray-50 hover:bg-white rounded-xl p-6 shadow-md flex justify-between items-center 
        transition-all duration-300 border-l-4 border-emerald-500 hover:border-emerald-600">
        <div class="space-y-2">
          <h3 class="text-xl font-bold text-gray-800 flex items-center">
            <i class="fas fa-flag-checkered text-emerald-500 mr-2"></i>Tour de Maroc 2025
          </h3>
          <p class="text-gray-600"><i class="fas fa-calendar-day mr-2 text-emerald-500"></i>May 1 - May 15, 2025</p>
          <p class="text-gray-600"><i class="fas fa-medal mr-2 text-emerald-500"></i>1st Place</p>
        </div>
        <button class="removeExperienceBtn text-gray-400 hover:text-emerald-600 transition-colors duration-300">
          <i class="fas fa-trash-alt text-lg"></i>
        </button>
      </div>
    </div>
  </section>

  <!-- Enhanced Experience Modal -->
  <div id="experienceModal" class="fixed inset-0 flex items-center justify-center bg-black/30 backdrop-blur-sm z-50 
    transition-opacity duration-300">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-xl p-8 relative transform transition-transform duration-300 
      scale-95 opacity-0" id="modalContent">
      <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
        <i class="fas fa-plus-circle mr-3 text-emerald-500"></i>Add New Experience
      </h3>
      <form id="modalExperienceForm" class="space-y-3">
        <!-- Input Group with Icon -->
        <div class="relative">
          <label class="block text-sm font-medium text-gray-700 mb-2">Race Name</label>
          <div class="relative">
            <i class="fas fa-flag-checkered absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
            <input type="text" name="raceName" placeholder="Tour de Maroc 2025" 
                   class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-200 focus:border-emerald-500 focus:ring-2 
                   ring-emerald-200 transition-all duration-300 placeholder-gray-400">
          </div>
        </div>

        <!-- Date Input with Icon -->
        <div class="relative">
          <label class="block text-sm font-medium text-gray-700 mb-2">Date Range</label>
          <div class="relative">
            <i class="fas fa-calendar-alt absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
            <input type="text" name="raceDate" placeholder="May 1 - May 15, 2025" 
                   class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-200 focus:border-emerald-500 focus:ring-2 
                   ring-emerald-200 transition-all duration-300 placeholder-gray-400">
          </div>
        </div>

        <!-- Rank Input with Icon -->
        <div class="relative">
          <label class="block text-sm font-medium text-gray-700 mb-2">Rank Achieved</label>
          <div class="relative">
            <i class="fas fa-medal absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
            <input type="text" name="raceRank" placeholder="1st Place" 
                   class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-200 focus:border-emerald-500 focus:ring-2 
                   ring-emerald-200 transition-all duration-300 placeholder-gray-400">
          </div>
        </div>

        <!-- Additional Info Textarea -->
        <div class="relative">
          <label class="block text-sm font-medium text-gray-700 mb-2">Additional Information</label>
          <div class="relative">
            <i class="fas fa-info-circle absolute left-3 top-4 text-gray-400"></i>
            <textarea name="raceInfo" placeholder="Describe your experience..." rows="3"
                     class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-200 focus:border-emerald-500 focus:ring-2 
                     ring-emerald-200 transition-all duration-300 placeholder-gray-400"></textarea>
          </div>
        </div>

        <!-- Form Actions -->
        <div class="flex justify-end space-x-4 mt-8">
          <button type="button" id="closeExperienceModal" 
                  class="px-6 py-2.5 text-gray-600 hover:text-gray-800 bg-gray-100 hover:bg-gray-200 rounded-lg transition-all 
                  duration-300">Cancel</button>
          <button type="submit" 
                  class="px-6 py-2.5 bg-emerald-500 hover:bg-emerald-600 text-white rounded-lg transition-all duration-300 
                  transform hover:scale-[1.02]">Save Experience</button>
        </div>
      </form>
      <button id="modalCloseButton" 
              class="absolute top-5 right-5 text-gray-400 hover:text-gray-600 transition-colors duration-300">
        <i class="fas fa-times text-xl"></i>
      </button>
    </div>
  </div>

  <!-- Updated Script with Animation -->
  <script>
    // Modal Animation Logic
    const experienceModal = document.getElementById('experienceModal');
    const modalContent = document.getElementById('modalContent');
    experienceModal.classList.add('hidden');

    document.getElementById('openExperienceModal').addEventListener('click', () => {
      experienceModal.classList.remove('hidden');
      setTimeout(() => {
        modalContent.classList.remove('scale-95', 'opacity-0');
        modalContent.classList.add('scale-100', 'opacity-100');
      }, 10);
    });

    function closeModal() {
      modalContent.classList.remove('scale-100', 'opacity-100');
      modalContent.classList.add('scale-95', 'opacity-0');
      experienceModal.classList.add('hidden');
      document.getElementById('modalExperienceForm').reset();
    }

    // Event Listeners for Closing
    document.getElementById('closeExperienceModal').addEventListener('click', closeModal);
    document.getElementById('modalCloseButton').addEventListener('click', closeModal);

    // Form Submission with Animation
    document.getElementById('modalExperienceForm').addEventListener('submit', (e) => {
      e.preventDefault();
      const formData = new FormData(e.target);
      const experience = Object.fromEntries(formData);
      
      const newCard = document.createElement('div');
      newCard.className = 'experience-card group bg-gray-50 hover:bg-white rounded-xl p-6 shadow-md flex justify-between items-center transition-all duration-300 border-l-4 border-emerald-500 hover:border-emerald-600';
      newCard.innerHTML = `
        <div class="space-y-2">
          <h3 class="text-xl font-bold text-gray-800 flex items-center">
            <i class="fas fa-flag-checkered text-emerald-500 mr-2"></i>${experience.raceName}
          </h3>
          <p class="text-gray-600"><i class="fas fa-calendar-day mr-2 text-emerald-500"></i>${experience.raceDate}</p>
          <p class="text-gray-600"><i class="fas fa-medal mr-2 text-emerald-500"></i>${experience.raceRank}</p>
          ${experience.raceInfo ? `<p class="text-gray-600"><i class="fas fa-info-circle mr-2 text-emerald-500"></i>${experience.raceInfo}</p>` : ''}
        </div>
        <button class="removeExperienceBtn text-gray-400 hover:text-emerald-600 transition-colors duration-300">
          <i class="fas fa-trash-alt text-lg"></i>
        </button>
      `;
      
      // Add animation when inserting new card
      newCard.style.opacity = '0';
      newCard.style.transform = 'translateY(20px)';
      document.getElementById('experiencesList').prepend(newCard);
      setTimeout(() => {
        newCard.style.opacity = '1';
        newCard.style.transform = 'translateY(0)';
      }, 50);
      
      closeModal();
    });

    // Smooth removal animation
    document.getElementById('experiencesList').addEventListener('click', (e) => {
      if (e.target.closest('.removeExperienceBtn')) {
        const card = e.target.closest('.experience-card');
        card.style.transform = 'translateX(100%)';
        card.style.opacity = '0';
        setTimeout(() => card.remove(), 300);
      }
    });
  </script>
</main>
