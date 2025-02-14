<main class="max-w-7xl mx-auto px-4 py-20">
  <!-- Profile Section -->
  <section class="bg-white shadow-xl rounded-2xl p-8 mb-12 transition-all duration-300 hover:shadow-2xl">
    <div class="flex flex-col md:flex-row items-center space-y-8 md:space-y-0">
      <!-- Profile Image with Fan Badge -->
      <div class="relative group">
        <div class="absolute inset-0 bg-emerald-500/10 rounded-full blur-lg animate-pulse"></div>
        <div class="relative">
          <img 
            src="/api/placeholder/300/300"
            alt="Profile" 
            class="w-48 h-48 rounded-full border-4 border-emerald-500/30 object-cover transform transition-transform duration-300 hover:scale-105"
          />
          <!-- Fan Badge -->
          <div class="absolute -bottom-2 -right-2 bg-emerald-500 text-white px-4 py-1 rounded-full text-sm font-semibold shadow-lg flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
            </svg>
            Fan
          </div>
        </div>
      </div>

      <!-- Profile Details -->
      <div class="md:ml-12 space-y-4 text-center md:text-left">
        <h1 class="text-4xl font-bold bg-gradient-to-r from-emerald-600 to-green-600 bg-clip-text text-transparent">
          Sarah Johnson
        </h1>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
          <div class="flex items-center justify-center md:justify-start">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
              <circle cx="12" cy="7" r="4"></circle>
            </svg>
            <span class="ml-2 text-gray-600">
              <span class="font-medium text-gray-800">Member since:</span> 2023
            </span>
          </div>
          <div class="flex items-center justify-center md:justify-start">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6"></path>
              <path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18"></path>
              <path d="M4 22h16"></path>
              <path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22"></path>
              <path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22"></path>
              <path d="M18 2H6v7a6 6 0 0 0 12 0V2Z"></path>
            </svg>
            <span class="ml-2 text-gray-600">
              <span class="font-medium text-gray-800">Favorite Team:</span> Team Morocco
            </span>
          </div>
        </div>

        <!-- Cool Logout Button -->
        <form method="POST" action="<?= url('logout') ?>" class="mt-6">
          <button class="flex items-center justify-center bg-emerald-500 text-white px-6 py-3 rounded-lg shadow-lg hover:bg-emerald-600 transition duration-300">
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
  </section>

  <!-- Badges Section -->
  <section class="bg-white shadow-xl rounded-2xl p-8 transition-all duration-300 hover:shadow-2xl">
    <div class="text-center mb-8">
      <h2 class="text-3xl font-bold text-gray-800 flex items-center justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-3 text-emerald-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6"></path>
          <path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18"></path>
          <path d="M4 22h16"></path>
          <path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22"></path>
          <path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22"></path>
          <path d="M18 2H6v7a6 6 0 0 0 12 0V2Z"></path>
        </svg>
        Fan Achievements
      </h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <!-- Likes Badge -->
      <div class="group bg-gradient-to-br from-emerald-50 to-green-50 rounded-xl p-6 shadow-md transition-all duration-300 hover:shadow-lg hover:scale-105">
        <div class="flex items-center justify-between mb-4">
          <div class="p-3 bg-emerald-500 rounded-lg text-white">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
            </svg>
          </div>
          <span class="text-2xl font-bold text-emerald-600">50+</span>
        </div>
        <h3 class="text-lg font-semibold text-gray-800">Enthusiastic Fan</h3>
        <p class="text-gray-600 text-sm mt-2">Liked 50+ cycling moments</p>
      </div>

      <!-- Comments Badge -->
      <div class="group bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl p-6 shadow-md transition-all duration-300 hover:shadow-lg hover:scale-105">
        <div class="flex items-center justify-between mb-4">
          <div class="p-3 bg-emerald-500 rounded-lg text-white">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
            </svg>
          </div>
          <span class="text-2xl font-bold text-emerald-600">10+</span>
        </div>
        <h3 class="text-lg font-semibold text-gray-800">Active Supporter</h3>
        <p class="text-gray-600 text-sm mt-2">Posted 10+ engaging comments</p>
      </div>

      <!-- Early Supporter Badge -->
      <div class="group bg-gradient-to-br from-emerald-50 to-green-50 rounded-xl p-6 shadow-md transition-all duration-300 hover:shadow-lg hover:scale-105">
        <div class="flex items-center justify-between mb-4">
          <div class="p-3 bg-emerald-500 rounded-lg text-white">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
            </svg>
          </div>
          <span class="text-2xl font-bold text-emerald-600">2023</span>
        </div>
        <h3 class="text-lg font-semibold text-gray-800">Early Supporter</h3>
        <p class="text-gray-600 text-sm mt-2">Joined in the first year</p>
      </div>
    </div>
  </section>

  <!-- Favorite Cyclists Section -->
  <section class="bg-white shadow-xl rounded-2xl p-8 transition-all duration-300 hover:shadow-2xl">
    <div class="text-center mb-8">
      <h2 class="text-3xl font-bold text-gray-800 flex items-center justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-3 text-emerald-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M4.5 16.5c-1.5 1.26-2 5-2 5s3.74-.5 5-2c.71-.84.7-2.13-.09-2.91a2.18 2.18 0 0 0-2.91-.09z"></path>
          <path d="m12 15-3-3a22 22 0 0 1 2-3.95A12.88 12.88 0 0 1 22 2c0 2.72-.78 7.5-6 11a22.35 22.35 0 0 1-4 2z"></path>
          <path d="M9 12H4s.55-3.03 2-4c1.62-1.08 5 0 5 0"></path>
          <path d="M12 15v5s3.03-.55 4-2c1.08-1.62 0-5 0-5"></path>
        </svg>
        Favorite Cyclists
      </h2>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <!-- Favorite Cyclist Card (Repeat for each favorite cyclist) -->
      <div class="group bg-gradient-to-br from-emerald-50 to-green-50 rounded-xl p-6 shadow-md transition-all duration-300 hover:shadow-lg hover:scale-105">
        <div class="flex items-center space-x-4">
          <img src="https://avatars.githubusercontent.com/u/110723408?v=4" alt="Cyclist Name" class="w-20 h-20 rounded-full object-cover border-2 border-emerald-500">
          <div>
            <h3 class="text-lg font-semibold text-gray-800">John Doe</h3>
            <p class="text-emerald-600 font-medium">Team Greenspeed</p>
          </div>
        </div>
        <div class="mt-4">
          <p class="text-sm text-gray-600"><span class="font-medium">Wins:</span> 15</p>
        </div>
        <button class="mt-4 w-full bg-emerald-500 text-white px-4 py-2 rounded-lg shadow hover:bg-emerald-600 transition duration-300">View Profile</button>
      </div>

      <!-- Add more favorite cyclist cards here -->

    </div>

    <!-- Add Favorite Button -->
    <div class="mt-8 text-center">
      <a href="<?= url('cyclists') ?>" class="bg-emerald-500 w-fit text-white px-6 py-3 rounded-lg shadow-lg hover:bg-emerald-600 transition duration-300 flex items-center justify-center mx-auto">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="10"></circle>
          <line x1="12" y1="8" x2="12" y2="16"></line>
          <line x1="8" y1="12" x2="16" y2="12"></line>
        </svg>
        Add Favorite Cyclist
      </a>
    </div>
  </section>
</main>
