@extends("admin.layout.main")
@section("title", "Dashboard - ")

@section("main-section")
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Cards with few info -->
        <div class="row">
            <!-- single card  -->
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-widget-separator-wrapper">
                        <div class="card-body card-widget-separator">
                            <div class="row gy-4 gy-sm-1">
                                <div class="col-sm-12 col-lg-4">
                                    <div class="d-flex justify-content-between align-items-start card-widget-2 border-end pb-3 pb-sm-0">
                                        <div>
                                            <h3 class="mb-1">{{ $posts }}</h3>
                                            <p class="mb-0">Posts</p>
                                        </div>
                                        <span class="badge bg-label-secondary rounded p-2 me-lg-4">
                                            <i class="fa-solid fa-building bx-sm"></i>
                                        </span>
                                    </div>
                                    <hr class="d-none d-sm-block d-lg-none">
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <div class="d-flex justify-content-between align-items-start card-widget-2 border-end pb-3 pb-sm-0">
                                        <div>
                                            <h3 class="mb-1">0</h3>
                                            <p class="mb-0">Reels</p>
                                        </div>
                                        <span class="badge bg-label-secondary rounded p-2 me-lg-4">
                                            <i class="fa-solid fa-tag bx-sm"></i>
                                        </span>
                                    </div>
                                    <hr class="d-none d-sm-block d-lg-none me-4">
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <div class="d-flex justify-content-between align-items-start card-widget-2 border-end pb-3 pb-sm-0">
                                        <div>
                                            <h3 class="mb-1">{{ $users }}</h3>
                                            <p class="mb-0">User</p>
                                        </div>
                                        <span class="badge bg-label-secondary rounded p-2 me-lg-4">
                                            <i class="fa-solid fa-user bx-sm"></i>
                                        </span>
                                    </div>
                                    <hr class="d-none d-sm-block d-lg-none me-4">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /single card  -->
        </div>
        <!--/ Cards with few info -->

    </div>
@endsection
