<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Dashboard
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div v-if="$page.flash.success" class="bg-green-200 text-green-500 p-3 ">
                  {{ $page.flash.success }}
              </div>
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <div class="w-full">
            <form
              class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4"
              @submit.prevent="submit"
            >
              <div class="mb-4">
                <label
                  class="block text-gray-700 text-sm font-bold mb-2"
                  for="title"
                >
                  Titre de la formation
                </label>
                <input
                  v-model="form.title"
                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                  id="title"
                  type="text"
                />
                <div class="bg-red-200  text-red-800 p-4 my-2" v-if="$page.errors.title">{{$page.errors.title[0]}}</div>
              </div>
              <div class="mb-6">
                <label
                  class="block text-gray-700 text-sm font-bold mb-2"
                  for="description"
                >
                  Description de la formation
                </label>
                <textarea
                  v-model="form.description"
                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                  id="description"
                ></textarea>
                    <div class="bg-red-200  text-red-800 p-4 my-2" v-if="$page.errors.description">{{$page.errors.description[0]}}</div>

              </div>

              <div class="mb-4">
                  <h2 class="text-2xl">Episodes de la formation</h2>
                  <div v-for="(episode,index) in form.episodes" :key="index">
                        <label
                  class="block text-gray-700 text-sm font-bold mb-2"
                  :for="'title'+[index+1]"
                >
                 Titre de l'episode n° {{ index + 1 }}
                </label>
                 <input
                  v-model="form.episodes[index].title"
                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                  :id="'title'+[index+1]"
                  type="text"
                />

                <div class="bg-red-200  text-red-800 p-4 my-2" v-if="$page.errors['episodes.'+index+'.title']">{{$page.errors['episodes.'+index+'.title'][0]}}</div>
                         <label
                  class="block text-gray-700 text-sm font-bold mb-2"
                  :for="'description'+[index]"
                >
                 Description de l'episode n° {{ index + 1 }}
                </label>
                 <textarea
                  v-model="form.episodes[index].description"
                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                  :id="'description'+[index]"
                  type="text"
                ></textarea>
                <div class="bg-red-200  text-red-800 p-4 my-2" v-if="$page.errors['episodes.'+index+'.description']">{{$page.errors['episodes.'+index+'.description'][0]}}</div>


                         <label
                  class="block text-gray-700 text-sm font-bold mb-2"
                  :for="'video_url'+[index]"
                >
                 Url de la video de l'episode n° {{ index + 1 }}
                </label>
                 <input
                  v-model="form.episodes[index].video_url"
                  class="shadow appearance-none border rounded w-full mb-5 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                  :id="'video_url'+[index]"
                  type="text"
                />
           <div class="bg-red-200  text-red-800 p-4 my-2" v-if="$page.errors['episodes.'+index+'.video_url']">{{$page.errors['episodes.'+index+'.video_url'][0]}}</div>

                  </div>
              </div>
            <button class="py-2 px-4 my-2 bg-green-600 rounded text-white block" v-if="form.episodes.length<15" @click.prevent="add()">+</button>
            <button class="py-2 px-4 my-2 bg-red-600 rounded text-white block" v-if="form.episodes.length>1" @click.prevent="remove()">Remove🗑️</button>

              <div class="flex items-center justify-between">
                <button
                  class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                  type="submit"
                >
                  Creer ma formation
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "./../Layouts/AppLayout";

export default {
  components: {
    AppLayout,
  },
  data() {
    return {
      form: {
        title: null,
        description: null,
        episodes:[
            {
                title:null,
                description:null,
                video_url:null
            }
        ]
      },
    };
  },
  methods: {
    submit() {
      this.$inertia.post("/courses", this.form);
    },
    add()
    {
        this.form.episodes.push( {
                title:null,
                description:null,
                video_url:null
            });
    },
    remove()
    {
        this.form.episodes.pop( {
                title:null,
                description:null,
                video_url:null
            });
    }
  },
};
</script>
