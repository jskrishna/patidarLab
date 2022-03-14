<?php include_once "./public/assets/includes/header.php"; ?>
<?php include_once "./public/assets/includes/navbar.php";   ?>
<div class="layoutSidenav_content">
    <div class="layout_content_inr">
        <div class="patient-sec">
            <div class="form-row">
                <div class="col-lg-12">
                    <div class="c-datatable">
                        <table width="100%" class="table dt-responsives" role="grid">
                            <thead>
                                <tr role="row" class="tablesorter-headerRow">
                                     <th style="width:35px">
                                        <div class="tablesorter-header-inner">No.</div>
                                    </th>
                                    <th>
                                        <div class="tablesorter-header-inner">Name</div>
                                    </th>
                                    <th>
                                        <div class="tablesorter-header-inner"> Registered On</div>
                                    </th>
                                    <th>
                                        <div class="tablesorter-header-inner">Id</div>
                                    </th>
                                    <th>
                                        <div class="tablesorter-header-inner"> Referred By</div>
                                    </th>
                                    <th>
                                        <div class="tablesorter-header-inner">Mobile No.</div>
                                    </th>
                                    <th>
                                        <div class="tablesorter-header-inner">Action</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 1;
                                foreach ($patientData as $data) { ?>
                                    <tr role="row">
                                        <td style="width:35px"><?php echo $count++ ?></td>
                                        <td>
                                            <div class="patient-avator">
                                                <div class="ava-l">
                                                    <div class="patient-short-name">
                                                        <?php $name = explode(' ', $data->patientname );
                                                        $name = array_filter($name);
                                                        $nCount =0;
                                                        foreach ($name as $n) {
                                                            if($nCount == 0 || $nCount == 1){
                                                                echo $n[0];
                                                            }
                                                            $nCount++;
                                                        } ?> </div>
                                                </div>
                                                <div class="ava-r">
                                                    <span><?php echo $data->patientname; ?></span>
                                                    <div>
                                                        <?php echo $data->gender[0]; ?> / <?php echo $data->age . ' ' . $data->age_type; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="reg-span date">
                                                <span class="nowwrap-text"><?php echo date_format(new DateTime($data->created_at), "d/m/Y"); ?></span>
                                            </span>
                                        </td>
                                        <td><?php echo $data->patientid; ?></td>
                                        <?php foreach ($referedData as $doc) {
                                            if ($data->refered_by == $doc->id) {
                                        ?>
                                                <td class=""><?php if($doc->title){ echo $doc->title; ?> <?php } ?> <?php echo $doc->referral_name; ?></td>
                                        <?php }
                                        } ?>
                                        <td>
                                            <?php echo $data->mobile; ?>
                                        </td>
                                        <td>
                                            <ul class="action-list">
                                                <li>
                                                    <a href="<?php echo BASE_URL ?>bill?t=<?php echo $data->id; ?>" data-toggle="tooltip" data-placement="top" title="Billing" class="btn btn-sml btn-billing">
                                                       
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g transform="translate(4653 -22580)"><rect width="24" height="24" transform="translate(-4653 22580)" fill="none"/><path d="M5.59,3.1c-.278-.82-.527-1.65-.732-2.49.788-.864,3.832-.75,4.707-.015L8.747,2.522c.439-.573.586-.809.842-1.127a2.556,2.556,0,0,1,.309.239,1.253,1.253,0,0,1,.478.762.788.788,0,0,1-.218.636L8.3,5.2a3.955,3.955,0,0,1-.7-.179c.105-.248.233-.52.338-.769l-.677.732a2.54,2.54,0,0,0-1.8.22L3.572,2.938a.63.63,0,0,1-.163-.4c0-.546.817-1.025,1.245-1.2L5.59,3.093ZM8.007,7.188,7.638,5.5c1.576.293,4.1,3.5,4.919,4.957a13.785,13.785,0,0,1,1.081,2.48c.595,2.218.022,4.294-2.385,4.776a30.053,30.053,0,0,1-5.9.243c-1.7-.088-4.342-.088-5.031-1.836C-.793,13.3,1.243,9.936,3.1,7.876a10,10,0,0,1,.759-.757A7.245,7.245,0,0,1,6.136,5.527L5.294,7.09l1.22-1.611h.643l.85,1.715ZM4.576,11.867l.407-.892h1.5a.586.586,0,0,0-.1-.188.732.732,0,0,0-.176-.16.942.942,0,0,0-.233-.108.842.842,0,0,0-.272-.042H4.576l.407-.9h4.3l-.4.9H7.843a.672.672,0,0,1,.114.11,1,1,0,0,1,.094.129,1.284,1.284,0,0,1,.067.135.64.64,0,0,1,.037.125H9.281l-.4.892H8.067a1.49,1.49,0,0,1-.267.439,2.219,2.219,0,0,1-.413.368,2.751,2.751,0,0,1-.511.274,2.473,2.473,0,0,1-.56.146l2.262,2.329H6.789L4.772,13.213v-.825h.894a.8.8,0,0,0,.253-.042,1.025,1.025,0,0,0,.236-.114.857.857,0,0,0,.183-.164.567.567,0,0,0,.11-.2Z" transform="translate(-4648.003 22582.998)" fill="#223345" fill-rule="evenodd"/></g></svg>
                                                     
                                                    </a>
                                                </li>
                                                <?php if($loggedData->role=='admin'){ ?>

                                                <li>
                                                    <button data-toggle="tooltip" data-placement="top" title="Edit Patient" data-bs-target="#patientEdit" data-bs-toggle="modal" data-bs-dismiss="modal"
                                                    class="btn btn-sml patientedit_btn patientedit-btn" namse="test_edit" data-id="<?php echo $data->id; ?>" value="<?php echo $data->id; ?>">
                                                       
                                                        

<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24" height="24" viewBox="0 0 24 24"><defs><clipPath id="a"><path d="M1,15.978a1,1,0,0,1-1-1.09l.379-4.17A1.975,1.975,0,0,1,.953,9.5l9-9A1.8,1.8,0,0,1,11.238,0a2.028,2.028,0,0,1,1.427.577L15.4,3.315a1.927,1.927,0,0,1,.069,2.715l-9,9a1.971,1.971,0,0,1-1.214.568l-4.17.38C1.064,15.977,1.034,15.978,1,15.978ZM11.272,2.012h0L9.324,3.962l2.695,2.695,1.948-1.949L11.272,2.012Z" transform="translate(4 4.022)" fill="#223345"/></clipPath></defs><path d="M1,15.978a1,1,0,0,1-1-1.09l.379-4.17A1.975,1.975,0,0,1,.953,9.5l9-9A1.8,1.8,0,0,1,11.238,0a2.028,2.028,0,0,1,1.427.577L15.4,3.315a1.927,1.927,0,0,1,.069,2.715l-9,9a1.971,1.971,0,0,1-1.214.568l-4.17.38C1.064,15.977,1.034,15.978,1,15.978ZM11.272,2.012h0L9.324,3.962l2.695,2.695,1.948-1.949L11.272,2.012Z" transform="translate(4 4.022)" fill="#223345"/></svg>
                                                        
                                                    </button>
                                                </li>
                                                <?php } ?>

                                            </ul>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal fade" id="printReport" tabindex="-1" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5>Select Report Type</h5>
                                    <button type="button" class="close" data-dismiss="modal">×</button>
                                </div>
                                <div class="modal-body">
                                    <span id="reportOption"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="layoutRightSide">

</div>
</div>
<?php
include_once "./public/assets/includes/footer.php";
?>