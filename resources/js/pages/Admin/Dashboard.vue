<script setup lang="ts">
import AdminAppLayout from '@/layouts/AdminAppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
//import PlaceholderPattern from '@components/PlaceholderPattern.vue';
import PlaceholderPattern from '@/components/PlaceholderPattern.vue';
import MonthlyChart from '@/pages/Admin/MonthlyChart.vue';
import '@fortawesome/fontawesome-free/css/all.min.css';
import { Link } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import moment from 'moment';


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/admin/dashboard',
    },
];

const props = defineProps<{
  articles: any;
}>();
</script>

<template>
    <Head title="Dashboard" />

    <AdminAppLayout :breadcrumbs="breadcrumbs">
    <section class="bg-gray-300">
<div class="p-4 space-y-6">
    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Popularity -->
            <div class="bg-gradient-to-br from-blue-50 to-white border border-blue-100 rounded-2xl p-6 shadow hover:shadow-md transition">
                <div class="flex items-center gap-4">
                <div class="bg-blue-100 text-blue-700 p-3 rounded-full">
                    <i class="fas fa-chart-line text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Popularity (Total Views)</p>
                    <p class="text-2xl font-bold text-blue-700">13,323</p>
                </div>
                </div>
            </div>

            <!-- Articles Published -->
            <div class="bg-gradient-to-br from-green-50 to-white border border-green-100 rounded-2xl p-6 shadow hover:shadow-md transition">
                <div class="flex items-center gap-4">
                <div class="bg-green-100 text-green-700 p-3 rounded-full">
                    <i class="fas fa-newspaper text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Articles Published</p>
                    <p class="text-2xl font-bold text-green-700">25</p>
                </div>
                </div>
            </div>

            <!-- Last Article Posted -->
            <div class="bg-gradient-to-br from-purple-50 to-white border border-purple-100 rounded-2xl p-6 shadow hover:shadow-md transition">
                <div class="flex items-center gap-4">
                <div class="bg-purple-100 text-purple-700 p-3 rounded-full">
                    <i class="fas fa-clock text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Last Article Posted</p>
                    <p class="text-2xl font-bold text-purple-700">May 21, 2025</p>
                </div>
                </div>
            </div>
    </div>

    <!-- Recent Articles Table -->
    <div class="bg-white border rounded-xl shadow-lg overflow-hidden text-gboblack">
    <div class="flex justify-between items-center px-6 pt-6 pb-2">
        <h2 class="text-xl font-semibold">Recent Articles</h2>
        <span class="text-sm text-gray-400">Updated {{ new Date().toLocaleDateString() }}</span>
    </div>
    <div class="overflow-x-auto p-4">
        <table class="min-w-full table-auto border-collapse text-sm">
        <thead>
            <tr class="bg-gray-100 text-left text-gray-700 uppercase tracking-wide">
            <th class="px-4 py-3 border">Image</th>
            <th class="px-4 py-3 border">Title</th>
            <th class="px-4 py-3 border">Category</th>
            <th class="px-4 py-3 border">Status</th>
            <th class="px-4 py-3 border">Date Posted</th>
            <th class="px-4 py-3 border">Popularity</th>
            <th class="px-4 py-3 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr
            v-for="(article, index) in props.articles"
            :key="index"
            class="hover:bg-gray-50 transition-colors duration-200"
            >
            <td class="px-4 py-2 border">
                <img :src="article.media_url" alt="Article" class="w-12 h-12 rounded-md object-cover" />
            </td>
            <td class="px-4 py-2 border font-medium text-gray-900">{{ article.title }}</td>
            <td class="px-4 py-2 border">{{ article.category.name }}</td>
            <td class="px-4 py-2 border">
                <span
                :class="{
                    'bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs': article.status === 'Published',
                    'bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full text-xs': article.status === 'Draft',
                }"
                >
                {{ article.status }}
                </span>
            </td>
            <td class="px-4 py-2 border text-gray-600">{{ moment(article.created_at).format('YYYY-MM-DD') }}</td>
            <td class="px-4 py-2 border text-blue-600 font-semibold">{{ article.popularity }}</td>
            <td class="px-4 py-2 border">
                <div class="flex space-x-2">
                <Link
                    :href="route('posts.edit', article.id)"
                    class="inline-flex items-center justify-center bg-blue-600 hover:bg-blue-500 text-white rounded px-3 py-1"
                >
                    <i class="fas fa-edit"></i>
                </Link>
                <Link
                    :href="route('single-article', article.id)"
                    class="inline-flex items-center justify-center bg-green-600 hover:bg-green-500 text-white rounded px-3 py-1"
                >
                    <i class="fas fa-eye"></i>
                </Link>
                <Link
                    :href="route('single-article', article.id)"
                    class="inline-flex items-center justify-center bg-gray-600 hover:bg-gray-500 text-white rounded px-3 py-1"
                >
                    <i class="fas fa-lock"></i>
                </Link>
                </div>
            </td>
            </tr>
        </tbody>
        </table>
    </div>
    </div>

    <!-- Chart -->
    <div class="bg-white border rounded shadow p-4">
      <h2 class="text-lg font-semibold mb-4">Monthly Views Trend</h2>
      <MonthlyChart />
    </div>
  </div>

    </section>
    </AdminAppLayout>
</template>
