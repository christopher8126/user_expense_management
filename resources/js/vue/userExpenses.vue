<template>

    <div class="container">
        <div class="lead">
            <h2>{{users_expenses.first_name}}</h2>
        </div>
        <div class="d-flex my-5 justify-content-between">
            <router-link :to="{name: 'expenses.create', params: {id: users_expenses.id}}">
                <button class="btn btn-success">
                    Add Expenses 
                </button>
            </router-link>
            <button class="btn btn-primary" v-if="userRole=='user'" @click="changePasswordLink">Change Password</button>
            <button class="btn btn-danger" @click="logOut">
                Logout
            </button>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Expenses</th>
                    <th scope="col">Category</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <template v-for="item in users_expenses.expenses" :key="item.id">
                    <tr>
                        <td scope="row">{{ item.id }}</td>
                        <td>{{ item.cost }}</td>
                        <td>{{ item.category.category_name }}</td>
                        <td>
                            <button class="btn btn-danger" @click="destroyExpense(item.id)"> Delete </button>
                            <router-link :to="{name: 'user_expense.edit', params: {id: item.id}}">
                                <button class="btn btn-success"> Edit </button>
                            </router-link>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>

</template>

<script>

    import useUser from '../data/display-user';
    import userExpenses from '../data/get-expenses';
    import logoutUser from '../data/logout-user';
    import { onMounted } from 'vue';


    export default {
        props: {

            id: {

                required: true,
                type: String

            }

        },   

        setup(props){

            const { users_expenses, getExpenses, deleteExpense } = userExpenses();
            const { logout_process } = logoutUser();

            const userRole = window.Laravel.roles;
        
            onMounted(getExpenses(props.id));

            const destroyExpense = async(id) => {

                if(!window.confirm('Are you sure you want to delete this data? ')){

                    return;

                }

               await deleteExpense(id);
               await getExpenses(props.id);

            }

            const changePasswordLink = async () => {

                window.location.href = '/user/change-password'

            }

            const logOut = async () => {
                
               await logout_process();

            }

            return {

                users_expenses,
                destroyExpense,
                logOut,
                userRole,
                changePasswordLink

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