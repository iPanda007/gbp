<script setup lang="ts">
import AdminAppLayout from '@/layouts/AdminAppLayout.vue';
import { Post, type BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';
import { Textarea } from '@/components/ui/textarea'
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import InputError from '@/components/InputError.vue';
import { ref } from 'vue';
import {  Select,
  SelectTrigger,
  SelectValue,
  SelectContent,
  SelectItem, } from '@/components/ui/select'

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Create Post',
        href: '/admin/posts',
    },
];

const props = defineProps(['categories', 'tags','status'])
const form = useForm<Post>({
    id:'',
    title: '',
    content: '',
    image: '',
    category_id:'',
    tag_id:'',
    status:'',
    popularity:0,
    created_at: '',
});

const imagePreview = ref<string | null>(null);

const submit = () => {
    form.post(route('posts.store'), {
      preserveScroll: true,
      forceFormData: true,
      onSuccess: () => {
        console.log('Created successfully!')
      },
    onError: (errors) => {
      console.error('Form submission errors:', errors)
    },
  });
};

const handleImageInput = (e: Event) => {
    const target = e.target as HTMLInputElement;
    const file = target.files?.[0];
    if (file) {
        form.image = file;
        imagePreview.value = URL.createObjectURL(file);
    }
};

</script>

<template>
    <Head title="Create Post" />

    <AdminAppLayout :breadcrumbs="breadcrumbs">
        <section class="bg-gbowhite py-8">
            <div class="border border-gray-200 rounded-lg shadow-sm max-w-4xl mx-auto p-6 bg-white">
                <div class="max-w-4xl mx-auto px-6 text-gboblack">
                <h2 class="text-3xl font-semibold mb-2">Add New Article</h2>
                <p class="text-sm text-gray-600 mb-6">Fill out the form below to publish a new post.</p>

                <form @submit.prevent="submit" class="space-y-6">

                    <!-- Image Upload -->
                    <div class="grid gap-2">
                         <div v-if="imagePreview" class="mt-2">
                            <img :src="imagePreview" alt="Preview" class="h-28 w-28 py-3 rounded object-cover border border-gray-200 shadow-sm" />
                        </div>
                        <Label for="image">Cover Image</Label>
                        <Input
                            id="image"
                            type="file"
                            :tabindex="2"
                            @change="handleImageInput"
                            class="h-10"
                        />
                        <InputError :message="form.errors.image" />
                    </div>
                    <!-- Title -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                        <div>
                            <Label for="title" class="mb-2">Title</Label>
                            <Input
                                id="title"
                                type="text"
                                autofocus
                                :tabindex="1"
                                autocomplete="title"
                                v-model="form.title"
                                placeholder="Enter your article title here"
                                class="py-5 "
                            />
                            <InputError :message="form.errors.title" />
                        </div>

                        <div>
                            <Label for="status" class="mb-2">Status</Label>
                            <Select v-model="form.status">
                                <SelectTrigger class="w-full">
                                    <SelectValue placeholder="Choose post status" />
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectItem
                                        v-for="status in props.status"
                                        :key="status"
                                        :value="status"
                                    >{{ status }}</SelectItem>
                                </SelectContent>
                            </Select>
                            <InputError :message="form.errors.status" />
                        </div>
                    </div>

                    <!-- Category & Tag -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <Label for="category" class="mb-2">Category</Label>
                            <Select v-model="form.category_id">
                                <SelectTrigger class="w-full">
                                    <SelectValue placeholder="Choose a category" />
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectItem
                                        v-for="category in props.categories"
                                        :key="category.id"
                                        :value="category.id"
                                    >{{ category.name }}</SelectItem>
                                </SelectContent>
                            </Select>
                            <InputError :message="form.errors.category_id" />
                        </div>

                        <div>
                            <Label for="tag" class="mb-2">Tag</Label>
                            <Select v-model="form.tag_id">
                                <SelectTrigger class="w-full">
                                    <SelectValue placeholder="Choose a tag" />
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectItem
                                        v-for="tag in props.tags"
                                        :key="tag.id"
                                        :value="tag.id"
                                    >{{ tag.name }}</SelectItem>
                                </SelectContent>
                            </Select>
                            <InputError :message="form.errors.tag_id" />
                        </div>
                    </div>

                    <!-- Content Editor -->
                    <div class="grid gap-2">
                        <Label for="content">Content</Label>
                        <quill-editor
                            placeholder="Write your content here..."
                            :toolbar="['bold', 'italic', 'underline', 'strike','blockquote', 'code-block','link','formula',,{ 'header': [1, 2, 3, 4, 5, 6, false] },{ 'size': ['small', false, 'large', 'huge'] },{ 'color': [] }, { 'background': [] }]"
                            theme="snow"
                            v-model:content="form.content"
                            contentType="html"
                        />
                        <InputError :message="form.errors.content" />
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <Button
                            type="submit"
                            class="w-full h-13 bg-gboprimary-600 hover:bg-gboprimary-800 text-white py-2.5 text-lg font-medium"
                            :tabindex="4"
                            :disabled="form.processing"
                        >
                            <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin mr-2 inline" />
                            Create Post
                        </Button>
                    </div>

                </form>
            </div>
            </div>
            
        </section>
    </AdminAppLayout>
</template>

<style scoped>
/* Custom styling for Quill editor to match form design */
:deep(.ql-editor) {
    min-height: 300px;
    overflow-y: auto;
    font-size: 14px;
    line-height: 1.5;
    padding: 12px;
    border: 1px solid #d1d5db;
    border-radius: 1px;
    background-color: white;
}

:deep(.ql-toolbar) {
    border: 1px solid #d1d5db;
    border-bottom: none;
    border-radius: 6px 6px 0 0;
    background-color: #f9fafb;
}

:deep(.ql-container) {
    border: 1px solid #d1d5db;
    border-top: none;
    border-radius: 0 0 6px 6px;
}

:deep(.ql-editor:focus) {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

:deep(.ql-editor.ql-blank::before) {
    color: #9ca3af;
    font-style: italic;
}

/* Error state styling */
:deep(.ql-editor.error) {
    border-color: #ef4444;
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
}
</style>
