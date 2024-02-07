<?php
require '../connect.php';

// Check if form was submitted and exam was set
if (isset($_POST['exam'])) {
    // Include TCPDF library
    require_once('tcpdf/tcpdf.php'); // Adjust the path as needed

    // create new PDF document
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Your Name');
    $pdf->SetTitle('Supervision Schedule');
    $pdf->SetSubject('Supervision Schedule Details');
    $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

    // set default header data
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING);

    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // add a page
    $pdf->AddPage();

    // set font
    $pdf->SetFont('helvetica', '', 10);

    // Fetch data and prepare HTML content
    $e = $_POST["exam"];
    $ay = $_POST['ay'];
    $dates = array(); // Store unique dates
    $professors = array(); // Store unique professors

    // Fetch data for 'js' role
    $sql = "SELECT * FROM allotment WHERE e_id='$e' AND a_year='$ay' AND role='js';";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $resultt = $result->fetch_all(MYSQLI_ASSOC);

        // Collect unique dates and professors
        foreach ($resultt as $row) {
            $dates[] = $row['date'];
            $professors[$row['p_id']] = $row['p_id'];
        }

        // Display dates in header
        foreach (array_unique($dates) as $date) {
            $pdf->Cell(40, 10, $date, 1);
        }

        // Move to the next line after the header
        $pdf->Ln();

        // Display professor names and ticks
        foreach ($professors as $profId) {
            $profSql = "SELECT * FROM professor WHERE p_id='$profId'";
            $profResult = mysqli_query($conn, $profSql);
            $profData = mysqli_fetch_assoc($profResult);

            $pdf->Cell(40, 10, $profData['name'], 1);

            foreach (array_unique($dates) as $date) {
                $tickSql = "SELECT * FROM allotment WHERE e_id='$e' AND a_year='$ay' AND p_id='$profId' AND date='$date';";
                $tickResult = mysqli_query($conn, $tickSql);

                if (mysqli_num_rows($tickResult) > 0) {
                    $pdf->Cell(40, 10, '✔', 1);
                } else {
                    $pdf->Cell(40, 10, '', 1);
                }
            }

            // Move to the next line for the next professor
            $pdf->Ln();
        }

        // Output the PDF
        $pdf->Output('supervision_schedule.pdf', 'D'); // D for download
    } else {
        echo "No data found";
    }

    // Stop further execution of the script
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<!-- Rest of your HTML code remains unchanged -->

</html>
