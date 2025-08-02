<script setup lang="ts">
import {
  Table,
  TableBody,
  TableCaption,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from '@/components/ui/table'
import AdminAppLayout from '@/layouts/AdminAppLayout.vue';
import { Post, type BreadcrumbItem } from '@/types';
import { Head, Link, usePage } from '@inertiajs/vue3';
import { onMounted, watch,computed } from 'vue';
import '@fortawesome/fontawesome-free/css/all.min.css'


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Posts',
        href: '/admin/posts',
    },
];

const props = defineProps<{
  posts: Post[];
  // categories: { id: number, name: string }[];
}>();

const posts = computed(() => props.post[0]);
const page = usePage();


</script>

<template>
    <Head title="My Articles" />
    <AdminAppLayout :breadcrumbs="breadcrumbs">
        <section class="bg-white py-8 h-full">
            <div class="max-w-6xl mx-auto px-4">
                <!-- Table Header -->
                <div class="grid grid-cols-7 font-semibold text-sm text-gray-600 bg-gray-100 px-4 py-2 rounded-t-lg border">
                <div>Image</div>
                <div>ID</div>
                <div>Title</div>
                <div>Status</div>
                <div>Category</div>
                <div>Date</div>
                <div class="text-right">Actions</div>
                </div>

                <!-- Table Rows -->
                <div v-for="post in props.posts" :key="post.id" class="grid grid-cols-7 items-center px-4 py-4 border-b hover:bg-gray-50 transition text-sm">
                <div>
                    <img
                    :src="post.media_url"
                    alt="Post image"
                    class="h-12 w-12 rounded-md object-cover border"
                    />
                </div>

                <!-- ID -->
                <div class="font-medium text-gray-700">#{{ post.id }}</div>

                <!-- Title -->
                <div class="truncate text-gray-800">{{ post.title }}</div>

                <!-- Status -->
                <div>
                    <span
                    :class="{
                        'bg-green-100 text-green-800': post.status === 'published',
                        'bg-yellow-100 text-yellow-800': post.status === 'draft',
                        'bg-red-100 text-red-800': post.status === 'archived'
                    }"
                    class="px-2 py-1 rounded text-xs font-semibold"
                    >
                    {{ post.status }}
                    </span>
                </div>

                <!-- Category -->
                <div class="text-gray-600 text-xs">
                     {{ post.category.name }}
                </div>

                <!-- Date -->
                <div class="text-gray-500 text-xs">
                    {{ new Date(post.created_at).toLocaleDateString() }}
                </div>

                <!-- Actions -->
                <div class="flex justify-end gap-3">
                    <Link :href="route('posts.edit', post.id)" class="text-blue-600 hover:text-blue-400" title="Edit">
                    <i class="fas fa-edit"></i>
                    </Link>
                    <Link :href="route('single-article', post.id)" class="text-green-600 hover:text-green-400" title="View">
                    <i class="fas fa-eye"></i>
                    </Link>
                    <Link :href="route('posts.destroy', post.id)" method="delete" as="button" class="text-red-600 hover:text-red-400" title="Delete">
                    <i class="fas fa-trash"></i>
                    </Link>
                </div>
                </div>
            </div>
        </section>
    </AdminAppLayout>
</template>
