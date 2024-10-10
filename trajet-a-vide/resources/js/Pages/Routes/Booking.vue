<template>
    <base-layout>
    <div class="container mt-5">
      <h1 class="text-center">Détails du trajet</h1>
  
      <div class="row mt-4">
        <!-- Détails du trajet -->
        <div class="col-md-6">
          <h4>De : {{ route.departure_city.name }}</h4>
          <h4>À : {{ route.arrival_city.name }}</h4>
          <p>Date de départ : {{ route.departure_date_time }}</p>
          <p>Prix par passager : {{ route.price_per_passenger }}€</p>
          <p>Places disponibles : {{ route.available_seats }}</p>
        </div>
  
        <!-- Images de la voiture -->
        <div class="col-md-6">
          <h5>Voiture : {{ route.car.brand }} {{ route.car.model }}</h5>
          <div v-if="route.car.images.length">
            <div v-for="image in route.car.images" :key="image.id" class="mb-3">
              <img :src="image.url" class="img-fluid" alt="Car image">
            </div>
          </div>
          <p v-else>Aucune image disponible</p>
        </div>
      </div>
  
      <!-- Formulaire de réservation -->
      <div class="row mt-5 justify-content-center">
        <div class="col-md-6">
          <h3>Réserver ce trajet</h3>
  
          <form @submit.prevent="submitBooking">
            <div class="mb-3">
              <label for="reservedSeats" class="form-label">Nombre de places à réserver :</label>
              <input
                type="number"
                v-model="form.reservedSeats"
                min="1"
                :max="route.available_seats"
                class="form-control"
                id="reservedSeats"
                required
              />
            </div>
            <button type="submit" class="btn btn-primary">Réserver</button>
          </form>
        </div>
      </div>
    </div>
    </base-layout>
    
  </template>
  
  <script>
  import { ref } from 'vue';
  import { useForm } from '@inertiajs/vue3';
  import BaseLayout from '../Layouts/BaseLayout.vue';
  
  export default {
    props: {
      route: Object
    },
    components: {
        BaseLayout,
    },
    setup(props) {
      const form = useForm({
        reservedSeats: ''
      });
  
      const submitBooking = () => {
        form.post(`/route/${props.route.id}/booking`, {
          onSuccess: () => {
            form.reset();
          }
        });
      };
  
      return {
        form,
        submitBooking
      };
    }
  };
  </script>
  
  <style scoped>
  .container {
    text-align: center;
  }
  
  .img-fluid {
    max-height: 200px;
    object-fit: cover;
  }
  
  .mb-3 {
    margin-bottom: 1rem;
  }
  </style>
  