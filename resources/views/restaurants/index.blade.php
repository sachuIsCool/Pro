<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{ config('app.name', 'Restaurants by City') }}</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
	<style>
		body { font-family: Inter, system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif; background:#f8fafc; color:#0f172a; margin:0; }
		.container { max-width: 840px; margin: 40px auto; padding: 0 16px; }
		.card { background:#fff; border:1px solid #e5e7eb; border-radius:12px; box-shadow: 0 1px 2px rgba(0,0,0,0.04); }
		.header { padding: 20px; border-bottom:1px solid #e5e7eb; }
		h1 { margin:0; font-size: 20px; font-weight: 600; }
		.section { padding: 20px; }
		form { display:flex; gap:12px; }
		input[type="text"] { flex:1; padding:12px 14px; border:1px solid #d1d5db; border-radius:8px; font-size:14px; }
		button { padding:12px 16px; background:#111827; color:#fff; border:none; border-radius:8px; cursor:pointer; font-weight:600; }
		button:hover { background:#0b1220; }
		.error { color:#b91c1c; background:#fef2f2; border:1px solid #fecaca; padding:12px; border-radius:8px; margin-top:12px; }
		.list { margin:0; padding:0; list-style:none; display:grid; gap:12px; }
		.item { padding:14px; border:1px solid #e5e7eb; border-radius:10px; background:#fff; }
		.item .name { font-weight:600; margin-bottom:6px; }
		.item .meta { color:#475569; font-size:14px; }
		.badge { display:inline-block; padding:2px 8px; border-radius:999px; background:#f1f5f9; margin-left:8px; font-size:12px; }
		.footer { padding:16px 20px; border-top:1px solid #e5e7eb; color:#6b7280; font-size:13px; }
	</style>
</head>
<body>
	<div class="container">
		<div class="card">
			<div class="header">
				<h1>Find Restaurants by City</h1>
			</div>
			<div class="section">
				<form method="POST" action="{{ route('restaurants.search') }}">
					@csrf
					<input type="text" name="city" value="{{ old('city', $city) }}" placeholder="Enter a city (e.g., Mumbai)" required />
					<button type="submit">Search</button>
				</form>

				@if ($errors->any())
					<div class="error">
						{{ $errors->first('city') }}
					</div>
				@endif

				@if ($error)
					<div class="error">{{ $error }}</div>
				@endif
			</div>

			@if (is_array($results))
				<div class="section">
					@if (count($results) === 0)
						<p>No restaurants found for “{{ $city }}”.</p>
					@else
						<ul class="list">
							@foreach ($results as $r)
								<li class="item">
									<div class="name">
										{{ $r['name'] }}
										@if (!is_null($r['rating']))
											<span class="badge">★ {{ number_format($r['rating'], 1) }}</span>
										@endif
									</div>
									<div class="meta">{{ $r['address'] }}</div>
								</li>
							@endforeach
						</ul>
					@endif
				</div>
			@endif

			<div class="footer">
				Minimal UI • Powered by Google Places API
			</div>
		</div>
	</div>
</body>
</html>


