<template>
  <div class="flex h-screen bg-gray-900">
    <Sidebar :sidebar="sidebar" @close="sidebar = false" />
    <div class="flex flex-col flex-1 overflow-y-auto overflow-x-hidden">
      <Header :sidebar="sidebar" @update:sidebar="showSidebar($event)" />
      <main class="h-full pb-16 overflow-y-auto overflow-x-hidden">
        <router-view></router-view>
      </main>
    </div>
    <Alert />
  </div>
</template>

<script>
import Header from "./components/Header";
import Sidebar from "./components/Sidebar";
import Alert from "./components/Alert";
export default {
  name: "App",

  components: {
    Header,
    Sidebar,
    Alert
  },

  data() {
    return {
      sidebar: false
    };
  },

  methods: {
    showSidebar(event) {
      this.sidebar = event;
    }
  }
};
</script>