<template>
    <div class="products-wrapper">
        <div class="row">
            <div class="col-lg-6 mx-auto">
                Create product
                <hr/>
                <form>
                    <div class="row">
                        <div class="col-8">

                            <div class="form-group">
                                <label for="product_name">Name</label>
                                <input class="form-control" id="product_name" type="text" v-model="product.name" >
                            </div>

                            <div class="form-group">
                                <label for="product_price">Price</label>
                                <input class="form-control" id="product_price" type="number" step="0.1" v-model="product.price" >
                            </div>
                            
                            <div class="form-group">
                                <label for="product_description">Description</label>
                                <textarea class="form-control" id="product_description" v-model="product.description"></textarea>
                            </div>

                            <div class="form-group mt-4">
                                <vue-dropzone v-on:vdropzone-error="onDzError" v-on:vdropzone-success="onSuccess" ref="myVueDropzone" id="dropzone" :options="dropzoneOptions"></vue-dropzone>
                                <div class="text-center mt10">
                                    <!-- <button type="button" v-on:click="clearDz">Effacer</button> -->
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-4">
                            <label for="product_categories">Categories</label>
                            <select id="product_categories" class="form-control" multiple v-model="product.categories">
                                <option v-for="category in Categories" :key="category.id" :value="category.id">{{   category.name }}</option>
                            </select>
                        </div>
                    </div>

                    <hr/>

                    <div class="row pb-5">
                        <div class="col-6">
                            <button type="button" class="btn btn-secondary">Cancel</button>
                        </div>
                        <div class="col-6 text-right">
                            <button :disabled="!isValide || saving" type="button" v-on:click="createProdduct" class="btn btn-success">Create</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</template>

<script>
import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'
import { mapActions } from 'vuex';

export default {
    components: {
        vueDropzone: vue2Dropzone
    },
    mounted(){
        this.getCategories();
    },
    data(){
        return{
            saving: false,
            product: {
                name: '',
                price: null,
                description: null,
                image: null,
                categories: [],
            },
            uploadedFile: '',
            dropzoneOptions: {
                url: API_URL + '/uploadfile',
                thumbnailWidth: 150,
                thumbnailHeight: 150,
                maxFilesize: 3,
                maxFiles: 1,
                acceptedFiles: 'image/*',
                createImageThumbnails: true
            }
        }
    },
    computed: {
        Categories: function(){
            return this.$store.state.categories;
        },
        isValide: function() {
          return (this.product.name != '' 
                    && this.product.price != ''
                    && this.product.price > 0);
      }
    },
    methods: {
        ...mapActions(['getCategories']),
        onSuccess: function(file, response) {
          if(response.result == 'success'){
              this.product.image = response.file;
          }
        },

        onDzError: function(file, message, xhr){
            this.$refs.myVueDropzone.removeFile(file);
        },

        clearDz: function(){
          this.$refs.myVueDropzone.removeAllFiles();
          this.product.image = '';
        },

        createProdduct: function(){
            this.saving = true;

            axios.post(API_URL + '/products/create', this.product)
                .then(response => {

                    if(response.statusText == 'OK' || response.status == 201){
                        alert('The product was created succesfuly')
                        this.$router.push('/products/');
                    }
                    else{
                        alert('Sorry, something went wrong!');
                    }
                    this.saving = false;
                })
                .catch(error => {
                    this.saving = false;
                    console.log(error);
                });
        }
    }
}
</script>