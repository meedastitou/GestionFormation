<?php

session_start();
$noNav = '';
$pageTitle = "index";
include 'init.php';

if (isset($_POST['Code']) && isset($_POST['Matricule'])) {
    $stmt = $con->prepare("SELECT id FROM `partisipe` WHERE code= ? AND Matricule = ?");
    $stmt->execute(array($_POST['Code'], $_POST['Matricule']));
    $participe = $stmt->fetch();    
    $do = isset($_GET['do']) ? $_GET['do'] : 'doesntExist';
    if($do == 'doesntExist'){

    
        ?>  
        <div class="container evaluationChaud page-content">
            <form action="?do=Insert" method="POST">
                <input type="hidden" name="idParticipe" value="<?php echo $participe['id'] ?>">
                <input type="hidden" name="Code" value="<?php echo $_POST['Code'] ?>">
                <input type="hidden" name="Matricule" value="<?php echo $_POST['Matricule'] ?>">
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
                            <td class="text-center"><input type="checkbox" name="q1" value="1" ></td>
                            <td class="text-center"><input type="checkbox" name="q1" value="2" ></td>
                            <td class="text-center"><input type="checkbox" name="q1" value="3" ></td>
                            <td class="text-center"><input type="checkbox" name="q1" value="4" ></td>
                        </tr>
                        <tr>
                            <td class="fw-6">2. La duree et le rythme de formation etaient conformes a ce qui a ete annonce</td>
                            <td class="text-center"><input type="checkbox" name="q2" value="1" ></td>
                            <td class="text-center"><input type="checkbox" name="q2" value="2" ></td>
                            <td class="text-center"><input type="checkbox" name="q2" value="3" ></td>
                            <td class="text-center"><input type="checkbox" name="q2" value="4" ></td>
                        </tr>
                        <tr>
                            <td class="fw-6">3. Les documents annonces ont ete remis aux paticipants</td>
                            <td class="text-center"><input type="checkbox" name="q3" value="1" ></td>
                            <td class="text-center"><input type="checkbox" name="q3" value="2" ></td>
                            <td class="text-center"><input type="checkbox" name="q3" value="3" ></td>
                            <td class="text-center"><input type="checkbox" name="q3" value="4" ></td>
                        </tr>
                        <tr>
                            <td class="fw-6">4. Les documtens remis constituent une aide a l'assimilation des contenus</td>
                            <td class="text-center"><input type="checkbox" name="q4" value="1" ></td>
                            <td class="text-center"><input type="checkbox" name="q4" value="2" ></td>
                            <td class="text-center"><input type="checkbox" name="q4" value="3" ></td>
                            <td class="text-center"><input type="checkbox" name="q4" value="4" ></td>
                        </tr>
                        <tr>
                            <td class="fw-6">5. Les contenus de la formation etainet adaptes a mon niveau initial</td>
                            <td class="text-center"><input type="checkbox" name="q5" value="1" ></td>
                            <td class="text-center"><input type="checkbox" name="q5" value="2" ></td>
                            <td class="text-center"><input type="checkbox" name="q5" value="3" ></td>
                            <td class="text-center"><input type="checkbox" name="q5" value="4" ></td>
                        </tr>
                        <tr>
                            <td class="fw-6">6. Les conditions materielles (locaux, restauration, facilite d'acces, etc.) etaient satisfaisantes</td>
                            <td class="text-center"><input type="checkbox" name="q6" value="1" ></td>
                            <td class="text-center"><input type="checkbox" name="q6" value="2" ></td>
                            <td class="text-center"><input type="checkbox" name="q6" value="3" ></td>
                            <td class="text-center"><input type="checkbox" name="q6" value="4" ></td>
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
                            <td class="text-center"><input type="checkbox" name="q7" value="1" ></td>
                            <td class="text-center"><input type="checkbox" name="q7" value="2" ></td>
                            <td class="text-center"><input type="checkbox" name="q7" value="3" ></td>
                            <td class="text-center"><input type="checkbox" name="q7" value="4" ></td>
                        </tr>
                        <tr>
                            <td class="fw-6">8. Le formateur dispose des competences pedagogique</td>
                            <td class="text-center"><input type="checkbox" name="q8" value="1" ></td>
                            <td class="text-center"><input type="checkbox" name="q8" value="2" ></td>
                            <td class="text-center"><input type="checkbox" name="q8" value="3" ></td>
                            <td class="text-center"><input type="checkbox" name="q8" value="4" ></td>
                        </tr>
                        <tr>
                            <td class="fw-6">9. Le formateur a su creer ou entretenir une ambiance agreable dans le groupe en formation</td>
                            <td class="text-center"><input type="checkbox" name="q9" value="1" ></td>
                            <td class="text-center"><input type="checkbox" name="q9" value="2" ></td>
                            <td class="text-center"><input type="checkbox" name="q9" value="3" ></td>
                            <td class="text-center"><input type="checkbox" name="q9" value="4" ></td>
                        </tr>
                        <tr>
                            <td class="fw-6">10. Les moyens pedagogiques etaient adaptes au contenu de la formation</td>
                            <td class="text-center"><input type="checkbox" name="q10" value="1" ></td>
                            <td class="text-center"><input type="checkbox" name="q10" value="2" ></td>
                            <td class="text-center"><input type="checkbox" name="q10" value="3" ></td>
                            <td class="text-center"><input type="checkbox" name="q10" value="4" ></td>
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
                            <td class="text-center"><input type="checkbox" name="q11" value="1"></td>
                            <td class="text-center"><input type="checkbox" name="q11" value="2"></td>
                            <td class="text-center"><input type="checkbox" name="q11" value="3"></td>
                            <td class="text-center"><input type="checkbox" name="q11" value="4"></td>
                        </tr>
                        <tr>
                            <td class="fw-6">12. D'une maniere generale, cette formation me permettra d'ameliorer mes competences professionnelles</td>
                            <td class="text-center"><input type="checkbox" name="q12" value="1" ></td>
                            <td class="text-center"><input type="checkbox" name="q12" value="2" ></td>
                            <td class="text-center"><input type="checkbox" name="q12" value="3" ></td>
                            <td class="text-center"><input type="checkbox" name="q12" value="4" ></td>
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
                                    <li class="my-2"><input type="text" name="suggestion1" style="width:90%"></li>
                                    <li class="mb-2"><input type="text" name="suggestion2" style="width:90%"></li>
                                    <li class="mb-2"><input type="text" name="suggestion3" style="width:90%"></li>
                                </ul>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary">Envoyer</button>
            </form>
        </div>

        <?php
    // end not isset variable do in Get 
    }elseif($do == 'Insert'){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            $idParticipe = $_POST['idParticipe'];
            $q1     = $_POST['q1'];
            $q2     = $_POST['q2'];
            $q3     = $_POST['q3'];
            $q4     = $_POST['q4'];
            $q5     = $_POST['q5'];
            $q6     = $_POST['q6'];
            $q7     = $_POST['q7'];
            $q8     = $_POST['q8'];
            $q9     = $_POST['q9'];
            $q10    = $_POST['q10'];
            $q11    = $_POST['q11'];
            $q12    = $_POST['q12'];


            $suggestion1 = $_POST['suggestion1'];
            $suggestion2 = $_POST['suggestion2'];
            $suggestion3 = $_POST['suggestion3'];
            $rowcont = InsertEvaluationChaud($idParticipe, $q1, $q2, $q3, $q4, $q5, $q6, $q7, $q8, $q9, $q10, $q11, $q12, $suggestion1, $suggestion2, $suggestion3);
            echo $rowcont;
        }
    }

} else {
    header("Location: loginEChaud.php");
}

?>
<script>
    // to Check one CheckBox in Section
    $('input[type="checkbox"]').on('change', function() {
        $(this).parent().siblings('td').children('input[type="checkbox"]').not(this).prop('checked', false);
    });
</script>
<?php
include 'includes/templates/footer.php';
