<?php
require_once __DIR__ . '/../../../vendor/autoload.php';
include '../../../src/config.php';



// Get data from form submission
$name = $_POST['comp_name'];
$invoice = $_POST['comp_inv'];
$date = $_POST['date'];
$payment = $_POST['payment'];


function getLastFormId($con) {
    $sql = "SELECT cred_invoice FROM credit ORDER BY cred_invoice DESC LIMIT 1";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row["cred_invoice"];
    } else {
        return 0;
    }
}
function generateNextFormId($lastId) {
    // Extract the numeric part from the last ID and increment it
    $numericPart = intval(substr($lastId, 3)) + 1;
    // Format the numeric part to have leading zeros
    $formattedNumericPart = sprintf("%03d", $numericPart);
    // Concatenate with the prefix "RC"
    return "RC" . $formattedNumericPart;
}

$lastId = getLastFormId($con);
$newId = generateNextFormId($lastId);

function numberToWord($num = ''){
    $num    = (string) ((int) $num);

    if ((int) ($num) && ctype_digit($num)) {
        $words  = array();

        $num    = str_replace(array(',', ' '), '', trim($num));

        $list1  = array(
            '', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh',
            'lapan', 'sembilan', 'sepuluh', 'sebelas', 'dua belas', 'tiga belas', 'empat belas',
            'lima belas', 'enam belas', 'tujuh belas', 'lapan belas', 'sembilan belas'
        );

        $list2  = array(
            '', 'sepuluh', 'dua puluh', 'tiga puluh', 'empat puluh', 'lima puluh', 'enam puluh',
            'tujuh puluh', 'lapan puluh', 'sembilan puluh', 'ratus'
        );

        $list3  = array(
            '', 'ribu', 'juta', 'bilion', 'trilion',
            'quadrilion', 'quintillion', 'sextillion', 'septillion',
            'octillion', 'nonillion', 'decillion', 'undecillion',
            'duodecillion', 'tredecillion', 'quattuordecillion',
            'quindecillion', 'sexdecillion', 'septendecillion',
            'octodecillion', 'novemdecillion', 'vigintillion'
        );

        $num_length = strlen($num);
        $levels = (int) (($num_length + 2) / 3);
        $max_length = $levels * 3;
        $num    = substr('00' . $num, -$max_length);
        $num_levels = str_split($num, 3);

        foreach ($num_levels as $num_part) {
            $levels--;
            $hundreds   = (int) ($num_part / 100);
            $hundreds   = ($hundreds ? ' ' . $list1[$hundreds] . ' Ratus' . ($hundreds == 1 ? '' : '') . ' ' : '');
            $tens       = (int) ($num_part % 100);
            $singles    = '';

            if ($tens < 20) {
                $tens = ($tens ? ' ' . $list1[$tens] . ' ' : '');
            } else {
                $tens = (int) ($tens / 10);
                $tens = ' ' . $list2[$tens] . ' ';
                $singles = (int) ($num_part % 10);
                $singles = ' ' . $list1[$singles] . ' ';
            }
            $words[] = $hundreds . $tens . $singles . (($levels && (int) ($num_part)) ? ' ' . $list3[$levels] . ' ' : '');
        }
        $commas = count($words);
        if ($commas > 1) {
            $commas = $commas - 1;
        }

        $words  = implode(', ', $words);

        $words  = trim(str_replace(' ,', ',', ucwords($words)), ', ');
        if ($commas) {
            $words  = str_replace(',', '', $words);
        }

        return $words;
    } else if (!((int) $num)) {
        return 'Kosong';
    }
    return '';
    }

    $word = numberToWord($payment);
    $newDate = date("d-m-Y", strtotime($date));


// Create new mPDF instance
$mpdf = new \Mpdf\Mpdf();

// Your HTML template content
$html = '
    <table>
    <tr>
        <td style="width: 15cm;"><h1>KRC Receipt</h1></td>
        <td><p style="font-size: 20px;">No : '. $newId .'</p></td>
    </tr>
    </table>
    <p style="font-size: 20px;"><b>Date :</b> '.$newDate .'</p>
    <p style="font-size: 20px;"><b>Received From :</b> '. $name .'</p>
    <p style="font-size: 20px;"><b>Payment Of :</b> '. $invoice .'</p>
    <p style="font-size: 20px;"><b>The sum of :</b> '. $word .' Sahaja</p>
    <p style="font-size: 20px;"><b>Amount :</b> RM '. $payment .'</p>
    <br>
    <p>*This is computer generated, signature is not required.</p>
';

$mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);



$outputPath = 'C:/xampp/htdocs/SAS/views/payment_pdf/'.$newId.'.pdf' ;
// Output PDF
$mpdf->Output($outputPath, \Mpdf\Output\Destination::FILE);

if (isset($_POST['submit'])) {

    $oldDate = date("Y-m-d", strtotime($date));
    $addPayment = mysqli_query($con, "INSERT INTO credit VALUES ('$newId','$name','$invoice', '$payment', '$oldDate')");

    $debt = mysqli_query($con, "SELECT * FROM debt WHERE debt_invoice = '$invoice'");
    $row = mysqli_fetch_array($debt);
    $amount = $row['amount'];
    $balance = $amount - $payment;

    // Get the current status
    $status = $row['status'];

    if ($balance == 0) {
        $status = 'COMPLETED';
    }

    $updateDebt = mysqli_query($con, "UPDATE debt SET amount = '$balance', status = '$status' WHERE debt_invoice = '$invoice'");

    if($addPayment && $updateDebt){
        echo '<script> alert("The payment have been made."); window.location="../ad_main.php"; </script>';
    } else{
        echo '<script> alert("There\'s an error."); window.location="../ad_main.php"; </script>';
    }
}


?>
