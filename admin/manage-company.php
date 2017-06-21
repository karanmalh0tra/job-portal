<?php
@session_start();

if(!isset($_SESSION['admin_email'])){

  echo "<script>window.open('login.php','_self')</script>";
}
else {

  ?>
  <?php include "header.php" ; ?>
  <?php
  require_once 'class/admin-service.php';
  $adminService = new AdminService();
  $companyList = $adminService->viewCompany();
  ?>
  <style>
  table {
    border-collapse: collapse;
    border-spacing: 0;
    width: 100%;
    border: 1px solid #ddd;
  }

  th, td {
    border: none;
    text-align: left;
    padding: 8px;
  }

  tr:nth-child(even){background-color: #d6ddef}
  </style>

  <div id="content">

    <div id="content-header">

      <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Manage Company</a> </div>

      <h1>Manage Company</h1>
      <?php if(isset($_GET['success'])){
        if($_GET['success']==0){  ?>

          <?php	echo '<h4><center><b style="color:red;"><span>Company Detail Not Updatted .Please Try Again.</span></b></center></h4>'; ?>

          <?php } elseif($_GET['success']==1){ ?>

            <?php	echo '<h4><center><b style="color:green;"><span>Company Detail Updatted Successfully.</span></b></center></h4>'; ?>

            <?php }} else if(isset($_GET['delete'])){
              if($_GET['delete']==0){
                ?>
                <?php	echo '<h4><center><b style="color:red;"><span>Company Detail Not Delete .Please Try Again.</span></b></center></h4>'; ?>

                <?php } elseif($_GET['delete']==1){ ?>

                  <?php	echo '<h4><center><b style="color:green;"><span>Company Detail Delete Successfully.</span></b></center></h4>'; ?>
                  <?php }} ?>

                </div>

                <div class="container-fluid">

                  <hr>

                  <div class="row-fluid">

                    <div class="span12">

                      <div class="widget-box">

                        <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>

                          <h5>Company List</h5>

                        </div>

                        <div class="widget-content nopadding" style="overflow-x:auto;">

                          <table class="table table-bordered table-striped">

                            <thead>

                              <tr>

                                <th>#</th>
                                <th>Name</th>
                                <th>Email Id</th>
                                <th>Person</th>
                                <th>Mobile Number</th>
                                <!--<th>Password</th>-->
                                <th>Address</th>
                                <th>Action</th>
                              </tr>

                            </thead>

                            <tbody>
                              <?php $sr=1;
                              foreach($companyList as $company){ ?>
                                <tr class="odd gradeX">

                                  <td><?php echo $sr++?></td>
                                  <td><?php echo $company['company_name'];?></td>
                                  <td><?php echo $company['company_email'];?></td>
                                  <td><?php echo $company['company_contact_person'];?></td>
                                  <td><?php echo $company['company_contact'];?></td>
                                  <!--<td class="center"><?php //echo $company['password'];?></td>-->
                                  <td><?php echo $company['company_address'];?></td>
                                  <td class="center"><a href="edit-company.php?companyId=<?php echo $company['company_id'];?>"><span class='btn btn-primary btn-mini'>Edit</span></a> <a href="controller/delete-company.php?companyId=<?php echo $company['company_id'];?>" onclick='return confirm("Are you sure? You want to Delete.")'><span class='btn btn-danger btn-mini'>Delete</span></a></td>
                                </tr>

                                <?php }?>
                              </tbody>

                            </table>

                          </div>

                        </div>

                      </div>

                    </div>

                  </div>

                </div>
                <?php include "footer.php" ; ?>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
                <script>
                jQuery(document).ready(function(){

                  $(document).on("click",".status",function(){

                    var companyId = $(this).attr("id");
                    //alert('ID = '+portfolioId);
                    var this_ref = this;
                    //	alert("vendorId "+vendorId+" feature "+feature);
                    $.ajax({
                      url:"controller/company-status.php",
                      type:"post",
                      data:"companyId="+companyId,
                      success: function(response)
                      {
                        //alert(response);
                        if(response =="In-Active"){
                          $(this_ref).html(response).wrapInner('<span class="btn btn-warning btn-mini"></span>');
                          $(this_ref).parent().parent().attr("style","background:#f1d4d9;");
                          $(this_ref).removeClass("status").addClass("status");
                        }else{
                          $(this_ref).html(response).wrapInner('<span class="btn btn-success btn-mini"></span>');
                          $(this_ref).parent().parent().attr("style","background:#d4f1d4;");
                          $(this_ref).removeClass("status").addClass("status");
                        }
                      }
                    });
                  });
                });
                </script>
                <?php } ?>
