@extends('layouts.manage')

@section('page-header')
	<h1>
		Add Happy Hour to {{ $venue->name }}
	</h1>
@stop

@section('main-content')
<div class="row">
	{{ Form::open(array('url' => 'manage/venues/add-happy-hour')) }}

	<div class="col-md-9">
		{{ Form::token() }}

		{{ Form::hidden('venue_id', $venue->id) }}

		{{ $errors->first('day_of_week') }}

		<div class="form-group">
			<label for="day_of_week">Day of Week</label>
			{{ Form::select('day_of_week', $days_of_week, array('class'=>'form-control')) }}
		</div>

		<div class="row">
			<div class="col-md-6">
				{{ $errors->first('start_hour') }}

				<div class="form-group">
					<label for="start_hour">Start</label>
					{{ Form::select('start_hour', $hours, array('class'=>'form-control')) }}
				</div>
			</div>

			<div class="col-md-6">
				{{ $errors->first('end_hour') }}

				<div class="form-group">
					<label for="end_hour">End</label>
					{{ Form::select('end_hour', $hours, array('class'=>'form-control')) }}
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-3">
		{{ Form::submit('Save', array('class'=>'btn btn-primary btn-lg btn-block'))}}
		{{ link_to_action('Manage\VenuesController@getEdit', 'Cancel', $venue->id, array('class'=>'btn btn-default btn-lg btn-block')) }}

	</div>

	{{ Form::close() }}
</div>
@stop