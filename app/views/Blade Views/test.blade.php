<section>
	
	<h2>{{$goal->name}}</h2>

	<p>
	{{$goal->name}} {{$goal->description}}
	</p>

	<a href='/goal/edit/{{ $goal->id }}'>Edit</a>
</section>