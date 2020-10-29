<template>
  <div>
    <div class="mb-4 d-flex justify-content-between align-items-center">
      <h3>Product list</h3>
      <router-link v-if="user.role != 'admin'" :to="{ name: 'admin.products.create' }" class="btn btn-primary btn-md">Add new product</router-link>
    </div>
    <table class="table table-striped table-bordered">
      <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Category</th>
        <th scope="col">Price</th>
        <th scope="col">Status</th>
        <th scope="col">#</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="product in products" :key="product.id">
        <th scope="row">{{ product.id }}</th>
        <td>{{ product.title }}</td>
        <td>{{ product.category }}</td>
        <td>{{ product.price }}</td>
        <td>{{ product.status }}</td>
        <td v-if="user.role == 'admin'">
          <button v-if="product.status == 'unapproved'" @click="accept(product.id)" class="btn btn-sm btn-success">Accept</button>
          <button v-else @click="refuse(product.id)" class="btn btn-sm btn-danger">Refuse</button>
        </td>
        <td v-if="user.role != 'admin'">
          <button
            class="btn btn-sm btn-danger"
            @click="deleteProduct(product.id)"
          >{{ $t('delete') }}
          </button>
          <router-link
            class="ml-2 btn btn-sm btn-success"
            :to="{ name: 'admin.products.edit', params: {id: product.id} }"
          >{{ $t('edit') }}
          </router-link>
        </td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<script>

import axios from 'axios'
import { mapGetters } from 'vuex'

export default {
  middleware: 'auth',
  data () {
    return {
      products: []
    }
  },
  methods: {
    fetchAllProducts () {
      axios.get('/admin/products')
        .then((response) => {
          this.products = response.data.products
        })
    },
    deleteProduct (id) {
      axios.delete('/admin/products/' + id)
        .then((response) => {
          this.products.splice(this.products.map(item => item.id).indexOf(id), 1)
        })
    },
    accept(id) {
      axios.patch('/admin/products/' + id + '/accept')
        .then((response) => {
          this.products.forEach(item => {
            if(item.id == id) {
              item.status = 'approved'
            }
          })
        })
    },
    refuse(id) {
      axios.patch('/admin/products/' + id + '/refuse')
        .then((response) => {
          this.products.forEach(item => {
            if(item.id == id) {
              item.status = 'unapproved'
            }
          })
        })
    }
  },
  computed: mapGetters({
    user: 'auth/user'
  }),
  mounted () {
    this.fetchAllProducts()
  }
}
</script>
