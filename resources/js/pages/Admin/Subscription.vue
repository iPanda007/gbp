<script setup lang="ts">
import AdminAppLayout from '@/layouts/AdminAppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, router } from '@inertiajs/vue3';
import {Link,  usePage } from '@inertiajs/vue3';
import moment from 'moment';

const page = usePage();
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'SubscriptionPlan',
        href: '/admin/subscription-plan',
    },
];

const cancelSubscription = () => {
    if (confirm('Are you sure you want to cancel your subscription?')) {
        router.post(route('cancel-subscription'), {}, {
            preserveScroll: true,
            onSuccess: (page) => {
                alert('Subscription cancelled successfully!');
                console.log('Response data:', page.props); // You can access response props here
            },
            onError: (errors) => {
                console.error('Error:', errors);
                alert('Something went wrong while cancelling.');
            },
            onFinish: () => {
                // Optional: always runs after success or error
            }
        });
    }
};

const resumeSubscription =()=>{
        if (confirm('Are you sure you want to resume your subscription?')) {
        router.post(route('resume-subscription'), {}, {
            preserveScroll: true,
            onSuccess: (page) => {
                alert('Subscription resumed successfully!');
                console.log('Response data:', page.props); // You can access response props here
            },
            onError: (errors) => {
                console.error('Error:', errors);
                alert('Something went wrong while resuming.');
            },
            onFinish: () => {
                // Optional: always runs after success or error
            }
        });
    }
}
</script>

<template>
    <Head title="Subscription Plan" />
    <AdminAppLayout :breadcrumbs="breadcrumbs">
        <section class="bg-white py-12">

                <div class="flex justify-end max-w-5xl mx-auto" v-if="$page.props.auth?.grace_period == false">

                    <button @click="cancelSubscription" class=" bg-red-700 hover:bg-red-800 text-white px-4 py-1 cursor-pointer rounded-lg font-medium">Cancel subscription</button>
                </div>

                <div class="flex justify-between max-w-5xl mx-auto" v-if="$page.props.auth?.grace_period == true">
                    <div class="flex items-center gap-2 bg-yellow-50 border border-yellow-200 rounded-lg p-4 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-4a1 1 0 10-2 0 1 1 0 002 0zm-.25-7.75a.75.75 0 00-1.5 0v4a.75.75 0 001.5 0v-4z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm text-yellow-700 font-medium">
                            Subscription will end on:
                            <span class="font-semibold">
                            {{ moment($page.props.auth?.active_subscription[0].ends_at).format('YYYY-MM-DD') }}
                            </span>
                        </span>
                    </div>
                    <button @click="resumeSubscription" class=" bg-green-700 hover:bg-green-800 text-white px-4 py-1 cursor-pointer rounded-lg font-medium">Resume subscription</button>
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
                    <li class="flex px-2"><img src="/images/icons/check 1.svg" class="px-2"/> Publish up to 5 articles per month</li>
                    <li class="flex px-2"><img src="/images/icons/check 1.svg" class="px-2"/> Access to the university admin panel</li>
                    <li class="flex px-2"><img src="/images/icons/check 1.svg" class="px-2"/> Article tagging and image uploads</li>
                    <li class="flex px-2"><img src="/images/icons/check 1.svg" class="px-2"/> Basic performance metrics</li>
                    <li class="flex px-2"><img src="/images/icons/check 1.svg" class="px-2"/> Contributor profile with logo</li>
                    <li class="flex px-2"><img src="/images/icons/check 1.svg" class="px-2"/> Email support</li>
                    </ul>
                </div>
                <div>
                    <p class="text-3xl font-bold mb-2 text-black">$49<span class="text-base font-normal text-gray-300">/month</span></p>
                    <button v-show="$page.props.auth?.active_subscription?.[0]?.type != null" class="w-full bg-blue-700 hover:bg-blue-800 text-white py-2 rounded-full">Active plan</button>
                     <Link v-show="$page.props.auth?.active_subscription?.[0]?.type == null" :href="route('premium-plan')" class="w-full cursor-pointer inline-block text-center bg-gboprimary-600 hover:bg-gboprimary-700 text-white py-2 rounded-full">Subscribe</Link>
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
                    <li class="flex px-2"><img src="/images/icons/check 1.svg" class="px-2"/> Unlimited article publishing</li>
                    <li class="flex px-2"><img src="/images/icons/check 1.svg" class="px-2"/> Placement in featured articles section</li>
                    <li class="flex px-2"><img src="/images/icons/check 1.svg" class="px-2"/> Enhanced contributor analytics</li>
                    <li class="flex px-2"><img src="/images/icons/check 1.svg" class="px-2"/> Basic performance metrics</li>
                    <li class="flex px-2"><img src="/images/icons/check 1.svg" class="px-2"/> Contributor profile with logo</li>
                    <li class="flex px-2"><img src="/images/icons/check 1.svg" class="px-2"/> Priority email & chat support</li>
                    </ul>
                </div>
                <div>
                    <p class="text-3xl font-bold mb-2 text-black">$100<span class="text-base font-normal text-gray-300">/month</span></p>
                     <Link v-show="$page.props.auth?.active_subscription?.[0]?.type != 'premium'" :href="route('premium-plan')" class="w-full cursor-pointer inline-block text-center bg-gboprimary-600 hover:bg-gboprimary-700 text-white py-2 rounded-full">Subscribe</Link>
                     <button v-show="$page.props.auth?.active_subscription?.[0]?.type == 'premium'" class="w-full bg-blue-700 hover:bg-blue-800 text-white py-2 rounded-full">Active plan</button>
                </div>
                </div>
                </div>
            </section>
    </AdminAppLayout>
</template>
