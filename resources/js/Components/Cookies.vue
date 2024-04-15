<script setup>
import { ref } from 'vue';
import Cookies from 'js-cookie';
import PrimaryButton from "@/Components/PrimaryButton.vue";

const acceptedCookies = ref(false);

const props = defineProps({
  text: {
    type: String,
    required: true
  },
});

function acceptCookies() {
  acceptedCookies.value = true;
  Cookies.set('acceptCookies', '2', { expires: 365 }); // Cookie válida por 1 año
}

if (!Cookies.get('acceptCookies')) {
  acceptedCookies.value = false;
} else {
  acceptedCookies.value = true;
}
</script>
Este sitio web utiliza cookies para garantizar que obtenga la mejor experiencia en nuestro sitio web.

<template>
    <div v-if="!acceptedCookies" class="fixed bottom-0 left-0 right-0 p-4 bg-gray-800 text-white text-center flex items-center justify-center">
      <p class="text-sm flex-grow">{{ props.text }}</p>
      <PrimaryButton @click="acceptCookies" class="">Aceptar</PrimaryButton>
    </div>
  </template>