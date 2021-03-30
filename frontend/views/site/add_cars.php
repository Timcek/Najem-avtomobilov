<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use frontend\assets\Add_cars;
Add_cars::register($this);
use yii\widgets\Pjax;
?>


<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">


<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
<div class="sceleton">
    <h1 style="border-bottom: 1px solid grey; margin-top:0; margin-bottom: 30px">Dodaj avto</h1>
    <div class="small-sceleton">
        <div class="names">
            <h4 style="margin-bottom: 106px">Znamka & model</h4>
        </div>
        <?php
        //ko ponovno nalagamo stran, da izberemo taprav array modelov (kateri array bomo uporabili je odvisno od car_company, ki smo ga z ajaxsom poslali v backend)
        if(isset($_SESSION["model"])){
            if($_SESSION["car_company"]=="Audi"){
                $car_models=["50"=>"50","60"=>"60","80"=>"80","90"=>"90","100"=>"100","200"=>"200","A1"=>"A1","A2"=>"A2","A3"=>"A3","A4"=>"A4","A4 Allroad"=>"A4 Allroad","A5"=>"A5","A6"=>"A6","A6 Allroad"=>"A6 Allroad","A7"=>"A7","A8"=>"A8","Co"=>"Coupe","Cabriolet"=>"Cabriolet","E-Tron"=>"E-Tron","Q1"=>"Q1","Q2"=>"Q2","Q3"=>"Q3","Q5"=>"Q5","Q7"=>"Q7","Q8"=>"Q8","R8"=>"R8","RS2"=>"RS2","RS3"=>"RS3","RS4"=>"RS4","RS5"=>"RS5","RS6"=>"RS6","RS7"=>"RS7","RS Q3"=>"RS Q3","RS Q5"=>"RS Q5","RS Q8"=>"RS Q8","S1"=>"S1","S2"=>"S2","S3"=>"S3","S4"=>"S4","S5"=>"S5","S6"=>"S6","S7"=>"S7","S8"=>"S8","SQ2"=>"SQ2","SQ5"=>"SQ5","SQ7"=>"SQ7","SQ8"=>"SQ8","TT"=>"TT","V8"=>"V8"];
            }elseif($_SESSION["car_company"]=="BMW"){
               $car_models=["1802" => "1802","2002" => "2002","i3" => "i3","i8" => "i8","iX3" => "iX3","M1" => "M1","M2" => "M2","M3" => "M3","M4" => "M4","M5" => "M5","M6" => "M6","M8" => "M8","Serija 1" => "Serija 1","Serija 2" => "Serija 2","Serija 3" => "Serija 3","Serija 4" => "Serija 4","Serija 5" => "Serija 5","Serija 6" => "Serija 6","Serija 7" => "Serija 7","Serija 8" => "Serija 8","Serija X1" => "Serija X1","Serija X2" => "Serija X2","Serija X3" => "Serija X3","Serija X4" => "Serija X4","Serija X5" => "Serija X5","Serija X6" => "Serija X6","Serija X7" => "Serija X7","Z1" => "Z1","Z3" => "Z3","Z4" => "Z4","Z8" => "Z8"];
            }else{
                $car_models=["190" =>"190","W123" =>"W123","AMG GT" =>"AMG GT","A-Razred" =>"A-Razred","B-Razred" =>"B-Razred","C-Razred" =>"C-Razred","Citan" =>"Citan","CL-Razred" =>"CL-Razred","CLA-Razred" =>"CLA-Razred","CLC-Razred" =>"CLC-Razred","CLK-Razred" =>"CLK-Razred","CLS-Razred" =>"CLS-Razred","E-Razred" =>"E-Razred","EQC" =>"EQC","G-Razred" =>"G-Razred","GL-Razred" =>"GL-Razred","GLA-Razred" =>"GLA-Razred","GLB-Razred" =>"GLB-Razred","GLC-Razred" =>"GLC-Razred","GLC coupe" =>"GLC coupe","GLE-Razred" =>"GLE-Razred","GLE coupe" =>"GLE coupe","GLK-Razred" =>"GLK-Razred","GLS-Razred" =>"GLS-Razred","ML-Razred" =>"ML-Razred","R-Razred" =>"R-Razred","S-Razred" =>"S-Razred","SL-Razred" =>"SL-Razred","SLC-Razred" =>"SLC-Razred","SLS-Razred" =>"SLS-Razred","SLK-Razred" =>"SLK-Razred","SLR-Razred" =>"SLR-Razred","V-Razred" =>"V-Razred","X-Razred" =>"X-Razred","Vaneo" =>"Vaneo","Viano" =>"Viano","Vito" =>"Vito"];
            }
        }else{
            $car_models=["50"=>"50","60"=>"60","80"=>"80","90"=>"90","100"=>"100","200"=>"200","A1"=>"A1","A2"=>"A2","A3"=>"A3","A4"=>"A4","A4 Allroad"=>"A4 Allroad","A5"=>"A5","A6"=>"A6","A6 Allroad"=>"A6 Allroad","A7"=>"A7","A8"=>"A8","Co"=>"Coupe","Cabriolet"=>"Cabriolet","E-Tron"=>"E-Tron","Q1"=>"Q1","Q2"=>"Q2","Q3"=>"Q3","Q5"=>"Q5","Q7"=>"Q7","Q8"=>"Q8","R8"=>"R8","RS2"=>"RS2","RS3"=>"RS3","RS4"=>"RS4","RS5"=>"RS5","RS6"=>"RS6","RS7"=>"RS7","RS Q3"=>"RS Q3","RS Q5"=>"RS Q5","RS Q8"=>"RS Q8","S1"=>"S1","S2"=>"S2","S3"=>"S3","S4"=>"S4","S5"=>"S5","S6"=>"S6","S7"=>"S7","S8"=>"S8","SQ2"=>"SQ2","SQ5"=>"SQ5","SQ7"=>"SQ7","SQ8"=>"SQ8","TT"=>"TT","V8"=>"V8"];    
        }
        ?></p>
        <div class="all_forms">
            <?= $form->field($model, 'car_company',['template'=>"{input}\n{hint}\n{error}"])->dropDownList(["Audi"=>"Audi","BMW"=>"BMW","Mercedes-benz"=>"Mercedes-benz"],["class"=>"form-control car_company_ajax"]) ?>
            <?= $form->field($model, 'model',['template'=>"{input}\n{hint}\n{error}"])->dropDownList($car_models,["class"=>"form-control model_ajax"])->error(["style"=>"margin-left:15px; color:grey"]) ?>
        </div>
    </div>
    <div class="small-sceleton">
        <div class="names">
            <h4 style="margin-bottom: 114px">Leto & cena na dan (€)</h4>
        </div>
        <div class="all_forms">
            <?= $form->field($model, 'year',['template'=>"{input}\n{hint}\n{error}"])->error(["style"=>"margin-left:15px; color:grey"])->input('text', ['placeholder' => "Leto","class"=>"form-control year_ajax"]) ?>
            <?= $form->field($model, 'price',['template'=>"{input}\n{hint}\n{error}"])->error(["style"=>"margin-left:15px; color:grey; padding-bottom:30px"])->input('text', ['placeholder' => "Cena","class"=>"form-control price_ajax"]) ?>
        </div>
    </div>
    <div class="small-sceleton">
        <div class="names">
            <h4 style="margin-bottom: 163px">Moč motorja (kW), vrata & sedeži</h4>
        </div>
        <div class="all_forms">
            <?= $form->field($model, 'engine_power',['template'=>"{input}\n{hint}\n{error}"])->error(["style"=>"margin-left:15px; color:grey"])->input('text', ['placeholder' => "Moč motorja","class"=>"form-control engine_power_ajax"]) ?>
            <?= $form->field($model, 'dors',['template'=>"{input}\n{hint}\n{error}"])->error(["style"=>"margin-left:15px; color:grey"])->input('text', ['placeholder' => "Vrata","class"=>"form-control doors_ajax"]) ?>
            <?= $form->field($model, 'seats',['template'=>"{input}\n{hint}\n{error}"])->error(["style"=>"margin-left:15px; color:grey; padding-bottom:30px"])->input('text', ['placeholder' => "Sedeži","class"=>"form-control seats_ajax"]) ?>
        </div>
    </div>
    <div class="small-sceleton">
        <div class="names">
            <h4 style="margin-bottom: 150px">Menjalnik & tip goriva</h4>
        </div>
        <div class="all_forms">
            <?= $form->field($model, 'gearing_type',['template'=>"{input}\n{hint}\n{error}"])->dropDownList(["manual"=>"Ročni","automatic"=>"Avtomatski"],["class"=>"form-control gearing_type_ajax"]) ?>
            <?= $form->field($model, 'fuel_type',['template'=>"{input}\n{hint}\n{error}"])->dropDownList(["diesel"=>"Diezel","gasoline"=>"Bencin"],["style"=>"margin-bottom:30px","class"=>"form-control fuel_type_ajax"]) ?>
        </div>
    </div>
    <div class="small-sceleton">
        <div class="names">
            <h4 style="margin-bottom: 25px">Slika avtomobila</h4>
            <div style="cursor:pointer;display:flex;justify-content:center;align-items:center;width:120px; height:30px; background-color:rgb(116,116,116); border-radius:5px" onclick="document.getElementById('cover_image').click()" id="image_selection"><?php if(isset($_SESSION["select_change"])){echo "<h4 style='color:white; margin-bottom:0'>Change image</h4>";}else{echo "<h4 style='color:white;margin-bottom:0'>Izberi sliko</h4>";}?></div>
            <input type='file' accept="image/*" id="cover_image" style="display:none">
        </div>
                <div class="all_forms">
                                    <?php Pjax::begin(['id'=>'id-pjax']); ?>
                                        <?php 
                                        //da iz $_SESSION izbrisemo vse podatke, da se nebi ponavljali ko bi ponovno naložili stran
                                        if(isset($_SESSION["count"])&&$_SESSION["count"]==2){
                                            unset($_SESSION["engine_power"]);
                                            unset($_SESSION["year"]);
                                            unset($_SESSION["price"]);
                                            unset($_SESSION["doors"]);
                                            unset($_SESSION["seats"]);
                                            unset($_SESSION["count"]);
                                            unset($_SESSION["car_company"]);
                                            unset($_SESSION["model"]);
                                        }
                                        //da prikažemo sliko
                                    
                                        if(isset($_SESSION["temp_photo_loc"])){
                                            /*echo $_SESSION["temp_photo_loc"];
                                            echo '<div id="uploaded-image" style="width: 300px; height:300px;background:url(C:/Apache24/htdocs/sola-avto-stran/yii-appli/frontend/web/assets//temp/'.$_SESSION["temp_photo_loc"].'.png)"></div>';*/
                                            echo '<img id="uploaded-image" src="C:/Apache24/htdocs/sola-avto-stran/yii-appli/frontend/web/assets/temp/'?><?=$_SESSION["temp_photo_loc"]?><?='.png" height="400px" width="400px" style="box-shadow: 3px 3px 5px 6px #ccc; margin: 0 auto 0 auto;">';
                                        }?> 
                                    <?php Pjax::end(); ?>

                    <!-- This is the modal -->
                    <div class="modal" tabindex="-1" role="dialog" id="uploadimageModal">
                        <div class="modal-dialog" role="document" style="min-width: 700px">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <div id="image_demo"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary crop_image">Obreži in Shrani</button>
                                    <button type="button" class="btn btn-secondary close-btn" >Zapri</button>
                                </div>
                            </div>
                        </div>
                    </div>    
            </div>
        </div>
        <div style="text-align: center; margin-top:25px;padding-top: 10px; border-top: 1px solid black">
                <?= Html::submitButton('Dodaj', ['class' => 'btn btn-primary submitting-btn', 'name' => 'login-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
            <?php unset($_SESSION["incomming"]);?>
    </div>
</div>        

    <script>
        var image_crop = $('#image_demo').croppie({
            viewport: {
                width: 400,
                height: 400,
                type:'square'
            },
            boundary:{
                width: 650,
                height: 650
            }
        });
        
        $(".close-btn").click(function(){
            //da zapremo pop-up
          $('#uploadimageModal').modal('hide');
        })

        $('#cover_image').on('change', function(){
            //to se zgodi, ko kliknemo na button in izberemo sliko
            //1.
            //to je input, kamor shranimo sliko, in ko se input spremeni se pojavi pojavno okno.
            //se izvede najprej
            var reader = new FileReader();
            reader.onload = function (event) {
                image_crop.croppie('bind', {
                    url: event.target.result,
                });
            }
            //odpre pojavno okno
            reader.readAsDataURL(this.files[0]);
            $('#uploadimageModal').modal('show');
        });

        $('.crop_image').click(function(event){
            //2.
            //Crop and Save button
            var formData = new FormData();
            image_crop.croppie('result', {type: 'blob', format: 'png'}).then(function(blob) {
                //da dodamo podatke v FormData objekt, ki ga nato z ajax-som pošljemo v backend
                formData.append('cropped_image', blob);
                formData.append('year',$(".year_ajax").val());
                formData.append('price',$(".price_ajax").val());
                formData.append('engine_power',$(".engine_power_ajax").val());
                formData.append('doors',$(".doors_ajax").val());
                formData.append('seats',$(".seats_ajax").val());
                formData.append('car_company',$(".car_company_ajax :selected").val());
                formData.append('model',$(".model_ajax :selected").val());
                formData.append('gearing_type',$(".gearing_type_ajax :selected").val());
                formData.append('fuel_type',$(".fuel_type_ajax :selected").val());
                console.log($(".fuel_type_ajax :selected").val())
                ajaxFormPost(formData); // Calling my ajax function with my blob data passed to it
            });
            $('#uploadimageModal').modal('hide');
        });

        function ajaxFormPost(formData){
            //3.
            //kličemo actionAdd_cars, kamor posljemo v get photo true, da se izvede en del funkcije
            //succesa in errorja sedaj ne potrebujemo
            $.ajax({
                type: 'POST',
                url:"?r=site%2Fadd_cars&photo=true",
                data: formData,
                cache: false,
                async: true,
                processData: false,
                contentType: false,
                timeout: 5000,
            });

            //poskrbi, da se zgodi reload strani, da se prikaže slika.
            $.pjax.reload({container: '#id-pjax'});
        }
    </script>