<script setup>
import { useTaskStore } from "@/stores/taskStore";
import { maskDate } from "@/helpers";

const taskStore = useTaskStore();

const props = defineProps({
  task: {
    required: true
  }
})

const onEdit = (task) => {
    taskStore.task = { ...task }
      Object.entries({...taskStore.task}).forEach(([key, value]) => {
        if (key === 'data_limite' && taskStore.task[key]) {
            taskStore.task[key] = maskDate(value)
        }
    })
    taskStore.showModal()
}

const deleteTask = async (id) => {
    await taskStore.deleteTask(id)
    taskStore.tasks = (await taskStore.fetchTasks()).data
}
</script>

<template>
<div
    @click.prevent="onEdit(task)"
    data-w-id="b02b4e76-1748-d27c-216d-384ad360c12b" class="task">
    <label class="w-checkbox checkbox-field">
    <div class="w-checkbox-input w-checkbox-input--inputType-custom checkbox margin-right-10"></div>
    <input type="checkbox" name="checkbox-6" id="checkbox-6" data-name="Checkbox 6" style="opacity:0;position:absolute;z-index:-1">
    <span :class="['checkbox-label w-form-label', { 'checked': props.task.data_limite }]" for="checkbox-6">
        {{ props.task.nome }}
    </span>
    </label>
    <div v-if="props.task.data_limite" class="date-button margin-left-40">
    <div>{{ maskDate(props.task.data_limite) }}</div>
    </div>

    <div v-if="props.task.descricao" class="task-details">
    <div>{{ props.task.descricao }}</div>
    </div>

    <div @click.prevent.stop="deleteTask(props.task.id)" data-w-id="344bf463-2a50-5263-108f-91b4838268fe" class="remove-task">
    <div data-w-id="2194a6cb-7ee7-ae6b-c1ce-3cc4e5419727" class="button outlined rounded small">
        <div class="icon w-embed"><svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M16 6V5.2C16 4.0799 16 3.51984 15.782 3.09202C15.5903 2.71569 15.2843 2.40973 14.908 2.21799C14.4802 2 13.9201 2 12.8 2H11.2C10.0799 2 9.51984 2 9.09202 2.21799C8.71569 2.40973 8.40973 2.71569 8.21799 3.09202C8 3.51984 8 4.0799 8 5.2V6M10 11.5V16.5M14 11.5V16.5M3 6H21M19 6V17.2C19 18.8802 19 19.7202 18.673 20.362C18.3854 20.9265 17.9265 21.3854 17.362 21.673C16.7202 22 15.8802 22 14.2 22H9.8C8.11984 22 7.27976 22 6.63803 21.673C6.07354 21.3854 5.6146 20.9265 5.32698 20.362C5 19.7202 5 18.8802 5 17.2V6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg></div>
    </div>
    </div>
</div>
</template>