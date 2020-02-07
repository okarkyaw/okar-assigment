@extends('layouts.app')

@section('content')
<form method="POST" action="{{route('post.update')}}">
@csrf
@method('PUT')
<div class="form-group">
    <label for="title">title : </label>
    <input type="text" name="title" value="{{$post->title}}"/>
</div>

<div class="form-group">
    <label for="content">content : </label>
    <textarea type="text" id="content" name="content" value="{{$post->content}}"></textarea>
</div>
<div class="form-group">
    <label for="content">Published Post</label>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" checked name="is_published" id="is_published_yes" value="1">
        <label class="form-check-label" for="is_published_yes">Yes</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="is_published" id="is_published_no" value="0">
        <label class="form-check-label" for="is_published_no">No</label>
    </div>
</div>
<button class='btn btn-primary' type="submit">update</button>
</form>
@endsection