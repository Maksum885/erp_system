<script setup>
import { computed, ref } from 'vue'
import { Link, usePage } from '@inertiajs/vue3'

const page      = usePage()
const user      = computed(() => page.props.auth.user)
const role      = computed(() => user.value?.role)
const sidebarOpen = ref(true)

// Menu per role — hanya tampilkan yang relevan
const menuItems = computed(() => {
  const all = [
    {
      label: 'Dashboard',
      href: '/dashboard',
      icon: '⊞',
      roles: ['admin','account_manager','purchasing','finance'],
    },
    {
      label: 'Customer Database',
      href: '/customers',
      icon: '🏢',
      roles: ['admin','account_manager','purchasing','finance'],
    },
    {
      label: 'Sales Pipeline',
      href: '/pipeline/sales',
      icon: '📈',
      roles: ['admin','account_manager','finance'],
    },
    {
      label: 'Fronting Pipeline',
      href: '/pipeline/fronting',
      icon: '🔀',
      roles: ['admin','account_manager','finance'],
    },
    {
      label: 'Work Order',
      href: '/work-orders',
      icon: '📋',
      roles: ['admin','account_manager','purchasing','finance'],
    },
    {
      label: 'RS-Format',
      href: '/rs-format',
      icon: '💰',
      roles: ['admin','finance'],
    },
    {
      label: 'RS-Person',
      href: '/rs-person',
      icon: '👤',
      roles: ['admin','account_manager','finance'],
    },
    {
      label: 'Partnership',
      href: '/partnerships',
      icon: '🤝',
      roles: ['admin','account_manager','finance'],
    },
    {
      label: 'Kelola User',
      href: '/users',
      icon: '⚙️',
      roles: ['admin'],
    },
  ]
  return all.filter(m => m.roles.includes(role.value))
})

const flash = computed(() => page.props.flash)
</script>

<template>
  <div class="flex h-screen bg-gray-50 overflow-hidden">

    <!-- Sidebar -->
    <aside
      :class="sidebarOpen ? 'w-60' : 'w-16'"
      class="flex flex-col bg-primary text-white transition-all duration-200 flex-shrink-0"
    >
      <!-- Logo -->
      <div class="flex items-center gap-3 px-4 py-4 border-b border-white/10">
        <span class="text-accent font-bold text-xl">ERP</span>
        <span v-if="sidebarOpen" class="font-semibold text-sm truncate">
          Multi Mitra Guna
        </span>
      </div>

      <!-- Navigation -->
      <nav class="flex-1 py-4 space-y-1 overflow-y-auto">
        <Link
          v-for="item in menuItems"
          :key="item.href"
          :href="item.href"
          class="flex items-center gap-3 px-4 py-2.5 text-sm
                 text-white/80 hover:text-white hover:bg-white/10
                 rounded-lg mx-2 transition-colors"
          :class="{ 'bg-white/15 text-white': $page.url.startsWith(item.href) }"
        >
          <span class="text-base flex-shrink-0">{{ item.icon }}</span>
          <span v-if="sidebarOpen" class="truncate">{{ item.label }}</span>
        </Link>
      </nav>

      <!-- User info bottom -->
      <div class="px-4 py-3 border-t border-white/10">
        <div v-if="sidebarOpen" class="text-xs text-white/60 truncate">{{ user.name }}</div>
        <div v-if="sidebarOpen"
          class="text-xs font-medium mt-0.5 px-2 py-0.5 rounded
                 bg-accent/20 text-accent inline-block">
          {{ user.role_label }}
        </div>
      </div>
    </aside>

    <!-- Main area -->
    <div class="flex flex-col flex-1 overflow-hidden">

      <!-- Top Header -->
      <header class="flex items-center gap-4 px-6 py-3 bg-white border-b border-gray-200">
        <button
          @click="sidebarOpen = !sidebarOpen"
          class="text-gray-500 hover:text-gray-700"
        >☰</button>

        <div class="flex-1">
          <slot name="header" />
        </div>

        <!-- Logout -->
        <Link
          href="/logout"
          method="post"
          as="button"
          class="text-sm text-gray-500 hover:text-gray-700"
        >Keluar</Link>
      </header>

      <!-- Flash notification -->
      <div v-if="flash.success"
        class="mx-6 mt-4 px-4 py-3 bg-green-50 border border-green-200
               text-green-700 text-sm rounded-lg">
        ✓ {{ flash.success }}
      </div>
      <div v-if="flash.error"
        class="mx-6 mt-4 px-4 py-3 bg-red-50 border border-red-200
               text-red-700 text-sm rounded-lg">
        ✗ {{ flash.error }}
      </div>

      <!-- Page content -->
      <main class="flex-1 overflow-y-auto p-6">
        <slot />
      </main>

    </div>
  </div>
</template>