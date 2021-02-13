<template>
    <div class="container">
        <div class="products-wrapper">
            <div class="py-2 text-right">
                <div class="row">
                    <div class="col-lg-2">
                        <filter-type />
                    </div>
                    <div class="col-lg-2">
                        <filter-by-category />
                    </div>
                    <div class="col-lg-8">
                        <button type="button" class="btn btn-primary" v-on:click="newProduct">New Product</button>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Description</th>
                        <th scope="col">Category</th>
                        <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="product in Products" :key="product.id">
                            <th scope="row">
                                <thumbnail-product :src="product.image"/>
                            </th>
                            <td>{{ product.name }}</td>
                            <td>{{ product.price }}</td>
                            <td>{{ product.description }}</td>
                            <td>
                                <ul>
                                    <li v-for="category in product.categories" :key="category.id">{{ category.name }}</li>
                                </ul>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger" v-on:click="DeleteProduct(product.id)">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions } from 'vuex'
import FilterTypeComponent from '@/components/FilterTypeComponent.vue'
import CategoryFilterComponent from '@/components/CategoryFilterComponent.vue'
import ThumbnailComponent from '@/components/ThumbnailComponent.vue'

export default {
    components: {
        'filter-type': FilterTypeComponent,
        'filter-by-category': CategoryFilterComponent,
        'thumbnail-product': ThumbnailComponent,
    },
    mounted(){
        this.getProducts();
    },

    computed: {
        Products(){
            return this.$store.state.products;
        }
    },

    methods: {
        ...mapActions(['getProducts']),
        DeleteProduct(id){
            if(confirm('Are Sure you want to delete?')){
                this.$store.dispatch('deleteProduct', id);
            }
        },
        newProduct(){
            this.$router.push("/products/create")
        }
    }
}
</script>

<style>

</style>