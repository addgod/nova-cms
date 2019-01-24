<div class="border border-bottom-0 border-left-0 border-right-0">
    <div class="container-fluid">
        <div class="row">
            @foreach($block->columns as $block)
                @include('nova-cms::components.' . $block->component, ['block' => $block])
            @endforeach
        </div>
    </div>
</div>
