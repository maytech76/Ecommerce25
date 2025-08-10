<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    
    @include('admin.partials2.head')

<body>
    <!-- tap on top start -->
    <div class="tap-top">
        <span class="lnr lnr-chevron-up"></span>
    </div>
    <!-- tap on tap end -->

    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">

            <!-- Page Header Start-->
             @include('admin.partials2.header')
            <!-- Page Header Ends-->

            <!-- Page Body Start-->
            <div class="page-body-wrapper">

                <!-- Page Sidebar Start-->
                @include('admin.partials2.sidebar')
                <!-- Page Sidebar Ends-->

            
                @yield('content')

            </div>
        <!-- Page Body End -->
    </div>

    <!-- page-wrapper End-->

     <!-- footer start-->
    @include('admin.partials2.footer')
    <!-- footer End-->

    <!-- Modal Start -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <h5 class="modal-title" id="staticBackdropLabel">Logging Out</h5>
                    <p>Are you sure you want to log out?</p>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="button-box">
                        <button type="button" class="btn btn--no" data-bs-dismiss="modal">No</button>
                        <button type="button" class="btn  btn--yes btn-primary">Yes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal End -->

    <!-- latest js -->
    @include('admin.partials2.scripts')
</body>

</html>