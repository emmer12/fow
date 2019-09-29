@extends("layouts.app")
{{-- elevation worship backgreund:#eeeeef --}}

@section("content")
  @include('inc/drawer-admin')
  <br>
   <div class="container">
     <div class="row">
       <div class="col-md-3">
       </div>
       <div class="col-md-9">
         <div class="pull-right">
           <button type="button" class="btn btn-default"><a href="{{route('admin.notification')}}"> Notifications <span class="label label-pill label-success">1</span> </a></button>
         </div>
         <hr>
         <div class="container">
         </div>
         <!-- /.row -->
         <div class="row">
             <div class="col-lg-3 col-md-6">
                 <div class="panel panel-primary">
                     <div class="panel-heading">
                         <div class="row">
                             <div class="col-xs-3">
                                 <i class="glyphicon glyphicon-plus glyphicon-5x"></i>
                             </div>
                             <div class="col-xs-9 text-right">
                                 <div class="huge">{{ count($products)}}</div>
                                 <div>New Products!</div>
                             </div>
                         </div>
                     </div>
                     <a href="{{route("admin.dashboard.product")}}">
                         <div class="panel-footer">
                             <span class="pull-left">View Details</span>
                             <span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>
                             <div class="clearfix"></div>
                         </div>
                     </a>
                 </div>
             </div>
             <div class="col-lg-3 col-md-6">
                 <div class="panel panel-green">
                     <div class="panel-heading">
                         <div class="row">
                             <div class="col-xs-3">
                                 <i class="glyphicon glyphicon-book glyphicon-5x"></i>
                             </div>
                             <div class="col-xs-9 text-right">
                                 <div class="huge">{{ count($podcast)}}</div>
                                 <div>Podcast!</div>
                             </div>
                         </div>
                     </div>
                     <a href="{{route("admin.dashboard.podcast")}}">
                         <div class="panel-footer">
                             <span class="pull-left">View Details</span>
                             <span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>
                             <div class="clearfix"></div>
                         </div>
                     </a>
                 </div>
             </div>
             <div class="col-lg-3 col-md-6">
                 <div class="panel panel-yellow">
                     <div class="panel-heading">
                         <div class="row">
                             <div class="col-xs-3">
                                 <i class="glyphicon glyphicon-shopping-cart glyphicon-5x"></i>
                             </div>
                             <div class="col-xs-9 text-right">
                                 <div class="huge">124</div>
                                 <div>New Orders!</div>
                             </div>
                         </div>
                     </div>
                     <a href="#">
                         <div class="panel-footer">
                             <span class="pull-left">View Details</span>
                             <span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>
                             <div class="clearfix"></div>
                         </div>
                     </a>
                 </div>
             </div>
             <div class="col-lg-3 col-md-6">
                 <div class="panel panel-red">
                     <div class="panel-heading">
                         <div class="row">
                             <div class="col-xs-3">
                                 <i class="glyphicon glyphicon-music glyphicon-5x"></i>
                             </div>
                             <div class="col-xs-9 text-right">
                                 <div class="huge">{{ count($audio)}}</div>
                                 <div>Audio!</div>
                             </div>
                         </div>
                     </div>
                     <a href="{{route("admin.dashboard.audio")}}">
                         <div class="panel-footer">
                             <span class="pull-left">View Details</span>
                             <span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>
                             <div class="clearfix"></div>
                         </div>
                     </a>
                 </div>
             </div>
         </div>
         <!-- /.row -->

         <hr>
         <div class="row">
           <div class="col-md-6">
             <h4 class="heading">Google Analitics</h4 >
           </div>
           <div class="col-md-6">
             <h4 class="heading">Last Two Orders</h4>
           </div>
         </div>
         </div>
         </div>



       </div>
     </div>
   </div>
@endsection("content")
