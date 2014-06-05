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
    <h1><img src="view/image/module.png" alt="" /> <?php echo $heading_title; ?></h1>
    <div class="buttons"><a onclick="$('#form').submit();" class="button"><span><?php echo $button_save; ?></span></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><span><?php echo $button_cancel; ?></span></a></div>
  </div>
  <div class="content">
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
      <table class="form">
        <tr>
          <td><?php echo $label_api_key; ?> <span class="required">*</span></td>
          <td><input type="text" name="api_key" placeholder="Your Unique API Key" value="<?php echo $api_key;?>" size="50" >
	  <?php if($error_api_key) echo '<span class="error">' . $error_api_key . '</span>'; ?>
           </td>
        </tr>
        <tr>
          <td><?php echo $label_api_url; ?> <span class="required">*</span></td>
          <td><input type="text" name="api_url" placeholder="Normally http://api-uk.easypack24.net/" value="<?php echo $api_url;?>" size="50" >
	  <?php if($error_api_url) echo '<span class="error">' . $error_api_url . '</span>'; ?>
          </td>
        </tr>
        <tr>
          <td><?php echo $label_max_weight; ?> <span class="required">*</span></td>
          <td><input type="text" name="max_weight" placeholder="Max Weight (25kg)" value="<?php echo $max_weight;?>" >
	  <?php if($error_max_weight) echo '<span class="error">' . $error_max_weight . '</span>'; ?>
	  </td>
        </tr>
        <tr>
          <td><?php echo $label_max_sizea; ?> <span class="required">*</span></td>
          <td><input type="text" name="max_sizea" placeholder="Max Size for Small Parcel" value="<?php echo $max_sizea;?>" >
	  <?php if($error_max_sizea) echo '<span class="error">' . $error_max_sizea . '</span>'; ?>
          </td>
        </tr>
        <tr>
          <td><?php echo $label_max_sizeb; ?> <span class="required">*</span></td>
          <td><input type="text" name="max_sizeb" placeholder="Max Size for Medium Parcel" value="<?php echo $max_sizeb;?>" >
	  <?php if($error_max_sizeb) echo '<span class="error">' . $error_max_sizeb . '</span>'; ?>
          </td>
        </tr>
        <tr>
          <td><?php echo $label_max_sizec; ?> <span class="required">*</span></td>
          <td><input type="text" name="max_sizec" placeholder="Max Size for Large Parcel" value="<?php echo $max_sizec;?>" >
	  <?php if($error_max_sizec) echo '<span class="error">' . $error_max_sizec . '</span>'; ?>
          </td>
        </tr>
        <tr>
          <td><?php echo $label_price; ?> <span class="required">*</span></td>
          <td><input type="text" name="price" placeholder="Cost for one parcel" value="<?php echo $price;?>" >
	  <?php if($error_price) echo '<span class="error">' . $error_price . '</span>'; ?>
          </td>
        </tr>
      </table>
    </form>
  </div>
</div>
<script type="text/javascript"><!--
var module_row = <?php echo $module_row; ?>;

function addModule()
{	
	html  = '<tbody id="module-row' + module_row + '">';
	html += '  <tr>';
	html += '    <td class="left"><input type="text" name="inpost_module[' + module_row + '][limit]" value="5" size="1" /></td>';
	html += '    <td class="left"><input type="text" name="inpost_module[' + module_row + '][image_width]" value="80" size="3" /> <input type="text" name="inpost_module[' + module_row + '][image_height]" value="80" size="3" /></td>';		
	html += '    <td class="left"><select name="inpost_module[' + module_row + '][layout_id]">';
	<?php foreach ($layouts as $layout) { ?>
	html += '      <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>';
	<?php } ?>
	html += '    </select></td>';
	html += '    <td class="left"><select name="inpost_module[' + module_row + '][position]">';
	html += '      <option value="content_top"><?php echo $text_content_top; ?></option>';
	html += '      <option value="content_bottom"><?php echo $text_content_bottom; ?></option>';
	html += '      <option value="column_left"><?php echo $text_column_left; ?></option>';
	html += '      <option value="column_right"><?php echo $text_column_right; ?></option>';
	html += '    </select></td>';
	html += '    <td class="left"><select name="inpost_module[' + module_row + '][status]">';
    html += '      <option value="1" selected="selected"><?php echo $text_enabled; ?></option>';
    html += '      <option value="0"><?php echo $text_disabled; ?></option>';
    html += '    </select></td>';
	html += '    <td class="right"><input type="text" name="inpost_module[' + module_row + '][sort_order]" value="" size="3" /></td>';
	html += '    <td class="left"><a onclick="$(\'#module-row' + module_row + '\').remove();" class="button"><span><?php echo $button_remove; ?></span></a></td>';
	html += '  </tr>';
	html += '</tbody>';
	
	$('#module tfoot').before(html);
	
	module_row++;
}
//--></script>
<?php echo $footer; ?>
