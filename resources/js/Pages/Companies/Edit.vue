<template>
    <div class="container mx-auto p-8">
      <h1 class="text-4xl font-bold mb-8">Edit Company</h1>

      <div class="flex justify-between items-center mb-8">
        <h2 class="text-2xl font-bold">Edit Movie</h2>
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

          <button class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-colors duration-300" type="submit">Save Company</button>
        </form>
      </div>
    </div>
  </template>

  <script setup>
  import { Head, Link, useForm } from '@inertiajs/vue3';
  import { reactive } from 'vue';


  const props = defineProps({
    company: Object
  });

  const form = useForm({
    name: props.company.name,
    description: props.company.description,
    address: props.company.address
  });

  function submit() {
    form.patch('/companies/' + props.company.id);
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
