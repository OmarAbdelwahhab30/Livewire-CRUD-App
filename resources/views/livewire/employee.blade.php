<div>
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @elseif(session("fail"))
                        <div class="alert alert-danger">
                            {{ session('fail') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Manage <b>Employees</b></h2>
                        </div>
                        <div class="col-sm-6">
                            @auth()
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#addEmployeeModal">
                                    Add New Employee
                                </button>
                                <livewire:logout/>
                            @endauth
                            @guest()
                                <a href="/login" wire:navigate class="btn btn-outline-dark text-bg-dark"><i
                                        class="material-icons">&#xE147;</i> <span>Login</span></a>
                                <a href="/register" wire:navigate class="btn btn-outline-dark text-bg-dark"><i
                                        class="material-icons">&#xE147;</i> <span>Register</span></a>

                            @endguest
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($employees as $employee)
                        <tr>
                            <td>{{$employee->name}}</td>

                            <td>{{$employee->email }}</td>
                            @auth
                                <td>
                                    <button wire:click="clickEdit({{$employee->id}})" type="button"
                                            data-bs-toggle="modal" data-bs-target="#editEmployeeModal"
                                            class="mt-1 btn btn-warning" data-toggle="modal"><i class="material-icons"
                                                                                                data-toggle="tooltip"
                                                                                                title="edit">&#xE254;</i>
                                    </button>
                                    <button type="button" wire:click="clickEdit({{$employee->id}})" data-bs-toggle="modal" data-bs-target="#deleteEmployeeModal"
                                            class="mt-1 btn btn-danger" data-toggle="modal"><i class="material-icons"
                                                                                               data-toggle="tooltip"
                                                                                               title="Delete">&#xE872;</i>
                                    </button>
                                </td>
                            @endauth
                        </tr>
                    @empty
                        <tr>There is no employees to show !</tr>
                    @endforelse
                    </tbody>
                </table>
                <div>
                    {{ $employees->links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- Add Modal HTML -->
    <div wire:ignore.self class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add an employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="name" class="form-label">name</label>
                            <input type="text" class="form-control" wire:model.blur="form.name" id="name"
                                   aria-describedby="name">
                            <div class="text-danger">@error('form.name') {{ $message }} @enderror</div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="email" wire:model.blur="form.email" class="form-control"
                                   id="exampleInputEmail1"
                                   aria-describedby="emailHelp">
                            <div class="text-danger">@error('form.email') {{ $message }} @enderror</div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" wire:model.blur="form.password" class="form-control"
                                   id="exampleInputPassword1">
                            <div class="text-danger">@error('form.password') {{ $message }} @enderror</div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                            <input type="password" wire:model.blur="form.ConfirmPassword" class="form-control"
                                   id="exampleInputPassword1">
                            <div class="text-danger">@error('form.ConfirmPassword') {{ $message }} @enderror</div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" wire:click="addEmployee" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Modal HTML -->
    <div wire:ignore.self class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="editEmployeeModal"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit an employee !</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="name" class="form-label">name</label>
                            <input type="text"  class="form-control"
                                   wire:model.blur="form.name" value="{{$this->CurrentEmployee->name ?? ''}}" id="name" aria-describedby="name">
                            <div class="text-danger">@error('form.name') {{ $message }} @enderror</div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="email" value="{{$this->CurrentEmployee->email ?? ''}}"
                                   wire:model.blur="form.email" class="form-control" id="exampleInputEmail1"
                                   aria-describedby="emailHelp">
                            <div class="text-danger">@error('form.email') {{ $message }} @enderror</div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Enter Your Password or (Update it)</label>
                            <input type="password" wire:model.blur="form.password" class="form-control"
                                   id="exampleInputPassword1">
                            <div class="text-danger">@error('form.password') {{ $message }} @enderror</div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Confirm Your Password</label>
                            <input type="password" wire:model.blur="form.ConfirmPassword" class="form-control"
                                   id="exampleInputPassword1">
                            <div class="text-danger">@error('form.ConfirmPassword') {{ $message }} @enderror</div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" wire:click="editEmployee({{$this->CurrentEmployee->id ?? 1}})"
                            class="btn btn-outline-warning">Save changes
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Modal HTML -->
    <div wire:ignore.self class="modal fade" id="deleteEmployeeModal" tabindex="-1" aria-labelledby="deleteEmployeeModal"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete forever !</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are You Sure to delete this employee ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" wire:click="deleteEmployee({{$this->CurrentEmployee->id ?? 1}})" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>
