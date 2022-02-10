<template>
    <div>
        <div class="container text-center">
            <h1 class="m-5">Our Blog</h1>

            <div v-if="posts">
                <article class="mb-4" v-for="post in posts" :key="`post-${post.id}`">
                    <h2>{{post.title}}</h2>
                    <div mb-4>{{post.created_at}}</div>
                    <div mb-4>{{post.content}}</div>
                    <router-link class="btn btn-warning" :to="{name : 'post-detail', params : {slug : post.slug}}">Detail</router-link>
                </article>
            </div>

            <div v-else>
                Loading Posts... be quiet!
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name : 'Blog',
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

</style>