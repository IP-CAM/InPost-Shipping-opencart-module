<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/order.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons">
<a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a>
<a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a>
       </div>
    </div>

    <div class="content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
      <div id="tab-order" class="vtabs-content">
        <table class="form">
          <tr>
            <td><?php echo $text_order_id; ?></td>
            <td>#<?php echo $order_id; ?></td>
          </tr>
          <tr>
            <td><?php echo $text_parcel_id; ?></td>
            <td><?php echo $parcel_id; ?>
               <input type="hidden" name="parcel_id" value="<?php echo $parcel_id; ?>" />
               <input type="hidden" name="parcel_status" value="<?php echo $parcel_status; ?>" />
            </td>
          </tr>
            <tr>
              <td><span class="required">*</span> <?php echo $entry_target_machine_id; ?></td>
              <td><input type="text" name="target_machine_id" id="target_machine_id" value="<?php echo $target_machine_id; ?>" />
		<a href="#" onClick="openMap(); return false;">Map</a>
                <?php if ($error_target_machine_id) { ?>
                <span class="error"><?php echo $error_target_machine_id; ?></span>
                <?php } ?></td>
            </tr>
          <tr>
            <td><span class="required">*</span> <?php echo $text_email; ?></td>
            <td><input type="text" name="email" value="<?php echo $email; ?>" style="width:150px;" />
                <?php if ($error_email) { ?>
                <span class="error"><?php echo $error_email; ?></span>
                <?php } ?></td>
          </tr>
          <tr>
            <td><span class="required">*</span> <?php echo $text_mobile; ?></td>
            <td>07 <input type="text" name="mobile" value="<?php echo $mobile; ?>" maxlength="9" />
                <?php if ($error_mobile) { ?>
                <span class="error"><?php echo $error_mobile; ?></span>
                <?php } ?></td>
          </tr>
          <tr>
            <td><span class="required">*</span> <?php echo $text_size; ?></td>
            <td>
                <select name="size" id="size">
                  <option value="">Select</option>
                  <?php if ($size == 'A'): ?>
                  <option value="A" selected="selected"><?php echo $text_size_a; ?></option>
                  <?php else: ?>
                  <option value="A"><?php echo $text_size_a; ?></option>
                  <?php endif; ?>
                  <?php if ($size == 'B'): ?>
                  <option value="B" selected="selected"><?php echo $text_size_b; ?></option>
                  <?php else: ?>
                  <option value="B"><?php echo $text_size_b; ?></option>
                  <?php endif; ?>
                  <?php if ($size == 'C'): ?>
                  <option value="C" selected="selected"><?php echo $text_size_c; ?></option>
                  <?php else: ?>
                  <option value="C"><?php echo $text_size_c; ?></option>
                  <?php endif; ?>
                </select>
                <?php if ($error_size) { ?>
                <span class="error"><?php echo $error_size; ?></span>
                <?php } ?>
            </td>
          </tr>
        </table>
      </div>
    </div>
    </form>
  </div>
</div>
<script type="text/javascript" src="https://geowidget.inpost.co.uk/dropdown.php?field_to_update=target_machine_id&user_function=user_function"></script>
<script type="text/javascript"><!--
///
// user_function function
//
// @param value mixed string
// @return none
//
function user_function(value)
{
        //document.getElementById('inpost_data').value=value;
}
--></script>
<?php echo $footer; ?>
