@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card mt-3">
					<div class="card-body">
						<a class="btn btn-success float-right" href="{{ route('question.create') }}">Create Question</a>
						<div class="row mt-5">
							@foreach($data as $question)
								<div class="col-md-4 p-1 mb-4">
									<a href="{{ route('question.show',['id' => $question->id]) }}" >
										<div class="border p-2 text-center">
											<p>{{ $question->question }}</p>
										</div>
									</a>
								</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection