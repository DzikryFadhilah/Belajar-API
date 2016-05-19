@extends('app')

@section('content')
<h4>Country</h4>
<table>
	<thead>
		<tr>
			<th>Country ID</th>
			<th>Country Name</th>
			<th>Country AreaCode</th>
		</tr>
		<tbody>
			@foreach($data as $key)
				<tr>
					<td>{{$key->country_id}}</td>
					<td>{{$key->country_name}}</td>
					<td>{{$key->country_areacode}}</td>
				</tr>
				@endforeach
		</tbody>
	</thead>
</table>
<<<<<<< HEAD
@endsection
=======
@endsection
>>>>>>> 1f99628cb77c6b681e14b284c4b1943c25502ce5
