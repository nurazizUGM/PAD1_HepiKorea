<template>
    <Layout title="Profile">
      <div class="p-8 border-2 bg-[#EFEFEF] border-gray-200 rounded-2xl dark:border-gray-700 h-full overflow-y-auto">
        <div class="rounded-2xl flex flex-col bg-white p-10">
          <h1 class="text-black text-2xl font-semibold">Profile Detail</h1>
          <div class="grid gap-x-16 grid-cols-[2fr_4fr] mt-6">
            <div class="bg-white h-auto flex flex-col rounded-xl mt-4">
              <div class="rounded-xl bg-slate-300">
                <img class="w-full min-h-[10rem] m-0 p-2 object-contain object-center" id="profile_picture"
                  :src="userPhoto" alt="Profile Picture">
              </div>
              <button
                class="w-[98%] h-12 mt-4 rounded-3xl bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] mx-auto p-2"
                @click="choosePhoto">
                <h1 class="text-lg text-white font-semibold">Choose Photo</h1>
              </button>
            </div>
            <div class="items-start justify-start bg-white h-auto rounded-xl">
              <form @submit.prevent="updateProfile" enctype="multipart/form-data">
                <input type="file" name="photo" id="photo" class="hidden" @change="handlePhotoChange">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                  <tbody>
                    <tr class="bg-white border-b">
                      <th scope="row" class="py-4 font-medium text-[#898383] whitespace-nowrap">
                        <label for="fullname" class="flex items-center mb-2 text-lg font-medium text-[#898383]">Name</label>
                      </th>
                      <td class="py-4">
                        <input type="text" id="fullname" v-model="user.fullname"
                          class="h-12 bg-gray-50 border border-[#376F7E] text-[#898383] text-sm rounded-lg focus:ring-0 focus:border-[#376F7E] block w-full p-2.5"
                          placeholder="Your Name" required />
                      </td>
                    </tr>
                    <tr class="bg-white border-b">
                      <th scope="row" class="py-4 font-medium text-[#898383] whitespace-nowrap">
                        <label for="date_of_birth" class="flex items-center mb-2 text-lg font-medium text-[#898383]">Date of Birth</label>
                      </th>
                      <td class="py-4 relative">
                        <input type="text" id="date_of_birth" v-model="user.date_of_birth"
                          class="h-12 bg-gray-50 border border-[#376F7E] text-[#898383] text-sm rounded-lg focus:ring-0 focus:border-[#376F7E] block w-full p-2.5"
                          placeholder="Your Birth Date" required />
                      </td>
                    </tr>
                    <tr class="bg-white border-b">
                      <th scope="row" class="py-4 font-medium text-[#898383] whitespace-nowrap">
                        <label for="gender" class="flex items-center mb-2 text-lg font-medium text-[#898383]">Gender</label>
                      </th>
                      <td class="py-4 flex" colspan="2">
                        <div class="flex items-center mr-5">
                          <input id="genderMale" type="radio" name="gender" value="male" v-model="user.gender"
                            class="w-4 h-4 border-[#376F7E] focus:ring-0" />
                          <label for="genderMale" class="block ms-2 text-base font-medium text-[#898383]">Male</label>
                        </div>
                        <div class="flex items-center">
                          <input id="genderFemale" type="radio" name="gender" value="female" v-model="user.gender"
                            class="w-4 h-4 border-[#376F7E] focus:ring-0" />
                          <label for="genderFemale" class="block ms-2 text-base font-medium text-[#898383]">Female</label>
                        </div>
                      </td>
                    </tr>
                    <tr class="border-b bg-white">
                      <th scope="row" class="py-4 font-medium text-[#898383] whitespace-nowrap">
                        <label for="email" class="flex items-center mb-2 text-lg font-medium text-[#898383]">Email</label>
                      </th>
                      <td class="py-4">
                        <input type="email" id="email" v-model="user.email"
                          class="h-12 bg-gray-50 border border-[#376F7E] text-[#898383] text-sm rounded-lg focus:ring-0 focus:border-[#376F7E] block w-full p-2.5"
                          placeholder="Your Email" disabled />
                      </td>
                    </tr>
                    <tr class="bg-white border-b">
                      <th scope="row" class="py-4 font-medium text-[#898383] whitespace-nowrap">
                        <label for="old_password" class="flex items-center mb-2 text-lg font-medium text-[#898383]">Password</label>
                      </th>
                      <td class="py-4 relative">
                        <input type="password" id="old_password" v-model="oldPassword"
                          class="h-12 bg-gray-50 border border-[#376F7E] text-[#898383] text-sm rounded-lg focus:ring-0 focus:border-[#376F7E] block w-full p-2.5"
                          placeholder="Old Password" />
                        <span class="absolute inset-y-0 right-4 pr-6 flex items-center btn-show-password" @click="togglePasswordVisibility('old_password')">
                          <img :src="passwordVisibility.old ? 'path/to/show_icon.svg' : 'path/to/hide_icon.svg'" alt="Toggle Password Visibility" class="h-6 w-6 cursor-pointer">
                        </span>
                      </td>
                    </tr>
                    <tr class="bg-white border-b">
                      <th scope="row"></th>
                      <td class="py-4 relative">
                        <input type="password" id="new_password" v-model="newPassword"
                          class="h-12 bg-gray-50 border border-[#376F7E] text-[#898383] text-sm rounded-lg focus:ring-0 focus:border-[#376F7E] block w-full p-2.5"
                          placeholder="New Password" />
                        <span class="absolute inset-y-0 right-4 pr-6 flex items-center btn-show-password" @click="togglePasswordVisibility('new_password')">
                          <img :src="passwordVisibility.new ? 'path/to/show_icon.svg' : 'path/to/hide_icon.svg'" alt="Toggle Password Visibility" class="h-6 w-6 cursor-pointer">
                        </span>
                      </td>
                    </tr>
                    <tr class="border-b bg-white">
                      <th scope="row"></th>
                      <td class="py-4 relative">
                        <input type="password" id="new_password_confirmation" v-model="newPasswordConfirmation"
                          class="h-12 bg-gray-50 border border-[#376F7E] text-[#898383] text-sm rounded-lg focus:ring-0 focus:border-[#376F7E] block w-full p-2.5"
                          placeholder="Confirm Password" />
                        <span class="absolute inset-y-0 right-4 pr-6 flex items-center btn-show-password" @click="togglePasswordVisibility('new_password_confirmation')">
                          <img :src="passwordVisibility.confirmation ? 'path/to/show_icon.svg' : 'path/to/hide_icon.svg'" alt="Toggle Password Visibility" class="h-6 w-6 cursor-pointer">
                        </span>
                      </td>
                    </tr>
                    <tr class="border-b bg-white">
                      <th scope="row" class="py-4 font-medium text-[#898383] whitespace-nowrap">
                        <label for="phone" class="flex items-center mb-2 text-lg font-medium text-[#898383]">Phone Number</label>
                      </th>
                      <td class="py-4">
                        <input type="text" id="phone" v-model="user.phone"
                          class="h-12 bg-gray-50 border border-[#376F7E] text-[#898383] text-sm rounded-lg focus:ring-0 focus:border-[#376F7E] block w-full p-2.5"
                          placeholder="Your Phone Number" />
                      </td>
                    </tr>
                    <tr class="bg-white">
                      <th scope="row" class="px-6 py-4 font-medium text-[#898383] whitespace-nowrap">
                        <label for="address" class="flex items-center mb-2 text-lg font-medium text-[#898383]">Address</label>
                      </th>
                      <td class="py-4">
                        <textarea name="address" id="address" v-model="user.address"
                          class="h-24 bg-gray-50 border border-[#376F7E] text -[#898383] text-sm rounded-lg focus:ring-0 focus:border-[#376F7E] block w-full p-2.5 resize-none"
                          placeholder="Your Address"></textarea>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <button type="submit" class="mt-4 w-full h-12 rounded-3xl bg-[#3E6E7A] hover:bg-[#37626d] active:bg-[#325862] text-white">
                  Save Changes
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </Layout>
  </template>
  
  <script setup>
  import { ref } from 'vue';
//   import { usePage } from '@inertiajs/vue3';
  
//   const { props } = usePage();
  const user = ref(props.user);
  const userPhoto = ref(user.value.photo ? props.user.photo : 'default_photo_path');
  const oldPassword = ref('');
  const newPassword = ref('');
  const newPasswordConfirmation = ref('');
  const passwordVisibility = ref({ old: false, new: false, confirmation: false });
  
  const choosePhoto = () => {
    document.getElementById('photo').click();
  };
  
  const handlePhotoChange = (event) => {
    const file = event.target.files[0];
    const reader = new FileReader();
    reader.onload = (e) => {
      userPhoto.value = e.target.result;
    };
    reader.readAsDataURL(file);
  };
  
  const togglePasswordVisibility = (field) => {
    passwordVisibility.value[field] = !passwordVisibility.value[field];
  };
  
  const updateProfile = () => {
    // Logic to update the profile using Inertia.js
    // You can use Inertia.post or Inertia.put to send the data to the server
  };
  </script>
