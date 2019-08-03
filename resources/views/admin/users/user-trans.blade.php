@extends('admin.layout.master')

@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title ">{{$page_title}}</h3>
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover order-column" id="">
                            <thead>
                            <tr>
                                <th>#TRX</th>
                                <th>Details</th>
                                <th>Amount</th>
                                <th>Remaining Balance</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($deposits as $data)
                                <tr>
                                    <td>{{$data->trx}}</td>
                                    <td>{{$data->title or ''}}</td>
                                    <td><strong>{!! $data->amount  or 'N/A' !!} @if($data->mining_id == null)  {!! $basic->currency !!} @else  {!! $data->mining->coin_code !!} @endif</strong></td>
                                    <td>{!! $data->main_amo  or 'N/A' !!} @if($data->mining_id == null)  {!! $basic->currency !!} @else  {!! $data->mining->coin_code !!} @endif</td>

                                    <td>
                                        {!! $data->created_at  or '' !!}
                                    </td>
                                </tr>
                            @endforeach
                            <tbody>
                        </table>

                        {!! $deposits->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection