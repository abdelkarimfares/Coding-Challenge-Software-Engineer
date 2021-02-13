import axios from 'axios'
import Vuex from 'vuex'
import Vue from 'vue'
Vue.use(Vuex);

export default new Vuex.Store({
    state: {
      products: [],
      sortBy: '',
      category: '',
    },
    mutations: {
      setProducts (state, products) {
        state.products = products;
      },

      setSortBy (state, sortBy) {
        state.sortBy = sortBy;
      },
    },

    actions: {
        getProducts(context){
            let apiUrl = API_URL + '/products';
            
            if(context.state.category != ''){

                apiUrl += '?category=' + context.state.category;
                
            }

            if(context.state.sortBy != ''){

                let prefix = context.state.category != '' ? '&' : '?';
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
        
        sortProducts(context){
           context.dispatch('getProducts')
        },
    }
  })
  