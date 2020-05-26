<template>
    <div>
        <div style="padding:25px;background-color:#ffffff;border-radius:5px; box-shadow:1px 1px 15px #000000;">
            <h6>برای بازیابی گذرواژه ایمیل خود را وارد کنید</h6>
            <div class="container" style="padding:30px 0; width:90%">
                <ali-input type="email" label="email" icon="fas fa-envelope" @get_value="get_email"></ali-input>

                <button type="button" class="btn btn-primary col-12">send</button>
            </div>
        </div>
        <div class="text-center" style="margin-top:15px;">
            <div>??????? ??? ?? ?????? ???? ????</div>
            <h5><a href="/registery" style="text-decoration:none">???? ??????? ??????? ????? ???? ????</a></h5>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ForgetPassword",
        props:['clicked'],
        methods:{
            forget_pass(){
                this.$emit('change_type','forget_pass');
            }
        }

    }
</script>

<style scoped>


</style>
