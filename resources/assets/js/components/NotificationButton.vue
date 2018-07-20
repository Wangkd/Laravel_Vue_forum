<template>
    <li class=" dropdown" v-if="notifications.length">
        <a class="nav-link" href="#" role="button" data-toggle="dropdown">
            <span class="fa fa-bell-o"></span>
        </a>
        <div class="dropdown-menu">
            <div v-for="(notification, index) in notifications" :key='notification.id'>
                <a class="dropdown-item" :href="notification.data.link" v-text="notification.data.message" @click="markAsRead(index, notification)"></a>
            </div>
        </div>
    </li>
</template>

<script>
    export default {
        data() {
            return {
                notifications: false,
            }
        },

        created() {
            axios.get('/profiles/' + window.App.user.name + '/notifications')
                 .then(({data}) => {
                     this.notifications = data;
                 })
        },

        methods: {
            markAsRead(index, notification) {
                axios.delete('/profiles/' + window.App.user.name + '/notifications/' + notification.id)
                     .then(() => this.notifications.splice(index, 1));
            }
        }
    }
</script>
