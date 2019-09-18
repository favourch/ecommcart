<div id="ei-slider" class="ei-slider">
    <ul class="ei-slider-large">
        @foreach($sliders as $slider)
            <li>
                <a href="{{ $slider['link'] }}">
                    <img src="{{ get_storage_file_url($slider['featured_image']['path'], 'main_slider') }}" alt="{{ $slider['title'] ?? 'Slider Image ' . $loop->count }}">
                </a>
                <div class="ei-title">
                    <h2>{{ $slider['title'] }}</h2>
                    <h3>{{ $slider['sub_title'] }}</h3>
                </div>
            </li>
        @endforeach
    </ul><!-- ei-slider-large -->

    <ul class="ei-slider-thumbs">
        <li class="ei-slider-element">Current</li>
        @foreach($sliders as $slider)
            <li>
                <a href="#">Slide {{ $loop->count }}</a>
                <img src="{{ isset($slider['images'][0]['path']) ?
                    get_storage_file_url($slider['images'][0]['path'], 'slider_thumb') :
                    get_storage_file_url($slider['featured_image']['path'], 'slider_thumb') }}" alt="thumbnail {{ $loop->count }}"
                />
            </li>
        @endforeach
    </ul>
</div><!-- /.ei-slider-->