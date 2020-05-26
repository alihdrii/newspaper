<template>
    <div>
        <i @click="settingBox" class="fas fa-cog" :class="{iconclicked:settingClicked}" style="font-size:15px;cursor: pointer"></i>
        <div  v-if="settingClicked" class="arrow-up"></div>

        <div v-on-clickaway="settingAway" v-if="settingClicked" style="padding: 3px 5px;box-shadow: 2px 2px 15px #888888;  position:absolute; top:33px;right:-20px;width: 250px; height: auto; background-color:#ffffff;">
            <ul class="list-group" style="padding:0; direction:rtl;">

                <li class="list-group-item"  style="padding:4px; border:none; border-radius:0;">
                    <a href="account/edit"><span style="cursor: pointer; margin-right: 10px" class="mmm">تنظیمات حساب کاربری</span></a>
                </li>
                <li class="list-group-item" style="padding:4px; border:none; border-radius:0;">
                    <a style="margin-right: 10px" class="mmm" href="/logout" @click.prevent="logOut">
                        خروج
                    </a>
                    <!--<form id="logout-form" action=logout method="POST" style="display: none;">-->
                    <!--@csrf-->
                    <!--</form>-->
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    import {mixin as clickaway} from "vue-clickaway/index";

    export default {
        name: "ProfileSetting",
        mixins:[clickaway],
        data(){
            return{
                settingClicked:false,
            }
        },
        methods : {
            logOut(){
                axios.post('/logout')
                    .then(response=>{
                        window.location.href="/";

                    })
                    .catch(response=>{

                    })
            },
            settingBox(){
                this.settingClicked=! this.settingClicked;
            },
            settingAway(){
                this.settingClicked=false;
            },
        }
    }
</script>

<style scoped>
    .iconclicked{
        color:#f8f9fa;
    }
    .arrow-up{
        margin-top:4px;
        width: 0;
        height: 0;
        border-left: 7px solid transparent;
        border-right: 7px solid transparent;
        position: absolute;
        top:23px;
        border-bottom: 7px solid #ffffff;
    }
</style>
