<template>
    <div style="display: inline-block" class="pull-right">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" @click="openForm">发送私信</button>

        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">发送私信给 "{{ to_user }}"</h4>
                    </div>
                    <div class="modal-body">
                        <textarea class="form-control" v-model="body" placeholder="请输入内容..." v-if="!status"></textarea>
                        <div class="alert alert-success" v-if="status">
                            <strong>私信发送成功</strong>
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
        props:['user','to_user'],
        data() {
            return {
                body: '',
                status: false
            }
        },
        methods: {
            store: function () {
                this.$http.post('/api/message/store', {'user': this.user, 'body': this.body}).then(response => {
                    this.status = response.data.status
                    setTimeout(function () {
                        $('#myModal').modal('hide');
                    }, 1000)
                })
            },
            openForm: function () {
                $('#myModal').modal('show');
            }
        }
    }
</script>
