<template>
  <AppLayout current="Leads">
    <section class="space-y-6">
      <header>
        <h1 class="text-[33px] font-semibold tracking-[-0.04em] text-slate-900">Leads</h1>
        <p class="mt-1 text-[15px] text-slate-500">Manage prospects, saved searches, tags, and enrichment workflows from one view.</p>
      </header>

      <section class="grid gap-4 md:grid-cols-2 2xl:grid-cols-4">
        <article v-for="card in cards" :key="card.label" class="rounded-[22px] border border-slate-200/80 bg-white px-5 py-4 shadow-[0_20px_45px_rgba(15,23,42,0.05)]">
          <p class="text-[13px] font-medium text-slate-500">{{ card.label }}</p>
          <p class="mt-1 text-[33px] font-semibold tracking-[-0.04em] text-slate-900">{{ card.value }}</p>
          <p class="mt-3 text-xs font-semibold text-emerald-500">{{ card.delta }}</p>
        </article>
      </section>

      <div class="grid gap-5 xl:grid-cols-[minmax(0,1fr)_320px]">
        <article class="rounded-[24px] border border-slate-200/80 bg-white p-5 shadow-[0_20px_45px_rgba(15,23,42,0.05)]">
          <div class="mb-4 flex items-center justify-between">
            <h2 class="text-[24px] font-semibold tracking-[-0.03em] text-slate-900">Prospect Database</h2>
            <div class="flex gap-2">
              <button class="rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-600">Import CSV</button>
              <button class="rounded-xl bg-[#2f80ff] px-4 py-2 text-sm font-medium text-white">New Lead</button>
            </div>
          </div>
          <div class="overflow-hidden rounded-[18px] border border-slate-100">
            <table class="min-w-full text-left text-[14px] text-slate-600">
              <thead class="bg-slate-50/75 text-[11px] uppercase tracking-[0.08em] text-slate-400">
                <tr>
                  <th class="px-4 py-4 font-semibold">Lead</th>
                  <th class="px-4 py-4 font-semibold">Company</th>
                  <th class="px-4 py-4 font-semibold">Segment</th>
                  <th class="px-4 py-4 font-semibold">Score</th>
                  <th class="px-4 py-4 font-semibold">Status</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="lead in leads" :key="lead.name" class="border-t border-slate-100">
                  <td class="px-4 py-4 font-medium text-slate-800">{{ lead.name }}</td>
                  <td class="px-4 py-4">{{ lead.company }}</td>
                  <td class="px-4 py-4">{{ lead.segment }}</td>
                  <td class="px-4 py-4"><span class="rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold text-[#2f80ff]">{{ lead.score }}</span></td>
                  <td class="px-4 py-4"><span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-600">{{ lead.status }}</span></td>
                </tr>
              </tbody>
            </table>
          </div>
        </article>

        <aside class="space-y-5">
          <article class="rounded-[24px] border border-slate-200/80 bg-white p-5 shadow-[0_20px_45px_rgba(15,23,42,0.05)]">
            <h3 class="text-[22px] font-semibold tracking-[-0.03em] text-slate-900">Saved Segments</h3>
            <div class="mt-4 space-y-3 text-sm text-slate-600">
              <div v-for="segment in segments" :key="segment.name" class="rounded-2xl border border-slate-100 px-4 py-3">
                <p class="font-medium text-slate-800">{{ segment.name }}</p>
                <p class="mt-1 text-xs text-slate-400">{{ segment.count }} leads</p>
              </div>
            </div>
          </article>
          <article class="rounded-[24px] border border-slate-200/80 bg-white p-5 shadow-[0_20px_45px_rgba(15,23,42,0.05)]">
            <h3 class="text-[22px] font-semibold tracking-[-0.03em] text-slate-900">Enrichment Queue</h3>
            <div class="mt-4 space-y-3 text-sm text-slate-600">
              <div class="flex items-center justify-between"><span>Pending jobs</span><span class="font-semibold text-slate-800">48</span></div>
              <div class="flex items-center justify-between"><span>Duplicates flagged</span><span class="font-semibold text-slate-800">9</span></div>
              <div class="flex items-center justify-between"><span>AI scored today</span><span class="font-semibold text-slate-800">122</span></div>
            </div>
          </article>
        </aside>
      </div>
    </section>
  </AppLayout>
</template>

<script setup lang="ts">
import AppLayout from '../Layouts/AppLayout.vue';

const cards = [
  { label: 'Total Prospects', value: '4,286', delta: '↑ 14.8% this month' },
  { label: 'New This Week', value: '326', delta: '↑ 9.1% this week' },
  { label: 'Avg Lead Score', value: '76', delta: '↑ 5.4% quality lift' },
  { label: 'Saved Searches', value: '18', delta: '6 synced daily' },
];

const leads = [
  { name: 'Nadia Patel', company: 'BrightScale', segment: 'B2B SaaS CMOs', score: '91', status: 'Ready' },
  { name: 'Marcus Lee', company: 'Cloud Forge', segment: 'Series A Founders', score: '84', status: 'Ready' },
  { name: 'Angela Morris', company: 'RevPilot', segment: 'Sales Leaders', score: '79', status: 'Enriched' },
  { name: 'Tom Becker', company: 'Opslane', segment: 'Operations Heads', score: '73', status: 'Verified' },
];

const segments = [
  { name: 'SaaS Leaders Q3', count: 842 },
  { name: 'EMEA RevOps', count: 306 },
  { name: 'Startup Founders', count: 519 },
];
</script>