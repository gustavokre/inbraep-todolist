<template>
    <div>
        <p>Home/Index.vue</p>
<!--    vuex store test -->
        <p>{{$store.state.test}}</p>
<!--    devextreme test    -->
        <DxButton
            text="Click me"
        />
    </div>

</template>

<script>
import DxButton from 'devextreme-vue/button';
export default {
    name: "Index",

    components: {
        DxButton,
    },

    mounted() {

        // this.$swal('Test Vue-SweetAlert2');

    }
}
</script>

<style scoped>

</style>
