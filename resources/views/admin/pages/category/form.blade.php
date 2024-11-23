@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-md-5">
        <div class="card">
            <div class="card-footer border-bottom p-3">
                <h4>Form Data {{$page_title}}</h4>
            </div>
            <div class="card-body">
                <form id="form" enctype="multipart/form-data" action="{{$data == null ? route('admin.category.store'):route('admin.category.update', $data->id)}}" method="post">
                    @csrf
                    @if ($data != null)
                    @method('PUT')
                    @endif
                    <div class="form-group">
                            <label for="">Parent Category</label>
                            <select name="parent_id" id="" class="form-control">
                                <option value="" selected disabled>--- Choose One ---</option>
                                <option value="">None</option>
                                @foreach ($category_parent as $item)
                                <option value="{{$item->id}}" {{$data != null && $data->parent_id == $item->id ? 'selected':''}}>{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" class="form-control mb-2" required name="name" value="{{$data->name ?? ''}}">
                    </div>

            </div>
            <div class="card-footer text-end">
                <a href="{{route('admin.category.index')}}" class="btn btn-dark"><i class="fa fa-arrow-left mr-2"></i> Back</a>
                <button class="btn btn-primary" type="submit"><i class="fa fa-save mr-2"></i> Submit Data </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

