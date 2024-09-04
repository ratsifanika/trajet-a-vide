@extends("layouts.app")

@section("content")
  <div class="container">
    <div class="row justify-content-center">
        <div class="col col-md-8">
            <div class="card">
                <div class="card-header">{{__("Login")}}</div>
                <div class="card-body">
                    <form class="form" method="POST" action="{{route('login')}}">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
  </div>
@endsection