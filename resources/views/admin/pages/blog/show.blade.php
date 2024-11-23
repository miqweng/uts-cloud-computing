@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-footer border-bottom p-3">
                <h4>Informasi {{$page_title}}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <td class="font-weight-bold text-Capitalize w-25">Tour Name</td>
                                    <td>{{$data->title ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold text-Capitalize">Data Created At</td>
                                    <td>{{ \Carbon\Carbon::parse($data->created_at)->diffForHumans()}}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold text-Capitalize">Data Update At</td>
                                    <td>{{ \Carbon\Carbon::parse($data->updated_at)->diffForHumans()}}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold text-Capitalize">Featured Image</td>
                                    <td>
                                        <img src="{{$data->image ?? '' }}" alt="" class="w-25">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <td class="font-weight-bold text-Capitalize w-25">Tour Category</td>
                                    <td>{{$data->category->title ?? '-'}}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold text-Capitalize">Tour Destination</td>
                                    <td>{{$data->destination->title ?? '-'}}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold text-Capitalize">Keyword ( SEO )</td>
                                    <td>{{$data->seo->keyword ?? '-'}}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold text-Capitalize">Description ( SEO )</td>
                                    <td>{{$data->seo->description ?? '-'}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-footer border-bottom p-3">
                <h4>List Data Pricelist</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive" >
                    <!-- Projects table -->
                    <table class="table table-bordered" id="datatable">
                        <thead>
                            <th>Price</th>
                            <th class="w-25">Diupdate Pada</th>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script type="text/javascript">
    $(function () {
        var table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.tour.getpricelistdata', $data->id) }}",
            columns: [
                {
                    data: 'price',
                    name: 'price'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },

            ]
        });

    });

</script>
@endpush
