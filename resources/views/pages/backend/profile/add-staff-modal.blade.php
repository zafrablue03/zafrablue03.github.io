<form action="{{ route('add.staff') }}" method="POST">
    @csrf
    <div class="modal fade" id="modalAddStaffForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">Triple E add new Staff</h4>
                </div>
                <div class="modal-body mx-3">
                    <div class="md-form mb-5">
                        <i class="fas fa-user prefix grey-text"></i>
                        <input type="text" id="form34" name="name" 
                        class="form-control validate @error('name') is-invalid @enderror">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <label data-error="wrong" data-success="right" for="form34">Staff name</label>
                    </div>
    
                    <div class="md-form mb-5">
                        <i class="fas fa-envelope prefix grey-text"></i>
                        <input type="email" id="form29" name="email" 
                        class="form-control validate  @error('email') is-invalid @enderror"">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <label data-error="wrong" data-success="right" for="form29">Email</label>
                    </div>
                        <span><code>Note: password is automatically set to "tripleestaff2019"</code></span>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button class="btn btn-info" type="submit">Submit</button>
                </div>
            </div>
        </div>
    </div>
</form>