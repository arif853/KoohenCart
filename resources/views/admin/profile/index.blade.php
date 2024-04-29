@extends('layouts.admin')
@section('title','Profile Setting')

@section('content')
    <div class="content-header">
        <h3 class="content-title">Profile setting </h3>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row gx-5">
                <aside class="col-lg-2 border-end">

                    <ul class="nav nav-tabs flex-lg-column mb-4" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <a class="nav-link active" id="general-tab"
                          data-bs-toggle="tab" data-bs-target="#general"
                          role="tab" aria-controls="general"
                          aria-selected="true">General</a>
                        </li>
                        {{-- <li class="nav-item" role="presentation">
                          <a class="nav-link" id="admin-tab"
                          data-bs-toggle="tab" data-bs-target="#admin"
                           role="tab" aria-controls="admin"
                          aria-selected="false">Admin account</a>
                        </li> --}}
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="social-tab"
                            data-bs-toggle="tab" data-bs-target="#social"
                             role="tab" aria-controls="social"
                            aria-selected="false">Social settings</a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a class="nav-link" id="SEO-tab"
                          data-bs-toggle="tab" data-bs-target="#SEO"
                          role="tab" aria-controls="SEO"
                          aria-selected="false">SEO settings</a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a class="nav-link" id="mail-tab"
                          data-bs-toggle="tab" data-bs-target="#mail"
                          role="tab" aria-controls="mail"
                          aria-selected="false">Mail settings</a>
                        </li>
                      </ul>
                </aside>
                <div class="col-lg-10">
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="general" role="tabpanel" aria-labelledby="general-tab">
                            <section class="content-body p-xl-4">
                                <form>
                                    <div class="row">
                                        <div class="col-lg-7">
                                            <div class="row gx-3">
                                                <div class="col-6  mb-3">
                                                    <label class="form-label">Owner Name</label>
                                                    <input class="form-control" type="text" name="ownerName" placeholder="Type here">
                                                </div> <!-- col .// -->
                                                <div class="col-6  mb-3">
                                                    <label class="form-label">Web App Name</label>
                                                    <input class="form-control" type="text" name="webName" placeholder="Type here">
                                                </div> <!-- col .// -->
                                                <div class="col-lg-6  mb-3">
                                                    <label class="form-label">Email</label>
                                                    <input class="form-control" type="email" name="email" placeholder="example@mail.com">
                                                </div> <!-- col .// -->
                                                <div class="col-lg-6  mb-3">
                                                    <label class="form-label">Phone</label>
                                                    <input class="form-control" type="tel" name="phone" placeholder="+1234567890">
                                                </div> <!-- col .// -->
                                                <div class="col-lg-12  mb-3">
                                                    <label class="form-label">Address</label>
                                                    <input class="form-control" type="text" name="address" placeholder="Type here">
                                                </div> <!-- col .// -->
                                                <div class="col-lg-6  mb-3">
                                                    <label class="form-label">Starting Date</label>
                                                    <input class="form-control" type="date" name="startDate">
                                                </div> <!-- col .// -->
                                            </div> <!-- row.// -->
                                        </div> <!-- col.// -->
                                        <aside class="col-lg-3">
                                            <title>Logo</title>
                                            <figure class="text-lg-center">
                                                <img class="img-lg mb-3 img-avatar" src="{{asset('')}}admin/assets/imgs/people/avatar1.jpg" alt="User Photo">
                                                <figcaption>
                                                    <a class="btn btn-light rounded font-md" href="#">
                                                        <input type="file" name="" id="" >
                                                        <i class="icons material-icons md-backup font-md"></i> Upload
                                                    </a>
                                                </figcaption>
                                            </figure>
                                        </aside> <!-- col.// -->
                                        <aside class="col-lg-2">
                                            <title>Favicon</title>
                                            <figure class="text-lg-center">
                                                <img class="img-sm mb-3 img-avatar" src="{{asset('')}}admin/assets/imgs/people/avatar1.jpg" alt="User Photo">
                                                <figcaption>
                                                    <a class="btn btn-light rounded font-md" href="#">
                                                        <i class="icons material-icons md-backup font-md"></i> Upload
                                                    </a>
                                                </figcaption>
                                            </figure>
                                        </aside> <!-- col.// -->
                                    </div> <!-- row.// -->
                                    <br>
                                    <button class="btn btn-primary" type="submit">Save </button>
                                </form>
                                <hr class="my-5">
                                <div class="row" style="max-width:920px">
                                    <div class="col-md">
                                        <article class="box mb-3 bg-light">
                                            <a class="btn float-end btn-light btn-sm rounded font-md" href="#">Change</a>
                                            <h6>Password</h6>
                                            <small class="text-muted d-block" style="width:70%">You can reset or change your password by clicking here</small>
                                        </article>
                                    </div> <!-- col.// -->

                                </div> <!-- row.// -->
                            </section> <!-- content-body .// -->
                        </div>
                        <div class="tab-pane" id="social" role="tabpanel" aria-labelledby="social-tab">
                            <h4>Social link goes here!!</h4>
                        </div>
                        <div class="tab-pane" id="SEO" role="tabpanel" aria-labelledby="SEO-tab">
                            <h4>SEO goes here!!</h4>
                            ...
                        </div>
                        <div class="tab-pane" id="mail" role="tabpanel" aria-labelledby="mail-tab">
                            <h4>Mail Setup link goes here!!</h4>
                            ...
                        </div>
                    </div>

                </div> <!-- col.// -->
            </div> <!-- row.// -->
        </div> <!-- card body end// -->
    </div> <!-- card end// -->
@endsection
