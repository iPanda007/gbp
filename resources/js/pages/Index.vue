<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import  AppLayout  from '@/layouts/AppLayout.vue';
import HeroCarousel from '../components/HeroCarousel.vue';
import FeatureArticle from '../components/FeatureArticle.vue';
import PriceSection from '../components/PriceSection.vue';
import TruestedSection from '@/components/TruestedSection.vue';
import FeatureArticleTitle from '@/components/FeatureArticleTitle.vue';
//import Carousel from '@/components/Carousel.vue';


const logos = [
  { src: '/images/logo/vodafone.png', alt: 'Vodafone' },
  { src: '/images/logo/intel.png', alt: 'Intel' },
  { src: '/images/logo/tesla.png', alt: 'Tesla' },
  { src: '/images/logo/amd.png', alt: 'AMD' },
  { src: '/images/logo/talkit.png', alt: 'Talkit' },
]

const props = defineProps<{
    articles: [];
}>();
// const articles = [
//   {
//     category: 'Design',
//     title: 'UX review presentations',
//     description: 'How do you create compelling presentations that your colleagues and managers love?',
//     image: '/images/articles/Image (1).png',
//     author: 'Ms. Tiffany Kim',
//     university: 'Assumption University',
//     authorImage: '/images/articles/Avatar.png'
//   },
//   {
//     category: 'Product',
//     title: 'Migrating to Linear 101',
//     description: 'Linear helps streamline software projects, sprints, tasks, and bug tracking.',
//     image: '/images/articles/Image (2).png',
//     author: 'Mr. John Tam',
//     university: 'Stanford University',
//     authorImage: '/images/articles/Avatar (1).png'
//   },
//   {
//     category: 'Software Engineering',
//     title: 'Building API Stack',
//     description: 'The rise of RESTful APIs has been met by a rise in tools for creating, testing, and managing them.',
//     image: '/images/articles/Image (1).png',
//     author: 'Ms. Jean Witty',
//     university: 'MIT University',
//     authorImage: '/images/articles/Avatar (1).png'
//   },
//   // Duplicate to simulate more cards
//   {
//     category: 'Design',
//     title: 'UX review presentations',
//     description: 'How do you create compelling presentations that your colleagues and managers love?',
//     image: '/images/articles/Image (2).png',
//     author: 'Ms. Tiffany Kim',
//     university: 'Assumption University',
//     authorImage: '/images/articles/Avatar.png'
//   },
//   {
//     category: 'Product',
//     title: 'Migrating to Linear 101',
//     description: 'Linear helps streamline software projects, sprints, tasks, and bug tracking.',
//     image: '/images/articles/Image (1).png',
//     author: 'Mr. John Tam',
//     university: 'Stanford University',
//     authorImage: '/images/articles/Avatar (1).png'
//   },
//   {
//     category: 'Software Engineering',
//     title: 'Building API Stack',
//     description: 'The rise of RESTful APIs has been met by a rise in tools for creating, testing, and managing them.',
//     image: '/images/articles/Image (2).png',
//     author: 'Ms. Jean Witty',
//     university: 'MIT University',
//     authorImage: '/images/articles/Avatar.png'
//   }
// ]
</script>

<template>
    <Head title="Welcome">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <AppLayout>
      <HeroCarousel />
    <FeatureArticleTitle/>
    <div class="bg-white">
        <div class="max-w-7xl mx-auto px-4 pb-10">
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <FeatureArticle v-for="article in props.articles"
                :key="article.id"
                :article="article"/>
            </div>
        </div>
    </div>
      <TruestedSection/>
      <PriceSection/>
    </AppLayout>
</template>
