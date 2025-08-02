<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import  AppLayout  from '@/layouts/AppLayout.vue';
import { ref } from 'vue';

const activeIndexUniversities = ref<number | null>(null);
const activeIndexReaders = ref<number | null>(null);
const activeIndexTechnical = ref<number | null>(null);

const toggle = (index: number, section: string) => {
  if (section === 'universities') {
    activeIndexUniversities.value = activeIndexUniversities.value === index ? null : index;
  } else if (section === 'readers') {
    activeIndexReaders.value = activeIndexReaders.value === index ? null : index;
  } else if (section === 'technical') {
    activeIndexTechnical.value = activeIndexTechnical.value === index ? null : index;
  }
};

const faqs = [
  {
    question: 'How do universities subscribe?',
    answer:
      'A Design System is a super useful tool for designers. It helps keep designs consistent and makes the design process faster...'
  },
  {
    question: 'What types of content can we publish?',
    answer:
      'You can publish articles, research summaries, expert commentaries, and institutional insights.'
  },
  {
    question: 'How is payment processed?',
    answer:
      'Payments are processed securely via credit card or institutional invoicing through our payment gateway.'
  },
  {
    question: 'Can multiple contributors publish under one institution?',
    answer:
      'Yes, you can assign multiple authors under a single institutional account for collaborative publishing.'
  },
  {
    question: 'Can I edit my published article?',
    answer:
      'Yes, articles can be edited post-publishing with version tracking and editorial approval.'
  },
  {
    question: 'How do I become a contributor?',
    answer:
      'Contributors can register through our platform and verify their institutional affiliation to start publishing.'
  }
];
const faqs_readers=[
  {
  question:'Do I need a subscription to read articles?',
  answer:'A Design System is a super useful tool for designers. It helps keep designs consistent and makes the design process faster...'
  },
  {
    question:'How can I search for topics?',
    answer:'You can search for topics using the search bar on our platform. Simply enter keywords related to your topic of interest.'
  },
  {
    question:'How is content curated?',
    answer:'Content is curated through a combination of editorial oversight and community feedback. Our team reviews submissions for quality and relevance before publication.'
  }
];

const faqs_technical=[
  {
  question:'How do I reset my password?',
  answer:'A Design System is a super useful tool for designers. It helps keep designs consistent and makes the design process faster...'
  },
  {
    question:'What payment methods are accepted?',
    answer:'If you encounter a technical issue, please contact our support team via the help center or email us directly.'
  },
  {
    question:'How do I report a problem?',
    answer:'If you encounter a technical issue, please contact our support team via the help center or email us directly.'
  },
  {
    question:'Is my data secure?',
    answer:'We take data security seriously and implement various measures to protect your information. Please refer to our privacy policy for more details.'
  },
  
];

</script>

<template>
    <Head title="Faqs">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <AppLayout>
      <section>
        <!-- FAQ -->
      <div class="bg-gradient-to-r from-[#001848] to-[#001c58] text-white py-12 px-6">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center gap-10">
          <div class="md:w-1/2">
            <h2 class="text-2xl font-bold mb-4">Frequently asked questions</h2>
            <p>
              Find quick answers to the most common questions about subscriptions, publishing, contributions, and more. 
            </p>
          </div>
          <div class="md:w-1/2">
            <img src="/images/faq.png" alt="FAQ" class="w-full max-w-md mx-auto" />
          </div>
        </div>
      </div>
      </section>
      <section class="py-16 px-4 bg-white">
        <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-12 py-8 border-b-gray-200 border-b-2">
          <!-- Left Section -->
          <div class="flex flex-col items-start">
            <div class="text-3xl font-bold text-[#001848] mb-4">
              <img src="images/arrow-right-down-fill.png" alt="arrow icon"/>
              <!-- <span class="inline-block transform -rotate-45 text-xl">➤</span> -->
              For Universities & Institutions
            </div>
          </div>

          <!-- Right Section - Accordion -->
          <div class="space-y-4">
            <div
              v-for="(item, index) in faqs"
              :key="index"
              class="bg-white border rounded-lg shadow-sm overflow-hidden"
            >
              <button
                @click="toggle(index, 'universities')"
                class="w-full px-4 py-4 flex justify-between items-center text-left"
              >
                <span class="font-medium text-gray-900">{{ item.question }}</span>
                <span class="text-xl font-bold text-blue-600">
                  {{ activeIndexUniversities === index ? '−' : '+' }}
                </span>
              </button>
              <transition
              name="accordion"
              enter-active-class="transition-all duration-500 ease-in-out"
              leave-active-class="transition-all duration-500 ease-in-out"
