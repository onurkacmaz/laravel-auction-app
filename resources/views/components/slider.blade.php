@php $sliderImages = json_decode($generalSettings['homepage_slider'], true) @endphp
@if(count($sliderImages) > 0)
    <div id="entry-slider">
        <div>
            @foreach($sliderImages as $key => $sliderImage)
                <div class="entry-slider entry-slider-{{$key}}">
                    <a href="#">
                        <div class="entry-slider-img">
                            <img
                                src="{{ $sliderImage }}"
                                alt=""/>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endif
