<template>
  <AppLayout current="Dashboard">
    <section class="flex flex-col gap-6">
      <header class="flex flex-col gap-4 xl:flex-row xl:items-start xl:justify-between">
        <div>
          <h1 class="text-[33px] font-semibold tracking-[-0.04em] text-slate-900">Dashboard</h1>
          <p class="mt-1 text-[15px] text-slate-500">Welcome back, John! Here's what's happening with your leads.</p>
        </div>

        <div class="flex items-center gap-3 self-start">
          <button class="inline-flex h-11 items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 text-sm font-medium text-slate-700 shadow-[0_10px_30px_rgba(15,23,42,0.04)]">
            <span class="text-base">+</span>
            <span>New Campaign</span>
          </button>
          <button class="inline-flex h-11 items-center gap-2 rounded-xl bg-[#2f80ff] px-5 text-sm font-medium text-white shadow-[0_16px_30px_rgba(47,128,255,0.28)]">
            <span class="text-base">+</span>
            <span>New Lead</span>
          </button>
          <button class="relative flex h-11 w-11 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-500 shadow-[0_10px_30px_rgba(15,23,42,0.04)]">
            <span class="text-lg">o</span>
            <span class="absolute right-3 top-3 h-2 w-2 rounded-full bg-red-400"></span>
          </button>
        </div>
      </header>

      <div class="grid gap-5 xl:grid-cols-[minmax(0,1fr)_276px]">
        <div class="space-y-5">
          <section class="grid gap-4 md:grid-cols-2 2xl:grid-cols-4">
            <article v-for="card in cards" :key="card.label" class="rounded-[22px] border border-slate-200/80 bg-white px-5 py-4 shadow-[0_20px_45px_rgba(15,23,42,0.05)]">
              <div class="flex items-start gap-4">
                <div :class="['flex h-14 w-14 items-center justify-center rounded-full text-lg font-semibold', card.iconBg, card.iconText]">{{ card.icon }}</div>
                <div class="min-w-0 flex-1">
                  <p class="text-[13px] font-medium text-slate-500">{{ card.label }}</p>
                  <p class="mt-1 text-[33px] font-semibold tracking-[-0.04em] text-slate-900">{{ card.value }}</p>
                  <div class="mt-3 flex items-center gap-2 text-xs">
                    <span class="font-semibold text-emerald-500">↑ {{ card.growth }}</span>
                    <span class="text-slate-400">vs last 30 days</span>
                  </div>
                </div>
              </div>
            </article>
          </section>

          <section class="rounded-[24px] border border-slate-200/80 bg-white px-4 py-4 shadow-[0_20px_45px_rgba(15,23,42,0.05)] lg:px-5">
            <div class="mb-4 flex items-center justify-between px-2">
              <h2 class="text-[24px] font-semibold tracking-[-0.03em] text-slate-900">Recent Leads</h2>
              <a href="#" class="text-sm font-medium text-[#2f80ff]">View All Leads</a>
            </div>

            <div class="overflow-hidden rounded-[18px] border border-slate-100">
              <table class="min-w-full text-left">
                <thead class="bg-slate-50/75 text-[11px] uppercase tracking-[0.08em] text-slate-400">
                  <tr>
                    <th class="px-5 py-4 font-semibold">Name</th>
                    <th class="px-4 py-4 font-semibold">Title</th>
                    <th class="px-4 py-4 font-semibold">Company</th>
                    <th class="px-4 py-4 font-semibold">Status</th>
                    <th class="px-4 py-4 font-semibold">Last Activity</th>
                    <th class="w-8 px-4 py-4"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="lead in leads" :key="lead.name" class="border-t border-slate-100 text-[14px] text-slate-600">
                    <td class="px-5 py-4">
                      <div class="flex items-center gap-3">
                        <div class="h-10 w-10 rounded-full bg-[linear-gradient(135deg,#e2e8f0,#ffffff)] p-[2px]">
                          <div class="flex h-full w-full items-center justify-center rounded-full bg-slate-200 text-xs font-semibold text-slate-700">{{ lead.avatar }}</div>
                        </div>
                        <div class="flex items-center gap-2">
                          <span class="font-semibold text-slate-800">{{ lead.name }}</span>
                          <span class="rounded-md bg-[#1877f2] px-1.5 py-0.5 text-[10px] font-bold uppercase text-white">in</span>
                        </div>
                      </div>
                    </td>
                    <td class="px-4 py-4 text-slate-700">{{ lead.title }}</td>
                    <td class="px-4 py-4">
                      <div class="flex items-center gap-2">
                        <span class="text-slate-400">▦</span>
                        <span>{{ lead.company }}</span>
                      </div>
                    </td>
                    <td class="px-4 py-4">
                      <span :class="['inline-flex rounded-lg px-3 py-1 text-xs font-semibold', lead.statusClass]">{{ lead.status }}</span>
                    </td>
                    <td class="px-4 py-4 text-slate-400">{{ lead.activity }}</td>
                    <td class="px-4 py-4 text-center text-slate-400">⋮</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </section>

          <section class="grid gap-5 xl:grid-cols-3">
            <article class="rounded-[24px] border border-slate-200/80 bg-white px-5 py-5 shadow-[0_20px_45px_rgba(15,23,42,0.05)]">
              <div class="mb-4 flex items-center justify-between">
                <h3 class="text-[22px] font-semibold tracking-[-0.03em] text-slate-900">Campaign Performance</h3>
                <a href="#" class="text-sm font-medium text-[#2f80ff]">View Report</a>
              </div>
              <table class="min-w-full text-left text-[13px] text-slate-600">
                <thead class="text-[10px] uppercase tracking-[0.08em] text-slate-400">
                  <tr>
                    <th class="py-3 font-semibold">Campaign</th>
                    <th class="py-3 font-semibold">Sent</th>
                    <th class="py-3 font-semibold">Response Rate</th>
                    <th class="py-3 font-semibold">Replies</th>
                    <th class="py-3 font-semibold">Meetings</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="campaign in campaigns" :key="campaign.name" class="border-t border-slate-100">
                    <td class="py-4 font-medium text-slate-700">{{ campaign.name }}</td>
                    <td class="py-4">{{ campaign.sent }}</td>
                    <td class="py-4">{{ campaign.rate }}</td>
                    <td class="py-4">{{ campaign.replies }}</td>
                    <td class="py-4">{{ campaign.meetings }}</td>
                  </tr>
                </tbody>
              </table>
            </article>

            <article class="rounded-[24px] border border-slate-200/80 bg-white px-5 py-5 shadow-[0_20px_45px_rgba(15,23,42,0.05)]">
              <div class="mb-4 flex items-center justify-between">
                <h3 class="text-[22px] font-semibold tracking-[-0.03em] text-slate-900">Activity Feed</h3>
                <a href="#" class="text-sm font-medium text-[#2f80ff]">View All</a>
              </div>
              <div class="space-y-4">
                <div v-for="activity in activities" :key="activity.text" class="flex gap-3">
                  <div :class="['mt-1 flex h-8 w-8 items-center justify-center rounded-full text-xs font-bold text-white', activity.color]">{{ activity.icon }}</div>
                  <div class="min-w-0 flex-1 text-[14px] text-slate-600">
                    <p class="leading-6"><span class="font-medium text-slate-700">{{ activity.name }}</span> {{ activity.text }}</p>
                  </div>
                  <span class="text-xs text-slate-400">{{ activity.time }}</span>
                </div>
              </div>
            </article>

            <article class="rounded-[24px] border border-slate-200/80 bg-white px-5 py-5 shadow-[0_20px_45px_rgba(15,23,42,0.05)]">
              <div class="mb-4 flex items-center justify-between">
                <h3 class="text-[22px] font-semibold tracking-[-0.03em] text-slate-900">Deals Overview</h3>
                <a href="#" class="text-sm font-medium text-[#2f80ff]">View Pipeline</a>
              </div>
              <div class="flex items-center gap-5">
                <div class="relative flex h-40 w-40 items-center justify-center rounded-full bg-[conic-gradient(#4c8dff_0_32%,#4bc48d_32%_67%,#ffa447_67%_84%,#9b75ff_84%_100%)] p-4">
                  <div class="flex h-full w-full flex-col items-center justify-center rounded-full bg-white text-center shadow-inner">
                    <p class="text-[42px] font-semibold tracking-[-0.04em] text-slate-900">18</p>
                    <p class="-mt-1 text-xs text-slate-400">Total Deals</p>
                  </div>
                </div>
                <div class="space-y-3 text-sm text-slate-600">
                  <div v-for="item in dealStats" :key="item.label" class="flex items-center gap-3">
                    <span :class="['h-2.5 w-2.5 rounded-full', item.color]"></span>
                    <span class="w-3 text-slate-900">{{ item.count }}</span>
                    <span>{{ item.label }}</span>
                  </div>
                </div>
              </div>
              <div class="mt-4 flex items-center gap-3 text-sm">
                <span class="text-slate-500">Conversion rate: <span class="font-semibold text-slate-800">14.4%</span></span>
                <span class="font-semibold text-emerald-500">↑ 8.3%</span>
                <span class="text-slate-400">vs last 30 days</span>
              </div>
            </article>
          </section>
        </div>

        <aside class="rounded-[24px] border border-slate-200/80 bg-white px-4 py-5 shadow-[0_20px_45px_rgba(15,23,42,0.05)]">
          <div class="mb-4 flex items-center justify-between px-1">
            <div class="flex items-center gap-2">
              <h2 class="text-[22px] font-semibold tracking-[-0.03em] text-slate-900">Messaging</h2>
              <span class="rounded-full bg-[#2f80ff] px-2 py-0.5 text-[11px] font-semibold text-white">12</span>
            </div>
            <a href="#" class="text-sm font-medium text-[#2f80ff]">View All</a>
          </div>

          <div class="space-y-4">
            <article v-for="thread in threads" :key="thread.name" class="flex gap-3 rounded-2xl px-2 py-2 hover:bg-slate-50">
              <div class="h-11 w-11 rounded-full bg-[linear-gradient(135deg,#e2e8f0,#ffffff)] p-[2px]">
                <div class="flex h-full w-full items-center justify-center rounded-full bg-slate-200 text-xs font-semibold text-slate-700">{{ thread.avatar }}</div>
              </div>
              <div class="min-w-0 flex-1">
                <div class="flex items-center justify-between gap-3">
                  <div class="flex items-center gap-2">
                    <p class="truncate text-[14px] font-semibold text-slate-800">{{ thread.name }}</p>
                    <span class="h-2 w-2 rounded-full bg-emerald-400"></span>
                  </div>
                  <span class="text-xs text-slate-400">{{ thread.time }}</span>
                </div>
                <p class="mt-1 truncate text-[13px] text-slate-500">{{ thread.preview }}</p>
                <p class="mt-1 truncate text-[13px] text-slate-400">{{ thread.snippet }}</p>
              </div>
              <div v-if="thread.unread" class="flex items-center">
                <span class="flex h-5 min-w-5 items-center justify-center rounded-full bg-[#2f80ff] px-1.5 text-[10px] font-semibold text-white">{{ thread.unread }}</span>
              </div>
            </article>
          </div>

          <button class="mt-6 flex h-11 w-full items-center justify-center gap-2 rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-[#2f80ff]">
            <span>Go to Messaging</span>
            <span>›</span>
          </button>
        </aside>
      </div>
    </section>
  </AppLayout>
