   //GOLBALES
   var minC = 4;
   var maxC = 6.5;
   var minH = 3;
   var maxH = 11;
   var minCo = 3.5;
   var maxCo = 8;






    //     function toggleChevron(e) {
    //     $(e.target)
    //             .prev('.panel-heading')
    //             .find("i.indicator")
    //             .toggleClass('fa-caret-down fa-caret-right');
    // }
    // $('#accordion').on('hidden.bs.collapse', toggleChevron);
    // $('#accordion').on('shown.bs.collapse', toggleChevron);



// function myFunction() {
//     var input, filter, ul, li, a, i;
//     input = document.getElementById("myInput");
//     filter = input.value.toUpperCase();
//     ul = document.getElementById("myUL");
//     li = ul.getElementsByTagName("li");

//     for (i = 0; i < li.length; i++) {
//         a = li[i].getElementsByTagName("a")[0];
//         if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
//             li[i].style.display = "";
//         } else {
//             li[i].style.display = "none";
//         }
//     }
// }
$( document ).ready(function() {

//     $("form#filtersForm").submit(function() {
//         filterList();
//     });

//     $("#brands").on('change',function() {
//     var brand = $(this).val();

//     $("#models").find('option').remove();
//     if (brand) {
//         var dataString = 'id='+ brands;
//         console.log("entramos");
//         $.ajax({
//             dataType:'json',
//             type: "POST",
//             url: '<?php echo Router::url(["controller" => "cars", "action" => "getModelByBrand"]);?>',
//             data: dataString,
//             cache: false,
//             success: function(html) {
//             console.log("en ajax");
//                 //$("#loding1").hide();
//                 $.each(html, function(key, value) {              
//                     console.log("");
//                     //alert(key);
//                     //alert(value);
//                     //$('<option>').val('').text('select');
//                     $('<option>').val(key).text(value).appendTo($("#models"));
//                     //$('<option>').val(value['id']).text(value['title']).appendTo($("#subcategories"));
//                 });
//             }
//         });
//     }
// });

    //para poder seleccionar del listado de marcas sin tener que pulsar control
    // multiple select: selectable without Control
$('select[multiple] option').on('mousedown', function(e) {
    var $this = $(this),
        that = this,
        scroll = that.parentElement.scrollTop;

    e.preventDefault();
    $this.prop('selected', !$this.prop('selected'));

    setTimeout(function() {
        that.parentElement.scrollTop = scroll;
    }, 0);

    return false;
    });

});

   
function filterList(){
    // console.log( $(".fuelCheckBoxD").attr('value')/*$("#car_"+i).children("td.combustible").text()*/);
   //  var typeOfFuel = [];
   //  if($(".fuelCheckBoxD").is(":checked")){
   //      typeOfFuel.push($(".fuelCheckBoxD").val());
   //  }
   //  if($(".fuelCheckBoxP").is(":checked")){
   //      typeOfFuel.push($(".fuelCheckBoxP").val());
   //  }
   //  if($(".fuelCheckBoxE").is(":checked")){
   //      typeOfFuel.push($(".fuelCheckBoxE").val());
   //  }

   //  var cityMin = $("#amountC").attr("data-min");
   //  var cityMax = $("#amountC").attr("data-max");
   //  var highwayMin = $("#amountH").attr("data-min");
   //  var highwayMax = $("#amountH").attr("data-max");
   //  var combinedMin = $("#amountCo").attr("data-min");
   //  var combinedMax = $("#amountCo").attr("data-max");

   //  var brands = [];
   //  $.each($("input[name='brand']:checked"), function(){
   //      brands.push($(this).val());
   //  });

   //  var data = { "typeOfFuel": typeOfFuel, "cityMin": cityMin, "cityMax": cityMax, "highwayMin": highwayMin, "highwayMax": highwayMax, "combinedMin": combinedMin, "combinedMax": combinedMax, "brands": brands};

   // // console.log("DATA " +  " typeOfFuel " + typeOfFuel + " cityMin: " + cityMin + " cityMax: " + cityMax + " highwayMin: " + highwayMin + " highwayMax: " + highwayMax + " combinedMin: " + combinedMin + " combinedMax: " + combinedMax + " brands: " + brands );
    
   //  $.ajax({
   //      type: "POST",
   //      url: "/cars/contributions/",
   //      datatype: 'json',
   //      data: {
   //           typeOfFuel: typeOfFuel,
   //           cityMin: cityMin,
   //           cityMax: cityMax,
   //           highwayMin: highwayMin,
   //           highwayMax: highwayMax,
   //           combinedMin: combinedMin,
   //           combinedMax: combinedMax,
   //           brands: brands
   //      },
   //      success: function( data )
   //      {
   //          console.log("peticion realizada con exito" + data);
   //      },
   //      error: function( data )
   //      {
   //        console.log("ERROR, DATOS ENVIADOS: " + this.data);  
   //      }


  // var data = { "typeOfFuel": typeOfFuel, "cityMin": cityMin, "cityMax": cityMax, "highwayMin": highwayMin, "highwayMax": highwayMax, "combinedMin": combinedMin, "combinedMax":combinedMax, "brands": brands};
  //   console.log("DATRA " +  " typeOfFuel " + typeOfFuel + " cityMin: " + cityMin + " cityMax: " + cityMax + " highwayMin: " + highwayMin + " highwayMax: " + highwayMax + " combinedMin: " + combinedMin + " combinedMax: " + combinedMax + " Brands: " + brands );  

  //   $.ajax({
  //       type: "POST",
  //       url: 'http://localhost/howfartoreach/cars/contributions',
  //       datatype: 'json',
  //       data: data,
  //       success: function( data )
  //       {
  //           console.log("peticion realizada con exito");
  //       }
  //   });


    // });
    //ahora sería llamar con estos 3 datos a la query
}

