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
                :src="form.photo || defaultPhoto" alt="Profile Picture">
            </div>
            <button
              class="w-[50%] lg:w-[98%] h-12 mt-4 rounded-3xl bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] mx-auto p-2"
              @click="$refs.photoInput.click()">
              <h1 class="text-xs lg:text-lg text-white font-semibold">Choose Photo</h1>
            </button>
            <input type="file" ref="photoInput" class="hidden" @change="handlePhotoChange" accept="image/*">
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
                      </td>
                    </tr>

                    <!-- Date of Birth -->
                    <tr class="bg-white border-b">
                      <th scope="row" class="py-4 font-medium text-[#898383] whitespace-nowrap">
                        <label for="date_of_birth"
                          class="flex items-center mb-2 text-[12px] lg:text-lg font-medium text-[#898383]">Date of Birth</label>
                      </th>
                      <td class="py-4 relative">
                        <input v-model="form.date_of_birth" type="date" id="date_of_birth" name="date_of_birth"
                          class="h-12 bg-gray-50 border border-[#376F7E] text-[#898383] text-sm rounded-lg focus:ring-0 focus:border-[#376F7E] block w-full md:w-2/3 lg:w-full p-2.5 ml-auto"
                          placeholder="Your Birth Date" required :disabled="!isEditing" />
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
                          <input v-model="form.gender" id="genderMale" type="radio" name="gender" value="male"
                            class="w-4 h-4 border-[#376F7E] focus:ring-0" :disabled="!isEditing">
                          <label for="genderMale" class="block ms-2 text-base font-medium text-[#898383]">Male</label>
                        </div>
                        <div class="flex items-center">
                          <input v-model="form.gender" id="genderFemale" type="radio" name="gender" value="female"
                            class="w-4 h-4 border-[#376F7E] focus:ring-0" :disabled="!isEditing">
                          <label for="genderFemale"
                            class="block ms-2 text-base font-medium text-[#898383]">Female</label>
                        </div>
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
                        <input v-model="form.old_password" :type="showOldPassword ? 'text' : 'password'"
                          id="old_password" name="old_password"
                          class="h-12 bg-gray-50 border border-[#376F7E] text-[#898383] text-sm rounded-lg focus:ring-0 focus:border-[#376F7E] block w-full md:w-2/3 lg:w-full p-2.5 ml-auto"
                          placeholder="Old Password" :required="form.new_password !== ''" :disabled="!isEditing" />
                        <span class="absolute inset-y-0 right-2 lg:right-4 pr-2 lg:pr-6 flex items-center cursor-pointer"
                          @click="togglePassword('old')">
                          <img
                            :src="showOldPassword ? '/img/assets/icon/icon_show_eye.svg' : '/img/assets/icon/icon_hide_eye.svg'"
                            alt="eye icon" class="h-6 w-6">
                        </span>
                      </td>
                    </tr>

                    <!-- New Password -->
                    <tr class="bg-white">
                      <th scope="row"></th>
                      <td class="py-4 relative">
                        <input v-model="form.new_password" :type="showNewPassword ? 'text' : 'password'"
                          id="new_password" name="new_password"
                          class="h-12 bg-gray-50 border border-[#376F7E] text-[#898383] text-sm rounded-lg focus:ring-0 focus:border-[#376F7E] block w-full md:w-2/3 lg:w-full p-2.5 ml-auto"
                          placeholder="New Password" :disabled="!isEditing" />
                        <span class="absolute inset-y-0 right-2 lg:right-4 pr-2 lg:pr-6 flex items-center cursor-pointer"
                          @click="togglePassword('new')">
                          <img
                            :src="showNewPassword ? '/img/assets/icon/icon_show_eye.svg' : '/img/assets/icon/icon_hide_eye.svg'"
                            alt="eye icon" class="h-6 w-6">
                        </span>
                      </td>
                    </tr>

                    <!-- Confirm New Password -->
                    <tr class="bg-white border-b">
                      <th scope="row"></th>
                      <td class="py-4 relative">
                        <input v-model="form.new_password_confirmation"
                          :type="showConfirmPassword ? 'text' : 'password'" id="new_password_confirmation"
                          name="new_password_confirmation"
                          class="h-12 bg-gray-50 border border-[#376F7E] text-[#898383] text-sm rounded-lg focus:ring-0 focus:border-[#376F7E] block w-full md:w-2/3 lg:w-full p-2.5 ml-auto placeholder:text-xs"
                          placeholder="Confirm Password" :required="form.new_password !== ''" :disabled="!isEditing" />
                        <span class="absolute inset-y-0 right-2 lg:right-4 pr-2 lg:pr-6 -top-1/4 flex items-center cursor-pointer"
                          @click="togglePassword('confirm')">
                          <img
                            :src="showConfirmPassword ? '/img/assets/icon/icon_show_eye.svg' : '/img/assets/icon/icon_hide_eye.svg'"
                            alt="eye icon" class="h-6 w-6">
                        </span>
                        <a :href="route('auth.verify')" class="text-end block text-[#4F7AE8] mt-2 cursor-pointer">Verify
                          email</a>
                      </td>
                    </tr>

                    <!-- Phone Number -->
                    <tr class="bg-white border-b">
                      <th scope="row" class="py-4 font-medium text-[#898383] whitespace-nowrap">
                        <label for="phone" class="flex items-center mb-2 text-[12px] lg:ext-lg font-medium text-[#898383]">Phone
                          Number</label>
                      </th>
                      <td class="py-4">
                        <input v-model="form.phone" type="text" id="phone" name="phone"
                          class="h-12 bg-gray-50 border border-[#376F7E] text-[#898383] text-sm rounded-lg focus:ring-0 focus:border-[#376F7E] block w-full md:w-2/3 lg:w-full p-2.5 ml-auto"
                          placeholder="Your Phone Number" :disabled="!isEditing" />
                      </td>
                    </tr>

                    <!-- Address: Province and City -->
                    <tr class="bg-white">
                      <th scope="row" class="py-4 font-medium text-[#898383] whitespace-nowrap">
                        <label for="address"
                          class="flex items-center mb-2 text-[12px] lg:text-lg font-medium text-[#898383]">Address</label>
                      </th>
                      <td class="py-4">
                        <div class= "w-full md:w-2/3 lg:w-full flex ml-auto">
                          <input v-model="form.address.province" type="text" id="province" name="province"
                            class="h-12 bg-gray-50 border border-[#376F7E] text-[#898383] text-sm rounded-lg focus:ring-0 focus:border-[#376F7E] block w-full md:w-2/3 lg:w-full p-2.5"
                            placeholder="Your Province" :disabled="!isEditing" />
                          <input v-model="form.address.city" type="text" id="city" name="city"
                            class="h-12 bg-gray-50 border border-[#376F7E] text-[#898383] text-sm rounded-lg focus:ring-0 focus:border-[#376F7E] block w-full md:w-2/3 lg:w-full p-2.5 ml-1"
                            placeholder="Your City" :disabled="!isEditing" />
                        </div>
                      </td>
                    </tr>

                    <!-- Postal Code -->
                    <tr class="bg-white">
                      <th scope="row"></th>
                      <td class="py-4">
                        <input v-model="form.address.postal_code" type="text" id="postal_code" name="postal_code"
                          class="h-12 bg-gray-50 border border-[#376F7E] text-[#898383] text-sm rounded-lg focus:ring-0 focus:border-[#376F7E] block w-full md:w-2/3 lg:w-full p-2.5 ml-auto"
                          placeholder="Your Postal Code" :disabled="!isEditing" />
                      </td>
                    </tr>

                    <!-- Address Details -->
                    <tr class="bg-white">
                      <th scope="row"></th>
                      <td class="py-4">
                        <textarea v-model="form.address.address" id="address" name="address" rows="5"
                          class="h-24 bg-gray-50 border border-[#376F7E] text-[#898383] text-sm rounded-lg focus:ring-0 focus:border-[#376F7E] block w-full md:w-2/3 lg:w-full p-2.5 ml-auto"
                          placeholder="Your Address" :disabled="!isEditing"></textarea>
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
import { ref, reactive, onMounted } from 'vue';
// import { Inertia } from '@inertiajs/inertia';
import Layout from '../../Layouts/Customer.vue';

