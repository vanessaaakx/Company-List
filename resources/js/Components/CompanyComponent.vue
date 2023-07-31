<template>
    <div class="company-card" :class="{ 'company-card--enabled': company.enabled }" @click="openCompany">
      <img :src="company.picUrl" alt="Product photo" class="aspect-square w-full object-cover mb-4">

      <h4 class="text-2xl font-bold">Company Name: {{ company?.name }}</h4>
      <p class="text-gray-500">Description: {{ company?.description }}</p>
      <p class="text-gray-500">Address: {{ company?.address }}</p>

      <div class="flex justify-between mt-4 items-center">
        <label class="flex items-center space-x-2 cursor-pointer">
          <input type="checkbox" :checked="company.enabled" @change.prevent="toggleEnabled(company)" class="w-5 h-5 appearance-none rounded-full bg-gray-300 focus:outline-none">
          <span class="text-sm text-gray-600">Enabled</span>
        </label>
        <button @click.stop="openCompany" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-colors duration-300">View Details</button>
      </div>
    </div>
  </template>

  <script setup>
  import { defineProps } from 'vue';
  import { router } from '@inertiajs/vue3';

  const prop = defineProps({
    company: Object
  });

  function openCompany() {
    router.visit('/companies/' + prop.company.id);
  }

  function toggleEnabled(company) {
    company.enabled = !company.enabled; // Toggle the enabled state locally
    router.visit('/companies/toggle/' + company.id, {
      method: 'post',
      preserveScroll: true
    });
  }
  </script>

  <style scoped>
  /* Styles for CompanyCard component */
  .company-card {
    background-color: white;
    padding: 1.5rem;
    border-radius: 0.5rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    cursor: pointer;
    transition: background-color 0.2s ease-in-out;
  }

  .company-card:hover {
    background-color: #f7fafc;
  }

  .company-card--enabled {
    background-color: #edf2f7;
  }

  .company-card img {
    width: 100%;
    aspect-ratio: 1/1;
    object-fit: cover;
    margin-bottom: 1rem;
  }

  .company-card h4 {
    font-size: 1.5rem;
  }

  .company-card .text-gray-500 {
    color: #718096;
  }

  /* Tailwind CSS classes */
  /* ... (you can remove the original CSS classes and use Tailwind classes instead) */
  </style>
