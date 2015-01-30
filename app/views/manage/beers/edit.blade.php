@extends('layouts.manage')

@section('page-header')
	<h1>
		Edit Beer: {{ $beer->name }}
	</h1>
@stop

@section('main-content')
<div class="row">
	{{ Form::open(array('url' => 'manage/beers/edit/', 'files' => true)) }}

	<div class="col-md-9">
		{{ Form::token() }}

		{{ Form::hidden('id', $beer->id) }}

		{{ $errors->first('name') }}

		<div class="form-group">
			<label for="name">Name</label>
			{{ Form::text('name', $beer->name, array('class'=>'form-control')) }}
		</div>

		{{ $errors->first('brewery') }}

		<div class="form-group">
			<label for="brewery">Brewery</label>
			{{ Form::text('brewery', $beer->brewery, array('class'=>'form-control')) }}
		</div>

		{{ $errors->first('style') }}

		<div class="form-group">
			<label for="style">Style</label>
			{{ Form::text('style', $beer->style, array('class'=>'form-control')) }}
		</div>

		<div class="row">
			<div class="col-md-6">
				{{ $errors->first('abv') }}

				<div class="form-group">
					<label for="abv">ABV</label>
					{{ Form::text('abv', $beer->abv, array('class'=>'form-control')) }}
				</div>
			</div>

			<div class="col-md-6">
				{{ $errors->first('ibu') }}

				<div class="form-group">
					<label for="ibu">IBU</label>
					{{ Form::text('ibu', $beer->ibu, array('class'=>'form-control')) }}
				</div>
			</div>
		</div> 

		{{ $errors->first('body_markdown') }}

		<div class="form-group">
			<label for="body_markdown">Personal Review</label>
			{{ Form::textarea('body_markdown', $beer->body_markdown, array('class'=>'form-control monospace-field')) }}
			<code class="help-block small">
				*italicized*
				**bold**
				[This link](http://example.net/)
				![Alt text](/path/to/img.jpg "Optional title")
			</code>
		</div>

		<div class="form-group">
			<label for="overall">Overall</label>
			{{ Form::selectRange('overall', 1, 10, $beer->overall) }}
		</div>

		<div class="panel panel-default">
			<div class="panel-heading">Appearence</div>
			
			<div class="panel-body">
				<div class="form-group">
					<label for="overall_appearance">Overall Appearance</label>
					{{ Form::selectRange('overall_appearance', 1, 5, $beer->overall_appearance) }}
				</div>

				<div class="form-group">
					<label for="head_size">Head Size</label>
					{{ Form::select('head_size', $form_selects['head_size'], $beer->head_size, array('class'=>'form-control')) }}
				</div>

				<div class="form-group">
					<label for="head_texture">Head Texture</label>
					{{ Form::select('head_texture', $form_selects['head_texture'], $beer->head_texture, array('class'=>'form-control')) }}
				</div>

				<div class="form-group">
					<label for="head_color">Head Color</label>
					{{ Form::select('head_color', $form_selects['head_color'], $beer->head_color, array('class'=>'form-control')) }}
				</div>

				<div class="form-group">
					<label for="head_duration">Head Duration</label>
					{{ Form::select('head_duration', $form_selects['head_duration'], $beer->head_duration, array('class'=>'form-control')) }}
				</div>

				<div class="form-group">
					<label for="lacing">Lacing</label>
					{{ Form::select('lacing', $form_selects['lacing'], $beer->lacing, array('class'=>'form-control')) }}
				</div>

				<div class="form-group">
					<label for="body">Body</label>
					{{ Form::select('body', $form_selects['body'], $beer->body, array('class'=>'form-control')) }}
				</div>

				<div class="form-group">
					<label for="particles">Particles</label>
					{{ Form::select('particles', $form_selects['particles'], $beer->particles, array('class'=>'form-control')) }}
				</div>

				<div class="form-group">
					<label for="color">Color</label>
					{{ Form::select('color', $form_selects['color'], $beer->color, array('class'=>'form-control')) }}
				</div>

			</div>
		</div>

		<div class="panel panel-default">
			<div class="panel-heading">Aroma</div>
			
			<div class="panel-body">
				<div class="form-group">
					<label for="overall_aroma">Overall Aroma</label>
					{{ Form::selectRange('overall_aroma', 1, 10, $beer->overall_aroma) }}
				</div>

				<hr>

				<div class="form-group">
					<label for="status">Malt</label>
					{{ Form::select('malt', $form_selects['malt'], $beer->malt, array('class'=>'form-control')) }}
				</div>
				
				<div class="form-group">
					@foreach($aromas['malt'] as $aroma)
					<label class="checkbox-inline">
						{{ Form::checkbox($aroma['name'], 1, $beer->$aroma['name']) }} {{ $aroma['description'] }}
					</label>
					@endforeach
				</div>

				<hr>

				<div class="form-group">
					<label for="status">Hops</label>
					{{ Form::select('hops', $form_selects['hops'], $beer->hops, array('class'=>'form-control')) }}
				</div>
				
				<div class="form-group">
					@foreach($aromas['hops'] as $aroma)
					<label class="checkbox-inline">
						{{ Form::checkbox($aroma['name'], 1, $beer->$aroma['name']) }} {{ $aroma['description'] }}
					</label>
					@endforeach
				</div>

				<hr>

				<div class="form-group">
					<label for="status">Yeast</label>
					{{ Form::select('yeast', $form_selects['yeast'], $beer->yeast, array('class'=>'form-control')) }}
				</div>
				
				<div class="form-group">
					@foreach($aromas['yeast'] as $aroma)
					<label class="checkbox-inline">
						{{ Form::checkbox($aroma['name'], 1, $beer->$aroma['name']) }} {{ $aroma['description'] }}
					</label>
					@endforeach
				</div>

				<hr>

				<h6>Misc</h6>
				<div class="form-group">
					@foreach($aromas['misc'] as $aroma)
					<label class="checkbox-inline">
						{{ Form::checkbox($aroma['name'], 1, $beer->$aroma['name']) }} {{ $aroma['description'] }}
					</label>
					@endforeach
				</div>
				
			</div>
		</div>

		<div class="panel panel-default">
			<div class="panel-heading">Palate</div>
			
			<div class="panel-body">
				<div class="form-group">
					<label for="palate">Overall Palate</label>
					{{ Form::selectRange('palate', 1, 5, $beer->palate) }}
				</div>

				<div class="form-group">
					<label for="palate_body">Body</label>
					{{ Form::select('palate_body', $form_selects['palate_body'], $beer->palate_body, array('class'=>'form-control')) }}
				</div>

				<div class="form-group">
					<label for="palate_texture">Texture</label>
					{{ Form::select('palate_texture', $form_selects['palate_texture'], $beer->palate_texture, array('class'=>'form-control')) }}
				</div>

				<div class="form-group">
					<label for="palate_carbonation">Carbonation</label>
					{{ Form::select('palate_carbonation', $form_selects['palate_carbonation'], $beer->palate_carbonation, array('class'=>'form-control')) }}
				</div>

				<div class="form-group">
					<label for="palate_finish">Finish</label>
					{{ Form::select('palate_finish', $form_selects['palate_finish'], $beer->palate_finish, array('class'=>'form-control')) }}
				</div>
			</div>
		</div>

		<div class="panel panel-default">
			<div class="panel-heading">Flavor</div>
			
			<div class="panel-body">
				<div class="form-group">
					<label for="flavor">Overall Flavor</label>
					{{ Form::selectRange('flavor', 1, 10, $beer->flavor) }}
				</div>

				<div class="form-group">
					<label for="flavor_duration">Duration</label>
					{{ Form::select('flavor_duration', $form_selects['flavor_duration'], $beer->flavor_duration, array('class'=>'form-control')) }}
				</div>

				<div class="form-group">
					<label for="flavor_sweet">Sweet</label>
					{{ Form::select('flavor_sweet', $form_selects['flavor_sweet'], $beer->flavor_sweet, array('class'=>'form-control')) }}
				</div>

				<div class="form-group">
					<label for="flavor_acidic">Acidic</label>
					{{ Form::select('flavor_acidic', $form_selects['flavor_acidic'], $beer->flavor_acidic, array('class'=>'form-control')) }}
				</div>

				<div class="form-group">
					<label for="flavor_bitter">Bitter</label>
					{{ Form::select('flavor_bitter', $form_selects['flavor_bitter'], $beer->flavor_bitter, array('class'=>'form-control')) }}
				</div>

				<div class="form-group">
					<label for="other">Other</label>
					{{ Form::select('other', $form_selects['other'], $beer->other, array('class'=>'form-control')) }}
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-3">
		{{ Form::submit('Save', array('class'=>'btn btn-primary btn-lg btn-block'))}}
		{{ link_to_action('Manage\EventsController@getIndex', 'Cancel', null, array('class'=>'btn btn-default btn-lg btn-block')) }}

		<div class="panel panel-default">
			<div class="panel-heading">Featured Image</div>
			
			<div class="panel-body">
				@if (isset($beer->feature_image->filename))
					<img src="/files/{{ $beer->feature_image->filename }}" class="img-responsive">
				@endif

				<div class="form-group">
					{{ Form::file('featured_image'); }}
				</div>
			</div>
		</div>

		<div class="panel panel-default">
			<div class="panel-heading">Advanced</div>
			
			<div class="panel-body">
				<div class="form-group">
					<label for="status">Status</label>
					{{ Form::select('status', $statuses, $beer->status, array('class'=>'form-control')) }}
				</div>

				<div class="form-group">
					<label for="created_by">Author</label>
					{{ Form::select('created_by_id', $users, $beer->created_by_id, array('class'=>'form-control')) }}
				</div>
			</div>
		</div>

	</div>

	{{ Form::close() }}
</div>
@stop