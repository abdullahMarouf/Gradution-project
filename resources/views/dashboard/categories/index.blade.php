@extends('dashboard.parent')
@section('content')
    <form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-3">
        <input type="text" name="search" id="" placeholder="name" class="form-control mx-2">
        <select name="status" class="form-control mx-2">
            <option value="">All</option>
            <option value="active">active</option>
            <option value="archived">archived</option>
        </select>
    </form>
    <div class="my-5">
        <table class="table table-rounded table-striped border gy-7 gs-7" id="products">
            <div class="col-xl-12">
                <!--begin::Tables Widget 9-->
                <div class="card card-xl-stretch mb-5 mb-xl-8">
                    <!--begin::Header-->
                    <div class="card-header border-0 pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bolder fs-3 mb-1">Category List </span>
                            {{--                        <span class="text-muted mt-1 fw-bold fs-7">Over</span>--}}
                        </h3>
                        <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="" data-bs-original-title="Click to add a product">
                            <a href="{{ route('categories.create')}}" class="btn btn-sm btn-light btn-active-primary" >
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                <span class="svg-icon svg-icon-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black"></rect>
                        <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black"></rect>
                    </svg>
                </span>
                                <!--end::Svg Icon-->New Product</a>
                        </div>
                        <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="" data-bs-original-title="Click to show the trash">
                            <a href="{{ route('categories.trash')}}" class="btn btn-sm btn-light btn-active-danger" >
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                <span class="svg-icon svg-icon-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black"></rect>
                        <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black"></rect>
                    </svg>
                </span>
                                <!--end::Svg Icon-->Trash</a>
                        </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body py-3">
                        <!--begin::Table container-->
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                <!--begin::Table head-->
                                <thead>
                                              <tr class="fw-bolder text-muted">
                                                    <th class="w-25px">
                                                          <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox" value="1" data-kt-check="true"
                                                                                                                 data-kt-check-target=".widget-9-check">
                                                              </div>
                                                        </th>
                                                    <th class="min-w-100px">image </th>
                                                    <th class="min-w-100px">Name </th>
                                                    <th class="min-w-150px"> products count</th>
                                                    <th class="min-w-150px">description</th>
                                                    <th class="min-w-150px">status</th>
{{--                                                    <th class="min-w-150px">created_at</th>--}}
                                                    <th class="min-w-150px">Actions</th>
                                                  </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody>
                                @foreach ( $categories as $category )
                                    <tr>
                                        <td>
                                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                <input class="form-check-input widget-9-check" type="checkbox" value="1">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="symbol symbol-45px me-5">
                                                    <img src="{{ asset('storage/' . $category->image)}}" alt="">
                                                </div>
                                                <div class="d-flex justify-content-start flex-column">
                                                    <a href="{{route('products.show',$category->id)}}" class="text-dark fw-bolder text-hover-primary fs-6">{{$category->name}}</a>
                                                    {{-- <span class="text-muted fw-bold text-muted d-block fs-7">HTML, JS, ReactJS</span> --}}
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#" class="text-dark fw-bolder text-hover-primary d-block fs-6">{{ $category->id}}</a>
                                        </td>

                                        <td>
                                            <a href="#" class="text-dark fw-bolder text-hover-primary d-block fs-6">{{ $category->description }}</a>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-start flex-column">
                                                <a href="#" class="text-dark fw-bolder text-hover-primary fs-6">{{ $category->status }}</a>
                                                {{-- <span class="text-muted fw-bold text-muted d-block fs-7">HTML, JS, ReactJS</span> --}}
                                            </div>
                        </div>
                        </td>
                        <td>
                            {{-- <div class="d-flex justify-content-start flex-column">
                                    <a href="#" class="text-dark fw-bolder text-hover-primary fs-6">{{ $category->created_at }}</a>
                                    {{-- <span class="text-muted fw-bold text-muted d-block fs-7">HTML, JS, ReactJS</span> --}}
                            {{-- </div>
                        </div> --}}
                        </td>
                        <td class=" d-flex gap-2">
                            <a class="btn btn-outline-info" href="{{ route('categories.edit', $category->id) }}">Edit</a>
                            <form action="{{ route('categories.destroy', $category->id) }}"
                                  method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-outline-danger">Delete</button>
                            </form>
                        </td>
                        </tr>
                        </tr>
                        @endforeach
                        </tbody>

                        <!--end::Table body-->
        </table>
        {{$categories->links()}}

        <!--end::Table-->
    </div>
    <!--end::Table container-->
    </div>
    <!--begin::Body-->
    </div>
    <!--end::Tables Widget 9-->
    </div>
@endsection
|
