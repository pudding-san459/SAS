<?php
require_once __DIR__ . '/../../vendor/autoload.php';
include '../../src/config.php';



// Get data from form submission
$date = $_POST['date'];
$terms = $_POST['terms'];
$compName = $_POST['comp_name'];
$compAddress = $_POST['comp_address'];
$desc = $_POST['desc'];

// Calculate the due date
$dueDate = calculateDueDate($date, $terms);

function getLastFormId($con) {
    $sql = "SELECT debt_invoice FROM debt ORDER BY debt_invoice DESC LIMIT 1";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row["debt_invoice"];
    } else {
        return 0;
    }
}
function generateNextFormId($lastId) {
    // Extract the numeric part from the last ID and increment it
    $numericPart = intval(substr($lastId, 3)) + 1;
    // Format the numeric part to have leading zeros
    $formattedNumericPart = sprintf("%03d", $numericPart);
    // Concatenate with the prefix "INV"
    return "INV" . $formattedNumericPart;
}

$lastId = getLastFormId($con);
$newId = generateNextFormId($lastId);

// Function to calculate the due date
function calculateDueDate($date, $terms) {
    return date('Y-m-d', strtotime($date . ' + ' . $terms . ' days'));
}

// Get specific variables like particulars, qtty, price, and total
$particulars = array();
$qtty = array();
$price = array();
$total = array();

$particulars[1] = $_POST['particular1'];
$particulars[2] = $_POST['particular2'];
$particulars[3] = $_POST['particular3'];
$particulars[4] = $_POST['particular4'];
$particulars[5] = $_POST['particular5'];

$qtty[1] = $_POST['qtty1'];
$qtty[2] = $_POST['qtty2'];
$qtty[3] = $_POST['qtty3'];
$qtty[4] = $_POST['qtty4'];
$qtty[5] = $_POST['qtty5'];

$price[1] = $_POST['price1'];
$price[2] = $_POST['price2'];
$price[3] = $_POST['price3'];
$price[4] = $_POST['price4'];
$price[5] = $_POST['price5'];

// Calculate the total for each item
$total[1] = $qtty[1] * $price[1];
$total[2] = $qtty[2] * $price[2];
$total[3] = $qtty[3] * $price[3];
$total[4] = $qtty[4] * $price[4];
$total[5] = $qtty[5] * $price[5];

// Calculate the subtotal
$subTotal = array_sum($total);

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

    $word = numberToWord($subTotal);


// Create new mPDF instance
$mpdf = new \Mpdf\Mpdf();

