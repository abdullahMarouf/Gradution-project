@extends('dashboard.parent')
@section('content')
    <form action="{{URL::current()}}" method="get" class="d-flex justify-content-between mb-3">
        <input type="text" name="search" id="" placeholder="name" class="form-control mx-2">
        <select name="status" class="form-control mx-2">
            <option value="">All</option>
            <option value="active">active</option>
            <option value="archived">archived</option>
        </select>
        <button class="btn btn-sm btn-outline-dark">Filter</button>
    </form>
    <table class="table">
        <thead>
            <a href="{{ route('categories.index') }}" class="btn btn-outline-info btn-sm ml-4 mb-3">back</a>
            <tr>
                <th>image</th>
                <th>id</th>
                <th>name</th>
                <th>status</th>
                <th>deleted_at</th>
                <th>status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
                <tr>
                    <td><img src="{{ asset('storage/' . $category->image) }}" width="50" height="50" alt=""> </td>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $category->name }}</td>
                    <td></td>
                    <td>{{ $category->status }}</td>
                    <td>{{ $category->deleted_at }}</td>
                    <td>
                        <form action="{{ route('categories.restore', $category->id) }}" method="post">
                            @csrf
                            @method('put')
                            <button type="submit" class="btn btn-outline-info btn-sm mt-2">restore</button>

                        </form>
                        <span>
                            <form action="{{ route('categories.force-delete', $category->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-outline-danger btn-sm mt-2">Delete</button>

                            </form>
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No Categories found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $categories->withQueryString()->appends(['search'=>1])->links() }}
@endsection
