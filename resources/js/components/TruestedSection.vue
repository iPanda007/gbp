<template>
  <section ref="trustedSection" class="bg-white">
    <!-- Left content -->
     <div class="max-w-7xl mx-auto px-6 py-16 grid lg:grid-cols-2 gap-8">
      <div class="flex flex-col justify-between">
        <div class="">
        <h2 class="text-2xl md:text-3xl font-extrabold mb-4 custombold">
          <span class="text-gboprimary-800 font-extrabold">Trusted by</span> <span class="text-gbosecondary-600 font-extrabold">experts worldwide</span>
        </h2>
        <p class="text-gray-600 mb-10 max-w-lg">
          Global Bright Opportunities connects readers with expert content from leading institutions.
        </p>

        <!-- Stats grid -->
        <div class="grid grid-cols-2 gap-6 text-center">
          <div class="flex">
            <div class="bg-gbosecondary-200 p-3 rounded-xl inline-block mb-2">
              <img src="/images/icons/Graduation hat (1).svg" alt="University icon" class="w-8 h-8" />
            </div>
            <div class="px-4">
              <p class="text-2xl font-extrabold text-gbosecondary-700">{{ counters.universities }}+</p>
              <p class="text-gboblack text-sm">University contributors</p>
            </div>
          </div>

          <div class="flex">
            <div class="bg-gbosecondary-200 p-3 rounded-xl inline-block mb-2">
              <img src="/images/icons/Newspaper (1).svg" alt="Articles icon" class="w-8 h-8" />
            </div>
            <div class="px-4">
              <p class="text-2xl font-extrabold text-gbosecondary-700">{{ counters.articles }}+</p>
              <p class="text-gboblack text-sm">Articles published</p>
            </div>
          </div>

          <div class="flex">
            <div class="bg-gbosecondary-200 p-3 rounded-xl inline-block mb-2">
              <img src="/images/icons/Earth (1).svg" alt="Globe icon" class="w-8 h-8" />
            </div>
            <div class="px-4">
              <p class="text-2xl font-extrabold text-gbosecondary-700">{{ counters.countries }}+</p>
              <p class="text-gboblack text-sm">Countries represented</p>
            </div>
          </div>

          <div class="flex">
            <div class="bg-gbosecondary-200 p-3 rounded-xl inline-block mb-2">
              <img src="/images/icons/Group (1).svg" alt="Group icon" class="w-8 h-8" />
            </div>
            <div class="px-4">
              <p class="text-2xl font-extrabold text-gbosecondary-700">{{ counters.readers }}+</p>
              <p class="text-gboblack text-sm">Engaged readers</p>
            </div>
          </div>
        </div>
      </div>
      </div>

      <!-- Right illustration -->
      <div class="flex flex-col justify-between items-center">
        <img src="/images/cuate.png" alt="Illustration" class="max-w-md w-full" />
      </div>
     </div>
   
  </section>
</template>

<script setup>
import { onMounted, ref, reactive } from 'vue'

const trustedSection = ref(null)
const hasAnimated = ref(false)

const counters = reactive({
  universities: 0,
  articles: 0,
  countries: 0,
  readers: 0,
})

const targetValues = {
  universities: 50,
  articles: 1200,
  countries: 15,
  readers: 30000,
}

function animateCounter(key, target, duration = 1000) {
  const start = performance.now()
  const step = (now) => {
    const progress = Math.min((now - start) / duration, 1)
    counters[key] = Math.floor(progress * target)
    if (progress < 1) requestAnimationFrame(step)
    else counters[key] = target
  }
  requestAnimationFrame(step)
}

function startCounting() {
  Object.entries(targetValues).forEach(([key, value]) => {
    animateCounter(key, value, 1500)
  })
}

onMounted(() => {
  const observer = new IntersectionObserver(
    (entries) => {
      const entry = entries[0]
      if (entry.isIntersecting && !hasAnimated.value) {
        hasAnimated.value = true
        startCounting()
        observer.disconnect()
      }
    },
    {
      threshold: 0.5, // Trigger when 50% is visible
    }
  )

  if (trustedSection.value) {
    observer.observe(trustedSection.value)
  }
})
</script>
<style>
.custombold {
  font-weight: 1000!important;
}
</style>