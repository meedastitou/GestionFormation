<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}

include "init.php";




$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

if ($do == 'Manage') {
    // manage page formation
    ?>
    <!-- Modal -->
    <div class="modal fade" id="editFormation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Formation</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="bg-w p-4">
                        <div class="card-body">
                            <div class="live-preview">
                                <div class="mb-3">
                                    <label for="formationName" class="form-label">formation Name</label>
                                    <input type="text" class="form-control input-shadow" name="formationName" placeholder="Enter formation Name" id="formationName">
                                </div>
                                <div class="mb-3">
                                    <label for="formationCat" class="form-label">formation Categorie</label>
                                    <input type="text" class="form-control input-shadow" name="formationCat" placeholder="Enter formation Categorie" id="formationCat">
                                </div>
                                <div class="mb-3">
                                    <label for="objectif" class="form-label">Formation Objective</label>
                                    <textarea class="form-control input-shadow" name="objectif" placeholder="Enter The purpose of this Formation" id="objectif"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="proposedBy" class="form-label">Proposed by</label>
                                    <input list="listServices" name="proposedBy" class="form-control input-shadow" id="proposedBy">

                                    <datalist id="listServices">
                                        <option value="service 1">
                                        <option value="service 2">
                                        <option value="service 3">
                                        <option value="service 4">
                                        <option value="service 5">
                                    </datalist>
                                </div>
                                <div class="mb-3">
                                    <label for="formationEI" class="form-label">Formation (externe/ interne)</label>
                                    <select name="formationEI" class="form-control input-shadow" id="formationEI">
                                        <option value="Externe" id="formationE">Externe</option>
                                        <option value="Interne" id="formationI">Interne</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="numberHoures" class="form-label">Number Of Houres</label>
                                    <input type="Number" min="1" class="form-control input-shadow" name="numberHoures" placeholder="Enter Number of Houres for the formation" id="numberHoures">
                                </div>

                                <div class="mb-3">
                                    <label for="trainerName" class="form-label">trainer's name</label>
                                    <input type="text" class="form-control input-shadow" name="trainerName" placeholder="Enter trainer's name" id="trainerName">
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="trainerNumber" class="form-label">trainer Number</label>
                                        <input type="tel" class="form-control input-shadow" name="trainerNumber" placeholder="+(212) 451 45123" id="trainerNumber">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="trainerEmail" class="form-label">trainer Email Address</label>
                                    <input type="email" class="form-control input-shadow" name="trainerEmail" placeholder="example@gamil.com" id="trainerEmail">
                                </div>
                                <div class="mb-3">
                                    <label for="traininigSite" class="form-label">training site </label>
                                    <input type="text" class="form-control input-shadow" name="traininigSite" placeholder="Address 1" id="traininigSite">
                                </div>
                                <div class="mb-3">
                                    <label for="nbParticepants" class="form-label">numbre of participants</label>
                                    <input type="number" class="form-control input-shadow" name="nbParticepants" placeholder="Enter numbre of participants" id="nbParticepants">
                                </div>
                                <div class="mb-3">
                                    <label for="mySelect" class="form-label">responsible</label>
                                        <select id="mySelect" name="responsible" class="select2 form-control input-shadow" >
                                            <?php
                                        $query = "
                                        SELECT * FROM employe ORDER BY Matricule ASC
                                                ";

                                        $result = $con->query($query);

                                        foreach ($result as $row) {
                                            echo '<option value="' . $row["Matricule"] . '">' .$row["Matricule"] . '. ' . $row["Nom"] .' '. $row['Prenom'] .'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="dateStart" class="form-label">date start</label>
                                            <input type="date" class="form-control input-shadow" name="dateStart" placeholder="Enter Date Start" id="dateStart">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="dateFin" class="form-label">date Fin</label>
                                            <input type="date" class="form-control input-shadow" name="dateFin" placeholder="Enter Date Fin" id="dateFin">
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                            </div>
                            <!--end row-->
                            <input type="hidden" style="display:hidden;" name="idFormaiton" id="idFormaiton">
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="saveEdit()">Save changes</button>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="detailsFormation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Details Formation</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="bg-w p-4">
                        <div class="card-body">
                            <div class="live-preview">
                                <div class="mb-3">
                                    <label for="formationName" class="form-label">formation Name</label>
                                    <input type="text" class="form-control input-shadow" name="formationName" placeholder="Enter formation Name" id="DformationName">
                                </div>
                                <div class="mb-3">
                                    <label for="formationCat" class="form-label">formation Categorie</label>
                                    <input type="text" class="form-control input-shadow" name="formationCat" placeholder="Enter formation Categorie" id="DformationCat">
                                </div>
                                <div class="mb-3">
                                    <label for="Dobjectif" class="form-label">formation objective</label>
                                    <input type="text" class="form-control input-shadow" name="objectif" placeholder="Enter formation Categorie" id="Dobjectif">
                                </div>
                                <div class="mb-3">
                                    <label for="Dres" class="form-label">formation responsible</label>
                                    <input type="text" class="form-control input-shadow" name="res" placeholder="Enter formation Categorie" id="Dres">
                                </div>
                                <div class="mb-3">
                                    <label for="proposedBy" class="form-label">Proposed by</label>
                                    <input list="listServices" name="proposedBy" class="form-control input-shadow" id="DproposedBy">

                                    <datalist id="listServices">
                                        <option value="service 1">
                                        <option value="service 2">
                                        <option value="service 3">
                                        <option value="service 4">
                                        <option value="service 5">
                                    </datalist>
                                </div>
                                <div class="mb-3">
                                    <label for="formationEI" class="form-label">Formation (externe/ interne)</label>
                                    <select name="formationEI" class="form-control input-shadow" id="DformationEI">
                                        <option value="Externe" id="formationE">Externe</option>
                                        <option value="Interne" id="formationI">Interne</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="numberHoures" class="form-label">Number Of Houres</label>
                                    <input type="Number" min="1" class="form-control input-shadow" name="numberHoures" placeholder="Enter Number of Houres for the formation" id="DnumberHoures">
                                </div>

                                <div class="mb-3">
                                    <label for="trainerName" class="form-label">trainer's name</label>
                                    <input type="text" class="form-control input-shadow" name="trainerName" placeholder="Enter trainer's name" id="DtrainerName">
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="trainerNumber" class="form-label">trainer Number</label>
                                        <input type="tel" class="form-control input-shadow" name="trainerNumber" placeholder="+(212) 451 45123" id="DtrainerNumber">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="trainerEmail" class="form-label">trainer Email Address</label>
                                    <input type="email" class="form-control input-shadow" name="trainerEmail" placeholder="example@gamil.com" id="DtrainerEmail">
                                </div>
                                <div class="mb-3">
                                    <label for="traininigSite" class="form-label">training site </label>
                                    <input type="text" class="form-control input-shadow" name="traininigSite" placeholder="Address 1" id="DtraininigSite">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="dateStart" class="form-label">date start</label>
                                            <input type="date" class="form-control input-shadow" name="dateStart" placeholder="Enter Date Start" id="DdateStart">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="dateFin" class="form-label">date Fin</label>
                                            <input type="date" class="form-control input-shadow" name="dateFin" placeholder="Enter Date Fin" id="DdateFin">
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                                <div class="mb-3">
                                    <label for="createdBy" class="form-label">createdBy </label>
                                    <input type="text" class="form-control input-shadow" name="createdBy" id="DCreatedBy">
                                </div>
                                <div class="mb-3">
                                    <label for="createdAt" class="form-label">createdAt </label>
                                    <input type="date" class="form-control input-shadow" name="createdAt" id="DCeatedAt">
                                </div>
                                <div class="mb-3">
                                    <label for="UpdatedBy" class="form-label">Last UbpdateBy </label>
                                    <input type="text" class="form-control input-shadow" name="updatedBy" id="DUpdatedBy">
                                </div>
                                <div class="mb-3">
                                    <label for="UpdatedAt" class="form-label">UpdatedAt </label>
                                    <input type="date" class="form-control input-shadow" name="updatedAt" id="DUpdatedAt">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>






    <!-- Content -->
    <div class="page-content">
        <div class="container">
            <div class="widgets">
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <p class="text-uppercase fw-medium text-muted mb-0">Customers</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <h5 class="text-success fs-14 mb-0">
                                            <i class="fa-solid fa-square-arrow-up-right fs-13 align-middle"></i> +29.08 %
                                        </h5>
                                    </div>
                                </div>
                                <div class="text-center mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="183.35">0</span>M</h4>
                                        <a href="#" class="text-decoration-underline">See details</a>
                                    </div>

                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate bg-success">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <p class="text-uppercase fw-medium cl-w mb-0">Orders</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <h5 class="text-warning fs-14 mb-0">
                                            <i class="fa-solid fa-square-arrow-up-right fs-13 align-middle"></i> -3.57 %
                                        </h5>
                                    </div>
                                </div>
                                <div class="text-center mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4 text-white"><span class="counter-value" data-target="36894">0</span></h4>
                                        <a href="#" class="text-decoration-underline text-white-50">View all
                                            orders</a>
                                    </div>

                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <p class="text-uppercase fw-medium text-muted mb-0">Customers</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <h5 class="text-success fs-14 mb-0">
                                            <i class="fa-solid fa-square-arrow-up-right fs-13 align-middle"></i> +29.08 %
                                        </h5>
                                    </div>
                                </div>
                                <div class="text-center mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="183.35">0</span>M</h4>
                                        <a href="#" class="text-decoration-underline">See details</a>
                                    </div>

                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate bg-success">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <p class="text-uppercase fw-medium cl-w mb-0">Orders</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <h5 class="text-warning fs-14 mb-0">
                                            <i class="fa-solid fa-square-arrow-up-right fs-13 align-middle"></i> -3.57 %
                                        </h5>
                                    </div>
                                </div>
                                <div class="text-center mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4 text-white"><span class="counter-value" data-target="36894">0</span></h4>
                                        <a href="#" class="text-decoration-underline text-white-50">View all
                                            orders</a>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                </div> <!-- end row-->

            </div>
            <!-- end widgets -->
            <div class="row">
                <div class="col-12">
                    <h5 class="text-decoration-underline mb-3 mt-2 pb-3">Last Formations</h5>
                </div>
            </div>
            <!-- end row-->

            <div class="row">
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="alert alert-warning border-0 rounded-top rounded-0 m-0 d-flex align-items-center" role="alert">
                                <i data-feather="alert-triangle" class="text-warning me-2 icon-sm"></i>
                                <div class="flex-grow-1 text-truncate">
                                    Your free trial expired in <b>17</b> days.
                                </div>
                                <div class="flex-shrink-0">
                                    <a href="pages-pricing.html" class="text-reset text-decoration-underline"><b>Upgrade</b></a>
                                </div>
                            </div>

                            <div class="row align-items-end">
                                <div class="col-sm-8">
                                    <div class="p-3">
                                        <p class="fs-16 lh-base">Upgrade your plan from a <span class="fw-semibold">Free
                                                trial</span>, to ‘Premium Plan’ <i class="fa-solid fa-arrow-right"></i></i></p>
                                        <div class="mt-3">
                                            <a href="pages-pricing.html" class="btn btn-success">Upgrade
                                                Account!</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="px-3">
                                        <img src="layout/images/user-illustarator-2.png" class="img-fluid" alt="">
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end card-body-->
                    </div>
                </div> <!-- end col-->
                <div class="col-xl-4">
                    <div class="card bg-primary">
                        <div class="card-body p-0">
                            <div class="alert alert-danger rounded-top alert-solid alert-label-icon border-0 rounded-0 m-0 d-flex align-items-center" role="alert">
                                <i class="ri-error-warning-line label-icon"></i>
                                <div class="flex-grow-1 text-truncate">
                                    Your free trial expired in <b>17</b> days.
                                </div>
                                <div class="flex-shrink-0">
                                    <a href="pages-pricing.html" class="text-reset text-decoration-underline"><b>Upgrade</b></a>
                                </div>
                            </div>

                            <div class="row align-items-end">
                                <div class="col-sm-8">
                                    <div class="p-3">
                                        <p class="fs-16 lh-base text-white">Upgrade your plan from a <span class="fw-semibold">Free
                                                trial</span>, to ‘Premium Plan’ <i class="fa-solid fa-arrow-right"></i></p>
                                        <div class="mt-3">
                                            <a href="pages-pricing.html" class="btn btn-info">Upgrade
                                                Account!</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="px-3">
                                        <img src="layout/images/user-illustarator-1.png" class="img-fluid" alt="">
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end card-body-->
                    </div>
                </div> <!-- end col-->
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="alert alert-warning border-0 rounded-top rounded-0 m-0 d-flex align-items-center" role="alert">
                                <div class="flex-grow-1 text-truncate">
                                    We will choose a gift for you in <b>5</b> days.
                                </div>
                                <div class="flex-shrink-0">
                                    <a href="pages-pricing.html" class="text-reset text-decoration-underline"><b>Get Free Gift</b></a>
                                </div>
                            </div>
                            <div class="d-flex p-3">
                                <div class="flex-shrink-0">
                                    <div class="avatar-md me-3">
                                        <span class="avatar-title bg-soft-danger rounded-circle fs-1">
                                            <i class="fa-solid fa-book-open-reader icon-book-style"></i>
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    <p class="fs-16 lh-base">Personalized <span class="fw-semibold">Gift
                                            Boxes</span>, with attitude, Let's collect your Xmas box <i class="fa-solid fa-arrow-right"></i></p>
                                    <div class="mt-3">
                                        <a href="pages-pricing.html" class="btn cl-w bg-p">Get a Free
                                            Gift</a>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end card-body-->
                    </div>
                </div> <!-- end col-->
            </div> <!-- end row-->
            <div class="list-formation">
                <div class="row">
                    <div class="col-12">
                        <h5 class="text-decoration-underline mb-3 mt-2 py-2 px-3 bg-w ">List Of Formations</h5>
                    </div>
                </div>
                <!-- end row-->
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="id_formation">#</th>
                            <th class="name_formation">formation name</th>
                            <th class="propose_formation">Proposed By</th>
                            <th class="ex_in_formation">EX/IN</th>
                            <th class="date_start">date</th>
                            <th class="duree_formation text-center">duree(h)</th>
                            <th class="contoll text-center">Controll</th>

                        </tr>
                    </thead>
                    <tbody id="table_body">
                        <?php
                        // $formations = selectBetween(1, 10);
                        // foreach ($formations as $formation) {
                        //     echo "<tr class='align-middle'>";
                        //     echo '<th scope="row" class="id_formation" >' . $formation['id_formation'] . '</th>';
                        //     echo '<td class="name_formation">' . $formation['nom_formation'] . '</td>';
                        //     echo '<td class="propose_formation">' . $formation['service_propose'] . '</td>';
                        //     echo '<td class="ex_in_formation">' . $formation['formation_EX_IN'] . '</td>';
                        //     echo '<th class="date_start">' . $formation['date_debut'] . '</th>';
                        //     echo '<th class="duree_formation text-center">' . $formation['hours_formation'] . '</th>';
                        //     echo '<th class="contoll d-flex justify-content-around">';
                        //     echo '<a href="' . $formation['id_formation'] . '" class="btn btn-primary">Edit</a>';
                        //     echo '<butoon href="" class="btn btn-danger" onclick="conf(' . $formation['id_formation'] . ')">Delete</butoon>';
                        //     echo '<a href="' . $formation['id_formation'] . '" class="btn btn-success">Details</a>';
                        //     echo '</th>';
                        //     echo '</tr>';
                        // }
                        ?>

                    </tbody>
                </table>
                <nav aria-label="...">
                    <div class="d-flex justify-content-between">
                        <a href="?do=Add"><button type="button" class="btn btn-primary">Add new Formation</button></a>
                        <ul class="pagination justify-content-center mx-3">

                            <?php
                            $connt = countFormations();
                            $page_link_selected = 1;
                            $last = $connt / 10;
                            if ($connt % 10 != 0)
                                $last++;
                            for ($i = 1; $i <= $last; $i++) {
                                echo '<li class="page-item">';
                                echo '<button id="page_link' . $i . '" class="page-link ';
                                if ($page_link_selected == $i)
                                    echo "active";
                                echo '" onclick="displayFormation(' . ($i - 1) * 10 . ', ' . 10 . ')">' . $i . '</button>';
                                echo '</li>';
                            }
                            ?>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>

    </div>
    <?php

}elseif ($do == 'Add') {
    // Add formation
    ?>
    <div class="container mt-5">
        <div class="mx-auto text-center mb-4">
            <h2>Add Formation</h2>
        </div>

        <div class="bg-w p-4">
            <div class="card-body">
                <div class="live-preview">
                    <form action="?do=Insert" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="formationName" class="form-label">formation Name</label>
                                    <input type="text" required class="form-control input-shadow" name="formationName" placeholder="Enter formation Name" id="formationName">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="formationCat" class="form-label">formation Categorie</label>
                                    <input type="text" required class="form-control input-shadow" name="formationCat" placeholder="Enter formation Categorie" id="formationCat">
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="objectif" class="form-label">Formation Objective</label>
                                    <textarea required class="form-control input-shadow" name="objectif" placeholder="Enter The purpose of this Formation" id="objectif"></textarea>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="proposedBy" class="form-label">Proposed by</label>
                                    <input list="listServices" required name="proposedBy" class="form-control input-shadow" id="proposedBy">

                                    <datalist id="listServices">
                                        <option value="service 1">
                                        <option value="service 2">
                                        <option value="service 3">
                                        <option value="service 4">
                                        <option value="service 5">
                                    </datalist>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="formationEI" class="form-label">Formation (externe/ interne)</label>
                                    <select name="formationEI" required class="form-control input-shadow" id="formationEI">
                                        <option value="1">Externe</option>
                                        <option value="2">Interne</option>
                                    </select>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="numberHoures" class="form-label">Number Of Houres</label>
                                    <input type="Number" min="1" class="form-control input-shadow" name="numberHoures" placeholder="Enter Number of Houres for the formation" id="numberHoures">
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="trainerName" required class="form-label">trainer's name</label>
                                    <input type="text" class="form-control input-shadow" name="trainerName" placeholder="Enter trainer's name" id="trainerName">
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="trainerNumber" class="form-label">trainer Number</label>
                                    <input type="tel" class="form-control input-shadow" name="trainerNumber" placeholder="+(212) 451 45123" id="trainerNumber">
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="trainerEmail" class="form-label">trainer Email Address</label>
                                    <input type="email" class="form-control input-shadow" name="trainerEmail" placeholder="example@gamil.com" id="trainerEmail">
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="traininigSite" required class="form-label">training site </label>
                                    <input type="text" class="form-control input-shadow" name="traininigSite" placeholder="Address 1" id="traininigSite">
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="nbParticepants" class="form-label">Number of participants <span>(Optional)</span></label>
                                    <input type="number" class="form-control input-shadow" name="nbParticepants" placeholder="Enter numbre of participants" id="nbParticepants">
                                </div>
                            </div>
                            
                            <!--end col-->
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="mySelect" required class="form-label">responsible</label>
                                    <select id="mySelect" name="responsible" class="select2 form-control input-shadow" >
                                        <?php
                                        $query = "
                                                SELECT * FROM employe ORDER BY Matricule ASC
                                                ";

                                        $result = $con->query($query);

                                        foreach ($result as $row) {
                                            echo '<option value="' . $row["Matricule"] . '">' .$row["Matricule"] . '. ' . $row["Nom"] .' '. $row['Prenom'] .'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="dateStart" required class="form-label">date start</label>
                                    <input type="date" class="form-control input-shadow" name="dateStart" placeholder="Enter Date Start" id="dateStart">
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="dateFin" required class="form-label">date Fin</label>
                                    <input type="date" class="form-control input-shadow" name="dateFin" placeholder="Enter Date Fin" id="dateFin">
                                </div>
                            </div>
                            <!--end col-->

                            <div class="col-lg-12">
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </form>
                </div>

            </div>
        </div>
    </div>
    <?php
} elseif ($do == 'Insert') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    ?>
        <div class="container mt-5">

            <div class="mx-auto text-center mb-4">
                <h2>Insert Formation</h2>
            </div>
            <?php

            // Get Data From Form 
            $formationName      = $_POST['formationName'];
            $formationCat       = $_POST['formationCat'];
            $objectif           = $_POST['objectif'];
            $proposedBy         = $_POST['proposedBy'];
            $numberHoures       = $_POST['numberHoures'];
            $trainerName        = $_POST['trainerName'];
            $trainerNumber      = $_POST['trainerNumber'];
            $trainerEmail       = $_POST['trainerEmail'];
            $traininigSite      = $_POST['traininigSite'];
            $nbParticepants     = $_POST['nbParticepants'];
            $dateStart          = $_POST['dateStart'];
            $dateFin            = $_POST['dateFin'];
            $formation_EX_IN    = $_POST['formationEI'];
            $responsible        = $_POST['responsible'];

            $formErrors = validation($formationName, $formationCat, $objectif, $proposedBy, $numberHoures, $trainerName, $traininigSite, $nbParticepants, $dateStart, $dateFin, $responsible);
            foreach ($formErrors as $error) {
                echo '<div class="alert alert-danger">' . $error . '</div>';
            }
            if (empty($formErrors)) {

                $connt = Insert(
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
                    $formation_EX_IN,
                    $responsible,
                    $objectif
                );


                //Echo Success Message 

                echo "<div class='container'>";

                $theMsg =  "<div class='alert alert-success'>" .  $connt . ' Record Inserted</div>';

                redirectHome($theMsg, 'back');

                echo "</div>";
            }
            ?>

        </div>
        <!-- end container -->
    <?php
}
}
include "includes/templates/footer.php";
?>