<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
defineProps({
    employees: Array,
})
</script>
<template>
    <AppLayout title="Dashboard">

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-xl sm:rounded-lg">
                    <Welcome :employees="employees" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
