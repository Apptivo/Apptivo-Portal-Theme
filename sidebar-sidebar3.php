				<div id="sidebar" class="sidebar-offcanvas lftmnu collapse" role="complementary">
				
				
				<div class="side-section">
	<h2>BROWSE BY CATEGORY</h2>
	
	

	
	<div class="nav-side-menu">
  
        <div class="menu-list" id="category">

				<ul id="menu-content" class="bullet" id="bullet">

		<?php 
	$weblayout=getAnswersConfigData()-> webLayout;
	$support_weblayout = json_decode ( $weblayout, true );
	$support_weblayout_sections = $support_weblayout ['sections'];
	//po1($support_weblayout_sections);
	foreach ( $support_weblayout_sections as $layout_sections ) {
		
		$section_attributes = $layout_sections ['attributes'];
		
		foreach ( $section_attributes as $sec_attrivbutes ) {
			//echo '<pre>';print_r($sec_attrivbutes);
			$labe_name = $sec_attrivbutes ['label'] ['modifiedLabel'];
				switch ($labe_name) {
					case 'Category' :
					$case_form_data [$labe_name] = $sec_attrivbutes;
					break;
					case 'Sub-Category' :
					$case_form_data [$labe_name] = $sec_attrivbutes;
					break;
				}
		}
	}
	$ans_category_option_list = $case_form_data ['Category'] ['right'] ['0'] ['optionValueList'];
	$drive_values=$case_form_data['Sub-Category']['value']['criteria'][0]['groups'];
	
// 	po1($drive_values);
	$ans_category_attrid = $case_form_data['Category']['attributeId'];
	$sub_category=array();
	foreach($drive_values as $drive){
		$depen_category_id=$drive['condition']['selectedDrivingValues'][0]['id'];
		$cat_id=$drive['condition']['drivingAttribute']['id'];
		$categories=array();
		foreach ( $ans_category_option_list as $ans_cate ) {
			$ans_category['categoryId']=$ans_cate[optionId];
		$ans_category['categoryName']=$ans_cate[optionObject];
		$categories[]=$ans_category;
			if($ans_category_attrid==$cat_id){
			if($ans_category['categoryId']==$depen_category_id){
				
				
			//$sub_category['categoryId']=$ans_category['categoryId'];
			$sub_category_value=$drive['condition']['selectedAttrDrivingValues'];
		
			$sub_cat_value=$ans_category['categoryName'];
			$sub_cat_values[]=$sub_cat_value;
			}
			}
			
		}
	}
	$sorted_category_values=array();
	$count=sizeof($categories);
	for($i=0;$i<$count;$i++){
    $columns = null;
    foreach ($categories as $index => $element) {
    	
        $columns[] = ucfirst($element['categoryName']);
        
    }
   // echo '<pre>';print_r($columns);echo '</pre>';
    $temp = $categories;
    array_multisort($columns, SORT_ASC, $temp);
    $sorted_category_values = $temp;

	}
	
