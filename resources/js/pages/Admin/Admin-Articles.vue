<script setup lang="ts">
import AdminAppLayout from '@/layouts/AdminAppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head,router } from '@inertiajs/vue3';
import { reactive } from 'vue'
import PlaceholderPattern from '@/components/PlaceholderPattern.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Ariticles',
        href: '/admin/admin-articles',
    },
];

import { ref } from 'vue'

const form = ref({
  title: '',
  image: null,
  content: '',
  category: '',
  tag: '',
  video: ''
})


const errors = reactive<{ [key: string]: string }>({})

const validateForm = () => {
  errors.title = form.value.title ? '' : 'Title is required.'
  errors.content = form.value.content ? '' : 'Content is required.'
  errors.category = form.value.category ? '' : 'Category is required.'
  errors.tag = form.value.tag ? '' : 'Tag is required.'

  return !Object.values(errors).some(e => e)
}

const categories = ref(['Design', 'Product', 'Software Engineering'])
const tags = ref(['UX', 'API', 'Project'])

const handleImageUpload = (e) => {
  form.value.image = e.target.files[0]
}

const postArticle = () => {
  if (!validateForm()) return

  const payload = new FormData()
  payload.append('title', form.value.title)
  if (form.value.image) payload.append('image', form.value.image)
  payload.append('content', form.value.content)
  payload.append('category', form.value.category)
  payload.append('tag', form.value.tag)
  payload.append('video', form.value.video)

  router.post('/admin/admin-articles', payload, {
    forceFormData: true,
    onError: (err) => {
      console.log('Error posting article:', err);
      Object.assign(errors, err)
    }
  })
}
</script>

<template>
    <Head title="Articles" />

    <AdminAppLayout :breadcrumbs="breadcrumbs">

    <section class="max-w-full bg-gbowhite">
        <div class="max-w-4xl mx-auto p-6 text-gboblack">
      <h2 class="text-xl font-semibold mb-4">Add New Articles</h2>

      <form @submit.prevent="postArticle" class="space-y-6">

        <div>
          <label class="block mb-1 font-medium">Title</label>
          <input v-model="form.title" type="text" class="w-full border p-2 rounded" />
          <span v-if="errors.title" class="text-red-500 text-sm">{{ errors.title }}</span>
        </div>
        <div>
          <label class="block mb-1 font-medium">Featured Image</label>
          <input type="file" @change="handleImageUpload" class="block" />
        </div>

        <div>
          <label class="block mb-1 font-medium">Content</label>
          <textarea v-model="form.content" class="w-full border p-2 rounded h-32" required></textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block mb-1 font-medium">Category</label>
            <select v-model="form.category" class="w-full border p-2 rounded" required>
              <option value="">- Select -</option>
              <option v-for="cat in categories" :key="cat" :value="cat">{{ cat }}</option>
            </select>
          </div>

          <div>
            <label class="block mb-1 font-medium">Tag</label>
            <select v-model="form.tag" class="w-full border p-2 rounded" required>
              <option value="">- Select -</option>
              <option v-for="tag in tags" :key="tag" :value="tag">{{ tag }}</option>
            </select>
          </div>
        </div>

        <div>
          <label class="block mb-1 font-medium">Embedded Video</label>
          <textarea v-model="form.video" class="w-full border p-2 rounded h-20" placeholder="Paste YouTube iframe code here"></textarea>
        </div>

        <button type="submit" class="bg-indigo-500 text-white px-6 py-3 rounded hover:bg-indigo-600">
          Post Now
        </button>
      </form>
        </div>
    </section>






    </AdminAppLayout>
</template>

<style scoped>
textarea::placeholder {
  color: #cbd5e1;
}
</style>
