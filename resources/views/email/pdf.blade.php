
<div class="x_panel">
	<div class="x_title">
		<div>
		    <h1>Un devis</h1>
		    <table border = "1" width="100%">
				<tr>
					<td>Nom</td>
					<td>Prix</td>
				</tr>
			<?php 
				$sum = 0;
				if (is_array($name) && count($name) > 0) {
					foreach($name as $key=>$value) { 
				$sum += $price[$key];
			?>
				<tr>
					<td>{{$value}}</td>
					<td>{{$price[$key]}}</td>
				</tr>
			<?php } } ?>
				<tr>
					<td>Somme</td>
					<td>{{$sum}}</td>
				</tr>
		    </table>
		    <html-separator/>
		    
		</div>	
	</div>
</div>

