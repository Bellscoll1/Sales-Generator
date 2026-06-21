<template>
  <AppLayout current="Settings">
    <section class="space-y-6">
      <header>
        <h1 class="text-[33px] font-semibold tracking-[-0.04em] text-slate-900">Onboarding</h1>
        <p class="mt-1 text-[15px] text-slate-500">Complete the workspace setup to launch your first outbound campaign.</p>
      </header>

      <div class="grid gap-5 xl:grid-cols-[minmax(0,1fr)_320px]">
        <article class="rounded-[24px] border border-slate-200/80 bg-white p-6 shadow-[0_20px_45px_rgba(15,23,42,0.05)]">
          <div class="mb-5 flex items-center justify-between">
            <h2 class="text-[24px] font-semibold tracking-[-0.03em] text-slate-900">Checklist</h2>
            <span class="rounded-full bg-blue-50 px-3 py-1 text-sm font-medium text-[#2f80ff]">{{ steps.length }} steps</span>
          </div>
          <ol class="space-y-3">
            <li v-for="(step, idx) in steps" :key="step" class="flex items-center gap-4 rounded-2xl border border-slate-100 bg-slate-50/60 px-4 py-4 text-sm text-slate-700">
              <span class="flex h-10 w-10 items-center justify-center rounded-full bg-white text-sm font-semibold text-[#2f80ff] shadow-sm">{{ idx + 1 }}</span>
              <span class="font-medium">{{ step }}</span>
            </li>
          </ol>
        </article>

        <aside class="space-y-5">
          <article class="rounded-[24px] border border-slate-200/80 bg-white p-6 shadow-[0_20px_45px_rgba(15,23,42,0.05)]">
            <h3 class="text-[22px] font-semibold tracking-[-0.03em] text-slate-900">Workspace Health</h3>
            <div class="mt-4 space-y-4 text-sm text-slate-600">
              <div class="flex items-center justify-between"><span>Email verification</span><span class="font-semibold text-emerald-500">Ready</span></div>
              <div class="flex items-center justify-between"><span>Workspace created</span><span class="font-semibold text-amber-500">Pending</span></div>
              <div class="flex items-center justify-between"><span>LinkedIn connected</span><span class="font-semibold text-amber-500">Pending</span></div>
              <div class="flex items-center justify-between"><span>First campaign</span><span class="font-semibold text-amber-500">Pending</span></div>
            </div>
          </article>

          <article class="rounded-[24px] border border-slate-200/80 bg-white p-6 shadow-[0_20px_45px_rgba(15,23,42,0.05)]">
            <h3 class="text-[22px] font-semibold tracking-[-0.03em] text-slate-900">Recommended Next</h3>
            <p class="mt-3 text-sm leading-6 text-slate-500">Connect LinkedIn, import your first prospect list, and start a 3-step outbound campaign with AI personalization.</p>
            <button class="mt-5 inline-flex h-11 items-center gap-2 rounded-xl bg-[#2f80ff] px-5 text-sm font-medium text-white shadow-[0_16px_30px_rgba(47,128,255,0.28)]">
              <span>Continue Setup</span>
              <span>›</span>
            </button>
          </article>
        </aside>
      </div>
    </section>
  </AppLayout>
</template>

<script setup lang="ts">
import AppLayout from '../../Layouts/AppLayout.vue';
defineProps<{ steps: string[] }>();
</script>
