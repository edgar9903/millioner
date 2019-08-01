@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card mt-3">
					<div class="card-body">
						<a class="btn btn-success float-right" href="{{ route('user.start.game') }}">Start game</a>
						<div class="row mt-5">
							@foreach($games as $game)
								<div class="col-md-12 row">
									<div class="col-md-2 offset-4">
										{{ $game->rate}}
									</div>
									<div class="col-md-2">
										<a href="{{ route('user.game.info',['id' => $game->id]) }}">Info</a>
									</div>
								</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection