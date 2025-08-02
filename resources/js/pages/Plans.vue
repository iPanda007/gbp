<script setup lang="ts">
import {Head,Link} from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
</script>

<template>
    <Head title="Contributors">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <AppLayout>
            <section class="bg-white py-12">
                <div class="w-full justify-center text-center">
                    <h1 class="font-bold text-gboprimary-600 text-2xl">Choose a Plan</h1>
                    <h5 class="text-gbosecondary-500">Partner with us to share your insights, gain visibility.</h5>
                </div>
                <div class="max-w-5xl mx-auto px-4 py-12 grid lg:grid-cols-2 gap-8">
                <!-- Basic Plan -->
                <div class="border rounded-xl p-6 shadow-sm bg-white flex flex-col justify-between">
                <div>
                    <span class="inline-block bg-gray-400 text-sm font-medium px-4 py-1 rounded-full mb-4 text-black">Basic plan</span>
                    <p class="text-gray-700 text-sm mb-6 px-4">
                    Best for small departments or institutions looking to start sharing content.
                    </p>
                    <ul class="space-y-3 mb-6 text-sm text-gray-700">
                    <li class="flex px-2"><img src="images/icons/check 1.svg" class="px-2"/> Publish up to 5 articles per month</li>
                    <li class="flex px-2"><img src="images/icons/check 1.svg" class="px-2"/> Access to the university admin panel</li>
                    <li class="flex px-2"><img src="images/icons/check 1.svg" class="px-2"/> Article tagging and image uploads</li>
                    <li class="flex px-2"><img src="images/icons/check 1.svg" class="px-2"/> Basic performance metrics</li>
                    <li class="flex px-2"><img src="images/icons/check 1.svg" class="px-2"/> Contributor profile with logo</li>
                    <li class="flex px-2"><img src="images/icons/check 1.svg" class="px-2"/> Email support</li>
                    </ul>
                </div>
                <div>
                    <p class="text-3xl font-bold mb-2 text-black">$49<span class="text-base font-normal text-gray-300">/month</span></p>
                    <Link :href="route('basic-plan')" class="w-full inline-block text-center bg-blue-700 hover:bg-blue-800 text-white py-2 rounded-full">Subscribe</Link>
                </div>
                </div>

                <!-- Premium Plan -->
                <div class="border-2 border-yellow-400 rounded-xl p-6 shadow-sm bg-white flex flex-col justify-between relative">
                <div class="absolute -top-3 -right-3">
                    <img src="/images/logo/Premium.png" alt="Crown" class="w-8 h-8" />
                </div>
                <div>
                    <span class="inline-block bg-yellow-400 text-sm font-medium px-4 py-1 rounded-full mb-4 text-black">
                    Premium plan
                    </span>
                    <p class="text-gray-700 text-sm mb-6 px-4">
                    Ideal for full academic institutions or universities with regular publishing goals.
                    </p>
                    <ul class="space-y-3 mb-6 text-sm text-gray-700">
                    <li class="flex px-2"><img src="images/icons/check 1.svg" class="px-2"/> Unlimited article publishing</li>
                    <li class="flex px-2"><img src="images/icons/check 1.svg" class="px-2"/> Placement in featured articles section</li>
                    <li class="flex px-2"><img src="images/icons/check 1.svg" class="px-2"/> Enhanced contributor analytics</li>
                    <li class="flex px-2"><img src="images/icons/check 1.svg" class="px-2"/> Basic performance metrics</li>
                    <li class="flex px-2"><img src="images/icons/check 1.svg" class="px-2"/> Contributor profile with logo</li>
                    <li class="flex px-2"><img src="images/icons/check 1.svg" class="px-2"/> Priority email & chat support</li>
                    </ul>
                </div>
                <div>
                    <p class="text-3xl font-bold mb-2 text-black">$100<span class="text-base font-normal text-gray-300">/month</span></p>
                    <Link :href="route('premium-plan')" class="w-full inline-block text-center bg-blue-700 hover:bg-blue-800 text-white py-2 rounded-full">Subscribe</Link>
                </div>
                </div>
                </div>
            </section>

    </AppLayout>
</template>
