<template>
    <div>
        <div v-for="item in news" class="row text-right" style="background-color:#ffffff;border:1px solid #cccccc;border-radius:4px;margin: 0;">
            <div class="col-12" style="padding:0">
                <img style="padding:0;max-height:400px;" :src="'/storage/thumbnail_post/'+item.thumbnail_path" class="col-12" />
                <div class="col-12" style="padding:15px 15px;background-color:rgba(0,0,0,.5); color:#ffffff;position:absolute; bottom:0;left:0;">
                    <h5><a :href="'/news/'+item.id+'/'+item.slug">{{item.title}}</a></h5>
                    {{item.introduce}}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ValidationEmail",
        props:['news'],
    }
</script>

<style scoped>

a{
    color:#ffffff;
    text-decoration:none;
}
</style>
