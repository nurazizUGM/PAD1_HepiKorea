<template>
    <Modal :show="show" @close="$emit('close')">
        <div class="bg-white w-[45vw] rounded-xl shadow">
            <div class="relative w-full px-12 py-10 flex flex-row">
                <!-- Close Button -->
                <button class="absolute bg-black w-5 h-5 flex items-center justify-center rounded-full -top-2 -right-2"
                    @click="$emit('close')">
                    <p class="text-white text-sm">X</p>
                </button>
                <!-- Content -->
                <div class="w-full h-full rounded-lg">
                    <h1 class="text-3xl text-orange-400 font-semibold">Form Shipment</h1>
                    <form @submit.prevent="save" class="w-full max-h-[95%]">
                        <table class="w-full mt-1">
                            <tbody>
                                <tr>
                                    <td>
                                        <label class="text-base text-black text-opacity-50">Expedition Name</label>
                                        <input v-model="formData.shipment_service" type="text"
                                            class="w-full rounded-lg bg-white shadow-md border-none focus:border-none focus:ring-0"
                                            required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="text-base text-black text-opacity-50">Expedition Price</label>
                                        <input v-model="formData.price" type="number"
                                            class="w-full rounded-lg bg-white shadow-md border-none focus:border-none focus:ring-0"
                                            required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="text-base text-black text-opacity-50">Estimated Arrival
                                            Time</label>
                                        <div class="relative w-full">
                                            <div
                                                class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                                <svg class="w-4 h-4 text-gray-500" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 1 0 0-2H5a1 1 0 0 0 0 2Z" />
                                                </svg>
                                            </div>
                                            <input datepicker id="sent-arrival-estimation" type="text"
                                                class="w-full rounded-lg bg-white shadow-md border-none focus:ring-0 ps-10"
                                                placeholder="Select date">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <button type="submit"
                                            class="w-20 h-10 bg-orange-400 hover:bg-orange-500 rounded-md text-white py-0.5 px-1 mt-4">
                                            Save
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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
import { onUpdated, reactive } from 'vue';
import Modal from '../Modal.vue';

export default {
    components: { Modal },
    props: {
        show: Boolean,
        orderId: Number,
    },
    setup(props, { emit }) {
        const today = moment().format('YYYY-MM-DD');
        let datepicker: Datepicker;
        const formData = reactive({
            shipment_service: '', // Example data
            price: 0, // Example data
            tracking_code: '',
        });

        const save = async () => {
            try {
                await axios.post(`/api/admin/order/${props.orderId}/shipment-invoice`, {
                    shipment_service: formData.shipment_service,
                    price: formData.price,
                    arrival_estimation: moment(datepicker.getDate()).format('YYYY-MM-DD'),
                });
                emit('save');
            } catch (error) {
                console.error('Error sending order:', error);
            }
        }

        const initializeDatepicker = () => {
            const datepickerElement = document.getElementById('sent-arrival-estimation');
            if (datepickerElement) {
                // Initialize the datepicker with options
                datepicker = new Datepicker(datepickerElement, {
                    autohide: true,
                    buttons: true,
                    format: 'yyyy-mm-dd',
                    minDate: today,
                });
                datepicker.init();
                datepicker.setDate(today); // Set the initial date to today
            }
        };

        onUpdated(() => {
            if (props.show) {
                Object.assign(formData, {
                    shipment_service: '',
                    price: 0,
                    tracking_code: '',
                });
            }
            initializeDatepicker();
        });

        return {
            formData,
            today,
            save,
        };
    }
};
</script>