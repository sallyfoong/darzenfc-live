<?php
$pagePin = '0';

include 'include/connection.php'; 

?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
<?php echo $header; ?>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <?php echo $menu; ?>
        <?php echo $sideMenu; ?>
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Dashboard-2</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Library
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-md-6 col-lg-3" style="width:50% !important">
                        <div class="card card-hover">
                            <div class="box bg-cyan text-center">
                                <h1 class="font-light text-white">
                                    <i class="mdi mdi-view-dashboard"></i>
                                </h1>
                                <h6 class="text-white">Dashboard</h6>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-3">
                        <div class="card card-hover">
                            <div class="box bg-success text-center">
                                <h1 class="font-light text-white">
                                    <i class="mdi mdi-chart-areaspline"></i>
                                </h1>
                                <h6 class="text-white">Charts</h6>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-3">
                        <div class="card card-hover">
                            <div class="box bg-warning text-center">
                                <h1 class="font-light text-white">
                                    <i class="mdi mdi-collage"></i>
                                </h1>
                                <h6 class="text-white">Widgets</h6>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-3">
                        <div class="card card-hover">
                            <div class="box bg-danger text-center">
                                <h1 class="font-light text-white">
                                    <i class="mdi mdi-border-outside"></i>
                                </h1>
                                <h6 class="text-white">Tables</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Latest Posts</h4>
                            </div>
                            <div class="comment-widgets scrollable">
                                <!-- Comment Row -->
                                <div class="d-flex flex-row comment-row mt-0">
                                    <div class="p-2">
                                        <img src="../assets/images/users/1.jpg" alt="user" width="50"
                                            class="rounded-circle" />
                                    </div>
                                    <div class="comment-text w-100">
                                        <h6 class="font-medium">James Anderson <span class="text-muted float-end">April
                                                14, 2021</span></h6>
                                        <span class="mb-3 d-block">Lorem Ipsum is simply dummy text of the printing and
                                            type setting industry.
                                        </span>
                                    </div>
                                </div>
                                <!-- Comment Row -->
                                <div class="d-flex flex-row comment-row">
                                    <div class="p-2">
                                        <img src="../assets/images/users/4.jpg" alt="user" width="50"
                                            class="rounded-circle" />
                                    </div>
                                    <div class="comment-text active w-100">
                                        <h6 class="font-medium">Michael Jorden<span class="text-muted float-end">May 10,
                                                2021</span></h6>
                                        <span class="mb-3 d-block">Lorem Ipsum is simply dummy text of the printing and
                                            type setting industry.
                                        </span>
                                    </div>
                                </div>
                                <!-- Comment Row -->
                                <div class="d-flex flex-row comment-row">
                                    <div class="p-2">
                                        <img src="../assets/images/users/5.jpg" alt="user" width="50"
                                            class="rounded-circle" />
                                    </div>
                                    <div class="comment-text w-100">
                                        <h6 class="font-medium">Johnathan Doeting<span
                                                class="text-muted float-end">August 1, 2021</span></h6>
                                        <span class="mb-3 d-block">Lorem Ipsum is simply dummy text of the printing and
                                            type setting industry.
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">

                        <!-- card new -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-0">News Updates</h4>
                            </div>
                            <ul class="list-style-none">
                                <li class="d-flex no-block card-body">
                                    <i class="mdi mdi-check-circle fs-4 w-30px mt-1"></i>
                                    <div>
                                        <a href="#" class="mb-0 font-medium p-0">Lorem ipsum dolor sit amet, consectetur
                                            adipiscing
                                            elit.</a>
                                        <span class="text-muted">dolor sit amet, consectetur adipiscing</span>
                                    </div>
                                    <div class="ms-auto">
                                        <div class="tetx-right">
                                            <h5 class="text-muted mb-0">20</h5>
                                            <span class="text-muted font-16">Jan</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex no-block card-body border-top">
                                    <i class="mdi mdi-gift fs-4 w-30px mt-1"></i>
                                    <div>
                                        <a href="#" class="mb-0 font-medium p-0">Congratulation Maruti, Happy
                                            Birthday</a>
                                        <span class="text-muted">many many happy returns of the day</span>
                                    </div>
                                    <div class="ms-auto">
                                        <div class="tetx-right">
                                            <h5 class="text-muted mb-0">11</h5>
                                            <span class="text-muted font-16">Jan</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex no-block card-body border-top">
                                    <i class="mdi mdi-plus fs-4 w-30px mt-1"></i>
                                    <div>
                                        <a href="#" class="mb-0 font-medium p-0">Maruti is a Responsive Admin theme</a>
                                        <span class="text-muted">But already everything was solved. It will ...</span>
                                    </div>
                                    <div class="ms-auto">
                                        <div class="tetx-right">
                                            <h5 class="text-muted mb-0">19</h5>
                                            <span class="text-muted font-16">Jan</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex no-block card-body border-top">
                                    <i class="mdi mdi-leaf fs-4 w-30px mt-1"></i>
                                    <div>
                                        <a href="#" class="mb-0 font-medium p-0">Envato approved Maruti Admin
                                            template</a>
                                        <span class="text-muted">i am very happy to approved by TF</span>
                                    </div>
                                    <div class="ms-auto">
                                        <div class="tetx-right">
                                            <h5 class="text-muted mb-0">20</h5>
                                            <span class="text-muted font-16">Jan</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex no-block card-body border-top">
                                    <i class="mdi mdi-comment-question-outline fs-4 w-30px mt-1"></i>
                                    <div>
                                        <a href="#" class="mb-0 font-medium p-0">
                                            I am alwayse here if you have any question</a>
                                        <span class="text-muted">we glad that you choose our template</span>
                                    </div>
                                    <div class="ms-auto">
                                        <div class="tetx-right">
                                            <h5 class="text-muted mb-0">15</h5>
                                            <span class="text-muted font-16">Jan</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="card-title">Calender</h5>
                        <div class="card">
                            <div class="">
                                <div class="row">
                                    <div class="col-lg-3 border-right pe-0">
                                        <div class="card-body border-bottom">
                                            <h4 class="card-title mt-2">Drag & Drop Event</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div id="calendar-events" class="">
                                                        <div class="calendar-events mb-3" data-class="bg-info">
                                                            <i class="fa fa-circle text-info me-2"></i>Event
                                                            One
                                                        </div>
                                                        <div class="calendar-events mb-3" data-class="bg-success">
                                                            <i class="fa fa-circle text-success me-2"></i>
                                                            Event Two
                                                        </div>
                                                        <div class="calendar-events mb-3" data-class="bg-danger">
                                                            <i class="fa fa-circle text-danger me-2"></i>Event Three
                                                        </div>
                                                        <div class="calendar-events mb-3" data-class="bg-warning">
                                                            <i class="fa fa-circle text-warning me-2"></i>Event Four
                                                        </div>
                                                    </div>
                                                    <!-- checkbox -->
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="drop-remove" />
                                                        <label class="form-check-label" for="drop-remove">Remove after
                                                            drop</label>
                                                    </div>
                                                    <a href="javascript:void(0)" data-toggle="modal"
                                                        data-target="#add-new-event" class="
                                d-flex
                                align-items-center
                                justify-content-center
                                btn
                                mt-3
                                btn-info
                                d-block
                                waves-effect waves-light
                              ">
                                                        <i class="mdi mdi-plus fs-4 me-1"></i> Add New
                                                        Event
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="card-body b-l calender-sidebar">
                                            <div id="calendar"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- BEGIN MODAL -->
                <div class="modal none-border" id="my-event">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"><strong>Add Event</strong></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                    &times;
                                </button>
                            </div>
                            <div class="modal-body"></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">
                                    Close
                                </button>
                                <button type="button" class="btn btn-success save-event waves-effect waves-light">
                                    Create event
                                </button>
                                <button type="button" class="btn btn-danger delete-event waves-effect waves-light"
                                    data-dismiss="modal">
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Add Category -->
                <div class="modal fade none-border" id="add-new-event">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"><strong>Add</strong> a category</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                    &times;
                                </button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="control-label">Category Name</label>
                                            <input class="form-control form-white" placeholder="Enter name" type="text"
                                                name="category-name" />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label">Choose Category Color</label>
                                            <select class="form-select shadow-none form-white"
                                                data-placeholder="Choose a color..." name="category-color">
                                                <option value="success">Success</option>
                                                <option value="danger">Danger</option>
                                                <option value="info">Info</option>
                                                <option value="primary">Primary</option>
                                                <option value="warning">Warning</option>
                                                <option value="inverse">Inverse</option>
                                            </select>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="
                      btn btn-danger
                      waves-effect waves-light
                      save-category
                    " data-dismiss="modal">
                                    Save
                                </button>
                                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">
                                    Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END MODAL -->

                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
                All Rights Reserved by Dar Zen Food Centre. Designed and Developed by
                Sally.
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== --><?php include_once "include/footerJquery.php"; ?>
</body>

</html>