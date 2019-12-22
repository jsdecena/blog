@extends('cms::admin.template.main')
@section('cms::content')
	<!-- Default box -->
    @include('cms::messages')
	<div class="box">
		<div class="box-header with-border">
		  <h3 class="box-title">Edit post</h3>
		</div><!-- /.box-header -->
		<form action="{{route('admin.post.update', $post->id)}}" role="form" class="form" method="post" enctype="multipart/form-data">
			<div class="box-body row">
				<div class="col-md-8">
			    	<input type="hidden" name="_method" value="put" />
			    	<input type="hidden" name="_token" value="{{csrf_token()}}" />
			        <!-- text input -->
			        <div class="form-group">
			          <label for="title">Title<span class="text text-danger">*</span></label>
			          <input id="title" name="title" type="text" class="form-control" placeholder="Post title" value="{{$post->title?? old('title')}}" />
			        </div>
			        <div class="form-group">
			          <label for="content">Content</label>
			          <textarea name="content" id="content" rows="7" class="form-control" placeholder="Post content">{{$post->content?? old('content')}}</textarea>
			        </div>
                    @if($post->cover_image)
                        <figure>
                            <img src="{{asset("storage/$post->cover_image")}}" alt="cover image" height="150">
                        </figure>
                    @endif
                    <div class="form-group">
                        <label for="cover_image">Cover Image</label>
                        <input id="cover_image" name="cover_image" type="file" class="form-control" placeholder="Cover Image" />
                    </div>
                    @if($post->link)
                        <div class="form-group">
                            <label for="link">Link</label>
                            <input id="link" name="link" type="text" class="form-control" placeholder="Image link" value="{{$post->link ?? old('link')}}" />
                        </div>
                    @endif
			        <div class="form-group">
			        	<label for="status">Status</label>
			            <select name="status" id="status" class="form-control">
			            	<option @if($post->status == 0) selected="selected" @endif value="0">Disable</option>
			            	<option @if($post->status == 1) selected="selected" @endif value="1">Enable</option>
			            </select>
			        </div>
			        <a href="{{route('admin.post.index')}}" class="btn btn-default">Back</a>
			        <button type="submit" class="btn btn-sml btn-primary">Submit</button>
			    </div>
			    <div class="col-md-4">
			    	@if(isset($categories) && !$categories->isEmpty())
					<div class="form-group">
						@foreach($categories as $category)
							@if(in_array($category->id, $ids))
								<label class="checkbox">
									<input type="checkbox" checked="checked" name="category[]" value="{{$category->id}}"> {{$category->name}}
								</label>
							@else
								<label class="checkbox">
									<input type="checkbox" name="category[]" value="{{$category->id}}"> {{$category->name}}
								</label>
							@endif
						@endforeach
					</div>
					@endif
			    </div>
			</div><!-- /.box-body -->
		</form>
	</div><!-- /.box -->
@endsection
