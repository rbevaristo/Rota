<template>
    <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            <span class="fa fa-bell"></span>
            <span class="badge badge-danger">
               {{ messages.length }}
            </span>
        </a>

        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <li v-for="message in messages">
                <a href="#" class="dropdown-item" v-on:click="MarkAsRead(message)">
                    {{ message.data.messages.title }}
                </a>
                
            </li>
            <li v-if="messages.length == 0">
                <span>No Message</span>
            </li>
        </ul>
    </li>
</template>

<script>
    export default {
        props:['messages'],
        methods: {
            MarkAsRead: function(message){
                var data = {
                    id: message.id
                };
                axios.post('dashboard/notification/read', data).then(response => {
                    window.location.href = "/message/"+message.id
                });
            }
        }
    }
</script>
