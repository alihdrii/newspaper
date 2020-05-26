<template>
    <div>

        <div style="padding:25px;background-color:#ffffff;border-radius:5px; box-shadow:1px 1px 15px #000000;">
            <h5>ورود</h5>
            <h6>از این قسمت وارد شوید</h6>
            <div class="container" style="padding:30px 0; width:90%">
                <ali-input :error=error.errors.username label="نام کاربری" icon="fas fa-user" @get_value="get_username"></ali-input>
                <ali-input :error=error.errors.password type="password" label="گذرواژه" icon="fas fa-key" @get_value="get_pass"></ali-input>
                <button v-if="!load" @click="login" type="button" class="btn btn-primary col-12">ورود</button>
                <button v-else type="button" class="btn btn-primary col-12">
                    <i style="color: #000000;" class="fas fa-spinner fa-spin"></i>
                </button>
            </div>
        </div>
        <div class="text-center" style="margin-top:15px;">
            <div>گذرواژه خود را فراموش کرده اید؟</div>
            <h5><a href="/password/forget" style="text-decoration:none">برای بازیابی گذرواژه کلیک کنید</a></h5>
        </div>
        <hr>
        <div class="text-center">
            <div >ایمیل فعالسازی حساب را دریافت نکرده اید؟</div>
            <h5 style="color:yellow"><a href="/validation/email" style="text-decoration:none">برای ارسال مجدد ایمیل فعالسازی کلیک کنید</a></h5>

        </div>

    </div>

</template>

<script>
    export default {
        name: "SignIn",
        data(){
            return{
                load:false,
                username:'',
                pass:'',
                error: {
                    errors: {
                        username: '',
                        pass: '',
                    }
                },
            }
        },
        methods:{
            get_username(e){
                this.username=e;
            },
            get_pass(e){
                this.pass=e;
            },
            login(){
                this.load=true;
                axios.post('/login',{
                    username:this.username,
                    password:this.pass,
                })
                    .then(response=>{
                        window.location.href="/";
                        // this.$route.href('/profile');
                    })
                    .catch(response=>{
                        this.error=response.response.data;
                        this.load=false;
                    })
            }
        }
    }
</script>

<style scoped>


</style>
