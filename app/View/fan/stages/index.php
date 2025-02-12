<!-- Main Content -->
<main class="max-w-7xl mx-auto px-4 pb-10 pt-28">
  <!-- Page Title & Introduction -->
  <div class="text-center mb-12">
    <h1 class="text-4xl font-bold text-gray-800 mb-4">All Stages</h1>
    <p class="text-xl text-gray-600">
      Explore all the stages of the Tour de Maroc and get an overview of the challenging courses.
    </p>
  </div>

  <!-- Search and Filter Section -->
  <div class="bg-white rounded-lg shadow-md p-6 mb-8">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
      <div>
        <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
        <input
          type="text"
          id="search"
          name="search"
          placeholder="Search stages..."
          class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500"
        />
      </div>
      <div>
        <label for="stage-type" class="block text-sm font-medium text-gray-700 mb-1">Stage Type</label>
        <select
          id="stage-type"
          name="stage-type"
          class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500"
        >
          <option value="">All Types</option>
          <?php foreach ($categorys as $key => $value): ?>
            <option value="<?= htmlspecialchars($value->getIdCategory()) ?>"><?= htmlspecialchars($value->getNameCategory()) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div>
        <label for="distance" class="block text-sm font-medium text-gray-700 mb-1">Distance</label>
        <select
          id="distance"
          name="distance"
          class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500"
        >
          <option value="">All Distances</option>
          <option value="short">Short (&lt; 100 km)</option>
          <option value="medium">Medium (100-200 km)</option>
          <option value="long">Long (&gt; 200 km)</option>
        </select>
      </div>
    </div>
  </div>

  <!-- Stages Listing Section -->
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    <!-- Stage Card 1 -->
    <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition duration-300">
      <img
        src="https://dqh479dn9vg99.cloudfront.net/wp-content/uploads/sites/9/2018/02/07100521/tour_of_oman.jpg"
        alt="Stage Map"
        class="w-full h-48 object-cover"
      />
      <div class="p-6">
        <h3 class="font-bold text-xl mb-2">Stage 1: Casablanca → Rabat</h3>
        <p class="text-gray-600 mb-1"><strong>Distance:</strong> 90 km</p>
        <p class="text-gray-600 mb-4"><strong>Type:</strong> Coastal</p>
        <a href="<?= url('stages/1') ?>"
          class="inline-block bg-emerald-500 text-white py-2 px-4 rounded hover:bg-emerald-600 transition duration-300"
        >View Details</a>
      </div>
    </div>

    <!-- Additional stage cards can be added here -->
  </div>

  <!-- Pagination -->
  <div class="mt-12 flex justify-center">
    <nav class="inline-flex rounded-md shadow">
      <a href="#"
        class="px-4 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50"
      >Previous</a>
      <a href="#"
        class="px-4 py-2 border-t border-b border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50"
      >1</a>
      <a href="#"
        class="px-4 py-2 border-t border-b border-gray-300 bg-white text-sm font-medium text-emerald-500 hover:bg-gray-50"
      >2</a>
      <a href="#"
        class="px-4 py-2 border-t border-b border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50"
      >3</a>
      <a href="#"
        class="px-4 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50"
      >Next</a>
    </nav>
    <span id="Previous_page" class="px-4 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">Previous</span>
    <?php for ($i=0; $i < $NumberPagination; $i++): ?>
      <?php $stylePg = ($i == 1) ? 'text-emerald-500' : 'text-gray-700'; ?>
      <input type="radio" id="page<?= htmlspecialchars($i) ?>" name="pagination" value="<?= htmlspecialchars($i) ?>" class="hidden">
      <label for="page<?= htmlspecialchars($i) ?>" class=" <?= htmlspecialchars($stylePg) ?> px-4 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
      <?= htmlspecialchars($i) ?>
      </label>
    <?php endfor; ?> 
    <span id="Next_page" class="px-4 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">Next</span>

  </div>
</main>

<script>
  // touver la valeur drs input de search et filrage
  let searchInput = document.getElementById("search");
  let filterType = document.getElementById("stage-type");
  let filterDistance = document.getElementById("distance");

  function fetchStage() {
    const url = `fetch?search=${searchInput}&type=${filterType}&distance=${filterDistance}`

    fetch(url)
    .then(result => result.json())
    .then((result) => {
      
    }).catch((err) => {
      console.log(err);
    });


  }

</script>