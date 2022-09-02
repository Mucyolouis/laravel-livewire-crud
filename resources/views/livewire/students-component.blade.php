<div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header justify-content-between">
                        <h6 style="float:left;"><strong>All Students</strong></h6>
                            <button style="float:right;" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addStudentModal">Add New Student</button>
                    </div>

                    <div class="card-body">
                        @if (session()->has('message'))
                            <div class="alert alert-success text-center">{{ session('message') }}</div>
                        @endif

                        <table class="table  table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($students->count() > 0)
                                    @foreach ($students as $student)
                                        <tr>
                                           <td>{{ $student->student_id }}</td>
                                           <td>{{ $student->name }}</td>
                                           <td>{{ $student->email }}</td>
                                           <td>{{ $student->phone }}</td>
                                           <td style="text-align: center">
                                            <button class="btn btn-sm btn-primary" wire:click="viewStudentDetails({{ $student->id }})">View</button> 
                                                <button class="btn btn-sm btn-secondary" wire:click="editStudents({{ $student->student_id }})">Edit</button> 
                                                <button class="btn btn-sm btn-danger" wire:click="deleteConfirmation({{ $student->id }})">Delete</button> 
                                           </td>
                                        </tr>       
                                    @endforeach
                                @else
                                <tr>
                                    <td colspan="4" style="text-align: center;">
                                        <small>No student Found</small>
                                    </td>
                                </tr>
                                        
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
    <!-- Add Modal -->
    <div wire:ignore.self class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add new Student</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            
                        </button>
                </div>
                <div class="modal-body">

                    <form wire:submit.prevent="storeStudentData">
                        <div class="form-group row">
                            <label for="student_id" class="col-3">Student ID</label>
                            <div class="col-9">
                                <input type="number" id="student_id" class="form-control" wire:model="student_id" placeholder="Student ID">
                                @error('student_id')
                                    <span class="text-danger" style="font-size:11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-3">Student Name</label>
                            <div class="col-9">
                                <input type="text" id="name" class="form-control" wire:model="name" placeholder="Student Name">
                                @error('name')
                                    <span class="text-danger" style="font-size:11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-3">Student Email</label>
                            <div class="col-9">
                                <input type="email" id="email" class="form-control" wire:model="email" placeholder="Student@mail.com">
                                @error('email')
                                    <span class="text-danger" style="font-size:11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-3">Student Phone</label>
                            <div class="col-9">
                                <input type="number" id="phone" class="form-control" wire:model="phone" placeholder="Phone number">
                                @error('phone')
                                    <span class="text-danger" style="font-size:11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="student_id" class="col-3">Student ID</label>
                            <div class="col-9">
                                <button type="submit" class="btn btn-sm btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Modal --}}
    <div wire:ignore.self class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form wire:submit.prevent="editStudentData">
                        <div class="form-group row">
                            <label for="student_id" class="col-3">Student ID</label>
                            <div class="col-9">
                                <input type="number" id="student_id" class="form-control" wire:model="student_id" placeholder="Student ID">
                                @error('student_id')
                                    <span class="text-danger" style="font-size:11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-3">Student Name</label>
                            <div class="col-9">
                                <input type="text" id="name" class="form-control" wire:model="name" placeholder="Student Name">
                                @error('name')
                                    <span class="text-danger" style="font-size:11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-3">Student Email</label>
                            <div class="col-9">
                                <input type="email" id="email" class="form-control" wire:model="email" placeholder="Student@mail.com">
                                @error('email')
                                    <span class="text-danger" style="font-size:11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-3">Student Phone</label>
                            <div class="col-9">
                                <input type="number" id="phone" class="form-control" wire:model="phone" placeholder="Phone number">
                                @error('phone')
                                    <span class="text-danger" style="font-size:11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="student_id" class="col-3">Student ID</label>
                            <div class="col-9">
                                <button type="submit" class="btn btn-sm btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- delete modal --}}
    <div wire:ignore.self class="modal fade" id="deleteStudentModal" tabindex="-1" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-4 pb-4">
                    <h6>Are you sure? you want to delete this student data!?</h6>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-primary" wire:click="cancel()">Cancel</button>
                    <Yes! class="btn btn-sm btn-danger" wire:click="deleteStudentData()">Yes! Delete</button>
                </div>
            </div>
        </div>
    </div>

    {{-- View Modal --}}
    <div wire:ignore.self class="modal fade" id="viewStudentModal" tabindex="-1" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Student Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closeViewStudentModal()"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>ID:</th>
                                <td>{{ $view_student_id }}</td>
                            </tr>

                            <tr>
                                <th>Name:</th>
                                <td>{{ $view_student_name }}</td>
                            </tr>

                            <tr>
                                <th>Email:</th>
                                <td>{{ $view_student_email }}</td>
                            </tr>

                            <tr>
                                <th>Phone:</th>
                                <td>{{ $view_student_phone }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        window.addEventListener('close-modal', event =>{
            $('#addStudentModal').modal('hide');
            $('#editStudentModal').modal('hide');
            $('#deleteStudentModal').modal('hide');
        }); 

        window.addEventListener('show-edit-student-modal', event =>{
            $('#editStudentModal').modal('show');
        });
        
        window.addEventListener('show-delete-confirmation-modal', event =>{
            $('#deleteStudentModal').modal('show');
        });

        window.addEventListener('show-view-student-modal', event =>{
            $('#viewStudentModal').modal('show');
        });
    </script>
@endpush