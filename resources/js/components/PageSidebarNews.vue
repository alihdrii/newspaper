<template>

    <div class="text-right">
        <div class="row" style="margin=0;margin-top:10px;box-shadow:0 0 4px #000000;">
            <div class="col-12 " style="background-color: #ffffff; direction: rtl; border-radius:5px;">
                <div class="col-6 col-sm-6" style="border-bottom: 2px solid lightgreen;padding:0">
                    <span>
                        <i :class="news.icon"></i>
                        {{news.name}}
                    </span>
                </div>
                <ul>
                    <li v-for="item in temp">
                        <a :href="'news/'+item.id+'/'+item.slug">
                                <i style="font-size:9px" class="fas fa-angle-double-left"></i>
                                {{item.title}}
                        </a>
                    </li>
                    <li v-if="more" class="text-center">

                        <i v-if="!load" @click="clickMore" class="fas fa-plus" style="cursor:pointer"></i>
                        <i v-else style="color: #000000;" class="fas fa-spinner fa-spin"></i>

                    </li>
                </ul>
            </div>
        </div>

    </div>

</template>

<script>
    export default {
        name: "PageSidebarNews",
        props:['news','more_news'],
        data(){
            return{
                temp: [],
                more: '',
                load: false,
                skip: 0
            }
        },
        mounted(){
            this.temp = this.news.news;
            this.more = this.more_news;
        },
        methods:{
            clickMore(){
                this.load = true;
                this.skip = this.skip+1
                axios.post('/get_more_news',{
                    skip : this.skip ,
                    id : this.news.id
                })
                .then(response=>{

                    for(var i=0;i< response.data.news.length;i++)
                    {
                         this.temp.push(response.data.news[i]);
                    }
                    this.more= response.data.more_news;
                    this.load = false ;

                })
                .catch(
                    this.load = false,
                )
            },
        }
    }
</script>

<style scoped>
a{
    text-decoration : none ;
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
