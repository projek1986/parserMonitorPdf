<?php


class parsepdftodb
{


    public function create_firm(string $content1, string $content2, $monitor = 'test')
    {

//        dane podstawowe

        preg_match_all('/\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+/', strtolower($content1), $email);
        preg_match_all('/miejscowość(\D+)/', $content1, $miejscowosc);
        preg_match_all('/(\d+)-(\d+)/', $content1, $pocztowy);
        preg_match_all('/województwo (\D+)/', $content1, $woj);
        preg_match_all('/wojewódz-two (\D+) powiat /', $content1, $woj2);
        preg_match_all('/Dz. 1. Rub. 1. Dane podmiotu 1. (\D+)3.(\D+)/', $content1, $nazwa);


        preg_match_all('/elektronicznej \w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+/', strtolower($content1), $emailtwo);


        //   var_dump($email);

//       dziłalnosc

        preg_match_all('/Dz. 3. Rub. 1. Przedmiot działalności 1(\D+)(\d+)(\D+)(\d+)(\D+)(\d+)(\D+)/', $content2, $dzialalnosc);


        //   var_dump($dzialalnosc);

        $nazwafirmy = isset($nazwa[2][0]) ? $nazwa[2][0] : null;


        if (empty($nazwafirmy)) {

            preg_match_all('/Dz. 1. Rub. 1. Dane podmiotu 1. (\D+)(\d+)(\D+)(\d+)(\D+)(\d+)(\D+)(\d+)(\D+)(\d+)(\D+)(\d+)/', $content1, $nazwa);


            if ($nazwa[9][0] != ')	') {

                $nazwafirmy = $nazwa[9][0];
            } else {
                $nazwafirmy = '';

            }

        }

        if (trim($nazwafirmy) == ')') {

            $nazwafirmy = '';
        }

        $wojewodztywo = isset($woj[1][0]) ? $woj[1][0] : null;

        if (empty($woj[1][0])) {

            $wojewodztywo = isset($woj2[1][0]) ? $woj2[1][0] : null;;

        }


        $nazwafirmy = ltrim(trim(trim(str_replace('\r\n', '', str_replace('  ', ' ', $nazwafirmy))), '.'));

        $nazwafirmy = explode('-', $nazwafirmy);


// Nazwa firmy
        $nazwafirmynew = '';
        $nazwafirmynew2 = '';
        $ile = count($nazwafirmy);
        for ($i = 0; $i < $ile; $i++) {
            $nazwafirmynew .= trim($nazwafirmy[$i]);
        }

        $nazwafirmynew = explode(' ', $nazwafirmynew);
        $ile2 = count($nazwafirmynew);
        for ($i = 0; $i < $ile2; $i++) {
            $nazwafirmynew2 .= ' ' . trim($nazwafirmynew[$i]);
        }


        // Województwo
        $wojewodztywo = explode('-', $wojewodztywo);
        $wojnew = '';
        $wojnew2 = '';
        $ile = count($wojewodztywo);
        for ($i = 0; $i < $ile; $i++) {
            $wojnew .= trim($wojewodztywo[$i]);
        }

        $wojnew = explode(' ', $wojnew);
        $ile2 = count($wojnew);
        for ($i = 0; $i < $ile2; $i++) {
            $wojnew2 .= ' ' . trim($wojnew[$i]);
        }


        // miejscowość


        return array(
            'nazwa' => isset($nazwafirmynew2) ? trim($nazwafirmynew2) : '',
            'email' => isset($email[0][0]) ? $email[0][0] : '',
            'kodpocztowy' => isset($pocztowy[0][0]) ? $pocztowy[0][0] : '',
            'monitor' => $monitor,
            'dzialalnosc' => isset($dzialalnosc[7][0]) ? $dzialalnosc[7][0] : '',
            'wojewodztwo' => isset($wojnew2) ? $wojnew2 : '',
            'miejscowosc' => isset($miejscowosc[1][0]) ? $this->explodestring($miejscowosc[1][0]) : '',
            'kodppkd' => isset($dzialalnosc[4][0]) ? $dzialalnosc[4][0] . ' ' . $dzialalnosc[6][0] : '',

        );


    }


    public function explodestring($string)
    {

        $string = explode('-', $string);
        $stringnew = '';
        $stringnew2 = '';
        $ile = count($string);
        for ($i = 0; $i < $ile; $i++) {
            $stringnew .= trim($string[$i]);
        }

        $stringnew = explode(' ', $stringnew);
        $ile2 = count($stringnew);
        for ($i = 0; $i < $ile2; $i++) {
            $stringnew2 .= ' ' . trim($stringnew[$i]);
        }

        return $stringnew2;


    }

