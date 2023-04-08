<script setup>
import { onMounted } from "vue";

const props = defineProps({
    location: String,
});

onMounted(() => {
    setTimeout(() => {
        window.location = props.location;
    }, 500);
});
</script>

<template>
    <div class="container mx-auto h-screen prose mt-10">
        <h1 class="text-center">Redirecting</h1>
        <p class="text-center">You will redirect to admin panel</p>
        <div class="not-prose flex items-center justify-center">
            <svg
                class="animate-spin h-12 w-12 text-primary-500"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
            >
                <circle
                    class="opacity-25"
                    cx="12"
                    cy="12"
                    r="10"
                    stroke="currentColor"
                    stroke-width="4"
                />
                <path
                    class="opacity-75"
                    fill="currentColor"
                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                />
            </svg>
        </div>
    </div>
</template>
