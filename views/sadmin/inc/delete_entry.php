<?php
// Include database connection
include('../../../src/config.php');

// Check if the form is submitted
if (isset($_POST['delete_debt']) || isset($_POST['delete_credit'])) {
    // Get the invoice number from the form
    $invoice = $_POST['invoice'];

    // Determine the table based on the action
    $table = isset($_POST['delete_debt']) ? 'debt' : 'credit';
    
    // Prepare the delete query
    $delete_query = "DELETE FROM $table WHERE ";
    $delete_query .= ($table == 'debt') ? "debt_invoice" : "cred_invoice";
    $delete_query .= " = '$invoice'";

    // If it's a credit entry, retrieve the amount before deletion
    if ($table == 'credit') {
        $credit_amount_query = "SELECT * FROM credit WHERE cred_invoice = '$invoice'";
        $credit_result = mysqli_query($con, $credit_amount_query);
        $credit_row = mysqli_fetch_assoc($credit_result);
        $credit_amount = $credit_row['amount'];
        $credit_payment = $credit_row['payment_of'];
        $debt_amount_query = "SELECT * FROM debt WHERE debt_invoice = '$credit_payment'";
        $debt_result = mysqli_query($con, $debt_amount_query);
        $debt_row = mysqli_fetch_assoc($debt_result);
        $debt_amount = $debt_row['amount'];
        $debt_status = $debt_row['status'];

        $new_amount = $debt_amount + $credit_amount;


        // Update the corresponding debt entry with the credit amount
        $update_debt_query = "UPDATE debt SET amount = '$new_amount' WHERE debt_invoice = '$credit_payment'";
        mysqli_query($con, $update_debt_query);
    }

    // Delete PDF file
    $pdf_file_path = ($table == 'debt') ? "../../invoice_pdf/" : "../../payment_pdf/";
    $pdf_file = $pdf_file_path . $invoice . ".pdf";

    if (file_exists($pdf_file)) {
        unlink($pdf_file); // Delete the PDF file
    }

    // Execute the delete query
    $result = mysqli_query($con, $delete_query);

    // Check if deletion was successful
    if ($result) {
        echo '<script> alert("Entry and PDF file deleted successfully."); window.location="../sad_general.php"; </script>';
    } else {
        echo '<script> alert("Error deleting entry."); window.location="../sad_general.php"; </script>';
    }
} else {
    // Redirect to main page if accessed without proper form submission
    header("Location: ../sad_main.php");
    exit();
}
?>