</template>

<script setup lang="ts">
import AppLayout from '../Layouts/AppLayout.vue';

const cards = [
  { label: 'Total Leads', value: '1,250', growth: '18.5%', icon: 'OO', iconBg: 'bg-blue-50', iconText: 'text-[#2f80ff]' },
  { label: 'Messages Sent', value: '320', growth: '22.4%', icon: '>', iconBg: 'bg-violet-50', iconText: 'text-[#7c4dff]' },
  { label: 'Responses', value: '85', growth: '26.7%', icon: '<>', iconBg: 'bg-emerald-50', iconText: 'text-[#22a66f]' },
  { label: 'Deals Won', value: '18', growth: '12.1%', icon: '$', iconBg: 'bg-amber-50', iconText: 'text-[#ff9d2f]' },
];

const leads = [
  { name: 'Sarah Johnson', avatar: 'SJ', title: 'Marketing Manager', company: 'TechSolutions', status: 'Contacted', statusClass: 'bg-blue-50 text-[#4c8dff]', activity: '1h ago' },
  { name: 'Michael Chen', avatar: 'MC', title: 'CEO', company: 'Innovate Labs', status: 'Replied', statusClass: 'bg-emerald-50 text-[#28b379]', activity: '3h ago' },
  { name: 'Emily Davis', avatar: 'ED', title: 'Sales Director', company: 'GrowthCorp', status: 'Interested', statusClass: 'bg-violet-50 text-[#8b5cf6]', activity: '1d ago' },
  { name: 'David Wilson', avatar: 'DW', title: 'CTO', company: 'NextGen Systems', status: 'New', statusClass: 'bg-slate-100 text-slate-500', activity: '2d ago' },
  { name: 'Lisa Martinez', avatar: 'LM', title: 'Head of Ops', company: 'ScaleUp Co.', status: 'Contacted', statusClass: 'bg-blue-50 text-[#4c8dff]', activity: '2d ago' },
];

