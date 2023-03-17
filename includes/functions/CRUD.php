<?php




// /*
// **
// ** getAll function v1.0.0
// ** fetch all Formations from database
// ** return : 
// **      $formations -> list formations;
// ** args : 
// **      no args;
// */
// function getAll()
// {
//     global $con;

//     $stmt = $con->prepare("SELECT * FROM `formation` ");
//     $stmt->execute();

//     $formations = $stmt->fetchAll();

//     return $formations;
// }
// /*
// **
// ** Insert function v1.0.0
// ** Insert Entitie In Database
// ** return : 
// **      1 -> done
// **      0 -> error
// ** args : 
// **      all arguments of the Formation
// */
// function Insert(
//     $formationName,
//     $formationCat,
//     $proposedBy,
//     $numberHoures,
//     $trainerName,
//     $trainerNumber,
//     $trainerEmail,
//     $traininigSite,
//     $nbParticepants,
//     $dateStart,
//     $dateFin,
//     $formation_EX_IN
// ) {
//     global $con;

//     // Check If The User Exust In Database
//     $stmt = $con->prepare("INSERT INTO   
//                                 formation 
//                                 (nom_formation, 
//                                 categorie_formation, 
//                                 date_debut, 
//                                 date_fin, 
//                                 formation_EX_IN,
//                                 hours_formation, 
//                                 service_propose, 
//                                 nom_formateur, 
//                                 num_formateur, 
//                                 email_formateur, 
//                                 lieu_formation, 
//                                 NumberParticipe,
//                                 created_by, 
//                                 created_at) 
//                             VALUES
//                                 (
//                                 :znom_formation,
//                                 :zcategorie_formation,
//                                 :zdate_debut,
//                                 :zdate_fin, 
//                                 :zformation_EX_IN,
//                                 :zhours_formation,
//                                 :zservice_propose,
//                                 :znom_formateur,
//                                 :znum_formateur,
//                                 :zemail_formateur,
//                                 :zlieu_formation,
//                                 :zNumberParticipe,
//                                 :zcreated_by,
//                                 now()
//                                 )");
//     $stmt->execute(array(
//         ':znom_formation'       => $formationName,
//         ':zcategorie_formation' => $formationCat,
//         ':zdate_debut'          => $dateStart,
//         ':zdate_fin'            => $dateFin,
//         ':zformation_EX_IN'     => $formation_EX_IN,
//         ':zhours_formation'     => $numberHoures,
//         ':zservice_propose'     => $proposedBy,
//         ':znom_formateur'       => $trainerName,
//         ':znum_formateur'       => $trainerNumber,
//         ':zemail_formateur'     => $trainerEmail,
//         ':zlieu_formation'      => $traininigSite,
//         ':zNumberParticipe'     => $nbParticepants,
//         ':zcreated_by'          => 'med'
//     ));
//     //Echo Success Message 

//     return $stmt->rowCount();
// }

// /*
// **
// ** CheckIfExist function v1.0.0
// ** Check If The User Exist In Database
// ** return : number of columns fetched
// ** args : 
// **      $username -> username of user
// **      $hashedPass -> sha1 the password of the user
// */
// function CheckIfExist($username, $hashedPass)
// {
//     global $con;

//     // Check If The User Exust In Database
//     $stmt = $con->prepare("SELECT 
//                                 *
//                             FROM 
//                                 user 
//                             WHERE 
//                                 user_name= ? 
//                            ");
//     $stmt->execute(array($username));
//     $row = $stmt->fetch();
//     $count = $stmt->rowCount();

//     return $count;
// }
// /*
// **
// ** Delete function v1.0.0
// ** Delete Formation From Database
// ** 
// **
// */
// function Delete($id_formation)
// {

//     global $con;
//     $stmt = $con->prepare("DELETE FROM formation WHERE id_formation = :zfomrmation");
//     $stmt->bindParam(":zfomrmation", $id_formation);
//     $stmt->execute();
// }
// /*
// **
// ** getById function v1.0.0
// ** get the Formation From Database who has id_formation = $id_formation
// ** 
// **
// */
// function getById($id_formation)
// {
//     global $con;
//     $stmt = $con->prepare("SELECT * FROM formation WHERE id_formation = :zfomrmation");
//     $stmt->bindParam(":zfomrmation", $id_formation);
//     $stmt->execute();
//     return $stmt->fetch();

// }

// /*
// **
// ** selectBetween function v1.0.0
// ** fetch all Formations from database
// ** return : 
// **      $formations -> list formations;
// ** args : 
// **      no args;
// */
// function selectBetween($start, $fin)
// {
//     global $con;

//     $stmt = $con->prepare("SELECT * FROM `formation` LIMIT " . $start . " , " . $fin);
//     $stmt->execute();

//     $formations = $stmt->fetchAll();

//     return $formations;
// }


// /*
// **
// ** Update function v1.0.0
// ** Update data Of Formation
// ** return : 
// **      1 -> done
// **      0 -> error
// ** args : 
// **      all arguments of the Formation
// */
// function Update(
//     $id_formation,
//     $formationName,
//     $formationCat,
//     $proposedBy,
//     $numberHoures,
//     $trainerName,
//     $trainerNumber,
//     $trainerEmail,
//     $traininigSite,
//     $nbParticepants,
//     $dateStart,
//     $dateFin,
//     $formationEI
// ) {
//     global $con;

