<template>
  <AppLayout current="Settings">
    <section class="space-y-6">
      <header>
        <h1 class="text-[33px] font-semibold tracking-[-0.04em] text-slate-900">Settings</h1>
        <p class="mt-1 text-[15px] text-slate-500">Configure workspace details, team permissions, notifications, and connected tools.</p>
      </header>
      <div class="grid gap-5 xl:grid-cols-2">
        <article class="rounded-[24px] border border-slate-200/80 bg-white p-6 shadow-[0_20px_45px_rgba(15,23,42,0.05)]">
          <h2 class="text-[24px] font-semibold tracking-[-0.03em] text-slate-900">Workspace Profile</h2>
          <div class="mt-5 space-y-4">
            <div class="rounded-2xl border border-slate-100 px-4 py-4"><p class="text-xs uppercase tracking-[0.08em] text-slate-400">Workspace Name</p><p class="mt-2 font-medium text-slate-800">LeadConnect Labs</p></div>
            <div class="rounded-2xl border border-slate-100 px-4 py-4"><p class="text-xs uppercase tracking-[0.08em] text-slate-400">Timezone</p><p class="mt-2 font-medium text-slate-800">UTC</p></div>
          </div>
        </article>
        <article class="rounded-[24px] border border-slate-200/80 bg-white p-6 shadow-[0_20px_45px_rgba(15,23,42,0.05)]">
          <h2 class="text-[24px] font-semibold tracking-[-0.03em] text-slate-900">Integrations</h2>
          <div class="mt-5 space-y-4 text-sm text-slate-600">
            <div class="flex items-center justify-between rounded-2xl border border-slate-100 px-4 py-4"><span>LinkedIn OAuth</span><span class="font-semibold text-emerald-500">Connected</span></div>
            <div class="flex items-center justify-between rounded-2xl border border-slate-100 px-4 py-4"><span>Google OAuth</span><span class="font-semibold text-amber-500">Pending</span></div>
            <div class="flex items-center justify-between rounded-2xl border border-slate-100 px-4 py-4"><span>Slack Notifications</span><span class="font-semibold text-slate-800">Enabled</span></div>
          </div>
        </article>
      </div>
    </section>
  </AppLayout>
</template>

<script setup lang="ts">
import AppLayout from '../Layouts/AppLayout.vue';
</script>