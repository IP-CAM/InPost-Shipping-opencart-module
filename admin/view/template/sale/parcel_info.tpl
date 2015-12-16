<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/order.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons">
<a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a>
       </div>
    </div>
    <div class="content">
      <div id="tab-order" class="vtabs-content">
        <table class="form">
          <tr>
            <td><?php echo $text_order_id; ?></td>
            <td>#<?php echo $order_id; ?></td>
          </tr>
          <tr>
            <td><?php echo $text_parcel_id; ?></td>
            <td><?php echo $parcel_id; ?></td>
          </tr>
          <tr>
            <td><?php echo $text_parcel_status; ?></td>
            <td id="order-status"><?php echo $parcel_status; ?></td>
          </tr>
          <tr>
            <td><?php echo $text_parcel_detail; ?></td>
            <td><?php echo $parcel_details; ?></td>
          </tr>
          <tr>
            <td><?php echo $text_size; ?></td>
            <td><?php echo $size; ?></td>
          </tr>
          <tr>
            <td><?php echo $text_parcel_machine; ?></td>
            <td><?php echo $parcel_machine; ?></td>
          </tr>
          <tr>
            <td><?php echo $text_email; ?></td>
            <td><?php echo $email; ?></td>
          </tr>
          <tr>
            <td><?php echo $text_mobile; ?></td>
            <td><?php echo $mobile; ?></td>
          </tr>
          <tr>
            <td><?php echo $text_creation_date; ?></td>
            <td><?php echo $creation_date . ' ' . $creation_time; ?></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>
