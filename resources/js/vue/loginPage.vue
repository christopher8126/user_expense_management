<template>

    <div class="d-flex justify-content-center mt-5">
        <div class="col-md-6 ">

            <h1 class="text-center">Login form</h1>
            <form @submit.prevent="loginUser">
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" placeholder="email" v-model="form.email">
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" placeholder="password" v-model="form.password">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

</template>

<script>

    import useUser from '../data/display-user';
    import { reactive } from 'vue';

    export default {

        setup(){

            const form = reactive({

                'email': '',
                'password': ''

            });

            const { loginUrl, authAttempt } = useUser();

            const loginUser = async () =>{

               await authAttempt({...form});

            }

            return {

                form,
                loginUser
            }

        },
         beforeRouteEnter(to, from, next) {
            if ( window.Laravel.isLoggedin ) {
                
                window.Laravel.roles == 'user' ? window.location.href = "/all-user" : window.location.href = "/user/"+ window.Laravel.user.id +"/expenses";

            }
            next();
        }

    }

</script>