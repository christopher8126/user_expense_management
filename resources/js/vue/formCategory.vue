<template>

    <div class="col-md-6 mx-auto my-5">
        <h2> Create User </h2>
        <form @submit.prevent="submitCategory">

            <div class="mb-3">
                <label class="form-label">Expense Category</label>
                <input type="text" class="form-control" v-model="form.category">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</template>

<script>
    import userExpenses from '../data/get-expenses';
    import { reactive } from 'vue'

    export default {

        setup(){

            const form = reactive ({

                category: '',

            });

            const { saveCategory } = userExpenses();

            const submitCategory = async () => {

                await saveCategory({...form});

            }

            return {

                form,
                submitCategory

            }

        }

    }

</script>