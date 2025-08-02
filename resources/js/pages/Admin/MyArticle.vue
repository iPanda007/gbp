<script setup lang="ts">
import AdminAppLayout from '@/layouts/AdminAppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import PlaceholderPattern from '@/components/PlaceholderPattern.vue';
import '@fortawesome/fontawesome-free/css/all.min.css'
import { Link } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'MyArticle',
        href: '/admin/myarticles',
    },
];

import { ref, computed, watch } from 'vue'

const search = ref('')

const articles = ref([
  { title: 'How to start using AI?', category: 'Tech', status: 'Pending', date: 'June 10,2025', popularity: 0 },
  { title: 'UX trends in 2025', category: 'Design', status: 'Approved', date: 'May 1, 2025', popularity: 2245 },
  { title: 'Freelancing 101', category: 'Culture', status: 'Declined', date: 'April 20, 2025', popularity: 0 },
  { title: 'Robotic Chapter 2', category: 'Tech', status: 'Approved', date: 'April 1, 2025', popularity: 1232 },
])

// Example: push a new article from another form (emulate form submission)
function addArticle(newArticle) {
  articles.value.unshift(newArticle)
}

// This should be triggered by your form's submit method
// Example only (not automatically triggered)
/*
addArticle({
  title: 'New AI Frameworks',
  category: 'Tech',
  status: 'Pending',
  date: 'July 3, 2025',
  popularity: 0
})
*/

const filteredArticles = computed(() => {
  return articles.value.filter(article => {
    return (
      article.title.toLowerCase().includes(search.value.toLowerCase()) ||
      article.category.toLowerCase().includes(search.value.toLowerCase())
    )
  })
})
</script>

<template>
    <Head title="My Article" />

    <AdminAppLayout :breadcrumbs="breadcrumbs">
        <section class="bg-gbowhite h-full">
            <div class="p-4 md:p-8">
                <div class="flex justify-between items-center mb-4 text-gboblack">
                <h2 class="text-xl font-semibold">My Articles</h2>
                <input
                    v-model="search"
                    type="text"
                    placeholder="Search by title, category"
                    class="border rounded px-3 py-2 w-full md:w-80"
                />
                </div>

                <div class="overflow-x-auto">
                <table class="min-w-full table-auto border-collapse">
                    <thead>
                    <tr class="bg-gray-100 text-left text-sm text-gboblack">
                        <th class="px-4 py-2 border">Title</th>
                        <th class="px-4 py-2 border">Category</th>
                        <th class="px-4 py-2 border">Status</th>
                        <th class="px-4 py-2 border">Date Posted</th>
                        <th class="px-4 py-2 border">Popularity</th>
                        <th class="px-4 py-2 border">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr
                        v-for="(article, index) in filteredArticles"
                        :key="index"
                        class="hover:bg-gray-50 text-sm text-gboblack"
                    >
                        <td class="px-4 py-2 border">{{ article.title }}</td>
                        <td class="px-4 py-2 border">{{ article.category }}</td>
                        <td class="px-4 py-2 border">{{ article.status }}</td>
                        <td class="px-4 py-2 border">{{ article.date }}</td>
                        <td class="px-4 py-2 border">{{ article.popularity }}</td>
                        <td class="px-4 py-2 border flex gap-2">
                        
                        <Button class="bg-gboprimary-600 hover:bg-gboprimary-400 text-white px-6 py-2 rounded font-semibold text-sm">
                                  <Link :href="route('edit-article')" class="text-sm ">
                                    <i class="fas fa-edit"></i>
                                  </Link>
                        </Button>
                        
                        <Button class="bg-green-700 hover:bg-green-500 text-white px-6 py-2 rounded font-semibold text-sm">
                                  <Link :href="route('edit-article')" class="text-sm ">
                                   <i class="fas fa-eye"></i>
                                  </Link>
                        </Button> 
                        <!-- <button class="text-gray-500 hover:underline"><i class="fas fa-lock"></i></button> -->
                      <Button class="bg-gray-700 hover:bg-gray-500 text-white px-6 py-2 rounded font-semibold text-sm">
                                  <Link :href="route('edit-article')" class="text-sm ">
                                    <i class="fas fa-lock"></i>
                                  </Link>
                        </Button>  
                      </td>
                    </tr>
                    </tbody>
                </table>

                <p v-if="filteredArticles.length === 0" class="mt-4 text-center text-gray-500">No articles found.</p>
                </div>
            </div>
        </section>
    </AdminAppLayout>
</template>
<style scoped>
input::placeholder {
  color: #94a3b8; /* Tailwind's slate-400 */
}
</style>