<template>
    <div>
        <div v-for="item in ad" style="margin-top: 5px;position:relative">
                <a :href="'/advertising/redirect/'+item.id">
                    <img style="height: 30px; width:100%" :src="'/storage/ad/'+item.banner_path" />
                </a>
        </div>
    </div>
</template>

<script>
    export default {
        name: "MobileBottomAd",
        props:['ad'],
    }
</script>

<style scoped>

    .ad{
        cursor: pointer;
    }

</style>
