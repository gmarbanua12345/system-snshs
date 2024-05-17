<?php 
require_once ("../../include/initialize.php");
include 'tcpdf/tcpdf.php'; 
$IDNO = $_GET['id'];
$pageLayout = array(216,330);
$pdf = new TCPDF("P", "mm", $pageLayout, true, 'UTF-8', false);
$pdf->SetTitle('Form 137');
// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetMargins(5, 5, 0, 5);
$pdf->AddPage();
$pdf->SetAutoPageBreak(TRUE, 0);
$image =  '../../img/deped1.png';
$image2 =  '../../img/deped2.png';

$student = New Student();
$res = $student->single_student($IDNO);

$pdf->SetFont('calibri',null,10);
$pdf->Image($image, 25, 6,17);
$pdf->Cell(206,5,"Republic of the Philippines",0,1,'C', 0, '',1);
$pdf->Image($image2, 175, 5,25);
$pdf->Cell(206,5,"Department of Education",0,1,'C', 0, '',1);
$pdf->SetFont('calibri','B',14);
$pdf->Cell(206,5,"Learner's Permanent Record for Junior High School (SF10-JHS)",0,1,'C', 0, '',1);
$pdf->SetFont('calibri','I',10);
$pdf->Cell(206,5,"(Formerly Form 137)",0,1,'C', 0, '',1);

$pdf->SetFont('calibri','B',12);
$pdf->SetFillColor(255, 229, 204); // Set background color to yellow (RGB)
$pdf->Cell(206,5,"LEARNER'S INFORMATION",0,1,'C', 1, '',1);

$pdf->SetFont('calibri',null,9);
$pdf->Cell(18,5,"LAST NAME:",0,0,'C', 0, '',1);
$pdf->Cell(40,5,$res->LNAME,"B",0,'C', 0, '',1);
$pdf->Cell(18,5,"FIRST NAME:",0,0,'C', 0, '',1);
$pdf->Cell(40,5,$res->FNAME,"B",0,'C', 0, '',1);
$pdf->Cell(20,5,"NAME EXTN. (Jr., I, II)",0,0,'C', 0, '',1);
$pdf->Cell(10,5,$res->EXT,"B",0,'C', 0, '',1);
$pdf->Cell(18,5,"MIDDLE NAME:",0,0,'C', 0, '',1);
$pdf->Cell(40,5,$res->MNAME,"B",1,'C', 0, '',1);

$pdf->Cell(55,5,"Learner Reference Number (LRN):",0,0,'C', 0, '',1);
$pdf->Cell(26,5,$res->LR_NO,"B",0,'C', 0, '',1);
$pdf->Cell(40,5,"BIRTHDATE (mm/dd/yyyy):",0,0,'C', 0, '',1);
$formatted_date = date('m/d/Y', strtotime($res->BDAY));
$pdf->Cell(25,5,$formatted_date,"B",0,'C', 0, '',1);
$pdf->Cell(18,5,"SEX:",0,0,'C', 0, '',1);
$pdf->Cell(40,5,$res->SEX,"B",1,'C', 0, '',1);

$pdf->SetFont('calibri','B',12);
$pdf->Cell(206,5,"ELIGIBILITY FOR JHS ENROLMENT",0,1,'C', 1, '',1);

$pdf->SetFont('calibri',null,9);
$pdf->Cell(206,1,"","T,L,R",1,'C', 0, '',1);
$pdf->Cell(2,5,"","L",0,'C', 0, '',1);
$pdf->Cell(5,5,"",1,0,'C', 0, '',1);
$pdf->Cell(40,5,"Elementary School Completer",0,0,'L', 0, '',1);
$pdf->Cell(40,5,"General Average:",0,0,'R', 0, '',1);

$pdf->Cell(20,5,"","B",0,'C', 0, '',1);
$pdf->Cell(40,5,"Citation: (If Any)",0,0,'R', 0, '',1);
$pdf->Cell(40,5,"","B",0,'C', 0, '',1);
$pdf->Cell(19,5,"","R",1,'C', 0, '',1);

$pdf->Cell(7,5,"","L",0,'C', 0, '',1);
$pdf->Cell(40,5,"Name of Elementary School: ",0,0,'L', 0, '',1);
$pdf->Cell(50,5,"","B",0,'C', 0, '',1);
$pdf->Cell(20,5,"School ID:",0,0,'R', 0, '',1);
$pdf->Cell(20,5,"","B",0,'C', 0, '',1);
$pdf->Cell(30,5,"Address of School:",0,0,'R', 0, '',1);
$pdf->Cell(39,5,"","B,R",1,'C', 0, '',1);

$pdf->Cell(7,5,"","L",0,'C', 0, '',1);
$pdf->Cell(199,5,"Other Credential Presented","R",1,'L', 0, '',1);

