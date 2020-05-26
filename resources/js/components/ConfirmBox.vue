<template>
    <transition name="fade">
        <div v-show="isShow" class="vc-overlay" ref="vueConfirm">
            <transition name="zoom">
                <div v-on-clickaway="away"  v-if="isShow" ref="vueConfirm" class="vc-container">
                    <span class="vc-text-grid">
                            <h4 class="vc-title"></h4>
                            <p class="vc-text">'از حذف خبر مطمدن هستید؟'</p>
                    </span>
                    <div class="vc-btn-grid" >
                        <button
                            @click.stop="away"
                            class="vc-btn left"
                        >خیر</button>
                        <button
                            @click.stop="acceptConfirm"
                            class="vc-btn"
                        >بله</button>
                    </div>
                </div>
            </transition>
        </div>
    </transition>
</template>

<script>
    import {eventBus} from '../app';
    import {mixin as clickaway} from "vue-clickaway/index";

    export default {
        name: "AliModal",
        mixins:[clickaway],
        data(){
            return{
                isShow:false,
            }
        },
        mounted(){
            eventBus.$on('showModal', (res)=> {
                this.isShow = true;
            });
        },
        methods:{
            away(){
                this.isShow = false;
            },
            acceptConfirm(){
                eventBus.$emit('deleteNews',true);
                this.away();
            }
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
    .vc-title {
        color: black !important;
        padding: 0 1rem !important;
        width: 100% !important;
        font-weight: 900 !important;
        text-align: center !important;
        font-size: 16px !important;
        line-height: initial !important;
        margin-bottom: 5px !important;
    }
    .vc-text {
        color: black !important;
        padding: 0 1rem !important;
        width: 100% !important;
        font-weight: 500 !important;
        text-align: center !important;
        font-size: 14px !important;
        line-height: initial !important;
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

    .vc-text-grid {
        padding: 1rem;
    }
    .vc-btn-grid {
        width: 100%;
        display: grid;
        grid-template-columns: 1fr 1fr;
        height: 50px;
        border-radius: 0 0 1rem 1rem;
        overflow: hidden;
    }
    .vc-btn-grid.isMono {
        grid-template-columns: 1fr;
    }
    .vc-btn {
        border-radius: 0 0 1rem 0;
        color: cornflowerblue;
        background: white;
        border: 0;
        font-size: 1rem;
        border-top: 1px solid rgb(224, 224, 224);
        cursor: pointer;
        font-weight: 700;
        outline: none;
    }
    .vc-btn:hover {
        background: whitesmoke;
    }
    .vc-btn:disabled {
        background: whitesmoke;
    }
    .vc-btn:active {
        box-shadow: inset 0 2px 0px 0px #00000014;
    }
    .vc-btn.left {
        border-radius: 0;
        /* color: black; */
        border-right: 1px solid #e0e0e0;
    }
    .vc-input[type="password"] {
        width: 100%;
        outline: none;
        border-radius: 8px;
        height: 35px;
        border: 0;
        margin: 5px 0;
        background-color: #ebebeb;
        padding: 0 0.5rem;
        font-size: 16px;
        transition: 0.21s ease;
    }
    .vc-input[type="password"]:hover,
    .vc-input[type="password"]:focus {
        background-color: #dfdfdf;
    }
</style>
