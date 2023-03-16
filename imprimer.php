<?php
session_start();
include 'Admin/includes/ConxionDB/connect.php';
include 'includes/functions/CRUD.php';
include 'includes/functions/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Iid_formation'])) {
    $stmt = $con->prepare(" SELECT employe.* , partisipe.timeStart, partisipe.timeFin, partisipe.date, formation.* 
            FROM partisipe 
            INNER JOIN employe ON employe.Matricule=partisipe.Matricule
            INNER JOIN formation ON formation.id_formation = partisipe.id_formation
            WHERE partisipe.id_formation  = ? 
            AND partisipe.groupe = ?");
    $stmt->execute(array($_POST['Iid_formation'], $_POST['Igroupe']));
    $formations = $stmt->fetchAll();
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            .header-imprimer {
                display: flex;
                padding: 0 10px;
            }

            .header-imprimer {
                height: 120px;
                max-height: 120px;
                min-height: 120px;
            }

            .enregistrement {
                height: 40px;
                line-height: 40px;
                font-size: 21px;
                font-family: 600;
                font-weight: 600;
                font-style: italic;
                border: 1px solid;
                text-align: center;
            }

            .fichepresence {
                height: 80px;
                line-height: 80px;
                text-align: center;
                font-size: 18px;
                font-weight: 500;
                border: 1px solid;
            }

            .left-header-imprimer {
                display: flex;
                justify-content: center;
                align-items: center;
                text-align: center;
                border: 1px solid;
            }

            .right-header-imprimer {
                height: 40px;
                line-height: 40px;
                border: 1px solid;
                font-size: 13px;
                text-align: center;
            }

            .title-imprimer {
                display: flex;
                justify-content: center;
                margin-top: 10px;
            }

            .title-imprimer td {
                padding: 3px;
            }

            .imprimer h6 {
                font-size: 14px;
                font-weight: 600;
            }

            .table {
                width: 95%;
                text-align: center;
                caption-side: bottom;
                border-collapse: collapse;
                margin: 0 auto;
            }

            .table thead tr {
                background-color: #ececec;
                color: #000;

            }

            .table thead tr th {
                padding: 5px;
            }

            .table td {
                padding: 6px 3px;
            }
        </style>
    </head>

    <body style="
    position: relative;
    height: 1087px;">
        <div class="header-imprimer">
            <div class="left-header-imprimer" style="flex-basis: 20%">
                <img src="data:image/jpeg;base64,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" style="width: 80%; height:80%;" alt="">
            </div>
            <div style="flex-basis: 60%">
                <div>
                    <div class="enregistrement">
                        <p class="text-center">Enregistrement</p>
                    </div>
                    <div class="text-center fichepresence">
                        <b>Fiche de presence de la formation</b>
                    </div>
                </div>
            </div>
            <div style="flex-basis: 20%">
                <div>
                    <div class="right-header-imprimer">EN.PR.GRH.02.03</div>
                    <div class="right-header-imprimer">Version : 01</div>
                    <div class="right-header-imprimer">Page : 1 sur 1</div>
                </div>
            </div>
        </div>
        <div class="title-imprimer">
            <table width="90%" style="font-size: 21px;">
                <tr>
                    <td colspan="2">
                        <h6>
                            Theme de formation : <b><?php echo $formations[0]['nom_formation'] ?></b>
                        </h6>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h6>
                            Date de la formation: <?php echo converDate($formations[0]['date']); ?>
                        </h6>
                    </td>
                    <td>
                        <h6>
                            Formateur : <?php echo $formations[0]['nom_formateur'] ?>
                        </h6>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <h6>
                            Lieu de la formation : <?php echo $formations[0]['lieu_formation'] ?>
                        </h6>
                    </td>
                </tr>
            </table>
        </div>
        <div class="">
            <table class="table" border="1">
                <thead>
                    <tr class="align-middle">
                        <th class="">N</th>
                        <th class="">Nom et Prenom</th>
                        <th class="">Mle</th>
                        <th class="">Fonction</th>
                        <th class>Emargement</th>
                    </tr>
                </thead>
                <tbody id="table_body">
                    <?php
                    // foreach ($formations as $formation) {
                    $i;
                    for ($i = 0; $i < count($formations); $i++) {
                    ?>
                        <tr>
                            <td class=""><?php echo ($i + 1); ?></td>
                            <td class=""><?php echo $formations[$i]['Prenom'] . " " . $formations[$i]['Nom']; ?></td>
                            <td class=""><?php echo  "dfsffsdf" ?></td>
                            <td class=""><?php echo  "dasfweffewfefaefwfweff"; ?></td>
                            <td class=""></td>
                        </tr>
                        <?php
                    }
                    if (count($formations) < 20) {

                        // $j = 20 - count($formations);
                        // $j = $j + $i;

                        for (++$i; $i <= 20; $i++) {
                        ?>
                            <tr>
                                <td class=""><?php echo ($i); ?></td>
                                <td class=""></td>
                                <td class=""></td>
                                <td class=""></td>
                                <td class=""></td>
                            </tr>
                    <?php
                            // echo ' '. $i;
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div style="position: absolute; bottom: 0; text-align:center; width: 100%; padding: 0 5%;">
            <p style="padding-top: 8px;
    border-top: 1px solid;">Ce document ne doit etre ni reproduit ni communique sans l'autorisation de la R.A.D.E.E.L</p>
        </div>
        <?php

        ?>
        <script>
            window.onload = (event) => {
                window.print();
            };
        </script>
    </body>

    </html>
<?php
}
