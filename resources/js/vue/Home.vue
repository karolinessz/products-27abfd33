<template>
  <div class="flex h-screen">
    <Sidebar />
    <div class="flex flex-col flex-1 bg-gray-900">
      <Header />
      <main class="h-full pb-16 overflow-y-auto">
        <router-view></router-view>
      </main>
    </div>
  </div>
</template>

<script>
import Header from "./Header";
import Sidebar from "./Sidebar";
export default {
  name: "App",

  components: {
    Header,
    Sidebar
  },

  data() {
    return {};
  }
};
</script>