<template>
    <div class="container mx-auto p-8">
      <h1 class="text-4xl font-bold mb-8">Add Company</h1>

      <div class="flex justify-between items-center mb-8">
        <h2 class="text-2xl font-bold">Add Company</h2>
        <a href="/companies" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-colors duration-300">Back</a>
      </div>

      <div class="bg-gray-100 p-8 rounded-md">
        <form @submit.prevent="submit" class="space-y-4">
          <div class="form-group">
            <InputLabel for="name" value="Name" />
            <TextInput id="name" v-model="form.name" />
            <InputError :message="form.errors.name" v-if="form.errors.name" />
          </div>

          <div class="form-group">
            <InputLabel for="description" value="Description" />
            <textarea id="description" v-model="form.description" class="textarea"></textarea>
            <InputError :message="form.errors.description" v-if="form.errors.description" />
          </div>

          <div class="form-group">
            <InputLabel for="address" value="Address" />
            <textarea id="address" v-model="form.address" class="textarea"></textarea>
            <InputError :message="form.errors.address" v-if="form.errors.address" />
          </div>

          <div class="form-group">
            <InputLabel for="email" value="Email" />
            <TextInput id="email" type="email" v-model="form.email" />
            <InputError :message="form.errors.email" v-if="form.errors.email" />
          </div>

          <div class="form-group">
            <InputLabel for="pic" value="Picture" />
            <input type="file" @input="form.pic = $event.target.files[0]" accept="image/jpeg" />
            <progress v-if="form.progress" :value="form.progress.percentage" max="100">
              {{ form.progress.percentage }}%
            </progress>
          </div>

          <button class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-colors duration-300">Add Company</button>
        </form>
      </div>
    </div>
  </template>

  <script setup>
  import InputError from '@/Components/InputError.vue';
  import InputLabel from '@/Components/InputLabel.vue';
  import TextInput from '@/Components/TextInput.vue';
  import { useForm } from '@inertiajs/vue3';

  const form = useForm({
    name: null,
    description: null,
    address: null,
    email: '',
    pic: null,
  });

  function submit() {
    form.post('/companies');
  }
  </script>

  <style scoped>
  /* Styles for CompanyCard component */
  .container {
    max-width: 800px;
  }

  .textarea {
    resize: vertical;
  }

  /* You can add more Tailwind classes or customize the styles here as needed. */
  </style>
