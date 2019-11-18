<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<style type="text/css">

		::selection { background-color: #E13300; color: white; }
		::-moz-selection { background-color: #E13300; color: white; }

		body {
			background-color: #fff;
			margin: 40px;
			font: 13px/20px normal Helvetica, Arial, sans-serif;
			color: #4F5155;
		}

		a {
			color: #003399;
			background-color: transparent;
			font-weight: normal;
		}

		h1 {
			color: #444;
			background-color: transparent;
			border-bottom: 1px solid #D0D0D0;
			font-size: 19px;
			font-weight: normal;
			margin: 0 0 14px 0;
			padding: 14px 15px 10px 15px;
		}

		code {
			font-family: Consolas, Monaco, Courier New, Courier, monospace;
			font-size: 12px;
			background-color: #f9f9f9;
			border: 1px solid #D0D0D0;
			color: #002166;
			display: block;
			margin: 14px 0 14px 0;
			padding: 12px 10px 12px 10px;
		}

		#body {
			margin: 0 15px 0 15px;
		}

		p.footer {
			text-align: right;
			font-size: 11px;
			border-top: 1px solid #D0D0D0;
			line-height: 32px;
			padding: 0 10px 0 10px;
			margin: 20px 0 0 0;
		}

		#container {
			margin: 10px;
			border: 1px solid #D0D0D0;
			box-shadow: 0 0 8px #D0D0D0;
		}
	</style>
</head>
<body>

	<div id="container">
		<h1>Welcome to CodeIgniter!</h1>

		<div id="body">
			<p>The page you are looking at is being generated dynamically by CodeIgniter.</p>

			<p>If you would like to edit this page you'll find it located at:</p>
			<code>application/views/welcome_message.php</code>

			<p>The corresponding controller for this page is found at:</p>
			<code>application/controllers/Welcome.php</code>

			<p>If you are exploring CodeIgniter for the very first time, you should start by reading the <a href="user_guide/">User Guide</a>.</p>
		</div>

		<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
	</div>

</body>
</html>

<div class="card-header" id="heading'.$p++.'">
	<h2 class="mb-0">
		<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse'.$t++.'" aria-expanded="true" aria-controls="collapseOne">
			'.$menu->menu_name.'
		</button>
	</h2>
</div>
<div id="collapse'.$a++.'" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
	<div class="card-body">
		<div class="row justify-content-center">
			<label class="col-sm-2 col-form-label align-self-center text-center">Insight</label>
			<div class="col-sm-8">
				<textarea class="form-control" rows="5" name="insight'.$i++.'"></textarea>
			</div>
		</div>
		<div>
			Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably havent heard of them accusamus labore sustainable VHS.
		</div>
		<br>
		<hr>
		<div>
			<ul>
				<li>Coffee</li>
				<li>Tea</li>
				<li>Milk</li>
			</ul> 
		</div>
	</div>
</div>
</div>

echo '<div class="card">
	<div class="card-header" id="heading'.$p++.'">
		<h2 class="mb-0">
			<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse'.$t++.'" aria-expanded="true" aria-controls="collapseOne">
				'.$child->menu_name.'
			</button>
		</h2>
	</div>
	<div id="collapse'.$a++.'" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
		<div class="card-body">
			<div class="row justify-content-left">
				<label class="col-sm-2 col-form-label align-self-center text-center">Insight</label>
				<div class="col-sm-8">
					<textarea class="form-control" rows="5" name="insight'.$i++.'"></textarea>
				</div>
			</div>
			<div>
			</div>
			<br>
			<hr>';
			foreach ($child->menu_child as $mc ) {
			echo '
			<div class="card-header" id="heading'.$p++.'">
				<h2 class="mb-0">
					<button class="btn" type="button" aria-controls="collapseOne" style="color:#007bff;background-color:transparent">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>'.$mc->menu_name.'</u>
					</button>
				</h2>
			</div>
			<div class="row justify-content-left">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="col-sm-2 col-form-label align-self-center text-center">Insight</label>
				<div class="col-sm-8">
					<textarea class="form-control" rows="5" name="insight'.$i++.'"></textarea>
				</div>
			</div>

			<br>
			';

		}
		echo 
	'</div>
</div>
</div>
<br>';


if ($data['list_menu']->code != 404 ) {
foreach ($data['list_menu']->data as $menu){
foreach ($menu->menu as $child) {
echo '<div class="card">
	<div class="card-header" id="heading'.$p++.'">
		<h2 class="mb-0">
			<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse'.$t++.'" aria-expanded="true" aria-controls="collapseOne">
				'.$child->menu_name.'
			</button>
		</h2>
	</div>
	<div id="collapse'.$a++.'" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
		<div class="card-body">
			<div class="row justify-content-left">
				<label class="col-sm-2 col-form-label align-self-center text-center">Insight</label>
				<div class="col-sm-8">
					<textarea class="form-control" rows="5" name="insight'.$i++.'"></textarea>
				</div>
			</div>
			<div>
			</div>
			<br>
			<hr>';
			foreach ($child->menu_child as $mc ) {
			echo '
			<div class="card-header" id="heading'.$p++.'">
				<h2 class="mb-0">
					<button class="btn" type="button" aria-controls="collapseOne" style="color:#007bff;background-color:transparent">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>'.$mc->menu_name.'</u>
					</button>
				</h2>
			</div>
			<div class="row justify-content-left">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="col-sm-2 col-form-label align-self-center text-center">Insight</label>
				<div class="col-sm-8">
					<br>
					<textarea class="form-control" rows="5" name="insight'.$i++.'"></textarea>';
					echo '
				</div>
			</div>
			<br>
			<hr>
			';
		}
		echo 
	'</div>
</div>
</div>
<br>';
}

}
} else {
echo "No Data Avalaible";
}