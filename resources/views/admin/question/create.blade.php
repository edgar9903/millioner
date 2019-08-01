@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card mt-3">
					<div class="card-body">
						<h3 class="text-center mt-3 mb-4">Create new question</h3>
						<form action="{{ route('question.store') }}" method="post">
							@csrf
							<div class="form-group row">
								<label for="question" class="col-md-4 col-form-label text-md-right">Question</label>

								<div class="col-md-6">
									<input id="question" type="text" class="form-control @error('question') is-invalid @enderror" name="question" required autocomplete="question" autofocus value="{{ old('email') }}">

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
									<input id="point" type="number" min="5" max="20"  value="{{ old('point')?old('point'):'5' }}" class="form-control @error('point') is-invalid @enderror" name="point" required autocomplete="point" autofocus>

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
									<div class="mt-2 row answers">
										<div class="col-md-1 p-2">
											<input type="radio" required="" name="right" value="0">
										</div>
										<div class="col-md-10">

											<input type="text" name="answer[]" required="required"  class="form-control @error('answers') is-invalid @enderror" value="" >
											@error('answers')
											<span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
											@enderror
										</div>
										<div class="col-md-1 d-flex justify-content-around">
											<button style="height: 39px;" type="button" class="addAnswer btn btn-success mr-1">+</button>
											<button style="height: 39px;" type="button" class="deleteAnswer btn btn-danger" disabled>-</button>
										</div>
									</div>
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