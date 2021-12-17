<?php
require_once 'classes/db.php';
require_once 'classes/doctor.php';

session_start();

$uname = $_SESSION['username'];


if ($_SESSION['qualified'] == false) {
    $status = "You can't have an account here";
} else {
    $status = $uname;
}
$record_no = $_GET['varname'];

$_SESSION['record'] = $record_no;
$patient_no = $_GET['varname1'];
$patient_name = $_GET['varname2'];

// $_SESSION['number'] = $no;
// $_SESSION['doc_no'] = $doctor_no;

$db = Db::getInstance();

// $doctor_details = $db->getCommon('doctor', 'doctor_no', $doctor_no);
// $doctor_name = $doctor_details['doctor_name'];

$symptom_record = $db->getAll('symptom_record', 'patient_record_no', $record_no);
$reversed_record = array_reverse($symptom_record);

$doctor = new Doctor();

if (!empty($_POST)) {



    if (isset($_POST['comments'])) {
        $comments = $_POST['comments'];
    }
    if (isset($_POST['status'])) {
        $status = $_POST['status'];
    }


    if (
        $doctor->checkRecord($status, $comments, $reversed_record[0]['symptom_record_no'])
    ) {
        header("Location:doctordashboard.php");
    }
}


?>


<!DOCTYPE html>
<!-- Coding by CodingLab | www.codinglabweb.com-->
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <!--<title> Login and Registration Form in HTML & CSS | CodingLab </title>-->
    <link rel="stylesheet" href="patientsymptomsfordoctor.css">
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
     
<div class = "wrapper">
    <div class="container">
    <div>
              <input type="submit" id="input-box2" value="Home" onclick="redirecting2()" style ="font-size:18px"  />

              
        <script>
          function redirecting2() {
            location.replace("doctordashboard.php")

          }
        </script>
            </div>

            

            <br><br>

        

   
        <input type="checkbox" id="flip">

        <div class="forms">
            <div class="form-content">
                <div class="login-form">

                    <div class="title">
                        <h2> Record <?php echo $record_no ?></h2>

                    </div>
                    <h3>Patient <?php echo $patient_no . ' - '. $patient_name ?></h3>


                    <!-- <form  action="#" method="post"> -->

                    <div class="button input-box">
              <input name = "click" type="submit"  value="Confirm" />
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

                                <?php if($reversed_record[$y]['status'] == 'Pending'){ ?>
                                    <td><input type="text" id="comments" name='comments[]' placeholder = 'Enter your comments here'>  </td>
                                    <!-- <td><input type="Checkbox" name="status" value="yes" /> </td> -->
                                    <td><input type="checkbox" name="status[]" value="<? echo $reversed_record[$y]['symptom_record_id']; ?>"> </td>
                                <?php } else { ?>
                                
                                <td><?php echo $reversed_record[$y]['comments'] ?> </td>
                                <td><?php echo $reversed_record[$y]['status'] ?> </td>

                                <?php } ?>
                            </tr>
                        <?php
                            $y++;
                        }
                        ?>



                    </table>

                </div>


                <!-- </form> -->

            </div>
        </div>
        
    </div>
    </div>
    </div>
</body>

</html>