<script setup lang="ts">
import {Head,Link} from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { ref } from 'vue'

const step = ref(1)
const form = ref({
  firstName: '',
  lastName: '',
  country: '',
  university: '',
  email: '',
  password: '',
  confirmPassword: ''
})

function goToNextStep() {
  if (step.value < 5) step.value++
}

function handleRegister() {
  // Add validation here
  goToNextStep()
}
// Simulate email sent after registration
setTimeout(() => {
  step.value = 3
}, 10000)

const submitPayment = () => {
  // Payment logic goes here
  alert('Payment submitted');
  goToNextStep()
};

const basicPlan = ref(false);
const premiumPlan = ref(true); // checked and disabled

const confirmPayment = () => {
  alert('Payment confirmed!');
};
</script>

<template>
    <Head title="Contributors">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <AppLayout>
  <div class="min-h-screen bg-gray-700 flex items-center justify-center px-4">
    <div class="bg-white shadow-xl rounded-lg w-full max-w-2xl p-6 md:p-8">
      <!-- Step Indicator -->
      <div class="flex justify-between mb-6">
        <div class="flex items-center gap-2">
          <div class="w-8 h-8 flex items-center justify-center rounded-full"
               :class="step >= 1 ? 'bg-blue-500 text-white' : 'bg-gray-300 text-gray-600'">
               <span v-if="step >= 3">✓</span>
              <span v-else>1</span>
              </div>
          <span class="text-sm font-medium" :class="step >= 1 ? 'text-blue-500' : 'text-gray-400'">Registration</span>
        </div>
       
  
          
        
        <div class="flex items-center gap-2">
          <div class="w-8 h-8 flex items-center justify-center rounded-full"
               :class="step > 3 ? 'bg-blue-500 text-white' : 'bg-gray-300 text-gray-600'">
              <span v-if="step >= 4">✓</span>
              <span v-else>2</span>
              </div>
          <span class="text-sm font-medium" :class="step > 3 ? 'text-blue-500' : 'text-gray-400'">Payment</span>
        </div>
        <div class="flex items-center gap-2">
          <div class="w-8 h-8 flex items-center justify-center rounded-full"
               :class="step > 4 ? 'bg-blue-500 text-white' : 'bg-gray-300 text-gray-600'">3</div>
          <span class="text-sm font-medium" :class="step > 4 ? 'text-blue-500' : 'text-gray-400'">Confirmation</span>
        </div>
      </div>

      <!-- Step 1: Registration -->
      <div v-if="step === 1" class="space-y-4">
        <h2 class="text-center text-lg font-semibold text-gboblack">Personal Details</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <input v-model="form.firstName" type="text" placeholder="First name" class="w-full border p-2 rounded placeholder-gboprimary-200 text-gboblack" />

          <input v-model="form.lastName" type="text" placeholder="Last name" class="w-full border p-2 rounded placeholder-gboprimary-200 text-gboblack" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <select v-model="form.country" class="w-full border p-2 rounded text-gboblack">
            <option value="">Select Country</option>
            <option>Myanmar</option>
            <option>Thailand</option>
            <option>USA</option>
          </select>
          <select v-model="form.university" class="w-full border p-2 rounded text-gboblack">
            <option value="">Select University</option>
            <option>YTU</option>
            <option>UCSY</option>
            <option>MIT</option>
          </select>
        </div>

        <input v-model="form.email" type="email" placeholder="University Mail" class="w-full border p-2 rounded placeholder-gboprimary-200 text-gboblack" />

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <input v-model="form.password" type="password" placeholder="Password" class="w-full border p-2 rounded placeholder-gboprimary-200 text-gboblack" />
          <input v-model="form.confirmPassword" type="password" placeholder="Confirm Password" class="w-full border p-2 rounded placeholder-gboprimary-200 text-gboblack" />
        </div>

        <button @click="handleRegister"
                class="w-full mt-4 bg-indigo-600 hover:bg-indigo-700 text-white py-2 rounded transition">
          Register
        </button>
      </div>

      <!-- Step 2: Email Sent -->
      <div v-else-if="step === 2" class="text-center space-y-4 py-12">
        <h2 class="text-lg font-semibold">Check Your Email</h2>
        <p class="text-gray-600">A verification link has been sent. Click it to activate your account.</p>
      
        <!-- Progress Bar -->
        <div class="w-full max-w-md mx-auto mt-6">
          <div class="w-full h-2 bg-gray-200 rounded-full overflow-hidden">
            <div class="h-full bg-indigo-600 animate-progress rounded-full"></div>
          </div>
          <p class="text-sm text-gray-500 mt-2">Waiting for email verification...</p>
        </div>
      </div>
      <!-- Step 3: Payment -->
      <div v-else-if="step === 3" class="text-center space-y-4 py-12">
        <!-- Title -->
        <h2 class="text-center text-lg font-semibold mb-4 text-gboblack">Payment Information</h2>

        <!-- Payment Methods -->
        <div class="text-sm text-gray-700 mb-2">Select payment method</div>
        <div class="flex justify-center space-x-4 mb-6">
          <button class="border rounded-md p-2 hover:shadow-md focus:outline-blue-400">
            <img src="/images/icons/cc-visa-brands.svg" class="h-10 w-auto" alt="Visa" />
            
          </button>
          <button class="border rounded-md p-2 hover:shadow-md focus:outline-blue-400">
            <img src="/images/icons/cc-paypal-brands.svg" class="h-10 w-auto" alt="PayPal" />
            
          </button>
          <button class="border-2 border-blue-500 rounded-md p-2 shadow-md">
            <img src="/images/icons/cc-mastercard-brands.svg" class="h-10 w-auto" alt="Mastercard" />
          </button>
        </div>

        <!-- Card Fields -->
        <form @submit.prevent="submitPayment" class="space-y-4">
          <input type="text" placeholder="Card number" class="border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 w-full placeholder-gboprimary-200" />

          <div class="grid grid-cols-2 gap-4">
            <input type="text" placeholder="MM/YY" class="border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 w-full placeholder-gboprimary-200" />
            <input type="text" placeholder="Security code" class="border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 w-full placeholder-gboprimary-200" />
          </div>

          <input type="text" placeholder="Cardholder name" class="border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 w-full placeholder-gboprimary-200" />

          <select class="border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 w-full text-gboblack">
            <option disabled selected>Country/region</option>
            <option>United States</option>
            <option>United Kingdom</option>
            <option>Myanmar</option>
          </select>

          <input type="text" placeholder="Billing zip code" class="border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 w-full placeholder-gboprimary-200" />

          <!-- Submit Button -->
          <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 rounded">
            Continue
          </button>
        </form>
      </div>
      <!-- Step 4: Done -->
      <div v-else-if="step === 4" class="text-center space-y-4 py-12">
        <!-- Summary Card -->
        <div class="border rounded-md p-6 space-y-4">
          <h2 class="text-center font-semibold text-gray-700 text-lg">Summary</h2>

          <div class="flex items-center justify-between">
            <label class="flex items-center space-x-2 text-gray-600">
              <input type="checkbox" v-model="basicPlan" />
              <span>Basic Plan</span>
            </label>

            <label class="flex items-center space-x-2 text-gray-800 font-medium">
              <input type="checkbox" v-model="premiumPlan" checked disabled />
              <span class="text-indigo-600 font-semibold">Premium Plan</span>
            </label>
          </div>

          <!-- Phone input (disabled) -->
          <div class="relative">
            <input
              type="text"
              placeholder="007 xxxxx 631"
              class="form-input w-full bg-gray-100 text-gray-500"
              disabled
            />
            <span class="absolute left-3 top-2.5 text-gray-400">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m6 4h6M9 7h6m-6 4h6m-6 4h6M3 15h12M9 13v2" />
              </svg>
            </span>
          </div>

          <!-- Total -->
          <div class="flex justify-between font-semibold text-gray-800 border-t pt-4">
            <span>Total</span>
            <span>50000 MMK</span>
          </div>

          <!-- Confirm Button -->
          <button
            @click="confirmPayment"
            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 rounded mt-2"
          >
            Confirm Payment
          </button>
        </div>

      </div>
    </div>
  </div>
 </AppLayout>
</template>

<style scoped>
textarea::placeholder {
  color: #cbd5e1;
}
/* .input{
  @apply w-full border p-2 rounded;
} */
 @keyframes progress {
  0% {
    width: 0%;
  }
  100% {
    width: 100%;
  }
}

.animate-progress {
  animation: progress 3s ease-in-out infinite;
}
</style>
