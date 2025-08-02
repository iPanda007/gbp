<script setup lang="ts">
import Breadcrumbs from '@/components/Breadcrumbs.vue';
import { SidebarTrigger } from '@/components/ui/sidebar';
import type { BreadcrumbItemType } from '@/types';
import { ref, computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import { getInitials } from '@/composables/useInitials';
import { router } from '@inertiajs/vue3'

withDefaults(
    defineProps<{
        breadcrumbs?: BreadcrumbItemType[];
    }>(),
    {
        breadcrumbs: () => [],
    },
);
const dropdownOpen = ref(false)
const page = usePage();
const auth = computed(() => page.props.auth);

const toggleDropdown = () => {
  dropdownOpen.value = !dropdownOpen.value
}

const goToAddArticle = () => {
  router.visit(route('posts.create')) // or your correct route
}
</script>

<template>
    <header
        class="flex bg-gboprimary-500 text-white h-16 shrink-0 items-center gap-2 border-b border-sidebar-border/70 px-6 transition-[width,height] ease-linear group-has-data-[collapsible=icon]/sidebar-wrapper:h-12 md:px-4"
    >
        <div class="flex items-center gap-2">
            <SidebarTrigger class="-ml-1" />
            <template v-if="breadcrumbs && breadcrumbs.length > 0">
                <Breadcrumbs :breadcrumbs="breadcrumbs"  />
            </template>
        </div>
        <!-- Right side -->
        <div class="flex items-center gap-4 ml-auto">
        <!-- Add Article Button -->
        <button
            @click="goToAddArticle"
            class="flex cursor-pointer items-center gap-1 border border-gray-300 text-gray-700 px-3 py-1.5 rounded hover:bg-gray-100 transition bg-gbowhite"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 4v16m8-8H4" />
            </svg>
            <span class="hidden sm:inline">Article</span>
        </button>
        </div>
    </header>
</template>
