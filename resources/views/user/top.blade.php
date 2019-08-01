@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card mt-3">
					<div class="card-body">
						<h3 class="text-center">Top 10 User</h3>
						<div class="row mt-5">
							@foreach($users as $user)
								<div class="col-md-6">
									<h5 class="text-center">{{ $user->name.'  '.$user->surname}}</h5>
								</div>
								<div class="col-md-4">
									{{ $user->rate}}
								</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection