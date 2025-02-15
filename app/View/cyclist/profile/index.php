<main class="max-w-7xl mx-auto px-4 py-20">
  <!-- Enhanced Profile Section -->
  <section class="bg-white shadow-xl rounded-2xl p-8 mb-12 transition-all duration-300 hover:shadow-2xl">
    <form id="DetailsForm" action="<?= url('profile/update') ?>" method="POST" enctype="multipart/form-data" class="flex flex-col md:flex-row items-center space-y-8 md:space-y-0">
      <!-- Profile Image with Enhanced Styling -->
      <div class="relative group">
        <div class="absolute inset-0 bg-emerald-500/10 rounded-full blur-lg animate-pulse"></div>
        <img id="profileImagePreview" src="<?= user()->getPhoto()?>" alt="Profile Image" 
             class="w-48 h-48 rounded-full border-4 border-emerald-500/30 object-cover transform transition-transform duration-300 hover:scale-105">
        <label for="profileImage" class="absolute bottom-3 right-3 bg-emerald-500 p-3 rounded-full cursor-pointer hover:bg-emerald-600 shadow-lg hidden" >
          <i class="fas fa-camera text-white text-lg"></i>
        </label>
        <input type="file" id="profileImage" name="profileImage" accept="image/*" class="hidden" onclick="previewImage(event)">
      </div>

      <!-- Profile Details with Improved Typography -->
      <div class="md:ml-12 space-y-2 mb-8">
        <h1 class="text-4xl font-bold bg-gradient-to-r from-emerald-600 to-cyan-600 bg-clip-text text-transparent">
          <?= $cyclist->getFullName() ?>
        </h1>
        <div>
          <div class="grid grid-cols-2 gap-x-8 gap-y-2 mt-4">
            <div id="TeamGrid" class="flex items-center">
              <i class="fas fa-users text-emerald-500 w-6"></i>
              <span class="ml-2 font-medium text-gray-800">Team:</span> 
              <label for="teamInput" class="ml-2  text-gray-600 "><?= $cyclist->getTeam() ?></label> 
              <div class="ml-2 grid-cols-2 items-center hidden">
                <input id="teamInput" name="teamInput" type="text" value="<?= $cyclist->getTeam() ?>" placeholder="Team">
                <label for="teamInput" class="text-gray-500 hover:text-green-400 cursor-pointer"><i class="fas fa-edit"></i></label>
              </div>
            </div>

            <div id="NationalityGrid" class="flex items-center">
              <i class="fas fa-flag text-emerald-500 w-6"></i>
              <span class="ml-2 font-medium text-gray-800">Nationality: </span>  
              <label for="NationalityInput" class="ml-2 text-gray-600"> <?= $cyclist->getNationality() ?></label>
              <div class="ml-2 grid-cols-2 items-center hidden">
                <input id="NationalityInput" name="NationalityInput" type="text" value="<?= $cyclist->getNationality() ?>" placeholder="Nationality">
                <label for="NationalityInput" class="text-gray-500 hover:text-green-400 cursor-pointer"><i class="fas fa-edit"></i></label>
              </div>
            </div>

            <div id="BirthdayGrid" class="flex items-center">
              <i class="fas fa-birthday-cake text-emerald-500 w-6"></i>    
              <span class="ml-2 font-medium text-gray-800">Birthday: </span>  
              <label for="BirthdateInput" class="ml-2 text-gray-600"> <?= $cyclist->getBirthdate() ? $date = (new DateTime( $cyclist->getBirthdate()))->format("F j, Y") : '----- --, ----'; ?></label>
              <div class="ml-2 grid-cols-2 items-center hidden">
                <input id="BirthdateInput" name="BirthdateInput" type="date" value="$date = (new DateTime( $cyclist->getBirthdate()))->format('F j, Y') : '00-00-0000'; ?>" placeholder="Birthday">
                <label for="BirthdateInput" class="text-gray-500 hover:text-green-400 cursor-pointer"><i class="ml-4 fas fa-edit"></i></label>
              </div>
            </div>

            <div id="EmailGrid" class="flex items-center">
              <i class="fas fa-envelope text-emerald-500 w-6"></i>
              <span class="ml-2 font-medium text-gray-800">Email: </span>  
              <label for="EmailInput" class="ml-2 text-gray-600"> <?= $cyclist->getEmail() ?></label>
              <div class="ml-2 grid-cols-2 items-center hidden" >
                <input id="EmailInput" name="EmailInput" type="email" class="ml-2 min-w-64" value="<?= $cyclist->getEmail() ?>" placeholder="Email">
                <label for="EmailInput" class="text-gray-500 hover:text-green-400 cursor-pointer"><i class="ml-4 fas fa-edit"></i></label>
              </div>
            </div>

          </div>
          <div class="flex w-full items-end  mt-10 gap-5">
            <button id="modifyButton" type="button" class="flex items-center justify-center bg-emerald-500 text-white px-4 py-1.5 rounded-lg shadow-lg hover:bg-emerald-600 transition duration-300"">
              <i class="mr-2 fas fa-edit"></i>
              Modify
            </button>
            <div id="ComfermeForm" class="grid-cols-2 gap-5 hidden">
              <a href="<?= url('profile') ?>">
                <button id="cancelButton" type="button" class=" items-center justify-center bg-yellow-500 text-white px-4 py-1.5 rounded-lg shadow-lg hover:bg-yleowl-600 transition duration-300">
                  <i class="mr-2 fas fa-x"></i>
                  Cancel
                </button>
              </a>
              <button id="accepteButton" type="button" class=" items-center justify-center bg-blue-500 text-white px-4 py-1.5 rounded-lg shadow-lg hover:bg-blue-600 transition duration-300">
                <i class="mr-2 fas fa-check"></i>
                Accpete
              </button>
            </div>

          </div>
        </div>
      </div>
    </form>
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
      <?php foreach ($experiences as $key => $experience): ?>
        <div class="experience-card group bg-gray-50 hover:bg-white rounded-xl p-6 shadow-md flex justify-between items-center 
          transition-all duration-300 border-l-4 border-emerald-500 hover:border-emerald-600">
          <div class="flex gap-4">
            <img src="<?= $experience->getPhoto() ?>" alt="Experience Image" 
                class="w-48 h-56 rounded-xl border-2 border-emerald-500/30 object-cover transform transition-transform duration-300">
            <div class="space-y-4 max-w-xl py-2">
              <h3 class="text-xl font-bold text-gray-800 flex items-center">
                <i class="fas fa-flag-checkered text-emerald-500 mr-2"></i><?= $experience->getTour() ?>
              </h3>
              <p class="text-gray-600"><i class="fas fa-calendar-day mr-2 text-emerald-500"></i>
                <?php
                  $startDate = (new DateTime($experience->getStartDate()))->format("F j, Y");
                  $endDate = (new DateTime($experience->getEndDate()))->format("F j, Y");
                  echo  "$startDate → $endDate";

                ?></p>
              <p class="text-gray-600"><i class="fas fa-medal mr-2 text-emerald-500"></i><?= $experience->getRank() . ' Place' ?></p>
              <p class="text-gray-600"> <?= $experience->getDescription() ?></p>
            </div>
          </div>
          <a href="<?= url("profile/delete/" . $experience->getId()) ?>" class="self-start">
            <button class="removeExperienceBtn text-gray-400 hover:text-emerald-600 transition-colors duration-300">
              <i class="fas fa-trash-alt text-xl"></i>
            </button>
          </a>
        </div>
      <?php endforeach; ?>
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
      <form id="modalExperienceForm" action="<?= url('profile/experience') ?>" method="POST" enctype="multipart/form-data" class="space-y-3">
        <div class="relative group">
          <div class="absolute inset-0 bg-emerald-500/10 rounded-full blur-lg animate-pulse"></div>
          <label for="historyImage" class="absolute text-white bottom-3 right-3 bg-emerald-500 p-3 rounded-full cursor-pointer hover:bg-emerald-600 shadow-lg" >
            <i class="fas fa-camera text-lg"></i> Add Photo
          </label>
          <input type="file" id="historyImage" name="exeriencepImage" accept="image/*" class="hidden">
        </div>
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
        <div class="relative ">
          <label class="block text-sm font-medium text-gray-700 mb-2">Date Range</label>
          <div class="w-full flex gap-2">
            <div class="relative">
              <i class="fas fa-calendar-alt absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
              <input type="date" name="raceStartDate"
                    class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-200 focus:border-emerald-500 focus:ring-2 
                    ring-emerald-200 transition-all duration-300 placeholder-gray-400">
            </div>
            <div class="relative">
              <i class="fas fa-calendar-alt absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
              <input type="date" name="raceEndDate"
                    class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-200 focus:border-emerald-500 focus:ring-2 
                    ring-emerald-200 transition-all duration-300 placeholder-gray-400">
            </div>
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
          <button id="accpeteButton" type="submit" 
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
      

    // Smooth removal animation
    document.getElementById('experiencesList').addEventListener('click', (e) => {
      if (e.target.closest('.removeExperienceBtn')) {
        const card = e.target.closest('.experience-card');
        card.style.transform = 'translateX(100%)';
        card.style.opacity = '0';
        setTimeout(() => card.remove(), 300);
      }
    });

    //button d'acceptation des information
    AccepteInformation = document.querySelector("#ComfermeForm #accepteButton");

    function previewImage(event) {
        const file = event.target.files[0]; 
        const reader = new FileReader();  
        
        reader.onload = function(e) {  
            const imgPreview = document.getElementById('profileImagePreview');  
            imgPreview.src = e.target.result;  
        };

        if (file) {
            reader.readAsDataURL(file);  
        }
    }

    document.querySelector('label[for="profileImage"]').addEventListener('click', (event) => {previewImage(event)});

    function InputToggel(){
      document.querySelector('label[for="profileImage"]').classList.toggle('hidden');
      document.querySelector('#TeamGrid > div').classList.toggle('hidden');
      document.querySelector('#NationalityGrid > div').classList.toggle('hidden');
      document.querySelector('#BirthdayGrid > div').classList.toggle('hidden');
      document.querySelector('#EmailGrid > div').classList.toggle('hidden');
      document.querySelector('#TeamGrid > label[for="teamInput"]').classList.toggle('hidden');
      document.querySelector('#NationalityGrid > label[for="NationalityInput"]').classList.toggle('hidden');
      document.querySelector('#BirthdayGrid > label[for="BirthdateInput"]').classList.toggle('hidden');
      document.querySelector('#EmailGrid > label[for="EmailInput"]').classList.toggle('hidden');
      ComfermeForm.classList.toggle('hidden');
      modifyButton.classList.toggle('hidden');
    }

    modifyButton.addEventListener('click',() => InputToggel());
    cancelButton.addEventListener('click',() => InputToggel());


    // const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    // const dateRegex = /^\d{4}-\d{2}-\d{2}$/;
    // const nameRegex = /^[A-Za-zÀ-ÿ\s'-]+$/;

    // let birthdate = new Date(BirthdateInput.value);
    // const today = new Date();
    // let age = today.getFullYear() - birthdate.getFullYear();
    // console.log();
    

    // function ValidationRegex() 
    // {
    //   let validation = false;
    //   // if (!emailRegex.test(EmailInput.value)) {
    //   //   EmailInput.classList.add('border-red-200','border-2');
    //   //   validation = false;
    //   // } else {
    //   //   EmailInput.classList.remove('border-red-200','border-2');
    //   //   validation = true;
    //   // }

    //   // if (!nameRegex.test(NationalityInput.value)) {
    //   //   NationalityInput.classList.add('border-red-200','border-2');
    //   //   validation = false;
    //   // } else {
    //   //   NationalityInput.classList.remove('border-red-200','border-2');
    //   //   validation = true;
    //   // }

    //   // if (!nameRegex.test(teamInput.value)) {
    //   //   teamInput.classList.add('border-red-200','border-2');
    //   //   validation = false;
    //   // } else {
    //   //   teamInput.classList.remove('border-red-200','border-2');
    //   //   validation = true;
    //   // }

    //   if (birthdate < 18 ) {
    //     BirthdateInput.classList.add('border-red-200','border-2');
    //     validation = false;
    //   } else {
    //     BirthdateInput.classList.remove('border-red-200','border-2');
    //     validation = true;
    //   }

    //   return validation;
    // }
    

    AccepteInformation.addEventListener('click', (event) => {
      event.preventDefault();

      DetailsForm.submit(); 
    
    });

  </script>
</main>
