<?php
session_start();
ob_start();
include('includes/MysqliDb.php');
$fType="SELECT * FROM facility_type";
$fTypeResult = $db->rawQuery($fType);
?>
<link rel="stylesheet" media="all" type="text/css" href="assets/css/jquery-ui.1.11.0.css" />
  <link href="assets/css/jasny-bootstrap.min.css" rel="stylesheet" />
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link href="assets/css/style.css" rel="stylesheet" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/css/font-awesome.min.4.5.0.css">
   <!-- DataTables -->
  <link rel="stylesheet" href="assets/plugins/datatables/dataTables.bootstrap.css">
  <link href="assets/css/deforayModal.css" rel="stylesheet" />
  <script type="text/javascript" src="assets/js/jquery.min.2.0.2.js"></script>
  <script src="assets/js/deforayModal.js"></script>
  <script type="text/javascript" src="assets/js/jasny-bootstrap.js"></script>
  <script src="assets/js/deforayValidation.js"></script>
  <style>
    b{font-size: 12px;}
    .closeModal{display: none;}
  </style>

<div class="content-wrapper" style="padding: 20px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h4>Add Instance Details</h4>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header with-border">
          <div class="pull-right" style="font-size:15px;"><span class="mandatory">*</span> indicates required field &nbsp;</div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <!-- form start -->
            <form class="form-horizontal" method='post' name='addInstance' id='addInstance' enctype="multipart/form-data" autocomplete="off" action="addInstanceHelper.php">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <table class="table" cellpadding="1" cellspacing="3" style="margin-left:1%;margin-top:20px;width: 98%;">
                                <tr>
                                    <td style=""><b>Instance Name&nbsp;<span class="mandatory">*</span></b></td>
                                    <td>
                                      <input type="text" class="form-control isRequired" name="fName" id="fName" title="Please enter instance name" placeholder="Instance Name"/>
                                    </td>
                                    <td>&nbsp;<b>Facility Code/ID&nbsp;</b></td>
                                    <td>
                                      <input type="text" class="form-control " id="fCode" name="fCode" placeholder="Facility Code" title="Please enter facility code"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td style=""><b>Facility Type&nbsp;<span class="mandatory">*</span></b></td>
                                    <td>
                                        <select class="form-control isRequired" id="fType" name="fType" placeholder="Facility Type" title="Please enter facility type">
                                            <option value="">-- Select --</option>
                                            <?php foreach($fTypeResult as $result){ ?>
                                                <option value="<?php echo base64_encode($result['facility_type_id']);?>"><?php echo ucwords($result['facility_type_name']);?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <td>&nbsp;<b>Logo Image&nbsp;</b></td>
                                    <td>
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width:200px; height:150px;">
                                               <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=No image">
                                            </div>
                                            <div>
                                              <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
                                              <input type="file" id="logo" name="logo" title="Please select logo image">
                                              </span>
                                              <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                            </div>
                                        </div>
                                        <div class="box-body">
                                            <b>Please make sure logo image size of:</b> <code>80x80</code>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
              <div class="box-footer">
                <a class="btn btn-primary" href="javascript:void(0);" onclick="validateNow();return false;">Save & Proceed</a>
              </div>
            </form>
            <hr/>
        </div>
      </div>
    </section>
</div>
<script src="assets/js/bootstrap.min.js"></script>
  <!-- DataTables -->
 <script type="text/javascript">
    <?php if(isset($_SESSION['success']) && trim($_SESSION['success'])!=""){ ?>
        alert('<?php echo $_SESSION['alertMsg']; ?>');
    <?php $_SESSION['alertMsg']=''; unset($_SESSION['alertMsg']); $_SESSION['success']=''; unset($_SESSION['success']);
    ?>
    window.parent.closeModal();
    <?php } ?>
  function validateNow(){
    flag = deforayValidator.init({
        formId: 'addInstance'
    });
    
    if(flag){
      document.getElementById('addInstance').submit();
    }
  }
</script>