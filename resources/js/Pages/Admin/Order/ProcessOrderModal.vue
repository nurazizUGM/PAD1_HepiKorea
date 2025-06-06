<template>
    <Modal :show="show" @close="$emit('close')">
        <div class="bg-white rounded-xl shadow max-w-md w-full">
            <div class="relative p-5 flex flex-row">
                <!-- Close Button -->
                <button class="absolute bg-black w-5 h-5 flex items-center justify-center rounded-full -top-2 -right-2"
                    @click="$emit('close')">
                    <p class="text-white text-sm">X</p>
                </button>
                <!-- Content -->
                <div class="flex flex-col w-full">
                    <h1 class="text-black text-base font-semibold">Estimation Arrival</h1>
                    <div class="relative max-w-sm">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                            <img src="/img/assets/icon/icon_admin_order_date.svg">
                        </div>
                        <input datepicker id="process-arrival-estimation" type="text" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-12 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Select date">
                    </div>
                    <!-- Form -->
                    <form @submit.prevent="save" id="process-order-form">
                        <button type="submit"
                            class="rounded-lg bg-orange-400 hover:bg-orange-500 text-white ml-auto mt-2 h-9 w-1/4">
                            Save
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </Modal>
</template>

<script lang="ts">
import axios from 'axios';
import { Datepicker } from 'flowbite';
import moment from 'moment';
import { onUpdated } from 'vue';
import Modal from '../Modal.vue';

export default {
    components: { Modal },
    props: {
        show: Boolean,
        orderId: Number,
    },
    setup(props, { emit }) {
        let datePicker: Datepicker;

        const save = async () => {
            try {
                await axios.post(`/api/admin/order/${props.orderId}/process`, {
                    estimated_arrival: moment(datePicker.getDate()).format('YYYY-MM-DD'),
                });
                emit('save');
            } catch (error) {
                console.error('Error processing order:', error);
            }
        };

        // Initialize datepicker
        const initializeDatepicker = () => {
            const datepickerElement = document.getElementById('process-arrival-estimation');
            if (datepickerElement) {
                datePicker = new Datepicker(datepickerElement, {
                    autohide: true,
                    buttons: true,
                    format: 'yyyy-mm-dd',
                    minDate: moment().format('YYYY-MM-DD'),
                });
                datePicker.setDate(moment().format('YYYY-MM-DD'));
                datePicker.init();
            }
        };

        onUpdated(() => {
            initializeDatepicker();
        })

        return {
            save,
        };
    },
};
</script>