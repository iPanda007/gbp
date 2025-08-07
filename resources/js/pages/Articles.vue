<script setup lang="ts">

import { Head, Link,usePage } from '@inertiajs/vue3';
import FeatureArticle from '@/components/FeatureArticle.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { ref, computed } from 'vue';
import {Post} from '@/types';


const props = defineProps<{
    articles: Post[] ,
    categories: { id: number, name: string }[],
    tags: { id: number, name: string }[]
}>();


const search = ref('')
const selectedCategory = ref('')
const selectedTag = ref('')

const page = usePage();


const currentPage = ref(1)
const perPage = 6

const filteredArticles = computed(() => {
  return props.articles.filter(article => {
    const matchesSearch = article.title.toLowerCase().includes(search.value.toLowerCase())
    const matchesCategory = selectedCategory.value ? article.category_id === selectedCategory.value : true
    const matchesTag = selectedTag.value ? article.tag_id === selectedTag.value : true
    return matchesSearch && matchesCategory && matchesTag
  })
})

const totalPages = computed(() => Math.ceil(filteredArticles.value.length / perPage))

const paginatedArticles = computed(() => {
  const start = (currentPage.value - 1) * perPage
  return filteredArticles.value.slice(start, start + perPage)
})

function getPreview(html:any) {
  const div = document.createElement('div')
  div.innerHTML = html
  return (div.textContent || div.innerText || '').substring(0, 100) + '...'
}



</script>

<template>
  <Head title="Articles">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <AppLayout>
      <section>
        <!-- Articles Section -->
      <div class="bg-gradient-to-r from-[#001848] to-[#001c58] text-white py-12 px-6">
        <div class="max-w-[70%] mx-auto flex flex-col md:flex-row  gap-10">
          <div class="md:w-1/2 mt-8">
            <h2 class="text-2xl font-bold mb-4">Browse all articles</h2>
            <p class="w-[90%]">
              Discover thought-provoking insights from universities and institutions across the globe. Use filters and categories to find the content.
            </p>
          </div>
          <div class="md:w-1/2">
            <img src="/images/browse1-1.png" alt="Browse Articles" class="w-full max-w-md mx-auto" />
          </div>
        </div>
      </div>
      </section>
      <section class="bg-gbowhite py-12">
        <div class="p-4 max-w-7xl lg:max-w-[70%] mx-auto">
         <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
            <div class="flex gap-4 w-full md:w-auto">
              <div class="border rounded p-1">
                <select v-model="selectedCategory" class="p-2 w-full md:w-auto text-gboblack outline-none">
                    <option value=""><span class="text-gray-400">Sort by:</span> Category</option>
                    <option v-for="category in props.categories" :key="category.id" :value="category.id">{{ category.name }}</option>
                </select>
              </div>
                
               <div class="border rounded p-1">
                 <select v-model="selectedTag" class=" p-2 rounded w-full md:w-auto text-gboblack outline-none">
                    <option value=""><span class="text-gray-400">Sort by:</span> Tag</option>
                    <option v-for="tag in props.tags" :key="tag.id" :value="tag.id">{{ tag.name }}</option>
                </select>
               </div>
               
            </div>
            <input
            type="text"
            v-model="search"
            placeholder="Search"
            name="search"
            class="border rounded p-2 w-full md:w-84 text-gboblack placeholder-gray-400"
            />
        </div>
        <div class="">
            <div class="max-w-7xl mx-auto px-4 pb-10">
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    <FeatureArticle v-for="(article, index) in props.articles"
                    :key="article.id"
                    :article="article"
                    :index="index"/>
                </div>
            </div>
        </div>
        <!-- Pagination -->
        <div class="flex justify-end items-center gap-2 mt-8">
          <button
            class="px-3 py-1 border rounded hover:bg-gbogray text-gboblack"
            :disabled="currentPage === 1"
            @click="currentPage--"
          >
            &lt;
          </button>
          <button
            v-for="page in totalPages"
            :key="page"
            @click="currentPage = page"
            :class="[
              'px-3 py-1 border rounded',
              page === currentPage ? 'bg-gboprimary-800 text-gbowhite' : 'hover:bg-gbogray text-gboblack'
            ]"
          >
            {{ page }}
          </button>
          <button
            class="px-3 py-1 border rounded hover:bg-gbogray text-gboblack"
            :disabled="currentPage === totalPages"
            @click="currentPage++"
          >
            &gt;
          </button>
        </div>
      </div>
      </section>
    </AppLayout>
</template>
<style>
input[type="text"] {
  background-image: url('/images/icons/search.svg');
  background-position: 10px 10px;
  background-repeat: no-repeat;
   padding: 12px 20px 12px 40px;
}
</style>


