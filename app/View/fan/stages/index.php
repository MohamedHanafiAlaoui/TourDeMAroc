
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
            <option value="<?= htmlspecialchars($value->getId()) ?>"><?= htmlspecialchars($value->getName()) ?></option>
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
  <div id="stages-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    <!-- Stage Cards -->
     
  </div>

  <!-- Pagination -->
  <div id="paginationGrid" class="mt-12 flex justify-center">
    <span id="Previous_page" class="cursor-pointer px-4 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">Previous</span>
    <?php for ($i=0; $i < $NumberPagination; $i++): ?>
      <?php $stylePg = ($i == 0) ? 'text-emerald-500' : 'text-gray-700'; ?>
      <input type="radio" id="page<?= htmlspecialchars($i) ?>" name="pagination" value="<?= htmlspecialchars($i) ?>" class="hidden">
      <label for="page<?= htmlspecialchars($i) ?>" class=" <?= htmlspecialchars($stylePg) ?> px-4 py-2 border-t border-b border-gray-300 bg-white text-sm font-medium hover:bg-gray-50">
      <?= htmlspecialchars($i + 1) ?>
      </label>
    <?php endfor; ?> 
    <span id="Next_page" class="cursor-pointer px-4 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">Next</span>

  </div>
</main>

<script>

  // Obtenir les éléments de la page
const stagesGrid = document.getElementById("stages-grid");
let searchInput = document.getElementById("search");
let filterType = document.getElementById("stage-type");
let filterDistance = document.getElementById("distance");

let radioButtons = document.querySelectorAll('#paginationGrid label');
// //les element de pagination 
  let paginationGrid = document.getElementById('paginationGrid');
  let Previous_page = document.getElementById('Previous_page');
  let Next_page = document.getElementById('Next_page');
let PageTotal = 0; 
let NbPage = 0;

// Fonction de recherche avec debounce
let debounceTimeout;
searchInput.addEventListener("input", (e) => {
    clearTimeout(debounceTimeout);
    debounceTimeout = setTimeout(() => {
      if (searchInput.value.trim() !== "") {
        fetchStage();
      } else {
        NbPage = 0;
        fetchStage();
      }
    }, 150);
  });
  
filterDistance.addEventListener("input", () => { NbPage = 0; fetchStage()});
filterType.addEventListener("input", () => { NbPage = 0; fetchStage()});

// Fonction de récupération des données
function fetchStage() {
    const url = `api/Stages?search=${searchInput.value}&type=${filterType.value}&distance=${filterDistance.value}&NumberPage=${NbPage}`;
    
    fetch(url)
    .then(result => result.json())
    .then((data) => {
        if (data.length == 0) {
            PageTotal = 0;
        } else {
            PageTotal = data[0]['page_stage'];
        }
        toString(data);
        PaginationBar(PageTotal);
    }).catch((err) => {
        console.log(err);
    });
}

// Affichage des données des étapes
function toString(stages) {
    stagesGrid.innerHTML = ``;
    if (stages.length == 0) {
      const stageCard = document.createElement("div");
      stageCard.className = "h-72 flex justify-center";
      stageCard.innerHTML = `<span class="text-red-500">No Stage exist</span>`;
      stagesGrid.appendChild(stageCard);
    } else {
      stages.forEach(stage => {
        const stageCard = document.createElement("div");
        stageCard.className = "bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition duration-300";

        stageCard.innerHTML = 
            `<img
              src="${stage['photo']}"
              alt="Stage Map"
              class="w-full h-48 object-cover"
            />
            <div class="p-6">
              <h3 class="font-bold text-xl mb-2">Stage 1: ${stage['start_location']} → ${stage['end_location']}</h3>
              <p class="text-gray-600 mb-1"><strong>Distance:</strong> ${stage['distance_km']} km</p>
              <p class="text-gray-600 mb-4"><strong>Type:</strong> ${stage['nameCategory']}</p>
              <a href="http://localhost/tourDeMAroc/stages/${stage['id']}"
                class="inline-block bg-emerald-500 text-white py-2 px-4 rounded hover:bg-emerald-600 transition duration-300"
              >View Details</a>
            </div>
          </div>`;
        
        stagesGrid.appendChild(stageCard);
      });
    }
}

// Fonction pour gérer la pagination
function PaginationBar(PageTotal) {
    paginationGrid.innerHTML = '';
    paginationGrid.appendChild(Previous_page);

    // Ajouter des boutons de pagination si PageTotal est supérieur à 0
    if (PageTotal > 0) {
        for (let index = 0; index < PageTotal; index++) {
            const radioButton = document.createElement('input');
            radioButton.type = 'radio';
            radioButton.id = `page${index}`;
            radioButton.name = 'pagination';
            radioButton.value = index;
            radioButton.classList.add('hidden');
            
            const label = document.createElement('label');
            label.setAttribute('for', `page${index}`);
            label.classList.add('px-4', 'py-2', 'border-t', 'border-b', 'border-gray-300', 'bg-white', 'text-sm', 'font-medium', 'hover:bg-gray-50');
            label.textContent = index + 1;

            if (index == 0) { 
                label.classList.add('text-emerald-500');
                radioButton.checked = true;
            } else {
                label.classList.add('text-gray-700');
            }

            paginationGrid.appendChild(radioButton);
            paginationGrid.appendChild(label);
        }
    }

    paginationGrid.appendChild(Next_page);
    radioButtons = document.querySelectorAll('#paginationGrid label');
    ButtonPagination();
}

// Gérer les événements des boutons de pagination
function ButtonPagination() {
    radioButtons.forEach(element => {
        element.addEventListener('click', () => {
            const input = document.querySelector(`#${element.getAttribute('for')}`);
            NbPage = input.value;
            fetchStage();
            
            styleInit();
            
        });
    });

    // Gestion du bouton "Suivant"
    Next_page.addEventListener('click', () => {
        if (NbPage < PageTotal - 1) {
            NbPage++;
            fetchStage();
            styleInit();
        }
    });

    // Gestion du bouton "Précédent"
    Previous_page.addEventListener('click', () => {
        if (NbPage > 0) {
            NbPage--;
            fetchStage();
            styleInit();
            
        }
    });
}

function styleInit() {
  document.querySelector('#paginationGrid .text-emerald-500').classList.replace('text-emerald-500', 'text-gray-700');
  const btn = document.querySelector('#paginationGrid input:checked');
  document.querySelector(`label[for="page${NbPage}"]`).classList.replace('text-gray-700', 'text-emerald-500');

}

// Initialisation de la pagination et affichage des données
document.addEventListener('DOMContentLoaded', fetchStage);

</script>