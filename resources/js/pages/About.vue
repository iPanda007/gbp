<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import  AppLayout  from '@/layouts/AppLayout.vue';

const benefits = [
  "Expand your institution’s global visibility",
  "Showcase original research and academic excellence",
  "Reach readers, students, and collaborators around the world",
  "Publish with confidence on a trusted, professional platform"
];
</script>

<template>
    <Head title="About">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <AppLayout>
    <section>
      <!-- Who we are -->
      <div class="bg-gradient-to-r from-[#001848] to-[#001c58] text-white py-12 px-6">
        <div class="max-w-5xl mx-auto flex flex-col md:flex-row items-center gap-10">
          <div class="md:w-1/2">
            <h2 class="text-2xl font-bold mb-4">Who we are</h2>
            <p>
              Global Bright Opportunities is a platform where universities, experts,
              and institutions share valuable insights with global readers.
            </p>
          </div>
          <div class="md:w-1/2">
            <img src="/images/explore1-2.png" alt="Who we are" class="w-full max-w-md mx-auto" />
          </div>
        </div>
      </div>

      <!-- Our mission -->
      <div class="bg-white py-12 px-6">
        <div class="max-w-5xl mx-auto flex flex-col md:flex-row items-center gap-10">
          <div class="md:w-1/2">
            <h2 class="text-2xl font-bold text-[#001848] mb-4">Our mission</h2>
          </div>
          <div class="md:w-1/2 text-[#1a1a1a]">
            <p>
              Our mission is to bridge the gap between academic institutions and worldwide audiences.
              We empower universities and organizations to publish meaningful content —
              from articles and studies to expert opinions — on a global stage.
            </p>
          </div>
        </div>
      </div>

      <!-- Who we serve -->
      <div class="bg-gray-100 py-12 px-6">
        <div class="max-w-5xl mx-auto">
          <h2 class="text-2xl font-bold text-[#001848] mb-10">Who we serve</h2>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Card 1 -->
            <div class="flex gap-4 items-start">
              <img src="/images/University.png" alt="Universities" class="w-30 h-30" />
              <div>
                <h3 class="font-bold text-[#001848] mb-1">Universities & Institutions</h3>
                <p class="text-[#444]">Subscribe to publish your research, insights, and academic content.</p>
              </div>
            </div>
            <!-- Card 2 -->
            <div class="flex gap-4 items-start">
              <img src="/images/reading-book.png" alt="Readers" class="w-30 h-30" />
              <div>
                <h3 class="font-bold text-[#001848] mb-1">Global Readers</h3>
                <p class="text-[#444]">Access reliable, thought-provoking content from credible academic sources.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="py-16 bg-white">
    <div class="max-w-5xl mx-auto">
      <!-- Heading -->
      <h2 class="text-2xl md:text-3xl font-bold text-[#001848] mb-10">
        Why partner with us?
      </h2>

      <!-- Partner Benefit Cards -->
      <div class="space-y-6">
        <div
          v-for="(item, index) in benefits"
          :key="index"
          class="bg-gray-50 p-6 shadow-sm rounded-md border-b-4 border-blue-200 flex items-start gap-4"
        >
          <div class="bg-blue-100 text-blue-700 font-bold w-8 h-8 flex items-center justify-center rounded">
            {{ index + 1 }}
          </div>
          <p class="text-gray-800">{{ item }}</p>
        </div>
      </div>
    </div>

    <!-- CTA Section -->
    <div class="mt-20 bg-[#001848] py-12 px-6">
      <div class="max-w-5xl mx-auto text-white p-6">
        <h3 class="text-lg md:text-2xl font-bold text-[#178fff] mb-4">
          Ready to share your knowledge with the world?
        </h3>
        <p class="mb-6">
          Subscribe to Global Bright Opportunities and begin publishing as an academic institution.
        </p>
        <button class="bg-[#178fff] hover:bg-blue-600 text-white font-semibold px-6 py-2 rounded-full transition">
          View subscription plans
        </button>
      </div>
    </div>
  </section>
    </AppLayout>
</template>
