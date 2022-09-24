<x-dashboard-layout>

   <x-dashboard.heading>Comment</x-dashboard.heading>

   <div class="row">
      <div class="col-12 col-lg-8">
          <div class="card c-card">
              <div class="card-body">
                  <div class="comment-detail">
                     <div class="d-flex justify-content-between align-items-center">
                        <h2 class="h4">Comment Detail</h2>
                        <a href="{{ url()->previous() }}" class="btn btn-primary text-white fw-bold text-decoration-none"><i class="bi bi-chevron-left me-1"></i> Back</a>
                     </div>
                     <hr>  
                     <div class="mb-3">
                        <span class="fw-bold">Owner</span> <i class="bi-dash"></i> <span class="comment-detail__info">{{ $comment->user->name }}</span>
                     </div>
                     <div class="mb-3">
                        <span class="fw-bold">Created At</span> <i class="bi-dash"></i> <span>
                           
                           <span class="comment-detail__info"><i class="bi bi-calendar"></i> {{ $comment->created_at->format('d M Y') }}</span>
                     </span>
                     </div>
                     <div class="mb-3">
                        <span class="fw-bold">Post Id</span>
                        <i class="bi-dash"></i>
                        <span class="comment-detail__info">{{ $comment->post_id }}</span>
                     </div>
                     <div>
                        <p class="fw-bold mb-3">Comment</p>
                        <div class="p-3 rounded comment-detail__comment-container">
                           <p>{{ $comment->body }}</p>
                        </div>
                     </div>
                  </div>
              </div>
          </div>
      </div>
   </div>

</x-dashboard-layout>