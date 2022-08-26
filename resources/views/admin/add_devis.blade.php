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
		<?php
			if (!empty($success)) {
		?>
				<h3>Sauvegarde réussie</h3>
				<a href="{{route('listing.index',['model'=>'Devis'])}}">Retour à la page de liste</a>
		<?php
			} else {
		?>
		<form class="form-horizontal form-label-left" method="post" action="{{route('editing.store',['model'=>'Devis'])}}">
			@csrf
			<div class="form-group row ">
				<label class="control-label col-md-3 col-sm-3 ">Nom <span class="required">*</span></label>
				<div class="col-md-9 col-sm-9 ">
					<input type="text" class="form-control" placeholder="Nom" name="name" id="name" class="@error('name') is-invalid @enderror">
					@error('name')
					    <div class="alert alert-danger">{{ $message }}</div>
					@enderror
				</div>
			</div>

			<div class="form-group row ">
				<label class="control-label col-md-3 col-sm-3 ">Description <span class="required">*</span></label>
				<div class="col-md-9 col-sm-9 ">
					<textarea name="des" id="des" class="form-control" rows="3" placeholder="Description" class="@error('des') is-invalid @enderror"></textarea>
					
					@error('des')
					    <div class="alert alert-danger">{{ $message }}</div>
					@enderror
				</div>
			</div>

			<div class="ln_solid"></div>
			<div class="form-group">
				<div class="col-md-9 col-sm-9  offset-md-3">
					<button type="submit" class="btn btn-success">Submit</button>
				</div>
			</div>

		</form>
		<?php
		}
		?>
	</div>
</div>
@endsection
