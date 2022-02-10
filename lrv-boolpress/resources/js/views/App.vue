<template>
    <div>
        <Header />

        <main>
            <!-- component matched by the route will render here -->
            <router-view></router-view>
        </main>

        <footer>Footer Here</footer>
    </div>
</template>

<script>
import Header from '../components/Header.vue';
import axios from 'axios';

export default {
    name: 'App',
    components: {
        Header,
    },
}
</script>

<style lang="scss">
    
</style>