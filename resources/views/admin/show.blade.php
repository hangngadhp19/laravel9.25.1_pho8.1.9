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
				<a href="{{route('listing.index',['model'=>'Client'])}}">Retour à la page de liste</a>
		<?php
			} else {
		?>
		<form class="form-horizontal form-label-left" method="post" action="{{route('editing.update',['model'=>'Client', 'id'=>$model_data->id])}}">
			@csrf
			@method('PATCH')
			<div class="form-group row ">
				<label class="control-label col-md-3 col-sm-3 ">Nom <span class="required">*</span></label>
				<div class="col-md-9 col-sm-9 ">
					<input type="text" class="form-control" placeholder="Nom" name="lastname" id="lastname" class="@error('lastname') is-invalid @enderror" value="{{$model_data->lastname}}">
					@error('lastname')
					    <div class="alert alert-danger">{{ $message }}</div>
					@enderror
				</div>
			</div>

			<div class="form-group row ">
				<label class="control-label col-md-3 col-sm-3 ">Prénom <span class="required">*</span></label>
				<div class="col-md-9 col-sm-9 ">
					<input type="text" class="form-control" placeholder="Prénom" name="firstname" id="firstname" class="@error('firstname') is-invalid @enderror" value="{{$model_data->firstname}}">
					@error('firstname')
					    <div class="alert alert-danger">{{ $message }}</div>
					@enderror
				</div>
			</div>

			<div class="form-group row ">
				<label class="control-label col-md-3 col-sm-3 ">Email <span class="required">*</span></label>
				<div class="col-md-9 col-sm-9 ">
					<input type="text" class="form-control" placeholder="Email" name="email" id="email" class="@error('email') is-invalid @enderror" value="{{$model_data->email}}">
					@error('email')
					    <div class="alert alert-danger">{{ $message }}</div>
					@enderror
				</div>
			</div>

			<div class="form-group row ">
				<label class="control-label col-md-3 col-sm-3 ">Numéro de téléphone  <span class="required">*</span></label>
				<div class="col-md-9 col-sm-9 ">
					<input type="text" class="form-control" placeholder="Numéro de téléphone" name="tel" id="tel" class="@error('tel') is-invalid @enderror" value="{{$model_data->tel}}">
					@error('tel')
					    <div class="alert alert-danger">{{ $message }}</div>
					@enderror
				</div>
			</div>
			
			
			<div class="form-group row">
				<label class="control-label col-md-3 col-sm-3 ">Adresse <span class="required">*</span>
				</label>
				<div class="col-md-9 col-sm-9 ">
					<input type="text" class="form-control" placeholder="Adresse" name="adress" id="adress" class="@error('adress') is-invalid @enderror" value="{{$model_data->adress}}">
					@error('adress')
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
