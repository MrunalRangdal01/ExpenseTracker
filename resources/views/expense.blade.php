@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('My Expenses > Expenses') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    @if(session('errorMsg'))
                    <span style="color:red"><strong>{{ session('errorMsg') }}</strong></span>
                    @endif
                    @if(session('successMsg'))
                    <span style="color:green"><strong>{{ session('successMsg') }}</strong></span>
                    @endif

                    <div class="right_col" role="main" style="min-height:0px !important;">
                        <div class="">
                            <div class="page-title">
                                <div class="title_left d-flex justify-content-between align-items-center" style="margin-bottom:10px">
                                    <h3>Expense</h3>
                                    <button class="btn btn-secondary" type="button" data-toggle="modal" data-target="#exampleModalCenter">Add Expense + </button>
                                </div>
                            </div>

                            <div class="clearfix"></div>
                            <div id="flashMessage" class="alert" role="alert" style="display: none;"></div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="width: 100%;">
                                            <thead class="thead-style">
                                                <tr>
                                                    <th>Expense ID</th>
                                                    <th>Title</th>
                                                    <th>Category</th>
                                                    <th>Amount</th>
                                                    <th>Description</th>
                                                    <th>Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($expenses as $ex)
                                                <tr>
                                                    <td>{{$ex->id}}</td>
                                                    <td>{{$ex->title}}</td>
                                                    <td>{{$ex->category->category_name}}</td>
                                                    <td>{{$ex->amount}}</td>
                                                    <td>{{$ex->description}}</td>
                                                    <td>{{$ex->date}}</td>
                                                    <td>
                                                        <button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#editModalCenter{{$ex->id}}"><i class="fa fa-edit" aria-hidden="true"></i> Edit</button>
                                                        <a id="deleteCategory" href="{{route('delete_expense',$ex->id)}}" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Add Expense Modal -->
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalCenterTitle">Add Expense Details</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div id="flashMessage" class="alert" role="alert" style="display: none;"></div>
                                <form id="addExpenseForm" action="{{ route('add_expense') }}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="Name" class="required-field">Title</label>
                                                    <input type="text" placeholder="Enter title" class="form-control" name="title">
                                                    <span id="title_error" style="color: red; display: none;"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="Name" class="required-field">Category</label>
                                                    <!-- <input type="text" placeholder="Enter category name" class="form-control" name="category"> -->
                                                    <select name="category" class="form-control">
                                                        <option value="" disabled selected>Select Category</option>
                                                        @foreach($categories as $cat)
                                                        <option value="<?php echo $cat->id; ?>">{{$cat->category_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <span id="category_error" style="color: red; display: none;"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="Name" class="required-field">Amount</label>
                                                    <input type="number" placeholder="Enter title" class="form-control" name="amount">
                                                    <span id="amount_error" style="color: red; display: none;"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="Name" class="required-field">Date</label>
                                                    <input type="date" placeholder="Enter title" class="form-control" name="date">
                                                    <span id="date_error" style="color: red; display: none;"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="Name">Description</label>
                                                    <textarea name="description" rows="3" class="form-control"></textarea>
                                                    <span id="cat_name_error" style="color: red; display: none;"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-primary" onclick="submitForm()">Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>                    </div>

                    <!-- Edit Expense Modals -->
                    @foreach($expenses as $ex)
                    <div class="modal fade" id="editModalCenter<?php echo $ex->id; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalCenterTitle">Edit Expense Details</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div id="flashMessage" class="alert" role="alert" style="display: none;"></div>
                                <form id="updateExpenseForm" action="{{ route('update_expense') }}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row">
                                        <input type="hidden" name="id" value="<?php echo $ex->id; ?>">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="Name" class="required-field">Title</label>
                                                    <input type="text" placeholder="Enter title" class="form-control" name="title" value="<?php echo $ex->title; ?>">
                                                    <span id="title_error" style="color: red; display: none;"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="Name" class="required-field">Category</label>
                                                    <!-- <input type="text" placeholder="Enter category name" class="form-control" name="category"> -->
                                                    <select name="category" class="form-control">
                                                        <option value="" disabled>Select Category</option>
                                                        @foreach($categories as $cat)
                                                        <option value="{{ $cat->id }}" {{ $cat->id == $ex->category_id ? 'selected' : '' }}>{{ $cat->category_name }}</option>
                                                        @endforeach
                                                    </select>

                                                    <span id="category_error" style="color: red; display: none;"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="Name" class="required-field">Amount</label>
                                                    <input type="number" placeholder="Enter title" class="form-control" name="amount" value="<?php echo $ex->amount; ?>">
                                                    <span id="amount_error" style="color: red; display: none;"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="Name" class="required-field">Date</label>
                                                    <input type="date" placeholder="Enter title" class="form-control" name="date" value="<?php echo $ex->date; ?>">
                                                    <span id="date_error" style="color: red; display: none;"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="Name">Description</label>
                                                    <textarea name="description" rows="3" class="form-control">{{$ex->description}}</textarea>
                                                    <span id="cat_name_error" style="color: red; display: none;"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script>
    function submitForm() {
        // Get form data
        var formData = $('#addExpenseForm').serialize();
        // Send Ajax request
        $.ajax({
            type: 'POST',
            url: '{{ route("add_expense") }}',
            data: formData,
            success: function(response, textStatus, xhr) {
                if (xhr.status === 302) {
                    // Redirect detected
                    var redirectUrl = xhr.getResponseHeader('Location');
                    if (redirectUrl) {
                        window.location.replace(redirectUrl); // Redirect to the specified URL
                    } else {
                        // Handle redirection error
                        console.error('Redirection URL not found.');
                    }
                } else {
                    // Handle success response as usual
                    alert("Expense added successfully.");
                    $('#exampleModalCenter').modal('hide');
                    location.reload();
                }
            },
            error: function(error) {
                // Handle error response
                if (error.status === 422) {
                    // If validation fails, display errors
                    var errors = error.responseJSON.errors;
                    if (errors.title) {
                        $('#title_error').text(errors.title[0]);
                        $('#title_error').css('display', 'block');
                    } else {
                        $('#title_error').css('display', 'none');
                    }
                    if (errors.category) {
                        $('#category_error').text(errors.category[0]);
                        $('#category_error').css('display', 'block');
                    } else {
                        $('#category_error').css('display', 'none');
                    }
                    if (errors.amount) {
                        $('#amount_error').text(errors.amount[0]);
                        $('#amount_error').css('display', 'block');
                    } else {
                        $('#amount_error').css('display', 'none');
                    }
                    if (errors.date) {
                        $('#date_error').text(errors.date[0]);
                        $('#date_error').css('display', 'block');
                    } else {
                        $('#date_error').css('display', 'none');
                    }
                } else {
                    // Handle other error scenarios
                    console.error('Error occurred:', error);
                }
            }
        });

    }

    $('#updateExpenseForm').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize(); // Serialize form data
        var url = $(this).attr('action'); // Get form action URL

        $.ajax({
            type: 'POST',
            url: '{{ route("update_expense") }}',
            data: formData,
            success: function(response, textStatus, xhr) {
                if (xhr.status === 302) {
                    // Redirect detected
                    var redirectUrl = xhr.getResponseHeader('Location');
                    if (redirectUrl) {
                        window.location.replace(redirectUrl); // Redirect to the specified URL
                    } else {
                        // Handle redirection error
                        console.error('Redirection URL not found.');
                    }
                } else {
                    // Handle success response as usual
                    alert("Expense updated successfully.");
                    $('#editModalCenter' + response.id).modal('hide');
                    location.reload();
                }
            },
            error: function(error) {
                // Handle error response
                if (error.status === 422) {
                    // If validation fails, display errors
                    var errors = error.responseJSON.errors;
                    if (errors.title) {
                        $('#title_error').text(errors.title[0]);
                        $('#title_error').css('display', 'block');
                    } else {
                        $('#title_error').css('display', 'none');
                    }
                    if (errors.category) {
                        $('#category_error').text(errors.category[0]);
                        $('#category_error').css('display', 'block');
                    } else {
                        $('#category_error').css('display', 'none');
                    }
                    if (errors.amount) {
                        $('#amount_error').text(errors.amount[0]);
                        $('#amount_error').css('display', 'block');
                    } else {
                        $('#amount_error').css('display', 'none');
                    }
                    if (errors.date) {
                        $('#date_error').text(errors.date[0]);
                        $('#date_error').css('display', 'block');
                    } else {
                        $('#date_error').css('display', 'none');
                    }
                } else {
                    // Handle other error scenarios
                    console.error('Error occurred:', error);
                }
            }
        });
    });
</script>

@endsection