export default {
  components: {
    Layout,
  },
  setup() {
    // Data dummy sementara
    const dummyData = {
      photo: '/img/default-profile.jpg', // Ganti dengan path gambar default
      fullname: 'John Doe',
      date_of_birth: '1990-01-01',
      gender: 'male',
      email: 'john.doe@example.com',
      phone: '1234567890',
      address: {
        province: 'DKI Jakarta',
        city: 'Jakarta Selatan',
        postal_code: '12345',
        address: 'Jalan Raya No. 123',
      },
    };

    // State reaktif untuk form
    const form = reactive({ ...dummyData, old_password: '', new_password: '', new_password_confirmation: '' });
    const originalData = { ...dummyData }; // Simpan data asli untuk cancel
    const isEditing = ref(false);
    const showOldPassword = ref(false);
    const showNewPassword = ref(false);
    const showConfirmPassword = ref(false);
    const defaultPhoto = '/img/default-profile.jpg'; // Path gambar default

    // Fungsi untuk mengganti foto
    const handlePhotoChange = (event) => {
      const file = event.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
          form.photo = e.target.result; // Preview gambar
        };
        reader.readAsDataURL(file);
      }
    };

    // Toggle visibility password
    const togglePassword = (field) => {
      if (field === 'old') showOldPassword.value = !showOldPassword.value;
      else if (field === 'new') showNewPassword.value = !showNewPassword.value;
      else if (field === 'confirm') showConfirmPassword.value = !showConfirmPassword.value;
    };

    // Edit mode
    const edit = () => {
      isEditing.value = true;
    };

    // Cancel edit
    const cancel = () => {
      isEditing.value = false;
      Object.assign(form, originalData); // Kembalikan ke data asli
      form.old_password = '';
      form.new_password = '';
      form.new_password_confirmation = '';
    };

    // Submit form (contoh dengan Inertia, bisa diganti dengan fetch API)
    const submitForm = () => {
      const formData = new FormData();
      Object.keys(form).forEach((key) => {
        if (key === 'address') {
          formData.append('province', form.address.province);
          formData.append('city', form.address.city);
          formData.append('postal_code', form.address.postal_code);
          formData.append('address', form.address.address);
        } else if (key === 'photo' && form.photo && form.photo !== originalData.photo) {
          formData.append('photo', document.querySelector('input[type="file"]').files[0]);
        } else {
          formData.append(key, form[key]);
        }
      });

      Inertia.patch(route('auth.profile'), formData, {
        onSuccess: () => {
          isEditing.value = false;
          Object.assign(originalData, { ...form }); // Update data asli setelah sukses
        },
      });
    };

    // Contoh fetching API (uncomment dan sesuaikan endpoint)
    const fetchProfileData = async () => {
      try {
        const response = await fetch('/api/profile'); // Ganti dengan endpoint API Anda
        const data = await response.json();
        Object.assign(form, data);
        Object.assign(originalData, data);
      } catch (error) {
        console.error('Error fetching profile:', error);
      }
    };

    onMounted(() => {
      // fetchProfileData(); // Uncomment untuk fetch data dari API
    });

    return {
      form,
      isEditing,
      showOldPassword,
      showNewPassword,
      showConfirmPassword,
      defaultPhoto,
      handlePhotoChange,
      togglePassword,
      edit,
      cancel,
      submitForm,
      route,
    };
  },
};
</script>

<style scoped>
/* Tambahkan gaya khusus jika diperlukan */
</style>