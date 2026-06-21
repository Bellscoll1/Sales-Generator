<template>
  <div class="min-h-screen text-slate-900">
    <div class="flex min-h-screen">
      <aside class="hidden w-64 border-r border-slate-200 bg-white/85 p-4 lg:block">
        <h1 class="mb-6 text-lg font-semibold">LeadConnect</h1>
        <nav class="space-y-1 text-sm text-slate-700">
          <a v-for="item in sidebar" :key="item" href="#" class="block rounded-xl px-3 py-2 hover:bg-blue-50">{{ item }}</a>
        </nav>
      </aside>
      <main class="flex-1 p-6 lg:p-8">
        <slot />
      </main>
    </div>
  </div>
</template>

<script setup lang="ts">
const sidebar = [
  'Dashboard', 'Lead Generation', 'Prospects', 'Messaging', 'Campaigns', 'CRM',
  'Deals', 'Tasks', 'Reports', 'Integrations', 'Team', 'Billing', 'Settings',
];
</script>
