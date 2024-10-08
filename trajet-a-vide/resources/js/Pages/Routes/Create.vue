<template>
  <base-layout>
    <div class="card">
      <div class="card-header">
        <h1>Créer un Nouveau Trajet</h1>
      </div>
      <div class="card-body">
         <!-- Departure City -->
        <div class="mb-3">
          <label for="departureCityName" class="form-label">Ville de départ :</label>
          <input
            type="text"
            v-model="departureCityName"
            @input="searchCity('departureCity')"
            class="form-control"
            id="departureCityName"
            placeholder="Entrez la ville de départ"
          />
          <!-- Suggestions dropdown -->
          <ul v-if="departureCities.length" class="list-group mt-2 city-list">
            <li
              v-for="city in departureCities"
              :key="city.id"
              @click="selectCity(city, 'departureCity')"
              class="list-group-item list-group-item-action"
              style="cursor: pointer"
            >
              {{ city.name }}
            </li>
          </ul>
        </div>

          <!-- Arrival City -->
          <div class="mb-3">
          <label for="arrivalCityName" class="form-label">Ville de d'arrivée :</label>
          <input
            type="text"
            v-model="arrivalCityName"
            @input="searchCity('arrivalCity')"
            class="form-control"
            id="arrivalCityName"
            placeholder="Entrez la ville de destination"
          />
          <!-- Suggestions dropdown -->
          <ul v-if="arrivalCities.length" class="list-group mt-2 city-list">
            <li
              v-for="city in arrivalCities"
              :key="city.id"
              @click="selectCity(city, 'arrivalCity')"
              class="list-group-item list-group-item-action"
              style="cursor: pointer"
            >
              {{ city.name }}
            </li>
          </ul>
          </div>
          
        <form @submit.prevent="form.post('/routes', {
          onError: (errors) => {
            console.log(errors); // Affiche les erreurs dans la console du navigateur
          }
        })">
          <input type="hidden" v-model="form.departure_city_id" name="departure_city_id" />
          <input type="hidden" v-model="form.arrival_city_id" name="arrival_city_id" />
          <!-- Departure Date and Time -->
          <div class="mb-3">
            <label for="departure_date_time" class="form-label">Date et Heure de départ :</label>
            <input type="datetime-local" v-model="form.departure_date_time" class="form-control" id="departure_date_time" name="departure_date_time">
          </div>

          <!-- Available Seats -->
          <div class="mb-3">
            <label for="available_seats" class="form-label">Places disponibles :</label>
            <input type="number" v-model="form.available_seats" class="form-control" id="available_seats" 
            placeholder="Entrez le nombre de places disponibles" name="available_seats">
          </div>

          <!-- Price per Passenger -->
          <div class="mb-3">
            <label for="price_per_passenger" class="form-label">Prix par passager :</label>
            <input type="number" v-model="form.price_per_passenger" class="form-control" id="price_per_passenger"
             placeholder="Entrez le prix par passager" name="price_per_passenger">
          </div>

          <!-- Car Selection -->
          <div class="mb-3">
            <label for="car" class="form-label">Voiture :</label>
            <select v-model="form.car_id" class="form-control" id="car">
              <option v-for="car in cars" :key="car.id" :value="car.id">{{ car.brand }} {{ car.model }}</option>
            </select>
            <span v-if="form.errors.car" class="text-danger">{{ form.errors.car }}</span>
            <button type="button" class="btn btn-link" @click="showCarModal = true">Ajouter une nouvelle voiture</button>
          </div>

          <!-- Remarks -->
          <div class="mb-3">
            <label for="remarks" class="form-label">Remarques :</label>
            <textarea v-model="form.remarks" class="form-control" id="remarks" rows="3"></textarea>
          </div>

          <!-- Submit Button -->
          <div class="text-end">
            <button type="submit" class="btn btn-primary">Créer Trajet</button>
          </div>
        </form>

        <!-- Modal for Adding a New Car -->
        <div v-if="showCarModal" class="modal fade show" style="display: block;" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Ajouter une nouvelle voiture</h5>
                <button type="button" class="btn-close" @click="closeCarModal"></button>
              </div>
              <div class="modal-body">
                <form @submit.prevent="submitCar">
                  <div class="mb-3">
                    <label for="newCarBrand" class="form-label">Marque :</label>
                    <input type="text" v-model="newCar.brand" class="form-control" id="newCarBand" placeholder="Entrez la marque de la voiture" required>
                  </div>
                  <div class="mb-3">
                    <label for="newCarModel" class="form-label">Modèle :</label>
                    <input type="text" v-model="newCar.model" class="form-control" id="newCarModel" placeholder="Entrez le modèle de la voiture" required>
                  </div>
                  <div class="mb-3">
                    <label for="newCarImage" class="form-label">Image de la voiture :</label>
                    <input type="file" @change="handleFileUpload" class="form-control" id="newCarImage">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="closeCarModal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Ajouter la voiture</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </base-layout>
