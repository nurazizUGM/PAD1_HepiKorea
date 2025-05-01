<template>
    <Layout title="Profile">
        <div class="p-4 lg:p-8 border-2 bg-[#EFEFEF] border-gray-200 rounded-2xl h-full overflow-y-auto">
            <div class="rounded-2xl flex flex-col bg-white p-5 lg:p-10">
                <h1 class="text-black text-xs md:text-sm lg:text-2xl font-semibold">Profile Detail</h1>
                <div class="grid gap-x-8 lg:gap-x-16 grid-flow-row lg:grid-cols-[2fr_4fr] mt-0 md:mt-4 lg:mt-6">
                    <!-- Profile Picture Section -->
                    <div class="bg-white h-auto flex flex-col rounded-xl mt-4">
                        <div class="rounded-xl bg-slate-300">
                            <img class="min-h-[10rem] m-0 md:p-2 object-contain object-center" id="profile_picture"
                                :src="form.photo || defaultPhoto" alt="Profile Picture" />
                        </div>
                        <button
                            class="w-[50%] lg:w-[98%] h-12 mt-4 rounded-3xl bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] mx-auto p-2"
                            @click="$refs.photoInput.click()" :disabled="!isEditing">
                            <h1 class="text-xs lg:text-lg text-white font-semibold">Choose Photo</h1>
                        </button>
                        <input type="file" ref="photoInput" class="hidden" @change="handlePhotoChange"
                            accept="image/*" />
                    </div>

                    <!-- Profile Form Section -->
                    <div class="items-start justify-start bg-white h-auto rounded-xl mt-4 lg:mt-0">
                        <div class="relative overflow-x-auto w-full">
                            <form @submit.prevent="submitForm">
                                <table class="w-full text-sm text-left text-gray-500">
                                    <tbody>
                                        <!-- Full Name -->
                                        <tr class="bg-white border-b">
                                            <th scope="row" class="py-4 font-medium text-[#898383] whitespace-nowrap">
                                                <label for="fullname"
                                                    class="flex items-center mb-2 text-[12px] lg:text-lg font-medium text-[#898383]">Name</label>
                                            </th>
                                            <td class="py-4">
                                                <input v-model="form.fullname" type="text" id="fullname" name="fullname"
                                                    class="h-12 bg-gray-50 border border-[#376F7E] text-[#898383] text-sm rounded-lg focus:ring-0 focus:border-[#376F7E] block w-full md:w-2/3 lg:w-full p-2.5 ml-auto"
                                                    placeholder="Your Name" required :disabled="!isEditing" />
                                                <p v-if="errors.fullname" class="error">{{ errors.fullname.join(', ') }}
                                                </p>
                                            </td>
                                        </tr>

                                        <!-- Date of Birth -->
                                        <tr class="bg-white border-b">
                                            <th scope="row" class="py-4 font-medium text-[#898383] whitespace-nowrap">
                                                <label for="date_of_birth"
                                                    class="flex items-center mb-2 text-[12px] lg:text-lg font-medium text-[#898383]">Date
                                                    of Birth</label>
                                            </th>
                                            <td class="py-4 relative">
                                                <input v-model="form.date_of_birth" type="date" id="date_of_birth"
                                                    name="date_of_birth"
                                                    class="h-12 bg-gray-50 border border-[#376F7E] text-[#898383] text-sm rounded-lg focus:ring-0 focus:border-[#376F7E] block w-full md:w-2/3 lg:w-full p-2.5 ml-auto"
                                                    placeholder="Your Birth Date" required :disabled="!isEditing" />
                                                <p v-if="errors.date_of_birth" class="error">{{
                                                    errors.date_of_birth.join(', ') }}</p>
                                            </td>
                                        </tr>

                                        <!-- Gender -->
                                        <tr class="bg-white border-b">
                                            <th scope="row" class="py-4 font-medium text-[#898383] whitespace-nowrap">
                                                <label for="gender"
                                                    class="flex items-center mb-2 text-[12px] lg:text-lg font-medium text-[#898383]">Gender</label>
                                            </th>
                                            <td class="py-4 flex justify-end lg:justify-around" colspan="2">
                                                <div class="flex items-center mr-5">
                                                    <input v-model="form.gender" id="genderMale" type="radio"
                                                        name="gender" value="male"
                                                        class="w-4 h-4 border-[#376F7E] focus:ring-0"
                                                        :disabled="!isEditing" />
                                                    <label for="genderMale"
                                                        class="block ms-2 text-base font-medium text-[#898383]">Male</label>
                                                </div>
                                                <div class="flex items-center">
                                                    <input v-model="form.gender" id="genderFemale" type="radio"
                                                        name="gender" value="female"
                                                        class="w-4 h-4 border-[#376F7E] focus:ring-0"
                                                        :disabled="!isEditing" />
                                                    <label for="genderFemale"
                                                        class="block ms-2 text-base font-medium text-[#898383]">Female</label>
                                                </div>
                                                <p v-if="errors.gender" class="error">{{ errors.gender.join(', ') }}</p>
                                            </td>
                                        </tr>

                                        <!-- Email -->
                                        <tr class="bg-white border-b">
                                            <th scope="row" class="py-4 font-medium text-[#898383] whitespace-nowrap">
                                                <label for="email"
                                                    class="flex items-center mb-2 text-[12px] lg:text-lg font-medium text-[#898383]">Email</label>
                                            </th>
                                            <td class="py-4">
                                                <input v-model="form.email" type="email" id="email"
                                                    class="h-12 bg-gray-50 border border-[#376F7E] text-[#898383] text-sm rounded-lg focus:ring-0 focus:border-[#376F7E] block w-full md:w-2/3 lg:w-full p-2.5 ml-auto"
                                                    placeholder="Your Email" disabled />
                                            </td>
                                        </tr>

                                        <!-- Old Password -->
                                        <tr class="bg-white">
                                            <th scope="row" class="py-4 font-medium text-[#898383] whitespace-nowrap">
                                                <label for="old_password"
                                                    class="flex items-center mb-2 text-[12px] lg:text-lg font-medium text-[#898383]">Password</label>
                                            </th>
                                            <td class="py-4 relative">
                                                <input v-model="form.old_password"
                                                    :type="showOldPassword ? 'text' : 'password'" id="old_password"
                                                    name="old_password"
                                                    class="h-12 bg-gray-50 border border-[#376F7E] text-[#898383] text-sm rounded-lg focus:ring-0 focus:border-[#376F7E] block w-full md:w-2/3 lg:w-full p-2.5 ml-auto"
                                                    placeholder="Old Password" :required="form.new_password !== ''"
                                                    :disabled="!isEditing" />
                                                <span
                                                    class="absolute inset-y-0 right-2 lg:right-4 pr-2 lg:pr-6 flex items-center cursor-pointer"
                                                    @click="togglePassword('old')">
                                                    <img :src="showOldPassword ? '/img/assets/icon/icon_show_eye.svg' : '/img/assets/icon/icon_hide_eye.svg'"
                                                        alt="eye icon" class="h-6 w-6" />
                                                </span>
                                                <p v-if="errors.old_password" class="error">{{
                                                    errors.old_password.join(', ') }}</p>
                                            </td>
                                        </tr>

                                        <!-- New Password -->
                                        <tr class="bg-white">
                                            <th scope="row"></th>
                                            <td class="py-4 relative">
                                                <input v-model="form.new_password"
                                                    :type="showNewPassword ? 'text' : 'password'" id="new_password"
                                                    name="new_password"
                                                    class="h-12 bg-gray-50 border border-[#376F7E] text-[#898383] text-sm rounded-lg focus:ring-0 focus:border-[#376F7E] block w-full md:w-2/3 lg:w-full p-2.5 ml-auto"
                                                    placeholder="New Password" :disabled="!isEditing" />
                                                <span
                                                    class="absolute inset-y-0 right-2 lg:right-4 pr-2 lg:pr-6 flex items-center cursor-pointer"
                                                    @click="togglePassword('new')">
                                                    <img :src="showNewPassword ? '/img/assets/icon/icon_show_eye.svg' : '/img/assets/icon/icon_hide_eye.svg'"
                                                        alt="eye icon" class="h-6 w-6" />
                                                </span>
                                                <p v-if="errors.new_password" class="error">{{
                                                    errors.new_password.join(', ') }}</p>
                                            </td>
                                        </tr>

                                        <!-- Confirm New Password -->
                                        <tr class="bg-white border-b">
                                            <th scope="row"></th>
                                            <td class="py-4 relative">
                                                <input v-model="form.new_password_confirmation"
                                                    :type="showConfirmPassword ? 'text' : 'password'"
                                                    id="new_password_confirmation" name="new_password_confirmation"
                                                    class="h-12 bg-gray-50 border border-[#376F7E] text-[#898383] text-sm rounded-lg focus:ring-0 focus:border-[#376F7E] block w-full md:w-2/3 lg:w-full p-2.5 ml-auto placeholder:text-xs"
                                                    placeholder="Confirm Password" :required="form.new_password !== ''"
                                                    :disabled="!isEditing" />
                                                <span
                                                    class="absolute inset-y-0 right-2 lg:right-4 pr-2 lg:pr-6 flex items-center cursor-pointer"
                                                    @click="togglePassword('confirm')">
                                                    <img :src="showConfirmPassword ? '/img/assets/icon/icon_show_eye.svg' : '/img/assets/icon/icon_hide_eye.svg'"
                                                        alt="eye icon" class="h-6 w-6" />
                                                </span>
                                                <p v-if="errors.new_password_confirmation" class="error">{{
                                                    errors.new_password_confirmation.join(', ') }}</p>
                                                <Link :href="route('auth.verify')"
                                                    class="text-end block text-[#4F7AE8] mt-2 cursor-pointer">Verify
                                                email</Link>
                                            </td>
                                        </tr>

                                        <!-- Phone Number -->
                                        <tr class="bg-white border-b">
                                            <th scope="row" class="py-4 font-medium text-[#898383] whitespace-nowrap">
                                                <label for="phone"
                                                    class="flex items-center mb-2 text-[12px] lg:text-lg font-medium text-[#898383]">Phone
                                                    Number</label>
                                            </th>
                                            <td class="py-4">
                                                <input v-model="form.phone" type="text" id="phone" name="phone"
                                                    class="h-12 bg-gray-50 border border-[#376F7E] text-[#898383] text-sm rounded-lg focus:ring-0 focus:border-[#376F7E] block w-full md:w-2/3 lg:w-full p-2.5 ml-auto"
                                                    placeholder="Your Phone Number" :disabled="!isEditing" />
                                                <p v-if="errors.phone" class="error">{{ errors.phone.join(', ') }}</p>
                                            </td>
                                        </tr>

                                        <!-- Address: Province and City -->
                                        <tr class="bg-white">
                                            <th scope="row" class="py-4 font-medium text-[#898383] whitespace-nowrap">
                                                <label for="address"
                                                    class="flex items-center mb-2 text-[12px] lg:text-lg font-medium text-[#898383]">Address</label>
                                            </th>
                                            <td class="py-4">
                                                <div class="w-full md:w-2/3 lg:w-full flex ml-auto">
                                                    <div class="flex-1">
                                                        <input v-model="form.address.province" type="text" id="province"
                                                            name="province"
                                                            class="h-12 bg-gray-50 border border-[#376F7E] text-[#898383] text-sm rounded-lg focus:ring-0 focus:border-[#376F7E] block w-full p-2.5"
                                                            placeholder="Your Province" :disabled="!isEditing" />
                                                        <p v-if="errors.province" class="error">{{
                                                            errors.province.join(', ') }}</p>
                                                    </div>
                                                    <div class="flex-1 ml-1">
                                                        <input v-model="form.address.city" type="text" id="city"
                                                            name="city"
                                                            class="h-12 bg-gray-50 border border-[#376F7E] text-[#898383] text-sm rounded-lg focus:ring-0 focus:border-[#376F7E] block w-full p-2.5"
                                                            placeholder="Your City" :disabled="!isEditing" />
                                                        <p v-if="errors.city" class="error">{{ errors.city.join(', ') }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Postal Code -->
                                        <tr class="bg-white">
                                            <th scope="row"></th>
                                            <td class="py-4">
                                                <input v-model="form.address.postal_code" type="text" id="postal_code"
                                                    name="postal_code"
                                                    class="h-12 bg-gray-50 border border-[#376F7E] text-[#898383] text-sm rounded-lg focus:ring-0 focus:border-[#376F7E] block w-full md:w-2/3 lg:w-full p-2.5 ml-auto"
                                                    placeholder="Your Postal Code" :disabled="!isEditing" />
                                                <p v-if="errors.postal_code" class="error">{{
                                                    errors.postal_code.join(',')
                                                    }}</p>
                                            </td>
                                        </tr>

                                        <!-- Address Details -->
                                        <tr class="bg-white">
                                            <th scope="row"></th>
                                            <td class="py-4">
                                                <textarea v-model="form.address.address" id="address" name="address"
                                                    rows="5"
                                                    class="h-24 bg-gray-50 border border-[#376F7E] text-[#898383] text-sm rounded-lg focus:ring-0 focus:border-[#376F7E] block w-full md:w-2/3 lg:w-full p-2.5 ml-auto"
                                                    placeholder="Your Address" :disabled="!isEditing"></textarea>
                                                <p v-if="errors.address" class="error">{{ errors.address.join(', ') }}
                                                </p>
                                            </td>
                                        </tr>

                                        <!-- General Error -->
                                        <tr v-if="errors.general" class="bg-white">
                                            <th scope="row"></th>
                                            <td class="py-4">
                                                <p class="error">{{ errors.general }}</p>
                                            </td>
                                        </tr>

                                        <!-- Edit/Save/Cancel Buttons -->
                                        <tr v-if="isEditing" class="bg-white">
                                            <th scope="row"></th>
                                            <td class="py-4 flex space-x-4">
                                                <button type="submit"
                                                    class="bg-orange-400 hover:bg-orange-500 text-white rounded-lg lg:rounded-lg px-2 py-1 lg:px-5 lg:py-2.5 text-xl">
                                                    Save
                                                </button>
                                                <button type="button" @click="cancel"
                                                    class="bg-gray-400 hover:bg-gray-500 text-white rounded-lg lg:rounded-lg px-2 py-1 lg:px-5 lg:py-2.5 text-xl">
                                                    Cancel
                                                </button>
                                            </td>
                                        </tr>
                                        <tr v-else class="bg-white">
                                            <th scope="row"></th>
                                            <td class="py-4 w-full md:w-2/3 lg:w-full flex ml-auto">
                                                <button type="button" @click="edit"
                                                    class="bg-orange-400 hover:bg-orange-500 text-white rounded-lg lg:rounded-lg px-2 py-1 lg:px-5 lg:py-2.5 text-xl">
                                                    Edit
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
    </Layout>
</template>

<script>
import { Link } from '@inertiajs/vue3';
import Layout from '../../Layouts/Customer.vue';

export default {
    components: {
        Layout,
        Link,
    },
    data() {
        return {
            form: {
                photo: null,
                fullname: '',
                date_of_birth: '',
                gender: '',
                email: '',
                phone: '',
                address: {
                    province: '',
                    city: '',
                    postal_code: '',
                    address: '',
                },
                old_password: '',
                new_password: '',
                new_password_confirmation: '',
            },
            originalData: {},
            isEditing: false,
            showOldPassword: false,
            showNewPassword: false,
            showConfirmPassword: false,
            defaultPhoto: '/img/example/admin_order_img_user.png',
            photoFile: null,
            errors: {},
        };
    },
    methods: {
        async fetchProfileData() {
            try {
                const response = await fetch('/api/auth/profile');
                if (!response.ok) throw new Error('Failed to fetch profile');

                const data = await response.json();

                Object.assign(this.form, {
                    photo: data.photo ? `/storage/${data.photo}` : null,
                    fullname: data.fullname || '',
                    date_of_birth: data.date_of_birth || '',
                    gender: data.gender || '',
                    email: data.email || '',
                    phone: data.phone || '',
                    address: {
                        province: data.address?.province || '',
                        city: data.address?.city || '',
                        postal_code: data.address?.postal_code || '',
                        address: data.address?.address || '',
                    },
                    old_password: '',
                    new_password: '',
                    new_password_confirmation: '',
                });

                this.originalData = { ...this.form };
            } catch (error) {
                console.error('Error fetching profile:', error);
            }
        },
        handlePhotoChange(event) {
            const file = event.target.files[0];
            if (file) {
                this.photoFile = file;
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.form.photo = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        },
        togglePassword(field) {
            if (field === 'old') this.showOldPassword = !this.showOldPassword;
            else if (field === 'new') this.showNewPassword = !this.showNewPassword;
            else if (field === 'confirm') this.showConfirmPassword = !this.showConfirmPassword;
        },
        edit() {
            this.isEditing = true;
        },
        cancel() {
            this.isEditing = false;
            this.form = { ...this.originalData };
            this.form.old_password = '';
            this.form.new_password = '';
            this.form.new_password_confirmation = '';
            this.photoFile = null;
            this.errors = {};
        },
        async submitForm() {
            const formData = new FormData();
            formData.append('fullname', this.form.fullname);
            formData.append('date_of_birth', this.form.date_of_birth);
            formData.append('gender', this.form.gender);
            formData.append('phone', this.form.phone);
            formData.append('province', this.form.address.province);
            formData.append('city', this.form.address.city);
            formData.append('postal_code', this.form.address.postal_code);
            formData.append('address', this.form.address.address);
            if (this.form.old_password) formData.append('old_password', this.form.old_password);
            if (this.form.new_password) formData.append('new_password', this.form.new_password);
            if (this.form.new_password_confirmation) formData.append('new_password_confirmation', this.form.new_password_confirmation);
            if (this.photoFile) formData.append('photo', this.photoFile);
            try {
                const response = await fetch('/api/auth/profile', {
                    method: 'POST',
                    headers: {
                        "content-type": "multipart/form-data",
                        Accept: 'application/json',
                    },
                    body: formData,
                });
                const result = await response.json();
                if (!response.ok) {
                    this.errors = result.errors || { general: result.message || 'Failed to update profile' };
                    throw new Error(result.message || 'Failed to update profile');
                }
                Object.assign(this.form, {
                    photo: result.photo ? `/storage/${result.photo}` : this.form.photo,
                    fullname: result.fullname || this.form.fullname,
                    date_of_birth: result.date_of_birth || this.form.date_of_birth,
                    gender: result.gender || this.form.gender,
                    email: result.email || this.form.email,
                    phone: result.phone || this.form.phone,
                    address: {
                        province: result.address?.province || this.form.address.province,
                        city: result.address?.city || this.form.address.city,
                        postal_code: result.address?.postal_code || this.form.address.postal_code,
                        address: result.address?.address || this.form.address.address,
                    },
                    old_password: '',
                    new_password: '',
                    new_password_confirmation: '',
                });
                this.originalData = { ...this.form };
                this.photoFile = null;
                this.isEditing = false;
                this.errors = {};
            } catch (error) {
                console.error('Error updating profile:', error);
            }
        },
    },
    mounted() {
        this.fetchProfileData();
    },
};
</script>

<style scoped>
.error {
    color: red;
    font-size: 0.875rem;
    margin-top: 0.25rem;
}
</style>