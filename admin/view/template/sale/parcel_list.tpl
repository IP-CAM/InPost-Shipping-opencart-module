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
  <?php if ($success) { ?>
  <div class="success"><?php echo $success; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/order.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons">
         <a onclick="$('#form').attr('action', '<?php echo $create; ?>'); $('#form').attr('target', '_self'); $('#form').submit();" class="button"><?php echo $button_create; ?></a>
         <a onclick="$('#form').attr('action', '<?php echo $cancel; ?>'); $('#form').attr('target', '_self'); $('#form').submit();" class="button"><?php echo $button_cancel; ?></a>
         <a onclick="$('#form').attr('action', '<?php echo $labels; ?>'); $('#form').attr('target', '_self'); $('#form').submit();" class="button"><?php echo $button_labels; ?></a>
       </div>
    </div>
    <div class="content">
      <form action="" method="post" enctype="multipart/form-data" id="form">
        <table class="list">
          <thead>
            <tr>
              <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
              <td class="right"><?php if ($sort == 'order_id') { ?>
                <a href="<?php echo $sort_order; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_order_id; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_order; ?>"><?php echo $column_order_id; ?></a>
                <?php } ?></td>
              <td class="left"><?php if ($sort == 'parcel_id') { ?>
                <a href="<?php echo $sort_parcel_id; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_parcel_id; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_parcel_id; ?>"><?php echo $column_parcel_id; ?></a>
                <?php } ?></td>
              <td class="left"><?php if ($sort == 'parcel_status') { ?>
                <a href="<?php echo $sort_parcel_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_parcel_status; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_parcel_status; ?>"><?php echo $column_parcel_status; ?></a>
                <?php } ?></td>
              <td><?php if ($sort == 'target_machine_id') { ?>
                <a href="<?php echo $sort_target_machine_id; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_target_machine_id; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_target_machine_id; ?>"><?php echo $column_target_machine_id; ?></a>
                <?php } ?></td>
              <td class="left"><?php if ($sort == 'creation_date') { ?>
                <a href="<?php echo $sort_creation_date; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_creation_date; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_creation_date; ?>"><?php echo $column_creation_date; ?></a>
                <?php } ?></td>
		<td class="left"> <?php echo $column_file_name; ?> </td>
              <td class="left"><?php if ($sort == 'sticker_creation_date') { ?>
                <a href="<?php echo $sort_sticker_creation_date; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_sticker_creation_date; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_sticker_creation_date; ?>"><?php echo $column_sticker_creation_date; ?></a>
                <?php } ?></td>
              <td class="right"><?php echo $column_action; ?></td>
            </tr>
          </thead>
          <tbody>
            <tr class="filter">
              <td></td>
              <td align="right"><input type="text" name="filter_order_id" value="<?php echo $filter_order_id; ?>" size="4" style="text-align: right;" /></td>
              <td><input type="text" name="filter_parcel_id" value="<?php echo $filter_parcel_id; ?>" /></td>
              <td>
                <select name="filter_parcel_status">
                  <option value="*"> </option>
                  <?php foreach ($parcel_statuses as $key => $status): ?>
                  <?php if ($filter_parcel_status == $key): ?>
                  <option value="$key" selected="selected"><?php echo $status; ?></option>
                  <?php else: ?>
                  <option value="<?php echo $key; ?>"><?php echo $status; ?></option>
                  <?php endif; ?>
                  <?php endforeach; ?>
                </select>
              </td>
              <td><input type="text" name="filter_target_machine_id" value="<?php echo $filter_target_machine_id; ?>" /></td>
              <td><input type="text" name="filter_creation_date" value="<?php echo $filter_creation_date; ?>" size="12" class="date" /></td>
		<td>&nbsp;</td>
              <td><input type="text" name="filter_sticker_creation_date" value="<?php echo $filter_sticker_creation_date; ?>" size="12" class="date" /></td>
              <td align="right"><a onclick="filter();" class="button"><?php echo $button_filter; ?></a></td>
            </tr>
            <?php if (isset($orders) && $orders) { ?>
            <?php foreach ($orders as $order) { ?>
            <tr>
              <td style="text-align: center;"><?php if ($order['selected']) { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $order['order_id']; ?>" checked="checked" />
                <?php } else { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $order['order_id']; ?>" />
                <?php } ?></td>
              <td class="right"><?php echo $order['order_id']; ?></td>
              <td class="left"><?php echo $order['parcel_id']; ?></td>
              <td class="left"><?php echo $order['parcel_status']; ?></td>
              <td class="left"><?php echo $order['parcel_target_machine_id']; ?></td>
              <td class="left"><?php echo $order['creation_date']; ?></td>
              <td class="left"><?php echo $order['file_name']; ?></td>
              <td class="left"><?php echo $order['sticker_creation_date']; ?></td>
              <td class="right"><?php foreach ($order['action'] as $action) { ?>
                [ <a href="<?php echo $action['href']; ?>"><?php echo $action['text']; ?></a> ]
                <?php } ?></td>
            </tr>
            <?php } ?>
            <?php } else { ?>
            <tr>
              <td class="center" colspan="8"><?php echo $text_no_results; ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </form>
      <div class="pagination"><?php echo $pagination; ?></div>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
function filter() {
	url = 'index.php?route=sale/inpost_parcel&token=<?php echo $token; ?>';

	var filter_order_id = $('input[name=\'filter_order_id\']').attr('value');

	if (filter_order_id) {
		url += '&filter_order_id=' + encodeURIComponent(filter_order_id);
	}

	var filter_parcel_id = $('input[name=\'filter_parcel_id\']').attr('value');

	if (filter_parcel_id) {
		url += '&filter_parcel_id=' + encodeURIComponent(filter_parcel_id);
	}

	var filter_target_machine_id = $('input[name=\'filter_target_machine_id\']').attr('value');

	if (filter_target_machine_id) {
		url += '&filter_target_machine_id=' + encodeURIComponent(filter_target_machine_id);
	}

	var filter_parcel_status = $('select[name=\'filter_parcel_status\']').attr('value');

	if (filter_parcel_status != '*') {
		url += '&filter_parcel_status=' + encodeURIComponent(filter_parcel_status);
	}

	var filter_creation_date = $('input[name=\'filter_creation_date\']').attr('value');

	if (filter_creation_date) {
		url += '&filter_creation_date=' + encodeURIComponent(filter_creation_date);
	}

	var filter_sticker_creation_date = $('input[name=\'filter_sticker_creation_date\']').attr('value');

	if (filter_sticker_creation_date) {
		url += '&filter_sticker_creation_date=' + encodeURIComponent(filter_sticker_creation_date);
	}

	location = url;
}
//--></script>  
<script type="text/javascript"><!--
$(document).ready(function() {
	$('.date').datepicker({dateFormat: 'yy-mm-dd'});
});
//--></script> 
<script type="text/javascript"><!--
$('#form input').keydown(function(e) {
	if (e.keyCode == 13) {
		filter();
	}
});
//--></script> 
<script type="text/javascript"><!--
$.widget('custom.catcomplete', $.ui.autocomplete, {
	_renderMenu: function(ul, items) {
		var self = this, currentCategory = '';
		
		$.each(items, function(index, item) {
			if (item.category != currentCategory) {
				ul.append('<li class="ui-autocomplete-category">' + item.category + '</li>');
				
				currentCategory = item.category;
			}
			
			self._renderItem(ul, item);
		});
	}
});

$('input[name=\'filter_customer\']').catcomplete({
	delay: 0,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=sale/customer/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						category: item.customer_group,
						label: item.name,
						value: item.customer_id
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		$('input[name=\'filter_customer\']').val(ui.item.label);
						
		return false;
	},
	focus: function(event, ui) {
      	return false;
   	}
});

//--></script> 
<?php echo $footer; ?>
