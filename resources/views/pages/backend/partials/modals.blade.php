<form action="{{ route('datetime.add') }}" method="POST">
    @csrf
    <div class="modal fade" id="datetime" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">Add new datetime</h4>
                </div>
                <div class="modal-body mx-3">
                    <div class="md-form mb-5">
                        <label data-error="wrong" data-success="right" for="form34">Name <small class="text-muted">(e.g. "lunch,dinner")</small></label>
                        <input type="text" id="form34" name="name" 
                        class="form-control validate @error('name') is-invalid @enderror" 
                        placeholder="dinner, lunch, breakfast" value="{{ old('name') }}">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="md-form mb-5">
                        <label data-error="wrong" data-success="right" for="form34">Time <small class="text-muted">(e.g. "12:00,18:00")24 hour format*</small></label>
                        <input type="text" id="form34" name="time" 
                        class="form-control validate @error('time') is-invalid @enderror" 
                        placeholder="12:00, 18:00" value="{{ old('time') }}">
                        @error('time')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button class="btn btn-info" type="submit">Submit</button>
                </div>
            </div>
        </div>
    </div>
</form>