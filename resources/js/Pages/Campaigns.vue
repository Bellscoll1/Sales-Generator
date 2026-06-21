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
            <button
              type="button"
              class="rounded-xl bg-[#2f80ff] px-4 py-2 text-sm font-medium text-white"
              @click="openCreateModal"
            >
              New Campaign
            </button>
          </div>
          <div v-if="campaigns.length === 0" class="rounded-[20px] border border-dashed border-slate-200 px-5 py-10 text-center">
            <p class="text-base font-semibold text-slate-700">No campaigns yet</p>
            <p class="mt-1 text-sm text-slate-500">Create your first campaign to start automating outreach.</p>
          </div>
          <div v-else class="space-y-4">
            <div v-for="campaign in campaigns" :key="campaign.id" class="rounded-[20px] border border-slate-100 p-4">
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

      <div v-if="isCreateModalOpen" class="fixed inset-0 z-40 flex items-center justify-center bg-slate-900/40 px-4" @click.self="closeCreateModal">
        <article class="w-full max-w-lg rounded-[24px] border border-slate-200/80 bg-white p-6 shadow-[0_25px_60px_rgba(15,23,42,0.2)]">
          <div class="mb-5 flex items-center justify-between">
            <h3 class="text-[24px] font-semibold tracking-[-0.03em] text-slate-900">Create Campaign</h3>
            <button type="button" class="rounded-lg px-2 py-1 text-slate-400 hover:bg-slate-100" @click="closeCreateModal">✕</button>
          </div>

          <form class="space-y-4" @submit.prevent="submitCampaign">
            <label class="block space-y-1.5">
              <span class="text-sm font-medium text-slate-600">Campaign name</span>
              <input
                v-model="form.name"
                type="text"
                class="w-full rounded-xl border border-slate-200 px-3 py-2.5 text-sm text-slate-800 outline-none transition focus:border-[#2f80ff]"
                placeholder="Q3 SaaS Founder Outreach"
              />
              <p v-if="form.errors.name" class="text-xs font-medium text-rose-500">{{ form.errors.name }}</p>
            </label>

            <label class="block space-y-1.5">
              <span class="text-sm font-medium text-slate-600">Channel type</span>
              <select v-model="form.type" class="w-full rounded-xl border border-slate-200 px-3 py-2.5 text-sm text-slate-800 outline-none transition focus:border-[#2f80ff]">
                <option value="LinkedIn">LinkedIn</option>
                <option value="Email">Email</option>
                <option value="Mixed Campaign">Mixed Campaign</option>
              </select>
              <p v-if="form.errors.type" class="text-xs font-medium text-rose-500">{{ form.errors.type }}</p>
            </label>

            <label class="block space-y-1.5">
              <span class="text-sm font-medium text-slate-600">Start date (optional)</span>
              <input
                v-model="form.starts_at"
                type="date"
                class="w-full rounded-xl border border-slate-200 px-3 py-2.5 text-sm text-slate-800 outline-none transition focus:border-[#2f80ff]"
              />
              <p v-if="form.errors.starts_at" class="text-xs font-medium text-rose-500">{{ form.errors.starts_at }}</p>
            </label>

            <div class="flex items-center justify-end gap-3 pt-2">
              <button type="button" class="rounded-xl border border-slate-200 px-4 py-2 text-sm font-medium text-slate-600" @click="closeCreateModal">Cancel</button>
              <button
                type="submit"
                class="rounded-xl bg-[#2f80ff] px-4 py-2 text-sm font-medium text-white"
                :disabled="form.processing"
              >
                {{ form.processing ? 'Creating...' : 'Create Campaign' }}
              </button>
            </div>
          </form>
        </article>
      </div>
    </section>
  </AppLayout>
</template>

<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import AppLayout from '../Layouts/AppLayout.vue';

type CampaignStat = {
  label: string;
  value: string;
  note: string;
};

type CampaignItem = {
  id: string;
  name: string;
  steps: number;
  type: string;
  status: string;
  enrolled: number;
  replies: number;
  meetings: number;
  conversion: string;
};

const props = defineProps<{
  stats: CampaignStat[];
  campaigns: CampaignItem[];
}>();

const isCreateModalOpen = ref(false);

const form = useForm({
  name: '',
  type: 'Mixed Campaign',
  status: 'draft',
  starts_at: '',
});

const openCreateModal = (): void => {
  isCreateModalOpen.value = true;
};

const closeCreateModal = (): void => {
  isCreateModalOpen.value = false;
  form.clearErrors();
};

const submitCampaign = (): void => {
  form.post('/campaigns', {
    preserveScroll: true,
    onSuccess: () => {
      form.reset();
      closeCreateModal();
    },
  });
};

const stats = props.stats;
const campaigns = props.campaigns;
</script>