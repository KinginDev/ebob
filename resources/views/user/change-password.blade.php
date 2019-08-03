@extends('user')
@section('content')

    <!-- get in touch area start -->
    <div class="get-in-touch-area cotnact-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 remove-col-padding">
                        <div class="section-title text-center">
                            <h2 class="title">
                                <strong> {{$page_title}}</strong>
                            </h2>
                        </div>
                    <div class="contact-form-wrapper">
                        <!-- content form wrapper -->
                        <form action="" method="post" role="form">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-element margin-bottom-30">
                                        <input type="password" name="current_password" class="input-field" placeholder="Current Password">
                                        @if ($errors->has('current_password'))
                                            <span class="error form-error-msg ">
                                                <strong>{{ $errors->first('current_password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-element margin-bottom-30">
                                        <input type="password" name="password" class="input-field"
                                               placeholder="New Password">
                                        @if ($errors->has('password'))
                                            <span class="error form-error-msg ">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-element margin-bottom-30">
                                        <input type="password" name="password_confirmation" class="input-field"
                                               placeholder="Confirm Password">
                                        @if ($errors->has('password_confirmation'))
                                            <span class="error form-error-msg ">
                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-element has-icon margin-bottom-20"></div>
                                    <input type="submit" value="Change Password" class="submit-btn btn-block">
                                </div>

                            </div>
                        </form>
                    </div>
                    <!-- //.content form wrapper -->
                </div>
            </div>
        </div>
    </div>
    <!-- get in touch area end -->




@endsection

@section('script')
    @if (session('message'))
        <script type="text/javascript">
            $(document).ready(function () {
                swal("Success!", "{{ session('message') }}", "success");
            });
        </script>
    @endif

    @if (session('alert'))
        <script type="text/javascript">
            $(document).ready(function () {
                swal("Sorry!", "{{ session('alert') }}", "error");
            });
        </script>
    @endif
@endsection
