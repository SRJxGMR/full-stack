@extends('layouts.master')

@section('content')

<h2>Edit Student</h2>

<form method="POST" action="index.php?page=update&id={{ $student['id'] }}">

    <label>Name</label><br>
    <input type="text" name="name" value="{{ $student['name'] }}"><br><br>

    <label>Email</label><br>
    <input type="email" name="email" value="{{ $student['email'] }}"><br><br>

    <label>Course</label><br>
    <input type="text" name="course" value="{{ $student['course'] }}"><br><br>

    <button type="submit" class="btn-edit">Update</button>

</form>

@endsection
