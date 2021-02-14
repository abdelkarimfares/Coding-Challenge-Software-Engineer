<template>
  <div class="navbar py-3">
      <div class="container">
          <h5 class="text-center">Coding challenge</h5>
          <ul class="nav">
            <li>
              <router-link class="btn btn-default" exact to="/products">Products</router-link>
            </li>
            <li>
              <router-link class="btn btn-default" exact to="/products/create">Create Product</router-link>
            </li>
          </ul>
      </div>
  </div>
</template>

<script>
export default {

}
</script>

<style lang="scss">
  .navbar{
    border-bottom: 1px solid #EEE;
    padding: 10px;
    margin-bottom: 20px;
    h5{
      // width: 100%;
    }
  }
</style>