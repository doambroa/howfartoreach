<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Car $car
 */
use Cake\Routing\Router;
?>

<div class="container">
    <div class="" style=" margin-top: 40px;background-image: url(http://localhost/howfartoreach/img/tires3.png);">
        <?= $this->Form->create($carsUser,['type' => 'file', 'class' => 'ajax_page']) ?>
        <fieldset>
            <legend><?= __('Edit poll') ?><div class="ajax_loading_image"></div></legend>

                <div class="form-group select">
                    <span style="font-weight: bold;">Brand</span>
                    <div class="input-group">
                        <span class="input-group-addon" style="background-color:orange;border-color:orange"><span class="glyphicon glyphicon-tag"></span></span>
                        <?php echo $this->Form->control('marca', [/*'label' => ['class' => 'col-md-2',*/ 'label' => false, 'placeholder' => $cars->marca, 'disabled' ]);?>
                    </div>
                </div>
                <div class="form-group select">
                    <span style="font-weight: bold;">Model</span>
                    <div class="input-group">
                        <span class="input-group-addon" style="background-color:orange;border-color:orange"><span class="glyphicon glyphicon-tags"></span></span>
                            <?php echo $this->Form->control('modelo', [/*'label' => ['class' => 'col-md-2',*/ 'label' => false, 'placeholder' => $cars->modelo, 'disabled' ]);?>
                    </div>
                </div>
                <div class="container col-md-12" style="text-align: center; padding-top: 40px; padding-bottom: 60px;">    
                    <div class="col-md-3">
                        <span style="font-weight: bold;">City consumption</span>
                        <div class="input-group">
                            <span class="input-group-addon" style="background-color:orange;border-color:orange"><span class="glyphicon glyphicon-home"></span></span>
                                <?php echo $this->Form->control('consumoCiudad', [/*'label' => ['class' => 'col-md-2',*/ 'label' => false, 'placeholder' => 'ie: 6.5' ]);?>
                        </div>
                    </div>
                    <div class="col-md-3 col-md-offset-1"">
                        <span style="font-weight: bold;">Highway consumption</span>
                        <div class="input-group">
                            <span class="input-group-addon" style="background-color:orange;border-color:orange"><span class="glyphicon glyphicon-road"></span></span>
                            <?php echo $this->Form->control('consumoAutopista', ['label' => false,'placeholder' => 'ie: 6.2']);?>
                        </div>
                    </div>
                    <div class="col-md-3 col-md-offset-1">
                        <span style="font-weight: bold;">Combined</span>
                        <div class="input-group">
                            <span class="input-group-addon" style="background-color:orange;border-color:orange"><span class="glyphicon glyphicon-refresh"></span></span>
                            <?php echo $this->Form->control('combinado', ['label' => false,'placeholder' => 'ie: 6.35']);?>
                        </div>
                    </div>
                </div>
                <div class="form-group select">
                    <span style="font-weight: bold;">Type of fuel</span>
                    <div class="input-group">
                        <span class="input-group-addon" style="background-color:orange;border-color:orange"><span class="glyphicon glyphicon-tint"></span></span>
                        <?php echo $this->Form->control('combustible', [/*'label' => ['class' => 'col-md-2',*/ 'label' => false, 'placeholder' => $cars->combustible, 'disabled' ]);?>
                    </div>
                </div>    
                <div class="form-group select"">
                    <span style="font-weight: bold;">Driving</span>
                    <div class="input-group">
                        <span class="input-group-addon" style="background-color:orange;border-color:orange"><span class="glyphicon glyphicon-fire"></span></span>
                        <?php echo $this->Form->control('tipoConduccion', ['label' => false, 'options' => ['Eco' => 'Eco', 'Normal' => 'Normal', 'Sport' => 'Sport'] ]);?>
                    </div>
                </div>   
                            <?php echo $this->Form->hidden('user_id', ['value' => $current_user['id']]); ?>
                            <?php echo $this->Form->hidden('creado', ['value' => date("Y-m-d H:i:s")]); ?>



            </div>
        </fieldset>
        <?= $this->Form->button(__('Confirm changes')   ) ?>
        <?= $this->Form->end() ?>   

    </div>
</div>

<div id="brandLogo" style="visibility:hidden;text-align: center;">
    <img id="logoBrand" src="" alt="Car Brand" width="180">
</div>