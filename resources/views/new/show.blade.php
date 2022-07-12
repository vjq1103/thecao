@extends('master')
@section('title')
   {{ $result->title }} |  
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
	@if(Auth::guest())  
		@elseif(Auth::user()->is_Admin == 2 || Auth::user()->is_Admin == 10  || Auth::user()->is_Admin == 8)
			<a href="/news/{{$id}}/edit"> Edit</a> 

	@endif
 
           <h1>{{ $result->title }}</h1>  
           <p>
		   @if(empty($result->image))
                                            <img class="img-thumbnail" src="/uploads/6789.jpg" alt="" />
                                            @else
                                            <img class="img-thumbnail" src="{{ URL::to($result->image) }}" alt="{{ $result->title }}" title="Minh họa {{ $result->title }}"/>
                                            @endif
										
			</p>
           <p>{!! $result->content !!}</p>
		   
		   <b>{{ $result->tag }}</b>
		   
		   
		   <hr>
		  
		   <?php 
		   
		   $data = explode(',', $result->tag);

print_r($data);
//output: Array ( [0] => T [1] => idic [2] => de.c [3] => m )
$data = explode(',', $result->tag, 2);
echo '<hr>';
print_r($data);
//output: Array ( [0] => T [1] => idicode.com )

?>


<hr>

    </div>
</div>
@endsection
