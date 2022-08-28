
<div class="x_panel">
	<div class="x_title">
		<h4>Bonjour,</h4></br>
		<?php
			if ($status == 0) {
		?>
		<p>{{$data_client->firstname}} {{$data_client->lastname}} n'a pas choisi devis "{{$name_devis}}"</p>
		<?php
			} else if ($status == 1) {
		?>
		<p>{{$data_client->firstname}} {{$data_client->lastname}} a choisi devis "{{$name_devis}}"</p>
		<?php
			}
		?>
	</div>
</div>