//     // Check If The User Exust In Database
//     $stmt = $con->prepare("UPDATE    
//                                 formation 
//                             SET 
//                                 nom_formation       = ?,
//                                 categorie_formation = ?,
//                                 date_debut          = ?, 
//                                 date_fin            = ?,
//                                 formation_EX_IN     = ?,
//                                 hours_formation     = ?, 
//                                 service_propose     = ?, 
//                                 nom_formateur       = ?, 
//                                 num_formateur       = ?, 
//                                 email_formateur     = ?, 
//                                 lieu_formation      = ?,
//                                 NumberParticipe     = ?,
//                                 updated_by          = ?, 
//                                 updated_at          = now()
//                             WHERE 
//                                 id_formation = ?");
//     $stmt->execute(array(
//         $formationName,
//         $formationCat,
//         $dateStart,
//         $dateFin,
//         $formationEI,
//         $numberHoures,
//         $proposedBy,
//         $trainerName,
//         $trainerNumber,
//         $trainerEmail,
//         $traininigSite,
//         $nbParticepants,
//         'meed',
//         $id_formation
//     ));
//     //Echo Success Message 

//     return $stmt->rowCount();
// }

// function getCount(){
//     global $con;

//     $stmt = $con->prepare("SELECT COUNT(id_formation) FROM `formation`");
//     $stmt->execute();

//     $count = $stmt->fetchColumn(0);

//     return $count;
// }

// function SelectByEmail($email){
//     global $con;
//     $stmt = $con->prepare("SELECT id_formation, nom_formation, categorie_formation, hours_formation, NumberParticipe, date_debut FROM formation WHERE email_formateur = ?");
//     $stmt->execute(array($email));
//     $formations = $stmt->fetchAll();
//     return $formations;
// }
function numberOfGroup($id_formation)
{
    global $con;

    $stmt = $con->prepare("SELECT COUNT(id_formation) FROM partisipe WHERE id_formation = ? GROUP BY id_formation, groupe");
    $stmt->execute(array($id_formation));
    $x = $stmt->rowCount();

    return $x;
}
function InsertGroup(array $participants, $id_formation, $date, $timeStart, $timeFin, $groupe)
{
    global $con;

    $requet = "INSERT INTO `partisipe` (Matricule, id_formation, code, date, timeStart, timeFin, groupe) 
                VALUE(?, ?, ?, ?, ?, ?, ?)";
    $ase[] =    array();
    $ase[0] = $participants[0];
    $ase[1] = $id_formation;
    $ase[2] = generateRandomString();
    $ase[3] = $date;
    $ase[4] = $timeStart;
    $ase[5] = $timeFin;
    $ase[6] = $groupe;
    // $participants = array_values($participants);
    $j = count($participants);
    for ($i = 1; $i < $j; $i++) {
        $requet .= ",(?, ?, ?, ?, ?, ?, ?)";
        $ase[(7*$i)] = $participants[$i];
        $ase[(7*$i +1)] = $id_formation;
        $ase[(7*$i +2)] = generateRandomString();
        $ase[(7*$i +3)] = $date;
        $ase[(7*$i +4)] = $timeStart;
        $ase[(7*$i +5)] = $timeFin;
        $ase[(7*$i +6)] = $groupe;
    }
    
    $stmt = $con->prepare($requet);
    $stmt->execute($ase);
    return $stmt->rowCount();
}

function getFormationResponsible($matricule)
{
    global $con;

    $stmt = $con->prepare("SELECT * FROM formation WHERE responsable = ? AND date_debut != '0000-00-00'");
    $stmt->execute(array($matricule));
    $formations = $stmt->fetchAll();
    return $formations;
}

function exist_Mat_Code($matricule, $code){
    global $con;
    $stmt = $con->prepare("SELECT id_formation FROM `partisipe` WHERE Matricule = ? AND code = ? ");
    $stmt->execute(array($matricule, $code));
    if($stmt->rowCount()>0){
        return $stmt->fetch();
    }else{
        return 0;
    }
}
function InsertEvaluationChaud($idParticipe, $q1, $q2, $q3, $q4, $q5, $q6, $q7, $q8, $q9, $q10, $q11, $q12, $suggestion1, $suggestion2, $suggestion3){
    global $con;
    $stmt = $con->prepare("INSERT INTO `evaluation_chaud` VALUES (NULL, :zidp,
                                                                        :zq1,
                                                                        :zq2,
                                                                        :zq3,
                                                                        :zq4,
                                                                        :zq5,
                                                                        :zq6,
                                                                        :zq7,
                                                                        :zq8,
                                                                        :zq9,
                                                                        :zq10,
                                                                        :zq11,
                                                                        :zq12,
                                                                        :zs1,
                                                                        :zs2,
                                                                        :zs3)");
    $stmt->execute(array(
        ':zidp'     => $idParticipe,
        ':zq1'      => $q1,
        ':zq2'      => $q2,
        ':zq3'      => $q3,
        ':zq4'      => $q4,
        ':zq5'      => $q5,
        ':zq6'      => $q6,
        ':zq7'      => $q7,
        ':zq8'      => $q8,
        ':zq9'      => $q9,
        ':zq10'     => $q10,
        ':zq11'     => $q11,
        ':zq12'     => $q12,
        ':zs1'      => $suggestion1,
        ':zs2'      => $suggestion2,
        ':zs3'      => $suggestion3
    ));
    return $stmt->rowCount();
}

function formationRealize($id_formation, $responsable){
    global $con;
    $stmt = $con->prepare("UPDATE `formation` SET realize = '1' WHERE id_formation = ? AND responsable = ?");
    $stmt->execute(array($id_formation, $responsable));
    return $stmt->rowCount();    
}