
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
      <!-- Stage cards will be injected via JavaScript -->
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
      // Tour Stages Data (10 stages)
      const stages = [
        { start: "Casablanca", end: "Rabat", distance: 90, type: "Coastal", icon: "fa-water" },
        { start: "Rabat", end: "Fez", distance: 200, type: "Urban", icon: "fa-city" },
        { start: "Fez", end: "Meknes", distance: 65, type: "Nature", icon: "fa-tree" },
        { start: "Meknes", end: "Marrakech", distance: 350, type: "Mountain", icon: "fa-mountain" },
        { start: "Marrakech", end: "Agadir", distance: 250, type: "Coastal", icon: "fa-water" },
        { start: "Agadir", end: "Essaouira", distance: 180, type: "Coastal", icon: "fa-water" },
        { start: "Essaouira", end: "Safi", distance: 140, type: "Coastal", icon: "fa-water" },
        { start: "Safi", end: "El Jadida", distance: 160, type: "Coastal", icon: "fa-water" },
        { start: "El Jadida", end: "Casablanca", distance: 100, type: "Urban", icon: "fa-city" },
        { start: "Casablanca", end: "Mohammedia", distance: 30, type: "Urban", icon: "fa-city" }
      ];

      // Render Stages
      const stagesContainer = document.getElementById("stages-container");
      stages.forEach((stage, index) => {
        const stageElement = document.createElement("div");
        stageElement.className = "bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300";
        stageElement.innerHTML = `
          <div class="p-6">
            <div class="flex items-center justify-between mb-4">
              <span class="text-2xl font-bold text-emerald-500">Stage ${index + 1}</span>
              <span class="bg-emerald-100 text-emerald-600 px-3 py-1 rounded-full text-sm">
                ${stage.distance} km
              </span>
            </div>
            <h3 class="text-xl font-semibold text-gray-800 mb-2">${stage.start} → ${stage.end}</h3>
            <p class="text-gray-600 flex items-center">
              <i class="fas ${stage.icon} mr-2 text-emerald-500"></i> ${stage.type}
            </p>
          </div>
          <div class="bg-emerald-50 px-6 py-4">
            <div class="flex justify-between items-center">
              <span class="text-sm text-emerald-600 font-medium">Details</span>
              <button class="text-emerald-500 hover:text-emerald-600 transition">
                <i class="fas fa-chevron-right"></i>
              </button>
            </div>
          </div>
        `;
        stagesContainer.appendChild(stageElement);
      });

      // Teams Data
      const teams = [
        { name: "Team Morocco", country: "Morocco", flag: "🇲🇦", riders: 8 },
        { name: "Team France", country: "France", flag: "🇫🇷", riders: 8 },
        { name: "Team Spain", country: "Spain", flag: "🇪🇸", riders: 8 },
        { name: "Team Italy", country: "Italy", flag: "🇮🇹", riders: 8 },
        { name: "Team Belgium", country: "Belgium", flag: "🇧🇪", riders: 8 },
        { name: "Team Netherlands", country: "Netherlands", flag: "🇳🇱", riders: 8 }
      ];

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
              <span class="text-3xl">${team.flag}</span>
              <span class="bg-emerald-100 text-emerald-600 px-3 py-1 rounded-full text-sm">
                ${team.riders} riders
              </span>
            </div>
            <h3 class="text-xl font-bold text-gray-800">${team.name}</h3>
            <p class="text-gray-600">${team.country}</p>
          `;
          teamsGrid.appendChild(teamCard);
        });
      }

      // Initial render of teams
      renderTeams(teams);

      // Search functionality with debounce
      const searchInput = document.getElementById("team-search");
      let debounceTimeout;
      searchInput.addEventListener("input", (e) => {
        clearTimeout(debounceTimeout);
        debounceTimeout = setTimeout(() => {
          const searchTerm = e.target.value.toLowerCase();
          const filteredTeams = teams.filter(
            (team) =>
              team.name.toLowerCase().includes(searchTerm) ||
              team.country.toLowerCase().includes(searchTerm)
          );
          renderTeams(filteredTeams);
        }, 300);
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