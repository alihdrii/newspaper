<template>

    <div>
        <div class="col-12" style="background-color:#cccccc;display: flex; justify-content: space-between; border-radius:4px ; margin:10px 0">

            <span style="position:relative;">

                <div v-if="!$gate.Auth()">
                    <a href="#" data-target="#signInModal" data-toggle="modal" class="profileItems">
                        <i @click="newsSettingBox" title="???????" style="cursor: pointer; font-size: 11px" class="fas fa-ellipsis-h"></i>
                    </a>
                </div>
                <div v-else>

                    <i @click="newsSettingBox" title="???????" style="cursor: pointer; font-size: 11px" class="fas fa-ellipsis-h"></i>
                    <div v-if="newsSetting" class="arrow-up"></div>
                    <div v-on-clickaway="away" v-if="newsSetting" style="border:1px solid #cccccc;z-index:2;position:absolute;left:-15px;top:22px;border-top:0;background-color: #ffffff; box-shadow: 2px 2px 15px #cccccc;">
                        <div v-if="!$gate.ownPost(news.user_id)" @click="reportBox" class="list-group-item">گزارش</div>
                        <div  v-if="$gate.ownPost(news.user_id)"  class="list-group-item">ویرایش</div>
                        <div  v-if="$gate.ownPost(news.user_id)" @click="confirmBox" class="list-group-item" style="cursor:pointer">حذف</div>
                        <div @click="away" class="list-group-item">بستن</div>

                    </div>
                </div>
                <ali-modal v-show="isModalVisible" :isShow="isModalVisible" @closeModal="closeModal">
                    <div slot="header">
                        <div> لطفا دلیل گزارش این خبر را  انتخاب کنید</div>
                    </div>
                    <div slot="body" style="text-align: justify;" >
                       <ul class="list-group">
                            <li v-for="item in report" class="list-group-item text-center report-item " @click="sendReport(item.id)">
                                {{item.title}}
                            </li>
                       </ul>
                    </div>
                </ali-modal>
            </span>

            <span class="cat">
                <a :href="'/'+news.cat.slug">
                    {{news.cat.name}}
                </a>
                <i class="fas fa-pen"></i>
            </span>
            <span>
                {{news.viewer}}
                <i class="fas fa-eye"></i>
            </span>
            <span>
                {{news.published_at}}
                <span style="font-size: 11px">????</span>
            </span>


        </div>

        <div class="col-12" style="margin:15px 0">
            <div class="row">
                <div class="col-sm-5">
                    <img class="col-12" style="padding:0;height:100%" :src="'/storage/thumbnail_post/'+news.thumbnail_path" />
                </div>
                <div class="col-sm-7 text-right">
                   <div class="row">

                       <div class="col-12 mt-1 mt-sm-0">
                            <span style="font-size:17px">    {{news.title}}   </span>
                            <i class="fas fa-envelope" style="color:orange"></i>
                        </div>
                        <div class="col-12 mt-1">
                            {{news.introduce}}
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <hr class="col-6">

        <div class="col-12 text-right" style="margin:15px 0">
            {{news.text}}
            {{news.is_saved}}

        </div>
        <div class="col-12 text-right" style="margin:15px 0">
            نویسنده:
            {{news.author.name}}
            <i class="fas fa-pen"></i>
        </div>

<!--        <div class="col-12 text-right">-->
<!--            <div v-if="!Auth">-->
<!--                <a href="#" data-target="#signInModal" data-toggle="modal" class="profileItems">-->
<!--                    <i class="far fa-bookmark" style="cursor: pointer"></i>-->
<!--                </a>-->
<!--            </div>-->
<!--            <div v-else>-->
<!--                <span v-if="saveStatus">-->
<!--                            <i v-if="!saveLoad" @click="unSaveNews" class="fas fa-bookmark" style="cursor: pointer"></i>-->
<!--                            <i v-else class="fas fa-bookmark" style="cursor: pointer"></i>-->
<!--                </span>-->
<!--                <span v-if="!saveStatus">-->
<!--                            <i v-if="!saveLoad" @click="saveNews" class="far fa-bookmark" style="cursor: pointer"></i>-->
<!--                            <i v-else class="far fa-bookmark" style="cursor: pointer"></i>-->
<!--                </span>-->
<!--            </div>-->
<!--        </div>-->

    </div>

</template>

<script>
    import {mixin as clickaway} from "vue-clickaway/index";
    import {eventBus} from '../app';
    import AliModal from "./aliModal";

    export default {
        name: "News",
        components: {AliModal},
        mixins:[clickaway],
        props:['Auth','id','save','report'],
        data(){
            return {
                news:'',
                saveLoad:false,
                newsSetting:false,
                saveStatus:'',
                confirm:false,
                isModalVisible:false,
            }
        },
        created(){
            axios.get('/api/news/'+this.id)
                .then(res=>{
                    this.news = res.data ;
                })
                .catch(res=>{

                })
            // this.saveStatus = this.save;
            eventBus.$on('deleteNews',(res)=> {
                if(res){
                    this.deleteNews();
                }
            });
        },
        methods: {

            sendReport(reportId){
                axios.post('/submitReport/'+this.news.id,{
                    reportId:reportId,
                })
                    .then(res=>{

                    })
                    .catch(res=>{

                    })
            },
            closeModal(){
                this.isModalVisible = false;
            },
            reportBox(){
                this.isModalVisible = true;
            },
            deleteNews() {
                        this.$Progress.start();
                        axios.delete('/api/news/'+this.news.id)
                            .then(response=>{
                                this.$Progress.finish();
                                window.location.href = "/"
                            })
                            .catch(response=>{
                                this.$Progress.fail();
                            })
            },
            confirmBox(){
                eventBus.$emit('showModal');
            },
            newsSettingBox(){
                this.newsSetting = ! this.newsSetting;
            },
            saveNews() {
                this.saveLoad= true;
                axios.post('/saveNews',{
                    id:this.news.id
                })
                    .then(response => {
                            this.saveStatus = true;
                            this.saveLoad= false;
                        }
                    )
                    .catch(response => console.log(response.data));
            },
            unSaveNews() {
                this.saveLoad= true;
                axios.post('/unSaveNews',{
                    id:this.news.id,
                })
                    .then(response => {
                        this.saveStatus = false;
                        this.saveLoad= false;
                    })
                    .catch(response => console.log(response.data));
            },
            away(){
                this.newsSetting = false;
            }
        }
    }
</script>

<style scoped>

.cat a{
    text-decoration:none;
    color:#000;
}

.arrow-up{
    margin-top:4px;
    width: 0;
    height: 0;
    border-left: 7px solid transparent;
    border-right: 7px solid transparent;
    position: absolute;
    top:11px;
    border-bottom: 7px solid #ffffff;
}
.report-item{
    border:0;
    border-bottom:  2px solid #cccccc;
    cursor:pointer;
}
    .report-item:hover{
        background-color: silver;
    }
</style>
