<template>

    <div class="text-right">

        <div v-for="item in news" class="row" style="margin=0;margin-top:10px;box-shadow:0 0 4px #000000;">
            <div class="col-12 " style="background-color: #ffffff; direction: rtl; border-radius:5px;">
                <div class="col-6 col-sm-6" style="border-bottom: 2px solid lightgreen;padding:0">
                    <span>
                        <i :class="item.icon"></i>
                        {{item.name}}
                    </span>
                </div>
                <ul>
                    <li v-for="subItem in item.news">
                        <a :href="'/news/'+subItem.id+'/'+subItem.slug">
                            <i style="font-size:9px" class="fas fa-angle-double-left"></i>
                            {{subItem.title}}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: "SlidebarNews",
        mounted() {
            axios.get('/api/newspaperSlidebarNews')
                .then(res=>{
                    this.news=res.data;
                })
                .catch(res=>{

                })
        },
        data(){
            return{
                news:''
            }
        }
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
