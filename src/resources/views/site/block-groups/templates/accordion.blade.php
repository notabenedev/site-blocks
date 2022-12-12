@if(isset($group) && isset($blocks))
    <div class="accordion blocks-accrordion" id="accordionBlockGroup{{ $group->slug }}">
        @foreach ($blocks as $item)
            <div class="card blocks-accrordion__card">
                <div class="card-header blocks-accrordion__card-header" id="accordionBlockGroup{{ $group->slug }}Heading{{ $item->slug }}">
                    <h2 class="mb-0 blocks-accrordion__card-h2">
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
                     class="collapse blocks-accrordion__collapse{{ $loop->first ? " show" : "" }}"
                     aria-labelledby="accordionBlockGroup{{ $group->slug }}Heading{{ $item->slug }}"
                     data-parent="#accordionBlockGroup{{ $group->slug }}">
                    <div class="card-body blocks-accrordion__card-body">
                        <div class="float-md-right">
                            @if ($item->image)
                                @img([
                                "image" => $item->image,
                                "template" => "sm-grid-12",
                                "lightbox" => "blockGroup" . $item->slug,
                                "imgClass" => "img-fluid rounded mb-3 ml-md-3 blocks-accrordion__img",
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