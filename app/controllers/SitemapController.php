<?php

class SitemapController extends BaseController {

	public function getIndex()
	{
		// create new sitemap object
		$sitemap = App::make("sitemap");

		// set cache (key (string), duration in minutes (Carbon|Datetime|int), turn on/off (boolean))
		// by default cache is disabled
		$sitemap->setCache('laravel.sitemap', 3600);

		// check if there is cached sitemap and build new only if is not
		if (!$sitemap->isCached()) {
			// add item to the sitemap (url, date, priority, freq)
			$sitemap->add(URL::to('/'), '2014-09-29T20:10:00+02:00', '1.0', 'always');

			$pages = DB::table('pages')->where('status', 'published')->get();
			foreach ($pages as $page) {
				$sitemap->add('https://turlockcitybooze.com/page/'.$page->slug, $page->updated_at, '.5');
			}

			$posts = DB::table('posts')->where('status', 'published')->get();
			foreach ($posts as $post) {
				$sitemap->add('https://turlockcitybooze.com/post/'.$post->id.'/'.urlencode($post->title), $post->updated_at, '.9');
			}

			$venues = DB::table('venues')->where('status', 'published')->get();
			foreach ($venues as $venue) {
				$sitemap->add('https://turlockcitybooze.com/venues/detail/'.$venue->id.'/'.urlencode($venue->name), $venue->updated_at, '.8');
			}

			$events = DB::table('events')->where('status', 'published')->get();
			foreach ($events as $event) {
				$sitemap->add('https://turlockcitybooze.com/events/detail/'.$event->id.'/'.urlencode($event->title), $event->updated_at, '.7');
			}

			$beers = DB::table('beers')->where('status', 'published')->get();
			foreach ($beers as $beer) {
				$sitemap->add('https://turlockcitybooze.com/beer/'.$beer->id.'/'.urlencode($beer->name), $beer->updated_at, '.6');
			}

			$sitemap->add('https://turlockcitybooze.com/news', '2014-09-29T20:10:00+02:00', '1.0', 'always');
			$sitemap->add('https://turlockcitybooze.com/beers', '2014-09-29T20:10:00+02:00', '1.0', 'always');
			$sitemap->add('https://turlockcitybooze.com/events/index', '2014-09-29T20:10:00+02:00', '1.0', 'always');
			$sitemap->add('https://turlockcitybooze.com/venues/index', '2014-09-29T20:10:00+02:00', '1.0', 'always');
		}

		// show your sitemap (options: 'xml' (default), 'html', 'txt', 'ror-rss', 'ror-rdf')
		return $sitemap->render('xml');
	}
	
}
