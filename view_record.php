<?php
require_once 'classes/db.php';
session_start();

$uname = $_SESSION['username'];
$var=1;
$var2=1;


if ($_SESSION['qualified'] == false) {
    $status = "You can't have an account here";
} else {
    $status = $uname;
}
$record_no = $_GET['varname'];

$_SESSION['record'] = $record_no;
$no = $_GET['varname1'];
$doctor_no = $_GET['varname2'];

$_SESSION['number'] = $no;
$_SESSION['doc_no'] = $doctor_no;

$db = Db::getInstance();

$doctor_details = $db->getCommon('doctor', 'doctor_no', $doctor_no);
$doctor_name = $doctor_details['doctor_name'];

$symptom_record_details=$db->getCommon('patient_record','patient_record_no',$record_no);
$end_date=$symptom_record_details['end_date'];
$today=date('Y-m-d');

$symptom_record_no=$db->getMax('symptom_record','symptom_record_no',$record_no,'patient_record_no');
$symptom_details=$db->getCommon('symptom_record','symptom_record_no',$symptom_record_no);
$date=$symptom_details['date'];

$status=$symptom_record_details['status'];

if($date==$today){
    $var2=0;
}

if($end_date<$today){
    $var=0;
    if($status!='closed'){//quarantine time expired
        $status='closed';
        $result=$db->updateSimple('patient_record','status','patient_record_no',$status,$record_no);
    }
    
}

$symptom_record = $db->getAll('symptom_record', 'patient_record_no', $record_no);

$reversed_record = array_reverse($symptom_record);





?>


