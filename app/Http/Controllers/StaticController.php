<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StaticController extends Controller
{
  public function show($slug) {
		$methodName = Str::camel($slug);

		if ( ! method_exists($this, $methodName)) {
			return $this->loadViewFromSlug($slug);
		}

		return $this->$methodName();
	}

	protected function loadViewFromSlug($slug)
	{
		$slug = $this->slugToSnakeCase($slug);

		try {
			return view("static.{$slug}");
		} catch (\InvalidArgumentException $e) {
			abort(404);
		}
	}

	protected function slugToSnakeCase($slug) {
		return str_replace('-', '_', $slug);
	}

	protected function welcome() {
		$trader = Trader::take(6);
		return $trader;
		return view('welcome');
	}

}