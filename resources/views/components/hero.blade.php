<div class="jumbotron jumbotron-fluid">
    <div class="container">
        {!! Illuminate\Mail\Markdown::parse($block->content) !!}
    </div>
</div>
