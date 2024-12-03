<template>
  <base-layout>
  <div class="row h-200">
    <div class="col col-4 col-centered city-container">Antananarivo</div>
    <div class="col col-4 col-centered">Dimanche 15 Déc 2024</div>
    <div class="col col-4 col-centered city-container">Toamasina</div>

  </div>
  </base-layout>
    
  </template>
  <style>
  .car-div {
    width: 400px; height: 300px; background-size: cover;background-position: center;
  }
  .h-200 {
    height: 200px;
  }
  .city-container {
    background-color: yellow;
    border-radius: 5%;
  }
  .col-centered {
        display: flex;
        justify-content: center; /* Centre horizontalement */
        align-items: center;    /* Centre verticalement */
        height: 100%;           /* S'assure que l'élément occupe toute la hauteur du parent */
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
  