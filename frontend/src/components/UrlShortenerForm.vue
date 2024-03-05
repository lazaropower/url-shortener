<template>
  <div>
    <h2>URL Shortener</h2>
    <form @submit.prevent="submitForm">
      <label for="originalUrl">Enter URL:</label>
      <input
        type="url"
        id="originalUrl"
        v-model="originalUrl"
        placeholder="https://example.com"
        required
      />
      <button type="submit">Submit</button>
    </form>

    <div v-if="shortenedUrl">
      <p>Shortened URL: {{ shortenedUrl }}</p>
    </div>

    <div v-if="error">
      <p>Error: {{ error }}</p>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import apiService from '@/services/ApiService';
import type { AxiosError } from 'axios';

interface UrlShortenerFormProps {
  originalUrl: string;
  shortenedUrl: string;
  error: string;
}

export default defineComponent({
  data() {
    return {
      originalUrl: '',
      shortenedUrl: '',
      error: ''
    } as UrlShortenerFormProps;
  },
  methods: {
    async submitForm() {
      try {
        this.shortenedUrl = await apiService.shortenUrl(this.originalUrl);
        this.error = '';
      } catch (error: any) {
        console.error(error);
        this.error = error.message;
        this.shortenedUrl = '';
      }
    }
  }
});
</script>

<style scoped>
/* Add your styling here */
</style>
