@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card mt-3">
					<div class="card-body">
						<h3 class="text-center">Your game rate {{$game->rate}}</h3>
						<div class="mt-5">

							@foreach($game->getGameQuestion as $gameQuestion)
								@if(!is_null($gameQuestion->answer_id))
									<div class="border row mt-3 p-2">
										<div class="col-md-12 ">
											<h4 class="text-center">{{ $gameQuestion->getQuestion->question }}</h4>
										</div>
										<div class="col-md-12 row">
											@foreach($gameQuestion->getQuestion->getAnswers as $key => $answer)
												@if($gameQuestion->answer_id == $answer->id)
													<div class="col-md-12 p-4 border-dark">
														<div class="{{ $gameQuestion->right == 1?'text-success':'text-danger'  }}">{{ $answer->answer }}</div>
													</div>
												@else
													<div class="col-md-12 p-4 border-dark">
														<div class="{{  $answer->right == 1?'text-success':''  }}">{{ $answer->answer }}</div>
													</div>
												@endif
											@endforeach
										</div>
									</div>
								@endif
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection