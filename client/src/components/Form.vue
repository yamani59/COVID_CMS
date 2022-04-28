<template>
  <form @submit.prevent="handleSubmit" class="form" enctype="multipart/form-data">
    <div class="form-group mb-3" v-for="config of configs" :key="config.plac">
      
      <textarea 
        v-if="config.type == 'textarea'"
        class="form-control"
        :name="config.name.toLowerCase()"
        rows="10" 
        :value="[dataValue[config.name.toLowerCase()] ? dataValue[config.name.toLowerCase()] : '']" />

      <select 
        v-else-if="config.type == 'select'"
        class="form-select"
        :name="config.name.toLowerCase()"
        :value="
          [dataValue[config.name.toLowerCase()] ? 
            dataValue[config.name.toLowerCase()] : '']">
        <option 
          v-for="option of config.select" 
          :value="option.id"
          :key="option.id"> {{ option.title }} </option>
      </select>

      <input 
        v-else
        class="form-control" 
        :type="config.type" 
        :name="config.name.toLowerCase()" 
        :placeholder="config.name" 
        autocomplete="off"
        :value="
          [dataValue[config.name.toLowerCase()] ? 
            dataValue[config.name.toLowerCase()] : '']">

    </div>
    <div class="form-group mb-3" v-if="image">
      <input class="form-control" type="file" :name="image.name">
    </div>
    <div class="form-group mb-3">
      <input class="btn btn-warning form-control" type="submit" value="sumbit">
    </div>
  </form>
</template>

<script>
export default {
  name: 'FormComponent',
  props: {
    configs: {
      type: Array,
      required: true
    },
    dataValue: {
      type: Object,
      default: () => {},
    }
  },
  emits: ['handleSubmit'],
  data() {
    return {
      data: this.dataValue
    }
  },
  methods: {
    handleSubmit(e) {
      e.by = this.dataValue && this.dataValue.id
      this.$emit('handleSubmit', e)
    },
  }
}
</script>

<style>

</style>