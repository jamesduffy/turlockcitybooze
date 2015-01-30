@extends('layouts.manage')

@section('page-header')
	<h1>Meta for {{ $venue->name }}</h1>
@stop

@section('main-content')
<div class="row">
	{{ Form::open(array('url' => 'manage/venues/edit-meta')) }}

	<div class="col-md-9">
		{{ Form::token() }}

		{{ Form::hidden('id', $venue->id) }}

		@foreach($meta as $item)
		<div class="checkbox">
			<label>
				{{ Form::checkbox($item->id, 'value', $venue->has_meta($item->name)) }} {{ $item->description }}
			</label>
		</div>
		@endforeach

	</div>

	<div class="col-md-3">
		{{ Form::submit('Save', array('class'=>'btn btn-primary btn-lg btn-block'))}}
		{{ link_to_action('Manage\VenuesController@getEdit', 'Cancel', $venue->id, array('class'=>'btn btn-default btn-lg btn-block')) }}
	</div>

	{{ Form::close() }}
</div>
@stop