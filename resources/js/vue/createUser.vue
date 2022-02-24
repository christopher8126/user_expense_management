<template>

    <div class="col-md-6 mx-auto my-5">
        <h2> Create User </h2>
        <form @submit.prevent="createUser">
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" v-model="form.email" class="form-control">
            </div>
            <div class="mb-3">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" v-model="form.first_name" class="form-control" id="first_name">
            </div>
            <div class="mb-3">
                <label for="first_name" class="form-label">Last Name</label>
                <input type="text" v-model="form.last_name" class="form-control" id="last_name">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" v-model="form.password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</template>

<script>
    import { reactive } from 'vue'
    import useUser from '../data/display-user';

    export default {

        setup(){
            const form = reactive({

                'email': '',
                'first_name': '',
                'last_name': '',
                'password': '',


            });

            const { storeUser } = useUser();

            const createUser = async () => {

                await storeUser({...form});

            }

            return{

                form,
                createUser,

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

    }

</script>