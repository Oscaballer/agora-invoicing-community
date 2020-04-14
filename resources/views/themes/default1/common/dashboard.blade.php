@extends('themes.default1.layouts.master')
@section('title')
Dashboard
@endsection
@section('content')
<style>
.scrollit {
    overflow:scroll;
    height:300px;
}
</style>
 {!! Form::open(['url'=>'my-profile,"status=$status' ,'method'=>'get']) !!}
   <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h4>Total Sales</h4>
              @if(($allowedCurrencies2) != null)
              <span>{{$allowedCurrencies2}}: &nbsp;  {{currency_format($totalSalesCurrency2,$code=$allowedCurrencies2)}}</span><br/>
              @endif
               <span>{{$allowedCurrencies1}}: &nbsp;  {{currency_format($totalSalesCurrency1,$code=$allowedCurrencies1)}} </span>
            </div>

            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
             <a href="{{url('invoices?status=success')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
            	<h4>Yearly Sales</h4>
                <?php
              $startingDateOfYear = (date('Y-01-01'));
              
              ?>
              @if(($allowedCurrencies2) != null)
              <span>{{$allowedCurrencies2}}:&nbsp;  {{currency_format($yearlySalesCurrency2,$code=$allowedCurrencies2)}}   </span><br/>
              @endif
               <span>{{$allowedCurrencies1}}:&nbsp; {{currency_format($yearlySalesCurrency1,$code=$allowedCurrencies1)}} </span>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
             <a href="{{url('invoices?status=success&from='.$startingDateOfYear)}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
             </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
            	<h4>Monthly Sales</h4>
               <?php
              $startMonthDate = date('Y-m-01');
              $endMonthDate = date('Y-m-t');
               ?>
               @if(($allowedCurrencies2) != null)
              <span>{{$allowedCurrencies2}}:&nbsp; {{currency_format($monthlySalesCurrency2,$code=$allowedCurrencies2)}}</span><br/>
              @endif
              <span>{{$allowedCurrencies1}}:&nbsp; {{currency_format($monthlySalesCurrency1,$code=$allowedCurrencies1)}}</span>
             
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{url('invoices?status=success&from='.$startMonthDate. '&till='.$endMonthDate)}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
             </div>
        </div>

         <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h4>Pending Payments</h4>
              @if(($allowedCurrencies2) != null)
              <span>{{$allowedCurrencies2}}: &nbsp;  {{currency_format($pendingPaymentCurrency2,$code=$allowedCurrencies2)}}</span><br/>
              @endif
               <span>{{$allowedCurrencies1}}: &nbsp; {{currency_format($pendingPaymentCurrency1,$code=$allowedCurrencies1)}} </span>
            </div>
            <div class="icon">
             <i class="ion ion-ios-cart-outline"></i>
            </div>
             <a href="{{url('invoices?status=pending')}}" class="small-box-footer">More info 
              <i class="fa fa-arrow-circle-right"></i></a>
             </div>
        </div>
</div>
 {!! Form::close() !!}



