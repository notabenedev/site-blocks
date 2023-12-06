@if(isset($group) && isset($blocks))
    @includeIf("site-blocks::site.block-groups.templates.alert", ["group" => $group, "blocks" => $blocks])
@endif