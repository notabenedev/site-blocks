@if(isset($group) && isset($blocks))
    @includeIf("site-blocks::site.block-groups.templates.step", ["group" => $group, "blocks" => $blocks])
@endif