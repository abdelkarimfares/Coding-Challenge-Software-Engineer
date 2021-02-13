<template>
    <div class="wrapper">

        <app-header></app-header>

        <div class="main-panel">
          <router-view></router-view>
        </div>
    
    </div>
</template>

<script>
import HeaderComponent from '@/components/HeaderComponent';
export default {
    components: {
        'app-header': HeaderComponent
    }
}
</script>

<style>

</style>