@extends('layouts.master')

@push('title')
    Task Lists
@endpush

@push('breadcumb')
    Task Lists
@endpush

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="block">
          <div class="row">
            <div class="col-sm-8 d-flex">
                <form method="GET" action="{{ route('tasks.index') }}" class="d-flex">
                    <select name="status" class="form-control">
                        <option value="">All Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>

                    <select name="sort" class="form-control mx-2">
                        <option value="">Sort by Due Date</option>
                        <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Ascending</option>
                        <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Descending</option>
                    </select>

                    <button type="submit" class="btn btn-primary">Filter</button>
                </form>
            </div>
            <div class="col-sm-4 d-flex justify-content-end">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addTask">
                    <i class="fa fa-plus"></i> Add Task
                </button>
            </div>
          </div>
          <div class="table-responsive mt-5">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Title</th>
                  <th>Description</th>
                  <th>Due Date</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($tasks as $task)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $task->user->name ?? '' }}</td>
                        <td>{{ $task->title ?? '' }}</td>
                        <td>{{ Str::of($task->description)->limit(15) ?? '' }}</td>
                        <td>{{ $task->due_date ?? '' }}</td>
                        <td>{{ $task->status ?? '' }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#viewTask{{ $task->id }}">
                                <i class="fa fa-eye"></i> view
                            </button>
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editTask{{ $task->id }}">
                                <i class="fa fa-pencil"></i> edit
                            </button>
                            <form id="delete-task-{{ $task->id }}" action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                            <button class="btn btn-sm btn-primary" onclick="confirmDelete({{ $task->id }})"><i class="fa fa-trash"></i> Delete</button>
                        </td>
                    </tr>


                    {{-- View Task --}}
                    <div class="modal fade" id="viewTask{{ $task->id }}" tabindex="-1" role="dialog" aria-labelledby="viewTaskLabel{{ $task->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="viewTaskLabel{{ $task->id }}">View Task</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="block">
                                                <div class="block-body">
                                                    <div class="form-group row">
                                                    <label class="col-sm-3 form-control-label">Title</label>
                                                    <div class="col-sm-9">
                                                        <input id="inputHorizontalSuccess" type="text" name="title" value="{{ $task->title ?? '' }}" placeholder="Enter Title" class="form-control form-control-success">
                                                    </div>
                                                    </div>
                                                    <div class="form-group row">
                                                    <label class="col-sm-3 form-control-label">Description</label>
                                                    <div class="col-sm-9">
                                                        <textarea name="description" class="form-control form-control-success" placeholder="Enter Description">{{ $task->description ?? '' }}</textarea>

                                                    </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 form-control-label">Due Date</label>
                                                        <div class="col-sm-9">
                                                        <input id="inputHorizontalSuccess" type="date" name="due_date" value="{{ $task->due_date ?? '' }}" placeholder="Due Date" class="form-control form-control-success">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 form-control-label">Status</label>
                                                        <div class="col-sm-9">
                                                            <select name="account" class="form-control ">
                                                                <option @if($task->status == 'pending') selected @else @disabled(true) @endif>Pending</option>
                                                                <option @if($task->status == 'processing') selected @else @disabled(true) @endif>Processing</option>
                                                                <option @if($task->status == 'completed') selected @else @disabled(true) @endif>Completed</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 form-control-label">User</label>
                                                        <div class="col-sm-9">
                                                        <input id="inputHorizontalSuccess" type="text" name="name" value="{{ $task->user->name ?? '' }}" placeholder="name" class="form-control form-control-success">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Edit Task --}}
                    <div class="modal fade" id="editTask{{ $task->id }}" tabindex="-1" role="dialog" aria-labelledby="editTaskLabel{{ $task->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editTaskLabel{{ $task->id }}">Edit Task</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <form action="{{ route('tasks.update',$task->id) }}" method="post" class="form-horizontal">
                                    @csrf
                                    @method('put')
                                   <div class="modal-body">
                                       <div class="row">
                                           <div class="col-sm-12">
                                               <div class="block">
                                                   <div class="block-body">
                                                       <div class="form-group row">
                                                         <label class="col-sm-3 form-control-label">Title</label>
                                                         <div class="col-sm-9">
                                                           <input id="inputHorizontalSuccess" type="text" name="title" value="{{ $task->title }}" placeholder="Enter Title" class="form-control form-control-success">
                                                           @if ($errors->has('title'))<span class="text-danger"> {{ $errors->first('title') }}</span>@endif
                                                       </div>
                                                       </div>
                                                       <div class="form-group row">
                                                         <label class="col-sm-3 form-control-label">Description</label>
                                                         <div class="col-sm-9">
                                                           <textarea name="description" class="form-control form-control-success" placeholder="Enter Description">{{ $task->description }}</textarea>
                                                           @if ($errors->has('description'))<span class="text-danger"> {{ $errors->first('description') }}</span>@endif
                                                       </div>
                                                       </div>
                                                       <div class="form-group row">
                                                           <label class="col-sm-3 form-control-label">Due Date</label>
                                                           <div class="col-sm-9">
                                                             <input id="inputHorizontalSuccess" type="date" name="due_date" value="{{ $task->due_date }}" placeholder="Due Date" class="form-control form-control-success">
                                                             @if ($errors->has('due_date'))<span class="text-danger"> {{ $errors->first('due_date') }}</span>@endif
                                                           </div>
                                                         </div>
                                                   </div>
                                                 </div>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="modal-footer">
                                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                       <button type="submit" class="btn btn-primary">Update Task</button>
                                   </div>
                               </form>
                            </div>
                        </div>
                    </div>

                    @push('scripts')
                        <script>
                            $(document).ready(function() {
                                @if ($errors->any())
                                    $('#editTask{{ $task->id }}').modal('show');
                                @endif
                            });
                        </script>
                    @endpush

                @empty
                    <tr class="text-danger text-center">
                        <td colspan="7">No Data Found</td>
                    </tr>
                @endforelse

              </tbody>
            </table>
          </div>
        </div>
      </div>
</div>

{{-- Add Task --}}
<div class="modal fade" id="addTask" tabindex="-1" role="dialog" aria-labelledby="addTaskLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTaskLabel">Add Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('tasks.store') }}" method="post" class="form-horizontal">
             @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="block">
                            <div class="block-body">
                                <div class="form-group row">
                                  <label class="col-sm-3 form-control-label">Title</label>
                                  <div class="col-sm-9">
                                    <input id="inputHorizontalSuccess" type="text" name="title" placeholder="Enter Title" class="form-control form-control-success">
                                    @if ($errors->has('title'))<span class="text-danger"> {{ $errors->first('title') }}</span>@endif
                                </div>
                                </div>
                                <div class="form-group row">
                                  <label class="col-sm-3 form-control-label">Description</label>
                                  <div class="col-sm-9">
                                    <textarea name="description" class="form-control form-control-success" placeholder="Enter Description"></textarea>
                                    @if ($errors->has('description'))<span class="text-danger"> {{ $errors->first('description') }}</span>@endif
                                </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 form-control-label">Due Date</label>
                                    <div class="col-sm-9">
                                      <input id="inputHorizontalSuccess" type="date" name="due_date" placeholder="Due Date" class="form-control form-control-success">
                                      @if ($errors->has('due_date'))<span class="text-danger"> {{ $errors->first('due_date') }}</span>@endif
                                    </div>
                                  </div>
                            </div>
                          </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Task</button>
            </div>
        </form>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        @if ($errors->any())
            $('#myModal').modal('show');
        @endif
    });

</script>
@endpush
