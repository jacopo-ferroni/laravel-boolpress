<template>
    <div>
        <div class="container text-center">
            <h1 class="m-5">Our Blog</h1>

            <div v-if="posts">
                <article class="mb-4" v-for="post in posts" :key="`post-${post.id}`">
                    <h2>{{post.title}}</h2>
                    <div mb-4>{{post.created_at}}</div>
                    <div mb-4>{{post.content}}</div>
                </article>
            </div>

            <div v-else>
                Loading Posts... be quiet!
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'App',
    components: {},
    data() {
        return {
            posts : null,
        }
    },
    created() {
        this.getPosts();
    },
    methods : {
        getPosts() {
           const axios = require('axios');

            // Make a request for a user with a given ID
            axios.get('http://127.0.0.1:8000/api/post')
            .then(response => {
                // handle success
                this.posts = response.data;
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
    div {
        h1 {
            text-transform: uppercase;
        }
    }

</style>