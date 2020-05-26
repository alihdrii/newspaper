<template>

    <div class="text-right">

        <div class="row" style="margin=0;margin-top:10px;box-shadow:0 0 4px #000000;">
            <div class="col-12 " style="background-color: #ffffff; direction: rtl; border-radius:5px;">
                <div class="col-6 col-sm-6" style="border-bottom: 2px solid lightgreen;padding:0">
                    <span>
                        <i class="fas fa-newspaper"></i>
                        new news
                    </span>
                </div>
                <ul>
                    <li v-for="item in news">
                        <a :href="'news/'+item.slug">
                                <i style="font-size:9px" class="fas fa-angle-double-left"></i>
                                {{item.title}}

                        </a>
                        <span style="float:left; font-size:10px;color:#cccccc">
                            {{item.time_age}}
                        </span>
                    </li>

                </ul>
            </div>
        </div>

    </div>

</template>

<script>
    export default {
        name: "PageNewNews",
        props:['news']
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
