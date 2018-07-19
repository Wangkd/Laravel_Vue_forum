<reply :attributes="{{ $reply }}" inline-template>
    <div id="reply-{{ $reply->id }}" class="card mb-3">
        <div class="card-header d-flex justify-content-between">
            <div>
                <a href="/profiles/{{ $reply->owner->name }}">
                    {{ $reply->owner->name }} 
                </a>
                at {{ $reply->created_at->diffForHumans()}}
            </div>

            <favorite :reply="{{ $reply }}"></favorite>

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
        @can('update', $reply)
        <div v-if="!editting">
            <div class="card-footer">
                <div class="d-flex">
                    <button class="btn btn-primary btn-sm mr-2" @click="editting = true">Edit</button>
                    <button class="btn btn-danger btn-sm" @click="destroy">Delete</button>
                </div> 
            </div>
        </div>
        @endcan
    </div>
</reply>