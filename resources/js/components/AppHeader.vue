<script setup lang="ts">
import AppLogo from '@/components/AppLogo.vue';
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import Breadcrumbs from '@/components/Breadcrumbs.vue';
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar';
import { Button } from '@/components/ui/button';
import { DropdownMenu, DropdownMenuContent, DropdownMenuTrigger } from '@/components/ui/dropdown-menu';
import { NavigationMenu, NavigationMenuItem, NavigationMenuList, navigationMenuTriggerStyle } from '@/components/ui/navigation-menu';
import { Sheet, SheetContent, SheetHeader, SheetTitle, SheetTrigger } from '@/components/ui/sheet';
import { Tooltip, TooltipContent, TooltipProvider, TooltipTrigger } from '@/components/ui/tooltip';
import UserMenuContent from '@/components/UserMenuContent.vue';
import { getInitials } from '@/composables/useInitials';
import type { BreadcrumbItem, NavItem } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';
import { BookOpen, Folder, LayoutGrid, Menu, Search } from 'lucide-vue-next';
import { ref, computed } from 'vue';

interface Props {
    breadcrumbs?: BreadcrumbItem[];
}

const props = withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});

const page = usePage();
const auth = computed(() => page.props.auth);
const isCurrentRoute = computed(() => (url: string) => page.url === url);

const activeItemStyles = computed(
    () => (url: string) => (isCurrentRoute.value(url) ? 'text-neutral-900 dark:bg-neutral-800 dark:text-neutral-100' : ''),
);

const mainNavItems: NavItem[] = [
    {
        title: 'Home',
        href: '/',
    },
    {
        title: 'Articles',
        href: '/all-articles',
    },
    {
        title: 'About',
        href: '/about',
    },
    {
        title: 'FAQs',
        href: '/faqs',
    },
    {
        title: 'Contact us',
        href: '/contact-us',
    },
];

const rightNavItems: NavItem[] = [
    {
        title: 'Repository',
        href: 'https://github.com/laravel/vue-starter-kit',
        icon: Folder,
    },
    {
        title: 'Documentation',
        href: 'https://laravel.com/docs/starter-kits#vue',
        icon: BookOpen,
    },
];
const isMobileMenuOpen = ref(false);
const toggleMobileMenu = () => {
  isMobileMenuOpen.value = !isMobileMenuOpen.value;
};
</script>

<template>
    <div>
    <!-- Top Bar -->
    <!-- <div class="w-full bg-neutral-100 h-10 flex items-center justify-end px-8 text-sm text-neutral-700">
      University portal
    </div> -->

    <!-- Main Navigation -->
    <div class="bg-white relative border-b">
      <div class="mx-auto flex h-20 items-center justify-between px-4 md:max-w-7xl">
        <!-- Logo -->
        <div class="flex items-center mr-8" style="min-width: 120px;">
          <Link :href="route('home')" class="flex items-center gap-x-2">
            <AppLogo />
          </Link>
        </div>

        <!-- Desktop Nav -->
        <nav class="hidden lg:flex flex-1 justify-center space-x-8">
          <template v-for="(item, index) in mainNavItems" :key="index">
            <Link
              :href="item.href"
              :class="[navigationMenuTriggerStyle(), activeItemStyles(item.href), 'h-12 flex items-center px-3 text-base font-medium relative']"
            >
              {{ item.title }}
            </Link>
          </template>
        </nav>

        <!-- CTA + Hamburger -->
        <div class="flex items-center space-x-4">
          <!-- CTA Button (Desktop) -->
          <div class="hidden lg:block" >
            <Link :href="route('plans')" v-show="$page.props.auth?.active_subscription?.[0]?.type == null">
              <Button class="bg-gboprimary-600 hover:bg-gboprimary-700 text-white rounded-full px-6 py-2 text-base font-medium shadow-none min-w-[200px]">
                Become a contributor
              </Button>
            </Link>
            <Link :href="route('premium-plan')"  v-show="$page.props.auth?.active_subscription?.[0]?.type == 'basic'">
              <Button class="bg-gboprimary-600 hover:bg-gboprimary-700 text-white rounded-full px-6 py-2 text-base font-medium shadow-none min-w-[200px]">
                Upgrade to premium
              </Button>
            </Link>

            <Button v-show="$page.props.auth?.active_subscription?.[0]?.type == 'premium'" class="bg-gboprimary-600 hover:bg-gboprimary-700 text-white rounded-full px-6 py-2 text-base font-medium shadow-none min-w-[200px]">
            Premium user
            </Button>

          </div>
          <span v-show="$page.props.auth.user">
                <i class="ri-notification-2-line me-2"></i>
                <Link href="chat">
                    <i class="ri-question-answer-line me-2"></i>
                </Link>
            </span>
            <DropdownMenu v-if="$page.props.auth.user">
                <DropdownMenuTrigger :as-child="true">
                    <Button
                        variant="ghost"
                        size="icon"
                        class="relative size-10 w-auto rounded-full p-1 focus-within:ring-2 focus-within:ring-primary"
                    >
                        <Avatar class="size-8 overflow-hidden rounded-full">
                            <AvatarImage v-if="auth.user?.avatar" :src="auth.user.avatar" :alt="auth.user.name" />
                            <AvatarFallback class="rounded-lg bg-neutral-200 font-semibold text-black dark:bg-neutral-700 dark:text-white">
                                {{ getInitials(auth.user?.name) }}
                            </AvatarFallback>
                        </Avatar>
                    </Button>
                </DropdownMenuTrigger>
                <DropdownMenuContent align="end" class="w-56">
                    <UserMenuContent :user="auth.user" />
                </DropdownMenuContent>
            </DropdownMenu>
            <!-- <template v-else>
                <Link
                    :href="route('login')"
                    class="inline-block rounded-sm border border-transparent px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#19140035] dark:text-[#EDEDEC] dark:hover:border-[#3E3E3A]"
                >
                    Log in
                </Link>
                <Link
                    :href="route('register')"
                    class="md:inline-block hidden rounded-sm  border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
                >
                    Register
                </Link>
            </template> -->

          <!-- Hamburger (Mobile) -->
          <button @click="toggleMobileMenu" class="lg:hidden text-gray-700 focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
              viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
              <template v-if="!isMobileMenuOpen">
                <path d="M4 6h16M4 12h16M4 18h16" />
              </template>
              <template v-else>
                <path d="M6 18L18 6M6 6l12 12" />
              </template>
            </svg>
          </button>
        </div>
      </div>

      <!-- Mobile Menu -->
      <div v-if="isMobileMenuOpen" class="lg:hidden bg-white px-4 py-4 space-y-2 shadow">
        <nav class="flex flex-col space-y-2">
          <template v-for="(item, index) in mainNavItems" :key="index">
            <Link
              :href="item.href"
              :class="[navigationMenuTriggerStyle(), activeItemStyles(item.href), 'block px-3 py-2 text-base font-medium rounded-md']"
            >
              {{ item.title }}
            </Link>
          </template>
          <Link :href="route('plans')"
            class="block bg-gboprimary-600 hover:bg-gboprimary-700 text-white rounded-full text-center px-4 py-2 mt-2">
            Become a contributor
          </Link>
        </nav>
      </div>
    </div>

    <!-- Breadcrumb -->
    <div v-if="props.breadcrumbs.length > 1" class="flex w-full border-b border-sidebar-border/70">
      <div class="mx-auto flex h-12 w-full items-center justify-start px-4 text-neutral-500 md:max-w-7xl">
        <Breadcrumbs :breadcrumbs="breadcrumbs" />
      </div>
    </div>
  </div>
</template>
