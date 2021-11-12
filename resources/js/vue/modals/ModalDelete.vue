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
            <p class="mb-2 text-lg font-semibold text-gray-300">Remover produto</p>
          </div>
          <div class="mt-4 mb-6">
            <p
              class="text-sm"
            >Com a remoção do produto, seus dados serão excluídos e não podem ser restaurados.</p>
            <div class="mt-4 mb-8">
              <div class="flex mt-6 text-sm">
                <label class="flex items-center text-gray-400 hover:text-gray-100 cursor-pointer">
                  <input
                    type="checkbox"
                    class="text-purple-600 form-checkbox rounded-md bg-gray-600 hover:bg-gray-700 cursor-pointer focus:border-purple-400 focus:outline-none focus:shadow-outline-gray"
                    v-model="confirm"
                  />
                  <span class="ml-2">Confirmar exclusão.</span>
                </label>
              </div>
            </div>
          </div>
          <div class="flex justify-between">
            <button
              class="button-close"
              @click="close"
            >
              <span>Cancelar</span>
            </button>
            <button class="button-purple disabled:opacity-50" :disabled="!confirm" @click="save">
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
                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                  />
                </svg>
                <span class="ml-2">Excluir</span>
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
  name: "ModalDelete",
  props: {
    show: {
      required: true,
      type: Boolean
    },
    product: {
      required: true,
      type: Object
    }
  },
  data() {
    return {
      confirm: false
    };
  },
  methods: {
    close() {
      this.$emit("close");
      this.confirm = false;
    },
    save() {
      axios
        .delete(`products/${this.product.id}`)
        .then(response => {
          this.$notify(
            {
              group: "foo",
              color: "green",
              title: response.data.message
            },
            20000
          );
          this.close();
          this.$emit("reload");
        })
        .catch(() => {
          this.$notify(
            {
              group: "foo",
              color: "red",
              title:
                "Não foi possível remover o produto, tente novamente mais tarde."
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