<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}
$pageTitle = 'Statistic Page';
include "init.php";

?>

<div class="container">
    <div class="page-content">
        <!-- end widgets -->
        <div class="row mb-2 ">
            <div class="col-12">
                <h5 class="text-decoration-underline mb-1 mt-2 pb-1">Filter</h5>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-6 mb-2">
                        <label for="from" class="form-label">From</label>
                        <input type="date" id="from" class="form-control input-shadow" onchange="getByFilter()">
                    </div>
                    <div class="col-6 mb-2">
                        <label for="to" class="form-label">To</label>
                        <input type="date" name="" id="to" class="form-control input-shadow" onchange="getByFilter()">
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="mb-3">
                    <label for="option" class="form-label">Option</label>
                    <select name="" onchange="getByFilter()" id="option" class="form-control input-shadow">
                        <option value="1">PLANNED AND REALIZED</option>
                        <option value="2">PLANNED AND UNREALIZED</option>
                        <option value="3">UNPLANNED AND UNREALIZED</option>
                    </select>
                </div>
            </div>
        </div>
        <div id="welcome" class="mb-4 bg-w">

        </div>

        <!-- GET  Total houres -->
        <div class="houres_formation_realized">

            <!-- End Filter Section -->
            <h5 class="text-decoration-underline mb-1 mt-2 pb-1">Houres Formation Realized:</h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card card-animate bg-success">
                                <div class="card-body">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <p class="text-uppercase fw-medium cl-w mb-0 small">Total</p>
                                    </div>
                                    <div class="text-center mt-2">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-2 text-white"><?php echo getHoures()[0]; ?></h4>
                                        </div>

                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div>
                        <div class="col-md-4">
                            <div class="card card-animate bg-success">
                                <div class="card-body">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <p class="text-uppercase fw-medium cl-w mb-0 small">This year</p>
                                    </div>
                                    <div class="text-center mt-2">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-2 text-white"><?php echo getHoures("AND `year` = ". date('Y'))[0]; ?></h4>
                                        </div>

                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div>
                        <div class="col-md-4" id="houres_card_3">
                            

                                <!-- will set data here  -->

                            </div><!-- end card -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="houres_year" class="form-label">Choose Year</label>
                    <input type="number" id="houres_year" min="1990" max="2050" class="form-control input-shadow" placeholder="Enter Year">
                </div>
                <div class="col-md-2 d-flex flex-column justify-content-end">
                    <button type="button" class="btn btn-primary" onclick="getHouresYear()">get houres</button>
                </div>
            </div>
        </div>

        <!-- GET Total Groups -->
        <div class="total-groups">
            <!-- End Filter Section -->
            <h5 class="text-decoration-underline mb-1 mt-2 pb-1">Groups :</h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card card-animate bg-success">
                                <div class="card-body">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <p class="text-uppercase fw-medium cl-w mb-0 small">Total</p>
                                    </div>
                                    <div class="text-center mt-2">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-2 text-white"><?php echo getGroups(); ?></h4>
                                        </div>

                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div>
                        <div class="col-md-4">
                            <div class="card card-animate bg-success">
                                <div class="card-body">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <p class="text-uppercase fw-medium cl-w mb-0 small">This year</p>
                                    </div>
                                    <div class="text-center mt-2">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-2 text-white"><?php echo getGroupOfYear(date('Y')); ?></h4>
                                        </div>

                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div>
                        <div class="col-md-4" id="groups_card_3">
                            

                                <!-- will set data here  -->

                            </div><!-- end card -->
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="groups_year" class="form-label">Choose Year</label>
                    <input type="number" id="groups_year" min="1990" max="2050" class="form-control input-shadow" placeholder="Enter Year">
                </div>
                <div class="col-md-2 d-flex flex-column justify-content-end">
                    <button type="button" class="btn btn-primary" onclick="getGroupsYear()">get Groups</button>
                </div>
            </div>
        </div>
    </div>
</div>



<?php
include 'includes/templates/footer.php';
