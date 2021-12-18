<template>
    <app-layout title="Formation">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{formation.title}}
            </h2>
        </template>

        <div class="py-4 mx-6">
            <div class="text-2xl">{{ this.formationShow.episodes[this.currentKey].title }}</div>
            <iframe class="w-full h-screen" width="853" height="480" :src="this.formationShow.episodes[this.currentKey].video_url"
             title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write;
             encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <div class="text-sm text-gray-500">{{ this.formationShow.episodes[this.currentKey].description }}</div>

            <div class="py-6">
                <progress-bar :watched-episodes="watched" :episodes="formation.episodes" />
            </div>

            <div class="mt-6">
                <ul v-for="(episode,index) in this.formationShow.episodes" v-bind:key="episode.id">
                    <li class="mt-3 flex justify-between items-center">
                       <div>
                            Episode n°{{ index + 1 }} - {{ episode.title }}
                            <button class="text-gray-500 focus:text-indigo-500 focus:outline-none"
                            @click="switchEpisode(index)">Voir l'épisode
                            </button>
                       </div>
                        <progress-button :episode-id="episode.id" :watched-episodes="watched" />
                    </li>
                </ul>
            </div>
        </div>

    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import ProgressButton from '@/Components/ProgressButton.vue'
    import ProgressBar from '@/Components/ProgressBar.vue'


    export default defineComponent({
        components: {
            AppLayout,
            ProgressButton,
            ProgressBar
        },

        props : ['formation','watched'],

        data() {
            return {
                formationShow : this.formation,
                currentKey : 0
            }
        },

        methods: {
            switchEpisode(index){
                this.currentKey = index;

                window.scrollTo({
                    top:0,
                    left:0,
                    behavior:'smooth'
                })
            }
        }
    })
</script>
