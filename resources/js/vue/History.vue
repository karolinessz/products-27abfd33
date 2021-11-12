<template>
  <div class="grid px-5 py-4">
    <div class="flex items-center justify-between mb-2">
      <h4 class="mb-0 text-lg font-semibold text-gray-300">Histórico de produtos</h4>
    </div>
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
      <div class="w-full overflow-x-auto">
        <!-- table -->
        <table class="w-full whitespace-no-wrap">
          <thead>
            <tr
              class="table-header"
            >
              <th class="px-4 py-3">SKU</th>
              <th class="px-4 py-3">Descrição</th>
              <th class="px-4 py-3">Data</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-700 bg-gray-800">
            <tr v-if="loadingLogs" class="text-gray-100">
              <td colspan="5" class="px-4 py-3" align="center">
                <svg
                  width="38"
                  height="38"
                  viewBox="0 0 38 38"
                  xmlns="http://www.w3.org/2000/svg"
                  stroke="#fff"
                >
                  <g fill="none" fill-rule="evenodd">
                    <g transform="translate(1 1)" stroke-width="2">
                      <circle stroke-opacity="0.5" cx="18" cy="18" r="18" />
                      <path d="M36 18c0-9.94-8.06-18-18-18">
                        <animateTransform
                          attributeName="transform"
                          type="rotate"
                          from="0 18 18"
                          to="360 18 18"
                          dur="1s"
                          repeatCount="indefinite"
                        />
                      </path>
                    </g>
                  </g>
                </svg>
              </td>
            </tr>
            <tr v-else-if="allHistory.length === 0" class="text-gray-100">
              <td colspan="5" class="px-4 py-3" align="center">Não há histórico.</td>
            </tr>
            <tr v-else v-for="log in allHistory" :key="log.id" class="text-gray-400">
              <td class="px-4 py-3 text-sm font-semibold">{{ log.sku }}</td>
              <td class="px-4 py-3 text-sm">
                <span
                  v-for="(change, i) in JSON.parse(log.description)"
                  :key="i"
                  class="px-2 py-1 font-semibold leading-tight text-purple-100 rounded-full"
                >
                  <span v-show="i != 0">{{i}}:</span>
                  {{change}}
                </span>
              </td>
              <td class="px-4 py-3 text-sm">{{ log.created_at }}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- pagination -->
      <div
        class="pagination-background"
      >
        <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
          <nav aria-label="Table navigation">
            <ul class="inline-flex items-center">
              <li>
                <button
                  class="previous-button"
                  aria-label="Previous"
                  @click="getProducts(1)"
                >
                  <svg aria-hidden="true" class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                    <path
                      d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                      clip-rule="evenodd"
                      fill-rule="evenodd"
                    />
                  </svg>
                </button>
              </li>
              <li v-for="page in pagination.total" :key="page">
                <button
                  class="page-button"
                  :class="{'active-page': pagination.current == page}"
                  @click="getProducts(page)"
                >{{page}}</button>
              </li>
              <li>
                <button
                  class="next-button"
                  aria-label="Next"
                  @click="getProducts(pagination.total)"
                >
                  <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                    <path
                      d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                      clip-rule="evenodd"
                      fill-rule="evenodd"
                    />
                  </svg>
                </button>
              </li>
            </ul>
          </nav>
        </span>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "History",

  data() {
    return {
      allHistory: [],
      loadingLogs: false,

      pagination: {
        current: 1,
        count: 1,
        total: 0
      }
    };
  },

  created() {
    this.getProducts();
  },

  methods: {
    getProducts(page) {
      this.loadingLogs = true;
      axios
        .get("logs", {
          params: {
            page: page ? page : 1
          }
        })
        .then(response => {
          this.allHistory = response.data.data;

          let paginationData = response.data.meta;
          this.pagination.current = paginationData.current_page;
          this.pagination.total = paginationData.last_page;
          this.pagination.count = paginationData.total;

          this.loadingLogs = false;
        })
        .catch(() => {});
    },
    openModal(operation, id) {
      this.modal.operation = operation;
      this.modal.id = id;
      this.isModalOpen = true;
    }
  }
};
</script>
