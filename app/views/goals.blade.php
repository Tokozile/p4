<!DOCTYPE HTML>

<html>
<head>

		<title>@yield('title','SILO')</title>
		<meta charset='utf-8'>

		<link rel='stylesheet' href='' type='text/css/'>
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
    	<link rel='stylesheet' href='/style.css' type='text/css'>




</head>

<body>
	<img src='/img/Silo_hive.png' alt='SILO logo'>

<h1>Here are a list of your goals</h1>	

<!--Passing a parameter from routes to view-->
<!--   Prints to screen everthing in the books json file-->
	<!--<?php print_r($books); ?> -->

	<!--Prints just book titles from json array file-->

<!-- 	<?php foreach ($books as $title => $book): ?>

	each book is wrapped in it's own h2 tag and it's own section for future styling and for clearer readability 
		<section>
<h3><?php echo $title;?></h3>
		</section>
	
<?php endforeach; ?> -->

<!------NOW THE SAME THING IN BLADE -->

@foreach($books as $title => $book)

		<section>
<h3>{{$title}}</h3>
		</section>
	
@endforeach


<form method='GET' action='/goals'>
		<label for='query'>Search:</label>
		<input type='text' name='query' id='query'>
		<input type='submit' value='Search'>
</form>

</body>

</html>


