<template>
  <h1 class="text-center">Chart Monitoring</h1>
  <div class="col-md-8 mx-auto my-5">
    <MonthlyChart />
  </div>
</template>

<script>
import { defineComponent } from 'vue'
import MonthlyChart from './expenseChart.vue';

export default defineComponent({
  name: 'App',
  components: {
    MonthlyChart
  }
})
</script>