<script setup lang="ts">
import UrlShortenerForm from './components/UrlShortenerForm.vue';
</script>

<template>
  <main>
    <h1>URL Shortener</h1>
    <h2>Enter your url, press submit and we will shorten it for you!</h2>
    <UrlShortenerForm />
  </main>
</template>

<style>
  h1 {
    font-weight: 700;
    font-style: normal;
    font-size: 76px;
    line-height: 95px;
    background: linear-gradient(to right, #42D392, #5C93E4, #b4e45c, #5C93E4);
    -webkit-text-fill-color: transparent;
    -webkit-background-clip: text;
    background-clip: text;
    margin-bottom: 20px;
  }

  h2 {
    margin-bottom: 20px;
  }

  main {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100vh;
    width: 100vh;
  }

  @media screen and (max-width: 600px) {
    h1 {
      font-size: 40px; 
      line-height: 45px;
    }

    h2 {
      font-size: 18px;
    }

    main {
      padding-right: 20px;
      padding-left: 20px;
      justify-content: flex-start;
      align-items: flex-start;
    }
  }

</style>
