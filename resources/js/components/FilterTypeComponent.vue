<template>
  <select class="custom-select" id="inputGroupSelect02" v-model="sortBy">
    <option v-for="(filter, index) in filters" :key="index" :value="filter.value">{{ filter.text }}</option>
  </select>
</template>

<script>
import { mapActions } from 'vuex';
import { mapMutations } from 'vuex';

export default {
    mounted(){
        this.sortBy = this.$store.state.sortBy;
    },
    data(){
        return {
            filters: [
                    {value: '', text: 'Filter by Name Or Price'},
                    {value: 'name', text: 'Name'},
                    {value: 'price', text: 'Price'},
                ],
            sortBy: ''
            
        }
    },
    computed:{
    },
    methods: {
        ...mapMutations(['setSortBy']),
        ...mapActions(['sortProducts']),
    },
    watch: {
        sortBy: function(newVal, oldVal){
            this.setSortBy(newVal);
            this.sortProducts();
        }
    }
}
</script>

<style>

</style>