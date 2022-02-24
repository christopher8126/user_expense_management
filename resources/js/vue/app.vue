<template>
    <div class="container">
        <div class="d-flex my-5 justify-content-between">
            <router-link :to="{name: 'user.create'}">
                <button class="btn btn-success">
                    Add user 
                </button>
             </router-link>
            <button class="btn btn-primary" @click="categoryForm">
                Create Expense Category
            </button>
            <button class="btn btn-primary" @click="chartExpense">
                View Chart
            </button>
            <button class="btn btn-danger" @click="logOut">
                Logout
            </button>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <template v-for="item in users" :key="item.id">
                    <tr>
                        <td scope="row">{{item.id}}</td>
                        <td>{{ item.first_name }}</td>
                        <td>{{ item.last_name }}</td>
                        <td>
                            <button class="btn btn-danger" @click="destroyUser(item.id)"> Delete </button>
                            <router-link :to="{name: 'user.edit', params: {id: item.id}}">
                                <button class="btn btn-success"> Edit </button>
                            </router-link>
                            <router-link :to="{name: 'user.expenses', params: {id: item.id}}">
                                <button class="btn btn-primary"> View </button>
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
    import logoutUser from '../data/logout-user';
    import { onMounted, defineComponent } from 'vue';
    import { useRouter } from 'vue-router'
    import { Bar } from 'vue3-chart-v2'
    

    export default defineComponent({
        setup(){

            const { users, getUsers, deleteUsers } = useUser();
            const { logout_process } = logoutUser();
            const router = useRouter();

            onMounted(getUsers);

            const destroyUser = async (id) => {
                if(!window.confirm('Are you sure you want to delete this user? ')){

                    return;

                }

                await deleteUsers(id);
                await getUsers();

            }

            const logOut = async () => {

               await logout_process();

            }

            const categoryForm = async () => {

                window.location.href = '/user/category-form';

            }

            const chartExpense = async () => {

                window.location.href = '/expense/chart/';

            }

            return{

                users,
                destroyUser,
                logOut,
                categoryForm,
                chartExpense
                
            }

        },

        beforeRouteEnter(to, from, next) {
            if (!window.Laravel.isLoggedin) {

                window.location.href = "/";
                
            }else if(window.Laravel.roles == 'user'){

                window.location.href = "/user/"+ window.Laravel.user.id +"/expenses";

            }
            next();
        }

    });

</script>