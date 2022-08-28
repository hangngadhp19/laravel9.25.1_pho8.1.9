@extends('layouts.admin')
@section('content')
<div class="x_panel">
	<div class="x_title">
		<h2>Form Basic Elements <small>different form elements</small></h2>
		<ul class="nav navbar-right panel_toolbox">
			<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
			</li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
				<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
					<a class="dropdown-item" href="#">Settings 1</a>
					<a class="dropdown-item" href="#">Settings 2</a>
				</div>
			</li>
			<li><a class="close-link"><i class="fa fa-close"></i></a>
			</li>
		</ul>
		<div class="clearfix"></div>
	</div>
	<div class="x_content">
		<br />
		<h2>{{$result}}</h2><br><br>
		<a href="{{route('listing.index',['model'=>'Devis'])}}">Retour à la page de liste</a>
	</div>
</div>
@endsection
