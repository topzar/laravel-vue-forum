<template>
    <div style="display: inline-block">
        <!-- Button trigger modal -->
        <span class="label label-success" v-text="text" @click="openCommentForm"></span>

        <!-- Modal -->
        <div class="modal fade" :id="dialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">评论列表</h4>
                    </div>
                    <div class="modal-body">
                        <div class="media" v-for="comment in comments" :key="comment.id">
                            <div class="media-left media-middle">
                                <a href="#">
                                    <img class="media-object img-circle" :src="comment.user.avatar"/>
                                </a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">{{ comment.user.name}}</h4>
                                <p>{{ comment.body}}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea cols="30" rows="10" class="form-control" v-model="body"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        <button type="button" class="btn btn-primary" @click="store">发送</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        props:['type','id','count'],
        data() {
            return {
                body: '',
                comments: []
            }
        },
        computed: {
            text() {
                return this.count + "评论"
            },
            dialog() {
                return 'comments-dialog-' + this.type + '-' + this.id
            },
            dialogId() {
                return '#' + this.dialog
            },
        },
        methods: {
            store: function () {
                this.$http.post('/api/comment/create', {'id': this.id, 'body': this.body,'type': this.type}).then(response => {
                    let comment = {
                        user:{
                            name:LEARNFANS.name,
                            avatar:LEARNFANS.avatar
                        },
                        body: response.data.body
                    }
                    this.comments.push(comment)
                    this.body = ''
                })
            },
            openCommentForm: function () {
                //获取评论
                this.getComments()
                $(this.dialogId).modal('show');
            },
            getComments() {
                this.$http.get('/api/' + this.type +'/' + this.id + '/comments').then(response => {
                    this.comments = response.data
                })
            }
        }
    }
</script>