$pdf->Cell(2,5,"","L",0,'C', 0, '',1);
$pdf->Cell(5,5,"",1,0,'C', 0, '',1);
$pdf->Cell(20,5,"PEPT Passer",0,0,'L', 0, '',1);
$pdf->Cell(20,5,"Rating:",0,0,'R', 0, '',1);
$pdf->Cell(20,5,"","B",0,'C', 0, '',1);
$pdf->Cell(2,5,"","",0,'C', 0, '',1);
$pdf->Cell(5,5,"",1,0,'C', 0, '',1);
$pdf->Cell(25,5,"ALS A & E Passer",0,0,'R', 0, '',1);
$pdf->Cell(20,5,"Rating:",0,0,'C', 0, '',1);
$pdf->Cell(20,5,"","B",0,'C', 0, '',1);
$pdf->Cell(2,5,"","",0,'C', 0, '',1);
$pdf->Cell(5,5,"",1,0,'C', 0, '',1);
$pdf->Cell(30,5,"Others (pls. Specify):",0,0,'C', 0, '',1);
$pdf->Cell(30,5,"","R,B",1,'C', 0, '',1);

$pdf->Cell(2,5,"","L",0,'C', 0, '',1);
$pdf->Cell(70,5,"Date of examination/Assessment (mm/dd/yyyy): ",0,0,'L', 0, '',1);
$pdf->Cell(30,5,"","B",0,'C', 0, '',1);
$pdf->Cell(50,5,"Name and Address of Testing Center: ",0,0,'L', 0, '',1);
$pdf->Cell(54,5,"","B,R",1,'C', 0, '',1);

$pdf->Cell(206,1,"","B,L,R",1,'C', 0, '',1);

$pdf->SetFont('calibri','B',12);
$pdf->Cell(206,5,"SCHOLASTIC RECORD",0,1,'C', 1, '',1);
$pdf->SetFont('calibri',null,10);



