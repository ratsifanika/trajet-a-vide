<template>
  <base-layout>
  <div>
      <h1>Gérer l'annonce</h1>
      <div
        class="container"
      >
        <div
          class="row justify-content-center align-items-center g-2 mb-3"
        >
          <div class="col col-4">
            <div class="card">
              <div class="card-body">
                <p class="card-text">
                  {{ route.departure_city.name }}
                </p>
              </div>
            </div>
            
          </div>
          <div class="col col-4 text-center"><font-awesome-icon :icon="['fas', 'arrow-right']" /></div>
          <div class="col col-4">
            <div class="card">
              <div class="card-body">
                <p class="card-text">
                  {{ route.arrival_city.name }}
                </p>
              </div>
            </div>
          </div>
        </div>
        <div
          class="row justify-content-center align-items-center g-2"
        >
            <div class="col col-7">
              <div class="card w-50 mb-3">
              <div class="card-body">
                <p class="card-text">
                  Départ le {{ formatDate(route.departure_date_time) }}
                </p>
              </div>
            </div>

            <div class="card w-50 mb-3">
              <div class="card-body">
                <p class="card-text">
                  Places disponibles
                  <button
                    type="button"
                    class="btn btn-outline-primary"
                  >
                  <font-awesome-icon :icon="['fas', 'minus']" />
                  </button>
                  10
                  <button
                    type="button"
                    class="btn btn-outline-primary"
                  >
                  <font-awesome-icon :icon="['fas', 'plus']" />
                  </button>
                  
                </p>
              </div>
            </div>
          </div>
          <div class="col col-5">
            <!-- Div cliquable avec image ou nom de la voiture -->
            <div 
              @click="showCarModal = true"
              class="car-div"
              :style="carImage ? `background-image: url(${carImage});` : ''"
            >
              <p v-if="!carImage">{{ route.car.brand }} {{ route.car.model }}</p>
            </div>
          </div>
         
        </div>
        
        
      </div>
      
      <form @submit.prevent="updateRoute">
        <input v-model="form.available_seats" type="number" min="1" />
        <select v-model="form.car_id">
          <option v-for="car in route.cars" :key="car.id" :value="car.id">
            {{ car.brand }} {{ car.model }}
          </option>
        </select>
        <button type="submit">Modifier l'annonce</button>
      </form>
  
      <div v-for="booking in route.bookings" :key="booking.id">
        <p>{{ booking.user.name }} - Places: {{ booking.reserved_seats }}</p>
        <button @click="replyMessage(booking.id)">Répondre</button>
      </div>
    </div>
  </base-layout>
    
  </template>
  <style>
  .car-div {
    width: 400px; height: 300px; background-size: cover;background-position: center;
  }
  </style>
  
  <script>
  import { useForm } from "@inertiajs/vue3";
  import BaseLayout
   from "../Layouts/BaseLayout.vue";
  import { formatDate } from "../../utils";

  export default {
    components: {
      BaseLayout
    }
    ,
    props: ["route"],
    computed: {
      carImage() {
          return this.route.car.images.length
              ? `/storage/${this.route.car.images[0].image_path}`
              : '';
      },
    },
    setup(props) {
      const form = useForm({
        available_seats: props.route.available_seats,
        car_id: props.route.car_id,
      });
  
      const updateRoute = () => {
        form.post(`/admin/routes/${props.route.id}/update`);
      };
  
      const replyMessage = (bookingId) => {
        // Code pour répondre à un message (non implémenté ici)
      };

      // const carImage = (props.route.car.images.length > 0)?props.route.car.images[0].image_path:null;
      
      return { form, updateRoute, replyMessage, formatDate };
    },
  };
  </script>
  