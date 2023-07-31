<template>
    <div>
      <Head :title="`View Company | ${company.name}`" />

      <AppLayout>
        <template #header>
          <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold">View Company | {{ company.name }}</h2>
            <div class="flex space-x-2">
              <Link :href="'/companies/email/' + company.id" class="btn-primary">Send Email</Link>
              <a
                :href="'/companies/pdf/' + company.id"
                target="_blank"
                class="btn-secondary"
              >
                <svg
                  fill="#ffffff"
                  width="20px"
                  height="20px"
                  viewBox="0 0 1920 1920"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <!-- SVG path for the export icon (you can replace with your own icon or use Font Awesome icons) -->
                </svg>
                Export
              </a>
            </div>
          </div>
        </template>

        <div class="py-6">
          <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white shadow rounded-lg p-8 flex items-center space-x-8">
            <div class="w-32 h-32 rounded-full overflow-hidden">
              <img :src="company.picUrl" alt="Product photo" class="object-cover w-full h-full">
            </div>
            <div class="flex flex-col">
              <h4 class="text-3xl mb-4 font-bold">Company Name: {{ company.name }}</h4>
              <h4 class="text-2xl mb-2 font-bold">Description:</h4>
              <div class="p-4 bg-gray-100 rounded-lg shadow-md mb-4">
                {{ company.description }}
              </div>
              <h4 class="text-2xl mb-2 font-bold">Address:</h4>
              <div class="p-4 bg-gray-100 rounded-lg shadow-md">
                {{ company.address }}
              </div>
            </div>
          </div>
          <div class="flex justify-end mt-4">
            <Link class="btn-primary mr-3" :href="'/companies/edit/' + company.id" as="button">Edit</Link>
            <Link
              :href="`/companies/` + company.id"
              method="delete"
              class="btn-danger"
            >
              Delete
            </Link>
          </div>
        </div>
      </AppLayout>
    </div>
  </template>

  <script setup>
  import { defineProps } from 'vue'
  import { Link, Head } from '@inertiajs/vue3'
  import AppLayout from '@/Layouts/AppLayout.vue'

  const props = defineProps({
    company: Object,
  })
  </script>

  <style scoped>
  /* Custom styles using Tailwind CSS utility classes */
  .btn-primary {
    @apply px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600;
  }

  .btn-secondary {
    @apply px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600;
  }

  .btn-danger {
    @apply px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 mr-10;
  }
  </style>
