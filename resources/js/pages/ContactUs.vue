<script setup lang="ts">
import { Head, Link, useForm,usePage } from '@inertiajs/vue3';
import  AppLayout  from '@/layouts/AppLayout.vue';
import { watch,ref } from 'vue';


import { CheckCircle2 } from 'lucide-vue-next';

const form = useForm({
  firstName: '',
  lastName: '',
  email: '',
  phone: '',
  message: ''
});

//const success = ref(false)
const flashSuccess = ref<string | null>(null);

// Watch for success flash message from Laravel
const page = usePage();
watch(
  () => page.props.flash?.success,
  (val) => {
    if (val) {
      flashSuccess.value = val;
      setTimeout(() => (flashSuccess.value = null), 4000);
    }
  },
  { immediate: true }
);

const resetform=()=>{
  form.reset();
}
const submitForm = () => {
  form.post(route('contact.send'),{
     onSuccess: () => {
        console.log('Created successfully!')
        resetform();
      },
      onError: (errors) => {
      console.error('Form submission errors:', errors)
    },
  });
  
};
</script>

<template>
    <Head title="Contact Us">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <AppLayout>
      <section>
        <!-- Contact Us -->
        <div class="bg-gradient-to-r from-[#001848] to-[#001c58] text-white py-12 px-6">
          <div class="max-w-[70%] mx-auto flex flex-col md:flex-row gap-10">
            <div class="md:w-1/2 mt-8">
              <h2 class="text-2xl font-bold mb-4">Get in touch</h2>
              <p class="w-[90%]">
                Have a question, feedback, or partnership inquiry? We’re here to help. Reach out to our team and we’ll get back to you as soon as possible.
              </p>
            </div>
            <div class="md:w-1/2">
              <img src="/images/contact.png" alt="Contact Us" class="w-80 max-w-md mx-auto" />
            </div>
          </div>
        </div>
      </section>
      <section class="bg-gray-50">
        <div class="mx-auto grid md:grid-cols-2 gap-8">

          <!-- Left Side: Form -->
          <div class="custom-padding ml-50">
            <h2 class="text-2xl md:text-3xl font-bold text-[#001848] mb-6">Send a message</h2>

            <form @submit.prevent="submitForm" class="space-y-4">
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <input v-model="form.firstName" type="text" placeholder="First Name*" required
                      class="border-1 border-[#EEEEEE] rounded px-4 py-2 w-full outline-blue-500 placeholder-zinc-500 bg-white text-black" />
                <input v-model="form.lastName" type="text" placeholder="Last Name*" required
                      class="border-1 border-[#EEEEEE] rounded px-4 py-2 w-full outline-blue-500 placeholder-zinc-500 bg-white  text-black" />
              </div>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <input v-model="form.email" type="email" placeholder="Email Address*" required
                      class="border-1 border-[#EEEEEE] rounded px-4 py-2 w-full outline-blue-500 placeholder-zinc-500 bg-white text-black" />
                <input v-model="form.phone" type="tel" placeholder="Phone Number*" required
                      class="border-1 border-[#EEEEEE] rounded px-4 py-2 w-full outline-blue-500 placeholder-zinc-500 bg-white text-black" />
              </div>
              <div>
                <textarea v-model="form.message"
                          maxlength="400"
                          rows="4"
                          placeholder="Message*"
                          required
                          class="border-1 border-[#EEEEEE] bg-white rounded px-4 py-2 w-full outline-blue-500 resize-none placeholder-zinc-500 text-black"></textarea>
                          <div class="flex">
                            <div class="w-full text-black">
                              Maximum 400 characters
                            </div>
                            <div class="w-full text-right text-sm text-black">{{ form.message.length }}/400</div>
                          </div>
                
              </div>

              <button type="submit"
                      class="w-full bg-[#00237D] text-white rounded-full px-10 py-4 font-semibold hover:bg-[#001848] transition">
                Submit
              </button>
            </form>
          <!-- <form @submit.prevent="submitForm">
      <div class="grid grid-cols-2 gap-4">
        <input v-model="form.firstName" placeholder="First Name*" />
        <input v-model="form.lastName" placeholder="Last Name*" />
        <input v-model="form.email" placeholder="Email Address*" />
        <input v-model="form.phone" placeholder="Phone Number*" />
      </div>

      <textarea v-model="form.message" maxlength="400" placeholder="Message*"></textarea>
      <p>{{ form.message.length }}/400</p>

      <button type="submit">Submit</button>
          </form> -->

        <p v-if="flashSuccess">Message sent successfully!</p>

          </div>

          <!-- Right Side: Contact Info -->
          <div class="bg-[#02165C] text-white p-8 space-y-8 py-16 custom-padding">
            <div>
              <h3 class="text-lg font-semibold mb-2">Contact us</h3>
              <ul class="space-y-2 text-sm">
                <li class="flex items-center gap-2"><img src="images/icons/phone-fill.svg"/> +66 123 456 789</li>
                <li class="flex items-center gap-2"><img src="images/icons/mail.svg"/> support@globalbrightopportunities.org</li>
                <li class="flex items-center gap-2"><img src="images/icons/location.svg"/> 123 Academic Lane, Bangkok, Thailand</li>
              </ul>
            </div>
            <br/><br/><br/>
            <div class="py-8">
              <h3 class="text-lg font-semibold mb-2">Follow us</h3>
              <div class="flex gap-4 text-2xl">
                <a href="#" aria-label="Facebook" class="hover:text-gray-300"><img src="images/icons/facebook-fill.svg"/></a>
                <a href="#" aria-label="LinkedIn" class="hover:text-gray-300"><img src="images/icons/linkedin.svg"/></a>
                <a href="#" aria-label="Instagram" class="hover:text-gray-300"><img src="images/icons/instagram-fill.svg"/></a>
              </div>
            </div>
          </div>
        </div>

        <div class="py-8 my-10">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d61412.35758033333!2d100.9029006958008!3d15.842276880183164!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x311fc078222a5f41%3A0x988f58c198bdb2ca!2sWat%20Takrut%20Hin!5e0!3m2!1sen!2smm!4v1751040312287!5m2!1sen!2smm" width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </section>
    </AppLayout>
</template>
