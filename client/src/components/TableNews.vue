<template>
  <div id="TableNews" class="border border-dark p-4 rounded shadow bg-light">
    <h2 class="table-title text-start">News</h2>
    <table class="table p-2">
      <thead class="">
        <tr class="bg-dark">
          <th v-for="head of heads" :key="head" class="text-light"> {{ head }}</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="post of datas" :key="post.id">
          <td scope="row" class="fw-bolder">{{ post.id }}</td>
          <td>{{ post.title }}</td>
          <td>{{ post.category_id.title }}</td>
          <td>
            <button @click.prevent="handleEdit(post)" class="btn btn-warning me-2">
              edit
            </button>
            <button @click.prevent="handleDelete(post.id)" class="btn btn-danger">
              delete
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import axios from 'axios'

const token = window ?? localStorage.getItem('access_token')

axios.defaults.headers.common['Authorization'] = `Bearer ${token}`

export default {
  name: 'TableNews',
  emits: ['handleDelete', 'handleEdit'],
  props: {
    datas: Array,
    heads: Array
  },
  methods: {
    handleDelete(e) {
      this.$emit('handleDelete', e)
    },
    handleEdit(e) {
      this.$emit('handleEdit', e)
    }
  },
}
</script>

<style>
#TableNews table {
  overflow-y: auto;
}

#TableNews .table-title {
  font-family: 'Poppins', sans-serif;
  font-weight: 500;
}
</style>