<template>
    <base-layout>
    <div>
      <h1>Liste des trajets</h1>
      <div v-for="route in routes" :key="route.id" class="route-item">
        <div @click="toggleRoute(route.id)">
          <h3>{{ route.departure_city }} → {{ route.arrival_city }}</h3>
          <p>Date: {{ route.departure_date_time }}</p>
          <p>Réservations en cours : {{ route.bookings.length }}</p>
          <button @click="manageRoute(route.id)">Gérer l'annonce</button>
        </div>
  
        <div v-if="expandedRoute === route.id" class="reservations">
          <h4>Réservations</h4>
          <div v-for="booking in route.bookings" :key="booking.id" class="booking-item">
            <p>Client: {{ booking.user.name }} - Places: {{ booking.reserved_seats }}</p>
            <p v-if="booking.messages.length">Dernier message: {{ booking.messages[0].content }}</p>
            <button @click="confirmValidation(booking.id)">Valider</button>
          </div>
        </div>
      </div>
  
      <modal v-if="showModal" @close="showModal = false" @confirm="validateBooking">
        Confirmez-vous la validation de cette réservation ?
      </modal>
    </div>
    </base-layout>
  </template>
  
  <script>
  import { ref } from "vue";
  import BaseLayout from '../Layouts/BaseLayout.vue';
  
  export default {
    components: {
        BaseLayout,
    },
    props: ["routes"],
    setup() {
      const expandedRoute = ref(null);
      const showModal = ref(false);
      const bookingToValidate = ref(null);
  
      const toggleRoute = (id) => {
        expandedRoute.value = expandedRoute.value === id ? null : id;
      };
  
      const confirmValidation = (id) => {
        bookingToValidate.value = id;
        showModal.value = true;
      };
  
      const validateBooking = () => {
        axios
          .post(`/admin/bookings/${bookingToValidate.value}/validate`)
          .then(() => {
            showModal.value = false;
            location.reload(); // Recharge la page après validation
          });
      };
  
      const manageRoute = (id) => {
        Inertia.visit(`/admin/routes/${id}/manage`);
      };
  
      return { expandedRoute, toggleRoute, confirmValidation, showModal, validateBooking, manageRoute };
    },
  };
  </script>
  