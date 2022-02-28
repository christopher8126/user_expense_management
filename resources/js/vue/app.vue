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
        <div class="my-5">

            <BarChart :chart-data="data" :if="graphData.length > 0"/>
        </div>
    </div>
</template>

<script>

    import useUser from '../data/display-user';
    import logoutUser from '../data/logout-user';
    import { onMounted, defineComponent, ref, computed } from 'vue';
    import { useRouter } from 'vue-router'
    import { BarChart } from 'vue-chart-3';
    import {Chart, BarController, CategoryScale, LinearScale, BarElement, } from 'chart.js';
    
    Chart.register(BarController, CategoryScale, LinearScale, BarElement);

    export default defineComponent({
        components: { BarChart },
        setup(){

            const { users, getUsers, deleteUsers } = useUser();
            const { logout_process } = logoutUser();
            const graphLabels = ref([]);
            const graphData = ref([]);
            const router = useRouter();

            onMounted(getUsers);
            const getAll = async () => {

                let response =  await axios.get('/api/expense/categories');
                graphLabels.value = response.data.map(value => {

                    return value.category_name

                });

                let temp_data =  await axios.get('/api/expense/data');
                graphData.value = temp_data.data.map(value => {

                    return value.total_expense;

                });

            }

            getAll();

            const data = computed(() => ({

                labels: graphLabels.value,
                datasets: [

                    {
                        label: 'Expense Monitoring',
                        data: graphData.value,
                        backgroundColor: '#DBBEFF'
                    }

                ]

            }));

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

            return{

                users,
                destroyUser,
                logOut,
                categoryForm,
                data,
                graphData
                
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