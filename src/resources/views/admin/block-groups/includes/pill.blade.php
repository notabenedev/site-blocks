<li class="nav-item">
    <a href="{{ route("admin.blocks.groups.model", ["model" => $model, "model_id" => $modelId]) }}"
       class="nav-link{{ $currentRoute === "admin.blocks.groups.model" ? " active" : "" }}">
        Группы блоков
    </a>
</li>