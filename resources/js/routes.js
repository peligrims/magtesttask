import AllRealty from './components/AllRealty.vue';
import AddRealty from './components/AddRealty.vue';
import EditRealty from './components/EditRealty.vue';



export const routes = [
    {
        name: 'home',
        path: '/',
        component: AllRealty
    },
    {
        name: 'add',
        path: '/add',
        component: AddRealty
    },
    {
        name: 'edit',
        path: '/edit/:id',
        component: EditRealty
    },



];
