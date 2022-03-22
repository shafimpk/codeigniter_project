<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Unlimited selectbox subcategories with codeigniter</title>
	<meta name="description" content="The small framework with powerful features">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>

<div class="container pt-100" id="app">
	<div class="row pt-4">
		<div class="col-md-12">
			<select class="form-select" onchange="selected(this)">
			<option value="">select main category</option>
				<?php foreach($items as $item){	?> 	
					<option value="<?php echo $item->id; ?>" ><?php echo $item->select_item; ?></option>
					<?php } ?>
			</select>
			 
		</div>
	</div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>

	function selected(selected)
	{
	let id = selected.value;
	
		$.ajax({
    url: "http://codeigniter.test/public/home/getchildren/"+id,
    type: 'GET',
    success: function(response) {

		var html = `<div class="row pt-2"><div class="col-md-12"><select class="form-select" onchange="selected(this)">`;
		html+=`<option value="">select subcategory</option>`;
		 $.each(response, function(k, v) {
			html+=  `<option value="`+v.id+`">`+v.item+`</option>`;
		 });

		 html+= `</select></div></div>`;

		 $('#app').append(html);


}
	});	
}
	
</script>

</body>
</html>