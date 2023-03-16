<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// require 'Admin/mail/src/Exception.php';
// require 'Admin/mail/src/PHPMailer.php';
// require 'Admin/mail/src/SMTP.php';
session_start();
$pageTitle = "index";
include 'init.php';




// if (!isset($_SESSION['existGood']) || !isset($_SESSION['email']) || !isset($_SESSION['role'])) {
//     header('Location: login.php'); // redirect To login Page
// }
// if ($_SESSION['role'] == 'Responsible') {

$formations = getFormationResponsible($_SESSION['matricule']);
if (count($formations) > 0) {

    $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

    if ($do == 'Manage') {
        // manage page formation
        ?>

        <div class="page-content container">
            <div class="mb-3">
                <h2>you are responsible of these trainings</h2>
            </div>
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr class="align-middle">
                        <th class="id_formation">#</th>
                        <th class="name_formation">formation name</th>
                        <th class="name_formation">formation categorie</th>
                        <th class="date_start">date</th>
                        <th class="duree_formation text-center">duree(h)</th>
                        <th class="contoll text-center">Controll</th>

                    </tr>
                </thead>
                <tbody id="table_body">
                    <?php
                    foreach ($formations as $formation) {

                        $num = numberOfGroup($formation['id_formation']);
                        $x = $num + 1;
                        echo "<tr class='align-middle'>";
                        echo '<th scope="row" class="id_formation" >' . $formation['id_formation'] . '</th>';
                        echo '<td class="name_formation">' . $formation['nom_formation'] . '</td>';
                        echo '<td class="name_formation">' . $formation['categorie_formation'] . '</td>';
                        echo '<th class="date_start">' . $formation['date_debut'] . '</th>';
                        echo '<th class="duree_formation text-center">' . $formation['hours_formation'] . '</th>';
                        echo '<th class="contoll d-flex justify-content-around">';

                        echo '<form action="?do=Add" method="post">';
                        echo '<input type="hidden" name="id_formation" style="display:none;" value="' . $formation['id_formation'] . '">';
                        echo '<input type="hidden" name="numberGroup" style="display:none;" value="' . $x . '">';
                        if ($num == 0) {
                            echo '<button type="submit" class="btn btn-primary"> Create a Group</button>';
                        } else {
                            echo '<button type="submit" class="btn btn-primary"> Add a Group ' . $x . '</button>';
                        }
                        echo '</form>';
                        echo '<form action="?do=Details" method="post">';
                        echo '<input type="hidden" name="id_formatione" value="' . $formation['id_formation'] . '">';
                        echo '<input type="hidden" name="numberGroupe" style="display:none;" value="' . $num . '">';
                        echo '<button type="submit" class="btn btn-success">Details</button>';
                        echo '</form>';
                        echo '</th>';
                        echo '</tr>';
                    }
                    ?>

                </tbody>
            </table>


        </div>
        <?php
    } elseif ($do == 'Add') {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_formation']) && isset($_POST['numberGroup'])) {

        ?>
            <div class="page-content container">
                <form action="?do=Insert" method="POST">
                    <input type="hidden" name="id_formation" id="id_formation" value="<?php echo $_POST['id_formation']; ?>">
                    <input type="hidden" name="numberGroup" value="<?php echo $_POST['numberGroup']; ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="mb-2">
                                        <!-- <label for="group1" class="form-label">Group 1.</label> -->
                                        <h3>GROUP <?php echo $_POST['numberGroup']; ?>.</h2>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="date" class="form-label">Date Of The Formation</label>
                                        <input type="date" required placeholder="choose day of the formation" onchange="addgroup()" id="date" name="date" class="form-control input-shadow">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="heureStart" class="form-label">heure start</label>
                                        <input type="time" required placeholder="choose day of the formation" id="heureStart" onchange="addgroup()" name="heureStart" class="form-control input-shadow">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="heureFin" class="form-label">heure fin</label>
                                        <input type="time" required placeholder="choose day of the formation" onchange="addgroup()" id="heureFin" name="heureFin" class="form-control input-shadow">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3" id="listGroup">
                                        <select id="mySelect" name="participants[]" required class="select2 form-control input-shadow" multiple>
                                            <Option disabled>You Must firstly Choose daye and time</Option>
                                            <?php

                                            ?>
                                        </select>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
                    <div class="col-md-6">
                        <!-- <div class="row ">   
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-primary" onclick="addgroup()">Add Group</button>
                                    </div> -->
                        <div class="col-md-6 d-flex justify-content-end">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                        <!-- </div> -->
                    </div>
            </div>
            </form>
            </div>
        <?php

        } else {
            header("Location: index.php ");
        }
    } elseif ($do == 'Insert') {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_formation'])) {

            $ae = explode("-", $_POST['date']);
            $ab = explode(":", $_POST['heureStart']);
            $ac = explode(":", $_POST['heureFin']);

            if (
                is_numeric($ae[0]) && is_numeric($ae[0]) && is_numeric($ae[2])
                && is_numeric($ab[0]) && is_numeric($ab[1])
                && is_numeric($ac[0]) && is_numeric($ac[1])
            ) {

                $cont = InsertGroup($_POST['participants'], $_POST['id_formation'], $_POST['date'],  $_POST['heureStart'], $_POST['heureFin'], $_POST['numberGroup']);
                echo $cont;
            } else {
                $url = $_SERVER['HTTP_REFERER'];
                header("Location: index.php");
            }
        }
    } elseif ($do == "Details") {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_formatione'])) {
        ?>
            <div class="page-content container">

                <div class="mx-auto text-center mb-4">
                    <h2>Formation <?php echo $_POST['id_formatione'] ?> has a <?php echo $_POST['numberGroupe'] ?> group</h2>
                </div>
                <?php
                for ($i = 1; $i <= $_POST['numberGroupe']; $i++) {
                    $stmt = $con->prepare(" SELECT employe.* , partisipe.timeStart, partisipe.timeFin, partisipe.date , partisipe.id
                                            FROM partisipe 
                                            INNER JOIN employe ON employe.Matricule=partisipe.Matricule
                                            WHERE partisipe.id_formation  = ? 
                                            AND partisipe.groupe = ?");
                    $stmt->execute(array($_POST['id_formatione'], $i));
                    $formations = $stmt->fetchAll();

                ?>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="mb-2">
                                        <h3>GROUP <?php echo $i; ?></h2>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="date" class="form-label">Date Of The Formation</label>
                                        <input type="date" disabled class="form-control input-shadow" value="<?php echo $formations[($i - 1)]['date'] ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="heureStart" class="form-label">heure start</label>
                                        <input type="time" disabled class="form-control input-shadow" value="<?php echo $formations[($i - 1)]['timeStart'] ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="heureFin" class="form-label">heure fin</label>
                                        <input type="time" disabled class="form-control input-shadow" value="<?php echo $formations[($i - 1)]['timeFin'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="footer-body d-flex justify-content-around">
                                <form action="imprimer.php" method="post">
                                    <input type="hidden" name="Iid_formation" value="<?php echo $_POST['id_formatione'] ?>">
                                    <input type="hidden" name="Igroupe" value="<?php echo $i; ?>">
                                    <button class="btn btn-primary">Imprimper</button>
                                </form>
                                <a class="btn btn-primary " href="?do=sendMails&id_formation=<?php echo $_POST['id_formatione'] ?>&group=<?php echo $i; ?>">Sens Emails</a>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="table-responsive-y">
                                <table class="table table-striped table-hover table-bordered">
                                    <thead>
                                        <tr class="align-middle">
                                            <th class="id_formation">M</th>
                                            <th class="name_formation">formation name</th>
                                            <th class="name_formation">formation categorie</th>
                                            <th class="control">EvaluationChaud</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table_body">
                                        <?php
                                        foreach ($formations as $formation) {
                                        ?>
                                            <tr>
                                                <td class="id_formation align-middle"><?php echo $formation['Matricule']  ?></td>
                                                <td class="name_formation align-middle"><?php echo $formation['Nom']  ?></td>
                                                <td class="name_formation align-middle"><?php echo $formation['Prenom']  ?></td>
                                                <td class="text-center"><a class="btn btn-primary" href="?do=view&idP=<?php echo $formation['id']?>">show</a></td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                <?php
                } // end boucle for
                ?>
            </div>
        <?php
        } else {
            header("Location: index.php");
        }
    } elseif ($do == 'Imprimer') {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Iid_formation'])) {
            $stmt = $con->prepare(" SELECT employe.* , partisipe.timeStart, partisipe.timeFin, partisipe.date 
            FROM partisipe 
            INNER JOIN employe ON employe.Matricule=partisipe.Matricule
            WHERE partisipe.id_formation  = ? 
            AND partisipe.groupe = ?");
            $stmt->execute(array($_POST['Iid_formation'], $_POST['Igroupe']));
            $formations = $stmt->fetchAll();
        ?>
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr class="align-middle">
                        <th class="id_formation">#</th>
                        <th class="name_formation">formation name</th>
                        <th class="name_formation">formation categorie</th>
                    </tr>
                </thead>
                <tbody id="table_body">
                    <?php
                    foreach ($formations as $formation) {
                    ?>
                        <tr>
                            <td class="id_formation"><?php echo $formation['Matricule']  ?></td>
                            <td class="name_formation"><?php echo $formation['Nom']  ?></td>
                            <td class="name_formation"><?php echo $formation['Prenom']  ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        <?php
        } else {
            header("Location: index.php");
        }
    } elseif ($do == 'sendMails') {
        if (isset($_GET['group']) && isset($_GET['id_formation'])) {


            $stmt = $con->prepare("SELECT * 
                                    FROM employe
                                    INNER JOIN `partisipe` ON employe.Matricule = partisipe.Matricule
                                    WHERE partisipe.groupe = ?
                                    AND partisipe.id_formation = ?");
            $stmt->execute(array($_GET['group'], $_GET['id_formation']));
            $Employes = $stmt->fetchAll();

            foreach ($Employes as $Employe) {
                // echo $Employe['Nom'] . " " . $Employe['Prenom'] . " " . $Employe['email'] . "</br>";
                if (!empty($Employe['email'])) {

                    //  Plusieurs destinataires
                    $to  = $Employe['email']; // notez la virgule


                    // $to = 'yourmailid@gmail.com';
                    $subject = "Beautiful HTML Email using PHP by Discussdesk";
                    // Get HTML contents from file
                    $htmlContent = file_get_contents("Admin/template.html");

                    // Set content-type for sending HTML email
                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                    // Additional headers
                    $headers .= 'From: discussdesk<discussdesk@gmail.com>' . "\r\n";
                    $headers .= 'Cc: discussdesk@gmail.com ' . "\r\n";


                    $mail = new PHPMailer(true);
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'astitoumd@gmail.com';
                    $mail->Password = 'psastfwwwpryytvn';
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port = 465;
                    $mail->setFrom('astitoumd@gmail.com');
                    $mail->addAddress($to);
                    $mail->isHTML(true);
                    $mail->Subject = 'test subject';
                    $mail->Body = '
                        <html>
                            <head>
                            </head>
                            <body>
                            <form target="_blank" action="http://localhost:8080/server/GestionFormation/EvaluationChaud.php" method="post">
                                <input type="hidden" name="Matricule" value="' . $Employe['Matricule'] . '" />
                                <input type="hidden" name="Code" value="' . $Employe['code'] . '" />
                                <button type="submit"> send</button>
                            </form>
                            <div style="font-family:HelveticaNeue-Light,Arial,sans-serif;background-color:#eeeeee">
                                <table align="center" width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <table align="center" width="750px" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee"
                                                    style="width:750px!important">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <table width="690" align="center" border="0" cellspacing="0" cellpadding="0"
                                                                    bgcolor="#eeeeee">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td colspan="3" height="80" align="center" border="0" cellspacing="0"
                                                                                cellpadding="0" bgcolor="#eeeeee"
                                                                                style="padding:0;margin:0;font-size:0;line-height:0">
                                                                                <table width="690" align="center" border="0" cellspacing="0"
                                                                                    cellpadding="0">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td width="30"></td>
                                                                                            <td align="left" valign="middle"
                                                                                                style="padding:0;margin:0;font-size:0;line-height:0">
                                                                                                <a href="http://discussdesk.com//"
                                                                                                    target="_blank"><img
                                                                                                        src="http://discussdesk.com//view/assets/images/logo.png"
                                                                                                        alt="discussdesk"></a></td>
                                                                                            <td width="30"></td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="3" align="center">
                                                                                <table width="630" align="center" border="0" cellspacing="0"
                                                                                    cellpadding="0">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td colspan="3" height="60"></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="25"></td>
                                                                                            <td align="center">
                                                                                                <h1
                                                                                                    style="font-family:HelveticaNeue-Light,arial,sans-serif;font-size:48px;color:#404040;line-height:48px;font-weight:bold;margin:0;padding:0">
                                                                                                    ' . $to . '</h1>
                                                                                            </td>
                                                                                            <td width="25"></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td colspan="3" height="40"></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td colspan="5" align="center">
                                                                                                <p
                                                                                                    style="color:#404040;font-size:16px;line-height:24px;font-weight:lighter;padding:0;margin:0">
                                                                                                    Hello, Technology Lover!
                            
                                                                                                    Welcome to DiscussDesk, A place where you can
                                                                                                    grow you web programming knowledge. '. $to .'
                            
                                                                                                    DiscussDesk.com was started on Nov, 2012 with a
                                                                                                    passion to create a platform for web programmer
                                                                                                    where they can grow their web coding knowledge.
                                                                                                    Here we are trying to share latest web
                                                                                                    programming tips, fully readymade code in
                                                                                                    various programming language with full
                                                                                                    explanation, demo and download facilities. We
                                                                                                    always improving our technique and we just share
                                                                                                    this technique to our readers that may help
                                                                                                    them. When any new web technology or new trends
                                                                                                    comes in programming fields, we are trying to
                                                                                                    showcase it to our readers.
                            
                                                                                                    Discuss desk (www.discussdesk.com) is a blogging
                                                                                                    website with new technology content. Here, User
                                                                                                    can read and comment the latest blog. They can
                                                                                                    give suggestion about that blog. This Blog
                                                                                                    contain wide topics from Tech News, Web Design,
                                                                                                    Social Media, Software and Tech Tutorials.</p>
                                                                                                <br>
                                                                                                <p
                                                                                                    style="color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0">
                                                                                                    Learn PHP, MySQL, JavaScript, jQuery, Ajax,
                                                                                                    WordPress, Drupal, CodeIgniter, CakePHP, Web
                                                                                                    Development with Discussdesk tutorials. View
                                                                                                    live demo and download scripts.</p>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td colspan="4">
                                                                                                <div
                                                                                                    style="width:100%;text-align:center;margin:30px 0">
                                                                                                    <table align="center" cellpadding="0"
                                                                                                        cellspacing="0"
                                                                                                        style="font-family:HelveticaNeue-Light,Arial,sans-serif;margin:0 auto;padding:0">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td align="center"
                                                                                                                    style="margin:0;text-align:center">
                                                                                                                    <a href="http://discussdesk.com//"
                                                                                                                        style="font-size:21px;line-height:22px;text-decoration:none;color:#ffffff;font-weight:bold;border-radius:2px;background-color:#0096d3;padding:14px 40px;display:block;letter-spacing:1.2px"
                                                                                                                        target="_blank">Visit
                                                                                                                        website!</a></td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                </div>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td colspan="3" height="30"></td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                            
                                                                        <tr bgcolor="#ffffff">
                                                                            <td width="30" bgcolor="#eeeeee"></td>
                                                                            <td>
                                                                                <table width="570" align="center" border="0" cellspacing="0"
                                                                                    cellpadding="0">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td colspan="4" align="center">&nbsp;</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td colspan="4" align="center">
                                                                                                <h2 style="font-size:24px">Best Tutorials on</h2>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td colspan="4">&nbsp;</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="120" align="right" valign="top"><img
                                                                                                    src="https://i.imgbox.com/qrfX6RWN.png"
                                                                                                    alt="tool" width="120" height="120"></td>
                                                                                            <td width="30"></td>
                                                                                            <td align="left" valign="middle">
                                                                                                <h3
                                                                                                    style="color:#404040;font-size:18px;line-height:24px;font-weight:bold;padding:0;margin:0">
                                                                                                    Programming</h3>
                                                                                                <div style="line-height:5px;padding:0;margin:0">
                                                                                                    &nbsp;</div>
                                                                                                <div
                                                                                                    style="color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0">
                                                                                                    PHP/MySQL, Frameworks (CodeIgniter, CakePHP
                                                                                                    etc.), CMS (Drupal, WordPress etc.), Ajax,
                                                                                                    jQuery, JavaScript, HTML, CSS amd many more.
                                                                                                </div>
                                                                                                <div style="line-height:10px;padding:0;margin:0">
                                                                                                    &nbsp;</div>
                                                                                            </td>
                                                                                            <td width="30"></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td colspan="5" height="40"
                                                                                                style="padding:0;margin:0;font-size:0;line-height:0">
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="120" align="right" valign="top"><img
                                                                                                    src="https://i.imgbox.com/5zbmOytI.png"
                                                                                                    alt="no fees" width="120" height="120"></td>
                                                                                            <td width="30"></td>
                                                                                            <td align="left" valign="middle">
                                                                                                <h3
                                                                                                    style="color:#404040;font-size:18px;line-height:24px;font-weight:bold;padding:0;margin:0">
                                                                                                    Web Development</h3>
                                                                                                <div style="line-height:5px;padding:0;margin:0">
                                                                                                    &nbsp;</div>
                                                                                                <div
                                                                                                    style="color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0">
                                                                                                    Web development makes simple.</div>
                                                                                                <div style="line-height:10px;padding:0;margin:0">
                                                                                                    &nbsp;</div>
                                                                                            </td>
                                                                                            <td width="30"></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td colspan="5" height="40"
                                                                                                style="padding:0;margin:0;font-size:0;line-height:0">
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="120" align="right" valign="top"><img
                                                                                                    src="https://i.imgbox.com/AXtx1Oto.png"
                                                                                                    alt="creditibility" width="120" height="120"
                                                                                                    class="CToWUd"></td>
                                                                                            <td width="30"></td>
                                                                                            <td align="left" valign="middle">
                                                                                                <h3
                                                                                                    style="color:#404040;font-size:18px;line-height:24px;font-weight:bold;padding:0;margin:0">
                                                                                                    API Implementation</h3>
                                                                                                <div style="line-height:5px;padding:0;margin:0">
                                                                                                    &nbsp;</div>
                                                                                                <div
                                                                                                    style="color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0">
                                                                                                    Google, Google+, Google Map, Facebook, Twitter,
                                                                                                    LinkedIn and many more.</div>
                                                                                                <div style="line-height:10px;padding:0;margin:0">
                                                                                                    &nbsp;</div>
                                                                                            </td>
                                                                                            <td width="30"></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td colspan="4">&nbsp;</td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                                <table width="570" align="center" border="0" cellspacing="0"
                                                                                    cellpadding="0">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td>
                                                                                                <h2
                                                                                                    style="color:#404040;font-size:22px;font-weight:bold;line-height:26px;padding:0;margin:0">
                                                                                                    &nbsp;</h2>
                                                                                                <div
                                                                                                    style="color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0">
                                                                                                    Visit Discussdesk now and access tutorials, view
                                                                                                    live demo, download scripts at free of cost.
                                                                                                </div>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td align="center">
                                                                                                <div
                                                                                                    style="text-align:center;width:100%;padding:40px 0">
                                                                                                    <table align="center" cellpadding="0"
                                                                                                        cellspacing="0"
                                                                                                        style="margin:0 auto;padding:0">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td align="center"
                                                                                                                    style="margin:0;text-align:center">
                                                                                                                    <a href="http://discussdesk.com//"
                                                                                                                        style="font-size:18px;font-family:HelveticaNeue-Light,Arial,sans-serif;line-height:22px;text-decoration:none;color:#ffffff;font-weight:bold;border-radius:2px;background-color:#00a3df;padding:14px 40px;display:block"
                                                                                                                        target="_blank">Visit
                                                                                                                        Now!</a></td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                </div>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>&nbsp;</td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                            <td width="30" bgcolor="#eeeeee"></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                                <table align="center" width="750px" border="0" cellspacing="0" cellpadding="0"
                                                                    bgcolor="#eeeeee" style="width:750px!important">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>
                                                                                <table width="630" align="center" border="0" cellspacing="0"
                                                                                    cellpadding="0" bgcolor="#eeeeee">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td colspan="2" height="30"></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="360" valign="top">
                                                                                                <div
                                                                                                    style="color:#a3a3a3;font-size:12px;line-height:12px;padding:0;margin:0">
                                                                                                    &copy; 2015 discussesk. All rights reserved.
                                                                                                </div>
                                                                                                <div style="line-height:5px;padding:0;margin:0">
                                                                                                    &nbsp;</div>
                                                                                                <div
                                                                                                    style="color:#a3a3a3;font-size:12px;line-height:12px;padding:0;margin:0">
                                                                                                    Made in India</div>
                                                                                            </td>
                                                                                            <td align="right" valign="top">
                                                                                                <span style="line-height:20px;font-size:10px"><a
                                                                                                        href="https://www.facebook.com/discussdesk"
                                                                                                        target="_blank"><img
                                                                                                            src="https://i.imgbox.com/BggPYqAh.png"
                                                                                                            alt="fb"></a>&nbsp;</span>
                                                                                                <span style="line-height:20px;font-size:10px"><a
                                                                                                        href="https://twitter.com/discussdeskblog"
                                                                                                        target="_blank"><img
                                                                                                            src="https://i.imgbox.com/j3NsGLak.png"
                                                                                                            alt="twit"></a>&nbsp;</span>
                                                                                                <span style="line-height:20px;font-size:10px"><a
                                                                                                        href="https://plus.google.com/+discussdeskworld"
                                                                                                        target="_blank"><img
                                                                                                            src="https://i.imgbox.com/wFyxXQyf.png"
                                                                                                            alt="g"></a>&nbsp;</span>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td colspan="2" height="5"></td>
                                                                                        </tr>
                            
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            </body>    
                        </html>
                    ';
                    
                    
                    
                    if($mail->send()){
                        echo "The message was sent to " . $to . " successfully";
                    }else{
                        echo "Failed to send the message to " . $to;
                    }
                }
            }
        }
    } elseif($do == 'view'){
        $idP = $_GET['idP'];
        $stmt = $con->prepare("SELECT * FROM `evaluation_chaud` WHERE id_participe = ?");
        $stmt->execute(array($idP));
        $EsChaud = $stmt->fetch();
        ?>

        <div class="container evaluationChaud page-content">
            <table class="table">
                <thead>
                    <tr>
                        <th class="fw-bold px-2 align-middle">Condition de realisation</th>
                        <th class="th-min text-center align-middle">pas du tout satisfait</th>
                        <th class="th-min text-center align-middle">Peu satisfait</th>
                        <th class="th-min text-center align-middle">Moyennement satisfait</th>
                        <th class="th-min text-center align-middle">Tout a fait satisfait</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="fw-6">1. L'information concernant la formation a ete complete</td>
                        <td class="text-center"><input type="checkbox" onClick="return false"<?php if($EsChaud['q1'] == '1') echo 'checked'; else echo 'disabled'; ?> ></td>
                        <td class="text-center"><input type="checkbox" onClick="return false"<?php if($EsChaud['q1'] == '2') echo 'checked'; else echo 'disabled'; ?> ></td>
                        <td class="text-center"><input type="checkbox" onClick="return false"<?php if($EsChaud['q1'] == '3') echo 'checked'; else echo 'disabled'; ?> ></td>
                        <td class="text-center"><input type="checkbox" onClick="return false"<?php if($EsChaud['q1'] == '4') echo 'checked'; else echo 'disabled'; ?> ></td>
                    </tr>
                    <tr>
                        <td class="fw-6">2. La duree et le rythme de formation etaient conformes a ce qui a ete annonce</td>
                        <td class="text-center"><input type="checkbox" onClick="return false" <?php if($EsChaud['q2'] == '1') echo 'checked'; else echo 'disabled'; ?> ></td>
                        <td class="text-center"><input type="checkbox" onClick="return false" <?php if($EsChaud['q2'] == '2') echo 'checked'; else echo 'disabled'; ?> ></td>
                        <td class="text-center"><input type="checkbox" onClick="return false" <?php if($EsChaud['q2'] == '3') echo 'checked'; else echo 'disabled'; ?> ></td>
                        <td class="text-center"><input type="checkbox" onClick="return false" <?php if($EsChaud['q2'] == '4') echo 'checked'; else echo 'disabled'; ?> ></td>
                    </tr>
                    <tr>
                        <td class="fw-6">3. Les documents annonces ont ete remis aux paticipants</td>
                        <td class="text-center"><input type="checkbox" onClick="return false" <?php if($EsChaud['q3'] == '1') echo 'checked'; else echo 'disabled'; ?>  ></td>
                        <td class="text-center"><input type="checkbox" onClick="return false" <?php if($EsChaud['q3'] == '2') echo 'checked'; else echo 'disabled'; ?>  ></td>
                        <td class="text-center"><input type="checkbox" onClick="return false" <?php if($EsChaud['q3'] == '3') echo 'checked'; else echo 'disabled'; ?>  ></td>
                        <td class="text-center"><input type="checkbox" onClick="return false" <?php if($EsChaud['q3'] == '4') echo 'checked'; else echo 'disabled'; ?>  ></td>
                    </tr>
                    <tr>
                        <td class="fw-6">4. Les documtens remis constituent une aide a l'assimilation des contenus</td>
                        <td class="text-center"><input type="checkbox" onClick="return false" <?php if($EsChaud['q4'] == '1') echo 'checked'; else echo 'disabled'; ?>  ></td>
                        <td class="text-center"><input type="checkbox" onClick="return false" <?php if($EsChaud['q4'] == '2') echo 'checked'; else echo 'disabled';?>  ></td>
                        <td class="text-center"><input type="checkbox" onClick="return false" <?php if($EsChaud['q4'] == '3') echo 'checked'; else echo 'disabled';?>  ></td>
                        <td class="text-center"><input type="checkbox" onClick="return false" <?php if($EsChaud['q4'] == '4') echo 'checked'; else echo 'disabled';?>  ></td>
                    </tr>
                    <tr>
                        <td class="fw-6">5. Les contenus de la formation etainet adaptes a mon niveau initial</td>
                        <td class="text-center"><input type="checkbox" onClick="return false" <?php if($EsChaud['5'] == '1') echo 'checked'; else echo 'disabled';?>  ></td>
                        <td class="text-center"><input type="checkbox" onClick="return false" <?php if($EsChaud['5'] == '2') echo 'checked'; else echo 'disabled';?>  ></td>
                        <td class="text-center"><input type="checkbox" onClick="return false" <?php if($EsChaud['5'] == '3') echo 'checked'; else echo 'disabled';?>  ></td>
                        <td class="text-center"><input type="checkbox" onClick="return false" <?php if($EsChaud['5'] == '4') echo 'checked'; else echo 'disabled';?>  ></td>
                    </tr>
                    <tr>
                        <td class="fw-6">6. Les conditions materielles (locaux, restauration, facilite d'acces, etc.) etaient satisfaisantes</td>
                        <td class="text-center"><input type="checkbox" onClick="return false" <?php if($EsChaud['q6'] == '1') echo 'checked'; else echo 'disabled'; ?>  ></td>
                        <td class="text-center"><input type="checkbox" onClick="return false" <?php if($EsChaud['q6'] == '2') echo 'checked'; else echo 'disabled'; ?>  ></td>
                        <td class="text-center"><input type="checkbox" onClick="return false" <?php if($EsChaud['q6'] == '3') echo 'checked'; else echo 'disabled'; ?>  ></td>
                        <td class="text-center"><input type="checkbox" onClick="return false" <?php if($EsChaud['q6'] == '4') echo 'checked'; else echo 'disabled'; ?>  ></td>
                    </tr>
                </tbody>
            </table>

            <table class="table">
                <thead>
                    <tr>

                        <th class="fw-bold px-2 align-middle">Competences techniques et pedagogiques</th>
                        <th class="th-min text-center align-middle">pas du tout satisfait</th>
                        <th class="th-min text-center align-middle">Peu satisfait</th>
                        <th class="th-min text-center align-middle">Moyennement satisfait</th>
                        <th class="th-min text-center align-middle">Tout a fait satisfait</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="fw-6">7. Le formateur dispose des comperences techniques necessaires</td>
                        <td class="text-center"><input type="checkbox" onClick="return false" <?php if($EsChaud['q7'] == '1') echo 'checked'; else echo 'disabled'; ?> ></td>
                        <td class="text-center"><input type="checkbox" onClick="return false" <?php if($EsChaud['q7'] == '2') echo 'checked'; else echo 'disabled'; ?> ></td>
                        <td class="text-center"><input type="checkbox" onClick="return false" <?php if($EsChaud['q7'] == '3') echo 'checked'; else echo 'disabled'; ?> ></td>
                        <td class="text-center"><input type="checkbox" onClick="return false" <?php if($EsChaud['q7'] == '4') echo 'checked'; else echo 'disabled'; ?> ></td>
                    </tr>
                    <tr>
                        <td class="fw-6">8. Le formateur dispose des competences pedagogique</td>
                        <td class="text-center"><input type="checkbox" onClick="return false" <?php if($EsChaud['q8'] == '1') echo 'checked'; else echo 'disabled'; ?> ></td>
                        <td class="text-center"><input type="checkbox" onClick="return false" <?php if($EsChaud['q8'] == '2') echo 'checked'; else echo 'disabled'; ?> ></td>
                        <td class="text-center"><input type="checkbox" onClick="return false" <?php if($EsChaud['q8'] == '3') echo 'checked'; else echo 'disabled'; ?> ></td>
                        <td class="text-center"><input type="checkbox" onClick="return false" <?php if($EsChaud['q8'] == '4') echo 'checked'; else echo 'disabled'; ?> ></td>
                    </tr>
                    <tr>
                        <td class="fw-6">9. Le formateur a su creer ou entretenir une ambiance agreable dans le groupe en formation</td>
                        <td class="text-center"><input type="checkbox" onClick="return false" <?php if($EsChaud['q9'] == '1') echo 'checked'; else echo 'disabled'; ?> ></td>
                        <td class="text-center"><input type="checkbox" onClick="return false" <?php if($EsChaud['q9'] == '2') echo 'checked'; else echo 'disabled'; ?> ></td>
                        <td class="text-center"><input type="checkbox" onClick="return false" <?php if($EsChaud['q9'] == '3') echo 'checked'; else echo 'disabled'; ?> ></td>
                        <td class="text-center"><input type="checkbox" onClick="return false" <?php if($EsChaud['q9'] == '4') echo 'checked'; else echo 'disabled'; ?> ></td>
                    </tr>
                    <tr>
                        <td class="fw-6">10. Les moyens pedagogiques etaient adaptes au contenu de la formation</td>
                        <td class="text-center"><input type="checkbox" onClick="return false"<?php if($EsChaud['q10'] == '1') echo 'checked'; else echo 'disabled'; ?> ></td>
                        <td class="text-center"><input type="checkbox" onClick="return false"<?php if($EsChaud['q10'] == '2') echo 'checked'; else echo 'disabled'; ?> ></td>
                        <td class="text-center"><input type="checkbox" onClick="return false"<?php if($EsChaud['q10'] == '3') echo 'checked'; else echo 'disabled'; ?> ></td>
                        <td class="text-center"><input type="checkbox" onClick="return false"<?php if($EsChaud['q10'] == '4') echo 'checked'; else echo 'disabled'; ?> ></td>
                    </tr>
                </tbody>
            </table>
            <table class="table">
                <thead>
                    <tr>

                        <th class="fw-bold px-2 align-middle">Atteinte des objectifs</th>
                        <th class="th-min text-center align-middle">pas du tout satisfait</th>
                        <th class="th-min text-center align-middle">Peu satisfait</th>
                        <th class="th-min text-center align-middle">Moyennement satisfait</th>
                        <th class="th-min text-center align-middle">Tout a fait satisfait</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="fw-6">11. Les objectifs de la formation correspondent a mes besoins professionnels</td>
                        <td class="text-center"><input type="checkbox" onClick="return false" <?php if($EsChaud['q11'] == '1') echo 'checked'; else echo 'disabled';?> ></td>
                        <td class="text-center"><input type="checkbox" onClick="return false" <?php if($EsChaud['q11'] == '2') echo 'checked'; else echo 'disabled';?> ></td>
                        <td class="text-center"><input type="checkbox" onClick="return false" <?php if($EsChaud['q11'] == '3') echo 'checked'; else echo 'disabled';?> ></td>
                        <td class="text-center"><input type="checkbox" onClick="return false" <?php if($EsChaud['q11'] == '4') echo 'checked'; else echo 'disabled';?> ></td>
                    </tr>
                    <tr>
                        <td class="fw-6">12. D'une maniere generale, cette formation me permettra d'ameliorer mes competences professionnelles</td>
                        <td class="text-center"><input type="checkbox" onClick="return false" <?php if($EsChaud['q12'] == '1') echo 'checked'; else echo 'disabled';?> ></td>
                        <td class="text-center"><input type="checkbox" onClick="return false" <?php if($EsChaud['q12'] == '2') echo 'checked'; else echo 'disabled';?> ></td>
                        <td class="text-center"><input type="checkbox" onClick="return false" <?php if($EsChaud['q12'] == '3') echo 'checked'; else echo 'disabled';?> ></td>
                        <td class="text-center"><input type="checkbox" onClick="return false" <?php if($EsChaud['q12'] == '4') echo 'checked'; else echo 'disabled';?> ></td>
                    </tr>
                </tbody>
            </table>
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center" style="background-color: #bbbbbb;">SUGGESTIONS POUR AMELIORER CETTE FORMATON <span class="">(Optionel)</span></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td> 
                            <ul>
                                <li class="my-2"><input type="text" value="<?php echo $EsChaud['suggestion_1']; ?>" style="width:90%"></li>
                                <li class="mb-2"><input type="text" value="<?php echo $EsChaud['suggestion_2']; ?>" style="width:90%"></li>
                                <li class="mb-2"><input type="text" value="<?php echo $EsChaud['suggestion_3']; ?>" style="width:90%"></li>
                            </ul>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <script>
            function readOnlyCheckBox() {
                return false;
            }
        </script>
        <?php

    }
} else {
    header("location: login.php");
}
include 'includes/templates/footer.php';
// }
