<template>
  <div id="Dashboard-Wrap">
    <div class="row p-3">
        <div class="col">
          <div class="border rounded p-4 shadow bg-dark">
            <h2 class="border-bottom text-light fw-bolder">
              News
            </h2>
            <h1 class="text-light">
              {{ posts.length }}
            </h1>
          </div>
        </div>
        <div class="col">
          <div class="border rounded p-4 shadow bg-dark">
            <h2 class="border-bottom text-light fw-bolder">
              Slides
            </h2>
            <h1 class="text-light">
              {{ slides.length }}
            </h1>
          </div>
        </div>
        <div class="col">
          <div class="border rounded p-4 shadow bg-dark">
            <h2 class="border-bottom text-light fw-bolder">
              Category
            </h2>
            <h1 class="text-light">
              {{ categories.length }}
            </h1>
          </div>
        </div>
    </div>

    <div class="row p-3">
      <div class="col">
        <TableNews :datas="posts" :heads="table.heads" @handleDelete="deleteNews" />
      </div>

      <div class="col-4">
        <div class="row">
          <div class="col">
            <div class="category">
              <div class="border border-dark p-4 rounded shadow bg-light">
                <h2 class="table-title text-start text-danger">
                  Category list
                </h2>
                <table class="table">
                  <tbody>
                    <tr v-for="category in categories" :key="category.id">
                      <td class="fw-bolder text-start">{{ category.title.toUpperCase() }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</template>

<script>
import axios from 'axios'
import TableNews from '../../components/TableNews.vue'

const token = window && localStorage.getItem('access_token')

axios.defaults.headers.common['Authorization'] = `Bearer ${token}`

export default {
  name: 'MainPage',
  components: {
    TableNews
  },
  data() {
    return {
      posts: [],
      slides: [],
      admins: [],
      categories: [],
      table: {
        datas: new Array(),
        heads: ['#', 'Title', 'Category', 'Action']
      }
    }
  },
  mounted() {
    const getNews = axios.get('http://127.0.0.1:8000/api/v1/news')
    const getCategory = axios.get('http://127.0.0.1:8000/api/v1/category')
    const getSlide = axios.get('http://127.0.0.1:8000/api/v1/slide')

    axios.all([getNews, getCategory, getSlide])
      .then(res => {
        this.posts = res[0].data.data
        this.categories = res[1].data.data
        this.slides = res[2].data.data
        
        console.log(this.posts.length)
      }).catch(() => {
        this.$swal({
          icon: 'error',
          title: 'Oops..',
          text: 'Something Wrong',
          showConfirmButton: false,
          timer: 2000
        })

        this.$router.push({ path: '/admin' })
      })
  },
  methods: {
    getData() {
      console.log(this.posts)
    },
    deleteNews(e) {
      axios.delete('http://127.0.0.1:8000/api/v1/news/' + e.toString())
        .then(() => {
          this.$swal({
            icon: 'success',
            title: 'Success...',
            text: 'Deleted successfully',
            showConfirmButton: false,
            timer: 2000
          })
        }).catch(() => {
          this.$swal({
            icon: 'error',
            title: 'Ooopss..',
            text: 'Failed to deleted',
            showConfirmButton: false,
            timer: 2000
          })
        })
    }
  }
}
</script>

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap');

::-webkit-scrollbar {
  display: none;
}

</style>