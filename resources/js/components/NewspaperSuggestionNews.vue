<template>

        <div  style=" padding:7px; direction:rtl">
            <div class="col-6 text-right" style=" padding-right:0; border-bottom:3px solid lightgreen;">
                            <i class="fas fa-quote-left"></i>
                            خبرهای پیشنهادی

            </div>


             <div id="suggestion" class="swiper-container pt-2 pt-md-3 pb-2 pb-md-3" style="margin-top:25px;" >

                <div class="swiper-wrapper">

                        <div v-for="item in news" class="swiper-slide" >
                            <div style="border-radius:5px; font-size:13px;padding:0;box-shadow: 3px 3px 15px #cccccc;">

                                        <img :src="'/storage/thumbnail_post/'+item.thumbnail_path" class="col-12" style="padding:0; height:100px" />
                                    <div class="text-right" style="padding:5px;min-height:60px">
                                        <a :href="'/news/'+item.id+'/'+item.slug">
                                            {{item.title}}
                                        </a>
                                    </div>

                            </div>
                        </div>

                </div>
                <div id="suggestPagination" class="swiper-pagination"></div>

            </div>


        </div>


</template>

<script>
    import Swiper1 from 'swiper';

    export default {
        name: "NewspaperSuggestionNews",
         mounted(){
            axios.get('/api/newspaperSuggestionNews')
                .then(res=>{
                    this.news = res.data;
                })
                .catch(res=>{

                })
            var mySwiper1 = new Swiper1('#suggestion', {
                direction:'horizontal',
                speed: 300,
                spaceBetween:30,
                slidesPerView:3,
                pagination: {
                    el: '#suggestPagination',
                    clickable: true,
                    type: 'bullets',
                },
                breakpoints: {
                    // when window width is >= 320px
                    320: {
                        slidesPerView: 2,
                        spaceBetween: 20
                    },
                    // when window width is >= 480px
                    480: {
                        slidesPerView: 3,
                        spaceBetween: 30
                    },

                }

            });
         },
        data() {
            return{
                news : '',
            }
        }

    }
</script>

<style scoped>

a{
    text-decoration : none ;
    color : #000000;
}
.swiper-container-horizontal {
    display: block;
}
.swiper-container-multirow>.swiper-wrapper {
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
}
.swiper-pagination {
    position: relative;
    top: 0;
    bottom: 0;
    height: 12px;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    margin-top: 20px;
}

.swiper-container-horizontal>.swiper-pagination-bullets .swiper-pagination-bullet {
    width: 12px;
    height: 12px;
    margin: 0 3px;
    background: #1b4b72;
    opacity: 1;
}

.swiper-container-horizontal>.swiper-pagination-bullets .swiper-pagination-bullet-active {
    background: #1b4b72;
}
</style>
