@extends('layouts.user.navbar')
@section('content')
    <div class="container">
        <h1>Offline Page</h1>

        <div class="search">
            <form method="">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search">
                    <div class="input-group-btn">
                        <button class="btn border border-2 border-start-0" type="submit">
                            <i class="bi bi-search text-dark"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>

    </div>
@endsection
