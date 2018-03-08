<template>
    <button class="btn"
            v-text="text"
            v-bind:class="{'btn-success': voted, 'btn-default': !voted}"
            v-on:click="vote"
    >
    </button>
</template>

<script>
    export default {
        props:['answer', 'votes_count'],
        mounted() {
            this.$http.post('/api/answer/'+ this.answer +'/voted').then(response => {
                //console.log(response.data)
                this.voted = response.data.voted
            })
            //console.log('Component mounted.')
        },
        data() {
            return {
                voted: false
            }
        },
        computed: {
            text() {
                return this.votes_count
            }
        },
        methods: {
            vote: function () {
                this.$http.post('/api/answer/vote', {'answer': this.answer}).then(response => {
                    //console.log(response.data)
                    this.voted = response.data.voted
                    response.data.voted ? this.votes_count++ : this.votes_count--
                })
            }
        }
    }
</script>
