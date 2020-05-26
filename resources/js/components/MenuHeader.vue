<template>
    <div class="container" style="font-weight:500">
        <div class="row justify-content-center">
            <div class="col-lg-12">

                <div class="d-sm-none d-lg-block float-lg-left" >
                    <div class="search" style="padding: 8px">
                        <input type="text" class="searchTerm" placeholder="جستجو">
                        <button type="submit" class="searchButton">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>


                <ul class="row list-inline d-flex float-lg-right justify-content-between " style="margin-bottom: 0; direction: rtl">

                        <li class="list-inline-item" v-for="item in menuItems" :class="{activeborder:activePlace(item.name)}">
                            <a :href=item.url :class="{active:activePlace(item.name)}">
                                <div class="icon">
                                    <i :class="item.icon"></i>
                                </div>
                                <span>{{item.show}}</span>
                            </a>
                        </li>

                        <li class="list-inline-item" v-for="cats in category" :class="{activeborder:activePlace(cats.slug)}">
                            <a :href="'/'+cats.slug" :class="{active:activePlace(cats.slug)}">
                                <div class="icon">
                                <i :class="cats.icon"></i>
                                </div>
                                <span>{{cats.name}}</span>
                            </a>
                        </li>

                    </ul>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "MenuHeader",
        props:['place'],
        mounted(){
            axios.get('/api/category')
                .then(res => {
                    this.category = res.data ;
                })
                .catch(res => {

                })
        },
        data(){
            return{
                category:'',
                menuItems : [
                    {
                        show : 'خانه',
                        name : 'home',
                        icon : 'fas fa-home',
                        url: '/'

                    },
                    {
                        show : 'ویدیو',
                        name : 'video',
                        icon : 'fas fa-camera',
                        url: '/video'
                    }
                ],
            }
        },
        methods:{
            activePlace(item){
                if(this.place===item)
                    return true;
                return false;
            }
        }
    }
</script>

<style scoped>

    .col-sm-9{
padding-right:0;
        padding-left:0;
     }
ul{
    padding-right:0;
    padding-left:0;
}
ul li {
    height: 100%;
    width:60px;
    text-align : center;
    position: relative;
    padding:10px;
}
.activeborder{
    border-bottom: 3px solid lightgreen;
}
.active{
    color: lightgreen;
}
.active .icon{
    transform: translateY(-10px);
    opacity: 1;
}
.active span{
    transform: translateY(12px);
}
ul li .icon {
    width : 100%;
    text-align: center;
    opacity: 0;
    transition: all .3s;
}
ul li span {
    width:100%;
    text-align: center;
    position : absolute;
    top:9px ;
    left:0;
    transition:all .3s;
}
ul li:hover{
    border-bottom: 3px solid lightgreen;
}
ul li:hover .icon{
    transform: translateY(-10px);
    opacity: 1;
    color: lightgreen;
}

ul li:hover span{
    transform: translateY(12px);
    color : lightgreen;
}
 a {
     text-decoration: none;
     color: #ffffff
 }
div {
    font-size:1rem
}

.search {
    width: 100%;
    position: relative;
    display: flex;
}

.searchTerm {
    width: 100%;
    border: 3px solid #00B4CC;
    border-right: none;
    padding: 5px;
    height: 30px;
    border-radius: 5px 0 0 5px;
    outline: none;
    color: #9DBFAF;
    direction : rtl;
}

.searchTerm:focus{
    color: #00B4CC;
}

.searchButton {
    width: 40px;
    height: 30px;
    border: 1px solid #00B4CC;
    background: #00B4CC;
    text-align: center;
    color: #fff;
    border-radius: 0 5px 5px 0;
    cursor: pointer;
    font-size: 20px;
}
</style>
