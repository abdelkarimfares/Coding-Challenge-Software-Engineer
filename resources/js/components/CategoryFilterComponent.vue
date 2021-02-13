<template>
  <select class="custom-select" id="inputGroupSelect02" v-model="category_id">
      <option value="">Filter by category</option>
    <option v-for="category in Categories" :key="category.id" :value="category.id">{{ category.name }}</option>
  </select>
</template>

<script>
import { mapActions } from 'vuex';
import { mapMutations } from 'vuex';

export default {
    mounted(){
        this.getCategories();
        this.category_id = this.$store.state.category_id;
    },
    data(){
        return {
            category_id: ''
        }
    },
    computed:{
        Categories(){
            return this.$store.state.categories;
        },
    },
    methods: {
        ...mapActions(['getCategories', 'sortProducts']),
    },
    watch: {
        category_id: function(newVal, oldVal){
            this.$store.commit('setSelectedCategory', newVal);
            this.sortProducts();
        }
    }
}
</script>

<style>

</style>