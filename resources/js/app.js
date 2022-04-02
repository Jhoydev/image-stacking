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
    async mounted() {
        await this.fetchLayers()
        document.querySelector('#upload').addEventListener('submit', e => {
            e.preventDefault();
            const data = new FormData(e.target)
            this.storeLayer(e.target.action, data)
        })
    },
    methods: {
        async fetchLayers() {
            try {
                const response = await axios.get('api/layers');
                this.variations = response.data;
            } catch (e) {
                console.log(e)
            }
        },
        async storeLayer(url, data) {
            try {
                await axios.post(url, data, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                $('#addLayerModal').modal('hide')
                document.querySelector('#upload').reset();
                await this.fetchLayers()
            } catch (e) {
                console.log(e)
            }
        }
    }
})
