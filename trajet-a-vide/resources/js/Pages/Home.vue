<template>
     <base-layout>
     <div class="container mt-5">
      <h1 class="text-center">Rechercher un trajet</h1>
  
      <div class="row justify-content-center mt-4">
        <div class="col-md-6">
          <div class="d-flex justify-content-between mb-3">
            <!-- Champ de recherche ville de départ -->
            <div class="me-2" style="flex: 1;">
              <label for="departureCity">Ville de départ :</label>
              <input
                type="text"
                v-model="searchForm.departureCity"
                class="form-control"
                placeholder="Entrez la ville de départ"
                @input="searchCities('departureCity')"
              />
              <ul v-if="suggestedCities.departureCity.length" class="list-group mt-2">
                <li
                  v-for="city in suggestedCities.departureCity"
                  :key="city.id"
                  @click="selectCity(city, 'departureCity')"
                  class="list-group-item list-group-item-action"
                  style="cursor: pointer"
                >
                  {{ city.name }}
                </li>
              </ul>
            </div>
  
            <!-- Champ de recherche ville d'arrivée -->
            <div style="flex: 1;">
              <label for="arrivalCity">Ville d'arrivée :</label>
              <input
                type="text"
                v-model="searchForm.arrivalCity"
                class="form-control"
                placeholder="Entrez la ville d'arrivée"
                @input="searchCities('arrivalCity')"
              />
              <ul v-if="suggestedCities.arrivalCity.length" class="list-group mt-2">
                <li
                  v-for="city in suggestedCities.arrivalCity"
                  :key="city.id"
                  @click="selectCity(city, 'arrivalCity')"
                  class="list-group-item list-group-item-action"
                  style="cursor: pointer"
                >
                  {{ city.name }}
                </li>
              </ul>
            </div>
          </div>
  
          <button @click="submitSearch" class="btn btn-primary btn-block mt-3">Rechercher</button>
        </div>
      </div>
  
      <!-- Résultats des trajets -->
      <div class="mt-5" v-if="routes.length">
        <h2 class="text-center">Résultats de la recherche</h2>
        <div class="list-group">
          <div v-for="route in routes" :key="route.id" class="list-group-item" @click="goToBooking(route.id)">
            <h5>{{ route.departure_city.name }} → {{ route.arrival_city.name }}</h5>
            <p>Voiture: {{ route.car.brand }} {{ route.car.model }}</p>
            <p>Départ: {{ route.departure_date_time }}</p>
            <p>Prix: {{ route.price_per_passenger }}€</p>
          </div>
        </div>
      </div>
    </div>
    </base-layout>
    
  </template>
  
  <script>
  import { ref } from 'vue';
  import axios from 'axios';
  import { router } from '@inertiajs/vue3';
  import BaseLayout from './Layouts/BaseLayout.vue';
  
  export default {
    components: {
        BaseLayout,
    },
    setup() {
      const searchForm = ref({
        departureCity: '',
        arrivalCity: '',
        selectedDepartureCityId: null,
        selectedArrivalCityId: null,
      });
  
      const suggestedCities = ref({
        departureCity: [],
        arrivalCity: [],
      });
  
      const routes = ref([]);
  
      // Fonction pour rechercher les villes lors de la saisie
      const searchCities = async (target) => {
        
        if (searchForm.value[target].length >= 3) {
          try {
            console.log(searchForm.value[target]);
            const response = await axios.get(`/cities/search?query=${searchForm.value[target]}`);
            suggestedCities.value[target] = response.data.cities;
          } catch (error) {
            console.error('Erreur lors de la recherche des villes:', error);
          }
        } else {
          suggestedCities.value[target] = [];
        }
      };
  
      // Fonction pour sélectionner une ville
      const selectCity = (city, target) => {
        if (target === 'departureCity') {
          searchForm.value.departureCity = city.name;
          searchForm.value.selectedDepartureCityId = city.id;
        } else if (target === 'arrivalCity') {
          searchForm.value.arrivalCity = city.name;
          searchForm.value.selectedArrivalCityId = city.id;
        }
        suggestedCities.value[target] = [];
      };
  
      // Fonction pour soumettre la recherche de trajets
      const submitSearch = async () => {
        try {
          const response = await axios.get('/routes/search', {
            params: {
              departure_city_id: searchForm.value.selectedDepartureCityId,
              arrival_city_id: searchForm.value.selectedArrivalCityId,
            },
          });
          routes.value = response.data.routes;
        } catch (error) {
          console.error('Erreur lors de la recherche des trajets:', error);
        }
      };

      const goToBooking = (routeId) => {
        router.visit(`/route/${routeId}`);
      };
  
      return {
        searchForm,
        suggestedCities,
        routes,
        searchCities,
        selectCity,
        submitSearch,
        goToBooking
      };
    },
  };
  </script>
  
  <style scoped>
  .container {
    text-align: center;
  }
  
  .list-group-item {
    cursor: pointer;
  }
  
  .btn-block {
    width: 100%;
  }
  </style>
  