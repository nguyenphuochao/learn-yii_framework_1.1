<style>
    .errorMessage {
        color: red;
    }
</style>
<div class="main">
    <h2>Create Product</h2>
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'form-create',
        'enableAjaxValidation' => true,
    )); ?>
    <div class="form-group">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name', array('class' => 'form-control')); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model, 'price'); ?>
        <?php echo $form->textField($model, 'price', array('class' => 'form-control')); ?>
        <?php echo $form->error($model, 'price'); ?>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model, 'qty'); ?>
        <?php echo $form->textField($model, 'qty', array('class' => 'form-control')); ?>
        <?php echo $form->error($model, 'qty'); ?>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model, 'description'); ?>
        <?php echo $form->textArea($model, 'description', array('class' => 'form-control', 'rows' => 9, 'cols' => 50)); ?>
        <?php echo $form->error($model, 'description'); ?>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model, 'category_id'); ?>
        <?php echo $form->dropDownList($model, 'category_id', $categoryList, array('class' => 'form-control')); ?>
        <?php echo $form->error($model, 'category_id'); ?>
    </div>
    <div>
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-primary')); ?>
        <a href="http://localhost/learn-yii_framework_1.1/index.php/productform" class="btn btn-warning">Back</a>
    </div>
    <?php $this->endWidget(); ?>
</div>