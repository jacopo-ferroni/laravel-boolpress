<template>
    <section class="container">
        <div v-if="post">
            <h1 class="mb-5">{{post.title}}</h1>

            <p>{{post.content}}</p>
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
            axios.get(`http://127.0.0.1:8000/api/posts/${this.$route.params.slug}`)
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