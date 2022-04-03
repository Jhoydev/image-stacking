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
            let alert = document.querySelector('#warning-message');
            try {
                const response = await axios.get('api/layers');
                this.variations = response.data;
                alert.classList.add('d-none');
            } catch (e) {
               if (e.response.status === 400){
                   let alert = document.querySelector('#warning-message');
                   alert.classList.remove('d-none');
                   alert.innerHTML = e.response.data.error;
               }
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
