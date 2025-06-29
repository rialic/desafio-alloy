import { defineStore } from 'pinia'
import axios from 'axios'

export const useTaskStore = defineStore('tasks', {
  state: () => ({
    modal: false,
    task: {
      id: null,
      nome: null,
      descricao: null,
      data_limite: null
    },
    tasks: [],
    loading: false,
  }),
  actions: {
    async fetchTasks() {
      return await axios.get('api/tasks')
    },
    async createTask(task) {
      try {
        return await axios.post('api/tasks', task)
      } catch (exception) {
        const { response } = exception
        return response
      }
    },
    async updateTask(task, id) {
      try {
        return await axios.put(`api/tasks/${id}`, task)
      } catch (exception) {
        const { response } = exception
        return response
      }
     },
    async deleteTask(id) {
      try {
        return await axios.delete(`api/tasks/${id}`)
      } catch (exception) {
        const { response } = exception
        return response
      }
    },
    showModal() {
      this.modal = true
    },
    hideModal() {
      this.modal = false
    }
  }
})