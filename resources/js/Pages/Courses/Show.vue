<template>
  <app-layout>
      <template slot="header">
        {{course.title}}
      </template>
      <div  class="py-4 mx-8" >
           <div class="text-2xl">{{ this.courseShow.episodes[this.currentKey].title}}</div>
            <iframe class="w-full h-screen" :src="this.courseShow.episodes[this.currentKey].video_url" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
             <div class="text-sm text-gray-500">{{ this.courseShow.episodes[this.currentKey].description}}</div>
            <div class="py-6">
                <progress-bar :watched-episodes="watched" :episodes="course.episodes"></progress-bar>
            </div>
        <div class="mt-6">
            <ul v-for="(episode,index) in this.courseShow.episodes" :key="episode.id">
                <li class="mt-3 flex justify-between items-center" >
               <div>
                Episode n°{{index+1}} - {{episode.title }}
                <button class="text-gray-500 focus:text-indigo-500 outline-none"
                 @click="switchEpisode(index)">Voir l'episode</button>
               </div>

                <progress-button :episodeid="episode.id" :watched_episodes="watched"></progress-button>
                </li>
            </ul>
        </div>
      </div>
  </app-layout>
</template>

<script>
import AppLayout from './../../Layouts/AppLayout';
import ProgressButton from './ProgressButton';
import ProgressBar from './ProgressBar';
export default {
     components:{
         AppLayout,ProgressButton,ProgressBar
     },
     props :['course','watched'],
     data()
     {
         return{
             courseShow : this.course,
             currentKey :0,
         }
     },
     mounted(){

     },
     methods:{
         switchEpisode(index){
             this.currentKey = index
             window.scrollTo({
                 top:0,
                 left:0,
                 behavior:'smooth'


                 })
         }
     }
}
</script>

<style>

</style>
