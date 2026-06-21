<template>
  <AppLayout current="Reports">
    <section class="space-y-6">
      <header>
        <h1 class="text-[33px] font-semibold tracking-[-0.04em] text-slate-900">Reports</h1>
        <p class="mt-1 text-[15px] text-slate-500">Measure reply rates, meetings booked, rep productivity, and revenue contribution.</p>
      </header>
      <section class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
        <article v-for="report in reports" :key="report.label" class="rounded-[22px] border border-slate-200/80 bg-white px-5 py-4 shadow-[0_20px_45px_rgba(15,23,42,0.05)]">
          <p class="text-[13px] font-medium text-slate-500">{{ report.label }}</p>
          <p class="mt-1 text-[33px] font-semibold tracking-[-0.04em] text-slate-900">{{ report.value }}</p>
          <p class="mt-3 text-xs font-semibold text-emerald-500">{{ report.note }}</p>
        </article>
      </section>
      <div class="grid gap-5 xl:grid-cols-2">
        <article class="rounded-[24px] border border-slate-200/80 bg-white p-5 shadow-[0_20px_45px_rgba(15,23,42,0.05)]">
          <h2 class="text-[24px] font-semibold tracking-[-0.03em] text-slate-900">Pipeline Value by Stage</h2>
          <div class="mt-5 h-64 rounded-[20px] bg-gradient-to-br from-blue-50 via-white to-emerald-50"></div>
        </article>
        <article class="rounded-[24px] border border-slate-200/80 bg-white p-5 shadow-[0_20px_45px_rgba(15,23,42,0.05)]">
          <h2 class="text-[24px] font-semibold tracking-[-0.03em] text-slate-900">Rep Performance</h2>
          <div class="mt-4 space-y-4 text-sm text-slate-600">
            <div class="flex items-center justify-between rounded-2xl border border-slate-100 px-4 py-4"><span>Sarah Kim</span><span class="font-semibold text-slate-800">14 meetings</span></div>
            <div class="flex items-center justify-between rounded-2xl border border-slate-100 px-4 py-4"><span>John Smith</span><span class="font-semibold text-slate-800">11 meetings</span></div>
            <div class="flex items-center justify-between rounded-2xl border border-slate-100 px-4 py-4"><span>Ava Brooks</span><span class="font-semibold text-slate-800">9 meetings</span></div>
          </div>
        </article>
      </div>
    </section>
  </AppLayout>
</template>

<script setup lang="ts">
import AppLayout from '../Layouts/AppLayout.vue';

const reports = [
  { label: 'Reply Rate', value: '28.4%', note: '↑ 4.2% over last month' },
  { label: 'Meeting Rate', value: '12.6%', note: '↑ 1.8% over last month' },
  { label: 'Pipeline Value', value: '$182k', note: '↑ 9.4% over last month' },
  { label: 'Revenue Won', value: '$64k', note: '↑ 6.3% over last month' },
];
</script>