// Your HTML template content
$html = '

        <p class="customer">CUSTOMER\'S COPY</p>

    <div class="logo"> 
        <img src="../../img/Picture1.jpg">
    </div>
    <h2 class="company"><b>KANCHONG REKA CIPTA ENTERPRISE</b></h2>
    <div class="address">
        <p>BATU 23 1/2, JALAN PULAI, KANCHONG DARAT, 42700 BANTING, SELANGOR DARUL EHSAN</p>
    </div>
    <p class="tel"><b> TEL: 017-654 8272 &nbsp; &nbsp;&nbsp;&nbsp; EMEL: krcbanting@gmail.com</b></p>
    <p class="invoice">INVOICE</p>

    <table class="table-1">
        <tr>
            <td rowspan="4" style="width: 45%; padding: 0; vertical-align: top;">
                <p class="pad0mar0">To:</p>
                <p class="pad0mar0">'.$compName.'</p>
                <p class="pad0mar0 wb">'.$compAddress.'</p>
            </td>
            <td rowspan="4" style="width:130x;"> </td>
            <td class="pad0">
                <table>
                    <tr>
                        <th style="text-align: start; width:150px; ">INVOICE NO:</th>
                        <td style="border: 1px solid black; width: 100px; text-align:center; padding: 0;">'.$newId.'</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td class="pad0">
                <table>
                    <tr>
                        <th style="text-align: start; width:150px;">INVOICE DATE:</th>
                        <td style="border: 1px solid black; width: 100px; text-align:center; padding: 0;">'.$date.'</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style=" padding: 0;">
                <table>
                    <tr>
                        <th style="text-align: start; width:150px;">TERMS (Days):</th>
                        <td style="border: 1px solid black; width: 100px; text-align:center; padding: 0;">'.$terms.'</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style=" padding: 0;">
                <table >
                    <tr>
                        <th style="text-align: start; width:150px;">DUE DATE: </th>
                        <td style="border: 1px solid black; width: 100px; text-align:center; padding: 0;">'.$dueDate.'</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <p style="margin-left: 5%; margin-bottom: 0;">Per:</p>
    <table border="0" style="margin-left: auto; margin-right: auto; border-spacing: 0; border: 2px solid black">
        <tr>
            <th style="width: 31px; border-bottom: 2px solid; border-right: 2px solid;">No.</th>
            <th style="width: 390px; border-bottom: 2px solid; border-right: 2px solid;">Particular</th>
            <th style="width: 45px; border-bottom: 2px solid; border-right: 2px solid;">Qtty</th>
            <th style="width: 115px; border-bottom: 2px solid; border-right: 2px solid;">Price/Unit</th>
            <th style="width: 110px; border-bottom: 2px solid;">Total</th>
        </tr>
        <tr>
            <div>
                <td style="text-align:center; border-top: 0; border-bottom: 0; border-right: 2px solid;">1.</td>
                <td style="border-top: 0; border-bottom: 0; border-right: 2px solid;">'.$particulars[1].'</td>
                <td style="border-top: 0; border-bottom: 0; border-right: 2px solid;">'.$qtty[1].'</td>
                <td style="border-top: 0; border-bottom: 0; border-right: 2px solid;">'.$price[1].'</td>
                <td style="border-top: 0; border-bottom: 0;">'.$total[1].'</td>
            </div>
        </tr>
        <tr>
            <div>
                <td style="text-align:center; border-top: 0; border-bottom: 0; border-right: 2px solid;">2.</td>
                <td style="border-top: 0; border-bottom: 0; border-right: 2px solid;">'.$particulars[2].'</td>
                <td style="border-top: 0; border-bottom: 0; border-right: 2px solid;">'.$qtty[2].'</td>
                <td style="border-top: 0; border-bottom: 0; border-right: 2px solid;">'.$price[2].'</td>
                <td style="border-top: 0; border-bottom: 0;">'.$total[2].'</td>
            </div>
        </tr>
        <tr>
            <div>
                <td style="text-align:center; border-top: 0; border-bottom: 0; border-right: 2px solid;">3.</td>
                <td style="border-top: 0; border-bottom: 0; border-right: 2px solid;">'.$particulars[3].'</td>
                <td style="border-top: 0; border-bottom: 0; border-right: 2px solid;">'.$qtty[3].'</td>
                <td style="border-top: 0; border-bottom: 0; border-right: 2px solid;">'.$price[3].'</td>
                <td style="border-top: 0; border-bottom: 0;">'.$total[3].'</td>
            </div>
        </tr>
        <tr>
            <div>
                <td style="text-align:center; border-top: 0; border-bottom: 0; border-right: 2px solid;">4.</td>
                <td style="border-top: 0; border-bottom: 0; border-right: 2px solid;">'.$particulars[4].'</td>
                <td style="border-top: 0; border-bottom: 0; border-right: 2px solid;">'.$qtty[4].'</td>
                <td style="border-top: 0; border-bottom: 0; border-right: 2px solid;">'.$price[4].'</td>
                <td style="border-top: 0; border-bottom: 0;">'.$total[4].'</td>
            </div>
        </tr>
        <tr>
            <div>
                <td style="text-align:center; border-top: 0; border-bottom: 0; border-right: 2px solid; height: 100px; vertical-align: top;">5.</td>
                <td style="border-top: 0; border-bottom: 0; border-right: 2px solid; vertical-align: top;">'.$particulars[5].'</td>
                <td style="border-top: 0; border-bottom: 0; border-right: 2px solid; vertical-align: top;">'.$qtty[5].'</td>
                <td style="border-top: 0; border-bottom: 0; border-right: 2px solid; vertical-align: top;">'.$price[5].'</td>
                <td style="border-top: 0; border-bottom: 0; vertical-align: top;">'.$total[5].'</td>
            </div>
        </tr>
    </table>

    <table border="0" style="border-spacing: 0; border: 0px solid black; margin-left: auto; margin-right: auto;margin-bottom: 0;">
        <tr>
            <td rowspan="3" style="width: 520px; padding:0;"></td>
            <td style="text-align: end; padding:0;">Subtotal:</td>
            <td style="width: 115px; text-align: center; padding:0;">'.$subTotal.'</td>
        </tr>
        <tr>
            <td style="text-align: end; padding:0;">Grand Total:</td>
            <td style="width: 90px; text-align: center; padding:0; border: 2px solid black">'.$subTotal.'</td>
        </tr>
    </table>
    <p style="margin-left: 5%; margin-bottom: 0; margin-top: 0;">AMOUNT:</p>
    <p style="margin-left: 5%; word-wrap: break-word; width: 500px; margin-top: 0; margin-bottom: 0;"><b>'. $word .' Ringgit Sahaja</b></p>
    <p style="margin-left: 5%; margin-top: 1px; margin-bottom: 0;">Payment Details:</p>
    <table style="margin-left: 5%;">
        <tr>
            <th style="text-align: start; width: 150px">Company Name</th>
            <td style="width: 50px;">:</td>
            <td>Kachong Reka Cipta</td>
        </tr>
        <tr>
            <th style="text-align: start;">Bank\'s Name</th>
            <td>:</td>
            <td>Maybank</td>
        </tr>
        <tr>
            <th style="text-align: start;">Account Number</th>
            <td>:</td>
            <td>5120 5300 1567</td>
        </tr>
        <tr>
            <th style="text-align: start;">Contact</th>
            <td>:</td>
            <td> 017-654 8272 ( Puan Husna )</td>
        </tr>
    </table>

    <table>
        <tr>
            <td rowspan="4" style="width: 600px"></td>
            <td style="text-align: center;"><b>Issued By:</b></td>
        </tr>
        <tr>
            <td style="text-align: center;">HASSAN BIN SOYUT</td>
        </tr>
        <tr>
            <td style="height: 40px;"></td>
        </tr>
        <tr>
            <td style="text-align: center;">( Manager )</td>
        </tr>
    </table>
';

// Add content
$stylesheet = file_get_contents('../../src/css/pdf.css');
$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);



$outputPath = 'C:/xampp/htdocs/SAS/views/invoice_pdf/'.$newId.'.pdf' ;
// Output PDF
$mpdf->Output($outputPath, \Mpdf\Output\Destination::FILE);

if (isset($_POST['submit'])) {
    
    $query = mysqli_query($con, "INSERT INTO debt VALUES ('$newId','$compName','$desc','$subTotal', '$subTotal','$date','$terms','$dueDate','CURRENT')");

    if($query){
        echo '<script> alert("The invoice have been saved."); window.location="sad_main.php"; </script>';
    } else{
        echo '<script> alert("There\'s an error."); window.location="sad_main.php"; </script>';
    }
}


?>
