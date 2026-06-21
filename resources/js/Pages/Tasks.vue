<template>
  <AppLayout current="Tasks">
    <section class="space-y-6">
      <header>
        <h1 class="text-[33px] font-semibold tracking-[-0.04em] text-slate-900">Tasks</h1>
        <p class="mt-1 text-[15px] text-slate-500">Coordinate follow-ups, demos, and reminders with calendar and board-friendly layouts.</p>
      </header>
      <div class="grid gap-5 xl:grid-cols-3">
        <article v-for="column in columns" :key="column.name" class="rounded-[24px] border border-slate-200/80 bg-white p-4 shadow-[0_20px_45px_rgba(15,23,42,0.05)]">
          <div class="mb-4 flex items-center justify-between"><h2 class="text-lg font-semibold text-slate-900">{{ column.name }}</h2><span class="rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-500">{{ column.items.length }}</span></div>
          <div class="space-y-3">
            <div v-for="item in column.items" :key="item.title" class="rounded-2xl border border-slate-100 bg-slate-50/70 p-4">
              <p class="font-semibold text-slate-800">{{ item.title }}</p>
              <p class="mt-1 text-sm text-slate-400">{{ item.meta }}</p>
            </div>
          </div>
        </article>
      </div>
    </section>
  </AppLayout>
</template>

<script setup lang="ts">
import AppLayout from '../Layouts/AppLayout.vue';

const columns = [
  { name: 'Today', items: [{ title: 'Call Michael Chen', meta: '11:00 AM · Demo' }, { title: 'Review AI campaign draft', meta: '1:30 PM · Internal' }] },
  { name: 'Upcoming', items: [{ title: 'Send proposal to BrightScale', meta: 'Tomorrow · Email' }, { title: 'Prep QBR report', meta: 'Fri · Reporting' }] },
  { name: 'Completed', items: [{ title: 'Imported founder list', meta: 'Done · CSV Import' }, { title: 'Assigned inbox ownership', meta: 'Done · Ops' }] },
];
</script>