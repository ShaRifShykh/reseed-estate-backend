@extends("admin.layout.main")
@section("title", "Posts - ")

@section("main-section")
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="col-12 card">
            <div class="table-responsive text-nowrap">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Location</th>
                        <th>Created By</th>
                        <th>Created on</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($posts as $key => $post)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($post->description, 50) }}</td>
                            <td>{{ $post->price }}</td>
                            <td>{{ $post->location }}</td>
                            <td>
                                <a href="#">
                                    {{ $post->createdBy->full_name }}
                                </a>
                            </td>
                            <td><span>{{ $post->created_at->format('M, d Y') }}</span></td>
                            <td>
                                <a href="#">View</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
{{--            <div class="card-footer" style="display: flex; justify-content: space-between;">--}}
{{--                <div>--}}
{{--                    {{ $businesses->links() }}--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>

@endsection
