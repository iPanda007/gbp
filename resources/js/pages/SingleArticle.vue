<script setup lang="ts">
import {Head,Link} from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { ref, computed } from 'vue';

const props = defineProps<{
    post: Post[] ,
    categories: { id: number, name: string }[],
    tags: { id: number, name: string }[]
}>();
console.log(props.post);
console.log(props.post.map(p=>p.category.name));

const posts = computed(() => props.post[0]);
console.log(posts.value.tag.name);
console.log(posts.value.id);


</script>

<template>
    <Head title="Single Article">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <AppLayout>

        <section class="bg-gbowhite py-12">
          <div class="grid grid-cols-1 md:grid-cols-4 gap-8 justify-center max-w-6xl mx-auto">
            <!-- Author Info -->
             <div v-if="posts" class="mb-4 p-4">
               <div class="md:col-span-1 bg-gbogray p-4 shadow h-[16rem]">
              <img :src="posts.user?.avatar ?? '/images/articles/Avatar.png'" class="w-18 h-18 rounded-full" alt="Author" />
              <h3 class="mt-4 font-semibold text-gboblack">{{ posts.user?.name }}</h3>
              <p class="text-sm text-gray-600">{{ posts.user?.university }}</p>
              <div class="mt-4 flex outline-2 outline-gray-400 rounded p-2">
                <img src="/images/icons/bard-fill.svg" alt="bard"/>
                <span class="text-gray-600 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">
                   {{ posts.contributions }} articles contribution
                </span>
              </div>
              </div>
             </div>


            <!-- Article Content -->
<div class="md:col-span-3">
  <div class="bg-white p-6 md:p-10 shadow rounded-lg">
    <div v-if="posts">
      <!-- Category and Tag -->
      <div class="flex flex-wrap items-center text-sm text-gray-500 mb-3">
        <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded mr-2">
          {{ posts.category.name }}
        </span>
        <div class="flex items-center space-x-1">
          <img src="/images/icons/tag.svg" alt="tag" class="w-4 h-4">
          <span class="text-gray-600">{{ posts.tag.name }}</span>
        </div>
      </div>

      <!-- Title -->
      <h1 class="text-3xl font-bold text-gray-900 mb-4">
        {{ posts.title }}
      </h1>

      <!-- Feature Image -->
      <div class="overflow-hidden rounded-lg mb-6">
        <img
          :src="posts.media_url"
          alt="Article Feature Image"
          class="w-full h-auto max-h-[480px] object-cover"
        />
      </div>

      <!-- Content from Quill Editor -->
      <div class="prose prose-sm md:prose lg:prose-lg max-w-none text-gray-800" v-html="posts.content"></div>
    </div>
  </div>
</div>
          </div>
        </section>
    </AppLayout>
</template>