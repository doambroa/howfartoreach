<?php
use Cake\Routing\Router;
?>

<div class="container">
    <div class="" style=" margin-top: 40px;background-image: url(../img/tires3.png);">
        <?= $this->Form->create($car,['type' => 'file', 'class' => 'ajax_page']) ?>
        <fieldset>
            <legend><?= __('Add new car in the market') ?><div class="ajax_loading_image"></div></legend>
                <div class="form-group select">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-tags"></span><?php echo $this->Form->control('marca',['label'=>'Brand','required']);?></span>
                    </div>
                </div>
                <div class="form-group select">
                    <span style="font-weight: bold;"></span>
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-tag"></span><?php echo $this->Form->control('modelo',['label'=>'Model','required'=>true]);?></span>
                    </div>
                </div>
                <div class="form-group select" style="padding-top: 20px; padding-bottom: 10px;">
                    <span style="font-weight: bold;">Type of fuel</span>
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-tint"></span></span>
                        <?php echo $this->Form->control('combustible', ['label' => false, 'options' => ['Diesel' => 'Diesel', 'Gasolina' => 'Petrol', 'electrico' => 'Electric']]);?>
                    </div>
                </div>    
            </div>
        </fieldset>
        <?= $this->Form->button(__('Create')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
