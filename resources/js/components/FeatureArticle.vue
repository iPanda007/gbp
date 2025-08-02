<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps<{
  article: any;
}>();

function stripAndTruncate(html:any, length = 100) {
  const temp = document.createElement('div');
  temp.innerHTML = html;
  return temp.textContent?.slice(0, length) + '...';
}

const preview = computed(() => stripAndTruncate(props.article.content));

</script>

<template>

      <Link
        class="bg-white rounded shadow p-4"
        :href="route('single-article',article.id)"
      >
        <img :src="article.media_url" alt="" class="w-full h-68 object-cover" />
        <div class="p-4">
          <p class="text-sm text-gbosecondary-700 font-medium mb-3">{{ article.category.name }}</p>
          <h3 class="text-lg font-semibold mb-4 text-black">{{ article.title }}</h3>
          <p class="text-sm text-gray-600 mb-6">{{ preview }}</p>
          <div class="flex items-center gap-2">
            <img
              :src="article.authorImage ?? '/images/articles/Avatar.png'"
              alt="Author"
              class="w-8 h-8 rounded-full object-cover"
            />
            <div>
              <p class="text-sm font-medium text-black mb-1">{{ article.user.name }}</p>
              <p class="text-xs text-gray-500">{{ article.user.university ?? "" }}</p>
            </div>
          </div>
        </div>
    </Link>
</template>
