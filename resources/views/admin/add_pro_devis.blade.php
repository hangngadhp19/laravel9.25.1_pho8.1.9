@extends('layouts.admin')
@section('content')
<div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Tables <small>Some examples to get you started</small></h3>
      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5   form-group pull-right top_search">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button">Go!</button>
            </span>
          </div>
        </div>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row" style="display: block;">

      <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
          <div class="x_title">
            <h2>Bordered table <small>Bordered table subtitle</small></h2>
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
	    <form class="form-horizontal form-label-left" method="post" action="{{route('devis.store',['id'=>$id_devis])}}">
	    @csrf
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nom</th>
                  <th>Price</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($records as $record) { ?>
                <tr>
                  <th scope="row"><input type="checkbox" value="{{ $record->id }}" name="id_pro[]" id="id_pro[]" 
					<?php echo isset($arr_id_pro_choise[$record->id]) && ($arr_id_pro_choise[$record->id]==$record->id) ? "checked" : "";  ?>></th>
                  <td>{{ $record->name }}</td>
                  <td>{{ $record->price }}</td>
                </tr>
                <?php } ?>
		<tr>
		  <td colspan="3">
                    <button type="submit" class="btn btn-success">Submit</button>
		  </td>
		</tr>
              </tbody>
            </table>
	    </form>
            <?=$records->links("pagination::bootstrap-4")?>
          </div>
        </div>
      </div>

      <div class="clearfix"></div>

    </div>
  </div>
@endsection
