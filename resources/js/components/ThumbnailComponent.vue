<template>
  <div class="thumbnail-container">
      <img class="img-fluid" :src="Src" alt="">
  </div>
</template>

<script>
export default {
    props: ['src'],
    data(){
        return{
            
        }
    },
    computed: {
        Src: function(){
            if(this.src){
                return location.origin + '/storage/products/' + this.src;
            }
            return '';
        }
    }
}
</script>

<style>
    .thumbnail-container{
        width: 100px;
        height: 100px;
        overflow: hidden;
        border-radius: 5px;
        background: #EEE;
    }
</style>