/************ Filtros viejos DEPRECATED***************/ 

function checkCheckboxes(i){
    // if( ($(".fuelCheckBoxD").is(":checked")) && ($(".fuelCheckBoxP").is(":checked")) && ($(".fuelCheckBoxE").is(":checked")) || !($(".fuelCheckBoxD").is(":checked")) && !($(".fuelCheckBoxP").is(":checked")) && !($(".fuelCheckBoxE").is(":checked"))) {
    //     $("#car_"+i).show();
    // }else{
    //     if( ($(".fuelCheckBoxD").is(":checked")) && ($(".fuelCheckBoxP").is(":checked"))){
    //         if ( ($("#car_"+i).children("td.combustible").text() == "Diesel") || ($("#car_"+i).children("td.combustible").text() == "Gasolina") ){
    //             $("#car_"+i).show();
    //         }
    //     }
    //     if( ($(".fuelCheckBoxD").is(":checked")) && ($(".fuelCheckBoxE").is(":checked"))){
    //         if ( ($("#car_"+i).children("td.combustible").text() == "Diesel") || ($("#car_"+i).children("td.combustible").text() == "electrico") ){
    //             $("#car_"+i).show();
    //         }
    //     }
    //     if( ($(".fuelCheckBoxP").is(":checked")) && ($(".fuelCheckBoxE").is(":checked"))){
    //         if ( ($("#car_"+i).children("td.combustible").text() == "Gasolina") || ($("#car_"+i).children("td.combustible").text() == "electrico") ){
    //             $("#car_"+i).show();
    //         }
    //     }
    // }
    // if($(".fuelCheckBoxD").is(":checked")) {
    //     if ( ($("#car_"+i).children("td.combustible").text() == "Diesel") ){ 
    //         $("#car_"+i).show(); 
    //     }
    // }
    // if($(".fuelCheckBoxP").is(":checked")) {
    //     if ( ($("#car_"+i).children("td.combustible").text() == "Gasolina") ){ 
    //         $("#car_"+i).show();
    //     }
    // }
    // if($(".fuelCheckBoxE").is(":checked")) {
    //     if ( ($("#car_"+i).children("td.combustible").text() == "electrico") ){ 
    //         $("#car_"+i).show();
    //     }
    // }
}

function checkCheckboxesInverted(i){
    // if( ($(".fuelCheckBoxD").is(":checked")) && ($(".fuelCheckBoxP").is(":checked"))){
    //     if ( ($("#car_"+i).children("td.combustible").text() == "electrico") ){
    //         $("#car_"+i).hide();
    //     }
    // }
    // if( ($(".fuelCheckBoxD").is(":checked")) && ($(".fuelCheckBoxE").is(":checked"))){
    //     if ( ($("#car_"+i).children("td.combustible").text() == "Gasolina") ){
    //         $("#car_"+i).hide();
    //     }
    // }
    // if( ($(".fuelCheckBoxP").is(":checked")) && ($(".fuelCheckBoxE").is(":checked"))){
    //     if ( ($("#car_"+i).children("td.combustible").text() == "Diesel") ){
    //         $("#car_"+i).hide();
    //     }
    // }
    // if($(".fuelCheckBoxD").is(":checked") && !($(".fuelCheckBoxP").is(":checked")) && !($(".fuelCheckBoxE").is(":checked")) ) {
    //     if ( ($("#car_"+i).children("td.combustible").text() != "Diesel") ){ 
    //         $("#car_"+i).hide(); 
    //     }
    // }
    // if($(".fuelCheckBoxP").is(":checked") && !($(".fuelCheckBoxD").is(":checked")) && !($(".fuelCheckBoxE").is(":checked")) ) {
    //     if ( ($("#car_"+i).children("td.combustible").text() != "Gasolina") ){ 
    //         $("#car_"+i).hide();
    //     }
    // }
    // if($(".fuelCheckBoxE").is(":checked") && !($(".fuelCheckBoxP").is(":checked")) && !($(".fuelCheckBoxD").is(":checked")) ) {
    //     if ( ($("#car_"+i).children("td.combustible").text() != "electrico") ){ 
    //         $("#car_"+i).hide();
    //     }
    // }
}



