import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

export default function logoutUser(){

    const logout_process = async () => {

        axios.post('/api/user/logout').then(result => {
                if (result.data.success) {
                    window.location.href = "/"
                } else {
                    console.log(result)
                }
        })
        .catch(function (error) {
            console.error(error);
        });


    }

    

    return {

        logout_process

    }

}