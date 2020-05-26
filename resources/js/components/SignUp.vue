<template>
    <div>
        <div>
            <div style="padding:25px;background-color:#ffffff;border-radius:5px; box-shadow:1px 1px 15px #000000;">
                <h5>خبرنگار شو</h5>
                <h6>رای شروع خبرنگاری در ....... ثبت نام کن</h6>
                <div class="container" style="padding:30px 0; width:90%">

                    <ali-input :error=error.errors.username label="نام کاربری" icon="fas fa-user" @get_value="get_username"></ali-input>

                    <ali-input :error=error.errors.name label="نام خبرنگاری" icon="fas fa-user" @get_value="get_name"></ali-input>

                    <ali-input :error=error.errors.email type="email" label="ایمیل" icon="fas fa-envelope" @get_value="get_email"></ali-input>

                    <ali-input :error=error.errors.password type="password" label="گذرواژه" icon="fas fa-key" @get_value="get_pass"></ali-input>

                    <ali-input type="password" label="تکرار گذرواژه" icon="fas fa-keys" @get_value="get_confirm"></ali-input>

                    <button v-if="!load" @click="register" type="button" class="btn btn-primary col-12">ثبت نام</button>
                    <button v-else type="button" class="btn btn-primary col-12">
                        <i style="color: #000000;" class="fas fa-spinner fa-spin"></i>
                    </button>

                </div>
            </div>
        </div>
        <div v-if="registerStatus" class="modal fade show" id="signInModal" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content" style="overflow:hidden">
                    با موفقسا صبی شد
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: "SignUp",
        data(){
            return{
                registerStatus:false,
                error: {
                    errors: {
                        username: '',
                        name: '',
                        email: '',
                        pass: '',
                        gender: '',
                    }
                },
                username:'',
                name:'',
                email:'',
                pass:'',
                confirm:'',
                gender:'2',
                load:false
            }
        },
        methods:{
            get_username(e){
                this.username=e;
            },
            get_name(e){
                this.name=e;
            },
            get_email(e){
                this.email=e;
            },
            get_pass(e){
                this.pass=e;
            },
            get_confirm(e){
                this.confirm=e;
            },
            // forget_pass(){
            //     this.$emit('change_type','forget_pass');
            // },
            register(){
                this.load=true;
                axios.post('/register',{
                    name:this.name,
                    username:this.username,
                    password:this.pass,
                    password_confirmation:this.confirm,
                    email:this.email,
                    gender:this.gender,
                })
                    .then(response=>{
                        console.log(response.data);
                        this.registerStatus=true;
                        this.load=false;
                    })
                    .catch(response=>{
                        this.error =response.response.data;
                        this.load=false;
                    })
            }
        }
    }
</script>

<style scoped>

label{
    display:block;
    text-align:right
}
</style>
