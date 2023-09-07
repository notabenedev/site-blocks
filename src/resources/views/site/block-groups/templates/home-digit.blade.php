@if(isset($group) && isset($blocks))
    @includeIf("site-blocks::site.block-groups.templates.digit", ["group" => $group, "blocks" => $blocks])
@endif