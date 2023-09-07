@if(isset($group) && isset($blocks))
    @includeIf("site-blocks::site.block-groups.templates.benefit", ["group" => $group, "blocks" => $blocks])
@endif