<!DOCTYPE html>
<!-- Coding by CodingLab | www.codinglabweb.com-->
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <!--<title> Login and Registration Form in HTML & CSS | CodingLab </title>-->
    <link rel="stylesheet" href="view_record2.css">
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
<!-- <div >
              <input type="submit" id="input-box3" value="Update Symptoms" onclick="redirecting1()" style="font-size:16px" />

              
        <script>
          function redirecting1() {
            location.replace("symptom_record.php")

          }
        </script>
            </div> -->
    <div class="container">
    <div >
              <input type="submit" id="input-box5" value="View your evidence report" onclick="redirecting4()" style="font-size:16px" <?php if($var!=0){?> hidden <?php }?> />

              
        <script>
          function redirecting4() {
            location.replace("pdf.php")

          }
        </script>
        <div >
              <input type="submit" id="input-box3" value="Update Symptoms" onclick="redirecting1()" style="font-size:16px" <?php if($var==0){?> hidden <?php }?> />

              
        <script>
          function redirecting1() {
            location.replace("updatesymptom.php")

          }
        </script>
            </div>

            <div >
              <input type="submit" id="input-box4" value="Close Record" onclick="redirecting3()" style="font-size:16px" <?php if($var==0){?> hidden <?php }?> />

              
        <script>
          function redirecting3() {
            location.replace("submitreport.php")

          }
        </script>
            </div>
    
    <div >
              <input type="submit" id="input-box2" value="Home" onclick="redirecting2()" style ="font-size:18px"  />

              
        <script>
          function redirecting2() {
            location.replace("patient_dashboard.php")

          }
        </script>
            </div>

            

            <br><br>

        

   
        <input type="checkbox" id="flip">


        <div class="forms">
            <div class="form-content">
                <div class="login-form">
                    <div class="title">
                        <h2> Record <?php echo $no ?></h2>

                    </div>
                    <h3>Assigned Doctor-<?php echo $doctor_name ?></h3>
                    <h3>Status-<?php echo $status ?></h3>

                    <div class="button input-box">
              <input type="submit" value="Record your symptom" onclick="redirecting()"  <?php if($var==0){?> hidden <?php }?> <?php if($var2==0){?> disabled <?php }?>/>

              
        <script>
          function redirecting() {
            location.replace("symptom_record.php")

          }
        </script>
            </div>

           

            
                    <br> <br>

                    <table>

                        <tr>
                            <th>Day</th>
                            <th class="date">Date</th>
                            <th>Oxygen Saturation</th>
                            <th>Pressure</th>
                            <th>Pulse Rate</th>
                            <th>Temperature</th>
                            <th>Shortness of breathe</th>
                            <th>Fever</th>
                            <th>Sore Throat</th>
                            <th>Chills & Body Aches</th>
                            <th>Confusion</th>
                            <th>Nausea,Vomitting,Diarrhea</th>
                            <th>Runny nose</th>
                            <th>Redness of eyes</th>
                            <th>Headache</th>
                            <th>Loss of taste or smell</th>
                            <th>Doubts</th>
                            <th>Comments</th>
                            <th>Status</th>

                        </tr>
                        <?php
                        $y = 0;

                        while ($y < count($reversed_record)) {
                        ?>
                            <tr>
                                <td><?php echo count($reversed_record) - $y ?> </td>

                                <td><?php echo $reversed_record[$y]['date'] ?> </td>
                                <td><?php echo $reversed_record[$y]['oxygen'] ?> </td>
                                <td><?php echo $reversed_record[$y]['pressure1'] ?>/<?php echo $reversed_record[$y]['pressure2'] ?> </td>
                                <td><?php echo $reversed_record[$y]['pulse'] ?> </td>
                                <td><?php echo $reversed_record[$y]['temperature'] ?> </td>
                                <td><?php if ($reversed_record[$y]['breathe'] == "yes") { ?><span>&#9989;</span>
                                    <?php ;
                                    } else { ?><span>&#10060;</span><?php ;
                                                                    } ?> </td>
                                <td><?php if ($reversed_record[$y]['fever'] == "yes") { ?><span>&#9989;</span>
                                    <?php ;
                                    } else { ?><span>&#10060;</span><?php ;
                                                                    } ?> </td>
                                <td><?php if ($reversed_record[$y]['throat'] == "yes") { ?><span>&#9989;</span>
                                    <?php ;
                                    } else { ?><span>&#10060;</span><?php ;
                                                                    } ?> </td>
                               <td><?php if ($reversed_record[$y]['body_ache'] == "yes") { ?><span>&#9989;</span>
                                    <?php ;
                                    } else { ?><span>&#10060;</span><?php ;
                                                                    } ?> </td>
                                <td><?php if ($reversed_record[$y]['confusion'] == "yes") { ?><span>&#9989;</span>
                                    <?php ;
                                    } else { ?><span>&#10060;</span><?php ;
                                                                    } ?> </td>
                                <td><?php if ($reversed_record[$y]['vomit'] == "yes") { ?><span>&#9989;</span>
                                    <?php ;
                                    } else { ?><span>&#10060;</span><?php ;
                                                                    } ?> </td>
                                <td><?php if ($reversed_record[$y]['nose'] == "yes") { ?><span>&#9989;</span>
                                    <?php ;
                                    } else { ?><span>&#10060;</span><?php ;
                                                                    } ?> </td>
                               <td><?php if ($reversed_record[$y]['eyes'] == "yes") { ?><span>&#9989;</span>
                                    <?php ;
                                    } else { ?><span>&#10060;</span><?php ;
                                                                    } ?> </td>
                                <td><?php if ($reversed_record[$y]['headache'] == "yes") { ?><span>&#9989;</span>
                                    <?php ;
                                    } else { ?><span>&#10060;</span><?php ;
                                                                    } ?> </td>
                                <td><?php if ($reversed_record[$y]['taste'] == "yes") { ?><span>&#9989;</span>
                                    <?php ;
                                    } else { ?><span>&#10060;</span><?php ;
                                                                    } ?> </td>
                                <td><?php echo $reversed_record[$y]['doubt'] ?> </td>
                                <td><?php echo $reversed_record[$y]['comments'] ?> </td>
                                <td><?php echo $reversed_record[$y]['status'] ?> </td>


                            </tr>
                        <?php
                            $y++;
                        }
                        ?>



                    </table>

                </div>



            </div>
        </div>
        
    </div>
    </div>
</body>

</html>