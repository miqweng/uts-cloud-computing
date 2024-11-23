@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-footer border-bottom p-3">
                <h4>Form Data {{$page_title}}</h4>
            </div>
            <div class="card-body">
                <form id="form" enctype="multipart/form-data" action="{{$data == null ? route('admin.masterdata.category.store'):route('admin.masterdata.category.update', $data->id)}}" method="post">
                    @csrf
                    @if ($data != null)
                    @method('PUT')
                    @endif
                    <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" class="form-control mb-2" required name="title" value="{{$data->title ?? ''}}">
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea name="description" class="form-control" cols="30" rows="10">@php
                              echo  $data->description ??  ''
                            @endphp</textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Photo</label>
                            <input type="file" name="image" class="dropify" data-default-file="{{$data->image ?? ''}}" />
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-footer text-end">
                <a href="{{route('admin.masterdata.category.index')}}" class="btn btn-dark"><i class="fa fa-arrow-left mr-2"></i> Back</a>
                <button class="btn btn-primary" type="submit"><i class="fa fa-save mr-2"></i> Submit Data </button>
                </form>
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
            ajax: "{{ route('admin.masterdata.category.getdata') }}",
            columns: [
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'slug',
                    name: 'slug'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ]
        });

    });

</script>
@endpush
