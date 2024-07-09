@extends('layout.app')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <h2>Student Add System</h2>
        </div>
        <div class="col-md-3 offset-md-3">
            <a href="{{route('pages.create')}}"><button class="btn btn-primary">Add New Student</button></a>
        </div>
    </div>

    <table class="table mt-5">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Image</th>
            <th scope="col">Phone</th>
            <th scope="col">Address</th>
            <th scope="col">Action</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>Ashraful</td>
            <td>image</td>
            <td>01902659973</td>
            <td>Mushiganj</td>
            <td>
                <a href="#"><i class="fa-solid fa-pen-to-square btn btn-success"></i></a>
                <a href="#"><i class="fa-solid fa-trash btn btn-danger"></i></a>
            </td>
          </tr>
        </tbody>
      </table>
</div>
@endsection