>
              <div
                v-if="activeIndexUniversities === index"
                class="px-4 pb-4 text-sm text-gray-600"
              >
                {{ item.answer }}
              </div>
              </transition>
            </div>
          </div> 
        </div>
        <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-12 py-8 border-b-gray-200 border-b-2">
          <!-- Left Section -->
          <div class="flex flex-col items-start">
            <div class="text-3xl font-bold text-[#001848] mb-4">
              <img src="images/arrow-right-down-fill.png" alt="arrow icon"/>
              <!-- <span class="inline-block transform -rotate-45 text-xl">➤</span> -->
              For Readers
            </div>
          </div>

          <!-- Right Section - Accordion -->
          <div class="space-y-4">
            <div
              v-for="(item, index) in faqs_readers"
              :key="index"
              class="bg-white border rounded-lg shadow-sm overflow-hidden"
            >
              <button
                @click="toggle(index, 'readers')"
                class="w-full px-4 py-4 flex justify-between items-center text-left"
              >
                <span class="font-medium text-gray-900">{{ item.question }}</span>
                <span class="text-xl font-bold text-blue-600">
                  {{ activeIndexReaders === index ? '−' : '+' }}
                </span>
              </button>
              <transition
                name="accordion"
                enter-active-class="transition-all duration-500 ease-in-out"
                leave-active-class="transition-all duration-500 ease-in-out"
                >
              <div
                v-if="activeIndexReaders === index"
                class="px-4 pb-4 text-sm text-gray-600"
              >
                {{ item.answer }}
              </div>
              </transition>
            </div>
          </div>
        </div>
        <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-12 py-8">
          <!-- Left Section -->
          <div class="flex flex-col items-start">
            <div class="text-3xl font-bold text-[#001848] mb-4">
              <img src="images/arrow-right-down-fill.png" alt="arrow icon"/>
              <!-- <span class="inline-block transform -rotate-45 text-xl">➤</span> -->
              For Technical Support
            </div>
          </div>

          <!-- Right Section - Accordion -->
          <div class="space-y-4">
            <div
              v-for="(item, index) in faqs_technical"
              :key="index"
              class="bg-white border rounded-lg shadow-sm overflow-hidden"
            >
              <button
                @click="toggle(index, 'technical')"
                class="w-full px-4 py-4 flex justify-between items-center text-left"
              >
                <span class="font-medium text-gray-900">{{ item.question }}</span>
                <span class="text-xl font-bold text-blue-600">
                  {{ activeIndexTechnical === index ? '−' : '+' }}
                </span>
              </button>
              <transition
              name="accordion"
              enter-active-class="transition-all duration-500 ease-in-out"
              leave-active-class="transition-all duration-500 ease-in-out"
              >
              <div
                v-if="activeIndexTechnical === index"
                class="px-4 pb-4 text-sm text-gray-600"
              >
                {{ item.answer }}
              </div>
              </transition>
            </div>
          </div>
        </div>
      </section>
    </AppLayout>
</template>

<style>
.accordion-enter-from,
.accordion-leave-to {
  max-height: 0;
  opacity: 0;
}
.accordion-enter-to,
.accordion-leave-from {
  max-height: 500px;
  opacity: 1;
}
.accordion-enter-active,
.accordion-leave-active {
  overflow: hidden;
}
</style>

