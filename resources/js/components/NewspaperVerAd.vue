<template>
    <div>
        <div v-for="item in ad" style="margin-top: 10px">
            <a :href="'/advertising/redirect/'+item.id">
                <img class="ad d-none d-xl-block" :src="'/storage/ad/'+item.banner_path" />
                <img class="ad d-none d-lg-block d-xl-none" style="width: 100px;" :src="'/storage/ad/'+item.banner_path" />
                <img class="ad d-block d-lg-none" style="width: 90px;" :src="'/storage/ad/'+item.banner_path" />
            </a>
        </div>
    </div>
</template>

<script>
    export default {
        name: "NewsPaperVerAd",
        mounted(){
            axios.get('/api/newspaperVerAd')
                .then(res => {
                    this.ad = res.data ;
                })
                .catch(res => {

                })
        },
        data(){
            return{
                ad : '',
            }
        },
    }
</script>

<style scoped>

    .ad{
        cursor: pointer;
    }

</style>
