<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Car $car
 */
use Cake\Routing\Router;
?>

<script type="text/javascript">

$( document ).ready(function() {

        $("#brands").on('change',function() {
        var brand = $(this).val();

        $("#models").find('option').remove();
        if (brand) {
            var dataString = 'marca='+ brand;
            $.ajax({
                dataType:'json',
                type: "POST",
                url: '<?php echo Router::url(["controller" => 'Cars', 'action' => "getModelByBrand"]);?>',
                data: dataString,
                cache: false,
                success: function(data) {
                    //$("#loding1").hide();
                    $.each(data, function(key, value) {              
                        // alert(key);
                        // alert(value);
                        //$('<option>').val('').text('select');
                        $('<option>').val(value['modelo']).text(value['modelo']).appendTo($("#models"));
                    });
                    $("#combustible").find('option').remove();
                        
                        var dataString = 'modelo='+ $("#models").val();
                        $.ajax({
                            dataType:'json',
                            type: "POST",
                            url: '<?php echo Router::url(["controller" => 'Cars', 'action' => "getFuelByModel"]);?>',
                            data: dataString,
                            cache: false,
                            success: function(data) {
                                //$("#loding1").hide();
                                $.each(data, function(key, value) {              
                                    // alert(key);
                                    // alert(value);
                                    //$('<option>').val('').text('select');
                                    $('<option>').val(value['combustible']).text(value['combustible']).appendTo($("#combustible"));
                                });
                            },
                            error: function(data){
                                console.log("Error en la petición: " + data);
                            }
                        });
                },
                error: function(data){
                    console.log("Error en la petición: " + data);
                }
            });
        }
    });


     $("#models").on('change',function() {
        var model = $(this).val();

        $("#combustible").find('option').remove();
        if (model) {
            var dataString = 'modelo='+ model;
            $.ajax({
                dataType:'json',
                type: "POST",
                url: '<?php echo Router::url(["controller" => 'Cars', 'action' => "getFuelByModel"]);?>',
                data: dataString,
                cache: false,
                success: function(data) {
                    //$("#loding1").hide();
                    $.each(data, function(key, value) {              
                        // alert(key);
                        // alert(value);
                        //$('<option>').val('').text('select');
                        $('<option>').val(value['combustible']).text(value['combustible']).appendTo($("#combustible"));
                    });
                },
                error: function(data){
                    console.log("Error en la petición: " + data);
                }
            });
        }
    });

});


</script>

<div class="container">
    <div class="" style=" margin-top: 40px;background-image: url(http://localhost/howfartoreach/img/tires3.png);">
        <?= $this->Form->create($carsUser,['type' => 'file', 'class' => 'ajax_page']) ?>
        <fieldset>
            <legend><?= __('Add new poll') ?><div class="ajax_loading_image"></div></legend>

                <div class="form-group select">
                    <span style="font-weight: bold;">Brand</span>
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-tag"></span></span>
                        <select name="marca" class="form-control" id="brands" onchange="filterBrands()" required>
                            <option value="" selected="selected" required="required">(Please select a car brand)</option>
                            <?php foreach ($brands as $brand) {
                                 ?><option><?= $brand->marca?> </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group select">
                    <span style="font-weight: bold;">Model</span>
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-tags"></span></span>
                        <select name="modelo" class="form-control" id="models">
                            <option value="" selected="selected" required="required">(Please select a car model)</option>
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
                        <?php echo $this->Form->control('combustible', ['label' => false, 'required', 'options' => ['Diesel' => 'Diesel', 'Petrol' => 'Petrol', 'Electric' => 'Electric']]);?>
                    </div>
                </div>    
                <div class="form-group select"">
                    <span style="font-weight: bold;">Driving</span>
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-fire"></span></span>
                        <?php echo $this->Form->control('tipoConduccion', ['label' => false, 'options' => ['Eco' => 'Eco', 'Normal' => 'Normal', 'Sport' => 'Sport'] ]);?>
                    </div>
                </div>   
                            <?php echo $this->Form->hidden('user_id', ['value' => $current_user['id']]); ?>
                            <?php echo $this->Form->hidden('creado', ['value' => date("Y-m-d H:i:s")]); ?>



            </div>
        </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>   

          <a data-toggle="collapse" data-target="#allRegisters" type="button" style="cursor:pointer">How can I calculate my own mileage?</a>
            <div id="allRegisters" class="collapse"> 

                <div id="calculator" class="form-group"><h2>Calculator</h2>
                    <form oninput="Result.value=(parseFloat( (Litres.value)*100 ) / parseFloat(Kms.value)).toFixed(3)">
                        <p>
                            <label>Kms.</label>
                            <input id="Kms" type="text" name="Kms">
                        </p>
                        <p>
                            <label>Litres</label>
                            <input id="Litres" type="text" name="Litres">
                        </p>
                        <p>
                            <label>Result</label>
                            <input id="Result" type="text" name="result">
                        </p>
                    </form>
            <span style="position: ;"><?= $this->Html->link(__('What is this?'), ['controller' => 'Cars', 'action' => 'howto']) ?></span>
                </div>
                
            </div>

    </div>
</div>

<div id="brandLogo" style="visibility:hidden;text-align: center;">
    <img id="logoBrand" src="" alt="Car Brand" width="180">
</div>