<?php

if (isset($_POST) && isset($_POST['gender'])) {



    $monitor = $_POST['gender'];

    include("connect_db.php");


    $Sqlselect = "SELECT * FROM `firmy_all` WHERE `monitor` = '$monitor' ";


    $result = $conn->query($Sqlselect);

    echo '<table id="' . $_POST['gender'] . '" class="selectVal">
              <thead><tr>

                <th>Nazwa Firmy</th>
                <th>KRS</th>
                <th>dzialalnosc</th>
                <th>email</th>
                <th>kodpocztowy</th>
                <th>wojewodztwo</th>
                <th>Kod pkd</th>

                    </tr></thead><tbody>';

    foreach ($result as $row) {

        echo '<tr>';
        echo '<td>';
        echo $row['nazwa'];
        echo '</td>';
        echo '<td>';
        echo $row['krs'];
        echo '</td>';
        echo '<td>';
        echo $row['dzialalnosc'];
        echo '</td>';
        echo '<td>';
        echo $row['email'];
        echo '</td>';
        echo '<td>';
        echo $row['kodpocztowy'];
        echo '</td>';
        echo '<td>';
        echo $row['wojewodztwo'];
        echo '</td>';

        echo '<td>';
        echo $row['kodppkd'];
        echo '</td>';
        echo '</tr>';


    }
    echo '</tbody></table>

<script>


</script>



';

} else {

    return null;
}





