<div class="row">
    @foreach($comments as $comment)
        <div class="col-md-12">
          {{ $comment->name }}:   {{ $comment->comment }}
            <form method="post" action="{{ route('comments.reply',[$post->id, $comment->id]) }}">
                @csrf
                <div class="form-group col-md-3">
                    <label>name</label>
                    <input type="text" name="name" class="form-control" />
                </div>
                <div class="form-group col-md-9">
                    <label>Comment</label>
                    <input type="text" name="comment" class="form-control" />
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-sm btn-outline-danger py-0" style="font-size: 0.8em;" value="Reply" />
                </div>
            </form>
            <div style="margin: 20px">
                @include('web.includes.comment', ['comments' => $comment->replies])
            </div>
        </div>
    @endforeach
</div>
