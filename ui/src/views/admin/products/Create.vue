<template>
  <div class="card">
    <div class="card-header">Add a new product</div>
    <div class="card-body">
      <product-form @submitted="store($event)"></product-form>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import Form from './From'

export default {
  middleware: 'user',
  components: {
    'product-form': Form
  },
  methods: {
    store (product) {
      axios.post('/admin/products', product)
        .then((response) => {
          this.$router.push({name: 'admin.products'})
        })
    }
  }
}
</script>

