<template>
  <AppLayout>
    <section class="grid gap-4 md:grid-cols-4">
      <article v-for="card in cards" :key="card.label" class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
        <p class="text-xs uppercase tracking-wide text-slate-500">{{ card.label }}</p>
        <p class="mt-3 text-2xl font-semibold">{{ card.value }}</p>
      </article>
    </section>

    <section class="mt-6 grid gap-4 lg:grid-cols-3">
      <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm lg:col-span-2">
        <h2 class="text-sm font-semibold text-slate-800">Outreach Performance</h2>
        <div class="mt-4 h-48 rounded-xl bg-gradient-to-r from-blue-100 via-cyan-50 to-white"></div>
      </article>
      <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
        <h2 class="text-sm font-semibold text-slate-800">Upcoming Tasks</h2>
        <ul class="mt-3 space-y-2 text-sm text-slate-600">
          <li>Follow up with Acme Corp</li>
          <li>Review proposal for Northwind</li>
          <li>Prepare weekly pipeline report</li>
        </ul>
      </article>
    </section>
  </AppLayout>
</template>

<script setup lang="ts">
import AppLayout from '../Layouts/AppLayout.vue';

const cards = [
  { label: 'Total Leads', value: '1,284' },
  { label: 'Messages Sent', value: '6,442' },
  { label: 'Reply Rate', value: '28.4%' },
  { label: 'Revenue', value: '$182,400' },
];
</script>
