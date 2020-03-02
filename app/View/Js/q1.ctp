<div class="alert  ">
<button class="close" data-dismiss="alert"></button>
Question: Advanced Input Field</div>

<p>
1. Make the Description, Quantity, Unit price field as text at first. When user clicks the text, it changes to input field for use to edit. Refer to the following video.

</p>


<p>
2. When user clicks the add button at left top of table, it wil auto insert a new row into the table with empty value. Pay attention to the input field name. For example the quantity field

<?php echo htmlentities('<input name="data[1][quantity]" class="">')?> ,  you have to change the data[1][quantity] to other name such as data[2][quantity] or data["any other not used number"][quantity]

</p>



<div class="alert alert-success">
<button class="close" data-dismiss="alert"></button>
The table you start with</div>

<table id="mytable" class="table table-striped table-bordered table-hover">
<thead>
<th><span id="add_item_button" class="btn mini green addbutton" onclick="addToObj=false">
											<i class="icon-plus"></i></span></th>
<th>Description</th>
<th>Quantity</th>
<th>Unit Price</th>
</thead>

<tbody>
	<tr>
	<!-- data-name="description" data-editable -->
	<td></td>
	<td data-editable id='button0'><input type='text' class='name' name="data[][quantity]" id='name_1' ></td>
	<td data-editable id='button0'><input type='text' class='name' name="data[][unit_price]" id='quantity_1' ></td>
	<td data-editable id='button0'><input type='text' class='name' name="data[][description]" id='description_1' ></td>

	
</tr>

</tbody>

</table>


<p></p>
<div class="alert alert-info ">
<button class="close" data-dismiss="alert"></button>
Video Instruction</div>

<p style="text-align:left;">
<video width="78%"   controls>
  <source src="/video/q3_2.mov">
Your browser does not support the video tag.
</video>
</p>





<?php $this->start('script_own');?>
<script>
$(document).ready(function(){
	var new_id = 1;
	// $("#add_item_button").click(function(){
	// 	alert("suppose to add a new row");
	// });

	$('body').on('click', '[data-editable]', function () {
		var $el = $(this);
		var name_attr_no = $(this).find('.name').attr('name');
		var name_attr_index = name_attr_no.replace("data[]", "data["+new_id+"]");
		$(this).find('.name').attr('name',name_attr_index);

		var $input = $('<textarea  style="width: 98%;"></textarea>').val($el.text());
		$el.replaceWith($input);
		var save = function () {
			var $p = $('<td data-editable id='+new_id+'>').append("<input type='text' class='name' name="+name_attr_index+" value="+$input.val()+"></td>");
			$input.replaceWith($p);
		};

		/**
			We're defining the callback with `one`, because we know that
			the element will be gone just after that, and we don't want 
			any callbacks leftovers take memory. 
			Next time `p` turns into `input` this single callback 
			will be applied again.
		*/
		$input.one('blur', save).focus();

	});
	//add new row
	$("#add_item_button").click(function () {
		var id = $(this).children().data('id');
		new_id += 1;
     $("#mytable").each(function () {
         var tds = '<tr>';
         jQuery.each($('tr:last td', this), function () {
             tds += '<td data-editable id=button'+new_id+'>' + $(this).html() + '</td>';
						//  $(this).find('input.name').removeAttr('value');
         });
         tds += '</tr>';
         if ($('tbody', this).length > 0) {
             $('tbody', this).append(tds);
         } else {
             $(this).append(tds);
         }
     });
});
});
</script>
<?php $this->end();?>

