<style>
    .pt8{padding-top: 8px}
</style>
<?php if ($model): ?>
    <?php
    $isEdit = !empty($model->id);
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'id-form',
        'action' => $this->createUrl('save'),
        'enableAjaxValidation' => true,
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
            'class' => 'form-inline'
        ),
    ));
    ?>
    <?php if ($isEdit): ?>
        <input type="hidden" name="id" value="<?php echo $model->id; ?>" />
    <?php endif; ?>
    <table class='table table-hover'>
        <tr>
            <td  style="text-align: right;width:100px;">
                <?php echo $form->labelEx($model, 'title') ?>
            </td>
            <td style="text-align: left;width:40%;">
                <?php echo $form->textField($model, 'title', array('class' => 'form-control')) ?>
            </td>
            <td><?php echo $form->error($model, 'title'); ?></td>
        </tr>
        <tr>
            <td  style="text-align: right;width:100px;">
                <?php echo $form->labelEx($model, 'sorting') ?>
            </td>
            <td style="text-align: left;width:40%;">
                <?php echo $form->textField($model, 'sorting', array('class' => 'form-control')) ?>
            </td>
            <td><?php echo $form->error($model, 'sorting'); ?></td>
        </tr>
        <tr>
            <td  style="text-align: right;width:100px;">
                <?php echo $form->labelEx($model, 'user_id') ?>
            </td>
            <td style="text-align: left;width:40%;">
                <?php echo $form->dropDownList($model, 'user_id', $name, array('class' => 'form-control')) ?>
            </td>
            <td><?php echo $form->error($model, 'user_id'); ?></td>
        </tr>
        <tr>
            <td  style="text-align: right;width:100px;">
                <?php echo $form->labelEx($model, 'status', array('class' => 'pt8')) ?>
            </td>
            <td style="text-align: left;width:40%;">
                <?php echo $form->radioButtonList($model, 'status', News::model()->getKv(), array('class' => 'form-control', 'separator' => '&nbsp;&nbsp;&nbsp;&nbsp;')) ?>
            </td>
            <td><?php echo $form->error($model, 'status'); ?></td>
        </tr>
        <tr>
            <td  style="text-align: right;width:100px;">
                <?php echo $form->labelEx($model, 'cat_id') ?>
            </td>
            <td style="text-align: left;width:40%;">
                <?php echo $form->dropDownList($model, 'cat_id', $cate, array('class' => 'form-control')) ?>
            </td>
            <td><?php echo $form->error($model, 'cat_id'); ?></td>
        </tr>
        <tr>
            <td style="text-align: right;width:100px;">
                <?php echo $form->labelEx($model, 'image') ?>
            </td>
            <td class="tb-uploadify">
                <div class="images-info" style="width:100px;height:100px;border:1px solid #DDD;margin:10px 0px;position:relative">
                    <img style="width: 100%;height:100%" src="<?php echo UtilD::getArticleImageUrl($model->image, $model->cat_id); ?>" />
                    <input type="hidden" name="News[image]" value="<?php echo $model->image ?>" />
                    <?php echo $form->hiddenField($model, 'image', array('class' => 'form-control')) ?>
                    <a class="delete-uploadify" style="position:absolute;top:0px;background:rgba(0,0,0,0.5);color:white;width:20px;height: 20px;text-align: center;right:0px;" href="javascript:void(0)" >X</a>
                </div>
                <?php
                $this->widget('application.extensions.uploadify.EuploadifyWidget', array(
                    'name' => 'up_images',
                    'options' => array(
                        'uploader' => '/static/uploadify/uploadify.swf',
                        'script' => $this->createUrl('/upload/uploadify'),
                        'cancelImg' => '/static/uploadify/cancel.png',
                        'auto' => true,
                        'multi' => false,
                        'folder' => '/tmp',
                        'scriptData' => array('extraVar' => 1234, 'PHPSESSID' => session_id()),
                        'buttonText' => '',
                        'buttonImg' => '/static/uploadify/uploadfile.png',
                        'width' => 118,
                        'height' => 36
                    ),
                    'callbacks' => array(
                        'onError' => 'function(evt,queueId,fileObj,errorObj){alert("Error: " + errorObj.type + "\nInfo: " + errorObj.info);}',
                        'onComplete' => 'onComplete',
                        'onCancel' => 'function(evt,queueId,fileObj,data){alert("Cancelled");}',
                    )
                ));
                ?>
                <div class='form-error'><?php echo $form->error($model, 'image'); ?></div>
            </td>
        </tr>
        <tr>
            <td  style="text-align: right;width:100px;">
                <?php echo $form->labelEx($model, 'content') ?>
            </td>
            <td style="text-align: left;width:40%;">
                <script id="container" name="News[content]" type="text/plain"><?php echo $model->content ?></script>
            </td>
            <td><?php echo $form->error($model, 'content'); ?></td>
        </tr>
        <tr>
            <td colspan='3' style="text-align: center">
                <input type="submit" class='btn btn-primary' value='保存' >
            </td>
        </tr>
    </table>
    <?php $this->endWidget(); ?>
<?php endif; ?>
<script>
    function onComplete(event, ID, fileObj, response, data) {
        var response = eval("(" + response + ")");
        $(event.target).parent("td").find('img').attr("src", response.url);
        $(event.target).parent("td").find('input[type="hidden"]').val(response.url);
    }
    $('.delete-uploadify').bind('click', function () {
        $(this).parent('.images-info').find('img').attr('src', '');
        $(this).parent('.images-info').find('input[type="hidden"]').val('');
    });
</script>



