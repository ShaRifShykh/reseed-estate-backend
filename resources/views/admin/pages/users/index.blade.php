@extends("admin.layout.main")
@section("title", "Users - ")

@section("main-section")
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="col-12 card">
            <div class="table-responsive text-nowrap">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Joined on</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $key => $user)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $user->full_name }}</td>
                            <td>{{ $user->username ?? '-' }}</td>
                            <td>{{ $user->phone_number }}</td>
                            <td>{{ $user->email }}</td>
                            <td><span>{{ $user->created_at->format('M, d Y') }}</span></td>
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
