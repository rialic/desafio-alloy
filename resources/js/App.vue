<script setup>
import Appbar from '@/components/Appbar.vue';
import Footer from '@/components/Footer.vue';
import TasksContainer from '@/components/TasksContainer.vue';
import Modal from '@/components/Modal.vue';
</script>

<template>
  <div class="content-tasks">
    <Appbar />
    <TasksContainer />
    <Modal />
    <Footer />
  </div>
</template>
