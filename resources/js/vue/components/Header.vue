<template>
  <header class="z-10 py-4 bg-gray-800">
    <div class="text-purple-600 flex items-center justify-between md:justify-end h-full px-6 mx-auto">
      <div class="flex flex-1">
        <ul class="flex items-center flex-shrink-0 space-x-6">
          <!-- hamburguer menu -->
          <li class="flex">
            <button
              class="hamburguer-menu"
              @click="$emit('update:sidebar', !sidebar)"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M4 6h16M4 10h16M4 14h16M4 18h16"
                />
              </svg>
            </button>
            <span class="ml-6 text-xl font-bold text-gray-200">Sistema</span>
          </li>
        </ul>
      </div>
      <div class="flex flex-shrink-0">
        <ul class="flex items-center flex-shrink-0 space-x-6">
          <!-- notifications -->
          <li class="relative">
            <button
              class="relative align-middle rounded-md focus:outline-none focus:shadow-outline-purple"
              aria-label="Notifications"
              aria-haspopup="true"
            >
              <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                <path
                  d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"
                />
              </svg>
              <!-- badge -->
              <span
                aria-hidden="true"
                class="absolute top-0 right-0 inline-block w-3 h-3 transform translate-x-1 -translate-y-1 bg-red-600 border-2 rounded-full border-gray-800"
              ></span>
            </button>
          </li>
          <!-- profile -->
          <li class="relative">
            <button
              class="align-middle rounded-full focus:shadow-outline-purple focus:outline-none"
              aria-label="Account"
              aria-haspopup="true"
            >
              <img
                class="object-cover w-8 h-8 rounded-full"
                src="https://images.unsplash.com/photo-1566411520896-01e7ca4726af?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&ixid=eyJhcHBfaWQiOjE3Nzg0fQ"
                alt
                aria-hidden="true"
              />
            </button>
          </li>
        </ul>
      </div>
    </div>
  </header>
</template>

<script>
export default {
  name: "Header",
  props: {
    sidebar: {
      required: true,
      type: Boolean
    },
  },
};
</script>