const campaigns = [
  { name: 'May Outreach', sent: '150', rate: '32.0%', replies: '48', meetings: '12' },
  { name: 'SaaS Leaders', sent: '120', rate: '28.3%', replies: '34', meetings: '9' },
  { name: 'US Startups', sent: '200', rate: '26.5%', replies: '53', meetings: '15' },
];

const activities = [
  { name: 'Michael Chen', text: 'replied to your message', time: '3h ago', icon: 'M', color: 'bg-emerald-500' },
  { name: 'Sarah Johnson', text: 'accepted your connection', time: '5h ago', icon: 'S', color: 'bg-blue-500' },
  { name: 'Emily Davis', text: 'clicked on your link', time: '1d ago', icon: 'E', color: 'bg-violet-500' },
  { name: 'David Wilson', text: 'opened your message', time: '2d ago', icon: 'D', color: 'bg-amber-500' },
];

const threads = [
  { name: 'Michael Chen', avatar: 'MC', time: '3h', preview: 'Thanks for reaching out!', snippet: "I'd love to learn more...", unread: '2' },
  { name: 'Sarah Johnson', avatar: 'SJ', time: '5h', preview: 'That sounds interesting.', snippet: 'Can we schedule a call?', unread: '1' },
  { name: 'Emily Davis', avatar: 'ED', time: '1d', preview: 'Can you share more details', snippet: 'about your solution?' },
  { name: 'James Anderson', avatar: 'JA', time: '2d', preview: 'Looks like a great fit.', snippet: "Let's connect." },
  { name: 'Ryan Clark', avatar: 'RC', time: '2d', preview: 'Please send over your pricing.', snippet: '' },
];

const dealStats = [
  { count: '6', label: 'Qualified', color: 'bg-[#4c8dff]' },
  { count: '7', label: 'Proposal', color: 'bg-[#4bc48d]' },
  { count: '3', label: 'Negotiation', color: 'bg-[#ffa447]' },
  { count: '2', label: 'Won', color: 'bg-[#9b75ff]' },
];
</script>
