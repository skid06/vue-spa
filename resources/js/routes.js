import Home from './components/Home'
import Login from './components/auth/Login'

import UserMain from './components/users/Main'
import UsersList from './components/users/List'
import NewUser from './components/users/New.vue'
import User from './components/users/View'

import TaskMain from './components/tasks/Main'
import TasksList from './components/tasks/List'
import NewTask from './components/tasks/New.vue'
import Task from './components/tasks/View'

export const routes = [
  {
    path: '/',
    component: Home,
    meta: {
      requiresAuth: true
    }
  },
  {
    path: '/login',
    component: Login
  },
  {
    path: '/users',
    component: UserMain,
    meta: {
      requiresAuth: true
    },
    children: [
      {
        path: '/',
        component: UsersList
      },
      {
        path: 'new',
        component: NewUser
      },
      {
        path: ':id',
        component: User
      }
    ]
  },
  {
    path: '/tasks',
    component: TaskMain,
    meta: {
      requiresAuth: true
    },
    children: [
      {
        path: '/',
        component: TasksList
      },
      {
        path: 'new',
        component: NewTask
      },
      {
        path: ':id',
        component: Task
      }
    ]
  }  
];