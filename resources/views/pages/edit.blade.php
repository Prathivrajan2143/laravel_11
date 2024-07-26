@extends('layouts.app')

@section('content')

    <div class="container">

        <h3 align="center" class="mt-5">Edit User</h3>

        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">

            <div class="form-area">
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
              <form action="{{ route('post-edit-user', ['id' => $user->id ]) }}" method="POST">
              {!! csrf_field() !!}
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                  <label for="phone" class="form-label">Phone</label>
                  <input type="text" name="phone" class="form-control" value="{{ $user->phone }}" required>
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
        </div>
    </div>

@endsection

