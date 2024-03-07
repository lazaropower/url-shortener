<script setup lang="ts">
</script>

<template>
  <main>
    <router-view></router-view>
  </main>
</template>

<style>
h1 {
  font-weight: 700;
  font-style: normal;
  font-size: 76px;
  line-height: 95px;
  background: linear-gradient(to right, #42d392, #5c93e4, #b4e45c, #5c93e4);
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
