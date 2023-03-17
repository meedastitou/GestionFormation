<?php




/*
**
** getAll function v1.0.0
** fetch all Formations from database
** return : 
**      $formations -> list formations;
** args : 
**      no args;
*/
function getAll()
{
    global $con;

    $stmt = $con->prepare("SELECT * FROM `formation` ");
    $stmt->execute();

    $formations = $stmt->fetchAll();

    return $formations;
}
/*
**
** Insert function v1.0.0
** Insert Entitie In Database
** return : 
**      1 -> done
**      0 -> error
** args : 
**      all arguments of the Formation
*/
function Insert(
    $formationName,
    $formationCat,
    $proposedBy,
    $year,
    $numberHoures,
    $trainerName,
    $trainerNumber,
    $trainerEmail,
    $traininigSite,
    $nbParticepants,
    $dateStart,
    $dateFin,
    $formation_EX_IN,
    $responsible,
    $objectif
) {
    global $con;

    // Check If The User Exust In Database
    $stmt = $con->prepare("INSERT INTO   
                                formation 
                                (nom_formation, 
                                categorie_formation, 
                                objectif,
                                year,
                                date_debut, 
                                date_fin, 
                                formation_EX_IN,
                                hours_formation, 
                                service_propose, 
                                nom_formateur, 
                                num_formateur, 
                                email_formateur, 
                                lieu_formation, 
                                NumberParticipe,
                                responsable,
                                created_by, 
                                created_at) 
                            VALUES
                                (
                                :znom_formation,
                                :zcategorie_formation,
                                :zobjectif,
                                :zyear,
                                :zdate_debut,
                                :zdate_fin, 
                                :zformation_EX_IN,
                                :zhours_formation,
                                :zservice_propose,
                                :znom_formateur,
                                :znum_formateur,
                                :zemail_formateur,
                                :zlieu_formation,
                                :zNumberParticipe,
                                :zresponsable,
                                :zcreated_by,
                                now()
                                )");
    $stmt->execute(array(
        ':znom_formation'       => $formationName,
        ':zcategorie_formation' => $formationCat,
        ':zobjectif'            => $objectif,
        ':zyear'                => $year,
        ':zdate_debut'          => $dateStart,
        ':zdate_fin'            => $dateFin,
        ':zformation_EX_IN'     => $formation_EX_IN,
        ':zhours_formation'     => $numberHoures,
        ':zservice_propose'     => $proposedBy,
        ':znom_formateur'       => $trainerName,
        ':znum_formateur'       => $trainerNumber,
        ':zemail_formateur'     => $trainerEmail,
        ':zlieu_formation'      => $traininigSite,
        ':zNumberParticipe'     => $nbParticepants,
        ':zresponsable'         => $responsible,
        ':zcreated_by'          => 'med'
    ));
    //Echo Success Message 

    return $stmt->rowCount();
}

/*
**
** CheckIfExist function v1.0.0
** Check If The User Exist In Database
** return : number of columns fetched
** args : 
**      $username -> username of user
**      $hashedPass -> sha1 the password of the user
*/
function CheckIfExist($username, $hashedPass)
{
    global $con;

    // Check If The User Exust In Database
    $stmt = $con->prepare("SELECT 
                                *
                            FROM 
                                user 
                            WHERE 
                                user_name= ? 
                           ");
    $stmt->execute(array($username));
    $row = $stmt->fetch();
    $count = $stmt->rowCount();

    return $count;
}
/*
**
** Delete function v1.0.0
** Delete Formation From Database
** 
**
*/
function Delete($id_formation)
{

    global $con;
    $stmt = $con->prepare("DELETE FROM formation WHERE id_formation = :zfomrmation");
    $stmt->bindParam(":zfomrmation", $id_formation);
    $stmt->execute();
}
/*
**
** getById function v1.0.0
** get the Formation From Database who has id_formation = $id_formation
** 
**
*/
function getById($id_formation)
{
    global $con;
    $stmt = $con->prepare("SELECT * FROM formation WHERE id_formation = :zfomrmation");
    $stmt->bindParam(":zfomrmation", $id_formation);
    $stmt->execute();
    return $stmt->fetch();

}

/*
**
** selectBetween function v1.0.0
** fetch all Formations from database
** return : 
**      $formations -> list formations;
** args : 
**      no args;
*/
function selectBetween($start, $fin)
{
    global $con;

    $stmt = $con->prepare("SELECT * FROM `formation` LIMIT " . $start . " , " . $fin);
    $stmt->execute();

    $formations = $stmt->fetchAll();

    return $formations;
}


/*
**
** Update function v1.0.0
** Update data Of Formation
** return : 
**      1 -> done
**      0 -> error
** args : 
**      all arguments of the Formation
*/
function Update(
    $id_formation,
    $formationName,
    $formationCat,
    $proposedBy,
    $numberHoures,
    $trainerName,
    $trainerNumber,
    $trainerEmail,
    $traininigSite,
    $nbParticepants,
    $dateStart,
    $dateFin,
    $formationEI,
    $responsible,
    $objectif
) {
    global $con;

    // Check If The User Exust In Database
    $stmt = $con->prepare("UPDATE    
                                formation 
                            SET 
                                nom_formation       = ?,
                                categorie_formation = ?,
                                objectif            = ?,
                                date_debut          = ?, 
                                date_fin            = ?,
                                formation_EX_IN     = ?,
                                hours_formation     = ?, 
                                service_propose     = ?, 
                                nom_formateur       = ?, 
                                num_formateur       = ?, 
                                email_formateur     = ?, 
                                lieu_formation      = ?,
                                NumberParticipe     = ?,
                                responsable         = ?,
                                updated_by          = ?, 
                                updated_at          = now()
                            WHERE 
                                id_formation = ?");
    $stmt->execute(array(
        $formationName,
        $formationCat,
        $objectif,
        $dateStart,
        $dateFin,
        $formationEI,
        $numberHoures,
        $proposedBy,
        $trainerName,
        $trainerNumber,
        $trainerEmail,
        $traininigSite,
        $nbParticepants,
        $responsible,
        'meed',
        $id_formation
    ));
    //Echo Success Message 

    return $stmt->rowCount();
}
// v2
function getCount($where = '1=1'){
    global $con;
    $stmt = $con->prepare("SELECT COUNT(id_formation) FROM `formation` WHERE $where");
    $stmt->execute();

    $count = $stmt->fetchColumn(0);

    return $count;
}
// SELECT COUNT(*) FROM `formation` WHERE `date_debut` > '2023/1/1'




function getByIdWithEmp($id_formation)
{
    global $con;
    $stmt = $con->prepare("SELECT formation.*, employe.Nom, employe.Prenom 
                            FROM formation 
                            INNER JOIN employe ON employe.Matricule = formation.responsable   
                            WHERE id_formation = :zfomrmation");
    $stmt->bindParam(":zfomrmation", $id_formation);
    $stmt->execute();
    return $stmt->fetch();

}

function getByFilter($dateStart, $dateFin,$GLthan, $type){
    global $con;


    $stmt = $con->prepare("SELECT * FROM `formation` WHERE `date_debut` > ? AND `date_debut` < ?");
    $stmt->execute(array($dateStart, $dateFin));
    return $stmt->fetchAll();
}

?>