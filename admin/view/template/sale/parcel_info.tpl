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
<script type="text/javascript"><!--

$('#reward-remove').live('click', function() {
	$.ajax({
		url: 'index.php?route=sale/order/removereward&token=<?php echo $token; ?>&order_id=<?php echo $order_id; ?>',
		type: 'post',
		dataType: 'json',
		beforeSend: function() {
			$('#reward').after('<img src="view/image/loading.gif" class="loading" style="padding-left: 5px;" />');
		},
		complete: function() {
			$('.loading').remove();
		},				
		success: function(json) {
			$('.success, .warning').remove();
						
			if (json['error']) {
				$('.box').before('<div class="warning" style="display: none;">' + json['error'] + '</div>');
				
				$('.warning').fadeIn('slow');
			}
			
			if (json['success']) {
                $('.box').before('<div class="success" style="display: none;">' + json['success'] + '</div>');
				
				$('.success').fadeIn('slow');
				
				$('#reward').html('<b>[</b> <a id="reward-add"><?php echo $text_reward_add; ?></a> <b>]</b>');
			}
		}
	});
});

$('#history .pagination a').live('click', function() {
	$('#history').load(this.href);
	
	return false;
});			

$('#history').load('index.php?route=sale/order/history&token=<?php echo $token; ?>&order_id=<?php echo $order_id; ?>');

$('#button-history').live('click', function() {
	$.ajax({
		url: 'index.php?route=sale/order/history&token=<?php echo $token; ?>&order_id=<?php echo $order_id; ?>',
		type: 'post',
		dataType: 'html',
		data: 'order_status_id=' + encodeURIComponent($('select[name=\'order_status_id\']').val()) + '&notify=' + encodeURIComponent($('input[name=\'notify\']').attr('checked') ? 1 : 0) + '&append=' + encodeURIComponent($('input[name=\'append\']').attr('checked') ? 1 : 0) + '&comment=' + encodeURIComponent($('textarea[name=\'comment\']').val()),
		beforeSend: function() {
			$('.success, .warning').remove();
			$('#button-history').attr('disabled', true);
			$('#history').prepend('<div class="attention"><img src="view/image/loading.gif" alt="" /> <?php echo $text_wait; ?></div>');
		},
		complete: function() {
			$('#button-history').attr('disabled', false);
			$('.attention').remove();
		},
		success: function(html) {
			$('#history').html(html);
			
			$('textarea[name=\'comment\']').val('');
			
			$('#order-status').html($('select[name=\'order_status_id\'] option:selected').text());
		}
	});
});
//--></script> 
<script type="text/javascript"><!--
$('.vtabs a').tabs();
//--></script> 
<?php echo $footer; ?>
