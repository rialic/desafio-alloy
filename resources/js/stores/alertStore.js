import { defineStore } from 'pinia'

export const useAlertStore = defineStore('alert', {
  state: () => ({
    show: false,
  }),
  actions: {
    showAlert() {
      this.show = true
    },
    hideAlert() {
      this.show = false
    }
  }
})