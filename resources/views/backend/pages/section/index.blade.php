@extends('backend.template.template')

@section('content')
    <!-- Page Content -->
<div class="container mt-4">
    <!-- Section Table -->
    <div class="mb-3">
        <h4>Sections</h4>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">Create New Section</button>
    </div>
    <!-- Table of Sections -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Position</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="sectionTableBody">
            <!-- Dynamic rows will be added here from JS -->
        </tbody>
    </table>
</div>


@endsection