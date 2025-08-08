<template>
    <div id="watermark" class=" text-white p-4 rounded-lg shadow-lg bg-gboprimary-700 h-[132px] "  > 
        <!-- bg-gradient-to-br from-[#0C4866] to-[#0428AA]  -->
        <ul data-aos="fade-up" data-aos-duration="1000" class="max-w-7xl lg:max-w-[70%] mx-auto flex justify-between items-center h-full">
            <!-- <li v-for="watermark in watermarkes" :key="watermark.id" class="uppercase font-bold">
                {{ watermark.name }}
            </li> -->
            <li> <img src="images/watermark/vodafone.png" class="px-2"/> </li>
                <li><img src="images/watermark/intel.png" class="px-2"/> </li>
                <li><img src="images/watermark/tesla.png" class="px-2"/> </li>
                <li><img src="images/watermark/amd.png" class="px-2"/> </li>
                <li><img src="images/watermark/talkit.png" class="px-2"/> </li>
        </ul>
    </div>
    </template>

    <script setup>
// const watermarkes = [
//  { id: 1, name: 'vodafone', },
//  { id: 2, name: 'intel', },
//  { id: 3, name: 'TESLA', },
//  { id: 4, name: 'AMD', },
//  { id: 5, name: 'Talkit', },
// ];
</script>

<style scoped>
#watermark {
 padding: 20px; /* Add some padding around the logos */
}


#watermark li {
 color: #2445c9; /* Light blue text color */
 font-size: 1.5em; /* Adjust font size as needed */
 /* Add more styling for individual list items if needed */
}
</style>