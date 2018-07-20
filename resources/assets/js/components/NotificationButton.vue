<template>
    <li class=" dropdown" v-if="notifications.length">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown">
            Notifications
        </a>
        <div class="dropdown-menu">
            <div v-for="notification in notifications" :key='notification.id'>
                <a class="dropdown-item" :href="notification.data.link" v-text="notification.data.message" @click="markAsRead(notification)"></a>
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
            markAsRead(notification) {
                // profiles/{user}/notifications/{notification}
                axios.delete('/profiles/' + window.App.user.name + '/notifications/' + notification.id);
            }
        }
    }
</script>
