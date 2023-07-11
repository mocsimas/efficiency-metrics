import {createRouter, createWebHistory, RouterOptions} from 'vue-router'
import DashboardView from '@/views/dashboard/DashboardView.vue'
import TimeEntriesView from '@/views/timeEntries/TimeEntriesView.vue'
import ProjectsView from '@/views/projects/ProjectsView.vue'
import ProjectView from '@/views/projects/ProjectView.vue'
import TasksView from '@/views/tasks/TasksView.vue'

const router = createRouter<RouterOptions>({
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
    {
      path: '/projects',
      name: 'projects',
      component: ProjectsView,
    },
    {
      path: '/projects/:project',
      name: 'project',
      component: ProjectView,
    },
    {
      path: '/tasks',
      name: 'tasks',
      component: TasksView,
    },
  ]
})

export default router
