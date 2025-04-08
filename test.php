<?=$this->extend("layout")?>
  
<?=$this->section("content")?>
  
<div class="container">
    <div class="row justify-content-md-center mt-5">
    <div class="card-header text-center">
                    <h5>Data Summary - Interprise</h5>
                    <h2>Following information will be used to setup the import data as well as website configuration.</h2>
                    <h2>ATTENTION: Review each value before proceeding as this cannot be changed once saved.</h2>
                </div>
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <!-- <h5 class="card-title mb-4">Initial Configuration</h5> -->
                    <?php if(session()->getFlashdata('error')):?>
                        <div class="alert alert-danger">
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif;?>
                    
                  <?php  if (count($installwizard)>0) { ?>
                    <div id="loader" style="display:none;">Loading...</div>
    <div id="ajaxResponse"></div>
  
<table cellspacing="0">
    <tr>
        <td>Item</td>
        <td>Total Records</td>
        <td>Status</td>
        <td>Action</td>
    </tr>
        <?php foreach ($installwizard as $key => $collection) { ?>
        <tr>
            <?php
            $done=$collection['action'];

            switch ($collection['function_name']) {
                case 'customers':
                    $master_id=2;
                    $printdata='';
                    // $countpen = $block->countpendingitems($master_id);
                    // if ($countpen && $countpen>0) {
                    //     $chack_is_process = true;
                    // }
                    //  $resyysucess=$block->processChangeLog($master_id);
                    // $sucess=(isset($resyysucess['Success'])?$resyysucess['Success']:0);
                    // $faild=(isset($resyysucess['fail'])?$resyysucess['fail']:0);
                    // if ($sucess>0 || $faild>0) {
                    //     $faild_s='';
                    //     if ($done=='Done') {
                    //             $faild_s=" Check Task log for ".$faild." failed item(s).";
                    //     }
                    //     $data=$sucess."/".$collection['total_records'].' Completed. '.$faild_s;
                    //     $printdata =  $data;
                    // } else {
                    //         $printdata =  $collection['total_records'];
                    // }
                    break;
                case 'stock_items':
                    $master_id=1;
                    $printdata='';
                   
                    break;
                case 'kit_items':
                    $master_id=16;
                    $printdata='';
                    
                    break;
                case 'matrix_item':
                    $master_id=12;
                    $printdata='';
                    
                    break;
               
                case 'category':
                    $printdata ="Data not available";
                    break;
                default:
                    $printdata =  $collection['total_records'];
            }
            ?>
        <td><?= /* @noEscape */ $collection['item_name']; ?></td>
        <td id="records_<?= /* @noEscape */ $collection['id'] ?>"><?= /* @noEscape */$printdata; ?></td>
        <td id="records_<?= /* @noEscape */ $collection['id'] ?>"><?= /* @noEscape */$collection['status']; ?></td>
        <td id="records_<?= /* @noEscape */  $collection['id'] ?>">

                   
            <a style="text-decoration:none;" id="action_<?= /* @noEscape */ $collection['id'] ?>"
                onclick="process_start('<?= /* @noEscape */  $collection['function_name']; ?>')" href="javascript:void(0)"><?= /* @noEscape */ $collection['action']; ?></a>
            <input type="hidden" id="master_id_<?= /* @noEscape */ $collection['id'] ?>"
                value="<?= /* @noEscape */ $collection['id']; ?>">
                </td>
        </tr>
        <?php } ?>
</table>
    


    <?php } else { ?>

    <table cellspacing="0" style="width: 70%!important">
        <tr>
            <td style="text-align: center;"><h2 style="color: forestgreen;">Import Complete. API is live.</h2></td>
        </tr>
        
    </table>

    <?php } ?>
                </div>
            </div>
        </div>
    </div>
     
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    function showLoader() {
        document.getElementById('loader').style.display = 'block';
    }

    function hideLoader() {
        document.getElementById('loader').style.display = 'none';
    }

    function process_start(type) {
        var xhr = new XMLHttpRequest();
        var url = "<?= base_url('summary/process'); ?>?type=" + type;

        xhr.open('GET', url, true);
        xhr.setRequestHeader('Content-Type', 'application/json');

        // Show loader before sending the request
        showLoader();

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4) {
                hideLoader();
                if (xhr.status == 200) {
                    // On success, reload the page and update the response
                    window.location.reload();
                    document.getElementById("ajaxResponse").innerHTML = xhr.responseText;
                } else {
                    // On failure, show error message
                    alert('Oops, An error occurred, please try again later!' + xhr.responseText);
                    document.getElementById("ajaxResponse").innerHTML = 'Oops, An error occurred, please try again later!';
                }
            }
        };

        xhr.send();
    }

});
</script>
<?=$this->endSection()?>
