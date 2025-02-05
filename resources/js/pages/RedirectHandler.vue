<script setup>
import { usePage } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import { router } from '@inertiajs/vue3';

const page = usePage();

onMounted(() => {
    if (page.props.redirect) {
        router.visit(page.props.redirect); // Arahkan user tanpa reload!
    }
});
</script>

<template>
    <div class="flex items-center justify-center h-screen">
        <p class="text-lg font-semibold">Redirecting...</p>
    </div>
</template>
