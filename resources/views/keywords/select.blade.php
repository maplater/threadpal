@extends('layouts.app')

@section('content')

    @include('pages/_navbar')
    <div class="container spark-screen reportcontainer">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Please select the correct one</div>

                    <div class="panel-body">

                        <ul>
                            @foreach($autocomplete as $keyword)
                            <li>
                                <a href="{{url($keyword['url'])}}">{{$keyword['name'] }} - Includes {{$keyword['reach']}} People</a>
                            </li>
                            @endforeach
                        </ul>


                        @include('errors.list')

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
