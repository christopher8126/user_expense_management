import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

export default function userExpenses(){

    const users_expenses = ref([]);
    const user_expense = ref([]);
    const categories = ref([]);
    const router = useRouter();

    const getExpenses = async (id) => {

        let response = await axios.get(`/api/expense/user/${id}`);
        users_expenses.value = response.data;

    }
    
    const editExpense = async (id) => {

        let response = await axios.get(`/api/expense/edit/${id}`);
        user_expense.value = response.data;

    }

    const updateExpense = async (id) => {

        let response = await axios.post(`/api/expense/update/${id}`, user_expense.value);

        router.push({name: 'user.expenses', params: {id: response.data.user_id}});

    }

    const storeExpenses = async (id,data) => {

        await axios.post('/api/expense/store/' + id, data);
        await router.push({name: 'user.expenses'});

    }

    const getExpenseCategories = async () => {

        let response = await axios.get('/api/expense/categories');
        categories.value = response.data;

    }

    const deleteExpense = async (id) => {

        await axios.get(`/api/expense/delete/${id}`);

    }

    const saveCategory = async (data) => {

        await axios.post('/api/expense/save-category', data).then(result => {

            router.push({ name: 'index.user' });

        });

    }

    return {

        users_expenses,
        categories,
        user_expense,
        updateExpense,
        editExpense,
        storeExpenses,
        getExpenseCategories,
        getExpenses,
        deleteExpense,
        saveCategory

    }

}