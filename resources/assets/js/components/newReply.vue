<template>
    <div v-if="signedIn">
        <textarea class="form-control mb-3" name="body" rows="4" placeholder="Reply here..." required v-model="body"></textarea>
        <button class="btn btn-default" @click="submit">Reply</button>
    </div>
    <div v-else>
        you need to
        <a href="/login">sign in</a> to add comments 

    </div>
</template>

<script>
export default {
    props: ['endPoint'],

    data() {
        return {
            body: '',
        }
    },

    computed: {
        signedIn() {
            return window.App.signedIn;
        }
    }, 

    methods: {
        submit() {
            axios.post(this.endPoint, {body: this.body})
                .then(({data}) => {
                    this.body = '';
                    this.$emit('added', data);
                    flash('Your reply has been added');
                })
                .catch(error => {
                    flash(error.response.data, 'danger');
                })
        }
    }
}
</script>

