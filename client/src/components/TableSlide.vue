<template>
  <div id="TableSlide" class="border border-dark p-4 rounded shadow bg-light">
    <h2 class="table-title text-start bg-dark">Table</h2>
    <table class="table p-2">
      <thead class="">
        <tr class="bg-dark">
          <th v-for="head of heads" :key="head" class="text-light"> {{ head }}</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="slide of datas" :key="slide.id">
          <td scope="row" class="fw-bolder">{{ slide.id }}</td>
          <td>{{ slide.title }}</td>
          <td>{{ slide.description }}</td>
          <td>
            <button @click.prevent="handleEdit(slide)" class="btn btn-warning me-2">
              edit
            </button>
            <button @click.prevent="handleDelete(slide.id)" class="btn btn-danger">
              delete
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  name: 'TableSlideComponent',
  props: {
    datas: {
      type: Array,
      required: true
    },
    heads: {
      type: Array,
      required: true
    }
  },
  emits: ['handleEdit', 'handleDelete'],
  methods: {
    handleEdit(e) {
      this.$emit('handleEdit', e)
    },
    handleDelete(id) {
      this.$emit('handleDelete', id)
    }
  }
}
</script>

<style>

</style>