</template>

<style>
  .city-list {
  max-height: 100px; /* Limite la hauteur maximale à 200px */
  overflow-y: auto;  /* Active le défilement vertical si nécessaire */
  border: 1px solid #ccc; /* Optionnel : ajoute une bordure */
}
</style>

<script>
import { ref } from 'vue';
import { router, useForm} from '@inertiajs/vue3';
import BaseLayout from '../Layouts/BaseLayout.vue';
import axios from 'axios';

export default {
  props: {
    cars: Array, // Récupère les voitures via Inertia depuis Laravel
  },
  components: {
    BaseLayout,
  },
  setup() {
    const form = useForm({
      departure_city_id: null,
      arrival_city_id: null,
      departure_date_time: '',
      available_seats: '',
      price_per_passenger: '',
      car_id: null,
      remarks: ''
    });

    const departureCityName = ref('');
    const arrivalCityName = ref('');
    const departureCities = ref([]);
    const arrivalCities = ref([]);

    const searchCity = (target) => {
      let query = '';
      if (target == 'departureCity') {
        query = departureCityName.value
      } else {
        query = arrivalCityName.value
      }
      // Vérifie si au moins 3 lettres ont été saisies
      if (query.length >= 3) {
        axios.get('/cities/search', {
          params: {
            query: query, // Envoie la ville recherchée
          },
        })
        .then((response) => {
          if (target == 'departureCity') {
            departureCities.value = response.data.cities; // Met à jour la liste des villes
          } else {
            arrivalCities.value = response.data.cities; // Met à jour la liste des villes
          }
       
        })
        .catch((error) => {
          console.error('Erreur lors de la recherche de la ville:', error);
        });
      } else {
        // Si moins de 3 lettres, vider les résultats
        if (target == 'departureCity') {
            departureCities.value = [];
          } else {
            arrivalCities.value = [];
          }
        
      }
    }

    const selectCity = (city, target) => {
      if (target == 'departureCity') {
        console.log(city.name)
        // Met à jour la ville sélectionnée
        form.departure_city_id = city.id;
        departureCityName.value = city.name;
        // Vide la liste des suggestions après la sélection
        departureCities.value = [];
      } else {
        // Met à jour la ville sélectionnée
        form.arrival_city_id= city.id;
        arrivalCityName.value = city.name;
        // Vide la liste des suggestions après la sélection
        arrivalCities.value = [];
      }
     
    }

    const newCar = ref({
      name: '',
      image: null
    });

    const showCarModal = ref(false);

    const handleFileUpload = (event) => {
      newCar.value.image = event.target.files[0];
    };

    const closeCarModal = () => {
      showCarModal.value = false;
      newCar.value = { name: '', image: null }; // Reset the form
    };

    const submitCar = () => {
      // Utiliser Inertia pour envoyer les données de la nouvelle voiture au backend
      const formData = new FormData();
      console.log(formData);
      formData.append('brand', newCar.value.brand);
      formData.append('model', newCar.value.model);
      if (newCar.value.image) {
        formData.append('image', newCar.value.image);
      }

      router.post('/cars/store', formData, {
        onSuccess: () => {
          // Fermer la modale et mettre à jour la liste des voitures
          closeCarModal();
        },
        onFinish: () => {
          // Mettre à jour les voitures sans recharger la page
          // Pour récupérer les nouvelles voitures et les injecter dans le composant
          router.reload({ only: ['cars'] });
        }
      });
    };

    const submitRoute = () => {
      console.log('xxxx');
      router.post('/routes', form.value);
    };

    return {
      form,
      showCarModal,
      newCar,
      submitCar,
      handleFileUpload,
      closeCarModal,
      submitRoute,
      departureCities,
      arrivalCities,
      searchCity,
      selectCity,
      departureCityName,
      arrivalCityName
    };
  },
};
</script>
