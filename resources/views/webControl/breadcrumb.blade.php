@extends('admin.layout.master')
@section('import-css')
    <link href="{{ asset('assets/admin/css/bootstrap-fileinput.css') }}" rel="stylesheet">
@stop
@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">

                    <form action="" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}


                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Change
                                            Header Image</strong></label>
                                    <div class="col-sm-12">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="input-group input-large">
                                                <div class="form-control uneditable-input input-fixed input-medium"
                                                     data-trigger="fileinput">
                                                    <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                                    <span class="fileinput-filename"> </span>
                                                </div>
                                                <span class="input-group-addon btn btn-success btn-file">
                                                                    <span class="fileinput-new  bold"> Change Header Image </span>
                                                                    <span class="fileinput-exists bold"> Change </span>
                                                                    <input type="file" name="header_vector"> </span>
                                                <a href="javascript:;" style="margin-left: 5px"
                                                   class="input-group-addon btn btn-danger fileinput-exists"
                                                   data-dismiss="fileinput"> Remove </a>
                                            </div>
                                            <code>Header Image Mimes Type : png </code>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <img class="img-responsive" src="{{ asset('assets/images/logo/header-vector.png') }}"
                                     alt="logo" width="100%">
                            </div>
                        </div>
                        <br><br>

                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Change
                                            breadcrumb Image</strong></label>
                                    <div class="col-sm-12">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="input-group input-large">
                                                <div class="form-control uneditable-input input-fixed input-medium"
                                                     data-trigger="fileinput">
                                                    <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                                    <span class="fileinput-filename"> </span>
                                                </div>
                                                <span class="input-group-addon btn btn-success btn-file">
                                                                    <span class="fileinput-new  bold"> Change breadcrumb Image </span>
                                                                    <span class="fileinput-exists bold"> Change </span>
                                                                    <input type="file" name="breadcrumb"> </span>
                                                <a href="javascript:;" style="margin-left: 5px"
                                                   class="input-group-addon btn btn-danger fileinput-exists"
                                                   data-dismiss="fileinput"> Remove </a>
                                            </div>
                                            <code>breadcrumb Image Mimes Type : jpg </code>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <img class="img-responsive" src="{{ asset('assets/images/logo/breadcrumb.jpg') }}"
                                     alt="logo" width="100%">
                            </div>
                        </div>
                        <br><br>


                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Change
                                            How-it-work Background Image</strong></label>
                                    <div class="col-sm-12">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="input-group input-large">
                                                <div class="form-control uneditable-input input-fixed input-medium"
                                                     data-trigger="fileinput">
                                                    <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                                    <span class="fileinput-filename"> </span>
                                                </div>
                                                <span class="input-group-addon btn btn-success btn-file">
                                                                    <span class="fileinput-new  bold"> Change How-it-work bg-Image </span>
                                                                    <span class="fileinput-exists bold"> Change </span>
                                                                    <input type="file" name="how_it_work"> </span>
                                                <a href="javascript:;" style="margin-left: 5px"
                                                   class="input-group-addon btn btn-danger fileinput-exists"
                                                   data-dismiss="fileinput"> Remove </a>
                                            </div>
                                            <code>How-it-work Mimes Type : jpg </code>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                </div>


                            </div>

                            <div class="col-md-5">
                                <img class="img-responsive" src="{{ asset('assets/images/logo/how-it-work.jpg') }}"
                                     alt="logo" width="100%">
                            </div>
                        </div>

                        <br><br>

                        <div class="row">
                            <div class="col-md-7">

                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Change Feature-image </strong></label>
                                    <div class="col-sm-12">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="input-group input-large">
                                                <div class="form-control uneditable-input input-fixed input-medium"
                                                     data-trigger="fileinput">
                                                    <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                                    <span class="fileinput-filename"> </span>
                                                </div>
                                                <span class="input-group-addon btn btn-success btn-file">
                                                                    <span class="fileinput-new  bold"> Change Feature-image </span>
                                                                    <span class="fileinput-exists bold"> Change </span>
                                                                    <input type="file" name="feature_image"> </span>
                                                <a href="javascript:;" style="margin-left: 5px"
                                                   class="input-group-addon btn btn-danger fileinput-exists"
                                                   data-dismiss="fileinput"> Remove </a>
                                            </div>
                                            <code>Feature-Image Mimes Type : png </code>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                </div>

                            </div>
                            <div class="col-md-5">
                                <img class="img-responsive" src="{{ asset('assets/images/logo/feature-image.png') }}"
                                     alt="logo" width="40%">
                            </div>
                        </div>
                        <br><br>

                        <div class="row">
                            <div class="col-md-7">

                                <div class="form-group">
                                    <label class="col-md-12"><strong class="text-uppercase">Change Faq-image </strong></label>
                                    <div class="col-sm-12">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="input-group input-large">
                                                <div class="form-control uneditable-input input-fixed input-medium"
                                                     data-trigger="fileinput">
                                                    <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                                    <span class="fileinput-filename"> </span>
                                                </div>
                                                <span class="input-group-addon btn btn-success btn-file">
                                                                    <span class="fileinput-new  bold"> Change Faq-image </span>
                                                                    <span class="fileinput-exists bold"> Change </span>
                                                                    <input type="file" name="faq"> </span>
                                                <a href="javascript:;" style="margin-left: 5px"
                                                   class="input-group-addon btn btn-danger fileinput-exists"
                                                   data-dismiss="fileinput"> Remove </a>
                                            </div>
                                            <code>Faq-Image Mimes Type : png </code>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                </div>

                            </div>
                            <div class="col-md-5">
                                <img class="img-responsive" src="{{ asset('assets/images/logo/faq.png') }}"
                                     alt="logo" width="40%">
                            </div>
                        </div>
                        <br><br>
                        <div class="row">
                            <div class="col-md-7">

                                <div class="form-group">
                                    <label class="col-md-12"><strong class="text-uppercase">Change Footer-Background Image </strong></label>
                                    <div class="col-sm-12">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="input-group input-large">
                                                <div class="form-control uneditable-input input-fixed input-medium"
                                                     data-trigger="fileinput">
                                                    <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                                    <span class="fileinput-filename"> </span>
                                                </div>
                                                <span class="input-group-addon btn btn-success btn-file">
                                                                    <span class="fileinput-new  bold"> Change Footer-bg </span>
                                                                    <span class="fileinput-exists bold"> Change </span>
                                                                    <input type="file" name="footer_bg"> </span>
                                                <a href="javascript:;" style="margin-left: 5px"
                                                   class="input-group-addon btn btn-danger fileinput-exists"
                                                   data-dismiss="fileinput"> Remove </a>
                                            </div>
                                            <code>Footer-background Image Mimes Type : jpg </code>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                </div>

                            </div>
                            <div class="col-md-5">
                                <img class="img-responsive" src="{{ asset('assets/images/logo/footer_bg.jpg') }}"
                                     alt="logo" width="100%">
                            </div>
                        </div>
                        <br><br>


                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary bold btn-block"><i
                                            class="fa fa-send"></i> UPDATE
                                </button>
                            </div>

                    </form>


                </div>
            </div>
        </div>
    </div>


@stop

@section('import-script')
    <script src="{{ asset('assets/admin/js/bootstrap-fileinput.js') }}"></script>
@stop