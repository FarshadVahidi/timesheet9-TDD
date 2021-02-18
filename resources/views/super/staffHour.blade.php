<h1>staff hour</h1>
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="page-header">
                    <h2>All Tasks</h2>
                </div>
                @foreach($staffsHour as $staff)
                    <div class="card">
                        <div class="card-header">{{$staff->id}}</div>

                        <div class="card-body">
                            {{$staff->sum}}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
