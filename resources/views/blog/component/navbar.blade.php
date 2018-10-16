<nav class="navbar navbar-light p-0">
    {{-- navbar untuk logo dengna membagi 4 col medium --}}
   <div class="col-md-4">
   <a class="navbar-brand" href="#">
        <img src="/img/blog/navbar.png" alt="">
    </a>
   </div>
   {{-- navbar untuk pertenghan seacrh 4 colom medium  --}}
   <div class="col-md-4">
       <div class="row border-light">
           <div class="input-group">
               <input type="text" name="name" id="name" class="form-control" placeholder="Pencarian Produk..." aria-describedby="prefixId">
               <button class="btn-primary" id="prefixId"><i class="nav-icon fa fa-search fa-1x" aria-hidden="true"></i></button>
           </div>    
       </div>      
   </div>  
   {{-- nav bar untuk di paling pojok dengna membagi 4 colom dan mengset offet sebagai titik mulaii nav link --}}
   <div class="col-md-4 ">
       <div class="row">
               <div class="col-12 offset-md-4">
                     <ul class="nav nav-pills">
                             <li class="nav-item">
                                 <a href="#" class="nav-link text-center"><i class="nav-icon fa fa-calendar-plus " aria-hidden="true"></i><br><span>Event</span></a>
                             </li>
                             <li class="nav-item">
                                 <a href="#" class="nav-link text-center"><i class="nav-icon fa fa-store " aria-hidden="true"></i><br><span>Market</span></a>
                             </li>
                             <li class="nav-item">
                                 <a href="#" class="nav-link text-center"><i class="nav-icon fa fa-id-card " aria-hidden="true"></i><br><span>Voucher</span></a>
                             </li>
                         </ul>
               </div>
       </div>
   </div>    
   </div>
</nav>