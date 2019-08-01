@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card mt-3">
					<div class="card-body">
						<h3 class="text-center mt-3 mb-4">Question info</h3>

							<div class="form-group row">
								<div class="col-md-4 text-md-right">Question</div>

								<div class="col-md-6">
									{{ $data->question }}
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-4 text-md-right">Point</div>

								<div class="col-md-6">
									{{ $data->point }}
								</div>
							</div>
							<h5 class="text-center">Answers</h5>
							<div class="form-group row">

								<div class="col-md-4 col-form-label text-md-right">
									Right
								</div>
								<div class="col-md-6">
									@foreach($data->getAnswers as $key => $answer)
										<div class="mt-2 row answers">
											<div class="col-md-1 p-2">
												@if($answer->right == 1)
													<input type="radio" disabled checked>
												@else
													<input type="radio" disabled >
												@endif
											</div>
											<div class="col-md-11">
												{{ $answer->answer }}
											</div>
										</div>
									@endforeach
								</div>
							</div>
							<div class="form-group row mb-0">
								<div class="col-md-6 offset-md-9 d-flex" >
									<a href="{{ route('question.edit',['id' => $data->id]) }}" class="btn btn-warning mr-2">Edit</a>
									<form action="{{ route('question.destroy',['id' => $data->id]) }}" method="post">
										@csrf
										@method('DELETE')
										<button class="btn btn-danger">Delete</button>
									</form>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection