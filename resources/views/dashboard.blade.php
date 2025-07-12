<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        {{-- Form Add Category --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <form action="{{ route('category.store') }}" method="POST">
                    @csrf
                    <h2>Add New Category</h2>
                    <div class="form-group mt-2">
                        <label>Name:</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter Category">
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Post</button>
                </form>
            </div>
        </div>

        {{-- Form Add Sub Category --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <form action="{{ route('sub_category.store') }}" method="POST">
                    @csrf
                    <h2>Add New Sub Category</h2>
                    <div class="form-group mt-2">
                        <label>Name:</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter Sub Category">
                    </div>
                    <div class="form-group mt-2">
                        <label>Category:</label>
                        <select name="category_id" class="form-control">
                            <option disabled selected>Select Category</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Post</button>
                </form>
            </div>
        </div>

        {{-- List Kategori dan SubKategori --}}
        @foreach ($categories as $category)
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-4">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <h4 class="font-semibold text-lg">{{ $category->name }}</h4>
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Sub Category</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach ($category->sub_category as $sub_category)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $sub_category->name }}</td>
                                    <td>
                                        <button class="btn btn-warning btn-sm" data-toggle="modal"
                                            data-target="#editModal{{ $sub_category->id }}">Edit</button>
                                        <button class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#deleteModal{{ $sub_category->id }}">Delete</button>
                                    </td>
                                </tr>

                                {{-- Edit Modal --}}
                                <div class="modal fade" id="editModal{{ $sub_category->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <form action="{{ route('sub_category.update', $sub_category->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Subcategory</h5>
                                                    <button type="button" class="close"
                                                        data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <label>Name:</label>
                                                    <input type="text" name="name"
                                                        value="{{ $sub_category->name }}" class="form-control">
                                                    <label class="mt-2">Category:</label>
                                                    <select name="category_id" class="form-control">
                                                        @foreach ($categories as $cat)
                                                            <option value="{{ $cat->id }}"
                                                                {{ $cat->id == $sub_category->category_id ? 'selected' : '' }}>
                                                                {{ $cat->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success">Update</button>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Cancel</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                {{-- Delete Modal --}}
                                <div class="modal fade" id="deleteModal{{ $sub_category->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <form action="{{ route('sub_category.destroy', $sub_category->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Confirm Delete</h5>
                                                    <button type="button" class="close"
                                                        data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete
                                                    <strong>{{ $sub_category->name }}</strong>?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Cancel</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
