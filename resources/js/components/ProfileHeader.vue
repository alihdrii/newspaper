<template>
    <div>
        <ul class="list-inline" style="font-size:15px">
            <li class="list-inline-item" style="margin-right: 5px;position:relative">
                <profile-setting></profile-setting>
            </li>
            <li class="list-inline-item">
                <notifications></notifications>
            </li>
            <li class="list-inline-item">|</li>
            <li class="list-inline-item">
                <a style="text-decoration:none;color: #ffffff" href="/jam-e-jam">جام جم</a>
            </li>
            <li class="list-inline-item">|</li>
            <li class="list-inline-item">
                <a style="text-decoration:none;color: #ffffff" href="/">روزنامه</a>
            </li>
            <li class="list-inline-item">|</li>
            <li class="list-inline-item">
                <header-journalist-pic
                    :img = user.user_img_path
                    :name = user.name
                ></header-journalist-pic>
            </li>

        </ul>
    </div>

</template>

<script>

    import Notifications from "./Notifications";
    import ProfileSetting from "./ProfileSetting";

    export default {
        name: "ProfileHeader",
        components: {Notifications,ProfileSetting},
        data(){
            return{
                user ,
            }
        },
        mounted() {
            axios.get('/api/user')
                .then(res => {
                    this.user = res.data ;
                })
                .catch(res => {

                })
            // if(this.data.unread.length>0){
            //     this.unreadStatus=true;
            // }
        },
        methods:{
            signIn(){
                this.signInBox = !this.signInBox ;
            },
        },
    }
</script>

<style scoped>
    ul{
        margin-bottom: 0;
    }

.profileItems{
    color:#ffffff;
    text-decoration:none
}

</style>
