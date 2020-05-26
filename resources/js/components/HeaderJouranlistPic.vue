<template>

    <a style="text-decoration:none;color: #ffffff" href="/profile">
        <span> {{ user_name }}</span>
        <img :src="image" style="border-radius:50%; width: 27px; height: 27px; vertical-align: middle"/>
    </a>

</template>

<script>
    export default {
        name: "HeaderJouranlistPic",
        props:['img','name'],
        data(){
            return{
                image:'',
                user_name:'',
            }
        },
        mounted() {
            this.image='/storage/journalist/'+this.img;
            this.user_name=this.name;

        },
    }
</script>

<style scoped>

</style>