    public function create_pozycje($text)
    {

        include("connect_db.php");

        preg_match_all('/Poz.(\D+)(\d+)(\D+)KRS(\D+)(\d+)./', $text, $Poz);


        $danetodbpozycje = array();

        $w = 0;
        foreach ($Poz[0] as $pozycja) {


            $danetodbpozycje [$w]['contwnt'] =
                str_replace('\r\n', '', str_replace('-', '', $pozycja));

            $w++;
        }

        $y = 0;
        foreach ($Poz[3] as $pozycja) {

            $nazwafirmy = ltrim(trim(trim(str_replace('\r\n', '', str_replace('  ', ' ', $pozycja))), '.'));

            $nazwafirmy = explode('-', $nazwafirmy);

            $nazwafirmynew = '';
            $nazwafirmynew2 = '';
            $ile = count($nazwafirmy);
            for ($i = 0; $i < $ile; $i++) {
                $nazwafirmynew .= trim($nazwafirmy[$i]);
            }


            $nazwafirmynew = explode(' ', $nazwafirmynew);
            $ile2 = count($nazwafirmynew);
            for ($i = 0; $i < $ile2; $i++) {
                $nazwafirmynew2 .= ' ' . trim($nazwafirmynew[$i]);
            }

            $danetodbpozycje [$y]['f_name'] = trim($nazwafirmynew2);

            $y++;

        }
        $z = 0;
        foreach ($Poz[5] as $pozycja) {


            $danetodbpozycje [$z]['KRS'] = str_replace('\r\n', '', str_replace('-', '', $pozycja));

            $z++;

        }


        foreach ($danetodbpozycje as $pozycja) {

            $datetosql = array(

                $pozycja['contwnt'],
                $pozycja['f_name'],
                $pozycja['KRS'],


            );


            $sql2 = "INSERT INTO pozycje (content , f_name , KRS)
             VALUES ( ? , ? , ? )";

            $conn->prepare($sql2)->execute($datetosql);


        }


    }

    public function createdbfirm($text, $heder_img)
    {

        include("connect_db.php");
        preg_match_all('/Dz. 1. Rub. 1. Dane podmiotu 1. (\D+)(\d+)(\D+)(\d+)(\D+)(\d+)(\D+)(\d+)(\D+)(\d+)(\D+)(\d+)(\D+)(\d+)(\D+)(\d+)(\D+)(\d+)(\D+)(\d+)(\D+)(\d+)(\D+)(\d+)(\D+)(\d+)(\D+)/', $text, $calosc);


        $datatodb = array();

        $p = 0;
        foreach ($calosc[0] as $value) {

            $datatodb[$p]['info'] = array(

                $value

            );
            $p++;
        }


        preg_match_all('/Dz. 3. Rub. 1. Przedmiot działalności 1(\D+)(\d+)(\D+)(\D+)(\d+)(\D+)(\d+)(\D+)/', $text, $calosc2);


        $i = 0;
        foreach ($calosc2[0] as $value2) {


            $datatodb[$i]['info2'] = array(

                $value2
            );
            $i++;
        }


        foreach ($datatodb as $row) {

            $rowdata = array(
                $row['info'][0],
                $row['info2'][0]


            );

            $sql4 = "INSERT INTO all_content(content , content2)
             VALUES ( ? , ? )";

            $conn->prepare($sql4)->execute($rowdata);


            $view = $this->create_firm($row['info'][0], $row['info2'][0], $heder_img);


            $sqldatainsert = array(

                $view['nazwa'],
                $view['email'],
                $view['kodpocztowy'],
                $view['monitor'],
                $view['dzialalnosc'],
                $view['wojewodztwo'],
                $view['miejscowosc'],
                $view['kodppkd'],


            );

            //   var_dump($view['email']);

            $sql3 = "INSERT INTO firmy(nazwa  , email , kodpocztowy  , monitor , dzialalnosc , wojewodztwo ,miejscowosc ,kodppkd )
             VALUES ( ? , ? ,?, ? ,?, ? ,? ,? )";

            $conn->prepare($sql3)->execute($sqldatainsert);


        }
    }

    public function select_krs()
    {

        include("connect_db.php");

        $Sqlselect = "SELECT * FROM `firmy` f ,  pozycje p WHERE f.`nazwa` = p.f_name GROUP BY f.nazwa";


        $result = $conn->query($Sqlselect);


        foreach ($result as $row) {

            $caloscarray = array(

                $row['f_name'],
                $row['email'],
                $row['kodpocztowy'],
                $row['monitor'],
                $row['dzialalnosc'],
                $row['wojewodztwo'],
                $row['miejscowosc'],
                $row['kodppkd'],
                $row['KRS'],

            );


            $sql3 = "INSERT INTO firmy_all(nazwa  , email , kodpocztowy  , monitor , dzialalnosc , wojewodztwo ,miejscowosc ,kodppkd ,krs )
             VALUES ( ? , ? ,?, ? ,?, ? ,? ,? ,? )";

            $conn->prepare($sql3)->execute($caloscarray);


        }


        echo '<div class="container">
    <div class="row">
    <div class="col-md-12"><br><br> <br>';
        echo '<div class="alert alert-info" role="alert">Monitor dodany</div>';
        echo ' </div>
</div>
</div>';
    }


    public function insertmonitor($monitor)
    {
        include("connect_db.php");
        $caloscarray = array(

            $monitor

        );


        $sql3 = "INSERT INTO monitor(monitor )
             VALUES ( ? )";

        $conn->prepare($sql3)->execute($caloscarray);


    }

    public function monitor($monitor)
    {

        include("connect_db.php");


        $Sqlselect = "SELECT * FROM `monitor` WHERE `monitor` = '$monitor' ";


        $result = $conn->query($Sqlselect);

        return $result->rowCount();


    }

    public function pokazdanemonitor()
    {

        include("connect_db.php");


        $Sqlselect = "SELECT * FROM `monitor`";


        $result = $conn->query($Sqlselect);

        foreach ($result as $row) {

            echo '<option value="' . str_replace('.pdf', '', $row['monitor']) . '"> ' . str_replace('.pdf', '', $row['monitor']) . '</option>';


        }


    }

}