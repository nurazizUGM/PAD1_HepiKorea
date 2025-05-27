<template>
  <Modal :show="show" @close="$emit('close')">
    <div class="bg-white rounded-xl shadow max-w-md w-full">
      <div class="relative p-5 flex flex-row">
        <!-- Close Button -->
        <button
          class="absolute bg-black w-5 h-5 flex items-center justify-center rounded-full -top-2 -right-2"
          @click="$emit('close')"
        >
          <p class="text-white text-sm">X</p>
        </button>
        <!-- Content -->
        <div class="flex flex-col w-full">
          <h1 class="text-black text-base font-semibold">Estimation Arrival</h1>
          <!-- Datepicker -->
          <input
            v-model="estimatedArrival"
            type="date"
            class="mt-1 w-full h-10 border rounded-lg focus:ring-0 focus:border-orange-400"
            :min="today"
          >
          <!-- Form -->
          <form @submit.prevent="save">
            <input type="hidden" v-model="estimatedArrival">
            <button
              type="submit"
              class="rounded-lg bg-orange-400 hover:bg-orange-500 text-white ml-auto mt-2 h-9 w-1/4"
            >
              Save
            </button>
          </form>
        </div>
      </div>
    </div>
  </Modal>
</template>

<script>
import { ref, computed } from 'vue';
import Modal from '../Modal.vue';
import axios from 'axios';

export default {
  components: { Modal },
  props: {
    show: Boolean,
    orderId: Number,
  },
  setup(props, { emit }) {
    const today = new Date().toISOString().split('T')[0];
    const estimatedArrival = ref(today);

    const save = async () => {
      try {
        /*
        await axios.post(`/api/admin/orders/${props.orderId}/process`, {
          estimated_arrival: estimatedArrival.value,
        });
        */
        emit('save');
      } catch (error) {
        console.error('Error processing order:', error);
      }
    };

    return {
      estimatedArrival,
      today,
      save,
    };
  },
};
</script>