
<div class="x_panel">
	<div class="x_title">
		<h2>Un devis</h2></br>
		<p>{{ $data['firstname'] }} {{ strtoupper($data['lastname']) }}</p>
		<p>Vous pouvez voir le fichier de devis ci-joint</p>
		<p>Acceptez-vous un devis ?</p>
		<p>
			<form action="{{route('email.update',['id_devis'=>$id_devis, 'id_client'=>$data['id'], 'status'=>1])}}" method="get">
			      @csrf
                              
			      <button type="submit" class="btn btn-info">Accepter</button>
                        </form>
	 		&nbsp;&nbsp;	 
			<form action="{{route('email.update',['id_devis'=>$id_devis, 'id_client'=>$data['id'], 'status'=>0])}}" method="get">
			      @csrf
                              
			      <button type="submit" class="btn btn-info">Rejeter</button>
                        </form>
		</p>	
	</div>
</div>

