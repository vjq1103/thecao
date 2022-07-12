@extends('master')
@section('title')
    Tin tức
@endsection
@section('content')
<script src="//cdn.ckeditor.com/4.10.0/standard/ckeditor.js"></script>
<div class="row">
    <div class="col-md-6">
            <form action="{{ route('news.u') }}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="form-group">
                      <label for="">Tiêu đề</label>
                      <input required type="text" class="form-control" id="title" name="title" placeholder="Tiêu đề bài viết">
                    </div>
                    <div class="form-group">
                      <label for="">Image</label>
                      <input   type="file" class="form-control" id="img" name="img" placeholder="">
                    </div>
                    <div class="form-group">
                      <label for="">Content</label>
                      <textarea required class="form-control" name="content" id="content" cols="30" rows="10"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Tag</label>
                        <input  type="text" class="form-control" id="tag" name="tag" placeholder="">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
            </form>
    </div>
</div>
<script>
    CKEDITOR.replace( 'content' );
</script>

@endsection
