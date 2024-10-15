<template>
    <div>
      <h1>Gérer l'annonce</h1>
      <form @submit.prevent="updateRoute">
        <input v-model="form.departure_date_time" type="datetime-local" />
        <input v-model="form.available_seats" type="number" min="1" />
        {{ route }}
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
  </template>
  
  <script>
  import { ref } from "vue";
  import { useForm } from "@inertiajs/vue3";
  
  export default {
    props: ["route"],
    setup(props) {
      const form = useForm({
        departure_date_time: props.route.departure_date_time,
        available_seats: props.route.available_seats,
        car_id: props.route.car_id,
      });
  
      const updateRoute = () => {
        form.post(`/admin/routes/${props.route.id}/update`);
      };
  
      const replyMessage = (bookingId) => {
        // Code pour répondre à un message (non implémenté ici)
      };
  
      return { form, updateRoute, replyMessage };
    },
  };
  </script>
  