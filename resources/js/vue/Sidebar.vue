<template>
  <aside class="z-20 hidden w-64 overflow-y-auto bg-gray-800 md:block flex-shrink-0">
    <div class="py-4">
      <a class="ml-6 text-lg font-bold text-gray-200" href="#">Produtos</a>
      <ul class="mt-6">
        <li class="relative px-6 py-2" :class="{'active-link': $route.path == '/products'}">
          <a
            class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 text-gray-300 hover:text-gray-100"
            href="/products" :class="{'active-text': $route.path == '/products'}"
          >
            <svg
              class="w-5 h-5"
              aria-hidden="true"
              fill="none"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"
              />
            </svg>
            <span class="ml-4">Produtos</span>
          </a>
        </li>
        <li class="relative px-6 py-2" :class="{'active-link': $route.path == '/history'}">
          <a
            class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 text-gray-300 hover:text-gray-100"
            href="/history" :class="{'active-text': $route.path == '/history'}"
          >
            <svg
              class="w-5 h-5"
              aria-hidden="true"
              fill="none"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"
              />
            </svg>
            <span class="ml-4">Histórico</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>
</template>

<script>
export default {
  name: "Sidebar"
};
</script>