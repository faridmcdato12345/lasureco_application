<template>
<div>
    <span class="notification-count label label-danger" v-if="notifications.length > 0">{{ notifications.length }}</span>
</div>
</template>
<script>
    export default {
        props: [],
        data() {
            return {
                notifications: []
            }
        },
        mounted() {
            Echo.channel('application-status')
            .listen('ApplicationStatusChanged', (e) => {               
                this.notifications.unshift({
                        description:  'is applying for gas slip',
                        url: '/home'
                        // time: new Date()
                })
            });
        }
    }
</script>