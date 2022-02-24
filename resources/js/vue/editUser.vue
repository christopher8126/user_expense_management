<template>

    <div class="col-md-6 mx-auto my-5">
        <h2> Edit User </h2>
        <button class="btn btn-success" @click="backToDashboard"> Back to Dashboard </button>
        <form @submit.prevent="saveUser">
            <div class="mb-3">
                <label for="first_name" class="form-label">Email</label>
                <input type="email" v-model="user.email" class="form-control" placeholder="Email" id="first_name">
            </div>
            <div class="mb-3">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" v-model="user.first_name" class="form-control" placeholder="First name" id="first_name">
            </div>
            <div class="mb-3">
                <label for="first_name" class="form-label">Last Name</label>
                <input type="text" v-model="user.last_name" class="form-control" placeholder="Last name" id="last_name">
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" v-model="user.password" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</template>

<script>

    import useUser from '../data/display-user';
    import {onMounted, reactive} from 'vue';
    export default {

        props: {

            id: {

                required: true,
                type: String

            }

        },

        setup(props){

            const { user, getUser, updateUser } = useUser();

            onMounted(getUser(props.id));

            const saveUser = async () => {

                await updateUser(props.id);

            }

            const backToDashboard = async () => {

                window.location.href = '/all-user';

            }

            return {

                user,
                saveUser,
                backToDashboard,

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