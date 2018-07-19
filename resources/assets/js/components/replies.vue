<template>
    <div>
        <div v-for="(reply, index) in items" :key="reply.id">
            <reply :data='reply' @deleted='remove(index)'></reply>
        </div>

        <paginator :dataSet='dataSet' @updated='fetch'></paginator>
        <new-reply :endPoint='endPoint' @added='add'></new-reply>

    </div>

</template>

<script>
    import reply from "./reply.vue";
    import paginator from "./paginator.vue";
    import newReply from "./newReply.vue";
    export default {    
        components: {reply, newReply, paginator},

        data() {
            return {
                dataSet:[],
                items: [],
                endPoint: location.pathname + '/reply'
            }
        },

        created() {
            this.fetch();
        },

        methods: {
            fetch(page=1) {
                axios.get(location.pathname + '/replies?page=' + page).then(((response) => {
                    this.dataSet = response.data;
                    this.items = this.dataSet.data;

                    window.scrollTo(0, 0);
                }))
            },

            remove(index) {
                this.items.splice(index, 1);
                this.$emit('removed');
            },

            add(reply) {
                this.items.push(reply);
                this.$emit('added');
            }
        }
    }
</script>

