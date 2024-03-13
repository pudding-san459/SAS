
<?php
    include('../../src/config.php');
?>

<?php
    if (isset($_POST['view'])) {
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../src/css/pdf.css">
</head>
<body>

<br><br>
<form action="inc/generate_receipt.php" method="POST">
<div class="boxa" style="height: 10cm;">
    <table>
        <tr>
            <td style="width: 18cm;"><h1>KRC Receipt</h1></td>
            <td><p style="font-size: 20px;">No : <?php echo $newId; ?></p>  </td>
        </tr>
    </table>
    <p style="font-size: 20px;"><b>Date :</b> <?php echo $newDate; ?></p>
    <input type="hidden" name="date" value="<?php echo $date; ?>">
    <p style="font-size: 20px;"><b>Received From :</b> <?php echo $name; ?></p>
    <input type="hidden" name="comp_name" value="<?php echo $name; ?>">
    <p style="font-size: 20px;"><b>Payment Of :</b> <?php echo $invoice; ?></p>
    <input type="hidden" name="comp_inv" value="<?php echo $invoice; ?>">
    <p style="font-size: 20px;"><b>The sum of :</b> <?php echo $word; ?> Sahaja</p>
    <p style="font-size: 20px;"><b>Amount :</b> RM <?php echo $payment; ?></p>
    <input type="hidden" name="payment" value="<?php echo $payment; ?>">
    <br>
    <p>*This is computer generated, signature is not required.</p>
</div>
<center>
    <br>
    <button type="submit" class="butang" name="submit">Submit Invoice</button>
</center>
</form>


<?php
    }
?>