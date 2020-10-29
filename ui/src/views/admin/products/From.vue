<template>
  <form @submit.prevent="onSubmit()">
    <div class="row">
      <div class="col-md-8">
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" id="title" v-model="product.title" class="form-control" required placeholder="Title">
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label for="category">Category</label>
          <input type="text" id="category" v-model="product.category" class="form-control" required
                 placeholder="Category">
        </div>
      </div>
    </div>
    <div class="form-group">
      <label for="price">Price</label>
      <input type="text" id="price" v-model="product.price" class="form-control" required placeholder="Price">
    </div>
    <div class="form-group">
      <label for="description">Description</label>
      <textarea id="description" v-model="product.description" class="form-control" required placeholder="Description"
                rows="5"></textarea>
    </div>
    <button v-if="!edit" class="btn btn-success">{{  $t('save') }}</button>
    <button v-else class="btn btn-success">{{ $t('update') }}</button>
    <router-link :to="{ name: 'admin.products' }" class="ml-2 btn btn-dark">Cancel</router-link>
  </form>
</template>

<script>
export default {
  props: {
    productForm: {
      default: () => {
        return {
          title: '',
          category: '',
          price: 0,
          description: ''
        }
      }
    },
    edit: false,
  },
  data () {
    return {
      product: {
        title: this.productForm.title,
        category: this.productForm.category,
        price: this.productForm.price,
        description: this.productForm.description
      }
    }
  },
  methods: {
    onSubmit () {
      this.$emit('submitted', this.product)
    }
  },
  mounted () {
    console.log(this.product)
    console.log(this.productForm)
  }
}
</script>

