<script setup>
import { ref, } from "vue";
import { useTaskStore } from "@/stores/taskStore";
import { useAlertStore } from "@/stores/alertStore";
import { storeToRefs } from "pinia";

const taskStore = useTaskStore();
const alertStore = useAlertStore();
let { modal } = storeToRefs(taskStore);
const errors = ref([])

const save = async () => {
    const action = !taskStore.task.id ? 'createTask' : 'updateTask'
    const response = await taskStore[action](taskStore.task, taskStore.task.id)

    if (response.status === 200 || response.status === 201) {
        alertStore.showAlert()
        taskStore.tasks = (await taskStore.fetchTasks()).data
    }

    if (response.status === 422) {
        errors.value = []
        errors.value = response.data.errors

        return
    }

    taskStore.hideModal()
}
</script>

<template>
<div :class="['modal-task', {'show-modal': modal}]">
    <div class="container-modal regular">
      <div class="top-modal">
        <h3>Nova tarefa / Editar tarefa</h3>
        <div @click.prevent="modal = false" data-w-id="6a3ff0cf-028e-52be-3eb6-818b0ee5780f" class="close-modal">
          <div class="icon w-embed"><svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M17 7L7 17M7 7L17 17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg></div>
        </div>
      </div>
      <div class="content-modal">
        <div class="form-fields w-form">
          <form id="email-form" name="email-form" data-name="Email Form" method="get" class="form" data-wf-page-id="68420144a36b4657b5aa01f6" data-wf-element-id="6a3ff0cf-028e-52be-3eb6-818b0ee57822">
            <div class="block-fields-form">
              <div class="input-wrap no-margin-bottom">
                <input v-model="taskStore.task.nome" class="input w-input" maxlength="256" name="name-3" data-name="Name 3" placeholder="" type="text" id="name-3" required="">
                <label for="name" class="field-label">Nome</label>
              </div>

             <small v-if="errors['nome']" class="error-message">{{ errors['nome'].join(' ') }}</small>

              <div class="input-wrap no-margin-bottom">
                <input v-model="taskStore.task.descricao" class="input w-input" maxlength="256" name="name-3" data-name="Name 3" placeholder="" type="text" id="name-3" required="">
                <label for="name-4" class="field-label">Descricao</label>
             </div>

              <div class="input-wrap no-margin-bottom">
                <input v-model="taskStore.task.data_limite" class="input w-input" maxlength="256" name="name-3" data-name="Name 3" placeholder="" type="text" id="name-3" required="">
                <label for="name-4" class="field-label">Data de Finalização</label>
              </div>

              <small v-if="errors['data_limite']" class="error-message">{{ errors['data_limite'].join(' ') }}</small>
            </div>
          </form>
        </div>
      </div>
      <div class="bottom-modal">
        <div class="flex-block-horizontal-right-align">
          <div @click.prevent="modal = false" data-w-id="6a3ff0cf-028e-52be-3eb6-818b0ee5783a" class="button outlined rounded">
            <div>Fechar</div>
          </div>
          <div @click.prevent="save" data-w-id="f2777188-2bda-c1f8-1b35-7b28c58968ac" class="button rounded">
            <div>Salvar / Editar</div>
          </div>
        </div>
      </div>
    </div>
</div>
</template>