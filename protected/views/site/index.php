<div id="wrapper">

    <div id="header">
        <h1>Members Directory</h1>
    </div>

    <div id="map-container">
        <div id="map"></div>
    </div>

    <?php $form = $this->beginWidget('CActiveForm',array('htmlOptions'=>array('id'=>'search_form'))); ?>
        <div id="controls">
            <div id="control-left">

                <div class="control-row">
                    <?php echo $form->labelEx($model,'name'); ?>
                    <?php echo $form->textField($model,'name'); ?>
                </div>

                <div class="control-row">
                    <?php echo $form->labelEx($model,'city'); ?>
                    <?php echo $form->textField($model,'city'); ?>
                </div>

                <div class="control-row">
                    <?php echo $form->labelEx($model,'country'); ?>
                    <?php echo $form->dropDownList($model,'country',array(
                        'United States'=>'United States',
                        'Australia'=>'Australia',
                        'United Kingdom'=>'United Kingdom',
                        'Canada'=>'Canada',
                        'China'=>'China'
                    ),array('empty'=>'Select')); ?>
                </div>

                <div class="control-row">
                    <?php echo $form->labelEx($model,'forum_credentials'); ?>
                    <?php echo $form->dropDownList($model,'forum_credentials',Yii::app()->vanilla->getUserRanks(),array('empty'=>'Select')); ?>
                </div>

            </div>
            <div id="control-right">

                <div class="control-row">
                    <?php echo $form->labelEx($model,'role'); ?>
                    <?php echo $form->dropDownList($model,'role',Yii::app()->vanilla->getRoles(),array('empty'=>'Select')); ?>
                </div>

                <div class="control-row">
                    <?php echo $form->labelEx($model,'area_experience'); ?>
                    <?php echo $form->dropDownList($model,'area_experience',array(
                        'Content Marketing' => 'Content Marketing',
                        'SEO' => 'SEO',
                        'Paid Traffic'=>'Paid Traffic'
                    ),array('empty'=>'Select')); ?>
                </div>

                <div class="control-row">
                    <?php echo $form->labelEx($model,'platform_knowledge'); ?>
                    <?php echo $form->textField($model,'platform_knowledge'); ?>
                </div>

                <div class="control-row">
                    <?php echo $form->labelEx($model,'online'); ?>
                    <?php echo $form->checkBox($model,'online'); ?> <span>Yes</span>
                </div>

            </div>

            <div class="clear"></div>

            <div id="control-buttons">
                <?php echo CHtml::submitButton('Search Members'); ?>
                <?php echo CHtml::resetButton('Clear',array('id'=>'reset_button')); ?>
            </div>

        </div>
    <?php $this->endWidget(); ?>


    <?php $this->widget('zii.widgets.grid.CGridView', $gridParams);?>


    <div id="footer"><?php echo $countDisplayedUsers; ?> of <?php echo $countUsers; ?> members meet criteria</div>
</div>

<script> var usersRawData = '<?=json_encode(User::getLocations())?>'; </script>