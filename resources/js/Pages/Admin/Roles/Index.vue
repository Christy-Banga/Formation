<template>
    <admin-layout title="Dashboard">
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Roles
                </h2>
                <Link :href="route('admin.roles.create')" class="bg-blue-700 px-2 p-1 hover:bg-blue-500 transition text-white rounded-lg">Create</Link>
            </div>

        </template>

        <div class="text-center my-4" v-if="$page.props.flash.success">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{$page.props.flash.success}}</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                </span>
            </div>
        </div>

         <div class="text-center my-4" v-if="$page.props.flash.warning">
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{$page.props.flash.warning}}</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-yellow-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                </span>
            </div>
        </div>

         <div class="text-center my-4" v-if="$page.props.flash.danger">
            <div class="bg-red-100 border border-red-400 text-yellow-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{$page.props.flash.danger}}</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                </span>
            </div>
        </div>

        <div class="px-6 py-2">
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th class="text-left pl-3">Name</th>
                        <th class="text-left pl-3">Created</th>
                        <th class="text-right pr-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(role,index) in roles" :key="index" class="text-center hover:bg-gray-600 hover:text-gray-50">
                        <td class="text-left capitalize py-3 pl-3">{{role.name}}</td>
                        <td class="text-left py-3 pl-3">{{role.created_at}}</td>
                        <td class="py-3">
                            <div class="flex justify-end pr-3">
                                <Link :href="(route('admin.roles.show',role.id))" class="text-sm text-white uppercase bg-blue-500 mx-1 px-2 py-2 rounded-lg">Editer</Link>
                                <form @submit.prevent="submit(role.id)">
                                    <jet-danger-button type="submit" class="text-sm ml-1">Delete</jet-danger-button>
                                </form>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </admin-layout>
</template>

<script>
    import AdminLayout from '@/Layouts/AdminLayout'
    import JetDangerButton from '@/Jetstream/DangerButton'
    import {Link} from '@inertiajs/inertia-vue3';

    export default {
        props:['roles'],
        components:{
            AdminLayout,
            JetDangerButton,
            Link
        },
        methods: {
            submit(id){
                this.$inertia.delete(this.route('admin.roles.delete',id))
            },
        }
    }
</script>
