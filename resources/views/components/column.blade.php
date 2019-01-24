@foreach($block->column as $block)
    <div class="col-sm">
        @include('nova-cms::components.' . $block->component, ['block' => $block])
    </div>
@endforeach


