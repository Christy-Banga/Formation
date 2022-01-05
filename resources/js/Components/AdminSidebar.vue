<template>
    <div class="flex flex-col w-full sm:w-1/4">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <button class="flex justify-between items-center px-6 py-2 w-full
            focus:outline-none hover:bg-gray-500 hover:text-gray-50" @click="openAdmins =!openAdmins">
                <span>Admins</span>

                <svg xmlns="http://www.w3.org/2000/svg" v-if="openAdmins" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>

                <svg xmlns="http://www.w3.org/2000/svg" v-else class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
            </button>
            <div class="flex flex-col" v-if="openAdmins">
                <Link :href="route('admin.admins.index')" class="text-right capitalize border-t
                w-full px-6 py-2" :class="route().current('admin.admins.*') ?
                'text-gray-50 bg-gray-500' : 'hover:text-gray-50 hover:bg-gray-500'">Admins</Link>
                <Link :href="route('admin.roles.index')" class="text-right capitalize border-t w-full
                px-6 py-2" :class="route().current('admin.roles.*') ? 'text-gray-50 bg-gray-500':
                'hover:text-gray-50 hover:bg-gray-500'" v-if="$page.props.auth.can.accessRoles">Roles</Link>
                <Link :href="route('admin.users.index')" class="text-right capitalize border-t w-full
                px-6 py-2" :class="route().current('admin.users.*') ? 'text-gray-50 bg-gray-500':
                'hover:text-gray-50 hover:bg-gray-500'" v-if="$page.props.auth.can.accessUsers">Users</Link>
            </div>
            <Link :href="route('dashboard')" class="flex justify-between items-center border-t px-6 py-2
            capitalize hover:bg-gray-500 hover:text-gray-50">
                Dashboard
            </Link>
        </div>
    </div>
</template>

<script>
    import {Link} from '@inertiajs/inertia-vue3';

    export default {
        components: {
                Link
        },
        data(){
            return{
                openAdmins:false
            }
        }

    }
</script>
