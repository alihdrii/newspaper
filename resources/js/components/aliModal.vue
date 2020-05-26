<template>
    <transition name="fade">
        <div class="vc-overlay" ref="vueConfirm">
            <transition name="zoom">
                <div v-on-clickaway="away" v-if="isShow" ref="vueConfirm" class="vc-container">
                    <div class="modal-header">
                       <slot name="header">
                            <!--I'm the default header!-->
                        </slot>
                    </div>
                    <section class="modal-body">
                        <slot name="body">
                            I'm the default body!
                        </slot>
                    </section>

                </div>
            </transition>
        </div>
    </transition>
</template>

<script>
    import {eventBus} from '../app';
    import {mixin as clickaway} from "vue-clickaway/index";

    export default {
        name: "aliModal",
        mixins:[clickaway],
        props:['isShow'],
        // data(){
        //     return{
        //         isShow:false,
        //     }
        // },

        methods:{
            away(){
                this.$emit('closeModal');
            },

        }
    }
</script>

<style scoped>
    .fade-enter-active,
    .fade-leave-active {
        transition: opacity 0.21s;
    }

    .fade-enter,
    .fade-leave-to {
        opacity: 0;
    }

    .zoom-enter-active,
    .zoom-leave-active {
        animation-duration: 0.21s;
        animation-fill-mode: both;
        animation-name: zoom;
    }

    .zoom-leave-active {
        animation-direction: reverse;
    }

    @keyframes zoom {
        from {
            opacity: 0;
            transform: scale3d(1.1, 1.1, 1.1);
        }

        100% {
            opacity: 1;
            transform: scale3d(1, 1, 1);
        }
    }

    *,
    *:before,
    *:after {
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        text-decoration: none;
        /* -webkit-tap-highlight-color: rgba(0,0,0,0); */
        -webkit-touch-callout: none;
        /* -webkit-font-smoothing: antialiased; */
        -moz-osx-font-smoothing: grayscale;
        margin: 0;
        padding: 0;
    }

    .vc-overlay {
        background: rgba(0, 0, 0, 0.29);
        width: 100%;
        height: 100%;
        transition: all 0.1s ease-in;
        left: 0;
        top: 0;
        z-index: 999999999999;
        position: fixed;
        display: flex;
        justify-content: center;
        align-items: center;
        align-content: baseline;
    }
    .vc-container {
        background: white;
        border-radius: 1rem;
        width: 286px;
        height: auto;
        display: grid;
        grid-template-rows: 1fr auto;
        box-shadow: rgba(0, 0, 0, 0.29) 0px 3px 8px 0px;
    }

    .modal-header,
    .modal-footer {
        padding: 15px;
        /*display: flex;*/
        /*height: 0;*/
    }

    .modal-header {
        direction: rtl;
        border-bottom: 1px solid #eeeeee;
        color: #4AAE9B;
        /*justify-content: space-between;*/
    }

    .modal-footer {
        border-top: 1px solid #eeeeee;
        justify-content: flex-end;
    }

    .modal-body {
        position: relative;
        padding: 20px 10px;
        overflow: hidden;
        max-height: 800px;
    }
</style>
