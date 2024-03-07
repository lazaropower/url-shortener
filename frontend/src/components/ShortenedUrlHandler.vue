<template>
  <div>
    <h2>Loading...</h2>
  </div>
</template>

<script lang="ts">
import apiService from '@/services/ApiService';
import { defineComponent, onMounted } from 'vue';
import { useRouter } from 'vue-router';

export default defineComponent({
  setup() {
    const router = useRouter();
    onMounted(async () => {
      try {
        // Extract the hash and folder from the URL
        const hash = router.currentRoute.value.params.hash;
        const folder = router.currentRoute.value.params.folder;

        // Fetch the original URL from Back-End
        const originalUrl = await apiService.fetchOriginalUrl(hash as string, folder as string);

        // Open original URL
        window.location.href = originalUrl;

      } catch (error) {
        // In case of error render 404 page
        router.push('/404');
      }
    });
  }
});

</script>

<style></style>
