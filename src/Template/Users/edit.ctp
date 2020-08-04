<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */

?>
<body>

<div class="container" style="background-image: url(http://localhost/howfartoreach/img/tires3.png);">
    <div class="row">
        <div class="col-md-10 form-horizontal" style="padding-top: 40px;">
        <?= $this->Form->create($user) ?>
                <fieldset>

                    <legend><?= __('Edit your user data') ?></legend>

                        <div class="form-group">
                          <label class="col-md-4 control-label" for="login">Login</label>  
                          <div class="col-md-4">
                         <div class="input-group">
                               <div class="input-group-addon">
                                <i class="fa fa-user">
                                </i>
                               </div>
                               <input id="login" name="login" type="text" placeholder="New username" class="form-control input-md">
                              </div>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-md-4 control-label" for="Password">Password</label>  
                          <div class="col-md-4">
                         <div class="input-group">
                               <div class="input-group-addon">
                                <i class="fa fa-key">
                                </i>
                               </div>
                               <input id="Password" name="Password" type="Password" placeholder="New Password" class="form-control input-md">
                              </div>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-md-4 control-label" for="Age">Age</label>  
                          <div class="col-md-4">
                         <div class="input-group">
                               <div class="input-group-addon">
                                <i class="fa fa-birthday-cake">
                                </i>
                               </div>
                               <input type="number" name="age" id="age" class="form-control" placeholder='<?=$current_user['age']?>'>
                              </div>
                          </div>
                        </div>


                        <div class="form-group">
                          <label class="col-md-4 control-label" for="Sex">Sex</label>
                          <div class="col-md-4"> 
                            <label class="radio-inline" for="sex">
                              <input type="radio" name="sex" id="male" value="male">
                              Male
                            </label> 
                            <label class="radio-inline" for="sex">
                              <input type="radio" name="sex" id="female" value="female">
                              Female
                            </label> 
                            <label class="radio-inline" for="sex">
                              <input type="radio" name="sex" id="undefined" value="undefined">
                              Other
                            </label>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-md-4 control-label" for="Email Address">Email Address</label>  
                          <div class="col-md-4">
                          <div class="input-group">
                               <div class="input-group-addon">
                             <i class="fa fa-envelope-o"></i>
                                
                               </div>
                            <input id="Email Address" name="Email Address" type="text" placeholder="Email Address" class="form-control input-md">
                            
                              </div>
                          
                          </div>
                        </div>


                        <div class="form-group select">
                          <label class="col-md-4 control-label" for="Login">Country</label>  
                          <div class="col-md-4">
                         <div class="input-group">
                               <div class="input-group-addon">
                                <i class="fa fa-flag">
                                </i>
                               </div>
                               <?php 

                                    echo $this->Form->select('country', ['options' => ["AF"=>'Afghanistan',"AL"=>'Albania',"DZ"=>'Algeria',"AS"=>'American Samoa',"AD"=>'Andorra',"AO"=>'Angol',"AI"=>'Anguilla',"AQ"=>'Antarctica',"AG"=>'Antigua and Barbuda',"AR"=>'Argentina',"AM"=>'Armenia',"AW"=>'Aruba',"AU"=>'Australia',"AT"=>'Austria',"AZ"=>'Azerbaijan',"BS"=>'Bahamas',"BH"=>'Bahrai',"BD"=>'Bangladesh',"BB"=>'Barbados',"BY"=>'Belarus',"BE"=>'Belgium',"BZ"=>'Belize',"BJ"=>'Benin',"BM"=>'Bermuda',"BT"=>'Bhutan',"BO"=>'Bolivia',"BA"=>'Bosnia and Herzegowina',"BW"=>'Botswana',"BV"=>'Bouvet Island',"BR"=>'Brazil',"IO"=>'British Indian Ocean Territory',"BN"=>'Brunei Darussalam',"BG"=>'Bulgaria',"BF"=>'Burkina Faso',"BI"=>'Burundi',"KH"=>'Cambodia',"CM"=>'Cameroon',"CA"=>'Canada',"CV"=>'Cape Verde',"KY"=>'Cayman Islands',"CF"=>'Central African Republic',"TD"=>'Chad',"CL"=>'Chile',"CN"=>'China',"CX"=>'Christmas Island',"CC"=>'Cocos (Keeling) Islands',"CO"=>'Colombia',"KM"=>'Comoros',"CG"=>'Congo',"CD"=>'Congo, the Democratic Republic of the',"CK"=>'Cook Islands',"CR"=>'Costa Rica',"CI"=>'Cote d`Ivoire',"HR"=>'Croatia (Hrvatska)',"CU"=>'Cuba',"CY"=>'Cyprus',"CZ"=>'Czech Republic',"DK"=>'Denmark',"DJ"=>'Djibouti',"DM"=>'Dominica',"DO"=>'Dominican Republic',"TP"=>'East Timor',"EC"=>'Ecuador',"EG"=>'Egypt',"SV"=>'El Salvador',"GQ"=>'Equatorial Guinea',"ER"=>'Eritrea',"EE"=>'Estonia',"ET"=>'Ethiopia',"FK"=>'Falkland Islands (Malvinas)',"FO"=>'Faroe Islands',"FJ"=>'Fiji',"FI"=>'Finland',"FR"=>'France',"FX"=>'France, Metropolitan',"GF"=>'French Guiana',"PF"=>'French Polynesia',"TF"=>'French Southern Territories',"GA"=>'Gabon',"GM"=>'Gambia',"GE"=>'Georgia',"DE"=>'Germany',"GH"=>'Ghana',"GI"=>'Gibraltar',"GR"=>'Greece',"GL"=>'Greenland',"GD"=>'Grenada',"GP"=>'Guadeloupe',"GU"=>'Guam',"GT"=>'Guatemala',"GN"=>'Guinea',"GW"=>'Guinea-Bissau',"GY"=>'Guyana',"HT"=>'Haiti',"HM"=>'Heard and Mc Donald Islands',"VA"=>'Holy See (Vatican City State)',"HN"=>'Honduras',"HK"=>'Hong Kong',"HU"=>'Hungary',"IS"=>'Iceland',"IN"=>'India',"ID"=>'Indonesia',"IR"=>'Iran (Islamic Republic of)',"IQ"=>'Iraq',"IE"=>'Ireland',"IL"=>'Israel',"IT"=>'Italy',"JM"=>'Jamaica',"JP"=>'Japan',"JO"=>'Jordan',"KZ"=>'Kazakhstan',"KE"=>'Kenya',"KI"=>'Kiribati',"KP"=>'Korea, Democratic People´s Republic of',"KR"=>'Korea, Republic of',"KW"=>'Kuwait',"KG"=>'Kyrgyzstan',"LA"=>'Lao People´s Democratic Republic',"LV"=>'Latvia',"LB"=>'Lebanon',"LS"=>'Lesotho',"LR"=>'Liberia',"LY"=>'Libyan Arab Jamahiriya',"LI"=>'Liechtenstein',"LT"=>'Lithuania',"LU"=>'Luxembourg',"MO"=>'Macau',"MK"=>'Macedonia, The Former Yugoslav Republic of',"MG"=>'Madagascar',"MW"=>'Malawi',"MY"=>'Malaysia',"MV"=>'Maldives',"ML"=>'Mali',"MT"=>'Malta',"MH"=>'Marshall Islands',"MQ"=>'Martinique',"MR"=>'Mauritania',"MU"=>'Mauritius',"YT"=>'Mayotte',"MX"=>'Mexico',"FM"=>'Micronesia, Federated States of',"MD"=>'Moldova, Republic of',"MC"=>'Monaco',"MN"=>'Mongolia',"MS"=>'Montserrat',"MA"=>'Morocco',"MZ"=>'Mozambique',"MM"=>'Myanmar',"NA"=>'Namibia',"NR"=>'Nauru',"NP"=>'Nepal',"NL"=>'Netherlands',"AN"=>'Netherlands Antilles',"NC"=>'New Caledonia',"NZ"=>'New Zealand',"NI"=>'Nicaragua',"NE"=>'Niger',"NG"=>'Nigeria',"NU"=>'Niue',"NF"=>'Norfolk Island',"MP"=>'Northern Mariana Islands',"NO"=>'Norway',"OM"=>'Oman',"PK"=>'Pakistan',"PW"=>'Palau',"PA"=>'Panama',"PG"=>'Papua New Guinea',"PY"=>'Paraguay',"PE"=>'Peru',"PH"=>'Philippines',"PN"=>'Pitcairn',"PL"=>'Poland',"PT"=>'Portugal',"PR"=>'Puerto Rico',"QA"=>'Qatar',"RE"=>'Reunion',"RO"=>'Romania',"RU"=>'Russian Federation',"RW"=>'Rwanda',"KN"=>'Saint Kitts and Nevis',"LC"=>'Saint LUCIA',"VC"=>'Saint Vincent and the Grenadines',"WS"=>'Samoa',"SM"=>'San Marino',"ST"=>'Sao Tome and Principe',"SA"=>'Saudi Arabia',"SN"=>'Senegal',"SC"=>'Seychelles',"SL"=>'Sierra Leone',"SG"=>'Singapore',"SK"=>'Slovakia (Slovak Republic)',"SI"=>'Slovenia',"SB"=>'Solomon Islands',"SO"=>'Somalia',"ZA"=>'South Africa',"GS"=>'South Georgia and the South Sandwich Islands',"España"=>'Spain',"LK"=>'Sri Lanka',"SH"=>'St. Helena',"PM"=>'St. Pierre and Miquelon',"SD"=>'Sudan',"SR"=>'Suriname',"SJ"=>'Svalbard and Jan Mayen Islands',"SZ"=>'Swaziland',"SE"=>'Sweden',"CH"=>'Switzerland',"SY"=>'Syrian Arab Republic',"TW"=>'Taiwan, Province of China',"TJ"=>'Tajikistan',"TZ"=>'Tanzania, United Republic of',"TH"=>'Thailand',"TG"=>'Togo',"TK"=>'Tokelau',"TO"=>'Tonga',"TT"=>'Trinidad and Tobago',"TN"=>'Tunisia',"TR"=>'Turkey',"TM"=>'Turkmenistan',"TC"=>'Turks and Caicos Islands',"TV"=>'Tuvalu',"UG"=>'Uganda',"UA"=>'Ukraine',"AE"=>'United Arab Emirates',"GB"=>'United Kingdom',"US"=>'United States',"UM"=>'United States Minor Outlying Islands',"UY"=>'Uruguay',"UZ"=>'Uzbekistan',"VU"=>'Vanuatu',"VE"=>'Venezuela',"VN"=>'Viet Nam',"VG"=>'Virgin Islands (British)',"VI"=>'Virgin Islands (U.S.)',"WF"=>'Wallis and Futuna Islands',"EH"=>'Western Sahara',"YE"=>'Yemen',"YU"=>'Yugoslavia',"ZM"=>'Zambia',"ZW"=>'Zimbabwe']] ,['empty' => $current_user['country']]);
                                 ?>
                              </div>
                          </div>
                        </div>


                            
                        <!-- Textarea -->
         <!--                <div class="form-group">
                          <label class="col-md-4 control-label" for="Overview (max 200 words)">Bio (max 200 words)</label>
                          <div class="col-md-4">                     
                            <textarea class="form-control" rows="10"  id="Overview (max 200 words)" name="Overview (max 200 words)" placeholder="Something about you..."></textarea>
                          </div>
                        </div> -->



                        </fieldset>


                        <div class="form-group">
                          <label class="col-md-4 control-label" ></label>  
                          <div class="col-md-4">
                         
                            <?= $this->Form->button(__(' Confirm changes'), ['class' => 'btn btn-success glyphicon glyphicon-thumbs-up']) ?>
                            <?= $this->Form->button(' Clear', ['type' => 'reset', 'class'=>'glyphicon glyphicon-remove-sign btn btn-warning']) ?>

                            
                          </div>
                        </div>
                            <?= $this->Form->end() ?>


                    </form>
                </div>  
            <div class="col-md-2 hidden-xs">
              <?php       

                if($current_user['sex']=='male'){
                  ?><img src="../../img/Profile.png" class="img-responsive img-thumbnail "><?php
                } else if($current_user['sex']=='female'){
                  ?><img src="../../img/profile-female.jpg" class="img-responsive img-thumbnail "><?php
                } else{
                  ?><img src="../../img/profile-undefined.png" class="img-responsive img-thumbnail "><?php 
                }
              ?>
      </div>
    </div>
</div>

