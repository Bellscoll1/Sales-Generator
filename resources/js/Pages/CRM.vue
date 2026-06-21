<template>
  <AppLayout current="CRM">
    <section class="space-y-6">
      <header>
        <h1 class="text-[33px] font-semibold tracking-[-0.04em] text-slate-900">CRM</h1>
        <p class="mt-1 text-[15px] text-slate-500">Track pipeline progression, ownership, and forecasting with a clean deal board.</p>
      </header>

      <div class="grid gap-5 xl:grid-cols-4">
        <article v-for="stage in stages" :key="stage.name" class="rounded-[24px] border border-slate-200/80 bg-white p-4 shadow-[0_20px_45px_rgba(15,23,42,0.05)]">
          <div class="mb-4 flex items-center justify-between">
            <h2 class="text-lg font-semibold text-slate-900">{{ stage.name }}</h2>
            <span class="rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-500">{{ stage.count }}</span>
          </div>
          <div class="space-y-3">
            <div v-for="deal in stage.deals" :key="deal.name" class="rounded-2xl border border-slate-100 bg-slate-50/70 p-4">
              <p class="font-semibold text-slate-800">{{ deal.name }}</p>
              <p class="mt-1 text-sm text-slate-400">{{ deal.company }}</p>
              <div class="mt-3 flex items-center justify-between text-sm">
                <span class="text-slate-500">{{ deal.owner }}</span>
                <span class="font-semibold text-slate-800">{{ deal.value }}</span>
              </div>
            </div>
          </div>
        </article>
      </div>
    </section>
  </AppLayout>
</template>

<script setup lang="ts">
import AppLayout from '../Layouts/AppLayout.vue';

const stages = [
  { name: 'Lead', count: 12, deals: [{ name: 'Northwind Pilot', company: 'Northwind', owner: 'Jane', value: '$8.4k' }] },
  { name: 'Qualified', count: 8, deals: [{ name: 'Cloud Forge Expansion', company: 'Cloud Forge', owner: 'Liam', value: '$12.0k' }] },
  { name: 'Proposal', count: 7, deals: [{ name: 'BrightScale Annual', company: 'BrightScale', owner: 'Ava', value: '$18.5k' }] },
  { name: 'Negotiation', count: 3, deals: [{ name: 'RevPilot Renewal', company: 'RevPilot', owner: 'Noah', value: '$24.0k' }] },
];
</script>