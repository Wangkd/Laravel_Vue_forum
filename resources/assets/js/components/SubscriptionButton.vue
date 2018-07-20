<template>
    <button :class='classes' @click='subscribe'>Subscribe</button>
</template>

<script>
export default {
    props: ['subscribed'],

    data() {
        return {
            active: this.subscribed
        }
    },
    
    computed: {
        classes() {
            return ['btn', this.active ? 'btn-secondary' : 'btn-primary'];
        }
    },

    methods: {
        subscribe() {
            let type = this.active ? 'delete' : 'post';
            axios[type](location.pathname + '/subcriptions');

            this.active = ! this.active;
        }
    }
}
</script>

