<template>
    <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            <span class="fa fa-bell"></span>
            <span class="badge badge-danger" id="count-notification">{{ messages.length }}</span>
        </a>

        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
           <a href="#" class="dropdown-item" v-for="message in messages" :key="message.id">
                {{ message.data }}
           </a>
        </div>
    </li>
</template>

<script>
    export default {
        props:['messages'],
    }
</script>
