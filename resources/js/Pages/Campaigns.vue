<template>
  <AppLayout current="Campaigns">
    <section class="space-y-6">
      <header>
        <h1 class="text-[33px] font-semibold tracking-[-0.04em] text-slate-900">Campaigns</h1>
        <p class="mt-1 text-[15px] text-slate-500">Build multi-step sequences across LinkedIn and email with AI personalization.</p>
      </header>

      <section class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
        <article v-for="item in stats" :key="item.label" class="rounded-[22px] border border-slate-200/80 bg-white px-5 py-4 shadow-[0_20px_45px_rgba(15,23,42,0.05)]">
          <p class="text-[13px] font-medium text-slate-500">{{ item.label }}</p>
          <p class="mt-1 text-[33px] font-semibold tracking-[-0.04em] text-slate-900">{{ item.value }}</p>
          <p class="mt-3 text-xs font-semibold text-emerald-500">{{ item.note }}</p>
        </article>
      </section>

      <div class="grid gap-5 xl:grid-cols-[minmax(0,1fr)_320px]">
        <article class="rounded-[24px] border border-slate-200/80 bg-white p-5 shadow-[0_20px_45px_rgba(15,23,42,0.05)]">
          <div class="mb-4 flex items-center justify-between">
            <h2 class="text-[24px] font-semibold tracking-[-0.03em] text-slate-900">Active Sequences</h2>
            <button class="rounded-xl bg-[#2f80ff] px-4 py-2 text-sm font-medium text-white">New Campaign</button>
          </div>
          <div class="space-y-4">
            <div v-for="campaign in campaigns" :key="campaign.name" class="rounded-[20px] border border-slate-100 p-4">
              <div class="flex items-center justify-between gap-4">
                <div>
                  <p class="font-semibold text-slate-800">{{ campaign.name }}</p>
                  <p class="mt-1 text-sm text-slate-400">{{ campaign.steps }} steps · {{ campaign.type }}</p>
                </div>
                <span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-600">{{ campaign.status }}</span>
              </div>
              <div class="mt-4 grid gap-3 sm:grid-cols-4 text-sm text-slate-600">
                <div><p class="text-xs text-slate-400">Enrolled</p><p class="mt-1 font-semibold text-slate-800">{{ campaign.enrolled }}</p></div>
                <div><p class="text-xs text-slate-400">Replies</p><p class="mt-1 font-semibold text-slate-800">{{ campaign.replies }}</p></div>
                <div><p class="text-xs text-slate-400">Meetings</p><p class="mt-1 font-semibold text-slate-800">{{ campaign.meetings }}</p></div>
                <div><p class="text-xs text-slate-400">Conversion</p><p class="mt-1 font-semibold text-slate-800">{{ campaign.conversion }}</p></div>
              </div>
            </div>
          </div>
        </article>
        <aside class="space-y-5">
          <article class="rounded-[24px] border border-slate-200/80 bg-white p-5 shadow-[0_20px_45px_rgba(15,23,42,0.05)]">
            <h3 class="text-[22px] font-semibold tracking-[-0.03em] text-slate-900">Workflow Builder</h3>
            <div class="mt-4 space-y-3 text-sm text-slate-600">
              <div class="rounded-2xl border border-slate-100 px-4 py-3">1. Connection Request</div>
              <div class="rounded-2xl border border-slate-100 px-4 py-3">2. Wait 2 days</div>
              <div class="rounded-2xl border border-slate-100 px-4 py-3">3. AI Personalized Follow-up</div>
              <div class="rounded-2xl border border-dashed border-blue-200 bg-blue-50 px-4 py-3 text-[#2f80ff]">+ Add Step</div>
            </div>
          </article>
        </aside>
      </div>
    </section>
  </AppLayout>
</template>

<script setup lang="ts">
import AppLayout from '../Layouts/AppLayout.vue';

const stats = [
  { label: 'Active Campaigns', value: '14', note: '3 launched this week' },
  { label: 'Messages Sent', value: '2,140', note: '↑ 18.1% week over week' },
  { label: 'Replies', value: '284', note: '13.2% reply rate' },
  { label: 'Meetings Booked', value: '41', note: '↑ 7 new meetings' },
];

const campaigns = [
  { name: 'SaaS Leaders Outreach', steps: 5, type: 'Mixed Campaign', status: 'Running', enrolled: 240, replies: 42, meetings: 12, conversion: '17.5%' },
  { name: 'Founders Q3 Sequence', steps: 4, type: 'LinkedIn', status: 'Running', enrolled: 180, replies: 29, meetings: 7, conversion: '11.4%' },
  { name: 'RevOps Email Sprint', steps: 3, type: 'Email', status: 'Running', enrolled: 320, replies: 51, meetings: 10, conversion: '15.9%' },
];
</script>