function checkFuel(){
        // console.log( $(".fuelCheckBoxD").attr('value')/*$("#car_"+i).children("td.combustible").text()*/);
        // for(var i = 0; i< 600; ++i){
        //     $("#car_"+i).hide();
        //     checkCheckboxes(i);
        // }
    }

    function checkBrand(){
        // $selectedFilters = $("input:checkbox[name='brand']").filter(':checked');

        // $categoryContent = $('.carBrands');

        // $categoryContent.hide(); 
        // $selectedFilters.each(function (i, el) {
        //     $categoryContent.filter(':contains(' + el.value + ')').show();
        // });

        // for(var i = 0; i< 600; ++i){
        //     checkCheckboxesInverted(i);
        // }
    }

    $( function() {
        $( "#slider-rangeC" ).slider({
          range: true,
          min: 0,
          max: 30,
          values: [  $( "#amountC" ).attr("data-min"),  $( "#amountC" ).attr("data-max")],
          step: 0.1,

          slide: function( event, ui ) {
            $( "#amountC" ).val( ui.values[ 0 ]+ " - " + ui.values[ 1 ] );
            minC = ui.values[ 0 ];
            maxC = ui.values[ 1 ];

            $( "#amountC" ).attr("data-min", minC);
            $( "#amountC" ).attr("data-max", maxC);
            // for(var i = 0; i< 600; ++i){
            //     if ( ($("#car_"+i).children("td.consumoCiudad").text() >= minC) && ($("#car_"+i).children("td.consumoCiudad").text() <= maxC) && ($("#car_"+i).children("td.consumoAutopista").text() >= minH) && ($("#car_"+i).children("td.consumoAutopista").text() <= maxH) && (($("#car_"+i).children("td.consumoCombinado").text() >= minCo) && ($("#car_"+i).children("td.consumoCombinado").text() <= maxCo)) ){ 
            //         checkCheckboxes(i);
            //     }else{
            //         $("#car_"+i).hide();
            //     }
            // }
        }
    });
        $( "#amountC" ).val($( "#slider-rangeC" ).slider( "values", 0 )+ " - " + $( "#slider-rangeC" ).slider( "values", 1 )  );
    });
    $( function() {
        $( "#slider-rangeH" ).slider({
          range: true,
          min: 0,
          max: 30,
          values: [ $( "#amountH" ).attr("data-min"),  $( "#amountH" ).attr("data-max") ],
          step: 0.1,
          slide: function( event, ui ) {
            $( "#amountH" ).val( ui.values[ 0 ]+ " - " + ui.values[ 1 ] );
            minH = ui.values[ 0 ];
            maxH = ui.values[ 1 ];

            $( "#amountH" ).attr("data-min", minH);
            $( "#amountH" ).attr("data-max", maxH);
                    //Si el consumo en autopista está entre el mínimo y el máximo lo enseño, sino lo oculto
                    // for(var i = 0; i< 600; ++i){
                    //     if ( ($("#car_"+i).children("td.consumoCiudad").text() >= minC) && ($("#car_"+i).children("td.consumoCiudad").text() <= maxC) && ($("#car_"+i).children("td.consumoAutopista").text() >= minH) && ($("#car_"+i).children("td.consumoAutopista").text() <= maxH) && (($("#car_"+i).children("td.consumoCombinado").text() >= minCo) && ($("#car_"+i).children("td.consumoCombinado").text() <= maxCo)) ){ 
                    //         checkCheckboxes(i);
                    //     }else{
                    //         $("#car_"+i).hide();
                    //     }
                    // }
                }
            });
        $( "#amountH" ).val($( "#slider-rangeH" ).slider( "values", 0 )+ " - " + $( "#slider-rangeH" ).slider( "values", 1 ) );
    });
    $( function() {
        $( "#slider-rangeCo" ).slider({
          range: true,
          min: 0,
          max: 30,
          values: [  $( "#amountCo" ).attr("data-min"),  $( "#amountCo" ).attr("data-max") ],
          step: 0.1,
          slide: function( event, ui ) {
            $( "#amountCo" ).val( ui.values[ 0 ] + " - " + ui.values[ 1 ] );
            minCo = ui.values[ 0 ];
            maxCo = ui.values[ 1 ];
            
            $( "#amountCo" ).attr("data-min", minCo);
            $( "#amountCo" ).attr("data-max", maxCo);

            // for(var i = 0; i< 600; ++i){
            //         //Si el consumo Combinado está entre el mínimo y el máximo lo enseño, sino lo oculto
            //         if ( ($("#car_"+i).children("td.consumoCiudad").text() >= minC) && ($("#car_"+i).children("td.consumoCiudad").text() <= maxC) && ($("#car_"+i).children("td.consumoAutopista").text() >= minH) && ($("#car_"+i).children("td.consumoAutopista").text() <= maxH) && (($("#car_"+i).children("td.consumoCombinado").text() >= minCo) && ($("#car_"+i).children("td.consumoCombinado").text() <= maxCo)) ){ 
            //             // console.log( $("#car_"+i).children("td.consumoCombinado").text() );
            //             checkCheckboxes(i);
            //         }else{
            //             $("#car_"+i).hide();
            //         }
            //     }
            }
        });
        $( "#amountCo" ).val($( "#slider-rangeCo" ).slider( "values", 0 ) + " - " + $( "#slider-rangeCo" ).slider( "values", 1 )  );

    });


    //DEPRECATED, sólo se aprovecha la pate de los logos
    function filterBrands(){

        var brand = document.getElementById("brands").value;

        $('#models option:gt(0)').remove();
        
        if(brand == "Kia"){

            var newOptions = {
                "Cerato LX":"Cerato LX",
                "Carens":"Carens",
                "Picanto":"Picanto",
                "Sportage":"Sportage",
                "Optima":"Optima",
                "Ceed Sportswagon":"Ceed Sportswagon",
                "Pro_ceed":"Pro_ceed",
                "Soul":"Soul",
                "Soul EV":"Soul EV",
                "Stonic":"Stonic",
                "Optima PHEV":"Optima PHEV",
                "Stinger":"Stinger",
                "Rio":"Rio",
                "Venga":"Venga",
                "Cee'd":"Cee'd",
                "Niro":"Niro",
                "Sorento":"Sorento",
                "Optima Hibrido Enchufable":"Optima Hibrido Enchufable"
            };
            $("#logoBrand").attr("src","http://www.carlogos.org/logo/Kia-logo.png");
        }

            if(brand == "Alfa Romeo"){

                var newOptions = {
                    "MiTo":"MiTo",
                    "Stelvio":"Stelvio",
                    "Giulia":"Giulia",
                    "Giulietta":"Giulietta"
                };
                $("#logoBrand").attr("src","http://www.carlogos.org/logo/Alfa-Romeo-logo-2015-640x550.jpg");
            }
            if(brand == "Aston Martin"){

                var newOptions = {

                    "Rapide":"Rapide",
                    "DB9":"DB9",
                    "Vantage V8":"Vantage V8",
                    "Vanquish":"Vanquish",
                    "Rapide":"Rapide",
                    "Vantage V12":"Vantage V12"
                };
                 $("#logoBrand").attr("src","http://www.carlogos.org/logo/Aston-Martin-logo-2003-640x286.jpg");
            }
            if(brand == "Audi"){

                var newOptions = {

                    "A1":"A1",
                    "A3":"A3",
                    "A4":"A4",
                    "A5":"A5",
                    "A6":"A6",
                    "A7":"A7",
                    "A8":"A8",
                    "TT":"TT",
                    "Q3":"Q3",
                    "Q5":"Q5",
                    "Q7":"Q7",
                    "S1":"S1",
                    "S3":"S3",
                    "S4":"S4",
                    "S5":"S5",
                    "S6":"S6",
                    "S7":"S7",
                    "S6":"S6",
                    "S8":"S8",
                    "RS":"RS",
                    "R8":"R8",
                    "RS3":"RS3",
                    "RS4":"RS4",
                    "RS5":"RS5",
                    "RS6":"RS6",
                    "RS7":"RS7",
                    "SQ5":"SQ5",
                    "SQ7":"SQ7",
                    "TTs":"TTs"
                };
                $("#logoBrand").attr("src","http://www.carlogos.org/logo/Audi-logo.png");
            }
            if(brand == "BMW"){

                var newOptions = {

                    "Serie 2":"Serie 2",
                    "Serie 4":"Serie 4",
                    "Serie 7":"Serie 7",
                    "Z4":"Z4",
                    "X2":"X2",
                    "X4":"X4",
                    "X6":"X6",
                    "Serie 2 Active Tourer":"Serie 2 Active Tourer",
                    "Serie 1":"Serie 1",
                    "Serie 3":"Serie 3",
                    "Serie 5":"Serie 5",
                    "I3":"I3",
                    "X1":"X1",
                    "X3":"X3",
                    "X5":"X5",
                    "Serie 2 Grand Tourer":"Serie 2 Grand Tourer"
                };
                $("#logoBrand").attr("src","http://www.carlogos.org/logo/BMW-logo.png");
            }
            if(brand == "Bugatti"){

                var newOptions = {

                    "Veyron":"Veyron",
                    "Chiron":"Chiron"
                };
                $("#logoBrand").attr("src","http://www.carlogos.org/logo/Bugatti-logo-640x327.jpg");
            }
            if(brand == "BYD"){

                var newOptions = {

                    "E6":"E6"
                };
                $("#logoBrand").attr("src","http://www.carlogos.org/logo/BYD-logo-2007-640x396.jpg");
            }
            if(brand == "Cadillac"){

                var newOptions = {

                    "Escalade":"Escalade"
                };
                $("#logoBrand").attr("src","http://www.carlogos.org/logo/Cadillac-emblem-2009-640x537.jpg");
            }
            if(brand == "Chevrolet"){

                var newOptions = {

                    "Matiz":"Matiz",
                    "Captiva":"Captiva",
                    "Corvette":"Corvette",
                    "Cruze":"Cruze",
                    "Malibu":"Malibu",
                    "Orlando":"Orlando",
                    "Trax":"Trax",
                    "Volt":"Volt"

                };
                $("#logoBrand").attr("src","http://www.carlogos.org/logo/Chevrolet-logo.png");
            }
            if(brand == "Citroën"){

                var newOptions = {

                    "C2":"C2",
                    "C4":"C4",
                    "C3 Picasso":"C3 Picasso",
                    "C4 Grand Picasso":"C4 Grand Picasso",
                    "Nemo":"Nemo",
                    "C-Elysée":"C-Elysée",
                    "SpaceTourer":"SpaceTourer",
                    "C3 Aircross":"C3 Aircross",
                    "C1":"C1",
                    "C3":"C3",
                    "C5":"C5",
                    "C4 Picasso":"C4 Picasso",
                    "C4 Cactus":"C4 Cactus",
                    "Berlingo":"Berlingo",
                    "C-Zero":"C-Zero",
                    "E-Mehari":"E-Mehari"
                };
                $("#logoBrand").attr("src","http://www.carlogos.org/logo/Citroen-logo-2009-640x550.jpg");
            }
            if(brand == "Dacia"){

                var newOptions = {

                    "Lodgy":"Lodgy",
                    "Duster":"Duster",
                    "Logan":"Logan",
                    "Sandero":"Sandero",
                    "Dokker":"Dokker"
                };
                $("#logoBrand").attr("src","http://www.carlogos.org/logo/Dacia-logo-2008-640x550.jpg");
            }
            if(brand == "Dodge"){

                var newOptions = {

                    "":""
                };
                $("#logoBrand").attr("src","http://www.carlogos.org/logo/Dodge-logo-2011-640x90.jpg");
            }
            if(brand == "DS"){

                var newOptions = {

                    "DS 3":"DS 3",
                    "DS 5":"DS 5",
                    "DS 4 Crossback":"DS 4 Crossback",
                    "DS 7 Crossback":"DS 7 Crossback",
                    "DS 4":"DS 4"
                };
                $("#logoBrand").attr("src","http://www.carlogos.org/logo/DS-logo-2009-640x486.jpg");
            }
            if(brand == "Ferrari"){

                var newOptions = {

                    "488":"488",
                    "GTC4":"GTC4",
                    "California":"California",
                    "F12":"F12",
                    "Portofino":"Portofino",
                    "812":"812",
                    "458":"458",
                    "F12":"F12",
                    "F40":"F40",
                    "F50":"F50"
                };
                $("#logoBrand").attr("src","http://www.carlogos.org/logo/Ferrari-logo-640x550.jpg");
            }
            if(brand == "Fiat"){

                var newOptions = {

                    "Punto":"Punto",
                    "500":"500",
                    "500X":"500X",
                    "500C":"500C",
                    "Florino":"Florino",
                    "124 Spider":"124 Spider",
                    "Dobló":"Dobló",
                    "Panda":"Panda",
                    "500L":"500L",
                    "Qubo":"Qubo",
                    "Bravo":"Bravo",
                    "Tipo":"Tipo"
                };
                $("#logoBrand").attr("src","http://www.carlogos.org/logo/Fiat-logo-2006-640x550.jpg");
            }
            if(brand == "Ford"){

                var newOptions = {
                    "Focus C-Max":"Focus C-Max",
                    "Mondeo":"Mondeo",
                    "B-Max":"B-Max",
                    "Kuga":"Kuga",
                    "Grand Toruneo Connect":"Grand Toruneo Connect",
                    "Ecosport":"Ecosport",
                    "Mustang":"Mustang",
                    "Focus":"Focus",
                    "Edge":"Edge",
                    "Fiesta":"Fiesta",
                    "S-Max":"S-Max",
                    "Grand C-Max":"Grand C-Max",
                    "Ka":"Ka",
                    "Galaxy":"Galaxy",
                    "Tourneo":"Tourneo"

                };
                $("#logoBrand").attr("src","http://www.carlogos.org/logo/Ford-logo.png");
            }
            if(brand == "Honda"){

                var newOptions = {
                    "Accord":"Accord",
                    "Civic":"Civic",
                    "HR-V":"HR-V",
                    "Jazz":"Jazz",
                    "CR-V":"CR-V"             
                };
                $("#logoBrand").attr("src","http://www.carlogos.org/logo/Honda-logo.png");
            }
            if(brand == "Hummer"){

                var newOptions = {
                    "":""

                };
                $("#logoBrand").attr("src","http://www.carlogos.org/logo/Hummer-logo-2000x205.png");
            }
            if(brand == "Porsche"){

                var newOptions = {
                    "":""

                };
                $("#logoBrand").attr("src","http://www.carlogos.org/logo/Porsche-logo-2008-640x329.jpg");
            }
            if(brand == "Hyundai"){

                var newOptions = {

                    "Kona":"Kona",
                    "Ix35":"Ix35",
                    "I10":"I10",
                    "I40":"I40",
                    "Veloster":"Veloster",
                    "Elantra":"Elantra",
                    "Genesis":"Genesis",
                    "Tucson":"Tucson",
                    "Ioniq":"Ioniq",
                    "I20":"I20",
                    "Ix20":"Ix20",
                    "Grand Santa Fe":"Grand Santa Fe",
                    "Santa Fe":"Santa Fe",
                    "Accent":"Accent",
                    "I30":"I30",
                    "H1-Travel":"H1-Travel",
                    "I20 Active":"I20 Active"
                };
                $("#logoBrand").attr("src","http://www.carlogos.org/logo/Hyundai-logo.png");
            }
            if(brand == "Infiniti"){

                var newOptions = {

                    "30":"30"
                };
                $("#logoBrand").attr("src","http://www.carlogos.org/logo/Infiniti-logo-1989-640x308.jpg");
            }
            if(brand == "Isuzu"){

                var newOptions = {

                    "D-Max":"D-Max"
                };
                $("#logoBrand").attr("src","http://www.carlogos.org/logo/Isuzu-logo-1991-640x106.jpg");
            }
            if(brand == "Jaguar"){

                var newOptions = {

                    "Serie XK":"Serie XK",
                    "XJ":"XJ",
                    "XF":"XF",
                    "XE":"XE",
                    "F-Peace":"F-Peace",
                    "F-Type":"F-Type",
                    "E-Peace":"E-Peace"
                };
                $("#logoBrand").attr("src","http://www.carlogos.org/logo/Jaguar-logo-2012-640x287.jpg");
            }
            if(brand == "Jeep"){

                var newOptions = {

                    "Cherokee":"Cherokee",
                    "Grand Cherokee":"Grand Cherokee",
                    "Renegade":"Renegade",
                    "Wrangler Unlimited":"Wrangler Unlimited",
                    "Wrangler":"Wrangler",
                    "Compass":"Compass"
                };
                $("#logoBrand").attr("src","http://www.carlogos.org/logo/Jeep-logo-green-640x258.jpg");
            }
            if(brand == "KTM"){

                var newOptions = {

                    "X-Bow":"X-Bow"
                };
                $("#logoBrand").attr("src","http://www.carlogos.org/logo/KTM-logo-640x200.jpg");
            }
            if(brand == "Lada"){

                var newOptions = {

                    "Priora":"Priora",
                    "4x4":"4x4"
                };
                $("#logoBrand").attr("src","http://www.carlogos.org/logo/Lada-logo-silver-640x248.jpg");
            }
            if(brand == "Lamborghini"){

                var newOptions = {

                    "":""
                };
                $("#logoBrand").attr("src","http://www.carlogos.org/logo/Lamborghini-logo.png");
            }
            if(brand == "Lancia"){

                var newOptions = {

                    "Ypsilon":"Ypsilon",
                    "Delta":"Delta",
                    "Voyager":"Voyager",
                    "Thema":"Thema",
                    "option":"option"
                };
                $("#logoBrand").attr("src","http://www.carlogos.org/logo/Lancia-logo-2007-640x550.jpg");
            }
            if(brand == "Land Rover"){

                var newOptions = {

                    "Range Rover Velar":"Range Rover Velar"
                };
                        $("#logoBrand").attr("src","http://www.carlogos.org/logo/Land-Rover-logo-2011-640x335.jpg");
            }
            if(brand == "Lexus"){

                var newOptions = {

                    "GS":"GS",
                    "CT":"CT",
                    "NX":"NX",
                    "LS":"LS",
                    "RX":"RX",
                    "IS":"IS",
                    "RC":"RC",
                    "LC":"LC"
                };
                $("#logoBrand").attr("src","http://www.carlogos.org/logo/Lexus-logo.png");
            }
            if(brand == "Lotus"){

                var newOptions = {

                    "Elise":"Elise"
                };
                $("#logoBrand").attr("src","http://www.carlogos.org/logo/Lotus-logo-640x550.jpg");
            }
            if(brand == "Maserati"){

                var newOptions = {

                    "":""
                };
                $("#logoBrand").attr("src","http://www.carlogos.org/logo/Maserati-logo-black-640x280.jpg");
            }
            if(brand == "Mazda"){

                var newOptions = {

                    "MX-5":"MX-5",
                    "Mazda2":"Mazda2",
                    "Mazda3":"Mazda3",
                    "Mazda5":"Mazda5",
                    "Mazda6":"Mazda6",
                    "CX-3":"CX-3",
                    "CX-5":"CX-5",
                    "CX-9":"CX-9"
                };
                $("#logoBrand").attr("src","http://www.carlogos.org/logo/Mazda-logo.png");
            }
            if(brand == "Mercedes"){

                var newOptions = {

                    "Clase SL":"Clase SL",
                    "Clase V":"Clase V",
                    "Clase M":"Clase M",
                    "Clase E":"Clase E",
                    "Clase S":"Clase S",
                    "SLS AMG":"SLS AMG",
                    "Clase A":"Clase A",
                    "Clase CLS":"Clase CLS",
                    "Clase GLA":"Clase GLA",
                    "Vito":"Vito",
                    "Clase GLE":"Clase GLE",
                    "Citan":"Citan",
                    "Clase SLC":"Clase SLC",
                    "Mercedes-AMG GT":"Mercedes-AMG GT",
                    "Clase SLK":"Clase SLK",
                    "Clase C":"Clase C",
                    "Clase G":"Clase G",
                    "Clase CL":"Clase CL",
                    "Clase GLK":"Clase GLK",
                    "Clase B":"Clase B",
                    "Clase GL":"Clase GL",
                    "Clase CLA":"Clase CLA",
                    "Clase GLE Coupé":"Clase GLE Coupé",
                    "Clase GLC":"Clase GLC",
                    "Clase GLS":"Clase GLS",
                    "GLC Coupé":"GLC Coupé"
                };
                $("#logoBrand").attr("src","http://www.carlogos.org/logo/Mercedes-Benz-logo.png");
            }
            if(brand == "Mini"){

                var newOptions = {

                    "Contryman":"Contryman",
                    "Clubman":"Clubman",
                    "Mini":"Mini",
                    "Paceman":"Paceman"
                };
                $("#logoBrand").attr("src","http://www.carlogos.org/logo/Mini-logo-2001-640x270.jpg");
            }
            if(brand == "Mitsubishi"){

                var newOptions = {

                    "Pajero":"Pajero",
                    "ASX":"ASX",
                    "Space Star":"Space Star",
                    "Eclipse Cross":"Eclipse Cross",
                    "Montero":"Montero",
                    "I-MiEV":"I-MiEV",
                    "Outlander":"Outlander",
                    "Lancer":"Lancer",
                    "Evo":"Evo",
                    "L200":"L200"
                };
                $("#logoBrand").attr("src","http://www.carlogos.org/logo/Mitsubishi-logo-640x550.jpg");
            }
            if(brand == "Morgan"){

                var newOptions = {

                    "4/4":"4/4"
                };
                $("#logoBrand").attr("src","http://www.carlogos.org/logo/Morgan-logo-640x178.jpg");
            }
            if(brand == "Nissan"){

                var newOptions = {

                    "QASHQAI":"QASHQAI",
                    "NOTE":"NOTE",
                    "Pathfinder":"Pathfinder",
                    "JUKE":"JUKE",
                    "370Z":"370Z",
                    "NV200":"NV200",
                    "PULSAR":"PULSAR",
                    "NV200 Evalia":"NV200 Evalia",
                    "X-TRAIL":"X-TRAIL",
                    "LEAF":"LEAF",
                    "EVALIA":"EVALIA",
                    "Micra":"Micra",
                    "350Z":"350Z",
                    "Skyline":"Skyline",
                    "GT-R":"GT-R",
                    "Murano":"Murano",
                    "E-NV200 Evalia":"E-NV200 Evalia"
                };
                $("#logoBrand").attr("src","http://www.carlogos.org/logo/Nissan-logo.png");
            }
            if(brand == "Opel"){

                var newOptions = {

                    "Mokka X":"Mokka X",
                    "Grandland X":"Grandland X",
                    "Astra":"Astra",
                    "Zafira":"Zafira",
                    "Combo":"Combo",
                    "Mokka":"Mokka",
                    "Cabrio":"Cabrio",
                    "Karl":"Karl",
                    "Crossland X":"Crossland X",
                    "Vivaro":"Vivaro",
                    "Corsa":"Corsa",
                    "Meriva":"Meriva",
                    "Insignia":"Insignia",
                    "Ampera":"Ampera",
                    "Adam":"Adam",
                    "Karl":"Karl",
                    "Antara":"Antara",
                    "GTC":"GTC"
                };
                $("#logoBrand").attr("src","http://www.carlogos.org/logo/Opel-logo-2009-640x496.jpg");
            }
            if(brand == "Pagani"){

                var newOptions = {

                    "Zonda Uno":"Zonda Uno"
                };
                $("#logoBrand").attr("src","http://www.carlogos.org/logo/Pagani-logo-1992-640x343.jpg");
            }
            if(brand == "Peugeot"){

                var newOptions = {

                    "308":"308",
                    "206":"206",
                    "208":"208",
                    "3008":"3008",
                    "5008":"5008",
                    "306":"306",
                    "Ion":"Ion",
                    "Partner":"Partner",
                    "Tepee":"Tepee",
                    "108":"108",
                    "205":"205",
                    "207":"207",
                    "2008":"2008",
                    "4008":"4008",
                    "305":"305",
                    "RCZ":"RCZ",
                    "Traveller":"Traveller",
                    "Bipper":"Bipper"
                };
                $("#logoBrand").attr("src","http://www.carlogos.org/logo/Peugeot-logo.png");
            }
            if(brand == "Pontiac"){

                var newOptions = {

                    "":""
                };
                $("#logoBrand").attr("src","http://www.carlogos.org/logo/Pontiac-logo-640x440.jpg");
            }
            if(brand == "Prosche"){

                var newOptions = {

                    "":""
                };
                $("#logoBrand").attr("src","jpg");
            }
            if(brand == "Renault"){

                var newOptions = {

                    "Clio":"Clio",
                    "Espace":"Espace",
                    "Laguna":"Laguna",
                    "Kadjar":"Kadjar",
                    "Mégane":"Mégane",
                    "Grand Scénic":"Grand Scénic",
                    "Scénic":"Scénic",
                    "Kangoo Combi":"Kangoo Combi",
                    "Grand Kangoo Combi":"Grand Kangoo Combi",
                    "ZOE":"ZOE",
                    "Twingo":"Twingo",
                    "Fluence":"Fluence",
                    "Latitude":"Latitude",
                    "Captur":"Captur",
                    "Talisman":"Talisman",
                    "Koleos":"Koleos"
                };
                $("#logoBrand").attr("src","http://www.carlogos.org/logo/Renault-logo.png");
            }
            if(brand == "Rolls-Royce"){

                var newOptions = {

                    "Phantom":"Phantom"
                };
                $("#logoBrand").attr("src","http://www.carlogos.org/logo/Rolls-Royce-logo-640x550.jpg");
            }
            if(brand == "SAAB"){

                var newOptions = {

                    "9-4X Base":"9-4X Base",
                    "9-4X Aero":"9-4X Aero",
                    "9-4X Premium":"9-4X Premium"
                };
                $("#logoBrand").attr("src","http://www.carlogos.org/logo/Saab-logo-2013-640x143.jpg");
            }
            if(brand == "Seat"){

                var newOptions = {

                    "Ibiza":"Ibiza",
                    "León":"León",
                    "Altea":"Altea",
                    "Altea XL":"Altea XL",
                    "Nuevo Ibiza":"Nuevo Ibiza",
                    "Nuevo León":"Nuevo León",
                    "Toledo":"Toledo",
                    "Ateca":"Ateca",
                    "León FR":"León FR",
                    "Alhambra":"Alhambra",
                    "Mii":"Mii",
                    "Arona":"Arona"
                };
                $("#logoBrand").attr("src","http://www.carlogos.org/logo/SEAT-logo-2012-640x508.jpg");
            }
            if(brand == "Skoda"){

                var newOptions = {
                    "Fabia":"Fabia",
                    "Yeti":"Yeti",
                    "Citigo":"Citigo",
                    "Spaceback":"Spaceback",
                    "Kodiaq":"Kodiaq",
                    "Octavia":"Octavia",
                    "Roomster":"Roomster",
                    "Superb":"Superb",
                    "Rapid":"Rapid",
                    "Scout":"Scout",
                    "Karoq":"Karoq"
                };
                $("#logoBrand").attr("src","http://www.carlogos.org/logo/Skoda-logo-2016-640x550.jpg");
            }
            if(brand == "Smart"){

                var newOptions = {
                    "Fortwo":"Fortwo",
                    "Forfour":"Forfour"

                };
                $("#logoBrand").attr("src","http://www.carlogos.org/logo/Smart-logo-1994-640x550.jpg");

            }
            if(brand == "Ssangyong"){

                var newOptions = {

                    "Rexton":"Rexton",
                    "Korando":"Korando",
                    "Tivoli":"Tivoli",
                    "Rodius":"Rodius",
                    "Actyion Sports Pick Up":"Actyion Sports Pick Up",
                    "XLV":"XLV"
                };
                $("#logoBrand").attr("src","http://www.carlogos.org/logo/SsangYong-logo-640x422.jpg");
            }
            if(brand == "Subaru"){

                var newOptions = {

                    "Imprezza":"Imprezza",
                    "XV":"XV",
                    "BRZ":"BRZ",
                    "Levorg":"Levorg",
                    "Forester":"Forester",
                    "Outback":"Outback",
                    "WRX STI":"WRX STI",
                };
                $("#logoBrand").attr("src","http://www.carlogos.org/logo/Subaru-logo.png");
            }
            if(brand == "Suzuki"){

                var newOptions = {

                    "SX4 S-Cross":"SX4 S-Cross",
                    "Grand Vitara":"Grand Vitara",
                    "Kizashi":"Kizashi",
                    "Baleno":"Baleno",
                    "Swift":"Swift",
                    "SX4":"SX4",
                    "Celerio":"Celerio",
                    "Vitara":"Vitara",
                    "Ignis":"Ignis"
                };
                $("#logoBrand").attr("src","http://www.carlogos.org/logo/Suzuki-logo.png");
            }
            if(brand == "Tata"){

                var newOptions = {

                    "Vista":"Vista",
                    "Xenon":"Xenon",
                    "Aria":"Aria"
                };
                $("#logoBrand").attr("src","http://www.carlogos.org/logo/Tata-logo.png");
            }
            if(brand == "Tesla"){

                var newOptions = {

                    "Roadster":"Roadster",
                    "Model 3":"Model 3",
                    "Model S":"Model S",
                    "Model X":"Model X",
                    "Land Cruiser":"Land Cruiser",
                };
                $("#logoBrand").attr("src","http://www.carlogos.org/logo/Tesla-logo-2003-640x550.jpg");

            }
            if(brand == "Toyota"){

                var newOptions = {

                    "Verso":"Verso",
                    "Prius+":"Prius+",
                    "Prius":"Prius",
                    "Aygo":"Aygo",
                    "C-HR":"C-HR",
                    "Land Cruiser 200":"Land Cruiser 200",
                    "Avensis":"Avensis",
                    "Yaris":"Yaris",
                    "Auris":"Auris",
                    "GT86":"GT86",
                    "Rav4":"Rav4",
                    "Hilux":"Hilux"
                };
                $("#logoBrand").attr("src","http://www.carlogos.org/logo/Toyota-logo-1989-640x524.jpg");
            }
            if(brand == "Volkswagen"){

                var newOptions = {

                    "Jetta":"Jetta",
                    "Touran":"Touran",
                    "Beetle":"Beetle",
                    "Tiguan":"Tiguan",
                    "Caravelle":"Caravelle",
                    "CC":"CC",
                    "Amarok":"Amarok",
                    "Transporter":"Transporter",
                    "Passat":"Passat",
                    "Arteon":"Arteon",
                    "Tiguan Allspace":"Tiguan Allspace",
                    "Golf":"Golf",
                    "Polo":"Polo",
                    "Phaeton":"Phaeton",
                    "Touareg":"Touareg",
                    "Sharan":"Sharan",
                    "Multivan":"Multivan",
                    "Up!":"Up!",
                    "Golf Sportsvan":"Golf Sportsvan",
                    "Caddy":"Caddy",
                    "Scirocco":"Scirocco",
                    "Eos":"Eos",
                    "T-Roc":"T-Roc"
                };
                $("#logoBrand").attr("src","http://www.carlogos.org/logo/Volkswagen-logo.png");
            }
            if(brand == "Volvo"){

                var newOptions = {

                    "S80":"S80",
                    "S60":"S60",
                    "XC60":"XC60",
                    "V40 Cross Country":"V40 Cross Country",
                    "S60 Cross Country":"S60 Cross Country",
                    "V90":"V90",
                    "XC40":"XC40",
                    "V70":"V70",
                    "XC70":"XC70",
                    "XC90":"XC90",
                    "V40":"V40",
                    "V60 Cross Country":"V60 Cross Country",
                    "S90":"S90",
                    "V90 Cross Country":"V90 Cross Country",
                    "option":"option",
                    "option":"option",
                    "option":"option",
                    "option":"option",
                    "option":"option"
                };
                $("#logoBrand").attr("src","http://www.carlogos.org/logo/Volvo-logo.png");
            }
            if(brand == "W Motors"){

                var newOptions = {

                    "Fenyr Supersport":"Fenyr Supersport",
                    "Lykan Hypersport":"Lykan Hypersport"
                };
                $("#logoBrand").attr("src","http://www.carlogos.org/logo/W-Motors-logo-640x550.jpg");
            }

            $("#brandLogo").css('visibility', 'visible');

        // $("#logoBrand").attr("width","450");
        // $("#logoBrand").attr("height","450");
        var $el = $('#models');
        $el.html(' ');
        $.each(newOptions, function(key, value) {
            $el.append($("<option></option>")
                .attr("value", value).text(key));
        });
    }