<template>
  <h1>URL Shortener</h1>
  <h2>Enter your url, folder and press submit and we will shorten it for you!</h2>
  <form @submit.prevent="submitForm">
    <div v-if="shortenedUrl">
      <a :href="originalUrl">{{ shortenedUrl }}</a>
    </div>
    <input type="url" v-model="originalUrl" placeholder="https://example.com" required />
    <input type="text" maxLength="30" v-model="folder" placeholder="Your folder name, for example 'johndoe'" required />
    <div v-if="error">
      <p class="error">{{ error }}</p>
    </div>
    <button type="submit">Submit</button>
  </form>
</template>

<script lang="ts">
import { defineComponent, onMounted } from 'vue';
import apiService from '@/services/ApiService';

interface UrlShortenerFormProps {
  originalUrl: string;
  folder: string;
  shortenedUrl: string;
  error: string;
}

export default defineComponent({
  data() {
    return {
      originalUrl: '',
      folder: '',
      shortenedUrl: '',
      error: ''
    } as UrlShortenerFormProps;
  },
  methods: {
    async submitForm() {
      try {
        this.shortenedUrl = await apiService.shortenUrl(this.originalUrl, this.folder);

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

<style>
p {
  color: #333333;
  font-size: 18px;
}

input {
  margin-top: 20px;
  padding: 15px;
  width: 600px;
  margin-bottom: 10px;
  border-radius: 8px;
  border: 1px solid #cccccc;
  font-size: 16px;
}

button {
  margin-top: 20px;
  border-radius: 8px;
  background-color: #42b883;
  color: #213547;
  font-weight: 600;
  padding: 10px 30px;
  font-size: 16px;
  border: none;
  cursor: pointer;
  transition: 0.3s ease;
}

button:hover {
  background: #4fd89a;
}

.error {
  color: #f04f4f;
}

form {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}

@media screen and (max-width: 600px) {
  input {
    max-width: 100%;
  }

  form {
    max-width: 100%;
  }

  .error {
    font-size: 16px;
  }
}
</style>
