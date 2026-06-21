<template>
  <AppLayout current="Deals">
    <section class="space-y-6">
      <header>
        <h1 class="text-[33px] font-semibold tracking-[-0.04em] text-slate-900">Deals</h1>
        <p class="mt-1 text-[15px] text-slate-500">Review active opportunities, close dates, owners, and win probability.</p>
      </header>
      <div class="grid gap-5 xl:grid-cols-[minmax(0,1fr)_320px]">
        <article class="rounded-[24px] border border-slate-200/80 bg-white p-5 shadow-[0_20px_45px_rgba(15,23,42,0.05)]">
          <div class="mb-4 flex items-center justify-between">
            <h2 class="text-[24px] font-semibold tracking-[-0.03em] text-slate-900">Opportunity List</h2>
            <button class="rounded-xl bg-[#2f80ff] px-4 py-2 text-sm font-medium text-white">Create Deal</button>
          </div>
          <div class="space-y-3">
            <div v-for="deal in deals" :key="deal.name" class="flex items-center justify-between rounded-2xl border border-slate-100 px-4 py-4">
              <div>
                <p class="font-semibold text-slate-800">{{ deal.name }}</p>
                <p class="mt-1 text-sm text-slate-400">{{ deal.owner }} · closes {{ deal.close }}</p>
              </div>
              <div class="text-right">
                <p class="font-semibold text-slate-900">{{ deal.value }}</p>
                <p class="mt-1 text-xs text-slate-400">{{ deal.stage }}</p>
              </div>
            </div>
          </div>
        </article>
        <aside class="space-y-5">
          <article class="rounded-[24px] border border-slate-200/80 bg-white p-5 shadow-[0_20px_45px_rgba(15,23,42,0.05)]">
            <h3 class="text-[22px] font-semibold tracking-[-0.03em] text-slate-900">Forecast</h3>
            <div class="mt-4 space-y-4 text-sm text-slate-600">
              <div class="flex items-center justify-between"><span>Weighted pipeline</span><span class="font-semibold text-slate-800">$182k</span></div>
              <div class="flex items-center justify-between"><span>Best case</span><span class="font-semibold text-slate-800">$244k</span></div>
              <div class="flex items-center justify-between"><span>Committed</span><span class="font-semibold text-slate-800">$96k</span></div>
            </div>
          </article>
        </aside>
      </div>
    </section>
  </AppLayout>
</template>

<script setup lang="ts">
import AppLayout from '../Layouts/AppLayout.vue';

const deals = [
  { name: 'GrowthCorp Expansion', owner: 'Sarah Kim', close: 'Aug 12', value: '$24,000', stage: 'Proposal' },
  { name: 'TechSolutions Team Rollout', owner: 'John Smith', close: 'Aug 18', value: '$16,500', stage: 'Qualified' },
  { name: 'NextGen Annual Contract', owner: 'Ava Brooks', close: 'Sep 02', value: '$31,000', stage: 'Negotiation' },
];
</script>