// 	po1($sorted_category_values);
	foreach($sorted_category_values as $val){
				//echo '<pre>';print_r($val);echo '</pre>';
				//echo '<pre>';print_r($sub_cat_values);echo '</pre>';
	if(!in_array($val['categoryName'],$sub_cat_values)){
	$only_categ=$val['categoryName'];
	$only_category[]=$only_categ;
		?>
		<li class="accredit" id="<?php echo $val['categoryName'];?>" onclick="Dispcategory(this.id);"><a href="#">  <?php echo $val['categoryName'];?></a></li>
		<?php 
	}
	else 
	{
		$cat_value=$val['categoryName'];
		//echo $cat_value;
		$sub_category=array();
	
	foreach($drive_values as $drive){
		//echo '<pre>';print_r($drive);echo '</pre>';
		$depen_category_id=$drive['condition']['selectedDrivingValues'][0]['id'];
		$cat_id=$drive['condition']['drivingAttribute']['id'];
		$i=1;
		$categories=array();
		foreach ( $ans_category_option_list as $ans_cate ) {
		//echo '<pre>';print_r($ans_cate);echo '</pre>';
		$ans_category['categoryId']=$ans_cate[optionId];
		$ans_category['categoryName']=$ans_cate[optionObject];
		$categories[]=$ans_category;
		
		//echo '<pre>';print_r($ans_category);echo '</pre>';
		
		if($ans_category_attrid==$cat_id){
				if($ans_category['categoryId']==$depen_category_id){
			
				
			//$sub_category['categoryId']=$ans_category['categoryId'];
			$sub_category_value=$drive['condition']['selectedAttrDrivingValues'];
			//echo "hai";echo '<br>';
			$sub_cat_value=$ans_category['categoryName'];
			$sub_cat_values[]=$sub_cat_value;
			
			
			if($cat_value==$ans_category['categoryName'])	{
			?>
			
			
			<li data-toggle="collapse" data-target="#sub-menu<?php echo $i;?>"
						class="collapsed active" id="<?php echo $ans_category['categoryName'];?>" onclick="showcat(this.id);" disabled='disabled'><a href="#"><?php echo $ans_category['categoryName']; ?></a></li>
					
				<ul class="sub-menu collapse" id="sub-menu<?php echo $i;?>" style="list-style: none;">	
			<?php 
			
			foreach($sub_category_value as $value){
			//echo '<pre>';print_r($value);echo '</pre>';
			$sub_categoryName=$value['name'];  
			$sub_categoryId=$value['id'];
			//echo $sub_categoryName; 
			?>
						
						<li id="<?php echo $sub_categoryName;?>" onclick="Dispname(this.id);"><a href="#"><?php echo $sub_categoryName;?></a></li>
					
					
			<?php 
			$sub_category=array('id'=>$sub_categoryId,'name'=>$sub_categoryName);
			//$sub_categories[]=$sub_category;
			$sub_category_arr=array('categoryId'=>$ans_category['categoryId'],'categoryName'=>$ans_category['categoryName'],'subVal'=>$sub_category);
				//echo '<pre>';print_r($sub_category_arr);echo '</pre>';
				
			}?>
			</ul>
			
		
		
		<?php 
}
			
			
			}
			
			
			
			
		}
		
		$i++;
		}
		
		
	}
	
		
		
	}
	
	
	
	
	}

	
	?>
	
	
				
				</ul>
				<input type="hidden" id="ParentCategory">
				
			</div>
</div>
	
	</div>
	</div>
	<div id="res"></div>
	
	
	
	

  
<script type="text/javascript">
function showcat(subname){
	$("#ParentCategory").val(subname);
	
}
function Dispname(subname){

	var par_category=$("#ParentCategory").val();
	//alert(par_category);
	 $.ajax(
        {
            type: 'POST',
            url:'<?php echo admin_url('admin-ajax.php'); ?>',
            data: {'action':'view_category',"sub_category":subname,"parent_category":par_category},
           	success:function(data){
           		jQuery("#list").empty();
           		jQuery("#breadcrump").empty();
           		jQuery(".titlebg").empty();
           		jQuery(".titlebg").html("All Articles:"+ subname);
            	jQuery("#que").html(data);
            	jQuery("#articleTitle").html("All Articles:"+ subname);
           	}

        });


}

function Dispcategory(subname){
	$.ajax(
	        {
	            type: 'POST',
	            url:'<?php echo admin_url('admin-ajax.php'); ?>',
	            data: {'action':'view_category',"category":subname},
	           	success:function(data){
	           		jQuery("#list").empty();
	           		jQuery("#breadcrump").empty();
	           		jQuery(".titlebg").empty();
	           		jQuery(".titlebg").html("All Articles:"+ subname);
	            	jQuery("#que").html(data);
	            	jQuery("#articleTitle").html("All Articles:"+ subname);
	           	}

	        });


	}


</script>