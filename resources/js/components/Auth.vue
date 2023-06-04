<template>
    <div :id="id" hidden>{{ email }}</div>
  </template>

  <script>
  import axios from 'axios';
  import { mapMutations } from 'vuex';

  export default {
    data() {
      return {
        urlBase: import.meta.env.VITE_API_URL,
      };
    },
    props: ['id', 'email'],
    methods: {

    ...mapMutations(['setUser']),
      getUser() {
        const url = `${this.urlBase}user/autenticado/?email=${this.email}`;
        axios.get(url)
          .then(response => {
            this.setUser(response.data.user);
          })
          .catch(error => {
            console.log(error);
          });
      }
    },
    mounted() {
      this.getUser();
    }
  };
  </script>
