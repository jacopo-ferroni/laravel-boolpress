<template>
    <section class="container">
        <div v-if="post">
            <h1 class="mb-5">{{post.title}}</h1>

            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Atque maxime dolore minus dolorum illo maiores iure deleniti doloribus placeat fugiat est, voluptate, cupiditate modi assumenda inventore neque perferendis reiciendis fugit?</p>
        </div>

        <div v-else>
            Stiamo caricando i dettagli del post... ci scusiamo per l'attesa
        </div>
    </section>
</template>

<script>

export default {
    name : 'PostDetail',
    data() {
        return {
            post : null,
        }
    },
    created() {
        this.getPostDetail();
    },
    methods : {
        getPostDetail() {
            const axios = require('axios');

            // Make a request for a user with a given ID
            axios.get(`127.0.0.1:8000/api/posts/${this.$route.params.slug}`)
            .then(response => {
                // handle success
                console.log(response);
                this.post = response.data;
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
            .then(function () {
                // always executed
            });
        }
    }
}
</script>

<style lang="scss">
</style>