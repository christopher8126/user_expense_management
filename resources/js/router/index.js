import { createRouter , createWebHistory } from 'vue-router';

import App from '../vue/app.vue';
import CreateUser from '../vue/createUser.vue';
import EditUser from '../vue/editUser.vue';
import userExpenses from '../vue/userExpenses';
import createExpense from '../vue/createExpenses';
import editExpense from '../vue/editExpenses';
import loginPage from '../vue/loginPage';
import userChangePassword from '../vue/changePassword';
import createExpenseCategory from '../vue/formCategory';

const routes = [

    {

        path: '/',
        name: 'login.user',
        component: loginPage,

    },
    {

        path: '/all-user',
        name: 'index.user',
        component: App,

    },

    {

        path: '/user/create',
        name: 'user.create',
        component: CreateUser,

    },

    {

        path: '/user/:id/edit',
        name: 'user.edit',
        component: EditUser,
        props: true,

    },

    {

        path: '/user/:id/expenses',
        name: 'user.expenses',
        component: userExpenses,
        props: true,
    },

    {

        path: '/user/change-password',
        name: 'user.changepass',
        component: userChangePassword,
        
    },
    {

        path: '/user/category-form',
        name: 'user.category',
        component: createExpenseCategory,
        
    },

    {

        path: '/expenses/user/:id/create',
        name: 'expenses.create',
        component: createExpense,
        props: true
    },

    {

        path: '/expenses/user/edit/:id',
        name: 'user_expense.edit',
        component: editExpense,
        props: true
    },


];

export default createRouter({
    history: createWebHistory(),
    routes
})