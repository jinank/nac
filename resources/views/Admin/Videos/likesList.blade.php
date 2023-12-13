@extends('Admin.index', ['title' => 'Videos'])
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            @if (session()->has('msg-success'))
                <div class="alert alert-success">
                    <span class="glyphicon glyphicon-ok">
                        {{ session('msg-success') }}
                    </span>
                </div>
            @elseif(session()->has('msg-error'))
                {
                <div class="btn btn-danger">
                    <span class="glyphicon glyphicon-ok">
                        {{ session('msg-error') }}
                    </span>
                </div>

                }
            @endif
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header border-0">
                                    {{-- <div class="d-flex justify-content-between">
                                        <a href="{{ url('admin/import/people') }}" class="btn btn-success">Import</a>
                                    </div> --}}
                                </div>
                                <div class="card-body">
                                    <div>
                                        <a href="{{ url('/admin/business/view') }}"
                                            class="float-right btn btn-primary m-2">Add
                                            Business</a>
                                    </div>
                                    <table class="table table-bordered dataTable" id="dataTable" width="100%"
                                        cellspacing="0" role="grid" aria-describedby="dataTable_info"
                                        style="width: 100%;">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting">
                                                    S.No.</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                    colspan="1" aria-label="Position: activate to sort column ascending">
                                                    User Name
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="ProductTable">
                                            @foreach ($likes as $index => $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->first_name . ' ' . $item->last_name }}</td>


                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
