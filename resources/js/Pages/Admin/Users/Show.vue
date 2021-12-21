<template>
    <admin-layout title="Dashboard">
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Users
                </h2>
            </div>

        </template>

        <div class="flex flex-col px-6 py-2">
            <div>
                <h2 class="text-center text-xl font-semibold capitalize underline">{{user.name}}</h2>
                <form @submit.prevent="submit">
                    <div class="flex flex-col mt-4">
                        <jet-label for="name" value="Name" class="text-xl"></jet-label>
                        <jet-input id="name" type="text" class="mt-1 block w-full disabled:opacity-50"
                        v-model="form.name" required autofocus disabled></jet-input>
                        <jet-input-error :message="form.errors.name" class="mt-2"></jet-input-error>
                    </div>
                    <div class="flex flex-col mt-4">
                        <jet-label for="email" value="Email" class="text-xl"></jet-label>
                        <jet-input id="email" type="email" class="mt-1 block w-full disabled:opacity-50"
                        v-model="form.email" required autofocus disabled></jet-input>
                        <jet-input-error :message="form.errors.email" class="mt-2"></jet-input-error>
                    </div>
                    <div class="flex flex-col mt-4">
                        <jet-label for="created_at" value="Joined" class="text-xl"></jet-label>
                        <jet-input id="created_at" type="text" class="mt-1 block w-full disabled:opacity-50"
                        v-model="form.created_at" required autofocus disabled></jet-input>
                        <jet-input-error :message="form.errors.created_at" class="mt-2"></jet-input-error>
                    </div>
                    <div class="flex flex-col mt-4">
                        <div class="inline-block relative">
                            <jet-label for="role" value="Role" class="text-xl"></jet-label>
                            <select name="" id="" class="block capitalize border-gray-300
                            focus:border-indigo-300 focus:ring focus:ring-indigo-200
                            focus:ring-opacity-50 rounded-md shadow-sm mt-1 w-full"
                            v-model="form.roles[0][0].name" tabindex="1">
                                <option v-for="(option,index) in allRoles" :key="index"
                                :value="option.name" :selected="option.name===form.roles[0][0]">
                                    {{option.name}}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="flex items-center justify-center mt-8">
                        <button type="submit" class="text-sm ml-4" :class="{'opacity-25':form.processing}" :disabled="form.processing">Update</button>
                        <Link :href="route('admin.users.index')" class="bg-gray-500 text-white p-1 mx-2 px-2 rounded"
                        >Cancel</Link>
                    </div>
                </form>
            </div>
        </div>

    </admin-layout>
</template>

<script>
    import AdminLayout from '@/Layouts/AdminLayout'
    import JetDangerButton from '@/Jetstream/DangerButton'
    import JetInputError from '@/Jetstream/InputError'
    import JetInput from '@/Jetstream/Input'
    import JetLabel from '@/Jetstream/Label'
    import {Link} from '@inertiajs/inertia-vue3';

    export default {
        props:['user','allRoles'],
        components:{
            AdminLayout,
            JetDangerButton,
            JetInputError,
            JetInput,
            JetLabel,
            Link
        },

       data(){
           return {
               form: this.$inertia.form({
                   name: this.user.name,
                   email: this.user.email,
                   created_at: this.user.created_at,
                   roles: []
               })
           }
       },
       created(){
           if(this.user.roles){
               return this.form.roles.push(this.user.roles)
           }
       },
       methods: {
           submit(){
               this.form.patch(this.route('admin.users.update',this.user.id),this.form)
           }
       }
    }
</script>
