@extends('layouts.master')

@section('content')

<h2>Student List</h2>

<a href="index.php?page=create" class="btn-add">Add New Student</a>

<table>
    <tr>
        <th>ID</th><th>Name</th><th>Email</th><th>Course</th><th>Actions</th>
    </tr>

    @foreach($students as $s)
        <tr>
            <td>{{ $s['id'] }}</td>
            <td>{{ $s['name'] }}</td>
            <td>{{ $s['email'] }}</td>
            <td>{{ $s['course'] }}</td>
            <td>
                <a href="index.php?page=edit&id={{ $s['id'] }}" class="btn-edit">Edit</a>
                <a href="index.php?page=delete&id={{ $s['id'] }}" class="btn-delete">Delete</a>
            </td>
        </tr>
    @endforeach

</table>

@endsection
