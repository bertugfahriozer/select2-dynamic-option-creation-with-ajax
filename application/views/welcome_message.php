<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<title>Select 2 Dynamic option creation with ajax</title>
</head>
</head>
<body>
<div class="container mt-5 pt-5">
	<div class="row">
		<div class="col-4"></div>
		<div class="col-4">
			<form action="<?=base_url('welcome/create_stuff')?>" method="post">
			<select class="form-control select2" name="category">
				<?php foreach($categories as $category):?>
				<option value="<?=$category->id?>"><?=$category->categoryName?></option>
				<?php endforeach;?>
			</select>
				<button type="submit" class="btn btn-primary w-100">
					Gönder
				</button>
			</form>
		</div>
		<div class="col-4"></div>
	</div>
</div>

<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script>
	$(document).ready(function(){

		$('.select2').select2({
			placeholder:'Select Category',
			tags:true,
		}).on('select2:close', function(){
			var element = $(this);
			var new_category = $.trim(element.val());

			if(new_category != '')
			{
				$.ajax({
					url:"<?=base_url('welcome/add_category')?>",
					method:"POST",
					data:{categoryName:new_category},
					success:function(data)
					{
						if(data.result == true)
						{
							element.append('<option value="'+data.new.id+'">'+data.new.categoryName+'</option>').val(data.new.id);
						}
					}
				})
			}

		});

	});
</script>
<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
-->
</body>
</html>
