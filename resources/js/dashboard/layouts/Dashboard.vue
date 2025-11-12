<template>
    <div class="bg-base-200 min-h-screen relative ">
        <Header />
        <Navbar />
      
        <div class="min-h-[calc(100vh-177px)]">
          <RouterView /> 
        </div>
        <footer class="bg-black/10 p-2 text-center text-xs text-gray-400 mt-10">
          بروشور  © 2025 
          <a href="https://broshur.com" class="text-blue-800 hover:text-blue-900 ms-2 inline-flex items-center gap-x-1">بروشور 
            <img src="/assets/images/broshur-logo-shape.webp" alt="بروشور" class="h-4" /> 
          </a>
        </footer>
        <notifications position="top right" :duration="1000"   />


    </div>
</template>

<script setup>
 
// import { useAuthStore } from '@/stores/auth';
 
// const currentTenant = useAuthStore().tenant
// const currentUser = useAuthStore().user
</script>

<style >
.vue-notification {
  text-align: right;
  margin: 0 5px 5px;
  padding: 10px;
  font-size: 12px;
  color: #ffffff;
 
  background: #44a4fc;
  border-right: 5px solid #187fe7;
  border-left:0;
 
  &.success {
    background: #68cd86;
    border-right-color: #42a85f;
  }

  &.warn {
    background: #ffb648;
    border-right-color: #f48a06;
  }

  &.error {
    background: #e54d42;
    border-right-color: #b82e24;
  }
}
</style>