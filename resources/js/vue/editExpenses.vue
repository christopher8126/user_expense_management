<template>

    <div class="col-md-6 mx-auto my-5">
        <h2> Edit Expense Expenses </h2>
        <form @submit.prevent="saveExpense">
            <div class="mb-3">
                <label for="first_name" class="form-label">Cost</label>
                <input type="number" min="1"  class="form-control" id="first_name" v-model="user_expense.cost">
            </div>
            <div class="mb-3">
                <label for="categories" class="form-label">Categories</label>
                <select class="form-select" v-model="user_expense.category_id">
                    <option 
                    v-for="item in user_expense.categories" 
                    :key="user_expense.categories.id" 
                    :value="item.id"
                    >{{item.category_name}}</option>
                </select>   
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</template>

<script>

    import userExpenses from '../data/get-expenses';
    import { reactive, onMounted, watch } from 'vue';
    import { useRouter } from 'vue-router'


    export default{

        props: {

            id: {

                required: true,
                type: String,

            }

        },

        setup(props){
            const router = useRouter();

            const { user_expense, editExpense, updateExpense } = userExpenses();
            
            onMounted(editExpense(props.id));

            const expenseDashboard = async () => {

                router.push({name: 'user.expenses', params: {id: window.Laravel.user.id}});

            }

            const saveExpense = async () => {

               await updateExpense(props.id);

            }

            return {

                user_expense,
                saveExpense,
                expenseDashboard

            }

        },
        beforeRouteEnter(to, from, next) {
            if (!window.Laravel.isLoggedin) {
                window.location.href = "/";
            }
            next();
        }

    }

</script>