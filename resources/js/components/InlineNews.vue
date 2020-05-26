<template>
    <div>
        <div v-for="item in news" class="row text-right" style="border:1px solid #cccccc;border-radius:4px;margin:5px 0;">
            <div class="col-9">
                <h6>
                    <a :href="'/news/'+item.id+'/'+item.slug">
                        {{item.title}}
                    </a>
                </h6>
                <div style="font-size:13px">
                    {{item.introduce}}
                </div>
            </div>
            <div class="col-3" style="padding:0">
                <img style="padding:0;height:100%" :src="'/storage/thumbnail_post/'+item.thumbnail_path" class="col-12" />
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        name: "InlineNews",
        mounted(){
            axios.get('/api/newspaperHotNews')
                .then(res=>{
                    this.news = res.data;
                })
                .catch(res=>{

                })
        },
        data(){
            return {
                news : '',
            }
        }

    }
</script>

<style scoped>

a{
    text-decoration:none;
    color:#000000
}
</style>
