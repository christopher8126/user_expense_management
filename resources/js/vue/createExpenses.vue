<template>

    <div class="col-md-6 mx-auto my-5">
        <h2> Create Expenses </h2>
        <form @submit.prevent="createExpenses">
            <div class="mb-3">
                <label for="first_name" class="form-label">Cost</label>
                <input type="number" min="1"  class="form-control" id="first_name" v-model="form.cost">
            </div>
            <div class="mb-3">
                <label for="categories" class="form-label">Categories</label>
                <select class="form-select" v-model="form.categories_id">
                    <template v-for="item in categories" :key="categories.id">
                        <option :value="item.id">{{item.category_name}}</option>
                    </template>
                </select>   
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</template>

<script>

    import userExpenses from '../data/get-expenses';
    import { onMounted } from 'vue';
    import { reactive } from 'vue'

    export default{

        props: {

            id: {

                required: true,
                type: String

            }

        }, 

        setup(props){
            const form = reactive({

                'cost': '',
                'categories_id': '',

            });

            const { categories, getExpenseCategories, storeExpenses } = userExpenses();
            onMounted(getExpenseCategories);
            
            const createExpenses = async () => {

                await storeExpenses(props.id, {...form})

            }

            return{

                form,
                categories,
                createExpenses,

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

