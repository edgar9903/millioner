@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card mt-3">
					<div class="card-body">
						<form action="{{ route('user.confirm.answer') }}"  id="confirmForm" method="post">
							@csrf
							<div class="row mt-5">
								<div class="col-md-12">
									<h3 class="text-center">{{ $question->question }}</h3>
								</div>
								<div class="col-md-12 row">
									@foreach($question->getAnswers as $answer)
										<div class="col-md-6 mt-2 text-center">
											<button answer="{{ Crypt::encrypt($answer->id) }}" class="btn btn-outline-primary btn_answers">{{ $answer->answer }}</button>
										</div>
									@endforeach
								</div>
							</div>
						</form>
						<a class="btn btn-info float-right" href="{{ route('user.home') }}">Finish game</a>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection