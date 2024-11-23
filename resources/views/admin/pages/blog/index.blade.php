@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-footer border-bottom p-3">
                <h4>List Data {{$page_title}}</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table table-bordered" id="datatable">
                        <thead>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Slug</th>
                            <th>Created At</th>
                            <th>Action</th>
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
            ajax: "{{ route('admin.blog.getdata') }}",
            columns: [{
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'category_blog_id',
                    name: 'category_blog_id'
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
