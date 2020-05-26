<template>

    <div class="row justify-content-center" style="margin-bottom:40px;position:relative">

        <div  class="col-10" style="position:relative">
                <input @focus="focus_setting" @blur="input_value" :type=type  v-model="inp"  required/>
                <label class="label">{{label}}</label>
        </div>

        <i :class=icon></i>

        <div class="col-11" style="margin-top:7px;height:1px;border:1px solid #cccccc;"></div>

        <label v-for="er in error" class="error bg-danger " style="font-size: 11px">{{er}} *</label>

    </div>

</template>

<script>
    export default {
        name: "AliInput",
        props:['type','label','icon','old_value','error'],
        data() {
            return {
                inp:'',
                type_pass:false,
                errorBox:false,
            }
        },
        methods:{
            focus_setting(){
                this.type_pass=true;
            },
            input_value(){
                this.type_pass=false;
                this.$emit('get_value',this.inp);
            },
        },
    }
</script>

<style scoped>

.label{
        font-weight:normal;
        position: absolute;
        float:right;
        top:3%;
        right:10px;
        font-size:15px;
        pointer-events:none;
        color: #cccccc;
        transition: .3s ease all
    }
    i{
        /*font-weight:normal;*/
        position: relative;
        top:5px;
        font-size:15px;
        pointer-events:none;
        transition: all .5s;
    }
    input{
        direction:rtl;
        text-align: justify;
        height:30px;
        min-height: 30px;
        max-height: 90px;
        overflow:hidden;
        padding:5px;
        display:block;
        border:none;
        width: 100% ;
    }
    input:focus{
        border:none;
        box-shadow: none;
        outline-width: 0px;
    }
    input:focus ~ .label , input:valid ~ .label {
        top:-20px;
        font-size:11px;
        color: #1b4b72;
    }
    input:focus ~ i , input:valid ~ i{
        color: #005cbf;
    }
    .wer{
        border-bottom:2px solid red;
    }
    .arrow-down {
        width: 0;
        height: 0;
        border-left: 10px solid transparent;
        border-right: 10px solid transparent;

        border-top: 10px solid #cccccc;
    }

    .error{
        position:absolute;
        left:0;
        top:30px;
        color: #ffffff;
    }
</style>
