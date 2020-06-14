<?php
session_start();

// DATABASE CONNECTION //
$db = mysqli_connect("localhost" , "root" , "" , "brngy");

if(!$db) {
  die("Connection failed: ".mysqli_connect_error());
}
// DATABASE CONNECTION //

// LOGIN MODULE //
if(isset($_POST['login'])) {

  try {
        $uid = mysqli_real_escape_string($db,$_POST['username']);
        $password = mysqli_real_escape_string($db,$_POST['password']);

        $sql = "SELECT * FROM accounts WHERE username = '$uid' AND password = '$password'";
        $result = mysqli_query($db, $sql);

        if (!$row = $result->fetch_assoc()){
          echo "<script>alert('Username or Password is Incorrect ! ');window.location.href='index.php';</script>";
        }

        else {
                $_SESSION['emp_id'] = $row['uid'];
                $_SESSION['name_of_user'] = $row['name'];
                $sql = "SELECT * FROM accounts WHERE username = '$uid' and password = '$password' ";
                $result = mysqli_query($db, $sql);
                $row = $result->fetch_assoc();
                $_SESSION['username'] = $uid;

                if ($row['type'] === '1')
                      header("Location: managerec.php");

                elseif ($row['type'] === '0')
                      header("Location: errorpage.php");

                else
                echo "<script>alert('ERROR 0x1000');window.location.href='index.php';</script>";

                die();
            }
      } catch (Exception $e) {
          die("ERROR 0x1000 CONTACT DEVELOPER");
      }
  }
  // LOGIN MODULE //

  // ADD RECORD MODULE //
  if(isset($_POST['ADD_RECORD'])) {
      $full_name = $_POST["full_name"];
      $cur_address = $_POST["cur_address"];
      $per_address = $_POST["per_address"];
      $age = $_POST["age"];
      $sex = $_POST["sex"];
      $occupation = $_POST["occupation"];
      $civil_status = $_POST["civil_status"];
      $sql = "INSERT INTO
      records (full_name, cur_address	, per_address, age, sex, occupation, civil_status)
      VALUES ('$full_name', '$cur_address', '$per_address', '$age', '$sex', '$occupation', '$civil_status')";
      $result = mysqli_query($db, $sql);

      echo "<script>alert('ENTRY HAS BEEN ADDED');window.location.href='managerec.php';</script>";
  }
  // ADD RECORD MODULE //

  // VIEW INFO SESSION //
  if(isset($_POST["rec_id"]))
  {
    $rec_id = $_POST["rec_id"];
    $output = '';
    $sql = "SELECT * FROM records WHERE id = '".$rec_id."'";
    $result = mysqli_query($db, $sql);
    $output .= '
    ';
    while($row = mysqli_fetch_array($result))
    {
      $full_name = $row['full_name'];
      $cur_address = $row['cur_address'];
      $per_address = $row['per_address'];
      $age = $row['age'];
      $sex = $row['sex'];
      $occupation = $row['occupation'];
      $civil_status = $row['civil_status'];
         $output .= '
              <label>FULL NAME</label>
              <input type="text" class="form-control" value="'.$full_name.'" disabled>

              <label>CURRENT ADDRESS</label>
              <input type="text" class="form-control" value="'.$cur_address.'" disabled>

              <label>PERMANENT ADDRESS</label>
              <input type="text" class="form-control" value="'.$per_address.'" disabled>

              <label>AGE</label>
              <input type="text" class="form-control" value="'.$age.'" disabled>

              <label>GENDER</label>
              <input type="text" class="form-control" value="'.$sex.'" disabled>

              <label>OCCUPATION</label>
              <input type="text" class="form-control" value="'.$occupation.'" disabled>

              <label>CIVIL STATUS</label>
              <input type="text" class="form-control" value="'.$civil_status.'" disabled>
              ';
    }
      $output .= "
     ";
    echo $output;

  }
  // VIEW INFO SESSION //

  // INSUANCE INFO SESSION //
  if(isset($_POST["insuance_id"]))
  {
    $insuance_id = $_POST["insuance_id"];
    $output = '';
    $sql = "SELECT * FROM records WHERE id = '".$insuance_id."'";
    $result = mysqli_query($db, $sql);
    $output .= '
    ';
    while($row = mysqli_fetch_array($result))
    {
      $id = $row['id'];
      $full_name = $row['full_name'];
      $cur_address = $row['cur_address'];
      $per_address = $row['per_address'];
      $age = $row['age'];
      $sex = $row['sex'];
      $occupation = $row['occupation'];
      $civil_status = $row['civil_status'];
         $output .= '
              <form method="POST">
              <input type="text" class="form-control" name = "id" value="'.$id.'" hidden>
              <input type="text" class="form-control" value="'.$full_name.'" hidden>
              <input type="text" class="form-control" value="'.$cur_address.'" hidden>
              <input type="text" class="form-control" value="'.$per_address.'" hidden>
              <input type="text" class="form-control" value="'.$age.'" hidden>
              <input type="text" class="form-control" value="'.$sex.'" hidden>
              <input type="text" class="form-control" value="'.$occupation.'" hidden>
              <input type="text" class="form-control" value="'.$civil_status.'" hidden>
              <select name="forma" class="form-control">
               <option hidden>Choose one</option>
               <option id = "'.$insuance_id.'" value="Barangay Clearance">Barangay Clearance</option>
               <option id = "'.$insuance_id.'" value="Barangay Indigency">Barangay Indigency</option>
               <option id = "'.$insuance_id.'" value="Barangay Bonafide">Barangay Bonafide</option>
               <option id = "'.$insuance_id.'" value="Barangay Permits">Barangay Permits</option>
               <option id = "'.$insuance_id.'" value="Occupancy Permit">Occupancy Permit</option>
               <option id = "'.$insuance_id.'" value="Disbursement voucher">Disbursement voucher</option>
               <option id = "'.$insuance_id.'" value="Purchase Receipt">Purchase Receipt</option>
               <option id = "'.$insuance_id.'" value="Reimbursement Expense Receipt">Reimbursement Expense Receipt</option>
               <option id = "'.$insuance_id.'" value="Inspection Report">Inspection Report</option>
               <option id = "'.$insuance_id.'" value="Liquidation Report">Liquidation Report</option>
               <option id = "'.$insuance_id.'" value="Requisition and Issue Slip">Requisition and Issue Slip</option>
               <option id = "'.$insuance_id.'" value="Summary of Cash Payments">Summary of Cash Payments</option>
               <option id = "'.$insuance_id.'" value="Summary of Paid Petty Cash Vouchers">Summary of Paid Petty Cash Vouchers</option>
               <option id = "'.$insuance_id.'" value="Summary of Collections">Summary of Collections</option>
              </select>
              </form>
              ';
    }
      $output .= "
     ";
    echo $output;

  }
  // INSUANCE INFO SESSION //

  //ISSUE CERT//
  if(isset($_POST["ISSUE"]))
  {
    $selected = $_POST['forma'];
    $id = $_POST['id'];
    $date = date("M d D Y");
    if($selected == "Barangay Clearance")
    {
      $insuance = "Barangay Clearance";
      $sqlhis = "INSERT INTO history (rec_id, insuance, date) VALUES ('$id', '$insuance', '$date')";
      $resulthis = mysqli_query($db, $sqlhis);
    }
    if($selected == "Barangay Indigency")
    {
      $insuance = "Barangay Indigency";
      $sqlhis = "INSERT INTO history (rec_id, insuance, date) VALUES ('$id', '$insuance', '$date')";
      $resulthis = mysqli_query($db, $sqlhis);
    }
    if($selected == "Barangay Bonafide")
    {
      $insuance = "Barangay Bonafide";
      $sqlhis = "INSERT INTO history (rec_id, insuance, date) VALUES ('$id', '$insuance', '$date')";
      $resulthis = mysqli_query($db, $sqlhis);
    }
    if($selected == "Barangay Permits")
    {
      $insuance = "Barangay Permits";
      $sqlhis = "INSERT INTO history (rec_id, insuance, date) VALUES ('$id', '$insuance', '$date')";
      $resulthis = mysqli_query($db, $sqlhis);
    }
    if($selected == "Occupancy Permit")
    {
      $insuance = "Occupancy Permit";
      $sqlhis = "INSERT INTO history (rec_id, insuance, date) VALUES ('$id', '$insuance', '$date')";
      $resulthis = mysqli_query($db, $sqlhis);
    }
    if($selected == "Disbursement voucher")
    {
      $insuance = "Disbursement voucher";
      $sqlhis = "INSERT INTO history (rec_id, insuance, date) VALUES ('$id', '$insuance', '$date')";
      $resulthis = mysqli_query($db, $sqlhis);
    }
    if($selected == "Purchase Receipt")
    {
      $insuance = "Purchase Receipt";
      $sqlhis = "INSERT INTO history (rec_id, insuance, date) VALUES ('$id', '$insuance', '$date')";
      $resulthis = mysqli_query($db, $sqlhis);
    }
    if($selected == "Reimbursement Expense Receipt")
    {
      $insuance = "Reimbursement Expense Receipt";
      $sqlhis = "INSERT INTO history (rec_id, insuance, date) VALUES ('$id', '$insuance', '$date')";
      $resulthis = mysqli_query($db, $sqlhis);
    }
    if($selected == "Inspection Report")
    {
      $insuance = "Inspection Report";
      $sqlhis = "INSERT INTO history (rec_id, insuance, date) VALUES ('$id', '$insuance', '$date')";
      $resulthis = mysqli_query($db, $sqlhis);
    }
    if($selected == "Liquidation Report")
    {
      $insuance = "Liquidation Report";
      $sqlhis = "INSERT INTO history (rec_id, insuance, date) VALUES ('$id', '$insuance', '$date')";
      $resulthis = mysqli_query($db, $sqlhis);
    }
    if($selected == "Requisition and Issue Slip")
    {
      $insuance = "Requisition and Issue Slip";
      $sqlhis = "INSERT INTO history (rec_id, insuance, date) VALUES ('$id', '$insuance', '$date')";
      $resulthis = mysqli_query($db, $sqlhis);
    }
    if($selected == "Summary of Cash Payments")
    {
      $insuance = "Summary of Cash Payments";
      $sqlhis = "INSERT INTO history (rec_id, insuance, date) VALUES ('$id', '$insuance', '$date')";
      $resulthis = mysqli_query($db, $sqlhis);
    }
    if($selected == "Summary of Paid Petty Cash Vouchers")
    {
      $insuance = "Summary of Paid Petty Cash Vouchers";
      $sqlhis = "INSERT INTO history (rec_id, insuance, date) VALUES ('$id', '$insuance', '$date')";
      $resulthis = mysqli_query($db, $sqlhis);
    }
    if($selected == "Summary of Collections")
    {
      $insuance = "Summary of Collections";
      $sqlhis = "INSERT INTO history (rec_id, insuance, date) VALUES ('$id', '$insuance', '$date')";
      $resulthis = mysqli_query($db, $sqlhis);
    }
    $output = '';
    $sql = "SELECT * FROM records WHERE id = '".$id."'";
    $result = mysqli_query($db, $sql);
    while($row = mysqli_fetch_array($result))
    {
        if($selected == "Barangay Clearance")
        {
          $output .= '
          <style>
          @page {
              size: auto;   /* auto is the initial value */
              margin: 0;  /* this affects the margin in the printer settings */
          }
          </style>
          </head>
          </style>
          <div class="rezoom">
          <h5 align="center">Republic of the Philippines<br>Quezon City</h5>

          <b><p align="center" style="font-size: 25px; color: blue;">BARANGAY MATANDANG BALARA<br>Office of the Barangay</p></b>

          <table align="center">
            <tr>
              <th>
                <h4>CERTIFICATION<br>_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _</h4>
              </th>
            </tr>
            <tr>
              <td>
                <h3>TO WHOM IT MAY CONCERN:</h3>
                <br>
                <p style="text-align: justify;text-justify: inter-word;">This is to certify that <b>____<u>'.$row['full_name'].'</u>____</b> of legal age, married/single, Filipino is a bonafide resident of <b>____<u>'.$row['cur_address'].'</u>____</b> Barangay Matandang Balara, Quzon City,
                and that he/she has no derogatory / criminal records filled in this barangay.</p>
                <p>This Certification is issued upon his/her request for:</p>
                <input type="checkbox">Local Employment<br>
                <input type="checkbox">Overseas Employment<br>
                <input type="checkbox">Loans<br>
                <input type="checkbox">Wiring Permit<br>
                <input type="checkbox">___________<br>
                <br>
                <br>
                <b>Issued Date: '.date("M d D Y").'</b>
                <br>
                <br>
                <br>
                <br>
                <p align="right">_________________________<br>
                <b>Signature over printed name</b></p>
                <p>
                  Ref Court num:_______________ <br>
                  Issued at:____________________ <br>
                  Issued no:___________________
                </p>
              </td>
            </tr>
          </table>
          </div>
          <script type="text/javascript">
          <!--
          window.print();
          //-->
          </script>
          ';
          echo $output;
        }
        else if($selected == "Barangay Indigency")
        {
          $output .= '
          <style>
          @page {
              size: auto;   /* auto is the initial value */
              margin: 0;  /* this affects the margin in the printer settings */
          }
          </style>
          </head>
          </style>
          <div class="rezoom">
          <h5 align="center">Republic of the Philippines<br>Quezon City<br>BARANGAY MATANDANG BALARA</h5>

          <b><p align="center" style="font-size: 15px;"><u>OFFICE OF THE BARANGAY CHAIRMAN</u></p></b>

          <table align="center">
            <tr>
              <th>
                <h4>CERTIFICATION OF INDIGENCY<br>_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _</h4>
              </th>
            </tr>
            <tr>
              <td>
                <h3>TO WHOM IT MAY CONCERN:</h3>
                <br>
                <p style="text-align: justify;text-justify: inter-word;">
                This is to certify that <b>____<u>'.$row['full_name'].'</u>____</b> of '.$row['age'].' years old, '.$row['civil_status'].',
                Filipino and belongs to the indigent familt in this baragay. Moreover, this person has minimal means of livelihood to augment their needs supporting his
                children education.</p>
                <p>This certification is issues upon the request of the subject person for whatever legal purposes it may serve him this '.date("M d D Y").', this Barangay.</p>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <p align="right">__________________<br>
                <b>Barangay Chairman</b></p>
              </td>
            </tr>
          </table>
          </div>
          <script type="text/javascript">
          <!--
          window.print();
          //-->
          </script>
          ';
          echo $output;
        }
        else if($selected == "Barangay Bonafide")
        {
          $output .= '
          <style>
          @page {
              size: auto;   /* auto is the initial value */
              margin: 0;  /* this affects the margin in the printer settings */
          }
          </style>
          </head>
          </style>
          <div class="rezoom">
          <h5 align="center">Republic of the Philippines<br>Quezon City<br>BARANGAY MATANDANG BALARA</h5>

          <b><p align="center" style="font-size: 15px;"><u>OFFICE OF THE BARANGAY CHAIRMAN</u></p></b>

          <table align="center">
            <tr>
              <th>
                <h4>CERTIFICATION OF BONAFIDE<br>_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _</h4>
              </th>
            </tr>
            <tr>
              <td>
                <h3>TO WHOM IT MAY CONCERN:</h3>
                <br>
                <p style="text-align: justify;text-justify: inter-word;">
                This is to certify that '.$row['full_name'].' is a bonafide residence of Barangay Matandang Balara is one of the identified '.$row['occupation'].' in this Barangay.</p>
                <p>This certification is hereby issued upon the request of the interested party for whatever legal purpose it may serve.</p>
                <p>Issue this '.date("M d D Y").', At Barangay Matandang Balara.</p>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <p align="right">__________________<br>
                <b>Barangay Captain</b></p>
              </td>
            </tr>
          </table>
          </div>
          <script type="text/javascript">
          <!--
          window.print();
          //-->
          </script>
          ';
          echo $output;
        }
        else if($selected == "Barangay Permits")
        {
          $output .= '
          <style>
          @page {
              size: auto;   /* auto is the initial value */
              margin: 0;  /* this affects the margin in the printer settings */
          }
          </style>
          </head>
          </style>
          <div class="rezoom">
          <h5 align="center">Republic of the Philippines<br>Quezon City<br>BARANGAY MATANDANG BALARA</h5>

          <b><p align="center" style="font-size: 15px;"><u>OFFICE OF THE BARANGAY CHAIRMAN</u></p></b>

          <table align="center">
            <tr>
              <th>
                <h4>CERTIFICATION OF INDIGENCY<br>_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _</h4>
              </th>
            </tr>
            <tr>
              <td>
                <h3>TO WHOM IT MAY CONCERN:</h3>
                <br>
                <p style="text-align: justify;text-justify: inter-word;">
                  Pursuant to the provisions of the Local Government Code, Permission is HEREBY GRANTED to herein applicant as follows
                </p>
                <p>Name of Applicant: '.$row['full_name'].'</p>
                <p>Name of Business: </p>
                <p>Place of Business: </p>
                <p>Nature of Business: </p>
                <p>Remarks: ***CONSTRUCTION OF RESIDENTIAL BUILDING*** </p>
                <p>Granted this '.date("M d D Y").', at Barangay Matandang Balara. Valid until December 31 of this same year.</p>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <p align="right">__________________<br>
                <b>Barangay Captain</b></p>
              </td>
            </tr>
          </table>
          </div>
          <script type="text/javascript">
          <!--
          window.print();
          //-->
          </script>
          ';
          echo $output;
        }
        else if($selected == "Occupancy Permit")
        {
          $output .= '
          <style>
          @page {
              size: auto;   /* auto is the initial value */
              margin: 0;  /* this affects the margin in the printer settings */
          }
          </style>
          </head>
          </style>
          <div class="rezoom">
          <h5 align="center">Republic of the Philippines<br>Quezon City<br>BARANGAY MATANDANG BALARA</h5>

          <b><p align="center" style="font-size: 15px;"><u>OFFICE OF THE BARANGAY CHAIRMAN</u></p></b>

          <table align="center">
            <tr>
              <th>
                <h4>APPLICATION OF THE BUIDING OFFICIAL<br>_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _<br>
                <input type="checkbox"> FULL
                <input type="checkbox"> PARTIAL</h4>
              </th>
            </tr>
            <tr>
              <td>
                <h3>TO WHOM IT MAY CONCERN:</h3>
                <br>
                <p style="text-align: justify;text-justify: inter-word;">
                NAME OF OWNER/APPLICANT: <b>'.$row['full_name'].'</b><br>
                ADDRESS OF OWNER/APPLICANT: <b>'.$row['per_address'].'</b><br></p>
                <p align="center"><b>REQUIREMENTS SUBMITTED</b><br></p>
                <p>
                  <input type="checkbox"> AS-BUILT PLANS AND SPECIFICATIONS, DULY SIGNED AND SEALED BY RESPECTIVE PROFESSIONAL DISCIPLINE.<br>
                </p>
                <p>
                  <input type="checkbox"> DAILY CONSTRUCTION WORKS LOGBOOK.<br>
                </p>
                <p>
                  <input type="checkbox"> CERTIFICATE OF COMPLETION, DULY NOTARIZED.<br>
                </p>
                <p>
                  <input type="checkbox"> OTHERS (SPECIFY).<br>
                </p>
                <br>
                <br>
                <p>
                  NAME OF PROJECT:_____________________________<br>
                </p>
                <p>
                  LOCATION:____________________________________<br>
                </p>
                <p>
                  USE/CHARACTER OF OCCUPANCY: <br>
                </p>
                <p>
                  NO. OF STOREY: <br>
                </p>
                <p>
                  NO. OF UNITS<br>
                </p>
                <p>
                  TOTAL FLOOR AREA (SQM): <br>
                </p>
                <p>
                  DATE COMPLETION: <br>
                </p>
                <br>
                <br>
                <br>
                <br>
                <p>
                  SUBMITTED BY:<br>
                </p>
                <p align="right">__________________<br>
                <b>OWNER/APPLICANT</b><br>(SIGNATURE OVER PRINTED NAME)</p>
              </td>
            </tr>
          </table>
          </div>
          <script type="text/javascript">
          <!--
          window.print();
          //-->
          </script>
          ';
          echo $output;
        }
        else if($selected == "Disbursement voucher")
        {
          header("Location: template/disbursement.docx");
        }
        else if($selected == "Purchase Receipt")
        {
          header("Location: template/purchasereceipt.docx");
        }
        else if($selected == "Reimbursement Expense Receipt")
        {
          header("Location: template/reimbursereceipt.docx");
        }
        else if($selected == "Inspection Report")
        {
          header("Location: template/inspectionreport.docx");
        }
        else if($selected == "Liquidation Report")
        {
          header("Location: template/liquidation.docx");
        }
        else if($selected == "Requisition and Issue Slip")
        {
          header("Location: template/requisition.docx");
        }
        else if($selected == "Summary of Cash Payments")
        {
          header("Location: template/summaryofpayment.docx");
        }
        else if($selected == "Summary of Paid Petty Cash Vouchers")
        {
          header("Location: template/summaryofpayment.docx");
        }
        else if($selected == "Summary of Collections")
        {
          header("Location: template/summaryofpayment.docx");
        }










    }
  }
  //ISSUE CERT//

  // VIEW HISTORY SESSION //
  if(isset($_POST["history_id"]))
  {
    $history_id = $_POST['history_id'];
    $output = '';
    $sql = "SELECT * FROM history WHERE rec_id = '".$history_id."'";
    $result = mysqli_query($db, $sql);

    $output .= '
      <div class="table-responsive">
      <table id="example3" class="table table-striped table-bordered nowrap"  width="100%" cellspacing="0">
            <thead align="center">
              <tr>
                <th>CLAIMED</th>
                <th>DATE</th>
              </tr>
            </thead>
            <tbody align="center">
            <form method="POST">
    ';
    while($row = mysqli_fetch_array($result))
    {
         $output .= '
             <tr>
               <td>'.$row["insuance"].'</td>
               <td>'.$row["date"].'</td>
             </tr>
              ';
    }
      $output .= "
              </tbody>
            </table>
          </div>
     </form>
     <script>
     $(document).ready(function() {
        $.fn.DataTable.ext.pager.numbers_length = 5;
          $('#example3').DataTable( {
             'pagingType':'full_numbers'
          } );
       } );
     </script>
     ";
    echo $output;
  }
  // VIEW HISTORY SESSION //





?>
