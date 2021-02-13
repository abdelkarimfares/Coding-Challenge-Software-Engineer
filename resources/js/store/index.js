import axios from 'axios'
import Vuex from 'vuex'
import Vue from 'vue'
Vue.use(Vuex);

export default new Vuex.Store({
    state: {
      products: [],
      sortBy: '',
      category_id: '',
      categories: [],
    },
    mutations: {
      setProducts (state, products) {
        state.products = products;
      },
     
      setCategories (state, categories) {
        state.categories = categories;
      },

      setSortBy (state, sortBy) {
        state.sortBy = sortBy;
      },
      
      setSelectedCategory (state, category_id) {
        state.category_id = category_id;
      },
    },

    actions: {

        // GET Products api
        getProducts(context){
            let apiUrl = API_URL + '/products';
            
            if(context.state.category_id != ''){

                apiUrl += '?category=' + context.state.category_id;
                
            }

            if(context.state.sortBy != ''){

                let prefix = context.state.category_id != '' ? '&' : '?';
                apiUrl += prefix + 'sort_by=' + context.state.sortBy;

            }

            axios.get(apiUrl)
            .then(response => {
                context.commit('setProducts', response.data)
            })
            .catch(error => {
                console.log(error);
            })
        },
        
        // GET Categories api
        getCategories(context){
            let apiUrl = API_URL + '/categories';
            
            axios.get(apiUrl)
            .then(response => {
                context.commit('setCategories', response.data)
            })
            .catch(error => {
                console.log(error);
            })
        },
        
        sortProducts(context){
           context.dispatch('getProducts')
        },
        
        deleteProduct(context, id){
          let apiUrl = API_URL + '/products/delete/' + id;
          axios.delete(apiUrl)
            .then(response => {
                if(response.data.result == 'success'){
                    context.dispatch('getProducts')
                  alert('Product was deleted succesfuly');
                }
                else{
                  alert('Product deleted failed');

                }
            })
            .catch(error => {
                console.log(error);
            }) 
        },
       
    }
  })
  