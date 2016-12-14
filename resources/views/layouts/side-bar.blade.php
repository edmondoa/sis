
<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
  <!-- Sidebar user panel -->
  <div class="user-panel">
    <div class="pull-left image">
      <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
      <p>{{Auth::user()->firstname.' '.Auth::user()->lastname}}</p>
      <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
    </div>
  </div>
  <!-- search form -->
  <form action="#" method="get" class="sidebar-form">
    <div class="input-group">
      <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
            </button>
          </span>
    </div>
  </form>
  <!-- /.search form -->
  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu">
    <li class="header">MAIN NAVIGATION</li>
    
    <li class="treeview">
      <a href="#">
        <i class="fa fa-dashboard"></i> <span>Account</span>  
        <span class="pull-right-container">
           <i  class="fa fa-angle-left pull-right"></i>
        </span>      
      </a> 
      <ul class="treeview-menu">
        <li><a href="/"><i class="fa fa-circle-o"></i>Invoice</a></li>
        <li><a href="/"><i class="fa fa-circle-o"></i>Invoice Return</a></li>
        <li><a href="/"><i class="fa fa-circle-o"></i>Consign</a></li>
        <li><a href="/"><i class="fa fa-circle-o"></i>Consign Return</a></li>
        <li class='treeview'>
          <a href="#"><i class="fa fa-circle-o"></i>Credit Line
            <span class="pull-right-container">
                 <i  class="fa fa-angle-left pull-right"></i>
              </span> 
          </a>
          <ul class="treeview-menu">
             <li><a href="/"><i class="fa fa-circle-o"></i>Credit Request</a></li>
             <li><a href="/"><i class="fa fa-circle-o"></i>Manual Credit</a></li>
             <li class='treeview'><a href="/"><i class="fa fa-circle-o"></i>Bond
              <span class="pull-right-container">
                 <i  class="fa fa-angle-left pull-right"></i>
              </span> </a>
                <ul  class="treeview-menu">
                  <li><a href="/"><i class="fa fa-circle-o"></i>Deposit</a></li>
                  <li><a href="/"><i class="fa fa-circle-o"></i>Widraw</a></li>
                </ul>
             </li>
          </ul>
        </li>
        
      </ul>     
    </li>
    <li class="treeview">
      <a href="#">
        <i class="fa fa-dashboard"></i> <span>Financial</span>  
        <span class="pull-right-container">
           <i  class="fa fa-angle-left pull-right"></i>
        </span>      
      </a> 
      <ul class="treeview-menu">        
        <li class='treeview'>
          <a href="#"><i class="fa fa-circle-o"></i>Non ARPayment
            <span class="pull-right-container">
                 <i  class="fa fa-angle-left pull-right"></i>
              </span> 
          </a>
          <ul class="treeview-menu">
            <li><a href="/"><i class="fa fa-circle-o"></i>In</a></li>
            <li><a href="/"><i class="fa fa-circle-o"></i>Out</a></li>
          </ul>
        </li>
        <li class='treeview'>
          <a href="#"><i class="fa fa-circle-o"></i>Memo
            <span class="pull-right-container">
                 <i  class="fa fa-angle-left pull-right"></i>
              </span> 
          </a>
          <ul class="treeview-menu">
            <li><a href="/"><i class="fa fa-circle-o"></i>CM</a></li>
            <li><a href="/"><i class="fa fa-circle-o"></i>DM</a></li>
          </ul>
        </li>
        <li class='treeview'>
          <a href="#"><i class="fa fa-circle-o"></i>Collection Panel
            <span class="pull-right-container">
                 <i  class="fa fa-angle-left pull-right"></i>
              </span> 
          </a>
          <ul class="treeview-menu">
            <li><a href="/"><i class="fa fa-circle-o"></i>Cash TurnIn</a></li>
            <li><a href="/"><i class="fa fa-circle-o"></i>Balancing/Bank Deposit</a></li>
          </ul>
        </li>
      </ul>     
    </li>
    <!-- Financial -->
    <li class="treeview main-products">
      <a href="#">
        <i class="fa fa-laptop"></i>
        <span>Product</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li class='treeview'>
          <a href="#"><i class="fa fa-circle-o"></i>Product
            <span class="pull-right-container">
                 <i  class="fa fa-angle-left pull-right"></i>
              </span> 
          </a>
          <ul class="treeview-menu">
            <li><a href="/"><i class="fa fa-circle-o"></i>Customer Order</a></li>
            <li><a href="/"><i class="fa fa-circle-o"></i>Consolidated</a></li>
          </ul>
        </li>
        <li class="stockin"><a href="/stockin"><i class="fa fa-circle-o"></i> Stockin (Regular/Reject)</a></li>
        <li><a href="/stockout"><i class="fa fa-circle-o"></i> Stockout</a></li>
        <li><a href="/"><i class="fa fa-circle-o"></i>Transfer (Branch to Branch)</a></li>
        <li><a href="/"><i class="fa fa-circle-o"></i> Damage (Expense)</a></li>
        <li><a href="/"><i class="fa fa-circle-o"></i> Daily Cycle Count</a></li>
      </ul> 
    </li>
    <!-- Product -->
    <li class="treeview record-management">
      <a href="#">
        <i class="fa fa-laptop"></i>
        <span>Record Management</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li class="treeview customer">
            <a href="/">
              <i class="fa fa-circle-o"></i>
              <spa>Customer</spa>
              <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="account"><a href="/"><i class="fa fa-circle-o"></i> Account</a></li>
              <li class="discounting"><a href="/discounting"><i class="fa fa-circle-o"></i> Discounting Table</a></li>
            </ul>
        </li>  
        <li class="treeview product">
          <a href="/">
            <i class="fa fa-circle-o"></i>
            <spa>Product</spa>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class='products-regular'><a href="/products-regular"><i class="fa fa-circle-o"></i> Regular</a></li>
            <li class="promo"><a href="/-overview"><i class="fa fa-circle-o"></i> Promo</a></li>
            <li class='price-adjustment'><a href="/-overview"><i class="fa fa-circle-o"></i> Price Adjustment</a></li>
            <li class="system-product"><a href="/-overview"><i class="fa fa-circle-o"></i> System Products</a></li>
          </ul>
        </li>
      </ul>
    </li>
    <li class='treeview operations'>
      <a href="#">
        <i class="fa fa-gears"></i>
        <span>Operations</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        @if(Auth::user()->level_id > 2)  
        <li class='approvals'><a href="/approvals"><i class="fa fa-circle-o"></i> Approvals</a></li>
        @else
        <li class='journals'><a href="/journals"><i class="fa fa-circle-o"></i> Journals</a></li>
        @endif
      </ul> 
    </li>
    <li class="treeview settings">
      <a href="#">
        <i class="fa fa-gears"></i>
        <span>Settings</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li class="clusters"><a href="/clusters"><i class="fa fa-circle-o"></i> Clusters</a></li>
        <li class="branches"><a href="/branches"><i class="fa fa-circle-o"></i> Branches</a></li>
        <li class="category"><a href="/category"><i class="fa fa-circle-o"></i> Category</a></li>
        <li class="suppliers"><a href="/suppliers"><i class="fa fa-circle-o"></i> Supplier</a></li>
        <li class="acc_levels"><a href="/acc_levels"><i class="fa fa-circle-o"></i>Account Level</a></li>
        <li class="product-group"><a href="/product-group"><i class="fa fa-circle-o"></i>Product Group</a></li>
        <li class="product-storage"><a href="/product-storage"><i class="fa fa-circle-o"></i>Storage</a></li>

      </ul>
    </li>
   
       
  </ul>
</section>
<!-- /.sidebar -->

