<template>
    <div>
        <h1>Work in progress</h1>
        <p>Sito in costruzione</p>
    </div>
</template>

<script>
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
            axios.get('http://127.0.0.1:8001/api/post')
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