$gradesQuery = "SELECT * FROM schoolyr WHERE IDNO = ".$IDNO;
$gradeQuery = mysqli_query($mydb->conn,$gradesQuery) or die(mysqli_error($mydb->conn));
$n = 1;
$failed = 0;
$j = 1;
while ($row = mysqli_fetch_array($gradeQuery)) {
    if($j == 3 || $j == 5 || $j == 7){
        $pdf->AddPage();
    }
    $pdf->Cell(206,1,"","T,L,R",1,'C', 0, '',1);
    $pdf->Cell(20,5,"School: ","L",0,'L', 0, '',1);
    $pdf->Cell(50,5,"","B",0,'C', 0, '',1);
    $pdf->Cell(20,5,"School ID:",0,0,'R', 0, '',1);
    $pdf->Cell(20,5,"","B",0,'C', 0, '',1);
    $pdf->Cell(20,5,"Division:",0,0,'R', 0, '',1);
    $pdf->Cell(23,5,"","B",0,'C', 0, '',1);
    $pdf->Cell(15,5,"Region:",0,0,'R', 0, '',1);
    $pdf->Cell(38,5,"","B,R",1,'C', 0, '',1);

    $pdf->Cell(35,5,"Classified as Grade: ","L",0,'L', 0, '',1);
    $pdf->Cell(15,5,"","B",0,'C', 0, '',1);
    $pdf->Cell(20,5,"Section:",0,0,'R', 0, '',1);
    $pdf->Cell(15,5,"","B",0,'C', 0, '',1);
    $pdf->Cell(20,5,"School Year:",0,0,'R', 0, '',1);
    $pdf->Cell(15,5,$row['AY'],"B",0,'C', 0, '',1);
    $pdf->Cell(25,5,"Class Adviser:",0,0,'R', 0, '',1);
    $pdf->Cell(15,5,"","B",0,'C', 0, '',1);
    $pdf->Cell(20,5,"Signature:",0,0,'R', 0, '',1);
    $pdf->Cell(26,5,"","B,R",1,'C', 0, '',1);

    $pdf->Cell(206,1,"","B,L,R",1,'C', 0, '',1);

    $pdf->Cell(96,10,"LEARNING AREAS","L,B",0,'C', 0, '',1);
    $pdf->Cell(60,5,"Quarterly Rating","L,B",0,'C', 0, '',1);
    $pdf->Cell(20,5,"FINAL","L",0,'C', 0, '',1);
    $pdf->Cell(30,10,"REMARKS","L,B,R",0,'C', 0, '',1);
    $pdf->Cell(0,5,"",0,1,'L', 0, '',1);

    $pdf->Cell(96,0,"","L",0,'L', 0, '',1);
    $pdf->Cell(15,5,"1","L,B",0,'C', 0, '',1);
    $pdf->Cell(15,5,"2","L,B",0,'C', 0, '',1);
    $pdf->Cell(15,5,"3","L,B",0,'C', 0, '',1);
    $pdf->Cell(15,5,"4","L,B",0,'C', 0, '',1);
    $pdf->Cell(20,5,"RATING ","L,B",0,'C', 0, '',1);
    $pdf->Cell(30,0,"","L",0,'L', 0, '',1);
    $pdf->Cell(0,5,"","L",1,'L', 0, '',1);

    $sql = "SELECT * 
        FROM `tblstudent` st
        INNER JOIN `grades` g ON st.`IDNO` = g.`IDNO`
        INNER JOIN `subject` s ON g.`SUBJ_ID` = s.`SUBJ_ID`
        INNER JOIN `studentsubjects` ss ON s.`SUBJ_ID` = ss.`SUBJ_ID`
        WHERE st.`IDNO` = '{$IDNO}' 
        AND ss.`SY` = '".$row['AY']."'";
    $mydb->setQuery($sql);
    $cur = $mydb->loadResultList();
        
    $ga = 0;
    $count = 0;
    foreach ($cur as $result) {
        $pdf->Cell(96,5,$result->SUBJ_DESCRIPTION,"L,B",0,'L', 0, '',1);
        $pdf->Cell(15,5,$result->FIRST,"L,B",0,'C', 0, '',1);
        $pdf->Cell(15,5,$result->SECOND,"L,B",0,'C', 0, '',1);
        $pdf->Cell(15,5,$result->THIRD,"L,B",0,'C', 0, '',1);
        $pdf->Cell(15,5,$result->FOURTH,"L,B",0,'C', 0, '',1);
        $pdf->Cell(20,5,number_format($result->AVE,2),"L,B",0,'C', 0, '',1);
        $pdf->Cell(30,5,$result->REMARKS,"L,R,B",1,'C', 0, '',1);
        $ga = $ga + $result->AVE;
        $count++;
    }

    $general_average = $ga/$count;
    $pdf->Cell(96,5,"","L,B",0,'L', 0, '',1);
    $pdf->SetFont('calibri','I',10);
    $pdf->Cell(60,5,"General Average","L,B",0,'C', 0, '',1);
    $pdf->SetFont('calibri',null,10);
    $pdf->Cell(20,5,number_format($general_average,2),"L,B",0,'C', 0, '',1);
    $pdf->Cell(30,5,"","L,R,B",1,'C', 0, '',1);

    $pdf->Cell(206,2,"","B,L,R",1,'C', 1, '',1);

    $pdf->Cell(96,5,"Remedial Classes","L,B",0,'C', 0, '',1);
    $pdf->Cell(40,5,"Conducted from (mm/dd/yyyy)","L,B",0,'L', 0, '',1);
    $pdf->Cell(23,5,"____________","",0,'L', 0, '',1);
    $pdf->Cell(25,5,"to (mm/dd/yyyy)","",0,'C', 0, '',1);
    $pdf->Cell(22,5,"_______________","R,",1,'C', 0, '',1);

    $pdf->Cell(206,1,"","B,L,R",1,'C', 0, '',1);

    $pdf->Cell(96,5,"Learning Areas","L,B",0,'C', 0, '',1);
    $pdf->Cell(30,5,"Final Rating","L,B",0,'C', 0, '',1);
    $pdf->Cell(30,5,"Remedial Class Mark","L,B",0,'C', 0, '',1);
    $pdf->Cell(30,5,"Recomputed Final Grade ","L,B",0,'C', 0, '',1);
    $pdf->Cell(20,5,"Remarks","L,B,R",1,'L', 0, '',1);

    $pdf->Cell(96,5,"","L,B",0,'L', 0, '',1);
    $pdf->Cell(30,5,"","L,B",0,'C', 0, '',1);
    $pdf->Cell(30,5,"","L,B",0,'C', 0, '',1);
    $pdf->Cell(30,5,"","L,B",0,'C', 0, '',1);
    $pdf->Cell(20,5,"","L,B,R",1,'L', 0, '',1);

    $pdf->Cell(96,5,"","L,B",0,'L', 0, '',1);
    $pdf->Cell(30,5,"","L,B",0,'C', 0, '',1);
    $pdf->Cell(30,5,"","L,B",0,'C', 0, '',1);
    $pdf->Cell(30,5,"","L,B",0,'C', 0, '',1);
    $pdf->Cell(20,5,"","L,B,R",1,'L', 0, '',1);

    $j++;
}
$pdf->Cell(206,2,"",0,1,'C', 0, '',1);
$pdf->SetFont('calibri','B',11);
$pdf->Cell(206,5,"CERTIFICATION","T,R,L",1,'C', 0, '',1);
$pdf->SetFont('calibri',null,10);
$pdf->Cell(206,2,"","L,R",1,'C', 0, '',1);
$pdf->Cell(206,5,"I certify that this is a true record of ________________ with LRN ________________ and that he/she is eligible for admission to Grade","L,R",1,'L', 0,'',1);
$pdf->Cell(206,5,"Name of School:  _______________________________________ School ID: ______________ Last School Year Attended: _______________________","L,R",1,'L', 0,'',1);
$pdf->Cell(206,10,"","L,R",1,'C', 0, '',1);
$pdf->Cell(50,5,"____________________________","L",0,'C', 0, '',0);
$pdf->Cell(106,5,"_________________________________________________","",0,'C', 0, '',0);
$pdf->Cell(50,5,"","R",1,'C', 0, '',1);
$pdf->Cell(50,5,"Date","L,B",0,'C', 0, '',0);
$pdf->Cell(106,5,"Name of Principal/School Head over Printed Name","B",0,'C', 0, '',0);
$pdf->Cell(50,5,"(Affix School Seal here)","R,B",1,'C', 0, '',1);

ob_end_clean();
$pdf->Output();
?>