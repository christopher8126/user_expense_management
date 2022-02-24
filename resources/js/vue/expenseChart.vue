<script>
    import { defineComponent, ref } from 'vue'
    import { Bar } from 'vue3-chart-v2'

    export default defineComponent({
    name: 'MonthlyChart',
    extends: Bar,
    data(){

        return{

            labels: [],
            data: []

        }

    },
    mounted () {

        // const labels = ref([]);
        // const data = ref([]);
        var arr = [];

        const getLabels = async () => {

          return await axios.get('/api/expense/categories').then(result => {

            result.data.map((data) => {

                this.labels.push(data.category_name);

            })
                
            });

        }

        const getChartData = async () => {

            return await axios.get('/api/expense/data').then(result => {

                result.data.map(data => {
                    this.data.push(data.total_expense);
                });

            });

        }

        getLabels();
        getChartData();
        console.log(this.data);
        // Overwriting base render method with actual data.
        this.renderChart({
        labels: this.labels,
            datasets: [
                {
                label: 'Expense by Category',
                backgroundColor: '#f87979',
                // data: this.labels
                data: this.data
                }
            ]
        })
    }
    })
</script>