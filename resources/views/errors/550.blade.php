@extends('layouts.admin.master')

@section('title')
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
		<h1>{{ Lang::get('errors.no_permission') }}</h1>
   	</div>
</div>
@endsection