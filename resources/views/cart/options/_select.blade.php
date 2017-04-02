<ul class="list-group-item">
    <strong>{{ $mod->name }}</strong><br>
    @foreach($mod->options as $option)
        <span class="text-info">{{ $option->name }}</span><br>
    @endforeach
</ul>