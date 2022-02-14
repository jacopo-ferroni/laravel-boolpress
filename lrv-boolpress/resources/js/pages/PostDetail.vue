<template>
    <section class="container">
        <div v-if="post">
            <h1 class="mb-5">{{post.title}}</h1>

            <h4 v-if="post.category">Category: {{post.category.name}}</h4>
            <h4 v-else>Non ci sono categorie</h4>

            <img :src="post.cover" alt="" srcset="">

            <div class="mb-5">
                <h4>Tags:</h4>
                <span class="badge badge-primary mr-2" v-for="tag in post.tags" :key="`tag-${tag.id}`">
                    {{tag.name}}
                </span>
            </div>

            <h4>Descrizione</h4>
            <p>{{post.content}}</p>
        </div>

        <div v-else>
            Stiamo caricando i dettagli del post... ci scusiamo per l'attesa
        </div>
    </section>
</template>

<script>
import axios from 'axios';

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