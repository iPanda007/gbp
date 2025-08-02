<script setup lang="ts">
import {
  SidebarGroup,
  SidebarGroupLabel,
  SidebarMenu,
  SidebarMenuButton,
  SidebarMenuItem,
} from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps<{
  items: NavItem[];
}>();

const page = usePage();
const openMenus = ref<string[]>([]);

// Toggle submenu open state
const toggleMenu = (title: string) => {
  if (openMenus.value.includes(title)) {
    openMenus.value = openMenus.value.filter((t) => t !== title);
  } else {
    openMenus.value.push(title);
  }
};
</script>

<template>
  <SidebarGroup class="px-2 py-0">
    <SidebarGroupLabel>Platform</SidebarGroupLabel>

    <SidebarMenu>
      <!-- 🔹 Loop through items -->
      <template v-for="item in items" :key="item.title">
        <!-- 🔸 Check if item has children -->
        <SidebarMenuItem v-if="item.children">
          <!-- 🔹 Parent with toggle -->
          <SidebarMenuButton as-child @click="toggleMenu(item.title)" :tooltip="item.title">
            <div class="flex items-center justify-between w-full">
              <div class="flex items-center gap-2">
                <component :is="item.icon" />
                <span>{{ item.title }}</span>
              </div>
              <svg class="w-3 h-3 ml-auto" viewBox="0 0 20 20" fill="currentColor">
                <path
                  fill-rule="evenodd"
                  d="M5.23 7.21a.75.75 0 011.06.02L10 11.292l3.71-4.06a.75.75 0 111.08 1.04l-4.25 4.64a.75.75 0 01-1.08 0L5.25 8.27a.75.75 0 01-.02-1.06z"
                  clip-rule="evenodd"
                />
              </svg>
            </div>
          </SidebarMenuButton>

          <!-- 🔹 Render children when open -->
          <div v-show="openMenus.includes(item.title) " class="ml-6 mt-1 space-y-1">
            <SidebarMenuItem
              v-for="child in item.children"
              :key="child.title"
            >
              <SidebarMenuButton
                as-child
                :is-active="child.href === page.url"
                :tooltip="child.title"
              >
                <Link :href="child.href" class="text-sm flex items-center gap-2">
                  <component :is="child.icon" class="w-4 h-4" />
                  <span>{{ child.title }}</span>
                </Link>
              </SidebarMenuButton>
            </SidebarMenuItem>
          </div>
        </SidebarMenuItem>

        <!-- 🔸 Regular menu item (no children) -->
        <SidebarMenuItem v-else>
          <SidebarMenuButton
            as-child
            :is-active="item.href === page.url"
            :tooltip="item.title"
          >
            <Link :href="item.href" class="flex items-center gap-2">
              <component :is="item.icon" />
              <span>{{ item.title }}</span>
            </Link>
          </SidebarMenuButton>
        </SidebarMenuItem>
      </template>
    </SidebarMenu>
  </SidebarGroup>
</template>
