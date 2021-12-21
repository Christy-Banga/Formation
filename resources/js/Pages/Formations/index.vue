<template>
    <app-layout title="Formation">
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Listes des formations
                </h2>
                <Link :href="route('dashboard')" class="bg-blue-700 px-2 p-2 hover:bg-blue-500 capitalize text-white font-bold rounded-lg">Ajouter</Link>
            </div>
        </template>

        <div class="mx-8 py-3">
            <div v-if="$page.props.flash.success" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
            {{ $page.props.flash.success }}
            </div>
        </div>

        <div class="mx-8 py-3">
            <div v-if="$page.props.flash.warning" class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative">
            {{ $page.props.flash.warning }}
            </div>
        </div>


        <div class="py-4" v-for="formation in this.formationList.data" v-bind:key="formation.id">
            <div class="mx-8 bg-white rounded shadow-lg p-4">
                Mise en ligne par
                <div class="text-sm rounded inline-block px-3"> {{ formation.user.name }}
                    - <span class="text-gray-500 text-sm">{{ formation.participants }} participant<span v-if="parseInt(formation.participants) > 1 ">s</span>
                    </span>
                </div>
                <div class="flex justify-between item-center">
                    <div class="text-4xl">{{ formation.title }}</div>
                    <div class="text-sm text-gray-600">{{ formation.episodes_count }} épisodes</div>
                </div>
                <div class="text-sm">{{ formation.description }}</div>
                <div class="flex items-center justify-between">
                    <Link :href="route('formations.show', {id: formation.id})" class="bg-blue-700 text-white px-3 py-1 mt-3 inline-block hover:bg-blue-500 rounded">Voir la formation</Link>
                    <Link :href="route('formations.edit', {id: formation.id})" v-if="formation.update" class="bg-gray-700 text-white px-3 py-1 mt-3 inline-block hover:bg-gray-600 rounded">Modifier la formation</Link>
                </div>
            </div>
        </div>

        <Link :href="link.url" class="text-indigo-700 border-gray-500 p-5" v-for="link in formations.links" v-bind:key="link.label">
            <span v-bind:class="{'text-red-700' : link.active}">{{link.label}}</span>
        </Link>

    </app-layout>

</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import {Link} from '@inertiajs/inertia-vue3';


    export default defineComponent({
        components: {
            AppLayout,
            Link
        },

        props : ['formations'],

        data () {
            return {
                formationList : this.formations
            }
        }
    })
</script>
