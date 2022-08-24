@extends('layouts.admin')
@section('content')
<div class="x_panel">
	<div class="x_title">
		<h2>Email Client</h2></br><br/>
		<p>Nom: {{ $data['lastname'] }}</p>
		<p>Prenom: {{ $data['firstname'] }}</p>
		<p>Status: {{ $data['status_devis'] == 0 ? 'Non' : 'Oui' }}</p>
		<p>
			<form action="{{route('email.update',['model'=>'Client', 'id'=>$data['id'], 'status'=>1])}}" method="post">
			      @csrf
                              @method('PATCH')
			      <button type="submit" class="btn btn-info">Accepter</button>
                        </form>
	 		&nbsp;&nbsp;	 
			<form action="{{route('email.update',['model'=>'Client', 'id'=>$data['id'], 'status'=>0])}}" method="post">
			      @csrf
                              @method('PATCH')
			      <button type="submit" class="btn btn-info">Rejeter</button>
                        </form>
		</p>	
	</div>
</div>
@endsection