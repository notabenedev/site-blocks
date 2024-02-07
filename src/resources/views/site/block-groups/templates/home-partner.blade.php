@if(isset($group) && isset($blocks))
    @includeIf("site-blocks::site.block-groups.templates.partner", ["group" => $group, "blocks" => $blocks])
@endif