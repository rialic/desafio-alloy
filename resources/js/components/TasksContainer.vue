<script setup>
import { onMounted } from "vue";
import { useTaskStore } from "@/stores/taskStore";
import Alert from '@/components/Alert.vue';
import TaskList from '@/components/TaskList.vue';

const taskStore = useTaskStore();

onMounted(async () => {
    taskStore.tasks = (await taskStore.fetchTasks()).data
})
</script>

<template>
    <Alert/>

    <div class="tasks">
        <div class="form-fields no-space-top w-form">
        <form id="email-form" name="email-form" data-name="Email Form" method="get" class="form" data-wf-page-id="68420144a36b4657b5aa01f6" data-wf-element-id="974e3203-e48c-4560-0c4e-bd34c0af802b">
          <div class="block-tasks">
            <template v-if="taskStore.tasks.length" v-for="(task, _) in taskStore.tasks" :key="index">
                <TaskList :task="task"/>
            </template>
          </div>
        </form>
      </div>
    </div>
</template>
