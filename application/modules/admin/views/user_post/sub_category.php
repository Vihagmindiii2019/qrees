<div class="form-group">
	<label>Sub Categories</label>
	<select class='custom-select form-control js-example-basic-multiple5' name='sub_category[]' id='sub_category' multiple='multiple'>
	<?php 
		if(!empty($subcategoryData)){
	      foreach ($subcategoryData as $key => $value){ ?>
	       <option <?php if (in_array($value->categoryId, $subSelected)){ echo 'selected'; }?> value="<?php echo $value->categoryId ?>"> <?php echo $value->category_name; ?> </option>
	      <?php } 
	  	}
	 ?>                      
	</select>
</div>
<script type="text/javascript">
	$(document).ready(function() {
    $('.js-example-basic-multiple5').select2({
      placeholder: "Select sub categories",
      allowClear: true
    });
});
</script>