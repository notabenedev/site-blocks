@if(isset($group) && isset($blocks))
    @includeIf("site-blocks::site.block-groups.templates.hero", ["group" => $group, "blocks" => $blocks])
@endif