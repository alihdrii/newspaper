<template>
    <div>
        <i class="fas fa-bars icon" @click="mobile_menu"></i>
        <div v-if="visible_mobile_menu" class="mobileMenuBox">
            <ul class="list-inline text-center">
                <li class="list-inline-item" style="font-size: 12px;">
                    {{clock}}
                    <i class="fas fa-clock"></i>
                </li>
                <li class="list-inline-item" style="font-size: 12px;">
                    {{date}}
                    <i class="far fa-calendar"></i>
                </li>

            </ul>
            <ul class="list-group" >
                <li class="list-group-item">
                    <div class="search" style="padding: 8px">
                        <input type="text" class="searchTerm" placeholder="جستجو">
                        <button type="submit" class="searchButton">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </li>
                <a :href=item.url v-for="item in menuItems">
                    <li class="list-group-item" >
                            {{item.show}}
                            <i :class=item.icon></i>
                    </li>
                </a>

                <a :href="'/'+cats.slug" v-for="cats in category">
                    <li class="list-group-item">
                            {{cats.name}}
                                <i :class="cats.icon"></i>
                    </li>
                </a>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        name: "MobileMenu",
        props:['date','clock'],
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
                visible_mobile_menu:false,
                category :'',
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
                        url : '/video'
                    },
                ],
            }
        },
        methods:{
            mobile_menu(){
                this.visible_mobile_menu=!this.visible_mobile_menu;
            }
        }
    }
</script>

<style scoped>
.icon{
    font-size: 25px;
}
a{
    color: #ffffff;
    text-decoration:none
}
.mobileMenuBox{
    z-index:99999;
    background-color: #1b4b72;
    width:300px;
    position: absolute;
    height: auto;
    top:45px;
    left:0;
    display:block;
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

ul li{
    border:none;
    background: none;
    text-align: right;
    font-size:15px;
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
