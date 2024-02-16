@extends('template.main')

@section('title','Dashboard')

@section('content')
    <div class="row gap-20 masonry pos-r">
        <div class="masonry-sizer col-md-6"></div>

        <div class="masonry-item col-12">
            <div class="bd bgc-white">
                <div class="peers fxw-nw@lg+ ai-s">
                    <div class="peer peer-greed w-70p@lg+ w-100@lg- p-20">
                        <div class="layers">
                            <div class="layer w-100 mB-10">
                                <h6 class="lh-1">Site Visits</h6></div>
                            <div class="layer w-100">
                                <div id="stats"></div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>     
    </div>
@endsection