<template>
    <div>
      <h1>Dashboard Tenant</h1>
      <button @click="handleLogout">Logout</button>
    </div>
  </template>
  
  <script>
  import { router } from '@inertiajs/vue3';
  
  export default {
    methods: {
      handleLogout() {
        router.post('/logout');
      }
    }
  }
  </script>
  