<template>
    <div>
        <button :class="button" @click="toggle">
            <span :class='heart'></span>
            <span v-text=count></span>
        </button>
    </div>
</template>

<script>
    export default {
        props: ['reply'],
        data() {
            return {
                count: this.reply.favoritesCount,
                isActive: this.reply.isFavorited  
            }
        },

        computed: {
            button() {
                return ['btn', this.isActive ? 'btn-primary' : 'btn-default'];
            },
            heart() {
                return ['fa', this.isActive ? 'fa-heart' : 'fa-heart-o']
            }
        },

        methods: {
            toggle() {
                if(this.isActive) {
                    axios.delete('/replies/' + this.reply.id + '/favorites');
                    this.count--;
                } else {
                    axios.get('/replies/' + this.reply.id + '/favorites');
                    this.count++;
                }
                this.isActive = !this.isActive;
            }
        }
    }
</script>

