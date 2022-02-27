<!doctype html>
<html lang="{{ app()->getLocale() }}">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>{{ config('app.name') }}</title>
	</head>
	<body>
		<form action="{{ route('create_new_short_link') }}" method="post">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<label for="your-url">Enter URL:</label>
			<input id="your-url" type="url" name="url">
			<input type="submit" value="Shortly">
		</form>
		@if (!empty(session()->get('url')))
		<hr>
		<label for="short-url">Your short URL:</label>
		<input id="short-url" type="url" value="{{ route('short', ['name' => session()->get('url')]) }}">
		<button type="button" onclick="copy()">Copy URL</button>											
		<script>
		function copy() {
			let copyText = document.getElementById('short-url')
			copyText.select();
			document.execCommand('copy')
		}
		</script>														
		@endif			
	</body>
</html>