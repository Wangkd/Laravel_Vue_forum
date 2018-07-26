<template>
    <div id="'reply-' + id" class="card mb-3">
        <div class="card-header d-flex justify-content-between">
            <div>
                <a :href="'/profiles/'+data.owner.name" v-text="data.owner.name"></a>
                at {{ data.created_at }}
            </div>

            <div v-if="signedIn">
                <favorite :reply="data"></favorite>
            </div>

        </div>
        <div class="card-body">
            <div v-if="editting">
                <textarea class="form-control" v-model="body"></textarea>
                <div class="d-flex mt-2">
                    <button class="btn btn-primary btn-sm mr-2" @click="update">Update</button>
                    <button class="btn btn-link btn-sm" @click="editting = false">Cancel</button>
                </div>
            </div>
            <div v-else v-text="body">
            </div>
        </div>
        <!-- @can('update', $reply) -->
        <div v-if="!editting && canUpdate">
            <div class="card-footer">
                <div class="d-flex">
                    <button class="btn btn-primary btn-sm mr-2" @click="editting = true">Edit</button>
                    <button class="btn btn-danger btn-sm" @click="destroy">Delete</button>
                </div> 
            </div>
        </div>
        <!-- @endcan -->
    </div>
</template>

<script>
import favorite from './favorite.vue';
export default {
    props: ['data'],

    components: {favorite},

    data() {
        return {
            editting: false,
            body: this.data.body,
            id: this.data.id
        }
    },

    computed: {
        signedIn() {
            return window.App.signedIn;
        },
        canUpdate() {
            let user = window.App.user;
            return user && user.id == this.data.user_id;
        }
    },
    
    methods: {
        update() {
            axios.patch('/replies/' + this.data.id,{
                body: this.body
            })
                .then(() => flash('reply updated'))
                .catch(error => {
                    flash(error.response.data, 'danger')
                })
            
            this.editting = false;
            
        },

        destroy() {
            axios.delete('/replies/' + this.data.id);
            
            this.$emit('deleted', this.id);

            flash('reply deleted');
            
        }
    }
}
</script>
