@extends('layouts.basic', array(
  'title' => $beer->name,
  'description' => substr(strip_tags($beer->body_html),0,150),
  'og_image' => $beer->filename
))

@section('page-header')
	<h1>
    {{ $beer->name }}

    <span class="small">
      @if(isset($beer->style))
        {{ $beer->style }} |
      @endif

      @if(isset($beer->abv))
        {{ $beer->abv }}% <abbr title="Alcohol By Volume">ABV</abbr> |
      @endif

      @if(isset($beer->ibu))
        {{ $beer->ibu }} <abbr title="International Bittering Units">IBUs</abbr>
      @endif
    </span>
  </h1>
	<h4>
    {{ $beer->brewery }}
  </h4>
@stop

@section('main-content')
  <div class="row">
  	<div class="col-md-8">
      @include('elements/share-buttons')

			@if ($beer->filename !== null)
				<img src="/image/cache/large/{{ $beer->filename }}" class="featured-image thumbnail">
      @endif

      <h4>Overall</h4>
        <div class="progress">
          <div class="progress-bar" role="progressbar" aria-valuenow="{{ $beer->overall }}" aria-valuemin="1" aria-valuemax="10" style="width: {{ ($beer->overall/10)*100 }}%;">
            {{ $beer->overall }} out of 10
          </div>
        </div>
			
			{{ $beer->body_html }}

      <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
      <!-- Beer Detail embedded -->
      <ins class="adsbygoogle"
           style="display:block"
           data-ad-client="ca-pub-6630597458428556"
           data-ad-slot="8059668108"
           data-ad-format="auto"></ins>
      <script>
      (adsbygoogle = window.adsbygoogle || []).push({});
      </script>

      <h4>Appearance</h4>
        <div class="progress">
          <div class="progress-bar" role="progressbar" aria-valuenow="{{ $beer->overall_appearance }}" aria-valuemin="1" aria-valuemax="5" style="width: {{ ($beer->overall_appearance/5)*100 }}%;">
            {{ $beer->overall_appearance }} out of 5
          </div>
        </div>

        <table class="table table-bordered table-striped">
          @if(isset($beer->head_size))
            <tr>
              <td>Head Size</td>
              <td>{{ $selects['head_size'][$beer->head_size] }}</td>
            </tr>
          @endif

          @if(isset($beer->head_texture))
            <tr>
              <td>Head Texture</td>
              <td>{{ $selects['head_texture'][$beer->head_texture] }}</td>
            </tr>
          @endif

          @if(isset($beer->head_color))
            <tr>
              <td>Head Color</td>
              <td>{{ $selects['head_color'][$beer->head_color] }}</td>
            </tr>
          @endif

          @if(isset($beer->head_duration))
            <tr>
              <td>Head Duration</td>
              <td>{{ $selects['head_duration'][$beer->head_duration] }}</td>
            </tr>
          @endif

          @if(isset($beer->lacing))
            <tr>
              <td>Lacing</td>
              <td>{{ $selects['lacing'][$beer->lacing] }}</td>
            </tr>
          @endif

          @if(isset($beer->body))
            <tr>
              <td>Body</td>
              <td>{{ $selects['body'][$beer->body] }}</td>
            </tr>
          @endif

          @if(isset($beer->particles))
            <tr>
              <td>Particles</td>
              <td>{{ $selects['particles'][$beer->particles] }}</td>
            </tr>
          @endif

          @if(isset($beer->color))
            <tr>
              <td>Color</td>
              <td>{{ $selects['color'][$beer->color] }}</td>
            </tr>
          @endif
        </table>

      <h4>Aroma</h4>
        <div class="progress">
          <div class="progress-bar" role="progressbar" aria-valuenow="{{ $beer->overall_aroma }}" aria-valuemin="1" aria-valuemax="10" style="width: {{ ($beer->overall_aroma/10)*100 }}%;">
            {{ $beer->overall_aroma }} out of 10
          </div>
        </div>
          
        <table class="table table-bordered table-striped">
          <tr>
            <td>Malt</td>
            <td>
              @if(isset($beer->malt))
                <p>{{ $selects['malt'][$beer->malt] }}</p>
              @endif

              <p>
                @foreach($aromas['malt'] as $item)
                  @if($beer->$item['name'] !== null)
                    <span class="label label-default">{{ $item['description'] }}</span>
                  @endif
                @endforeach
              </p>
            </td>
          </tr>

          <tr>
            <td>Hops</td>
            <td>
              @if(isset($beer->hops))
                <p>{{ $selects['hops'][$beer->hops] }}</p>
              @endif

              <p>
                @foreach($aromas['hops'] as $item)
                  @if($beer->$item['name'] !== null)
                    <span class="label label-default">{{ $item['description'] }}</span>
                  @endif
                @endforeach
              </p>
            </td>
          </tr>

          <tr>
            <td>Yeast</td>
            <td>
              @if(isset($beer->yeast))
                <p>{{ $selects['yeast'][$beer->yeast] }}</p>
              @endif

              <p>
                @foreach($aromas['yeast'] as $item)
                  @if($beer->$item['name'] !== null)
                    <span class="label label-default">{{ $item['description'] }}</span>
                  @endif
                @endforeach
              </p>
            </td>
          </tr>

          <tr>
            <td>Misc</td>
            <td>
              @if(isset($beer->other))
                <p>{{ $selects['other'][$beer->other] }}</p>
              @endif

              <p>
                @foreach($aromas['misc'] as $item)
                  @if($beer->$item['name'] !== null)
                    <span class="label label-default">{{ $item['description'] }}</span>
                  @endif
                @endforeach
              </p>
            </td>
          </tr>
        </table>

      <h4>Palate</h4>
        <div class="progress">
          <div class="progress-bar" role="progressbar" aria-valuenow="{{ $beer->overall_appearance }}" aria-valuemin="1" aria-valuemax="5" style="width: {{ ($beer->overall_appearance/5)*100 }}%;">
            {{ $beer->overall_appearance }} out of 5
          </div>
        </div>

        <table class="table table-bordered table-striped">
          @if(isset($beer->palate_body))
            <tr>
              <td>Body</td>
              <td>{{ $selects['palate_body'][$beer->palate_body] }}</td>
            </tr>
          @endif

          @if(isset($beer->palate_texture))
            <tr>
              <td>Texture</td>
              <td>{{ $selects['palate_texture'][$beer->palate_texture] }}</td>
            </tr>
          @endif

          @if(isset($beer->palate_carbonation))
            <tr>
              <td>Carbonation</td>
              <td>{{ $selects['palate_carbonation'][$beer->palate_carbonation] }}</td>
            </tr>
          @endif

          @if(isset($beer->palate_finish))
            <tr>
              <td>Finish</td>
              <td>{{ $selects['palate_finish'][$beer->palate_finish] }}</td>
            </tr>
          @endif
        </table>

      <h4>Flavor</h4>
        <div class="progress">
          <div class="progress-bar" role="progressbar" aria-valuenow="{{ $beer->flavor }}" aria-valuemin="1" aria-valuemax="10" style="width: {{ ($beer->flavor/10)*100 }}%;">
            {{ $beer->flavor }} out of 10
          </div>
        </div>

        <table class="table table-bordered table-striped">
          @if(isset($beer->flavor_duration))
            <tr>
              <td>Duration</td>
              <td>{{ $selects['flavor_duration'][$beer->flavor_duration] }}</td>
            </tr>
          @endif

          @if(isset($beer->flavor_sweet))
            <tr>
              <td>Sweet</td>
              <td>{{ $selects['flavor_sweet'][$beer->flavor_sweet] }}</td>
            </tr>
          @endif

          @if(isset($beer->flavor_acidic))
            <tr>
              <td>Acidic</td>
              <td>{{ $selects['flavor_acidic'][$beer->flavor_acidic] }}</td>
            </tr>
          @endif

          @if(isset($beer->flavor_bitter))
            <tr>
              <td>Bitter</td>
              <td>{{ $selects['flavor_bitter'][$beer->flavor_bitter] }}</td>
            </tr>
          @endif
        </table>

  	</div>

    <div class="col-md-4">
      @include('elements.sidebar')
    </div>
  </div>
@stop
