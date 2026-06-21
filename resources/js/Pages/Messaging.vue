<template>
  <AppLayout current="Messaging">
    <section class="space-y-6">
      <header>
        <h1 class="text-[33px] font-semibold tracking-[-0.04em] text-slate-900">Messaging</h1>
        <p class="mt-1 text-[15px] text-slate-500">Stay on top of replies, assignments, and AI-generated follow-ups in one inbox.</p>
      </header>

      <div class="grid gap-5 xl:grid-cols-[340px_minmax(0,1fr)_300px]">
        <article class="rounded-[24px] border border-slate-200/80 bg-white p-4 shadow-[0_20px_45px_rgba(15,23,42,0.05)]">
          <div class="mb-4 flex items-center justify-between px-1">
            <h2 class="text-[22px] font-semibold tracking-[-0.03em] text-slate-900">Conversations</h2>
            <span class="rounded-full bg-[#2f80ff] px-2 py-0.5 text-[11px] font-semibold text-white">12</span>
          </div>
          <div class="space-y-3">
            <div v-for="thread in threads" :key="thread.name" class="rounded-2xl border border-slate-100 px-4 py-4">
              <div class="flex items-center justify-between gap-3">
                <p class="font-semibold text-slate-800">{{ thread.name }}</p>
                <span class="text-xs text-slate-400">{{ thread.time }}</span>
              </div>
              <p class="mt-1 text-sm text-slate-500">{{ thread.preview }}</p>
            </div>
          </div>
        </article>

        <article class="rounded-[24px] border border-slate-200/80 bg-white p-5 shadow-[0_20px_45px_rgba(15,23,42,0.05)]">
          <div class="mb-5 flex items-center justify-between">
            <div>
              <h2 class="text-[24px] font-semibold tracking-[-0.03em] text-slate-900">Michael Chen</h2>
              <p class="text-sm text-slate-400">Assigned to Sarah Lee</p>
            </div>
            <button class="rounded-xl border border-slate-200 px-4 py-2 text-sm font-medium text-slate-600">Assign</button>
          </div>
          <div class="space-y-4">
            <div class="max-w-[78%] rounded-2xl bg-slate-50 px-4 py-3 text-sm text-slate-600">Thanks for reaching out. I'd love to learn more about your workflow.</div>
            <div class="ml-auto max-w-[78%] rounded-2xl bg-[#2f80ff] px-4 py-3 text-sm text-white">Absolutely. We help sales teams automate LinkedIn outreach and unify pipeline activity.</div>
            <div class="max-w-[78%] rounded-2xl bg-slate-50 px-4 py-3 text-sm text-slate-600">Can you share pricing and a short demo?</div>
          </div>
          <div class="mt-6 rounded-[20px] border border-slate-100 bg-slate-50/80 p-4">
            <p class="mb-3 text-xs font-semibold uppercase tracking-[0.08em] text-slate-400">Reply Composer</p>
            <div class="min-h-28 rounded-2xl border border-slate-200 bg-white p-4 text-sm text-slate-400">Draft an AI-assisted response with meeting availability and pricing highlights.</div>
            <div class="mt-4 flex justify-end gap-2">
              <button class="rounded-xl border border-slate-200 px-4 py-2 text-sm font-medium text-slate-600">Generate with AI</button>
              <button class="rounded-xl bg-[#2f80ff] px-4 py-2 text-sm font-medium text-white">Send Reply</button>
            </div>
          </div>
        </article>

        <aside class="space-y-5">
          <article class="rounded-[24px] border border-slate-200/80 bg-white p-5 shadow-[0_20px_45px_rgba(15,23,42,0.05)]">
            <h3 class="text-[22px] font-semibold tracking-[-0.03em] text-slate-900">AI Suggestions</h3>
            <ul class="mt-4 space-y-3 text-sm text-slate-600">
              <li class="rounded-2xl border border-slate-100 px-4 py-3">Offer a 15-minute intro with two time slots.</li>
              <li class="rounded-2xl border border-slate-100 px-4 py-3">Mention LinkedIn and email automation in one sentence.</li>
              <li class="rounded-2xl border border-slate-100 px-4 py-3">Add social proof from SaaS customers.</li>
            </ul>
          </article>
          <article class="rounded-[24px] border border-slate-200/80 bg-white p-5 shadow-[0_20px_45px_rgba(15,23,42,0.05)]">
            <h3 class="text-[22px] font-semibold tracking-[-0.03em] text-slate-900">Thread Context</h3>
            <div class="mt-4 space-y-3 text-sm text-slate-600">
              <div class="flex items-center justify-between"><span>Lead score</span><span class="font-semibold text-slate-800">84</span></div>
              <div class="flex items-center justify-between"><span>Pipeline stage</span><span class="font-semibold text-slate-800">Qualified</span></div>
              <div class="flex items-center justify-between"><span>Last touch</span><span class="font-semibold text-slate-800">Today</span></div>
            </div>
          </article>
        </aside>
      </div>
    </section>
  </AppLayout>
</template>

<script setup lang="ts">
import AppLayout from '../Layouts/AppLayout.vue';

const threads = [
  { name: 'Michael Chen', preview: 'Can you share pricing and a short demo?', time: '3m' },
  { name: 'Sarah Johnson', preview: 'The campaign brief looks good to me.', time: '28m' },
  { name: 'Emily Davis', preview: 'Thanks, I reviewed the deck.', time: '1h' },
  { name: 'Ryan Clark', preview: 'Please resend the proposal PDF.', time: '3h' },
];
</script>