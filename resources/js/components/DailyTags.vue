<template>

<div class="text-right row" style="margin=0; ; border-radius:5px;box-shadow:0 0 4px #000000; background-color:#ffffff">
    <div class="col-12 " style=" direction: rtl">
        <div class="col-6 col-sm-6" style="border-bottom: 2px solid lightgreen;padding:0">
                    <span>
                        <i class="fas fa-tags"></i>
                        <span>تگ های روز</span>
                    </span>
        </div>
        <ul class="list-inline">
                    <a :href="'/tag/'+item.name" v-for="item in tag">
                        <li class="list-inline-item" style="background-color:blue; position:relative; border-radius:40%;;margin: 5px 5px; font-size:12px;padding:3px" >
                            {{item.name}}
                        </li>
                    </a>
        </ul>
    </div>
</div>

</template>

<script>
    export default {
        name: "DailyTags",
        props:['tag']
    }
</script>

<style scoped>
a{
    text-decoration : none ;
    color : #ffffff;
}
ul {
    list-style:none;
    padding:0;
    margin-top:5px
}
ul a li{
    font-size:12px
}
</style>
