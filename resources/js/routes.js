import Home from './components/Home'
import Login from './components/auth/Login'

import CustomerMain from './components/customers/Main'
import CustomersList from './components/customers/List'
import NewCustomer from './components/customers/New.vue'
import Customer from './components/customers/View'

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
    path: '/customers',
    component: CustomerMain,
    meta: {
      requiresAuth: true
    },
    children: [
      {
        path: '/',
        component: CustomersList
      },
      {
        path: 'new',
        component: NewCustomer
      },
      {
        path: ':id',
        component: Customer
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