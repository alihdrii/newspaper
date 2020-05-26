<template>

        <div id="sw1" class="swiper-container"  >
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Slides -->
                    <div v-for="item in news" class="swiper-slide" >
                        <div style="position:relative;">
                            <img style="border-radius:8px;max-height:300px;min-height:200px;padding:0;" :src="'/storage/thumbnail_post/'+item.news[0].thumbnail_path" class="col-12" />
                            <div class="text-right" style="padding:5px 15px;position:absolute;left:0;bottom:0;background-color:rgba(0,0,0,.5);width:100%;color:#ffffff;">
                                <h5>
                                    <a :href="'/news/'+item.news[0].id+'/'+item.news[0].slug">
                                        {{item.news[0].title}}
                                    </a>
                                </h5>

                                {{item.news[0].introduce}}
                            </div>
                        </div>
                        <div style="padding:5px;background-color:red;color:#ffffff;position:absolute; top:40px; right:0;">
                            <a :href="'/'+item.slug">
                                {{item.name}}
                            </a>
                        </div>
                    </div>

            </div>
                <div id="bestPagination" class="swiper-pagination"></div>
        </div>

</template>

<script>

    import Swiper from 'swiper';

    export default {
        name: "BestNewspaperNews",
        created() {
             axios.get('/api/newspaperBestNews')
                 .then(res => {
                     this.news = res.data;
                 })
                 .catch(res => {

                 })
        },
        mounted(){
            var mySwiper = new Swiper('#sw1', {
                direction:'horizontal',
                speed: 300,
                slidesPerView:1,
                loop:true,
                pagination: {
                    el: '#bestPagination',
                    clickable: true,
                    type: 'bullets',
                },
                autoplay: {
                    delay: 5000,
                },

            });
         },
        data(){
            return{
                news:'',
            }
        }
    }
</script>

<style scoped>
a{
    text-decoration : none ;
    color : #ffffff;
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
