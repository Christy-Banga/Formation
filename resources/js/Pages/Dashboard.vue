<template>
    <app-layout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Ajouter une formation
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="w-full">
                    <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" @submit.prevent="form.post('/formation')">
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                Titre de la formation
                            </label>
                            <input v-model="form.title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" type="text">
                            <div v-if="form.errors.title" class="bg-red-200 my-2 text-red-500">{{ form.errors.title }}</div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                                Description de la formation
                            </label>
                            <textarea v-model="form.description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="description" type="text" />
                            <div v-if="form.errors.description" class="text-red-500">{{ form.errors.description }}</div>
                        </div>

                        <div class="mb-4">
                            <h2 class="text-2xl">Episodes de la formation</h2>
                            <div v-for="(episode,index) in form.episodes" v-bind:key="index">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="'title-'+index">
                                    Titre de l'épisode N° {{ index + 1 }}
                                </label>
                                <input v-model="form.episodes[index].title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" :id="'title-'+index" type="text">
                                <div v-if="form.errors.title" class="text-red-500">{{ form.errors.title }}</div>

                                <label class="block text-gray-700 text-sm font-bold mb-2" for="'description-'+index">
                                    Description de l'episode N° {{ index + 1 }}
                                </label>
                                <textarea v-model="form.episodes[index].description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" :id="'description-'+index" type="text" />
                                <div v-if="form.errors.description" class="text-red-500">{{ form.errors.description }}</div>

                                <label class="block text-gray-700 text-sm font-bold mb-2" for="'video_url-'+index">
                                    URL de la video de l'episode N° {{ index + 1 }}
                                </label>
                                <input v-model="form.episodes[index].video_url" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-5" :id="'video_url-'+index" type="text" />
                                <div v-if="form.errors.video_url" class="text-red-500">{{ form.errors.video_url }}</div>
                            </div>
                        </div>


                        <button class="bg-green-500 hover:bg-green-700 rounded py-2 px-4 my-3 font-bold text-white" v-if="form.episodes.length < 15" @click.prevent="add">+</button>
                        <button class="bg-red-500 hover:bg-red-700 rounded py-2 ml-2 px-3 my-3 text-white" v-if="form.episodes.length > 1" @click.prevent="remove">🗑️</button>

                        <div class="flex space-x-4">
                            <div>
                                <Link :href="route('formations.index')" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline block">Retour</Link>
                            </div>
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline block" type="submit">
                                Créer ma formation
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import { useForm } from '@inertiajs/inertia-vue3'
    import {Link} from '@inertiajs/inertia-vue3';

    export default defineComponent({
        components: {
            AppLayout,
            Link
        },

        setup () {
            const form = useForm({
                title: null,
                description: null,
                episodes: [
                    {
                        title: null,
                        description: null,
                        video_url: null
                    }
                ]
            })

            return { form }
        },

        methods:{
            add(){
                this.form.episodes.push(
                    {
                        title: null,
                        description: null,
                        video_url: null
                    }
                )
            },

            remove(){
                this.form.episodes.pop()
            }
        }
    })
</script>
