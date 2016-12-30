@extends('layouts.app')

@section('content')

    @include('pages/_navbar')

    <header>
        <div class="header-content">
            <div class="header-content-inner">
                <h1>Demographic Data & Market Analysis Reports</h1>
                <hr>
                <p>ThreadPal creates market research reports around brands, companies, keywords and more.
                 </p>

                <div class="row">

                    <div class="col-md-8 col-md-offset-2">
                        <h2><div class="text-center">Enter a brand, company, or keyword:</div></h2>

                        {!! Form::open(['action' => 'KeywordsController@getAutocomplete']) !!}

                        <div class="form-group">

                            {!! Form::text('keyword', null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">

                            {!! Form::submit("Search", ['class' => 'btn btn-primary form-control']) !!}
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>

            </div>
        </div>
    </header>

    <section class="bg-primary" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">Example Report: "Stephen King"</h2>
                    <p class="text-faded">Get an audience breakdown for any brand or company.  Including Gender, Age, Income, Ethnicity, Education, Relationships, Sexuality, Home Ownership, Parenting, Politics, Mobile OS, Buyer Profile, Store Type, Travel, Entertainment, Fitness, Food & Drink, Sports</p>
                    <hr class="light">

                </div>
            </div>
            <embed width="100%" height="600px" src="{{url('/p/stephenking.pdf')}}" type="application/pdf"></embed>
        </div>
    </section>

    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">At Your Service</h2>
                    <hr class="primary">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-diamond wow bounceIn text-primary"></i>
                        <h3>Data</h3>
                        <p class="text-muted">All reports are for the U.S. only and represent the brand or keyword's engaged online audience.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-paper-plane wow bounceIn text-primary" data-wow-delay=".1s"></i>
                        <h3>Indexes</h3>
                        <p class="text-muted">Every report additionally shows how a your selected audience compares to the general U.S. public.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-newspaper-o wow bounceIn text-primary" data-wow-delay=".2s"></i>
                        <h3>Logistics</h3>
                        <p class="text-muted">Reports will be emailed to you within 24 hours of purchase.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-heart wow bounceIn text-primary" data-wow-delay=".3s"></i>
                        <h3>Custom Reports</h3>
                        <p class="text-muted">We can help with custom reports beyond our standard. Just ask :)</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
