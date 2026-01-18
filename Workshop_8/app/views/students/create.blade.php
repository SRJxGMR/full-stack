@extends('layouts.master')

@section('content')

<h2>Add Student</h2>

<form method="POST" action="index.php?page=store">

    <label>Name</label><br>
    <input type="text" name="name"><br><br>

    <label>Email</label><br>
    <input type="email" name="email"><br><br>

    <label>Course</label><br>
    <input type="text" name="course"><br><br>

    <button type="submit" class="btn-add">Save</button>

</form>

@endsection
