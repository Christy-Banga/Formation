<template>
    <admin-layout title="Dashboard">
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Ajouter > Roles
                </h2>
            </div>

        </template>

        <div class="px-6 py-2">
            <div>
                <h2 class="text-center text-xl font-semibold capitalize underline">{{form.name}}</h2>
                <form @submit.prevent="submit">
                    <div class="mt-4">
                        <jet-label for="name" value="Role Name" class="text-xl">Name</jet-label>
                        <jet-input id="name" type="text" class="mt-1 block w-full"
                        v-model="form.name"></jet-input>
                        <jet-input-error :message="form.errors.name" class="mt-2"></jet-input-error>
                    </div>
                    <div class="flex items-center justify-center mt-4">
                        <button type="submit" :class="{'opacity-25':form.processing}" :disabled="form.processing">Create</button>
                        <Link :href="route('admin.roles.index')" class="bg-gray-500 text-white p-1 mx-2 px-2 rounded"
                        >Cancelssss</Link>
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
                   name: this.name
               })
           }
       },
       methods: {
           submit(){
               this.form.post(this.route('admin.roles.store'))
           }
       }
    }
</script>
