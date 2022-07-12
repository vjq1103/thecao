@extends('master')
@section('title')
    Tin tức
@endsection
@section('content')
<script src="//cdn.ckeditor.com/4.10.0/standard/ckeditor.js"></script>



 @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
              @if(session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
            @endif
			
			
<div class="row">
    <div class="col-md-6">
            <form action="{{ route('news.update',['id' => $new->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
				 {{ method_field('PUT') }}
                    <div class="form-group">
                      <label for="">Tiêu đề</label>
                      <input required type="text" class="form-control" value="{{$new->title}}" id="title" name="title" placeholder="Tiêu đề bài viết">
                    </div>
                    <div class="form-group">
                      <label for="">Image</label>
                      <input   type="file" class="form-control" id="img" name="img" placeholder="">
                    </div>
                    <div class="form-group">
                      <label for="">Content</label>
                      <textarea required class="form-control" value="{{$new->content}}" name="content" id="content" cols="30" rows="10">
					  {{$new->content}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Tag</label>
                        <input value="{{$new->tag}}"  type="text" class="form-control" id="tag" name="tag" placeholder="">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
            </form>
    </div>
</div>
<script>
    CKEDITOR.replace( 'content' );
</script>

@endsection
