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
            <td  style="text-align: right;width:40%;">
                <?php echo $form->labelEx($model, 'name') ?>
            </td>
            <td style="text-align: left;width:40%;">
                <?php echo $form->textField($model, 'name', array('class' => 'form-control')) ?>
            </td>
            <td><?php echo $form->error($model, 'name'); ?></td>
        </tr>
        <tr>
            <td  style="text-align: right;width:40%;">
                <?php echo $form->labelEx($model, 'sorting') ?>
            </td>
            <td style="text-align: left;width:40%;">
                <?php echo $form->textField($model, 'sorting', array('class' => 'form-control')) ?>
            </td>
            <td><?php echo $form->error($model, 'sorting'); ?></td>
        </tr>
        <tr>
            <td  style="text-align: right;width:40%;">
                <?php echo $form->labelEx($model, 'status',array('class'=>'pt8')) ?>
            </td>
            <td style="text-align: left;width:40%;">
                <?php echo $form->radioButtonList($model, 'status', NewsCategory::model()->getKv() ,array('class' => 'form-control','separator'=>'&nbsp;&nbsp;&nbsp;&nbsp;')) ?>
            </td>
            <td><?php echo $form->error($model, 'status'); ?></td>
        </tr>
        <tr>
            <td colspan='3' style="text-align: center">
                <input type="submit" class='btn btn-primary' value='保存' >
            </td>
        </tr>
    </table>
    <?php $this->endWidget(); ?>
<?php endif; ?>

