<template>
<div v-if="poll.length>0" style="position:relative">
    <div v-if="load" style="display:flex;align-items: center;justify-content: center;background-color:rgba(255,255,255,.7);position:absolute;top:0;left:0;z-index:10;height:100%;width:100%;">
        <div>
            <i class="fas fa-spinner fa-spin"></i>
        </div>
    </div>
    <div class="text-right row" style="margin=0; border-radius:5px;box-shadow:0 0 4px #000000; background-color:#ffffff">
        <div v-for="item in poll" class="col-12" style="direction:rtl;padding-bottom:10px;">
            <div class="col-6 col-sm-6" style="border-bottom: 2px solid lightgreen;padding:0">
                        <span>
                            <i class="fas fa-questions"></i>
                            <span>poll</span>
                        </span>
            </div>
            <div style="padding:5px 0 ;">
                {{item.title}}
            </div>
            <div style="margin-top:15px;">
                <div v-if="boxStatus" v-for="option in item.options" class="col-12 p-0 mb-2">
                    <div class="pretty p-default p-round p-smooth">

                        <input type="radio" name="poll" :value=option.id v-model="pollValue" />
                        <div class="state p-primary" >
                            <label style="direction:rtl">
                                {{option.title}}
                            </label>
                        </div>
                    </div>
                </div>
                <div >
                    <canvas v-show="!boxStatus" ref="planetChart"></canvas>
                </div>

            </div>
            <div v-if="boxStatus" class="text-left">
                <button @click="pollSubmit(item.id)" type="submit" class="poll-btn">poll</button>
            </div>
        </div>
    </div>

</div>
</template>

<script>

    import Chart from 'chart.js';

    export default {
        name: "Poll",
        data(){
            return{
                poll:'',
                chart : '' ,
                load:false,
                boxStatus:'',
                pollValue:'',
                voteData:[],
                labels:[]
            }
        },
        methods:{
            pollSubmit(q_id){
                this.load=true;
                axios.post('/submitPoll',{
                    q_id:q_id,
                    a_id:this.pollValue,
                })
                .then(response=>{
                    this.voteData = response.data ;
                    this.boxStatus=false;
                    this.load=false;
                })
            },
            getData(){
                if(!this.boxStatus){
                    for(var i=0;i<this.poll.data[0].options.length;i++){
                        this.voteData.push(this.poll.data[0].options[i].vote);
                        this.labels.push(this.poll.data[0].options[i].title);
                    }
                }
                else{
                    for(var i=0;i<this.poll.data[0].options.length;i++){
                        this.labels.push(this.poll.data[0].options[i].title);
                    }
                }
            },

        },
        mounted(){
            axios.get('/api/getPoll')
                .then(res=>{
                    this.poll = res.data.data;
                    this.boxStatus= res.data.status;
                })
                .catch(res=>{

                })
            this.boxStatus = this.poll.status;
            // this.getData();
            // this.chart = new Chart(this.$refs.planetChart, {
            //     type : 'doughnut',
            //     data: {
            //         labels: this.labels,
            //         datasets: [
            //             {
            //                 data: this.voteData,
            //                 backgroundColor: [
            //                     'red','blue','green','orange','yellow','black'
            //                 ],
            //             },
            //
            //         ]
            //     },
            // });

        },
        // watch:{
        //     voteData:function (newDatasets) {
        //         var datasets = [
        //                 {
        //                     data: newDatasets,
        //                     backgroundColor: [
        //                         'red','blue','green','orange','yellow','black'
        //                     ],
        //                 },
        //
        //             ]
        //
        //     this.chart.data.datasets = datasets;
        //     this.chart.update();
        //     },
        // }
    }
</script>

<style scoped>

.poll-btn{
    height: 40px;
    border-radius: 24px;
    border: 3px solid #33c15d;
    padding: 0 30px;
    font-size: 13px;
    font-weight: 700;
    color: #23354a;
    margin: 10px 0;
    background: #fff;
    cursor: pointer;
    -ms-flex-item-align: start;
    align-self: flex-start;
}
.pretty .state label:before, .pretty .state label:after
{
    left:auto;right:0;
}

.pretty {margin-right:0;margin-left: 1em;}
</style>
