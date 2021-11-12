<template>
  <div class="grid px-5 py-4 overflow-x-hidden">
    <div class="grid grid-cols-1 items-center justify-between mb-2">
      <!-- new product -->
      <div class="col-span-1 flex justify-end">
        <button class="button-new" aria-label="New" @click="openModal('new')">
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
              d="M12 6v6m0 0v6m0-6h6m-6 0H6"
            />
          </svg>
          <span class="ml-2 text-md font-semibold">Novo produto</span>
        </button>
      </div>
    </div>
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
      <div class="w-full overflow-x-auto">
        <!-- table -->
        <table class="w-full whitespace-no-wrap">
          <thead>
            <tr class="table-header">
              <th class="px-4 py-3">SKU</th>
              <th class="px-4 py-3">Nome</th>
              <th class="px-4 py-3">Quantidade</th>
              <th class="px-4 py-3">Preço</th>
              <th class="px-4 py-3 w-12">Ações</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-700 bg-gray-800">
            <tr v-if="loadingProducts" class="text-gray-100">
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
            <tr v-else-if="allProducts.length === 0" class="text-gray-100">
              <td colspan="5" class="px-4 py-3" align="center">Não há produtos.</td>
            </tr>
            <tr v-else v-for="product in allProducts" :key="product.id" class="text-gray-400">
              <td class="px-4 py-3 text-sm font-semibold">{{ product.sku }}</td>
              <td class="px-4 py-3 text-sm">{{ product.name }}</td>
              <td class="px-4 py-3 text-sm">{{ product.stock }}</td>

              <td class="px-4 py-3 text-sm">${{ product.price }}</td>
              <td class="px-4 py-3 flex items-center">
                <button
                  class="table-button"
                  @click="openModal('edit', product.id)"
                  aria-label="Edit"
                >
                  <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                    <path
                      d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"
                    />
                  </svg>
                </button>
                <button class="table-button" aria-label="Delete" @click="openModalDelete(product)">
                  <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                    <path
                      fill-rule="evenodd"
                      d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                      clip-rule="evenodd"
                    />
                  </svg>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- pagination -->
      <div class="pagination-background">
        <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
          <nav aria-label="Table navigation">
            <ul class="inline-flex items-center">
              <li>
                <button class="previous-button" aria-label="Previous" @click="getProducts(1)">
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

    <ModalStoreUpdate
      :modal="modal"
      :show="isModalOpen"
      @reload="getProducts(1)"
      @close="closeModal"
    ></ModalStoreUpdate>
    <ModalDelete
      :show="isModalDelete"
      :product="product"
      @reload="getProducts(1);"
      @close="isModalDelete = false;product = {}"
    ></ModalDelete>
  </div>
</template>

<script>
import ModalStoreUpdate from "./modals/ModalStoreUpdate";
import ModalDelete from "./modals/ModalDelete";
export default {
  name: "Products",

  data() {
    return {
      allProducts: [],
      loadingProducts: false,

      product: {},
      isModalDelete: false,

      isModalOpen: false,
      modal: {
        operation: "",
        id: ""
      },

      pagination: {
        current: 1,
        count: 1,
        total: 0
      }
    };
  },

  components: {
    ModalStoreUpdate,
    ModalDelete
  },

  created() {
    this.getProducts();
  },

  methods: {
    closeModal() {
      this.isModalOpen = false;
      this.modal = {
        operation: "",
        id: ""
      };
    },
    getProducts(page) {
      this.loadingProducts = true;
      axios
        .get("products", {
          params: {
            page: page ? page : 1
          }
        })
        .then(response => {
          this.allProducts = response.data.data;

          let paginationData = response.data.meta;
          this.pagination.current = paginationData.current_page;
          this.pagination.total = paginationData.last_page;
          this.pagination.count = paginationData.total;

          this.loadingProducts = false;
        })
        .catch(() => {});
    },
    openModal(operation, id) {
      this.modal.operation = operation;
      this.modal.id = id;

      this.isModalOpen = true;
    },

    openModalDelete(product) {
      this.product = product;
      this.isModalDelete = true;
    }
  }
};
</script>
