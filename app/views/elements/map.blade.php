<img
	class="img-responsive"
	src="https://maps.googleapis.com/maps/api/staticmap?center={{ $street or '' }},{{ $city or 'Turlock' }}
		&zoom=15
		&size=700x400
		&markers=color%7C{{ $street or '' }},{{ $city or 'Turlock' }}+{{ $state or 'CA' }}"
	>
<a
	target="_blank"
	href="http://maps.google.com/?q={{ $street or '' }},{{ $city or 'Turlock' }}+{{ $state or 'CA' }}">View on Google Maps</a>