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
        props:['question'],
        mounted() {
            this.$http.post('/api/question/followed', {'question': this.question}).then(response => {
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
                return this.followed ? '已关注' : '关注问题'
            }
        },
        methods: {
            follow: function () {
                this.$http.post('/api/question/follow', {'question': this.question}).then(response => {
                    //console.log(response.data)
                    this.followed = response.data.followed
                })
            }
        }
    }
</script>
