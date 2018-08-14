<?php

// Include 'Composer' autoloader.
include 'vendor/autoload.php';
include('parse.php');
include('connect_db.php');



?>
<title>PDF-Parser<?php echo date('Y-m-d H:i') ?></title>

<link href="web/vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<script src="web/vendors/bootstrap/js/bootstrap.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
        integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>

<link rel="stylesheet" type="text/css"
      href="https://cdn.datatables.net/u/dt/jszip-2.5.0,pdfmake-0.1.18,dt-1.10.12,af-2.1.2,b-1.2.1,b-colvis-1.2.1,b-flash-1.2.1,b-html5-1.2.1,b-print-1.2.1,r-2.1.0,sc-1.4.2,se-1.2.0/datatables.min.css"/>

<!--<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/foundation/5.5.2/css/foundation.min.css"/>-->
<!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/dataTables.foundation.min.css"/>-->

<script type="text/javascript"
        src="https://cdn.datatables.net/u/dt/jszip-2.5.0,pdfmake-0.1.18,dt-1.10.12,af-2.1.2,b-1.2.1,b-colvis-1.2.1,b-flash-1.2.1,b-html5-1.2.1,b-print-1.2.1,r-2.1.0,sc-1.4.2,se-1.2.0/datatables.min.js"></script>


<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <br>
            <br>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Ładowanie pliku monitora</h3>
                </div>
                <div class="panel-body">
                    <form action="index.php" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="exampleInputFile">Plik</label>
                            <input name="files[]" multiple type="file" id="exampleInputFile">
                            <p class="help-block">Wczytaj plik.</p>
                        </div>

                        <button type="submit" class="btn btn-default">Przeslij plik</button>
                    </form>
                </div>
            </div>


        </div>
        <div class="col-md-3"></div>
    </div>

</div>


<?php
$parce = new parsepdftodb();
$parser = new \Smalot\PdfParser\Parser();


if (!is_dir("assets/file/pdf")) {
    mkdir("assets/file/pdf", 0777);
}

if (isset($_FILES['files'])) {

    for ($i = 0; $i < count($_FILES['files']['size']); $i++) {

        $heder_img = $_FILES['files']['name'][$i];


        if ($parce->monitor($heder_img) == 0) {
            $parce->insertmonitor($heder_img);


            $file = 'assets/file/pdf/' . $heder_img . '';

            move_uploaded_file($_FILES['files']['tmp_name'][$i], $file);


            $pdf = $parser->parseFile('assets/file/pdf/' . $heder_img . '');

            $text = $pdf->getText();

            $parce->create_pozycje($text);
            $parce->createdbfirm($text, str_replace('.pdf', '', $heder_img));


            echo '<div class="container">
    <div class="row">
    <div class="col-md-12"><br><br> <br>';

            $parce->select_krs();

            echo ' </div>
</div>
</div>';

            unlink('assets/file/pdf/' . $_FILES['files']['name'][0] . '');

        } else {
            echo '<div class="container">
    <div class="row">
    <div class="col-md-12"><br><br> <br>';
            echo '<div class="alert alert-danger" role="alert">Taki Monitor jest już w bazie</div>';
            echo ' </div>
</div>
</div>';
        }
    }
}


    echo '<div class="container">
        <div class="row">
        <div class="col-md-12"><br>
        <h3>Wybierz monitor do wyświetlenia</h3>
        <br>
         <select id="select1" name="gender">
        <option value="0">Wybierz monitor</option>';
                $parce->pokazdanemonitor();
    echo '</select>
     
   
     <br>
     <br>
     <br>
     <div class="tablehere"></div>
     ';

        echo ' <br><br> <br></div>
        </div>
        </div>';
        ?>

<script>
    $(document).ready(function () {

        const $select1 = $('#select1');


        $select1.on('change', function () {
            const selectVal = $(this).find('option:selected').val();   //pobieramy wartość wybranego selekta

            if (selectVal !== -1) {  //jeżeli jest inna niż -1 (czyli jeżeli został wybrany model)
                $.ajax({
                    type: "post",
                    url: "skryptNaSerwerze.php",
                    data: {
                        gender: selectVal
                    }
                })
                    .done(function (data) {

                        $('.tablehere').html(data);

                        var table = $('.selectVal').DataTable({
                                dom: 'Bfrtip',
                                buttons: [
                                    'excel'
                                ],
                                "scrollY": "600px",
//                "scrollX": "1180px",
                                "scrollCollapse": true,
                                paging: true,
                                stateSave: true,
                                "oLanguage": {
                                    "sInfo": "Wyników _TOTAL_  (_START_ do _END_)",
                                    "sSearch": "Szukaj:"

                                }

                            }
                        );

                    })
                    .fail(function () {
                        console.warn('wystąpił błąd');
                    })
            } else {

            }


        });


    });


</script>

