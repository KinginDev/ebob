@extends('user')

@section('css')
@stop
@section('content')

    <!-- get in touch area start -->
    <div class="get-in-touch-area cotnact-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 remove-col-padding">
                    <div class="panel panel-primary panel-custom "><!-- single pricing table -->
                        <div class="panel-heading ">
                            <h4 class="name text-uppercase inline-block">
                                <i class="fa fa-list"></i> {{$page_title}} By  {{$project->creator->username or ''}}
                            </h4>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-12">
                                @include('errors.error')
                            </div>
                            <div class="contact-form-wrapper">
                                <table class="table  table-default table-responsive">
                                    <thead>
                                    <tr>
                                        <th scope="col" style="width: 10%">Date</th>
                                        <th scope="col" style="width: 10%">Amount</th>
                                        <th scope="col" style="width: 20%">title</th>
                                        <th scope="col" style="width: 25%">Details</th>
                                        <th scope="col">Status</th>
                                        <th scope="col" style="width: 30%">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @if($project->mileStones->count() > 0)
                                        @php
                                            $mileStones = $project->mileStones()->paginate(10);
                                        @endphp

                                        @foreach($mileStones as $k=>$data)
                                            @php
                                            $data->is_read = 1;
                                            $data->save();
                                            @endphp
                                            <tr id="tr" class="black">
                                                <td data-label="Date">
                                                    {{date('d M Y',strtotime($data->created_at))}}
                                                </td>
                                                <td data-label="Amount">
                                                    <strong>{{number_format($data->amount,2)}} {{$basic->currency}}</strong>
                                                </td>
                                                <td data-label="title">
                                                    {!! $data->title  !!}
                                                </td>
                                                <td data-label="Details">
                                                    {!! $data->description !!}
                                                </td>
                                                <td data-label="Status">
                                                    @if($data->status == 0)
                                                        <span class="label label-warning ">
                                                            Pending
                                                        </span>
                                                    @elseif($data->status == -1)
                                                        <span class="label label-danger ">
                                                            Rejected
                                                        </span>
                                                    @elseif($data->status == 1)
                                                        <span class="label label-success">
                                                            Completed
                                                        </span>
                                                    @endif


                                                </td>
                                                <td data-label="Action ">

                                                    @if($data->status == 0)

                                                        @php
                                                            $report = App\Report::where('milestone_id',$data->id)->count()
                                                        @endphp
                                                        @if($report>0)
                                                            <a href="{{route('report.log.author',$data->code)}}"
                                                               class=" btn btn-info btn-md margin-bottom-10">
                                                                <i class="fab fa-facebook-messenger"></i>
                                                                View Report
                                                            </a>
                                                            <button data-toggle="modal" data-target="#release_button"
                                                                    value="3"
                                                                    data-id="{{$data->id}}"
                                                                    class="release_button btn btn-primary btn-md btn-bottom-10">
                                                                <i class="fa fa-money" aria-hidden="true"></i>
                                                                Reject Amount
                                                            </button>
                                                        @else
                                                            <button data-toggle="modal" data-target="#release_button"
                                                                    value="3"
                                                                    data-id="{{$data->id}}"
                                                                    class="release_button btn btn-primary btn-md btn-bottom-10">
                                                                <i class="fa fa-money" aria-hidden="true"></i>
                                                                Reject Amount
                                                            </button>
                                                            <button data-toggle="modal" data-target="#report_button"
                                                                    value="3"
                                                                    data-id="{{$data->id}}"
                                                                    class="report_button btn btn-danger btn-md margin-bottom-10">
                                                                Admin Help
                                                            </button>
                                                        @endif

                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach

                                    @else
                                        <tr>
                                            <td colspan="5">No Data Found!!</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>

                            </div>
                            <!-- //.content form wrapper -->
                            @if(isset($mileStones))
                                <div class="post-navigation">
                                    <ul class="pagination">
                                        {{ $mileStones->links('partials.pagination') }}
                                    </ul>
                                </div>
                            @endif

                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <!-- get in touch area end -->

    <!-- Modal -->
    <div class="modal fade" role="dialog" id="release_button">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title"><i class="fas fa-hand-holding-usd"></i> Reject Amount </h3>
                </div>
                <div class="modal-body">
                    <p>Are you sure to cancel this Amount ?</p>
                </div>
                <div class="modal-footer">
                    <form action="{{route('reject.amount')}}" method="post">
                        @csrf
                        <input type="hidden" name="id" id="confirm_id">
                        <button type="submit" id="confirm_accept" class="btn btn-success">Yes</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" role="dialog" id="report_button">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title"><i class="fas fa-file-invoice-dollar"></i> Report to Admin </h3>
                </div>

                <form action="{{route('user.report')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <label for="Report" class="black">Your Complain : </label>
                        <textarea name="report" id="report" class="form-control" cols="30" rows="10"></textarea>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="milestone_id" id="milestone_id">
                        <button type="submit" class="btn btn-success">Send</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    </div>
                </form>
            </div>
        </div>
    </div>





@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $(document).on('click', '.release_button', function () {
                var id = $(this).data('id');
                $('#confirm_id').val(id);
            });

            $(document).on('click', '.report_button', function () {
                var id = $(this).data('id');
                $('#milestone_id').val(id);
            });

            $(document).on('click', '.addMilestone', function () {
                var escrowId = $(this).data('escrow');
                var userId = $(this).data('user');
                $('#escrow_id').val(escrowId);
                $('#user_id').val(userId);
            });

        });

    </script>
@endsection
