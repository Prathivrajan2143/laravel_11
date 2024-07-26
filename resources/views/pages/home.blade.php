@extends('layouts.app')

@section('content')

    <div class="container">

        <h3 align="center" class="mt-5">User Management</h3>

        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">

            <div class="form-area">
            <div class="card-body">
              @if(Session::has('error'))
              <div class="alert alert-danger" role="alert">
                {{ Session::get('error') }}
              </div>
              @endif
              @if(Session::has('success'))
              <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
              </div>
              @endif
              <form action="{{ route('add-user') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password-confirm">Confirm Password</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
                <div class="mb-3">
                  <label for="phone" class="form-label">Phone</label>
                  <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
                  @error('phone')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="mb-1">
                  <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </div>
              </form>
            </div>
            </div>

                <table class="table mt-5">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">User Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>

                    @foreach ( $users as $key => $user )
                        <tr>
                            <td scope="col">{{ ++$key }}</td>
                            <td scope="col">{{ $user->name }}</td>
                            <td scope="col">{{ $user->email }}</td>
                            <td scope="col">{{ $user->phone }}</td>
                            <td scope="col">
                      @php $id = base64_encode($user->id); @endphp
                            <a href="{{ route('edit-user', ['id' => $id]) }}">
                            <button class="btn btn-primary btn-sm">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                            </button>
                            </a>
                            <a href="{{ route('whatsapp', ['phone' => $user->phone]) }}">
                            <button class="btn btn-primary btn-sm">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Whatsapp Notification
                            </button>
                            </a>
                            <form action="{{ route('destroy-user', ['id' => $user->id]) }}" method="POST" style ="display:inline">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                            </td>

                          </tr>
                      @endforeach




                    </tbody>
                  </table>
            </div>
        </div>
    </div>

@endsection

