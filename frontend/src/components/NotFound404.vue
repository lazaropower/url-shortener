<template>
    <div class="flex-container">
        <h1>404</h1>
        <h2>We couldn't find the original URL.</h2>
        <router-link to="/" class="button">
            ← Back Home
        </router-link>
    </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';

export default defineComponent({

});

</script>

<style scoped>
h1 {
    font-size: 100px;
}

div {
    display: flex;
    flex-direction: column;
    align-items: center;
}
</style>