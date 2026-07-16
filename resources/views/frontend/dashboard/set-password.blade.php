@extends('layouts.home')
@section('title', 'Set your password')
@section('main')

<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ url('/') }}" rel="nofollow">Home</a>
                <span></span> Set your password
            </div>
        </div>
    </div>

    <section class="mt-50 mb-50">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="border p-4 border-radius">
                        <div class="heading_s1 mb-3">
                            <h4>Set your password</h4>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="post" action="{{ route('customer.password.update') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control"
                                    value="{{ old('email', $email) }}" required readonly>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="password">New password</label>
                                <input type="password" id="password" name="password" class="form-control" required
                                    autocomplete="new-password">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="password_confirmation">Confirm password</label>
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    class="form-control" required autocomplete="new-password">
                            </div>
                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-fill-out">Save password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
