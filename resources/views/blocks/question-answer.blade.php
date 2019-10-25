<section class="question-answer">
    @foreach ($page->collection('QA') as $item)
        <div class="question">{{ $item->question }}
            <div class="answer">{!! $item->answer !!}</div>
        </div>
    @endforeach
</section>
