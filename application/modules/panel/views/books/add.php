<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
	        <div class="box-header with-border">
	          <h3 class="box-title"><?= lang('add_book_title'); ?></h3>
	    	<div class="box-body">
	          <?php echo validation_errors('<div class="alert alert-error">', '</div>');?>
	    		<div class="col-md-6">
	    			<?php $attrib = array('data-toggle' => 'validator', 'role' => 'form'); ?>

		    		<?php echo form_open_multipart('panel/books/add'); ?>
		    		<div class="form-group">
		              	<label class="control-label" for="book_type"><?= lang('add_book_type_title'); ?></label>
		                <?php
		                $opts = array('standard' => 'Standard', 'digital' => 'Digital');
		                echo form_dropdown('type', $opts, set_value('type') , 'class="form-control" id="type" required="required"');
		                ?>
		            </div>
		          	<div class="form-group">
		              	<label class="control-label" for="isbn"><?= lang('add_isbn_label'); ?></label>
		          		<?php echo form_input('isbn', set_value('isbn'),'class="form-control" id="isbn" required="required"'); ?>
		          	</div>
		          	
		          
		          	<div class="form-group">
		              	<label class="control-label" for="book_title"><?= lang('add_book_label'); ?></label>
						<?php echo form_input('book_title', set_value('book_title'),'class="form-control" id="book_title" required="required"');?>
		          	</div>
		          	<div class="form-group">
		              	<label class="control-label" for="category_id"><?= lang('add_category_label'); ?></label>
						<?php
                        $cat[''] = "";
                        if ($categories) {
                        	foreach ($categories as $category) {
                            	$cat[$category->id] = $category->category_name;
                        	}
                        }
                        
                        echo form_dropdown('category_id[]', (isset($cat)) ? $cat : lang('no_cat_label'), set_value('category_id'), 'class="form-control select" id="category_id" required="required" style="width:100%" multiple="multiple" placeholder="'.lang('select_cat_label').'"')
                        ?>
		          	</div>
		          	<div class="form-group">
		              	<label class="control-label" for="author_id"><?= lang('add_author_label'); ?></label>
						<?php
						if ($authors) {
							$aut[''] = "";
	                        foreach ($authors as $author) {
	                            $aut["$author->id"] = $author->author_name;
	                        }
						}
                       
                        echo form_dropdown('author_id[]', (isset($aut)) ? $aut : lang('no_authors_label') , set_value('author_id'), 'class="form-control select" id="author_id" required="required" style="width:100%" multiple="multiple"')
                        ?>
		       	  	</div>

                    <div class="digital" style="display:none;">
                        <div class="form-group digital">
                        	<label for="digital_file"><?= lang('add_digital_file_label'); ?><small>PDF</small></label>         
                            <input id="digital_file" type="file" data-browse-label="Browse" name="digital_file" data-show-upload="false"
                                   data-show-preview="false" class="form-control file">
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="book_image"><?= lang('add_image_label'); ?></label>                        
                        <input id="book_image" type="file" name="book_image" data-show-upload="false" data-show-preview="false" accept="image/*" class="form-control file">
                                  


                    </div>

				</div>
				<div class="col-md-6">
		    		<div class="form-group">
		              	<label class="control-label" for="isbn_13"><?= lang('add_isbn_13_label'); ?></label>

						<?php echo form_input('isbn_13',  set_value('isbn_13'),'class="form-control" id="isbn_13"');?>
		          	</div>
		          	<div class="form-group">
		              	<label class="control-label" for="book_copies"><?= lang('add_qty_label')?></label><!-- 
						<?php echo form_input('book_copies', (isset($_POST['book_copies']) ? $_POST['book_copies'] : ""),'class="form-control" id="book_copies" required="required"');?> -->
						<input type="number" name='book_copies' id='book_copies' step="any" class="form-control" id="book_copies" required="required" min=0 value="<?= set_value('book_copies'); ?>" />

		          	</div>
		           	<div class="form-group">
		              	<label class="control-label" for="book_pub"><?= lang('add_publisher_label'); ?></label>

						<?php echo form_input('book_pub', set_value('book_pub'),'class="form-control" id="book_pub" required="required"');?>
		         	</div>
		         	<div class="form-group">
		              	<label class="control-label" for="price"><?= lang('add_price_label'); ?></label>
						<input type="number" name='price' id='price' step="any" class="form-control" id="price" required="required" min=0 value="<?php echo set_value('price'); ?>" />
		          	</div>
		           	<div class="form-group">
		              	<label class="control-label" for="copyright_year"><?= lang('add_cp_year_label'); ?></label>

						<?php echo form_input('copyright_year', set_value('copyright_year'),'class="form-control" id="copyright_year" required="required"');?>
		          	</div>
		          	<div class="form-group">
		              	<label class="control-label" for="date_receive"><?= lang('add_rd_label'); ?></label>

						<?php echo form_input('date_receive', set_value('date_receive'),'class="form-control" id="date_receive" required="required"');?>
		          	</div>
				</div>
				<?php 
                    $custom_fields = $settings->books_custom_fields;
                    $custom_fields = explode(',', $custom_fields);
                    foreach($custom_fields as $line): 
                ?>
                
                <div class="col-lg-4 col-sm-12">
                    <div class="form-group">
                        <label>
                            <?= $line; ?>
                        </label>
                        <input name="cust_<?= bin2hex($line); ?>" type="text" value="" class="custom validate form-control" />
                    </div>
                </div>
                
                <?php endforeach; ?>
				<div class="col-md-12">
					<div class="form-group">
			          	<label class="control-label" for="description"><?= lang('add_desc_label'); ?></label>
						<?php echo form_textarea('description', (isset($_POST['description']) ? $_POST['description'] : ""),'class="form-control" id="description"');?>
			      	</div>
					<div class="form-group">
						<?php echo form_submit('submit', lang('submit_label'), 'class="form-control" id="submit"'); ?>
				  	</div>
			 		<?php echo form_close() ?>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</section>
<script type="text/javascript">
	$('#type').change(function () {
            var t = $(this).val();
            if (t !== 'digital') {
                $('.digital').slideUp();
                $('#digital_file').removeAttr('required');
                $('form[data-toggle="validator"]').bootstrapValidator('removeField', 'digital_file');
            } else {
                $('.digital').slideDown();
                $('#digital_file').attr('required', 'required');
                $('form[data-toggle="validator"]').bootstrapValidator('addField', 'digital_file');
            }
            
        });

</script><script type="text/javascript">
$(document).ready(function() {
	$(".select").select2();
	$('#date_receive').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd'
    });
    $('#copyright_year').datepicker({
      	autoclose: true,
      	viewMode: "years", 
    	minViewMode: "years",
      	format: 'yyyy'
    });

});
</script>
