<script setup lang="ts">
import {Link} from '@inertiajs/vue3';
</script>
<template>
  <section class="bg-white">
    <div class="max-w-7xl mx-auto px-4 py-12 grid lg:grid-cols-3 gap-8">
    <!-- Left CTA -->
    <div class="bg-gboprimary-700 text-white p-8 rounded-xl flex flex-col justify-between">
      <div>
        <h2 class="text-md font-medium mb-12">
          Are you a university or institution looking to share your insights?
        </h2>
        <div class="bg-gbosecondary-600 h-2 w-24 mb-2"></div>
        <p class="font-bold text-md mb-4">
          Partner with us to publish articles, gain visibility.
        </p>
      </div>
      <img
        src="/images/amico.png"
        alt="Partner Illustration"
        class="mt-8 w-full max-h-60 object-contain"
      />
    </div>

    <!-- Basic Plan -->
    <div class="border-2 border-gray-100 hover:border-gray-400 rounded-xl p-6 shadow-sm bg-white flex flex-col justify-between">
      <div>
        <span class="inline-block bg-gray-200 text-sm font-bold px-4 py-1 rounded-full mb-4 text-black">Basic plan</span>
        <p class="text-gray-700 text-sm mb-8 px-4">
          Best for small departments or institutions looking to start sharing content.
        </p>
        <ul class="space-y-3 mb-6 text-sm text-gray-700 border-t border-gray-300 py-6">
          <li class="flex px-2"><img src="images/icons/check 1.svg" class="px-2"/> Publish up to 5 articles per month</li>
          <li class="flex px-2"><img src="images/icons/check 1.svg" class="px-2"/> Access to the university admin panel</li>
          <li class="flex px-2"><img src="images/icons/check 1.svg" class="px-2"/> Article tagging and image uploads</li>
          <li class="flex px-2"><img src="images/icons/check 1.svg" class="px-2"/> Basic performance metrics</li>
          <li class="flex px-2"><img src="images/icons/check 1.svg" class="px-2"/> Contributor profile with logo</li>
          <li class="flex px-2"><img src="images/icons/check 1.svg" class="px-2"/> Email support</li>
        </ul>
      </div>
      <div class="mx-auto">
        <p class="text-3xl font-bold mb-4 text-black">$49<span class="text-base font-normal text-gray-300 mb-4">/month</span></p>
    <Link :href="route('basic-plan')" class="w-80 cursor-pointer inline-block text-center bg-gboprimary-600 hover:bg-gboprimary-700 text-white py-3.5 rounded-full">Subscribe</Link>
      </div>
    </div>

    <!-- Premium Plan -->
    <div class="border-2 border-yellow-200 hover:border-yellow-400 rounded-xl p-6 shadow-sm bg-white flex flex-col justify-between relative">
      <div class="absolute -top-3 -right-3">
        <img src="/images/logo/Premium.png" alt="Crown" class="w-8 h-8" />
      </div>
      <div>
        <span class="inline-block bg-yellow-400 text-sm font-bold px-4 py-1 rounded-full mb-4 text-black">
          Premium plan
        </span>
        <p class="text-gray-700 text-sm mb-8 px-4">
          Ideal for full academic institutions or universities with regular publishing goals.
        </p>

        <ul class="space-y-3 mb-6 text-sm text-gray-700 border-t border-gray-300 py-6">
          <li class="flex px-2"><img src="images/icons/check 1.svg" class="px-2"/> Unlimited article publishing</li>
          <li class="flex px-2"><img src="images/icons/check 1.svg" class="px-2"/> Placement in featured articles section</li>
          <li class="flex px-2"><img src="images/icons/check 1.svg" class="px-2"/> Enhanced contributor analytics</li>
          <li class="flex px-2"><img src="images/icons/check 1.svg" class="px-2"/> Basic performance metrics</li>
          <li class="flex px-2"><img src="images/icons/check 1.svg" class="px-2"/> Contributor profile with logo</li>
          <li class="flex px-2"><img src="images/icons/check 1.svg" class="px-2"/> Priority email & chat support</li>
        </ul>
      </div>
      <div class="mx-auto">
        <p class="text-3xl font-bold mb-4 text-black">$100<span class="text-base font-normal text-gray-300 mb-4">/month</span></p>
        <Link :href="route('premium-plan')" class="w-80 cursor-pointer inline-block text-center bg-gboprimary-600 hover:bg-gboprimary-700 text-white py-3.5 rounded-full">Subscribe</Link>
      </div>
    </div>
  </div>
  </section>
</template>
