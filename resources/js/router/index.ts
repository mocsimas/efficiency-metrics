import { createRouter, createWebHistory } from 'vue-router'
import DashboardView from '@/views/dashboard/DashboardView.vue'
import TimeEntriesView from '@/views/timeEntries/TimeEntriesView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),

  routes: [
    {
      path: '/',
      name: 'dashboard',
      component: DashboardView,
    },
    {
      path: '/time-entries',
      name: 'time-entries',
      component: TimeEntriesView,
    },
  ]
})

export default router
