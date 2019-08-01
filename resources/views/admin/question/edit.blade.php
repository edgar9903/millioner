@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card mt-3">
					<div class="card-body">
						<h3 class="text-center mt-3 mb-4">Create new question</h3>
						<form action="{{ route('question.update',['id' => $data->id]) }}" method="post">
							@csrf
							@method('put')
							<div class="form-group row">
								<label for="question" class="col-md-4 col-form-label text-md-right">Question</label>

								<div class="col-md-6">
									<input id="question" type="text" class="form-control @error('question') is-invalid @enderror" value="{{ old('question')?old('question'):$data->question }}" name="question" required autocomplete="question" autofocus>

									@error('question')
									<span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
									@enderror
								</div>
							</div>
							<div class="form-group row">
								<label for="point" class="col-md-4 col-form-label text-md-right">Point</label>

								<div class="col-md-6">
									<input id="point" type="number" min="5" max="20"  value="{{ old('point')?old('point'):$data->point }}" class="form-control @error('point') is-invalid @enderror"   name="point" required >

									@error('point')
									<span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
									@enderror
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
												<input type="radio" required="" name="right" value="{{ $key }}" checked>
											@else
												<input type="radio" required="" name="right" value="{{ $key }}">
											@endif
										</div>
										<div class="col-md-10">

											@if($key == 0)
											<input type="text" name="answer[]" required="required"  class="form-control @error('answers') is-invalid @enderror" value="{{ $answer->answer }}" >
												@error('answers')
												<span class="invalid-feedback" role="alert">
			                                        <strong>{{ $message }}</strong>
			                                    </span>
												@enderror
											@else
												<input type="text" name="answer[]" required="required"  class="form-control" value="{{ $answer->answer }}" >
											@endif
										</div>
										<div class="col-md-1 d-flex justify-content-around">
											<button style="height: 39px;" type="button" class="addAnswer btn btn-success mr-1">+</button>
											<button style="height: 39px;" type="button" class="deleteAnswer btn btn-danger">-</button>
										</div>
									</div>
									@endforeach
								</div>
							</div>
							<div class="form-group row mb-0">
								<div class="col-md-6 offset-md-9">
									<button type="submit" class="btn btn-primary">
										Submit
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection