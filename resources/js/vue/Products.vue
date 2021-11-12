<template>
  <div class="container grid px-6 mx-auto">
    <div class="text-white">Product Component</div>
  </div>
</template>

<script>
export default {
  name: "Products",

  created() {
    this.getProducts();
  },

  methods: {
    getProducts() {
      axios
        .get("products")
        .then(response => {
          console.log(response);
        })
        .catch(err => {
          console.log(err);
        });
    }
  }
};
</script>
