<template>
    <div>
        <canvas class="canva-stack"></canvas>
    </div>
</template>

<script>
    export default {
        name: "stack",
        props: ['images'],
        watch: {
            images(newstack, oldstack) {
                this.initCanva()
            }
        },
        mounted() {
            this.initCanva()
        },
        methods: {
            initCanva(){
                let canvas = this.$el.querySelector('.canva-stack');
                canvas.width = 100;
                canvas.height = 100;
                for (let image of this.images){
                    this.drawImageInCanva('/layers/' + image, canvas.getContext('2d'));
                }
            },
            drawImageInCanva(src, canvas) {
                let base_image = new Image();
                base_image.src = src;
                base_image.onload = () => {
                    canvas.drawImage(base_image, 0, 0, 100, 100);
                }
            }
        }
    }
</script>

<style scoped>

</style>
