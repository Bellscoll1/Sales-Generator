<template>
  <div class="min-h-screen bg-[radial-gradient(circle_at_top,#eef5ff_0%,#f8fbff_48%,#ffffff_100%)] text-slate-900">
    <div class="mx-auto flex min-h-screen max-w-[1440px]">
      <aside class="hidden w-[252px] border-r border-slate-200/80 bg-white/88 px-4 pb-6 pt-5 backdrop-blur lg:flex lg:flex-col">
        <div class="mb-8 flex items-center gap-3 px-2">
          <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-[#1877f2] text-sm font-bold text-white shadow-[0_10px_25px_rgba(24,119,242,0.22)]">in</div>
          <div>
            <p class="text-[22px] font-semibold tracking-[-0.03em] text-slate-900">LeadConnect</p>
          </div>
        </div>

        <nav class="space-y-1.5">
          <Link
            v-for="item in sidebar"
            :key="item.label"
            :href="item.href"
            :class="[
              'flex items-center justify-between rounded-xl px-3 py-3 text-[14px] font-medium transition',
              current === item.label
                ? 'bg-gradient-to-r from-[#eff5ff] to-[#f9fbff] text-[#2563eb] shadow-[inset_0_1px_0_rgba(255,255,255,0.9)]'
                : 'text-slate-600 hover:bg-slate-50',
            ]"
          >
            <span class="flex items-center gap-3">
              <span class="flex h-5 w-5 items-center justify-center rounded-md border border-slate-200 bg-white text-[10px] font-semibold text-slate-500">{{ item.icon }}</span>
              <span>{{ item.label }}</span>
            </span>
            <span v-if="item.badge" class="rounded-full bg-[#2f80ff] px-2 py-0.5 text-[11px] font-semibold text-white">{{ item.badge }}</span>
            <span v-else-if="item.expand" class="text-slate-400">˅</span>
          </Link>
        </nav>

        <div class="mt-auto border-t border-slate-100 pt-5">
          <div class="flex items-center gap-3 rounded-2xl px-2 py-3">
            <div class="h-11 w-11 rounded-full bg-[linear-gradient(135deg,#d8dde8,#ffffff)] p-[2px] shadow-sm">
              <div class="flex h-full w-full items-center justify-center rounded-full bg-slate-200 text-sm font-semibold text-slate-700">JS</div>
            </div>
            <div class="min-w-0 flex-1">
              <p class="truncate text-[14px] font-semibold text-slate-800">John Smith</p>
              <p class="text-xs text-slate-500">Pro Plan</p>
            </div>
            <span class="text-slate-400">˅</span>
          </div>
        </div>
      </aside>

      <main class="flex-1 px-5 py-5 lg:px-8 lg:py-6">
        <slot />
      </main>
    </div>
  </div>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

defineProps<{ current?: string }>();

const sidebar = [
  { label: 'Dashboard', icon: 'D', href: '/' },
  { label: 'Leads', icon: 'L', href: '/leads' },
  { label: 'Messaging', icon: 'M', badge: '12', href: '/messaging' },
  { label: 'Campaigns', icon: 'C', href: '/campaigns' },
  { label: 'CRM', icon: 'R', expand: true, href: '/crm' },
  { label: 'Deals', icon: '$', href: '/deals' },
  { label: 'Tasks', icon: 'T', href: '/tasks' },
  { label: 'Reports', icon: 'P', href: '/reports' },
  { label: 'Settings', icon: 'S', href: '/settings' },
];
</script>
