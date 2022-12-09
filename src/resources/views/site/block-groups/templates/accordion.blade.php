@if(isset($group) && isset($blocks))
    <div class="accordion" id="accordionBlockGroup{{ $group->slug }}">
        @foreach ($blocks as $item)
            <div class="card">
                <div class="card-header" id="accordionBlockGroup{{ $group->slug }}Heading{{ $item->slug }}">
                    <h2 class="mb-0">
                        <a class="btn btn-link btn-block text-left{{ $loop->first ? "" : " collapsed" }}"
                                data-toggle="collapse"
                                data-target="#collapse{{ $item->slug }}"
                                aria-expanded="{{ $loop->first ? "true" : "false" }}"
                                aria-controls="collapse{{ $item->slug }}">
                            {{ $item->title }}
                        </a>
                    </h2>
                </div>

                <div id="collapse{{ $item->slug }}"
                     class="collapse{{ $loop->first ? " show" : "" }}"
                     aria-labelledby="accordionBlockGroup{{ $group->slug }}Heading{{ $item->slug }}"
                     data-parent="#accordionBlockGroup{{ $group->slug }}">
                    <div class="card-body">
                        <div class="float-md-right">
                            @if ($item->image)
                                @img([
                                "image" => $item->image,
                                "template" => "sm-grid-12",
                                "lightbox" => "blockGroup" . $item->slug,
                                "imgClass" => "img-fluid rounded mb-3 ml-md-3",
                                "grid" => [
                                "lg-grid-4" => 992,
                                "md-grid-6" => 768
                                ],
                                ])
                            @endif
                        </div>
                        {!! $item->description !!}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif