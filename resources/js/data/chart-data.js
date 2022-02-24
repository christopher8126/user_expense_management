import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

export default function chartData() {
    const labels = ref([]);
    const data = ref([]);


    const getLabels = async () => {

        let response = await axios.get('/expense/categories');
        labels.value = response.data;

    }

    return {

        labels,
        getLabels

    }


}