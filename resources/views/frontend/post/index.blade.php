  @extends('layouts.app')

  @section('content')
      <div class="container" style="display:flex; flex-wrap: wrap;">
          <div class="col-lg-6">
              <h2>Posts</h2>
          </div>
          <div class="col-lg-6 d-flex justify-content-end align-items-center">
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                  Create Post
              </button>
          </div>

          <hr>

          @foreach ($posts as $postItem)
              <div class="col-lg-4 mb-4">
                  <div class="card">
                      <img style="height:200px;width:200px" src="{{ $postItem->hasMedia('post_image') ? $postItem->getMedia('post_image')[0]->getFullUrl() : 'https://via.placeholder.com/350x200.png?text=No+Image' }}"
                           alt="Post Image" class="card-img-top">
                      <div class="card-body">
                          <h5 class="card-title">{{ $postItem->name }}</h5>
                          <p class="card-text">{{ Str::limit($postItem->description, 100) }}</p>
                      </div>
                      <div class="card-footer">
                          <small class="text-muted">
                              Posted on {{ $postItem->created_at->format('M d, Y') }} by {{ $postItem->user->name }}
                          </small>
                          <div class="mt-2">
                              @if (!$postItem->likeBy(auth()->user()))
                                  <form action="{{ route('likeStore', $postItem->id) }}" method="POST">
                                      @csrf
                                      <button type="submit" class="btn btn-outline-primary btn-sm">
                                          <i class="bi bi-hand-thumbs-up"></i> Like
                                      </button>
                                  </form>
                              @endif

                              @if ($postItem->like->count() > 0)
                                  <span class="badge bg-primary rounded-pill">
                                          {{ $postItem->like->count() }} {{ Str::plural('like', $postItem->like->count()) }}
                                      </span>
                              @endif

                              @if ($postItem->likeBy(auth()->user()))
                                  <form action="{{ route('likeDelete', $postItem->id) }}" method="POST">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="btn btn-outline-primary btn-sm">
                                          <i class="bi bi-hand-thumbs-down"></i> Unlike
                                      </button>
                                  </form>
                              @endif
                              <div class="comment-section">
                                <form action="{{ route('post.comment', $postItem->id) }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <textarea name="comment" id="comment" class="form-control" required placeholder="Add a comment"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Post</button>
                                </form>
                                {{-- <div class="comments">
                                    @foreach($postItem->comments as $comment)
                                        <div class="comment">
                                            <p>{{ $comment->comment }}</p>
                                            <p>By {{ $comment->user->name }}</p>
                                            @if($comment->parent_comment)
                                                <div class="child-comment">
                                                    <p>{{ $comment->parent_comment->body }}</p>
                                                    <p>By {{ $comment->parent_comment->user->name }}</p>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div> --}}
                            </div>

                </div>
        </div>
    </div>
    </div>
    @endforeach
    </div>
    </div>

    <!-- The Modal -->
    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Create Post</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-10">
                                    <label for="title">Post Title</label>
                                    <input type="text" name="title" id="title"
                                        class="form-control @error('title') is-invalid @enderror"
                                        value="{{ old('title') }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" required>{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                    <label for="category_id">Choose Category</label>
                                    <select name="category_id" id="category_id"
                                        class="form-control @error('category_id') is-invalid @enderror" required>
                                        <option value="">Choose Your Option</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                    <label for="image">Image Upload</label>
                                    <input type="file" name="image" id="image"
                                        class="form-control @error('image') is-invalid @enderror" required>
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                    <button type="submit" class="btn btn-primary btn-sm mt-3">Create Post</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('form').on('submit', function(event) {
                event.preventDefault();
                var comment = $('#comment').val();
                var postId = $(this).data('post-id');
                $.ajax({
                    type: 'POST',
                    url: '/home/comment/' + postId,
                    data: {comment: comment, _token: '{{ csrf_token() }}'},
                    success: function(data) {
                        $('#comment-section').prepend('<div class="comment">' +
                            '<p>' + comment + '</p>' +
                            '<p>By ' + data.user_name + '</p>' +
                            '</div>');
                        $('#comment').val('');
                        $('#message').html('Comment posted successfully.');
                    },
                    error: function(data) {
                        $('#message').html('Error posting comment.');
                    }
                });
            });
        });
        </script>

@endsection
