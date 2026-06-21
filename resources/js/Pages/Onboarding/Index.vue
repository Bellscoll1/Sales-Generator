<template>
  <AppLayout>
    <div class="mx-auto max-w-3xl rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
      <h1 class="text-xl font-semibold">Onboarding Checklist</h1>
      <p class="mt-2 text-sm text-slate-600">Complete these steps to launch your first outbound campaign.</p>
      <ol class="mt-4 space-y-2">
        <li v-for="(step, idx) in steps" :key="step" class="rounded-xl border border-slate-100 p-3 text-sm">
          {{ idx + 1 }}. {{ step }}
        </li>
      </ol>
    </div>
  </AppLayout>
</template>

<script setup lang="ts">
import AppLayout from '../../Layouts/AppLayout.vue';
defineProps<{ steps: string[] }>();
</script>