<div class="row">
      <div class="col-md-6">
              <!-- USERS LIST -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Total Users: <span><strong>{{$count_users}}</strong></span></h3><br/>
                  <h3 class="box-title">Recently Registered Users</h3><br/>
                   <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->


                   <?php
                   $mytime = Carbon\Carbon::now();
                   $yesterday = Carbon\Carbon::yesterday();
                   $productSold=[];
                  ?>
                <div class="box-body no-padding">
                  <div class="scrollit">
                  <ul class="users-list clearfix">
                    @foreach($users as $user)
                    <li>
                     <a class="users-list-name" href="{{url('clients/'.$user['id'])}}"> <img src="{{$user['profile_pic']}}" alt="User Image"></a>
                      <a class="users-list-name" href="{{url('clients/'.$user['id'])}}">{{$user['first_name']." ".$user['last_name']}}</a>
                       <?php $displayDate = new DateTime($user['created_at']) ;
                        ?>
                      @if ($displayDate < $mytime)
                      <span class="users-list-date">{{($displayDate)->format('M j')}}</span>
                      @elseif ($displayDate == $yesterday)
                       <span class="users-list-date">Yesterday</span>
                      @else
                      <span class="users-list-date">Today</span>
                      @endif
                    </li>
                    @endforeach
                   </ul>
                 </div>

                  <!-- /.users-list -->
                </div>

                <!-- /.box-body -->
                 <div class="box-footer clearfix">
              <a href="{{url('clients')}}" class="btn btn-sm btn-info btn-flat pull-left">View All Users</a>
              <a href="{{url('clients/create')}}" class="btn btn-sm btn-default btn-flat pull-right">Create New User</a>
            </div>
              
                <!-- /.box-footer -->
              </div>
              <!--/.box -->
            </div>

             <div class="col-md-6">
             	         <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"> Products Sold  (Last 30 Days)</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                
              </div>
            </div>
            <!-- /.box-header -->
           <div class="box-body">
              <div class="scrollit">

                  @if(!count($productSoldInLast30Days))
                      <tr>
                          <td><p class="text-center">No records found</p></td>
                      </tr>
                  @else
                  <ul class="products-list product-list-in-box">
                   @foreach($productSoldInLast30Days as $element)
                        <li class="item">
                          <div class="product-img">
                            <img src="{{$element->product_image}}" alt="Product Image">
                          </div>
                          <div class="product-info">
                         <a href="#" class="product-title">{{$element->product_name}}<strong> &nbsp; &nbsp;  <td><span class="label label-success">{{$element->order_count}}</span></td></strong>
                            </a>
                               <span class="product-description">
                                <strong> Last Purchase: </strong>
                                  {{$element->order_created_at}}
                                </span>

                          </div>
                        </li>
                          @endforeach
                      </ul>
                  @endif
            </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <a href="{{url('products')}}" class="btn btn-sm btn-info btn-flat pull-left">View All Products</a>
              <a href="{{url('products/create')}}" class="btn btn-sm btn-default btn-flat pull-right">Create New Product</a>
            </div>
            
            <!-- /.box-footer -->
          </div>
             </div>
         </div>


         <div class="row">
         	<div class="col-md-6">
         	  <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Recent Paid Orders (Last 30 Days)</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <div class="scrollit">

                    @if(!count($recentOrders))
                        <tr>
                            <td><p class="text-center">No records found</p></td>
                        </tr>
                    @else
                    <table class="table no-margin">
                      <thead>
                      <tr>
                        <th>Order No</th>
                        <th>Item</th>
                        <th>Date</th>
                        <th>Client</th>
                        <!-- <th>Total</th> -->
                      </tr>
                      </thead>
                      <tbody>
                        @foreach($recentOrders as $element)
                       <tr>
                        <td><a href="{{url('orders/'.$element->order_id)}}">{{$element->order_number}}</a></td>
                        <td>{{$element->product_name}}</td>
                        <td>{{$element->order_created_at}}</td>
                        <td><a href="{{$element->client_profile_link}}" target="_blank" class="sparkbar" data-color="#00a65a" data-height="20">{{$element->client_name}}</a></td>
                      </tr>
                       @endforeach
                       </tbody>
                    </table>
                    @endif
              </div>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
           
              <a href="{{url('orders')}}" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
               <a href="{{url('invoice/generate')}}" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
            </div>
              
           
            <!-- /.box-footer -->
            </div>
          </div>

         	<div class="col-md-6">
         	   <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Paid Orders Expiring Soon (Next 30 Days)</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                 <div class="scrollit">

                 @if(!count($subscriptions))
                     <tr>
                         <td><p class="text-center">No records found</p></td>
                     </tr>
                 @else
                     <table class="table no-margin">
                      <thead>
                      <tr>
                        <th>User</th>
                        <th>Order No</th>
                        <th>Expiry</th>
                        <th>Days Left</th>
                        <th>Product</th>
                       </tr>
                      </thead>


                      <tbody>

                      @foreach($subscriptions as $element)

                      <tr>
                        <td><a href="{{$element->client_profile_link}}">{{ $element->client_name }}</a></td>
                        <td><a href="{{$element->order_link}}">{{$element->order_number}}</a></td>
                        <td>{{$element->subscription_ends_at}}</td>
                        <td>{{$element->remaining_days}}</td>
                         <td>{{$element->product_name}}</td>
                      </tr>
                      @endforeach
                      </tbody>
                    </table>
                 @endif
              </div>
              </div>
              <!-- /.table-responsive -->
            </div>
             <div class="box-footer clearfix">
           
              <a href="{{url('orders?expiry='.$startSubscriptionDate.'&expiryTill='.$endSubscriptionDate.'&p_un=paid')}}" class="btn btn-sm btn-default btn-flat pull-right">View Orders Expiring Soon</a>
              <!-- <a href="{{url('orders?expiryTill='.$endSubscriptionDate)}}" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a> -->
               <a href="{{url('invoice/generate')}}" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
            </div>
              
            <!-- /.box-body -->

            <!-- /.box-footer -->
            </div>
          </div>
         </div>

         <div class= row>
          <div class="col-md-6">
            <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Recent Invoices(Past 30 Days)</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                 <div class="scrollit">

                 @if(!count($invoices))
                     <tr>
                         <td><p class="text-center">No records found</p></td>
                     </tr>
                 @else
                     <table class="table no-margin">
                      <thead>
                      <tr>
                        <th>Invoice No.</th>
                        <th>Total</th>
                        <th>Client</th>
                        <th>Paid </th>
                        <th>Balance</th>
                        <th>Status</th>
                      </tr>
                      </thead>
                      <tbody>
                        @foreach($invoices as $element)
                      <tr>
                        <td><a href="{{url('invoices/show?invoiceid='.$element->invoice_id)}}">{{$element->invoice_number}}</a></td>

                        <td>{{$element->grand_total}}</td>
                         <td>{{$element->client_name}}</td>
                        <td>{{$element->paid}}  </td>
                        <td>
                          <div class="sparkbar" data-color="#00a65a" data-height="20">{{$element->balance}}</div>
                        </td>
                       @if ($element->status == 'Success')
                        <td><span class="label label-success">{{$element->status}}</span></td>
                       @elseif ($element->status == 'Pending')
                        <td><span class="label label-danger">{{$element->status}}</span></td>
                       @endif

                      </tr>
                        @endforeach
                      </tbody>
                    </table>
                 @endif
              </div>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <a href="{{url('invoices')}}" class="btn btn-sm btn-info btn-flat pull-left">View All Invoice</a>
              <a href="{{url('invoice/generate')}}" class="btn btn-sm btn-default btn-flat pull-right">Generate New Invoice</a>
            </div>
            <!-- /.box-footer -->
          </div>
        </div>
             
             <div class="col-md-6">
             <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Total Sold Products</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="scrollit">
                  @if(!count($allSoldProducts))
                      <tr>
                          <td><p class="text-center">No records found</p></td>
                      </tr>
                  @else

                  <ul class="products-list product-list-in-box">
                     @foreach($allSoldProducts as $element)
                          <li class="item">
                              <div class="product-img">
                                  <img src="{{$element->product_image}}" alt="Product Image">
                              </div>
                              <div class="product-info">
                                  <a href="#" class="product-title">{{$element->product_name}}<strong> &nbsp; &nbsp;  <td><span class="label label-success">{{$element->order_count}}</span></td></strong>
                                  </a>
                                  <span class="product-description">
                                <strong> Last Purchase: </strong>
                                  {{$element->order_created_at}}
                                </span>
                              </div>
                          </li>
                      @endforeach
                    </ul>
                  @endif
            </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <a href="{{url('products')}}" class="btn btn-sm btn-info btn-flat pull-left">View All Products</a>
              <a href="{{url('products/create')}}" class="btn btn-sm btn-default btn-flat pull-right">Create New Product</a>
            </div>
            <!-- /.box-footer -->
          </div>
        </div>
         </div>
@stop