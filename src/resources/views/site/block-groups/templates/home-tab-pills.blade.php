@if(isset($tabs))
    @includeIf("site-blocks::site.block-groups.templates.tab-pills", [ "tabs" => $tabs])
@endif