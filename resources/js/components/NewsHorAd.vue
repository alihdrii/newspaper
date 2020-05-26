<template>
    <div class="row justify-content-center">
        <div v-for="item in ad" style="margin-top: 10px">
            <a :href="'/advertising/redirect/'+item.id">
                <img  class="d-none d-xl-block ad" style="height: 80px; width:280px" :src="'/storage/ad/'+item.banner_path" />
                <img  class="d-block d-xl-none ad" style="height: 60px; width:230px" :src="'/storage/ad/'+item.banner_path" />
            </a>
        </div>
    </div>
</template>

<script>
    export default {
        name: "NewsHorAd",
        mounted(){
            axios.get('/api/newsHorAd')
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
