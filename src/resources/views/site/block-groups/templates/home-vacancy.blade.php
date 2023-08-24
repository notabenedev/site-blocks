@if(isset($group) && isset($blocks))
    @includeIf("site-blocks::site.block-groups.templates.vacancy", ["group" => $group, "blocks" => $blocks])
@endif