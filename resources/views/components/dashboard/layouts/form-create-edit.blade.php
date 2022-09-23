<div class="row">
   <div class="col-12 col-lg-8">
       <div class="card c-card">
           <div class="card-body">
               <h2 class="h4">{{ $title }} {{ $control ?? "Create" }}</h2>
               <hr>
               {{ $slot }}
           </div>
       </div>
   </div>
</div>