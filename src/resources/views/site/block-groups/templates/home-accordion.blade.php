@if(isset($group) && isset($blocks))
    @includeIf("site-blocks::site.block-groups.templates.accordion", ["group" => $group, "blocks" => $blocks])
@endif