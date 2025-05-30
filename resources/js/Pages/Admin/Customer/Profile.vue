<template>
    <Layout title="Customer Profile">
        <div
            class="p-1 lg:p-4 border-2 bg-[#EFEFEF] w-full border-gray-200 rounded-lg dark:border-gray-700 h-[800px] md:h-[770px] lg:h-[87vh]">
            <div class="grid grid-cols-1 lg:grid-cols-[2fr_5fr] h-full rounded-lg gap-4 bg-white">
                <!-- Profile Picture -->
                <div class="bg-white h-full md:h-fit lg:h-full flex flex-col rounded-xl p-4">
                    <h1 class="text-black text-xs lg:text-2xl font-semibold">Profile Detail</h1>
                    <img :src="customer?.photo || '/img/assets/icon/icon_user.svg'" alt="Profile Picture"
                        class="w-full min-h-20 md:min-h-20 md:max-h-60 lg:min-h-20 mt-4 p-2 rounded-3xl object-contain" />
                    <!-- <button @click="$router.go(-1)" -->
                    <button
                        class="w-fit hidden lg:flex flex-row bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white text-lg font-semibold rounded-2xl justify-center items-center py-2 pl-10 pr-12 mx-auto mt-auto">
                        <img src="/img/assets/icon/icon_arrow_back.svg" alt="Back" class="w-10 h-8" />
                        <p class="my-auto ml-2">Back</p>
                    </button>
                </div>

                <!-- Customer Information -->
                <div class="items-start justify-start bg-white overflow-y-auto rounded-xl p-1 lg:p-4 h-full">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <tbody>
                            <!-- Name -->
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-2 py-2 md:px-4 md:py-2 lg:px-6 lg:py-4 font-medium text-[#898383] whitespace-nowrap">
                                    <label for="fullname"
                                        class="flex items-center mb-2 text-[10px] lg:text-lg font-normal text-[#898383]">Name</label>
                                </th>
                                <td class="px-2 py-2 md:px-4 md:py-2 lg:px-6 lg:py-4">
                                    <input type="text" id="fullname" v-model="customer.fullname" disabled
                                        class="h-[30px] lg:h-14 bg-slate-50 border border-[#376F7E] text-[#898383] text-[10px] lg:text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block w-full p-2.5" />
                                </td>
                            </tr>
                            <!-- Date of Birth -->
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-2 py-2 md:px-4 md:py-2 lg:px-6 lg:py-4 font-medium text-[#898383] whitespace-nowrap">
                                    <label for="date_of_birth"
                                        class="flex items-center mb-2 text-[10px] lg:text-lg font-normal text-[#898383]">Date
                                        of
                                        Birth</label>
                                </th>
                                <td class="px-2 py-2 md:px-4 md:py-2 lg:px-6 lg:py-4">
                                    <input type="text" id="date_of_birth" v-model="customer.date_of_birth" disabled
                                        class="h-[30px] lg:h-14 bg-slate-50 border border-[#376F7E] text-[#898383] text-[10px] lg:text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block w-full p-2.5" />
                                </td>
                            </tr>
                            <!-- Gender -->
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-2 py-2 md:px-4 md:py-2 lg:px-6 lg:py-4 font-medium text-[#898383] whitespace-nowrap">
                                    <label for="gender"
                                        class="flex items-center mb-2 text-[10px] lg:text-lg font-normal text-[#898383]">Gender</label>
                                </th>
                                <td class="px-2 py-2 md:px-4 md:py-2 lg:px-6 lg:py-4 flex justify-around">
                                    <div class="flex items-center mr-5">
                                        <input id="genderMale" type="radio" name="gender" value="male"
                                            :checked="customer.gender === 'male'" disabled
                                            class="w-4 h-4 border-[#376F7E] focus:ring-2 focus:ring-orange-400" />
                                        <label for="genderMale"
                                            class="block ms-1 lg:ms-2 text-[10px] lg:text-base font-normal text-[#898383]">Laki-Laki</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input id="genderFemale" type="radio" name="gender" value="female"
                                            :checked="customer.gender === 'female'" disabled
                                            class="w-4 h-4 border-[#376F7E] focus:ring-2 focus:ring-orange-400" />
                                        <label for="genderFemale"
                                            class="block ms-1 lg:ms-2 text-[10px] lg:text-base font-normal text-[#898383]">Perempuan</label>
                                    </div>
                                </td>
                            </tr>
                            <!-- Email -->
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-2 py-2 md:px-4 md:py-2 lg:px-6 lg:py-4 font-medium text-[#898383] whitespace-nowrap">
                                    <label for="email"
                                        class="flex items-center mb-2 text-[10px] lg:text-lg font-normal text-[#898383]">Email</label>
                                </th>
                                <td class="px-2 py-2 md:px-4 md:py-2 lg:px-6 lg:py-4 relative">
                                    <input type="email" id="email" v-model="customer.email" disabled
                                        class="h-[30px] lg:h-14 bg-slate-50 border border-[#376F7E] text-[#898383] text-[10px] lg:text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block w-full p-2.5" />
                                    <label v-if="customer.is_verified" for="email"
                                        class="absolute top-0.5 lg:top-0 right-4 md:right-6 lg:right-10 h-full py-2 lg:py-8 flex justify-center flex-col">
                                        <img src="/img/assets/icon/icon_check.svg" alt="Verified"
                                            class="h-1/5 lg:h-3/5 mt-1" />
                                        <span class="text-orange-500 text-[8px] lg:text-[10px] mt-auto">Verified</span>
                                    </label>
                                </td>
                            </tr>
                            <!-- Address -->
                            <tr class="bg-white dark:bg-gray-800">
                                <th scope="row"
                                    class="px-2 py-2 md:px-4 md:py-2 lg:px-6 lg:py-4 font-normal text-[#898383] whitespace-nowrap">
                                    <label for="address"
                                        class="flex items-center mb-2 text-[10px] lg:text-lg font-normal text-[#898383]">Address</label>
                                </th>
                                <td class="px-2 py-2 md:px-4 md:py-2 lg:px-6 lg:py-4">
                                    <div class="flex">
                                        <input type="text" id="province" v-model="customer.province" disabled
                                            class="w-full h-[30px] lg:h-14 bg-slate-50 border border-[#376F7E] text-[#898383] text-[10px] lg:text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block mr-4 lg:mr-8 p-2.5" />
                                        <input type="text" id="city" v-model="customer.city" disabled
                                            class="w-full h-[30px] lg:h-14 bg-slate-50 border border-[#376F7E] text-[#898383] text-[10px] lg:text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block p-2.5" />
                                    </div>
                                </td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800">
                                <th scope="row"></th>
                                <td class="px-2 py-2 md:px-4 md:py-2 lg:px-6 lg:py-4">
                                    <input type="text" id="postal_code" v-model="customer.postal_code" disabled
                                        class="h-[30px] lg:h-14 bg-slate-50 border border-[#376F7E] text-[#898383] text-[10px] lg:text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block w-full p-2.5" />
                                </td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800">
                                <th scope="row"></th>
                                <td class="px-2 py-2 md:px-4 md:py-2 lg:px-6 lg:py-4">
                                    <textarea id="address" v-model="customer.address" disabled rows="5"
                                        class="h-20 lg:h-40 bg-slate-50 border border-[#376F7E] text-[#898383] text-[10px] lg:text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block w-full px-2.5 py-1 lg:p-2.5 resize-none"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <button
                                    class="w-fit hidden md:flex lg:hidden flex-row bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white text-lg font-semibold rounded-2xl justify-center items-center py-0.5 pl-4 pr-6 mb-2 mx-auto mt-auto">
                                    <img src="/img/assets/icon/icon_arrow_back.svg" alt="Back" class="w-8 h-6" />
                                    <p class="my-auto ml-1.5">Back</p>
                                </button>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script>
import { ref, onMounted } from 'vue';
// import { useRoute } from 'vue-router';
import AdminLayout from '../../Layouts/Admin.vue';
import axios from 'axios';

export default {
    components: { AdminLayout },
    setup() {
        // const route = useRoute();

        // Dummy customer data
        const customer = ref({
            id: 1,
            fullname: 'John Doe',
            photo: null,
            date_of_birth: '1990-01-01',
            gender: 'male',
            email: 'john.doe@example.com',
            is_verified: true,
            province: 'DKI Jakarta',
            city: 'Jakarta Selatan',
            postal_code: '12345',
            address: 'Jl. Sudirman No. 123',
        });

        // Fetch customer:

        const fetchCustomer = async () => {
            try {
                /*
                const response = await axios.get(`/api/admin/customers/${route.params.id}`);
                customer.value = response.data.customer;
                */
            } catch (error) {
                console.error('Error fetching customer:', error);
            }
        };

        onMounted(() => {
            // Simulate fetching customer based on route.params.id
            if (route.params.id !== '1') {
                customer.value = {
                    id: 2,
                    fullname: 'Jane Smith',
                    photo: '/img/customer2.jpg',
                    date_of_birth: '1992-02-02',
                    gender: 'female',
                    email: 'jane.smith@example.com',
                    is_verified: false,
                    province: 'Jawa Barat',
                    city: 'Bandung',
                    postal_code: '54321',
                    address: 'Jl. Merdeka No. 456',
                };
            }
            // fetchCustomer();
        });

        return {
            customer,
        };
    },
};
</script>