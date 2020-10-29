<template>
  <div class="card">
    <div class="card-header">Edit product</div>
    <div class="card-body">
      <product-form :product-form="product" v-if="product" :edit="true" @submitted="update($event)"></product-form>
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
  data() {
    return {
      product: null,
      productId: this.$route.params.id
    }
  },
  methods: {
    findProduct() {
      axios.get('/admin/products/' + this.productId)
        .then((response) => {
          this.product = response.data.product
        })
    },
    update(product) {
      axios.put('/admin/products/' + this.productId, product)
        .then((response) => {
          this.$router.push({name: 'admin.products'})
        })
    }
  },
  mounted () {
    this.findProduct()
  }
}
</script>

