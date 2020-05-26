<template>
    <div  style="position:relative">
        <i @click="notification_box" class="fas fa-globe-americas" :class="{iconclicked:notify_clicked}" style="cursor: pointer"></i>
        <i v-if="unreadStatus" class="fas fa-circle" style=" float:right; color: red ; font-size: 5px"></i>
        <div v-if="notify_clicked" class="arrow-up"></div>
        <div v-on-clickaway="away" v-if="notify_clicked" style="padding: 3px 5px;box-shadow: 2px 2px 15px #888888;  position:absolute; top:33px;right:-20px;width: 250px; max-height: 400px; overflow-y: auto ;direction: rtl; background-color:#ffffff;">
            <div v-if="unread.length>0">
                <div>
                    جدیدها
                </div>
                <ul v-for="notification in unread" class="list-inline" style=" padding: 3px 5px;">

                    <li v-if="notification.data.post" class="list-inline-item" >
                        <span style="font-size: 11px;"><a :href="'/journalist/'+notification.data.user.username"><img :src="'/storage/profile/'+notification.data.user.img" style="border-radius:50%; width: 27px; height: 27px; vertical-align: middle"/> {{notification.data.user.name}} </a> منتشر کرد :   </span>
                        <a style="text-decoration: none; color: #4e555b;" :href="'/news/'+notification.data.post.id+'/'+notification.data.post.tittle">{{notification.data.post.tittle}}</a>
                    </li>
                    <li v-if="notification.data.following" class="list-inline-item">
                        <!--                            <div class="col-sm-12" style="font-size: 11px; padding-right:0;"><a :href="'/journalist/'+notification.data.user.username"><img :src="'/storage/profile/'+notification.data.user.img" style="border-radius:50%; width: 27px; height: 27px; vertical-align: middle"/>  {{notification.data.user.name}} </a> مطالب شما را دنبال می کند </div>-->
                        <div class="col-sm-12" style="font-size:11px; color:#cccccc;float:left"><small>{{notification}}</small></div>
                    </li>
                    <li v-if="notification.data.welcome" class="list-inline-item">
                        <i class="fas fa-smile-beam" style="color: green; font-size: 20px;"></i><span style="font-size:11px; color:#171a1d;"> {{name}} عزیز {{notification.data.welcome}} </span>
                        <!--<div class="col-sm-12" style="font-size:11px; color:#cccccc;float:left"><small>{{notification.time_of_notif}}</small></div>-->
                    </li>

                </ul>
                <hr style="width:70%">

            </div>
            <ul v-for="notification in notifications" class="list-inline" style=" padding: 3px 5px;">

                <li v-if="notification.data.post" class="list-inline-item" >
                    <span style="font-size: 11px;"><a :href="'/journalist/'+notification.data.user.username"><img :src="'/storage/profile/'+notification.data.user.img" style="border-radius:50%; width: 27px; height: 27px; vertical-align: middle"/> {{notification.data.user.name}} </a> منتشر کرد :   </span>
                    <a style="text-decoration: none; color: #4e555b;" :href="'/news/'+notification.data.post.id+'/'+notification.data.post.tittle">{{notification.data.post.tittle}}</a>
                </li>
                <li v-if="notification.data.following" class="list-inline-item">
                    <!--                            <div class="col-sm-12" style="font-size: 11px; padding-right:0;"><a :href="'/journalist/'+notification.data.user.username"><img :src="'/storage/profile/'+notification.data.user.img" style="border-radius:50%; width: 27px; height: 27px; vertical-align: middle"/>  {{notification.data.user.name}} </a> مطالب شما را دنبال می کند </div>-->
                    <div class="col-sm-12" style="font-size:11px; color:#cccccc;float:left"><small>{{notification}}</small></div>
                </li>
                <li v-if="notification.data.welcome" class="list-inline-item">
                    <i class="fas fa-smile-beam" style="color: green; font-size: 20px;"></i><span style="font-size:11px; color:#171a1d;"> {{name}} عزیز {{notification.data.welcome}} </span>
                    <!--<div class="col-sm-12" style="font-size:11px; color:#cccccc;float:left"><small>{{notification.time_of_notif}}</small></div>-->
                </li>

            </ul>
        </div>
    </div>
</template>

<script>
    import {mixin as clickaway} from "vue-clickaway/index";
    export default {
        name: "Notifications",
        mixins:[clickaway],
        data(){
            return{
                notifications : '',
                notify_clicked : false,
                unread : '',
                unreadStatus : false,
                unreadBack : false,
            }
        },
        mounted() {

            axios.get('/api/unreadNotifications')
                .then(res => {
                    this.unread = res.data;
                    if(this.unread.length>0){
                        this.unreadStatus = true;
                    }
                })
                .catch(res => {

                })

            axios.get('/api/readNotifications')
                .then(res => {
                    this.notifications = res.data;
                })
                .catch(res => {

                })
        },
        methods: {
            notification_box() {
                this.notify_clicked = !this.notify_clicked;
                if (this.unreadStatus) {
                    axios.put('/api/markAsReadNotification')
                        .then(response => {
                            this.unreadStatus = false;
                        })
                        .catch(response => {

                        })
                }
            },
            away() {
                this.notify_clicked = false;
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
    .unread{
        background-color: #1d68a7;
    }
</style>
