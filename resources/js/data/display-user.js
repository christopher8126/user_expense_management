import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

export default function useUser(){
    const users = ref([]);
    const user = ref([]);
    const router = useRouter();

    const authAttempt = async (data) => {

        await axios.post('/api/login/users', data).then(result => {

            if(result.data.success){

                window.location.href = result.data.url;

            }else{

                alert(result.data.message);

            }

        });

        // console.log(loginUrl.value);

    }

    const getUsers = async () => {

     let response =  await axios.get('/api/users');
       users.value = response.data;

    }

    const getUser = async (id) => {

     let response =  await axios.get('/api/user/edit/' + id);
     user.value = response.data;

    }

    const deleteUsers = async (id) => {

      await axios.get('/api/user/delete/' +id)

    }

    const storeUser = async (data) => {

        await axios.post('/api/user/store', data);
        await router.push({name: 'index.user'});
        
    }

    const updateUser = async (id) => {

        await axios.post('/api/user/update/' + id, user.value);
        await router.push({name: 'index.user'});
        
    }
    
    const changePasswordProcess = async (data) => {

        await axios.post('/api/user/changepassword', data).then(result => {

            router.push({name: 'user.expenses', params: {id: window.Laravel.user.id}});

        });

    } 

    return {

        users,
        user,
        authAttempt,
        getUser,
        getUsers,
        deleteUsers,
        storeUser,
        updateUser,
        changePasswordProcess

    }

}