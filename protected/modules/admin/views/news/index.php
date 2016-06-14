<style>
    .table{margin-left: 20px}
</style>
<table class="table">
    <tr>
        <td colspan='14'>
            <form action="<?php echo $this->createUrl('index') ?>" method='get' class="form-inline">
                <div class="pull-left">
                    <a href="<?php echo $this->createUrl('create') ?>" class='btn btn-primary'>添加资讯</a>
                    <span id='delall' class='btn btn-primary' onclick='delall()'>删除</span>
                </div>
                <div class="col-lg-3">
                    <div class="input-group">
                        <input type='text' placeholder="分类名称" class="form-control" name='name' value="<?php echo Yii::app()->request->getParam('name', '') ?>"   />
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">搜索</button>
                        </span>
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
            </form>
        </td>
    </tr>
</table>

<?php if ($model): ?>
    <table class="table table-hover">
        <thead>
            <tr>
                <td>ID</td>
                <td><input type='checkbox' id='checkAll' myid='0'  /><label for='checkAll'>选择</label></td>
                <td>标题</td>
                <td>分类名称</td>
                <td>排序</td>
                <td>状态</td>
                <td>创建时间</td>
                <td>操作</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($model as $k => $v): ?>
                <tr>
                    <td><?php echo $v->id; ?></td>
                    <td width='7%'><input type='checkbox' name='del' value='<?php echo $v->id ?>' /></td>
                    <td><?php echo $v->title; ?></td>
                    <td><?php echo isset($v->category)?$v->category->name:$v->cat_id; ?></td>
                    <td><?php echo $v->sorting; ?></td>
                    <td><?php echo News::model()->getKv($v->status); ?></td>
                    <td><?php echo date("Y-m-d H:i:s", $v->created); ?></td>
                    <td>
                        <a href='<?php echo $this->createUrl('update',array('id'=>$v->id)) ?>'>[修改]</a>
                        <a onclick="return window.confirm('您确定要删除吗？')" href='<?php echo $this->createUrl('delete',array('id'=>$v->id)) ?>'>[删除]</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <form id='form1' action="<?php echo $this->createUrl('delete') ?>" method="post">
        <input type='hidden' name='id' id='myids'  />
    </form>
<?php else: ?>
    暂无分类
<?php endif; ?>
<script>

    function delall() {
        if (!confirm('确定要删除？')) {
            return;
        }
        var my_id = '';
        $("input[name='del']").each(function (k, v) {
            if ($(v).prop('checked')) {
                my_id += $(this).val() + ',';
            }
        });
        $('#myids').val(my_id);
        $('#form1').submit();
    }
</script>