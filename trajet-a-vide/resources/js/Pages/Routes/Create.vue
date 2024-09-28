<template>
  <base-layout>
    <div class="card">
      <div class="card-header">
        <h1>Créer un Nouveau Trajet</h1>
      </div>
      <div class="card-body">
        <form @submit.prevent="submitRoute">
          <!-- Departure City -->
          <div class="mb-3">
            <label for="departureCity" class="form-label">Ville de départ :</label>
            <input type="text" v-model="form.departureCity" class="form-control" id="departureCity" placeholder="Entrez la ville de départ">
          </div>

          <!-- Arrival City -->
          <div class="mb-3">
            <label for="arrivalCity" class="form-label">Ville d'arrivée :</label>
            <input type="text" v-model="form.arrivalCity" class="form-control" id="arrivalCity" placeholder="Entrez la ville d'arrivée">
          </div>

          <!-- Departure Date and Time -->
          <div class="mb-3">
            <label for="departureDateTime" class="form-label">Date et Heure de départ :</label>
            <input type="datetime-local" v-model="form.departureDateTime" class="form-control" id="departureDateTime">
          </div>

          <!-- Available Seats -->
          <div class="mb-3">
            <label for="availableSeats" class="form-label">Places disponibles :</label>
            <input type="number" v-model="form.availableSeats" class="form-control" id="availableSeats" placeholder="Entrez le nombre de places disponibles">
          </div>

          <!-- Price per Passenger -->
          <div class="mb-3">
            <label for="pricePerPassenger" class="form-label">Prix par passager :</label>
            <input type="number" v-model="form.pricePerPassenger" class="form-control" id="pricePerPassenger" placeholder="Entrez le prix par passager">
          </div>

          <!-- Car Selection -->
          <div class="mb-3">
            <label for="car" class="form-label">Voiture :</label>
            <select v-model="form.car" class="form-control" id="car">
              <option v-for="car in cars" :key="car.id" :value="car.id">{{ car.name }}</option>
            </select>
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

<script>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import BaseLayout from '../Layouts/BaseLayout.vue';

export default {
  props: {
    cars: Array, // Récupère les voitures via Inertia depuis Laravel
  },
  components: {
    BaseLayout,
  },
  setup(props) {
    const form = ref({
      departureCity: '',
      arrivalCity: '',
      departureDateTime: '',
      availableSeats: '',
      pricePerPassenger: '',
      car: null,
      remarks: ''
    });

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
      router.post('/routes', form.value);
    };

    return {
      form,
      showCarModal,
      newCar,
      submitCar,
      handleFileUpload,
      closeCarModal,
      submitRoute
    };
  },
};
</script>
