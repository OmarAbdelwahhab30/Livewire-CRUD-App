<div class="container mt-5 w-25 p-3">
    @if (session('fail'))
        <div class="alert alert-danger">
            {{ session('fail') }}
        </div>
    @endif
    <form>
        <!-- Email input -->
        <div data-mdb-input-init class="form-outline mb-4">
            <input type="email" id="form2Example1"  wire:model.blur="form.email" class="form-control"/>
            <label class="form-label" for="form2Example1">Email address</label>
            <div class="text-danger">@error('form.email') {{ $message }} @enderror</div>
        </div>

        <!-- Password input -->
        <div data-mdb-input-init class="form-outline mb-4">
            <input type="password" wire:model.blur="form.password" id="form2Example2" class="form-control"/>
            <label class="form-label" for="form2Example2">Password</label>
            <div class="text-danger">@error('form.password') {{ $message }} @enderror</div>
        </div>
        <!-- Submit button -->
        <button type="button" wire:click="login" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4">Sign
            in
        </button>

        <!-- Register buttons -->
        <div class="text-center">
            <p>Not a member? <a href="/register" wire:navigate>Register</a></p>
        </div>
    </form>
</div>
