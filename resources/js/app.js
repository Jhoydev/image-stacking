require('./bootstrap');
window.Vue = require('vue');
import stack from './components/stack.vue';

const app = new Vue({
    el: '#app',
    data: {
        app: 'app',
        variations: []
    },
    components: {
        stack
    },
    async mounted(){
        await this.fetchLayers()
    },
    methods: {
        async fetchLayers (){
            const response = await axios.get('api/layers');
            this.variations = response.data;
        }
    }
})
