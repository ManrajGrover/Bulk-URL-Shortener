<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="A 45 minute project to create a service for shortening URLs in bulk." />
	<!-- Schema.org markup for Google+ -->
	<meta itemprop="name" content="Bulk URL Shortener">
	<meta itemprop="description" content="A 45 minute project to create a service for shortening URLs in bulk.">
	<meta itemprop="image" content="http://manraj.collegespace.in/Experiments/bulkshortener/img.png">

	<!-- Twitter Card data -->
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:site" content="@publisher_handle">
	<meta name="twitter:title" content="Bulk URL Shortener">
	<meta name="twitter:description" content="A 45 minute project to create a service for shortening URLs in bulk.">
	<meta name="twitter:creator" content="@devilmanraj">
	<!-- Twitter summary card with large image must be at least 280x150px -->
	<meta name="twitter:image:src" content="http://manraj.collegespace.in/Experiments/bulkshortener/img.png">

	<!-- Open Graph data -->
	<meta property="og:title" content="Bulk URL Shortener" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="http://manraj.collegespace.in/Experiments/bulkshortener/" />
	<meta property="og:image" content="http://manraj.collegespace.in/Experiments/bulkshortener/img.png" />
	<meta property="og:description" content="A 45 minute project to create a service for shortening URLs in bulk." />
	<meta property="og:site_name" content="Bulk URL Shortener" />
	<script src="https://code.jquery.com/jquery-2.1.1.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<title>Bulk URL Shortener</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
</head>

<body>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="font-size:35px;text-align:center;">Your Bulk URL Shortening Service</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="font-size:20px;text-align:center;">By <span><a href="https://www.linkedin.com/in/manrajsinghgrover" target="_blank">manrajsingh</a></span></div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="font-size:20px;text-align:center;">Idea credits: Yashika Garg and Rahul Gandhi <span style="color:red;">:P</span></div>
		</div>
		<?php if(!isset($_POST[ 'submit'])){ echo '<div class="row" style="padding-top:20px;"><form name="contactform" method="POST" action="index.php" sytle="top:20px;"><div class="form-group"><label for="urls" > Please enter your URLs here! </label><textarea class="form-control" placeholder="Your URLs go here! Please enter one url in one line." name="urls" id="urls" maxlength="10000" cols="100" rows="10"></textarea></div><div class="form-group"><input type="submit" name="submit" id="submit" class="btn btn-default btn-md " value="Short it!" /></div></form></div>'; } else{ filter_var_array($_POST, FILTER_SANITIZE_STRING); $urls=e xplode(PHP_EOL, $_POST[ 'urls']); $i=0; foreach($urls as $url){ $curl=c url_init(); $post_data=a rray( 'format'=> 'json', 'apikey' => 'GET YOUR OWN API KEY!', 'provider' => 'tinyurl_com', 'url' => $url ); $api_url = 'http://tiny-url.info/api/v1/create'; curl_setopt($curl, CURLOPT_URL, $api_url); curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); curl_setopt($curl, CURLOPT_POST, 1); curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data); $result = curl_exec($curl); curl_close($curl); $result = json_decode($result, true); $x[$result['longurl']]=array($result['state'],$result['longurl'],$result['shorturl']); } echo '
		<div class="table-responsive" style="padding-top:20px;">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>#</th>
						<th>Long URL</th>
						<th>Short URL</th>
					</tr>
				</thead>
				<tbody>'; foreach($x as $v){ if($v[0]=="ok"){ $i++; echo '
					<tr>
						<th>'.$i.'</th>
						<td>'.$v[1].'</td>
						<td><a href="'.$v[2].'" target="_blank">'.$v[2].'</a></td>
					</tr>'; } } echo '</tbody>
			</table>
		</div>'; } ?>
	</div>
</body>

</html>