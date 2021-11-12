<template>
  <Transition name="fade">
    <div
      v-if="show"
      class="modal-overlay"
      @click.self="close"
    >
      <div
        class="modal-body"
      >
        <div>
          <div>
            <button
              aria-label="close"
              class="absolute top-0 right-0 text-xl text-gray-500 my-2 mx-4"
              @click.prevent="close"
            >×</button>
            <p class="mb-2 text-lg font-semibold text-gray-300">{{title}}</p>
          </div>
          <div class="mt-4 mb-6">
            <p class="text-sm">{{subtitle}}</p>
            <div class="mt-4 mb-8">
              <label class="block mb-4 text-sm">
                <span
                  class="text-gray-400"
                  :class="{'error-input-text': errors.sku}"
                >SKU*</span>
                <input
                  :class="{'error-input': errors.sku}"
                  class="input-normal form-input"
                  placeholder="SAMCEL21-09"
                  v-model="product.sku"
                  :disabled="edit"
                />
                <span v-show="errors.sku" class="text-xs text-red-400">
                  <div v-for="(err, i) in errors.sku" :key="i">{{err}}</div>
                </span>
              </label>

              <label class="block mb-4 text-sm">
                <span
                  class="text-gray-400"
                  :class="{'error-input-text': errors.name}"
                >Nome*</span>
                <input
                  class="input-normal form-input"
                  :class="{'error-input': errors.name}"
                  placeholder="Celular Samsung S20"
                  v-model="product.name"
                  :disabled="edit"
                />
                <span v-show="errors.name" class="text-xs text-red-400">
                  <div v-for="(err, i) in errors.name" :key="i">{{err}}</div>
                </span>
              </label>

              <label class="block mb-4 text-sm">
                <span
                  class="text-gray-400"
                  :class="{'error-input-text': errors.stock}"
                >Quantidade*</span>
                <input
                  class="input-normal form-input"
                  :class="{'error-input': errors.stock}"
                  placeholder="999"
                  type="number"
                  v-model="product.stock"
                />
                <span v-show="errors.stock" class="text-xs text-red-400">
                  <div v-for="(err, i) in errors.stock" :key="i">{{err}}</div>
                </span>
              </label>

              <label class="block mb-4 text-sm">
                <span
                  class="text-gray-400"
                  :class="{'error-input-text': errors.price}"
                >Preço*</span>
                <div class="relative text-gray-500 focus-within:text-purple-400">
                  <input
                    class="input-svg form-input"
                    :class="{'error-input': errors.price}"
                    placeholder="5299,99"
                    v-model="product.price"
                  />
                  <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none">
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
                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                      />
                    </svg>
                  </div>
                </div>
                <span v-show="errors.price" class="text-xs text-red-400">
                  <div v-for="(err, i) in errors.price" :key="i">{{err}}</div>
                </span>
              </label>
            </div>
          </div>
          <div class="flex justify-between">
            <button
              class="button-close"
              @click="close"
            >
              <span>Cancelar</span>
            </button>
            <button
              class="button-purple"
              @click="save"
            >
              <div class="flex items-center">
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
                    d="M17 16v2a2 2 0 01-2 2H5a2 2 0 01-2-2v-7a2 2 0 012-2h2m3-4H9a2 2 0 00-2 2v7a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-1m-1 4l-3 3m0 0l-3-3m3 3V3"
                  />
                </svg>
                <span class="ml-2">Salvar</span>
              </div>
            </button>
          </div>
        </div>
      </div>
    </div>
  </Transition>
</template>
 
<script>
export default {
  name: "ModalStoreUpdate",
  props: {
    show: {
      required: true,
      type: Boolean
    },
    modal: {
      required: true,
      type: Object
    }
  },
  data() {
    return {
      errors: {},
      product: {
        sku: "",
        name: "",
        stock: "",
        price: ""
      }
    };
  },
  watch: {
    edit(val) {
      if (val === true) {
        this.getProduct();
      }
    }
  },
  computed: {
    edit() {
      return this.modal.operation == "edit";
    },
    title() {
      switch (this.modal.operation) {
        case "new":
          return "Cadastro de novo produto";
          break;

        case "edit":
          return "Editar produto";
          break;

        default:
          break;
      }
    },
    subtitle() {
      switch (this.modal.operation) {
        case "new":
          return "Preencha os campos obrigatórios para o cadastro de um novo produto!";
          break;

        case "edit":
          return "Preencha os campos abaixo para editar o cadastro de um produto.";
          break;

        default:
          break;
      }
    }
  },
  methods: {
    close() {
      this.$emit("close");
      this.product = {
        sku: "",
        name: "",
        stock: "",
        price: ""
      };

      this.errors = {};
    },
    save() {
      if (this.modal.operation === "new") {
        axios
          .post("products", this.product)
          .then(response => {
            this.$notify(
              {
                group: "foo",
                color: "green",
                title: response.data.message
              },
              2000
            );

            this.$emit("reload");
            this.close();
          })
          .catch((err) => {
            this.$notify(
              {
                group: "foo",
                color: "red",
                title: "Verifique os campos novamente."
              },
              2000
            );

            this.errors = err.response.data.errors;
          });
      }

      if (this.edit) {
        axios
          .put(`products/${this.product.id}`, this.product)
          .then(response => {
            this.$notify(
              {
                group: "foo",
                color: "green",
                title: response.data.message
              },
              2000
            );

            this.$emit("reload");
            this.close();
          })
          .catch(err => {
            this.$notify(
              {
                group: "foo",
                color: "red",
                title: "Verifique os campos novamente."
              },
              2000
            );

            this.errors = err.response.data.errors;
          });
      }
    },
    getProduct() {
      axios
        .get(`products/${this.modal.id}`)
        .then(response => {
          this.product = response.data;
        })
        .catch(err => {
          this.$notify(
            {
              group: "foo",
              color: "red",
              title:
                "Não foi possível obter o produto, tente novamente mais tarde."
            },
            20000
          );
        });
    }
  }
};
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: all 0.4s;
}
.fade-enter,
.fade-leave-to {
  opacity: 0;
}
</style>