@extends('layouts.app')

@section('content')

    @include('pages/_navbar')


    <div class="container spark-screen reportcontainer">

            <div class="row">
                <div class="col-md-10 col-md-offset-1 text-center">
                    <h2>{{$keywordName}} Demographic Data and Market Analysis Report</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-4">
                    <h3>Contents:</h3>
                    <ul>
                        <li>Gender</li>
                        <li>Age</li>
                        <li>Income</li>
                        <li>Race</li>
                        <li>Education</li>
                        <li>Relationships</li>
                        <li>Sexuality</li>
                        <li>Home Ownership</li>
                        <li>Parenting</li>
                        <li>Politics</li>
                        <li>Mobile OS</li>
                        <li>Buyer Profile</li>
                        <li>Store Type</li>
                        <li>Travel Profile</li>
                        <li>Entertainment Profile</li>
                        <li>Fitness Profile</li>
                        <li>Food & Drink Profile</li>
                        <li>Sports Profile</li>


                    </ul>
                </div>
                <div class="col-md-6">
                    <h3>Price: $95</h3>
                    <button
                        class="snipcart-add-item btn-success btn-lg"
                        data-item-id="{{$id}}"
                        data-item-name="{{$keywordName}}"
                        data-item-price="95.00"
                        data-item-url="{{url($url)}}"
                        data-item-taxable="false"
                        data-item-shippable="false"
                        >
                        Add to Cart
                    </button>
                    <h3>About the Data:</h3>
                    <ul>
                        <li>This report is for the U.S. only</li>
                        <li>This report represents the brand or keyword's highly engaged online audience</li>
                        <li>In addition the report details how each content over or under indexes compared to the general U.S. populace</li>
                        <li>This report would be emailed to you within 24hrs of purchase</li>

                    </ul>

                    <h3>Free Example Reports:</h3>
                    <ul>
                        <li><a href="{{url('/p/uber.pdf')}}" target="_blank">Uber</a></li>
                        <li><a href="{{url('/p/lyft.pdf')}}" target="_blank">Lyft</a></li>
                        <li><a href="{{url('/p/stephenking.pdf')}}" target="_blank">Stephen King</a></li>
                        <li><a href="{{url('/p/goldmansachs.pdf')}}" target="_blank">Goldman Sachs</a></li>
                        <li><a href="{{url('/p/hbo.pdf')}}" target="_blank">HBO</a></li>
                    </ul>
                </div>

                <div class="col-md-1"></div>

            </div>

@endsection