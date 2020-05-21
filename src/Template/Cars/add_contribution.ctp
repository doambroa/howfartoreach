<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Car $car
 */
use Cake\Routing\Router;
?>
<nav>
<!--     <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Cars'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul> -->
</nav>
<script type="text/javascript">
        $("#brands").on('change',function() {
        var brand = $(this).val();

        $("#models").find('option').remove();
        if (brand) {
            var dataString = 'id='+ brands;
            $.ajax({
                dataType:'json',
                type: "POST",
                url: '<?php echo Router::url(["controller" => 'Cars', 'action' => "getModelByBrand"]);?>',
                data: dataString,
                cache: false,
                success: function(html) {
                    //$("#loding1").hide();
                    $.each(html, function(key, value) {              
                        alert(key);
                        alert(value);
                        //$('<option>').val('').text('select');
                        $('<option>').val(key).text(value).appendTo($("#models"));
                        //$('<option>').val(value['id']).text(value['title']).appendTo($("#subcategories"));
                    });
                } 
            });
        }
    });
</script>
<div class="container">
    <div class="" style=" margin-top: 40px;background-image: url(../img/tires3.png);">
        <?= $this->Form->create($carsUser,['type' => 'file', 'class' => 'ajax_page']) ?>
        <fieldset>
            <legend><?= __('Add new poll') ?><div class="ajax_loading_image"></div></legend>

                <div class="form-group select">
                    <span style="font-weight: bold;">Brand</span>
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-tags"></span></span>
                        <select name="marca" class="form-control" id="brands" onchange="filterBrands()" required>
                            <option value="" selected="selected">(Please select a car brand)</option>
                            <?php foreach ($brands as $brand) {
                                 ?><option><?= $brand->marca?> </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group select">
                    <span style="font-weight: bold;">Model</span>
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-tag"></span></span>
                        <select name="modelo" class="form-control" id="models">
                            <option value="" selected="selected">(Please select a car model)</option>
                           <?php foreach ($models as $model) {
                                 ?><option><?= $model->modelo?> </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="container col-md-12" style="text-align: center; padding-top: 40px; padding-bottom: 60px;">    
                    <div class="col-md-3">
                        <span style="font-weight: bold;">City consumption</span>
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-home"></span></span>
                                <?php echo $this->Form->control('consumoCiudad', [/*'label' => ['class' => 'col-md-2',*/ 'label' => false, 'placeholder' => 'ie: 6.5' ]);?>
                        </div>
                    </div>
                    <div class="col-md-3 col-md-offset-1"">
                        <span style="font-weight: bold;">Highway consumption</span>
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-road"></span></span>
                            <?php echo $this->Form->control('consumoAutopista', ['label' => false,'placeholder' => 'ie: 6.2']);?>
                        </div>
                    </div>
                    <div class="col-md-3 col-md-offset-1">
                        <span style="font-weight: bold;">Combined</span>
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-refresh"></span></span>
                            <?php echo $this->Form->control('combinado', ['label' => false,'placeholder' => 'ie: 6.35']);?>
                        </div>
                    </div>
                </div>
                <div class="form-group select">
                    <span style="font-weight: bold;">Type of fuel</span>
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-tint"></span></span>
                        <?php echo $this->Form->control('combustible', ['label' => false, 'options' => ['Diesel' => 'Diesel', 'Petrol' => 'Petrol', 'Electric' => 'Electric']]);?>
                    </div>
                </div>    
                <div class="form-group select"">
                    <span style="font-weight: bold;">Driving</span>
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-tint"></span></span>
                        <?php echo $this->Form->control('tipoConduccion', ['label' => false, 'options' => ['Eco' => 'Eco', 'Normal' => 'Normal', 'Deportiva' => 'Sport'] ]);?>
                    </div>
                </div>   
                            <?php echo $this->Form->hidden('user_id', ['value' => $current_user['id']]); ?>
                            <?php echo $this->Form->hidden('creado', ['value' => date("Y-m-d H:i:s")]); ?>



            </div>
        </fieldset>
        <?= $this->Form->button(__('Submit')) ?> METER MEDIDAS DE CONSUMO PARA 95 y 98
        <?= $this->Form->end() ?>
            <span style="position: ;"><a href="howto">How can I calculate my own mileage?</a></span>

    </div>
</div>

<div id="brandLogo" style="visibility:hidden;text-align: center;">
    <img id="logoBrand" src="" alt="Car Brand" width="180">
</div>



<!-- <?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Car $car
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Cars'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="cars form large-9 medium-8 columns content">
    <?= $this->Form->create($car) ?>
    <fieldset>
        <legend><?= __('Add Car') ?></legend>
        <?php
            echo $this->Form->control('marca');
            echo $this->Form->control('modelo');
            echo $this->Form->control('combustible');
            echo $this->Form->control('users._ids', ['options' => $users]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
 -->