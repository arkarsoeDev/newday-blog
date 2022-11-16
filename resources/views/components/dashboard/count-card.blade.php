<a href="{{ $route }}" class="card count-card shadow border-left-primary h-100 py-2 text-decoration-none">
   <div class="card-body">
      <div class="row align-items-center mx-0 flex-nowrap">
         <div class="col-8 me-auto px-0">
               <span class="text-xs text-wrap fw-bold text-primary text-uppercase mb-1 d-block">{{ $title }}</span>
               <span class="h5 fw-bold text-gray-800">{{ $payload }}</span>
         </div>
         <div class="col-auto px-0">   
               <i class="bi {{ $icon }} fs-1"></i>
         </div>
      </div>
   </div>
</a>