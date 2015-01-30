@extends('layouts.manage')

@section('page-header')
	<h1>
		Files

		<span class="pull-right">
			@if( Auth::user()->can('upload_file') )
				{{ link_to_action('Manage\FilesController@getUpload', 'Upload File', null, array('class' => 'btn btn-lg btn-primary')) }}
			@endif
		</span>
	</h1>
@stop

@section('main-content')
<div class="row">
	<div class="col-md-12">
		<table class="table table-striped">
			<thead>
				<tr>
					<th></th>
					<th>Name</th>
					<th>Type</th>
					<th>Size</th>
					<th>Path</th>
					<th>Created At</th>
					<th>Updated At</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($files as $file)
				<tr>
					<td>
						@if ( $file->mime_type == 'image/jpeg' OR $file->mime_type == 'image/png' )
							<img class="img-responsive" src="/image/cache/small/{{ $file->filename }}" width="100%">
						@else

						@endif
					</td>
					<td>
						<strong>On Disk:</strong> {{ $file->filename }}<br>
						<strong>Original:</strong> {{ $file->original_name }}
					</td>
					<td>{{ $file->mime_type }}</td>
					<td>{{ $file->size }}</td>
					<td>/files/{{ $file->filename }}</td>
					<td>{{ $file->created_at }}</td>
					<td>{{ $file->updated_at }}</td>
					<td>
						<!-- <a href="#">Delete</a>	-->					
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@stop