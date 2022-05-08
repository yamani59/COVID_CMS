<template>
  <div id="Post-Wrap">
    <div class="row p-3">
      <div v-if="showTable && edit.show">
        <button @click.prevent="showTable = !showTable" class="btn btn-dark mb-3 text-start">Add + {{ showTable }}</button>
        <TableSlide :datas="getData" :heads="heads" @handleDelete="deleteNews" @handleEdit="handleEdit" />
      </div>
      <div v-else>
        <Form :configs="configs" @handleSubmit="handleSubmit" :dataValue="edit.dataEdit" />
        <button @click.prevent="backButton" class="btn btn-dark mt-3 text-start">Back</button>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import Form from '../../components/Form.vue'
import TableSlide from '../../components/TableSlide.vue'

const token = window && localStorage.getItem('access_token')

axios.defaults.headers.common['Authorization'] = `Bearer ${token}`

export default {
  name: 'SlidePost',
  components: {
    Form, TableSlide
  },
  data() {
    return {
      getData: [],
      heads: ['#', 'Title', 'Description', 'Action'],
      showTable: true,
      edit: {
        show: true,
        dataEdit: [],
      },
      configs: [
        { name: 'Title', type: 'text' },
        { name: 'image', type: 'file' },
        { name: 'description', type: 'text' },
        { name: 'link', type: 'text' }
      ]
    }
  },
  created() {
    axios.get('http://127.0.0.1:8000/api/v1/slide')
      .then(res => {
        this.getData = res.data.data
      }).catch(() => {
        this.$swal({
          icon: 'error',
          title: 'Oopss...',
          text: 'Something Wrong',
          showConfirmButton: false,
          timer: 2000
        })
      })
  },
  methods: {
    deleteNews(e) {
      axios.delete('http://127.0.0.1:8000/api/v1/slide/' + e.toString())
        .then(async () => {
          const reloadData = await axios.get()
          this.getData = reloadData.data.data
        }).catch(() => {
          this.$swal({
            icon: 'error',
            title: 'Oopss...',
            text: 'Delete Failed',
            showConfirmButton: false,
            timer: 2000
          })
        })
    },
    handleSubmit(e) {      
      let formData = new FormData()

      if (e.by) {
        if (e.target.image.files[0]) 
          formData.append('poster', e.target.image.files[0])
        formData.append('id', e.by)
        formData.append('news_category_id', e.target.news_category_id.value)
        formData.append('title', e.target.title.value)
        formData.append('content', e.target.content.value)

        axios.post('http://127.0.0.1:8000/api/v1/news/' + e.by.toString(), 
          formData, {
            headers: {
              'Content-type': 'multipart/form-data'
            }
          })
          .then(async () => {
            const news = 'http://127.0.0.1:8000/api/v1/news'
            const categories = 'http://127.0.0.1:8000/api/v1/category'

            const api = await this.getApi([news, categories])
            this.getData = api[0].data.data
            this.configs[3].select = api[1].data.data
            this.edit.dataEdit = null
            this.backButton()
          }).catch(() => {
            this.$swal({
              icon: 'error',
              title: 'Oopss...',
              text: 'Failed for updated your data',
              showConfirmButton: false,
              timer: 2000
            })
          })
      } else {
        formData.append('news_category_id', e.target.news_category_id.value)
        formData.append('title', e.target.title.value)
        formData.append('content', e.target.content.value)
        formData.append('poster', e.target.image.files[0])

        axios.post('http://127.0.0.1:8000/api/v1/news/new', 
          formData, {
            headers: {
              'Content-type': 'multipart/form-data'
            }
          })
          .then(() => {
            this.$swal({
              icon: 'success',
              title: 'Horee...',
              text: 'Add news successfully',
              showConfirmButton: false,
              timer: 2000
            })
            this.backButton()
          }).catch(() => {
            this.$swal({
              icon: 'error',
              title: 'Ooopss...',
              text: 'Failed to post',
              showConfirmButton: false,
              timer: 2000
            })
          })
      }
    },
    handleEdit(e) {
      this.edit = {
        show: !this.edit.show,
        dataEdit: e
      }
    },
    backButton() {
      this.showTable = true
      this.edit.show = true
    },
    async getApi(urlApi) {
      const dataPromise = urlApi.map(data => {
        return axios.get(data)
      })
      return await axios.all(dataPromise)
    }
  }
}
</script>

<style>
  #Post-Wrap {
    height: 100vh;
    overflow-y: auto;
    overflow-x: hidden;
  }
</style>


<style>

</style>