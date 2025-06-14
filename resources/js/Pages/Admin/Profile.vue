<template>
    <adminLayout>
        <div class="p-4 border-2 bg-[#EFEFEF] border-gray-200 rounded-lg dark:border-gray-700 h-full overflow-y-auto">

            <div class="rounded-lg h-full flex flex-col bg-white p-8">
                <h1 class="text-black text-2xl font-semibold">Profile Admin</h1>
                <div class="grid h-full gap-x-4 grid-cols-[2fr_4fr] mt-6">
                    <div class="bg-white h-full flex flex-col rounded-xl mt-4">
                        <div class="rounded-xl bg-slate-300">
                            <img class="w-full min-h-[10rem] m-0 p-2" id="profile_picture"
                                :src="getImageUrl(profile.photo)" alt="Profile Picture">
                        </div>
                        <button
                            class="w-[98%] h-12 mt-4 rounded-3xl bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] mx-auto p-2"
                            @click="$refs.photo.click()">
                            <h1 class="text-lg text-white font-semibold">Choose Photo</h1>
                        </button>
                        <button type="button" onclick="window.location.href='{{ route('admin.dashboard') }}'"
                            class="flex flex-row bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white font-semibold justify-center items-center w-2/5 h-10 rounded-2xl mb-6 mt-auto mr-auto">
                            <img src="/img/assets/icon/icon_arrow_back.svg" alt="" class="w-10 h-8">
                            <p class="my-auto">Back</p>
                        </button>
                    </div>
                    <div class="items-start justify-start bg-white h-auto rounded-xl">
                        <div class="relative overflow-x-auto w-full">
                            <form autocomplete="off" @submit.prevent="updateProfile">
                                <input type="file" name="photo" ref="photo" id="photo" @change="changePhoto"
                                    class="hidden">
                                <table class="w-full text-sm text-left rtl:text-right">
                                    <tbody>
                                        <tr class="bg-white">
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                <label for="fullname"
                                                    class="flex items-center mb-2 text-lg font-medium text-[#898383] dark:text-white">Name</label>
                                            </th>
                                            <td class="px-6 py-4">
                                                <input type="text" id="fullname" name="fullname"
                                                    v-model="profile.fullname" autocomplete="off"
                                                    class="h-12 bg-gray-50 border border-[#376F7E] text-[#898383] text-sm rounded-lg focus:ring-0 focus:border-[#376F7E] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400"
                                                    placeholder="Your Name" required />
                                            </td>
                                        </tr>
                                        <tr class="bg-white">
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-[#898383] whitespace-nowrap dark:text-white">
                                                <label for="date_of_birth"
                                                    class="flex items-center mb-2 text-lg font-medium text-[#898383] dark:text-white">Date
                                                    of Birth</label>
                                            </th>
                                            <td class="px-6 py-4 relative">
                                                <input type="text" id="date_of_birth" name="date_of_birth"
                                                    autocomplete="off"
                                                    class="h-12 bg-gray-50 border border-[#376F7E] text-[#898383] text-sm rounded-lg focus:ring-0 focus:border-[#376F7E] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400"
                                                    placeholder="Your Birth Date" />
                                                <div
                                                    class="absolute inset-y-0 right-6 pe-6 flex items-center ps-3.5 pointer-events-none">
                                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400"
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        fill="currentColor" viewBox="0 0 20 20">
                                                        <path
                                                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                                    </svg>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr class="bg-white">
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-[#898383] whitespace-nowrap dark:text-white">
                                                <label for="gender"
                                                    class="flex items-center mb-2 text-lg font-medium text-[#898383] dark:text-white">
                                                    Gender </label>
                                            </th>
                                            <td class="px-6 py-4 flex" colspan="2">
                                                <div class="flex items-center mr-5">
                                                    <input id="genderMale" type="radio" name="gender" value="male"
                                                        v-model="profile.gender"
                                                        class="w-4 h-4 border-[#376F7E] focus:ring-2 focus:ring-[#376F7E]"
                                                        style="color:#376F7E">
                                                    <label for="genderMale"
                                                        class="block ms-2  text-base font-medium text-[#898383] dark:text-gray-300">
                                                        Male
                                                    </label>
                                                </div>
                                                <div class="flex items-center">
                                                    <input id="genderFemale" type="radio" name="gender" value="female"
                                                        v-model="profile.gender"
                                                        class="w-4 h-4 border-[#376F7E] focus:ring-2 focus:ring-[#376F7E]"
                                                        style="color:#376F7E">
                                                    <label for="genderFemale"
                                                        class="block ms-2 text-base font-medium text-[#898383] dark:text-gray-300">
                                                        Female
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr class="bg-white">
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-[#898383] whitespace-nowrap dark:text-white">
                                                <label for="email"
                                                    class="flex items-center mb-2 text-lg font-medium text-[#898383] dark:text-white">Email</label>
                                            </th>
                                            <td class="px-6 py-4">
                                                <input type="email" id="email" name="email" v-model="profile.email"
                                                    autocomplete="off"
                                                    class="h-12 bg-gray-50 border- border-[#376F7E] text-[#898383] text-sm rounded-lg focus:ring-0 focus:border-[#376F7E] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400"
                                                    placeholder="Your Email" disabled />
                                            </td>
                                        </tr>

                                        <tr class="bg-white">
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-[#898383] whitespace-nowrap dark:text-white">
                                                <label for="old_password"
                                                    class="flex items-center mb-2 text-lg font-medium text-[#898383] dark:text-white">Password</label>
                                            </th>
                                            <td class="px-6 py-4 relative">
                                                <input type="password" id="old_password" name="old_password"
                                                    v-model="old_password" autocomplete="off"
                                                    class="h-12 bg-gray-50 border- border-[#376F7E] text-[#898383] text-sm rounded-lg focus:ring-0 focus:border-[#376F7E] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400"
                                                    placeholder="Current Password" />
                                                <span
                                                    class="absolute inset-y-0 right-4 pr-6 flex items-center btn-show-password">
                                                    <img src="/img/assets/icon/icon_hide_eye.svg" alt="eye hide Icon"
                                                        class="h-6 w-6 cursor-pointer">
                                                </span>
                                            </td>
                                        </tr>

                                        <tr class="bg-white">
                                            <th scope="row">
                                            </th>
                                            <td class="px-6 py-4 relative">
                                                <input type="password" id="password" name="password" v-model="password"
                                                    autocomplete="off"
                                                    class="h-12 bg-gray-50 border- border-[#376F7E] text-[#898383] text-sm rounded-lg focus:ring-0 focus:border-[#376F7E] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400"
                                                    placeholder="New Password" />
                                                <span
                                                    class="absolute inset-y-0 right-4 pr-6 flex items-center btn-show-password">
                                                    <img src="/img/assets/icon/icon_hide_eye.svg" alt="eye hide Icon"
                                                        class="h-6 w-6 cursor-pointer">
                                                </span>

                                            </td>
                                        </tr>

                                        <tr class="bg-white">
                                            <th scope="row">
                                            </th>
                                            <td class="px-6 py-4 relative">
                                                <input type="password" id="password_confirmation"
                                                    name="password_confirmation" v-model="password_confirmation"
                                                    autocomplete="off"
                                                    class="h-12 bg-gray-50 border- border-[#376F7E] text-[#898383] text-sm rounded-lg focus:ring-0 focus:border-[#376F7E] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-400 dark:focus:border-orange-400"
                                                    placeholder="Confirm Password" />
                                                <span
                                                    class="absolute inset-y-0 right-4 pr-6 flex items-center btn-show-password">
                                                    <img src="/img/assets/icon/icon_hide_eye.svg" alt="eye hide Icon"
                                                        class="h-6 w-6 cursor-pointer">
                                                </span>

                                            </td>
                                        </tr>

                                        <tr class="bg-white">
                                            <th scope="row"></th>
                                            <td class="px-6 py-4">
                                                <button type="submit" v-if="changed"
                                                    class="w-full h-12 rounded-xl bg-orange-400 p-2 text-white font-semibold">
                                                    Save Changes
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </adminLayout>
</template>

<script lang="ts">
import { router } from '@inertiajs/vue3';
import axios from 'axios';
import { profile } from 'console';
import { Datepicker } from 'flowbite';
import moment from 'moment';
import adminLayout from '../Layouts/Admin.vue';

export default {
    components: {
        adminLayout,
    },
    props: {
        user: Object,
    },
    data() {
        return {
            profile: {
                fullname: '',
                date_of_birth: '',
                gender: '',
                email: '',
                photo: '',
            },
            old_password: '',
            password: '',
            password_confirmation: '',
            show_password: false,
            photo: null,
            changed: false,
            datePipcker: null,
            loading: true
        }
    },
    watch: {
        profile: {
            handler() {
                if (!this.loading) {
                    this.changed = true;
                }
            },
            deep: true,
        },
        old_password() {
            if (!this.loading) {
                this.changed = true;
            }
        },
        password() {
            if (!this.loading) {
                this.changed = true;
            }
        },
        password_confirmation() {
            if (!this.loading) {
                this.changed = true;
            }
        },
    },
    mounted() {
        this.fetchProfile().then(() => {
            this.initDatepicker();
        });
    },
    methods: {
        async fetchProfile() {
            this.loading = true;
            return axios.get('/api/auth/profile').then((response) => {
                if (response.status === 200) {
                    this.profile = response.data;
                    this.password = '';
                    this.password_confirmation = '';
                    this.old_password = '';
                    setTimeout(() => {
                        this.loading = false;
                    }, 1000);
                }
            }).catch((error) => {
                console.error('Error fetching profile data:', error);
            });
        },
        initDatepicker() {
            const datePickerElement = document.getElementById('date_of_birth');
            if (datePickerElement) {
                const datePicker = new Datepicker(datePickerElement, {
                    format: 'yyyy-mm-dd',
                    maxDate: moment().format('YYYY-MM-DD'),
                    autohide: true,
                });
                if (this.profile.date_of_birth) {
                    datePicker.setDate(moment(this.profile.date_of_birth).format('YYYY-MM-DD'));
                }

                this.datePicker = datePicker;
            }
        },
        updateProfile() {
            if (this.changed) {
                const formData = new FormData();
                formData.append('fullname', this.profile.fullname);
                formData.append('date_of_birth', moment(this.datePicker.getDate()).format('YYYY-MM-DD'));
                formData.append('gender', this.profile.gender);
                if (this.photo) {
                    formData.append('photo', this.photo);
                }
                if (this.password) {
                    if (this.password !== this.password_confirmation) {
                        console.error('Password confirmation does not match');
                        return;
                    }
                    formData.append('new_password', this.password);
                    formData.append('old_password', this.old_password);
                }

                axios.post('/api/auth/profile', formData).then((response) => {
                    if (response.status === 200) {
                        if (this.password) {
                            router.get('/auth/login')
                        }
                        this.changed = false;
                    }
                }).catch((error) => {
                    console.error('Error updating profile:', error);
                });
            }
        },
        getImageUrl(image) {
            if (!image) return '/img/assets/icon/icon_user.svg';
            return /^(http|blob)/.test(image) ? image : `/api/file?path=${encodeURIComponent(image)}`;
        },
        changePhoto(event) {
            const file = event.target.files[0];
            if (file) {
                this.profile.photo = URL.createObjectURL(file);
                this.photo = file;
                this.changed = true;
                event.target.value = ''; // Reset the input value
            }
        },
    },
}
</script>