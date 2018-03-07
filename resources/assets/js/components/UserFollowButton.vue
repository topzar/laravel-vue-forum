<template>
    <button class="btn"
            v-text="followText"
            v-bind:class="{'btn-success': followed, 'btn-default': !followed}"
            v-on:click="follow"
    >
    </button>
</template>

<script>
    export default {
        props:['user'],
        mounted() {
            this.$http.get('/api/user/'+ this.user +'/followed').then(response => {
                //console.log(response.data)
                this.followed = response.data.followed
            })
            //console.log('Component mounted.')
        },
        data() {
            return {
                followed: false
            }
        },
        computed: {
            followText() {
                return this.followed ? '已关注' : '关注TA'
            }
        },
        methods: {
            follow: function () {
                this.$http.post('/api/user/follow', {'user': this.user}).then(response => {
                    //console.log(response.data)
                    this.followed = response.data.followed
                })
            }
        }
    }
</script>
