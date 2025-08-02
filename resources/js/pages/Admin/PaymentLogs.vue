<script setup lang="ts">
import AdminAppLayout from '@/layouts/AdminAppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import PlaceholderPattern from '@/components/PlaceholderPattern.vue';
import moment from 'moment';
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'PaymentLogs',
        href: '/admin/payment-logs',
    },
];

const props = defineProps<{
    payments: any[]; // Adjust the type based on your actual data structure
}>();


</script>

<template>
    <Head title="Payment Logs" />
    <AdminAppLayout :breadcrumbs="breadcrumbs">
        <section class="bg-gbowhite h-full">
            <div class="p-4 md:p-8">
                <div class="items-center mb-4 text-gboblack">
                    <h2 class="text-xl font-semibold my-5">Payment Logs</h2>

                    <div class="overflow-x-auto rounded-lg shadow">
                        <table class="min-w-full table-auto border-collapse text-sm text-left text-gboblack">
                            <thead class="bg-gray-100 sticky top-0 z-10 shadow-sm">
                                <tr>
                                <th class="px-5 py-3 border-b">Transaction ID</th>
                                <th class="px-5 py-3 border-b">Start Date</th>
                                <th class="px-5 py-3 border-b">End Date</th>
                                <th class="px-5 py-3 border-b">Amount (USD)</th>
                                <th class="px-5 py-3 border-b">Status</th>
                                <th class="px-5 py-3 border-b">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                v-for="payment in props.payments"
                                :key="payment.id"
                                class="hover:bg-gray-50 even:bg-gray-50/50 transition-colors"
                                >
                                <td class="px-5 py-3 border-b">{{ payment.id }}</td>
                                <td class="px-5 py-3 border-b">
                                    {{ moment(payment.lines.data[0].period.start * 1000).format('YYYY-MM-DD') }}
                                </td>
                                <td class="px-5 py-3 border-b">
                                    {{ moment(payment.lines.data[0].period.end * 1000).format('YYYY-MM-DD') }}
                                </td>
                                <td class="px-5 py-3 border-b">
                                    ${{ (payment.subtotal / 100).toFixed(2) }}
                                </td>
                                <td class="px-5 py-3 border-b capitalize">
                                    <span
                                    :class="{
                                        'text-green-600 font-semibold': payment.status === 'paid',
                                        'text-yellow-600 font-semibold': payment.status === 'pending',
                                        'text-red-600 font-semibold': payment.status !== 'paid' && payment.status !== 'pending',
                                    }"
                                    >
                                    {{ payment.status }}
                                    </span>
                                </td>
                                <td class="px-5 py-3 border-b">
                                    <div class="flex gap-2">
                                    <a
                                        :href="payment.hosted_invoice_url"
                                        target="_blank"
                                        class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600"
                                    >
                                        View
                                    </a>
                                    <a
                                        :href="payment.invoice_pdf"
                                        target="_blank"
                                        class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600"
                                    >
                                        Download
                                    </a>
                                    </div>
                                </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </AdminAppLayout>
</template>
<style scoped>
</style>

