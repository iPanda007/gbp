<script setup>
import { ref } from 'vue'

const slides = ref([
  {
    title: 'WELCOME TO GLOBAL BRIGHT OPPORTUNITIES',
    subtitle: 'Where Knowledge connects with world',
    image: '/images/girl.png'
  },
  {
    title: 'PUBLISH WITH PURPOSE, REACH A GLOBAL AUDIENCE.',
    subtitle: 'Subscribe now →',
    image: '/images/girl.png'
  },
  {
    title: 'UNLOCK INSIGHTS FROM LEADING UNIVERSITIES',
    subtitle:'Read articles →',
    image: '/images/girl.png'
  }

])

const currentIndex = ref(0)

const next = () => {
  currentIndex.value = (currentIndex.value + 1) % slides.value.length
}

const prev = () => {
  currentIndex.value = (currentIndex.value - 1 + slides.value.length) % slides.value.length
}

const goTo = (index) => {
  currentIndex.value = index
}
</script>
<template>
  <div class="relative w-full overflow-hidden bg-gradient-to-l from-blue-800 to-blue-600 text-white custom-height">
    <!-- Slides -->
    <div class="flex transition-transform duration-700 ease-in-out" :style="{ transform: `translateX(-${currentIndex * 100}%)` }">
      <div v-for="(slide, index) in slides" :key="index" class="flex-none w-full flex items-center justify-between py-20 custom-padding">
        <!-- Left text -->
        <div class="max-w-lg">
          <h2 class="text-4xl font-bold mb-4">{{ slide.title }}</h2>
          <p class="text-lg">{{ slide.subtitle }}</p>
        </div>
        <!-- Right image -->
        <img :src="slide.image" alt="Smart Girl" class="rounded-2xl custom-width" />
      </div>
    </div>

    <!-- Arrows -->
    <button @click="prev" class="absolute left-4 top-1/2 -translate-y-1/2 text-3xl">&#10094;</button>
    <button @click="next" class="absolute right-4 top-1/2 -translate-y-1/2 text-3xl">&#10095;</button>

    <!-- Indicators -->
    <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2">
      <span
        v-for="(slide, index) in slides"
        :key="'dot-' + index"
        @click="goTo(index)"
        class="w-3 h-3 rounded-full cursor-pointer"
        :class="currentIndex === index ? 'bg-white' : 'bg-white/50'"
      ></span>
    </div>
  </div>
</template>



<style scoped>
/* Optional: smooth transition for carousel */
.custom-padding{
  padding: 0 10% 0 10%;
}
.custom-width{
  width:40%;
}
.custom-height{
  height: 80vh;
}
</style>
