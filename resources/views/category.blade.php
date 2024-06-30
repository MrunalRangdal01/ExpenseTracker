@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10"> <!-- Adjusted column width -->
            <div class="card">
                <div class="card-header">{{ __('My Expenses > Categories') }}</div>

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
                                    <h3>Categories</h3>
                                    <button class="btn btn-secondary" type="button" data-toggle="modal" data-target="#exampleModalCenter">Add Category + </button>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box table-responsive">
                                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                            <thead class="thead-style">
                                                <tr>
                                                    <th>Category ID</th>
                                                    <th>Category Name</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($categories as $key=>$category)
                                                <tr>
                                                    <td>{{$category->id}}</td>
                                                    <td>{{$category->category_name}}</td>
                                                    <td>
                                                        <button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#editModalCenter<?php echo $category->id; ?>"><i class="fa fa-edit" aria-hidden="true"></i> Edit</button>
                                                        <a id="deleteCategory" href="{{route('delete_category',$category->id)}}" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
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

                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalCenterTitle">Add Category</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="addCategoryForm" action="{{ route('add_category') }}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="Name" class="required-field">Category Name</label>
                                                    <input type="text" placeholder="Enter category name" class="form-control" name="cat_name">
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
                        </div>
                    </div>

                    <!-- Edit Modal -->
                    @foreach($categories as $cat)
                    <div class="modal fade" id="editModalCenter<?php echo $cat->id; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalCenterTitle">Edit Category</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="updateCategory" action="{{route('update_category')}}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="Name" class="required-field">Category Name</label>
                                                    <input type="text" placeholder="Enter category name" class="form-control" name="cat_name" value="<?php echo $cat->category_name; ?>">
                                                    <input type="hidden" name="id" value="<?php echo $cat->id; ?>">
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
                    <!-- End Edit Modal -->
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
        var formData = $('#addCategoryForm').serialize();
        // Send Ajax request
        $.ajax({
            type: 'POST',
            url: '{{ route("add_category") }}',
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
                    alert("Category added successfully.");
                    $('#exampleModalCenter').modal('hide');
                    location.reload(); // Reload the page to show new data
                }
            },
            error: function(error) {
                // Handle error response
                if (error.status === 422) {
                    // If validation fails, display errors
                    var errors = error.responseJSON.errors;
                    if (errors.cat_name) {
                        $('#cat_name_error').text(errors.cat_name[0]);
                        $('#cat_name_error').css('display', 'block');
                    }
                } else {
                    // Handle other error scenarios
                    console.error('Error occurred:', error);
                }
            }
        });

    }

    $('#updateCategory').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();
        var url = $(this).attr('action');

        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            success: function(response) {
                // Handle success response
                $('#editModalCenter' + response.id).modal('hide');
                alert('Category updated successfully');
                location.reload(); // Reload the page to show updated data
            },
            error: function(xhr, status, error) {
                // Handle error
                console.error('Error:', error);
                alert('Failed to update category');
            }
        });
    });

</script>

@endsection
