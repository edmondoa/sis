
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
        <i class="fa fa-laptop"></i> <span>SALES</span>
        <span class="pull-right-container">
           <i  class="fa fa-angle-left pull-right"></i>
        </span>      
      </a> 
      <ul class="treeview-menu">
        <li><a href="/"><i class="fa fa-circle-o"></i>Invoice</a></li>
        <li><a href="/"><i class="fa fa-circle-o"></i>InvoiceReturn</a></li>
        <li><a href="/"><i class="fa fa-circle-o"></i>Consign</a></li>
        <li><a href="/"><i class="fa fa-circle-o"></i>Consign Invoicing/Return</a></li>
        <li><a href="/"><i class="fa fa-circle-o"></i>DueDate Extension</a></li>
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
                  <li><a href="/"><i class="fa fa-circle-o"></i>Withdraw</a></li>
                </ul>
             </li>
          </ul>
        </li>
        
      </ul>     
    </li>
    <!-- Sales -->
    <li class="treeview">
      <a href="#">
        <i class="fa fa-laptop"></i> <span>FINANCIALS</span>  
        <span class="pull-right-container">
           <i  class="fa fa-angle-left pull-right"></i>
        </span>      
      </a> 
      <ul class="treeview-menu">
        <li><a href="/"><i class="fa fa-circle-o"></i>Payment</a></li>        
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
    <!-- Financials -->
    <li class="treeview main-products">
      <a href="#">
        <i class="fa fa-laptop"></i>
        <span>INVENTORY</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li class='treeview'>
          <a href="#"><i class="fa fa-circle-o"></i>Purchase Order
            <span class="pull-right-container">
                 <i  class="fa fa-angle-left pull-right"></i>
              </span> 
          </a>
          <ul class="treeview-menu">
            <li><a href="/"><i class="fa fa-circle-o"></i>Customer Order</a></li>
            <li><a href="/"><i class="fa fa-circle-o"></i>Consolidated</a></li>
          </ul>
        </li>        
        <li class='treeview'>
          <a href="#"><i class="fa fa-circle-o"></i>StockIn
            <span class="pull-right-container">
                 <i  class="fa fa-angle-left pull-right"></i>
              </span> 
          </a>
          <ul class="treeview-menu">
            <li class="stockin"><a href="/stockin"><i class="fa fa-circle-o"></i>Regular</a></li>
            <li><a href="/"><i class="fa fa-circle-o"></i>Reject</a></li>
          </ul>
        </li>
        <li><a href="/stockout"><i class="fa fa-circle-o"></i>Stockout</a></li>
        <li><a href="/transfer"><i class="fa fa-circle-o"></i>InterBranch Transfer</a></li>
        <li class='treeview'>
          <a href="#"><i class="fa fa-circle-o"></i>Stock Adjustment
            <span class="pull-right-container">
                 <i  class="fa fa-angle-left pull-right"></i>
              </span> 
          </a>
          <ul class="treeview-menu">
            <li class="stockin"><a href="/"><i class="fa fa-circle-o"></i>In</a></li>
            <li><a href="/"><i class="fa fa-circle-o"></i>Out</a></li>
          </ul>
        </li>

        <li><a href="/"><i class="fa fa-circle-o"></i>Daily Cycle Count</a></li>
      </ul> 
    </li>
    <!-- Inventory -->
    <li class="treeview record-management">
      <a href="#">
        <i class="fa fa-laptop"></i>
        <span>RECORD MANAGEMENT</span>
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
              <li class="account"><a href="/"><i class="fa fa-circle-o"></i>Account</a></li>
              <li class="discounting"><a href="/discounting"><i class="fa fa-circle-o"></i>Discounting</a></li>
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
            <li class='products-regular'><a href="/products-regular"><i class="fa fa-circle-o"></i>Regular</a></li>
            <li class="promo"><a href="/-overview"><i class="fa fa-circle-o"></i>Promo</a></li>
            <li class='price-adjustment'><a href="/-overview"><i class="fa fa-circle-o"></i>Price Adjustment</a></li>
            <li class="system-product"><a href="/-overview"><i class="fa fa-circle-o"></i>System Products</a></li>
          </ul>
        </li>
      </ul>
    </li>
    <!-- Record Management -->
    
    <li class='treeview operations'>
      <a href="#">
        <i class="fa fa-laptop"></i>
        <span>OPERATIONS</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="/"><i class="fa fa-circle-o"></i>Branch</a></li>
        <li><a href="/"><i class="fa fa-circle-o"></i>Domain</a></li>
        <li><a href="/"><i class="fa fa-circle-o"></i>Void</a></li>
        <li><a href="/"><i class="fa fa-circle-o"></i>Purchases</a></li>
        <li><a href="/"><i class="fa fa-circle-o"></i>Verifications</a></li>
        <li><a href="/"><i class="fa fa-circle-o"></i>BackDating</a></li>
        <li><a href="/"><i class="fa fa-circle-o"></i>Edit Record</a></li>
        <li><a href="/"><i class="fa fa-circle-o"></i>Tools</a></li>

        @if(Auth::user()->level_id > 2)  
        <li class='approvals'><a href="/approvals"><i class="fa fa-circle-o"></i>Approvals</a></li>
        @else
        <li class='journals'><a href="/journals"><i class="fa fa-circle-o"></i>Journals</a></li>
        @endif
      </ul> 
    </li>
    <!-- Operations -->
    
    <li class="treeview reports">
      <a href="#">
        <i class="fa fa-dashboard"></i> <span>REPORTS</span>
        <span class="pull-right-container">
           <i  class="fa fa-angle-left pull-right"></i>
        </span>      
      </a> 
      <ul class="treeview-menu">
        <li><a href="/"><i class="fa fa-circle-o"></i>Journals</a></li>
        <li><a href="/"><i class="fa fa-circle-o"></i>Account</a></li>
        <li><a href="/"><i class="fa fa-circle-o"></i>Consignments</a></li>
        <li><a href="/"><i class="fa fa-circle-o"></i>Receivables</a></li>
        <li><a href="/"><i class="fa fa-circle-o"></i>Sales Performance</a></li>
        <li><a href="/"><i class="fa fa-circle-o"></i>Product</a></li>
        <li><a href="/"><i class="fa fa-circle-o"></i>Management Reports</a></li>
        <li><a href="/"><i class="fa fa-circle-o"></i>Invoices</a></li>
        <li><a href="/"><i class="fa fa-circle-o"></i>Purchases</a></li>
        <li><a href="/"><i class="fa fa-circle-o"></i>Collection</a></li>
      </ul>     
    </li>
    <!-- Reports -->

    <li class="treeview settings">
      <a href="#">
        <i class="fa fa-gears"></i>
        <span>SETTINGS</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">

        <li class="treeview branches">
            <a href="/">
              <i class="fa fa-circle-o"></i>
              <spa>Branches</spa>
              <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="clusters"><a href="/clusters"><i class="fa fa-circle-o"></i>Clusters</a></li>
              <li class="branches"><a href="/branches"><i class="fa fa-circle-o"></i>Branches</a></li>
            </ul>
        </li>  
        <li class="treeview settings-product">
            <a href="/">
              <i class="fa fa-circle-o"></i>
              <spa>Product</spa>
              <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="category"><a href="/category"><i class="fa fa-circle-o"></i>Category</a></li>
              <li class="suppliers"><a href="/suppliers"><i class="fa fa-circle-o"></i>Supplier</a></li>
              <li class="product-group"><a href="/product-group"><i class="fa fa-circle-o"></i>Grouping</a></li>
              <li class="product-storage"><a href="/product-storage"><i class="fa fa-circle-o"></i>Storage</a></li>

            </ul>
        </li>  
        <li class="acc_levels"><a href="/acc_levels"><i class="fa fa-circle-o"></i>Account Level</a></li>
        <li><a href="/"><i class="fa fa-circle-o"></i>BankAccounts</a></li>
        <li><a href="/"><i class="fa fa-circle-o"></i>Holidays</a></li>
        <li><a href="/"><i class="fa fa-circle-o"></i>Terminals</a></li>
        <li><a href="/"><i class="fa fa-circle-o"></i>Cash Denominations</a></li>
        <li><a href="/"><i class="fa fa-circle-o"></i>Security</a></li>

        <li class="treeview settings-domain">
            <a href="/">
              <i class="fa fa-circle-o"></i>
              <spa>Domain</spa>
              <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="/"><i class="fa fa-circle-o"></i>Logo</a></li>
              <li><a href="/"><i class="fa fa-circle-o"></i>Policy</a></li>
              <li><a href="/"><i class="fa fa-circle-o"></i>Consignment</a></li>
              <li><a href="/"><i class="fa fa-circle-o"></i>Tax</a></li>
              <li><a href="/"><i class="fa fa-circle-o"></i>Cycle Count</a></li>
              <li><a href="/"><i class="fa fa-circle-o"></i>Print Document</a></li>
              <li><a href="/"><i class="fa fa-circle-o"></i>Approval</a></li>
              <li><a href="/"><i class="fa fa-circle-o"></i>Misc</a></li>
            </ul>
        </li>  
      </ul>
    </li>
    <!-- Settings -->   
       
  </ul>
</section>
<!-- /.sidebar -->

