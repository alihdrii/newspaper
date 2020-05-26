<template>
    <div class="row text-right" style=" direction:rtl;box-shadow:0 0 4px #000000; border-radius:5px; background-color:#ffffff"">
        <div class="col-9 text-right" style="border-bottom: 2px solid lightgreen;padding:5px;">
                    <span>
                        <i class="fas fa-tags"></i>
                        <span>best </span>
                    </span>
        </div>
        <div v-for="user in journalist" class="col-12 text-center" style="margin-top:5px; margin-bottom:5px;padding:0 7px">
            <a href="#">
                <img :src="'/storage/journalist/'+user.user_img_path" style="border-radius:50%; width: 30px; height: 30px; vertical-align: middle"/>
            </a>
            <div>{{user.followers_count}} follower </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "SideBarBestJournalist",
        props:['journalist']
    }
</script>

<style scoped>
a{
    text-decoration : none;
    color : #000000;
}
ul {
    list-style:none;
    padding:0;
    margin-top:5px
}
ul li{
    font-size:13px
}
</style>
