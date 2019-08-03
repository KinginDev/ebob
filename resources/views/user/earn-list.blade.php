@extends('user')
@section('content')

    <!-- get in touch area start -->
    <div class="get-in-touch-area cotnact-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 remove-col-padding">
                    <div class="panel panel-primary panel-custom "><!-- single pricing table -->
                        <div class="panel-heading ">
                            <h4 class="name text-uppercase inline-block">
                                <i class="fa fa-list"></i> {{$page_title}}
                            </h4>
                        </div>
                        <div class="panel-body">
                            <div class="contact-form-wrapper">

                                <table class="table table-default table-responsive">
                                    <thead>
                                    <tr>
                                        <th scope="col">SL</th>
                                        <th scope="col">Username </th>
                                        <th scope="col">Created Date</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @if(count($invests) >0)
                                        @foreach($invests as $k=>$data)
                                            <tr>
                                                <td data-label="SL">{{++$k}}</td>
                                                <td data-label="Username">
                                                    <strong>{{$data->creator->username or '-'}}</strong>
                                                </td>
                                                <td data-label="Created Date">
                                                    {!! date(' d M, Y ', strtotime($data->created_at)) !!} </td>

                                                <td data-label="Action">
                                                    <a href="{{route('get.earnStone.list',$data->escrow_code)}}" class="btn btn-md btn-success">
                                                        <i class="fa fa-eye"></i> View Transaction
                                                    </a>
                                                </td>
                                            </tr>

                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6"> No data Found   !!</td>
                                        </tr>

                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <!-- //.content form wrapper -->

                            <div class="post-navigation">
                                <ul class="pagination">
                                    {{ $invests->links('partials.pagination') }}
                                </ul>
                            </div>

                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <!-- get in touch area end -->




@stop