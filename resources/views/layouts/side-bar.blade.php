
<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
  <!-- Sidebar user panel -->
  <div class="user-panel">
    <div class="pull-left image">
      <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
      <p>{{Auth::user()->firstname.' '.Auth::user()->lastname}}</p>
      <a href="#"><i class="fa fa-circle text-success"></i> Online {{Auth::user()->domain_name}}</a>
    </div>
  </div>
  <!-- search form -->
  <form action="#" method="get" class="sidebar-form">
    <div class="input-group">
      <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
          </span>
    </div>
  </form>
  <!-- /.search form -->

  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu">
    <li class="header">MAIN NAVIGATION</li>
    <!-- Sales -->
    <li class="treeview">
      <a href="#">
        <i class="fa fa-laptop"></i> <span>Sales</span>
        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>      
      </a> 
      <ul class="treeview-menu">
        <li><a href="/"><i class="fa fa-circle-o"></i>Invoice</a></li>
        <li><a href="/"><i class="fa fa-circle-o"></i>Invoice Return</a></li>
        <li><a href="/"><i class="fa fa-circle-o"></i>Consign</a></li>
        <li><a href="/"><i class="fa fa-circle-o"></i>Consign Invoicing/Return</a></li>
      </ul>     
    </li>
    <!-- /Sales -->
    <!-- Financials -->
    <li class="treeview">
      <a href="#">
        <i class="fa fa-laptop"></i> <span>Financials</span>  
        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>      
      </a> 
      <ul class="treeview-menu">
        <li><a href="/"><i class="fa fa-circle-o"></i>Payment</a></li>        
        <li class='treeview'>
          <a href="#"><i class="fa fa-circle-o"></i>Non-AR Payment
            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/"><i class="fa fa-circle-o"></i>In</a></li>
            <li><a href="/"><i class="fa fa-circle-o"></i>Out</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#"><i class="fa fa-circle-o"></i>Memo
            <span class="pull-right-container"><i  class="fa fa-angle-left pull-right"></i></span> 
          </a>
          <ul class="treeview-menu">
            <li><a href="/"><i class="fa fa-circle-o"></i>Credit (CM)</a></li>
            <li><a href="/"><i class="fa fa-circle-o"></i>Debit (DM)</a></li>
          </ul>
        </li>
        <li class='treeview'>
          <a href="#"><i class="fa fa-circle-o"></i>Collection
            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span> 
          </a>
          <ul class="treeview-menu">
            <li><a href="/"><i class="fa fa-circle-o"></i>Cash Turn-In</a></li>
            <li><a href="/"><i class="fa fa-circle-o"></i>Balancing/Deposit</a></li>
          </ul>
        </li>
      </ul>     
    </li>
    <!-- /Financials -->
    <!-- Inventory -->
    <li class="treeview inventory">
      <a href="#">
        <i class="fa fa-laptop"></i><span>Inventory</span>
        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
      </a>
      <ul class="treeview-menu">
        <li><a href="/"><i class="fa fa-circle-o"></i>Daily Cycle Count</a></li>
        <li class="treeview">
          <a href="#"><i class="fa fa-circle-o"></i>Order
            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span> 
          </a>
          <ul class="treeview-menu">
            <li><a href="/"><i class="fa fa-circle-o"></i>Customer Order</a></li>
            <li><a href="/"><i class="fa fa-circle-o"></i>Consolidated</a></li>
            <li><a href="/"><i class="fa fa-circle-o"></i>Fulfillment Manager</a></li>
          </ul>
        </li>        
        <li class='treeview'>
          <a href="#"><i class="fa fa-circle-o"></i>StockIn
            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span> 
          </a>
          <ul class="treeview-menu">
            <li class="stockin"><a href="/stockin"><i class="fa fa-circle-o"></i>Regular</a></li>
            <li><a href="/"><i class="fa fa-circle-o"></i>Reject</a></li>
          </ul>
        </li>
        <li><a href="/stockout"><i class="fa fa-circle-o"></i>Stockout</a></li>
        <li class="interbranch-transfer"><a href="/transfer"><i class="fa fa-circle-o"></i>InterBranch Transfer</a></li>
        <li class='treeview'>
          <a href="#"><i class="fa fa-circle-o"></i>Stock Adjustment
            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span> 
          </a>
          <ul class="treeview-menu">
            <li class="stockin"><a href="/"><i class="fa fa-circle-o"></i>In</a></li>
            <li><a href="/"><i class="fa fa-circle-o"></i>Out</a></li>
          </ul>
        </li>

      </ul> 
    </li>
    <!-- /Inventory -->
    <!-- Record Management -->
    <li class="treeview">
      <a href="#">
        <i class="fa fa-laptop"></i><span>Record Management</span>
        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
      </a>
      <ul class="treeview-menu">
        <li class="treeview">
            <a href="#">
              <i class="fa fa-circle-o"></i><span>Customer</span>
              <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
            </a>
            <ul class="treeview-menu">
              <li><a href="/"><i class="fa fa-circle-o"></i>Customer Info</a></li>
              <li class="account"><a href="/"><i class="fa fa-circle-o"></i>Account/Registration</a></li>
              <li class="discounting"><a href="/discounting"><i class="fa fa-circle-o"></i>Discounting</a></li>
            </ul>
        </li>  
        <li class="treeview">
          <a href="#">
            <i class="fa fa-circle-o"></i><span>Product</span>
            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
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
    <!-- /Record Management -->
    <!-- Operations -->
    <li class="treeview">
      <a href="#">
        <i class="fa fa-laptop"></i><span>Operations</span>
        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
      </a>
      <ul class="treeview-menu">
        <li class='approvals'><a href="/approvals"><i class="fa fa-circle-o"></i>Approvals</a></li>
        <li><a href="/"><i class="fa fa-circle-o"></i>Branch</a></li>
        <li><a href="/"><i class="fa fa-circle-o"></i>Domain</a></li>
        <li><a href="/"><i class="fa fa-circle-o"></i>DueDate Extension</a></li>
        <li><a href="#"><i class="fa fa-circle-o"></i>CreditLine Adjustment</a></li>
        <li class="treeview">
            <a href="#">
              <i class="fa fa-circle-o"></i><span>Void</span>
              <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
            </a>
            <ul class="treeview-menu">
              <li><a href="/"><i class="fa fa-circle-o"></i>Invoice</a></li>
              <li><a href="/"><i class="fa fa-circle-o"></i>Payment</a></li>
              <li><a href="/"><i class="fa fa-circle-o"></i>Deposit</a></li>
            </ul>
        </li>  
        <li class="treeview">
            <a href="#">
              <i class="fa fa-circle-o"></i><span>Purchases</span>
              <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
            </a>
            <ul class="treeview-menu">
              <li><a href="/"><i class="fa fa-circle-o"></i>SupplierCM</a></li>
              <li><a href="/"><i class="fa fa-circle-o"></i>Purchase Liquidation</a></li>
            </ul>
        </li>  
        <li class="treeview">
            <a href="#">
              <i class="fa fa-circle-o"></i><span>Audit/Verifications</span>
              <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
            </a>
            <ul class="treeview-menu">
              <li><a href="/"><i class="fa fa-circle-o"></i>StockIn</a></li>
              <li><a href="/"><i class="fa fa-circle-o"></i>Deposit</a></li>
            </ul>
        </li>  
        <li class="treeview">
            <a href="#">
              <i class="fa fa-circle-o"></i><span>BackDating</span>
              <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
            </a>
            <ul class="treeview-menu">
              <li><a href="/"><i class="fa fa-circle-o"></i>Invoice</a></li>
              <li><a href="/"><i class="fa fa-circle-o"></i>Payment</a></li>
              <li><a href="/"><i class="fa fa-circle-o"></i>Non-AR Payment</a></li>
              <li><a href="/"><i class="fa fa-circle-o"></i>Deposit</a></li>
            </ul>
        </li>  
        <li class="treeview">
            <a href="#">
              <i class="fa fa-circle-o"></i><span>Modify Transaction Info</span>
              <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
            </a>
            <ul class="treeview-menu">
              <li><a href="/"><i class="fa fa-circle-o"></i>StockIn</a></li>
            </ul>
        </li> 
        <li class="treeview">
            <a href="#">
              <i class="fa fa-circle-o"></i><span>Tools</span>
              <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
            </a>
            <ul class="treeview-menu">
              <li><a href="/"><i class="fa fa-circle-o"></i>Export Invoices</a></li>
              <li><a href="/"><i class="fa fa-circle-o"></i>Export Receivables</a></li>
            </ul>
        </li> 
               </ul>
    </li>
    <!-- /Operations -->
    <!-- Reports -->
    <li class="treeview">
      <a href="#">
        <i class="fa fa-dashboard"></i> <span>Reports</span>
        <span class="pull-right-container"><i  class="fa fa-angle-left pull-right"></i></span>      
      </a> 
      <ul class="treeview-menu">
        <li class="journals"><a href="/journals"><i class="fa fa-circle-o"></i>Journals</a></li>
        <li><a href="/"><i class="fa fa-circle-o"></i>Non-AR Payments</a></li>
        <li><a href="/"><i class="fa fa-circle-o"></i>Customer/Account</a></li>
        <li><a href="/"><i class="fa fa-circle-o"></i>Consignments</a></li>
        <li><a href="/"><i class="fa fa-circle-o"></i>Receivables</a></li>
        <li><a href="/"><i class="fa fa-circle-o"></i>Sales Performance</a></li>
        <li><a href="/"><i class="fa fa-circle-o"></i>Products</a></li>
        <li><a href="/"><i class="fa fa-circle-o"></i>Management Reports</a></li>
        <li><a href="/"><i class="fa fa-circle-o"></i>Invoices</a></li>
        <li><a href="/"><i class="fa fa-circle-o"></i>Purchases</a></li>
        <li><a href="/"><i class="fa fa-circle-o"></i>Collection</a></li>
      </ul>     
    </li>
    <!-- /Reports -->
    <!-- Settings -->
    <li class="treeview">
      <a href="#">
        <i class="fa fa-gears"></i><span>Settings</span>
        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
      </a>
      <ul class="treeview-menu">
        <li><a href="/"><i class="fa fa-circle-o"></i>Security</a></li>
        <li class="treeview">
            <a href="/">
              <i class="fa fa-circle-o"></i><span></span>Branches</span>
              <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="clusters"><a href="/clusters"><i class="fa fa-circle-o"></i>Clusters</a></li>
              <li class="branches"><a href="/branches"><i class="fa fa-circle-o"></i>Branches</a></li>
            </ul>
        </li>  
        <li class="treeview">
            <a href="/">
              <i class="fa fa-circle-o"></i><span>Products</span>
              <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
            </a>
            <ul class="treeview-menu">
              <li class="category"><a href="/category"><i class="fa fa-circle-o"></i>Categories</a></li>
              <li class="suppliers"><a href="/suppliers"><i class="fa fa-circle-o"></i>Suppliers</a></li>
              <li class="product-group"><a href="/product-group"><i class="fa fa-circle-o"></i>Groups</a></li>
              <li class="product-storage"><a href="/product-storage"><i class="fa fa-circle-o"></i>Storages</a></li>
            </ul>
        </li>  
        <li class="acc_levels"><a href="/acc_levels"><i class="fa fa-circle-o"></i>Account Level</a></li>
        <li><a href="/"><i class="fa fa-circle-o"></i>Bank Accounts</a></li>
        <li><a href="/"><i class="fa fa-circle-o"></i>Holidays</a></li>
        <li><a href="/"><i class="fa fa-circle-o"></i>Terminals</a></li>
        <li><a href="/"><i class="fa fa-circle-o"></i>Cash Denominations</a></li>
        <li class="treeview">
            <a href="/">
              <i class="fa fa-circle-o"></i><span>Domain</span>
              <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
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
    <!-- /Settings -->         
  </ul>
</section>
<!-- / sidebar menu -->