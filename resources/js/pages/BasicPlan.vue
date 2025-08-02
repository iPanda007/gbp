<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { loadStripe, Stripe, StripeCardElement } from '@stripe/stripe-js';
import { router } from '@inertiajs/vue3'

const props = defineProps<{
  stripeKey: string;
}>();
const stripeKey = props.stripeKey;

const stripePromise = loadStripe(stripeKey);

const stripe = ref<Stripe | null>(null);
const cardElement = ref<StripeCardElement | null>(null);
const errorMessage = ref('');
const successMessage = ref('');

onMounted(async () => {
 stripe.value = await stripePromise;
 if (stripe.value) {
   const elements = stripe.value.elements();
   cardElement.value = elements.create('card');
   cardElement.value.mount('#card-element');
 }
});

const handleSubmit = async (e: Event) => {
 e.preventDefault();
 errorMessage.value = '';
 successMessage.value = '';
 if (!stripe.value || !cardElement.value) return;

 const { error, paymentMethod } = await stripe.value.createPaymentMethod({
   type: 'card',
   card: cardElement.value,
 });

 if (error) {
   errorMessage.value = error.message || 'Payment failed.';
 } else {
   router.post('plans/subscription',{paymentMethodId:paymentMethod.id,plan:'basic'},
       {
           onError:()=>{},
           onSuccess:()=>{
             router.visit(route('dashboard'));
           }

       }
   )
   successMessage.value = `Success! PaymentMethod id: ${paymentMethod.id}`;
 }
};
</script>

<template>
 <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-50 via-white to-pink-50 py-12">
   <form @submit="handleSubmit" class="max-w-md w-full bg-white/90 rounded-2xl shadow-2xl p-8">
     <h2 class="text-2xl font-bold text-indigo-700 mb-4 text-center">Basic Plan subscription</h2>
     <div id="card-element" class="p-3 border border-gray-200 rounded-lg bg-gray-50 w-full mb-4"></div>
     <button type="submit" class="w-full bg-indigo-500 hover:bg-indigo-600 text-white font-semibold py-3 rounded-lg shadow-lg transition-all text-lg">
       Pay Now
     </button>
     <div v-if="errorMessage" class="text-red-600 mt-4 text-center">{{ errorMessage }}</div>
     <div v-if="successMessage" class="text-green-600 mt-4 text-center">{{ successMessage }}</div>
   </form>
 </div>
</template>

