<template>
    <div>
        <button class="bg-green-500 px-2 py-3 rounded  text-white"
        @click="toggleProgress()">{{  this.isWatched ? 'Termine':'Termine ?'}}</button>
    </div>
</template>

<script>
export default {
    props:['episodeid','watched_episodes'],
    data(){
        return{
                watchedEp : this.watched_episodes,
                isWatched : null
        }
    },
    methods:{
        toggleProgress()
        {
            axios.post('/toggleProgress',{
                episodeid : this.episodeid
            }).then(response => {
                if(response.status==200)
                {
                    this.isWatched = !this.isWatched;
                }
           } )
            .catch(error=>console.log(error));
        },
        isWatchedep()
        {
            return this.watchedEp.find(episode => episode.id === this.episodeid )? true : false;
        }
    },
    mounted()
    {
        this.isWatched = this.isWatchedep();
    }
}
</script>

<style>

</style>
