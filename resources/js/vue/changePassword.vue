<template>

    <div class="col-md-6 mx-auto my-5">
        <h2> Create User </h2>
        <form @submit.prevent="changePw">

            <div class="mb-3">
                <label class="form-label">Enter new password</label>
                <input type="password" class="form-control" v-model="form.password">
            </div>
            <div class="mb-3">
                <label class="form-label">Confirm password</label>
                <input type="password" class="form-control" v-model="form.passwordconfirm">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</template>

<script>

    import { reactive } from 'vue'
    import useUser from '../data/display-user';

    export default{

        setup(){

            const form = reactive({

                password: '',
                passwordconfirm: '',
                user_id: window.Laravel.user.id

            });
            const { changePasswordProcess } = useUser();

            const changePw = async () => {

                if(form.password == form.passwordconfirm){

                    await changePasswordProcess({...form});

                }else{
                    
                    window.confirm('Your password does not match');

                }

            }

            return{

                form,
                changePw

            }

        }

    }

</script>