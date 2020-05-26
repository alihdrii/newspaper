<template>
    <div>

        <div style="padding:25px;background-color:#ffffff;border-radius:5px; box-shadow:1px 1px 15px #000000;">
            <h5>????</h5>
            <h6>??? ???? ??? ??? ???? ??? ???? ????</h6>
            <div class="container" style="padding:30px 0; width:90%">
                <ali-input label="??? ??????" icon="fas fa-user" @get_value="get_username"></ali-input>
                <ali-input type="password" label="???????" icon="fas fa-key" @get_value="get_pass"></ali-input>
                <button type="button" class="btn btn-primary col-12">????</button>
                <div class="text-right">
                    <h5><a href="/password/forget" style="text-decoration:none">???? ??????? ??????? ????? ???? ????</a></h5>
                </div>
            </div>
        </div>

    </div>

</template>

<script>
    export default {
        name: "PopupSignIn",
        props:['clicked'],
        data(){
            return{
                username:'',
                pass:'',
            }
        },
        methods:{
            get_username(e){
                this.username=e;
            },
            get_pass(e){
                this.pass=e;
            }
        }
    }
</script>

<style scoped>


</style>
