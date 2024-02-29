
<?php
    include('../../src/config.php');
?>

<?php
    if (isset($_POST['view'])) {
        $name = $_POST['comp_name'];
        $address = $_POST['comp_address'];
        $date = $_POST['date'];
        $terms = $_POST['terms'];
        $desc = $_POST['desc'];

        $particulars = array();
        $qttys = array();
        $prices = array();
        $totals = array();
    
        for ($i = 1; $i <= 5; $i++) {
            $particulars[$i] = $_POST['particular' . $i];
            $qttys[$i] = intval($_POST['qtty' . $i]); // Convert string to integer
            $prices[$i] = floatval($_POST['price' . $i]); // Convert string to float
            // Calculate the total for each item
            $totals[$i] = $qttys[$i] * $prices[$i];
        }

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
        $dueDate = date('Y-m-d', strtotime($date . ' + ' . $terms . ' days'));

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
<form action="generate_pdf.php" method="post">
<div class="boxa">
    <p class="customer">CUSTOMER'S COPY</p>
    <img class="logo" src="../../img/Picture1.jpg">
    <h2 class="company"><b>KANCHONG REKA CIPTA ENTERPRISE</b></h2>
    <div class="address">
        <p>BATU 23 1/2, JALAN PULAI, KANCHONG DARAT, 42700 BANTING, SELANGOR DARUL EHSAN</p>
    </div>
    <p class="tel"><b> TEL: 017-654 8272 &nbsp; &nbsp;&nbsp;&nbsp; EMEL: krcbanting@gmail.com</b></p>
    <p class="invoice">INVOICE</p>

    <table class="table-1">
        <tr>
            <td rowspan="4" class="td1" style="width: 64%;">
                <p class="pad0mar0">To:</p>
                <p class="pad0mar0"><?php echo $name; ?></p>
                <input type="hidden" name="comp_name" value="<?php echo $name; ?>">
                <p class="padwb"><?php echo $address; ?></p>
                <input type="hidden" name="comp_address" value="<?php echo $address; ?>">

            </td>
            <td style=" padding: 0;">
                <table>
                    <tr>
                        <th style="text-align: start; width:150px; ">INVOICE NO:</th>
                        <td style="border: 1px solid black; width: 100px; text-align:center; padding: 0;"><?php echo $newId; ?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style=" padding: 0;">
                <table>
                    <tr>
                        <th style="text-align: start; width:150px;">INVOICE DATE:</th>
                        <td style="border: 1px solid black; width: 100px; text-align:center; padding: 0;"><?php echo $date; ?></td>
                        <input type="hidden" name="date" value="<?php echo $date; ?>">
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style=" padding: 0;">
                <table>
                    <tr>
                        <th style="text-align: start; width:150px;">TERMS (Days):</th>
                        <td style="border: 1px solid black; width: 100px; text-align:center; padding: 0;"><?php echo $terms; ?></td>
                        <input type="hidden" name="terms" value="<?php echo $terms; ?>">
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style=" padding: 0;">
                <table >
                    <tr>
                        <th style="text-align: start; width:150px;">DUE DATE: </th>
                        <td style="border: 1px solid black; width: 100px; text-align:center; padding: 0;"><?php echo $dueDate; ?></td>
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
        <?php
          for ($i=1; $i <= 5; $i++) { 

        ?>
        <tr>
            <td style="text-align:center; border-top: 0; border-bottom: 0; border-right: 2px solid;"><?php echo $i; ?>.</td>
            <td style="border-top: 0; border-bottom: 0; border-right: 2px solid;"><?php echo $particulars[$i]; ?></td>
            <input type="hidden" name="particular<?php echo $i; ?>" value="<?php echo $particulars[$i]; ?>">
            <td style="border-top: 0; border-bottom: 0; border-right: 2px solid;"><?php echo $qttys[$i]; ?></td>
            <input type="hidden" name="qtty<?php echo $i; ?>" value="<?php echo $qttys[$i]; ?>">
            <td style="border-top: 0; border-bottom: 0; border-right: 2px solid;"><?php echo $prices[$i]; ?></td>
            <input type="hidden" name="price<?php echo $i; ?>" value="<?php echo $prices[$i]; ?>">
            <td style="border-top: 0; border-bottom: 0;"><?php echo $totals[$i]; ?></td>
        </tr>
        <?php
          }  
          $subTotal = array_sum($totals);
        ?>
        <tr>
            <td style="text-align:center; border-top: 0; border-bottom: 0; border-right: 2px solid; height: 100px;"></td>
            <td style="border-top: 0; border-bottom: 0; border-right: 2px solid;"></td>
            <td style="border-top: 0; border-bottom: 0; border-right: 2px solid;"></td>
            <td style="border-top: 0; border-bottom: 0; border-right: 2px solid;"></td>
            <td style="border-top: 0; border-bottom: 0;"></td>
        </tr>
    </table>

    <table border="0" style="border-spacing: 0; border: 0px solid black; margin-left: auto; margin-right: auto;margin-bottom: 0;">
        <tr>
            <td rowspan="3" style="width: 520px; padding:0;"></td>
            <td style="text-align: end; padding:0;">Subtotal:</td>
            <td style="width: 115px; text-align: center; padding:0;"><?php echo $subTotal; ?></td>
        </tr>
        <tr>
            <td style="text-align: end; padding:0;">Grand Total:</td>
            <td style="width: 90px; text-align: center; padding:0; border: 2px solid black"><?php echo $subTotal; ?></td>
        </tr>
    </table>
    <input type="hidden" name="desc" value="<?php echo $desc; ?>">
    <?php 

    } 
    $word = numberToWord($subTotal);

    ?>
    <p style="margin-left: 5%; margin-bottom: 0; margin-top: 0;">AMOUNT:</p>
    <p style="margin-left: 5%; word-wrap: break-word; width: 500px; margin-top: 0; margin-bottom: 0;"><b><?php echo $word. ' Ringgit Sahaja'; ?></b></p>
    <p style="margin-left: 5%; margin-top: 1px; margin-bottom: 0;">Payment Details:</p>
    <table style="margin-left: 5%;">
        <tr>
            <th style="text-align: start; width: 150px">Company Name</th>
            <td style="width: 50px;">:</td>
            <td>Kachong Reka Cipta</td>
        </tr>
        <tr>
            <th style="text-align: start;">Bank's Name</th>
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
</div>
<center>
    <br>
    <button type="submit" class="butang" name="submit">Submit Invoice</button>
</center>
</form>
