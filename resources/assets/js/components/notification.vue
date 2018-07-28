<template>
    <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            <span class="fa fa-bell"></span>
            <span class="badge">{{ unreads.length }}</span>
        </a>

        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
           <notification-item></notification-item>
        </div>
    </li>
</template>

<script>
    export default {
        props:['unreads'],
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
