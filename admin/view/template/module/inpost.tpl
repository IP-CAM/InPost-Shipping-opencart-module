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
          <td><input type="text" name="inpost_api_key" placeholder="Your Unique API Key" value="<?php echo $inpost_api_key;?>" size="50" >
	  <?php if($error_api_key) echo '<span class="error">' . $error_api_key . '</span>'; ?>
           </td>
        </tr>
        <tr>
          <td><?php echo $label_api_url; ?> <span class="required">*</span></td>
          <td><input type="text" name="inpost_api_url" placeholder="Normally http://api-uk.easypack24.net/" value="<?php echo $inpost_api_url;?>" size="50" >
	  <?php if($error_api_url) echo '<span class="error">' . $error_api_url . '</span>'; ?>
          </td>
        </tr>
        <tr>
          <td><?php echo $label_max_weight; ?> <span class="required">*</span></td>
          <td><input type="text" name="inpost_max_weight" placeholder="Max Weight (25kg)" value="<?php echo $inpost_max_weight;?>" >
	  <?php if($error_max_weight) echo '<span class="error">' . $error_max_weight . '</span>'; ?>
	  </td>
        </tr>
        <tr>
          <td><?php echo $label_max_sizea; ?> <span class="required">*</span></td>
          <td><input type="text" name="inpost_max_sizea" placeholder="Usually 8x38x64" value="<?php echo $inpost_max_sizea;?>" >
	  <?php if($error_max_sizea) echo '<span class="error">' . $error_max_sizea . '</span>'; ?>
          </td>
        </tr>
        <tr>
          <td><?php echo $label_max_sizeb; ?> <span class="required">*</span></td>
          <td><input type="text" name="inpost_max_sizeb" placeholder="Usually 19x38x64" value="<?php echo $inpost_max_sizeb;?>" >
	  <?php if($error_max_sizeb) echo '<span class="error">' . $error_max_sizeb . '</span>'; ?>
          </td>
        </tr>
        <tr>
          <td><?php echo $label_max_sizec; ?> <span class="required">*</span></td>
          <td><input type="text" name="inpost_max_sizec" placeholder="Usually 41x38x64" value="<?php echo $inpost_max_sizec;?>" >
	  <?php if($error_max_sizec) echo '<span class="error">' . $error_max_sizec . '</span>'; ?>
          </td>
        </tr>
      </table>
    </form>
  </div>
</div>
<script type="text/javascript"><!--
//--></script>
<?php echo $footer; ?>
