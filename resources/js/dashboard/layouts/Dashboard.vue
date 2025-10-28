<template>
    <div class="bg-base-200 min-h-screen relative pb-20">
        <Header />
        <Navbar />
      
        <RouterView /> 

    </div>
</template>

<script setup>
 
// import { useAuthStore } from '@/stores/auth';
 
// const currentTenant = useAuthStore().tenant
// const currentUser = useAuthStore().user
</script>