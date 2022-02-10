<template>
    <div>
        <Header />

        <main>
            <!-- component matched by the route will render here -->
            <router-view></router-view>
        </main>

        <Footer />
    </div>
</template>

<script>
import Header from '../components/Header.vue';
import Footer from '../components/Footer.vue';
import axios from 'axios';

export default {
    name: 'App',
    components: {
        Header,
        Footer,
    },
}
</script>

<style lang="scss">
main {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
}
    
</style>