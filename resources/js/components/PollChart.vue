<template>

    <div >
    {{aaa}}
        <canvas id="planet-chart"></canvas>
    </div>

</template>

<script>
    import Chart from 'chart.js';
    export default {
        name: "PollChart",
        props:['aaa'],
        mounted(){
            var ctx = document.getElementById('planet-chart');
            alert(this.aaa);
            new Chart(ctx , {
                type : 'doughnut',
                data : {

                    datasets: [{
                        label: '# of Votes',
                        data: aaa,
                        backgroundColor: [
                            'blue',
                            'red',
                            'green',
                            'orange',
                            'yellow',
                        ],

                    }]
                }
            })
        },
    }
</script>

<style scoped>
</style>
