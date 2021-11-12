<template>
  <header class="z-10 py-4 bg-gray-800">
    <div
      class="container flex items-center justify-between h-full px-6 text-purple-600 dark:text-purple-300"
    >
      <!-- name and logo -->
      <div class="flex justify-end flex-1 items-center">
        <ul class="flex items-center flex-shrink-0 space-x-6">
          <!-- Notifications menu -->
          <li class="relative">
            <button
              class="relative align-middle rounded-md focus:outline-none focus:shadow-outline-purple"
              @click="toggleNotificationsMenu"
              @keydown.escape="closeNotificationsMenu"
              aria-label="Notifications"
              aria-haspopup="true"
            >
              <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                <path
                  d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"
                />
              </svg>
              <!-- Notification badge -->
              <span
                aria-hidden="true"
                class="absolute top-0 right-0 inline-block w-3 h-3 transform translate-x-1 -translate-y-1 bg-red-600 border-2 border-white rounded-full dark:border-gray-800"
              ></span>
            </button>
          </li>
        </ul>
      </div>
    </div>
  </header>
</template>

<script>
export default {
  name: "Header"
}
</script>