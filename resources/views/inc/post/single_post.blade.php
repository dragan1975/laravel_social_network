<div class="panel panel-default post">
      <div class="panel-body">
         <div class="row">
           <div class="col-sm-2">
             <a href="profile/{{ $post->user->id }}" class="post-avatar thumbnail"><img src="{{ str_replace('public','storage',asset($post->user->profile->imagePath)) }}" alt=""><div class="text-center">{{ $post->user->name }}</div></a>
             <div class="likes text-center">{{ $count = count($post->likes) }} {{ $count == 1 ? 'Like' : 'Likes' }}</div>
           </div>
           <div class="col-sm-10">
             <div class="bubble">
               <div class="pointer">
                 <p>{{ $post->body }}</p>
               </div>
               <div class="pointer-border"></div>
             </div>

              @if(Auth::check())
               @if(!$post->likes->pluck('user_id')->contains(auth()->id())) 
                <a href="/post/{{ $post->id }}/like">Like</a>
               @else
                <a href="/post/{{ $post->id }}/unlike">Unlike</a>
               @endif
              
               <div class="comment-form">
                 <form class="form-inline" method="POST" action="/post/{{ $post->id }}/comment">
                  {{csrf_field()}}
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder="enter comment" name="body">
                  </div>
                  <button type="submit" class="btn btn-default">Add</button>
                </form>
               </div>
             @else
               <p><span class="pull-right">{{ $post->created_at->diffForHumans() }}</span></p>
             @endif

             <div class="clearfix"></div>

             <div class="comments">
              @foreach($post->comments as $comment)
               <div class="comment">
                 <a href="#" class="comment-avatar pull-left"><img src="{{ str_replace('public', 'storage', asset($comment->user->profile->imagePath)) }}" alt=""></a>
                 <div class="comment-text">
                   <p>{{ $comment->body }}</p>
                   <span class="pull-right" style="color: #337ab7; font-style: italic; font-size: 0.9em;">{{ $comment->created_at->diffForHumans() }}</span>
                 </div>
               </div>
               <div class="clearfix"></div>
              @endforeach
             </div>

              @if(Auth::check())
               @if(count($post->comments) < 1)
                <p style="color: #337ab7; font-style: italic; font-size: 0.9em;">Be the first one to comment this post!</p>
               @endif
              @endif
           </div>
         </div>
      </div>
    </div>