
  <!-- Hero Section -->
  <div class="pt-16 bg-gradient-to-b from-emerald-500/10 to-transparent">
    <div class="max-w-7xl mx-auto px-4 py-16">
      <div class="bg-white rounded-2xl shadow-xl p-8 backdrop-blur-md bg-opacity-90">
        <div class="flex flex-col md:flex-row items-start gap-8">
          <div class="flex-1">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Tour de Maroc 2025</h1>
            <div class="flex flex-wrap gap-4 text-gray-600 mb-6">
              <span class="flex items-center bg-gray-100 px-4 py-2 rounded-full">
                <i class="far fa-calendar-alt mr-2 text-emerald-500"></i>
                May 1 - May 15, 2025
              </span>
              <span class="flex items-center bg-gray-100 px-4 py-2 rounded-full">
                <i class="fas fa-route mr-2 text-emerald-500"></i>
                1565 km Total
              </span>
              <span class="flex items-center bg-gray-100 px-4 py-2 rounded-full">
                <i class="fas fa-flag-checkered mr-2 text-emerald-500"></i>
                10 Stages
              </span>
            </div>
            <p class="text-xl text-gray-700 leading-relaxed">
              Experience the majestic journey through Morocco's diverse landscapes, from the Atlantic coast to the Atlas Mountains, in this prestigious cycling event.
            </p>
          </div>
          <div class="flex-1">
            <div class="relative h-64 bg-gray-200 rounded-xl overflow-hidden">
              <img src="https://sportpro.ma/wp-content/uploads/2024/06/tour-de-france-scaled.jpg" alt="Tour Map" class="w-full h-full object-cover" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Stages Section (Redesigned) -->
  <section class="max-w-7xl mx-auto px-4">
    <h2 class="text-3xl font-bold text-gray-800 mb-12 text-center">Tour Stages</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="stages-container">
      <!-- Stage cards -->
      <?php if (!$Stages) { ?>
            <div class="h-40 text-red-500 flex justify-center ">
                <p>No Stage exists</p>
            </div>
        <?php } else { $i=1; foreach ($Stages as $key => $stage): ?>
          <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300">
            <div class="p-6">
              <div class="flex items-center justify-between mb-4">
                <span class="text-2xl font-bold text-emerald-500">Stage <?= htmlspecialchars($i) ?></span>
                <span class="bg-emerald-100 text-emerald-600 px-3 py-1 rounded-full text-sm">
                  <?= htmlspecialchars($stage->getDistance()) ?> km
                </span>
              </div>
              <h3 class="text-xl font-semibold text-gray-800 mb-2"><?= htmlspecialchars($stage->getStLocation()) ?> → <?= htmlspecialchars($stage->getEnLocation()) ?></h3>
              <p class="text-gray-600 flex items-center">
                <i class="fas fa-mountain mr-2 text-emerald-500"></i> <?= htmlspecialchars($stage->getNameCategory()) ?>
              </p>
            </div>
            <div class="bg-emerald-50 px-6 py-4">
              <div class="flex justify-between items-center">
                <span class="text-sm text-emerald-600 font-medium">Details</span>
                <a href="<?= url('stages/'.$stage->getId()) ?>">
                  <button class="text-emerald-500 hover:text-emerald-600 transition">
                    <i class="fas fa-chevron-right"></i>
                  </button>
                </a>
              </div>
            </div>
          </div>
        <?php $i++; endforeach;} ?>
    </div>
  </section>

  <!-- Teams Section -->
  <section class="max-w-7xl mx-auto px-4 py-16">
    <div class="bg-white rounded-2xl shadow-xl p-8">
      <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
        <h2 class="text-3xl font-bold text-gray-800">Participating Teams</h2>
        <div class="relative w-full md:w-auto">
          <input
            type="text"
            id="team-search"
            placeholder="Search teams..."
            class="w-full md:w-auto pl-10 pr-4 py-2 border border-gray-200 rounded-full focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
          />
          <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
        </div>
      </div>
      <div id="teams-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Team cards will be injected via JavaScript -->
      </div>
    </div>
  </section>

  <script>
    document.addEventListener("DOMContentLoaded", function () {

      // initial le bare de recherche
      let searchInput = document.getElementById("team-search");
      fetchTeam();

      //fonction qui permer de fetcher data des teams
      function fetchTeam() {
        const url = `api/Teams?search=${searchInput.value}`;
        
        fetch(url)
        .then(result => result.json())
        .then((data) => {
          renderTeams(data);
        }).catch((err) => {
          console.log(err);
        });
      }

      // fonction pour get les 2 caractere d'un string
      function getFirstTwoChars(string) {
        return string.slice(0,2).toUpperCase();
      }

      // Render Teams
      function renderTeams(teamsToRender) {
        const teamsGrid = document.getElementById("teams-grid");
        teamsGrid.innerHTML = "";
        teamsToRender.forEach((team) => {
          const teamCard = document.createElement("div");
          teamCard.className =
            "bg-gray-50 rounded-xl p-6 hover:shadow-lg transition duration-300 transform hover:-translate-y-1";
          teamCard.innerHTML = `
            <div class="flex items-center justify-between mb-4">
              <span class="text-3xl">${getFirstTwoChars(team.name_Team)}</span>
              <span class="bg-emerald-100 text-emerald-600 px-3 py-1 rounded-full text-sm">
                riders
              </span>
            </div>
            <h3 class="text-xl font-bold text-gray-800">${team.name_Team}</h3>
          `;
          teamsGrid.appendChild(teamCard);
        });
      }


      // Search functionality with 
      let debounceTimeout;
      searchInput.addEventListener("input", (e) => {
        clearTimeout(debounceTimeout);
        debounceTimeout = setTimeout(fetchTeam, 150);
      });

      // Responsive navigation menu for mobile devices
      const mobileMenuBtn = document.createElement("button");
      mobileMenuBtn.className = "md:hidden p-2 text-gray-600 hover:text-emerald-500 transition";
      mobileMenuBtn.innerHTML = '<i class="fas fa-bars text-xl"></i>';
      const nav = document.querySelector("nav .flex.justify-between");
      nav.insertBefore(mobileMenuBtn, nav.firstChild);

      const mobileMenu = document.createElement("div");
      mobileMenu.className =
        "md:hidden fixed inset-0 bg-white z-40 transform translate-x-full transition-transform duration-300 ease-in-out";
      mobileMenu.innerHTML = `
        <div class="p-4">
          <button class="absolute top-4 right-4 text-gray-600 hover:text-emerald-500">
            <i class="fas fa-times text-xl"></i>
          </button>
          <div class="flex flex-col space-y-4 mt-12">
            <a href="index.html" class="text-gray-600 hover:text-emerald-500 transition">Home</a>
            <a href="tours.html" class="text-gray-600 hover:text-emerald-500 transition">Tours</a>
            <a href="#" class="text-emerald-500 font-semibold">Tour Details</a>
            <a href="#" class="text-gray-600 hover:text-emerald-500 transition">Cyclists</a>
            <a href="#" class="text-gray-600 hover:text-emerald-500 transition">Rankings</a>
          </div>
        </div>
      `;
      document.body.appendChild(mobileMenu);
      mobileMenuBtn.addEventListener("click", () => {
        mobileMenu.classList.remove("translate-x-full");
      });
      mobileMenu.querySelector("button").addEventListener("click", () => {
        mobileMenu.classList.add("translate-x-full");
      });

      // Scroll to top button
      const scrollTopBtn = document.createElement("button");
      scrollTopBtn.className =
        "fixed bottom-8 right-8 bg-emerald-500 text-white p-4 rounded-full shadow-lg opacity-0 transition-opacity duration-300 hover:bg-emerald-600";
      scrollTopBtn.innerHTML = '<i class="fas fa-arrow-up"></i>';
      document.body.appendChild(scrollTopBtn);
      window.addEventListener("scroll", () => {
        scrollTopBtn.style.opacity = window.scrollY > 500 ? "1" : "0";
      });
      scrollTopBtn.addEventListener("click", () => {
        window.scrollTo({ top: 0, behavior: "smooth" });
      });
    });

   


  </script>