<?php ob_start();

add_shortcode( 'searchbar', 'search_bar' );

function search_bar(){
	?>
<div id="Top_Search_Block">
	<form id="adtpsearchform" name="adtpsearchform" method="post" action="<?php echo site_url(); ?>/advanced-search">
	<div class="header_search">
		<div class="dropdown">
			<select name="adtpsearch-option">
				<option value="buy" selected="selected">Buy</option>
				<option value="sell">Sell</option>
			</select>
			<input type="hidden" name="frm_search" value="top_frm" />
		</div>
		<div class="search-div">
			<input type="text" name="search" <?php if (isset($_POST['search'])) echo 'value="'.$_POST['search'].'"'; ?> placeholder="Enter your ISBN, Course Code, Book title, author, or keywords" />
			<input type="submit" name="adtpsearch" value="submit"/>
		</div>
	</div>
	</form>
</div>
<?php
}

add_shortcode( 'buybooksearch', 'buybook_search' );

function buybook_search(){
	?>
<div class="buysearch-wrap">
	<form id="buysearchform" name="buysearchform" method="post" action="<?php echo site_url(); ?>/advanced-search">
		<table cellpadding="0" cellspacing="0" border="0" style="border:none; width:100%; !important; margin: 0 auto;" >
            <tr class="form-field">
                <td colspan="2"><input type="text" <?php if (isset($_POST['book_title'])) echo 'value="'.$_POST['book_title'].'"'; ?> name="book_title" placeholder="Book Title" class="book_title"></td>
            </tr>
			<tr class="form-field form-required">
                <td><input type="text" <?php if (isset($_POST['isn'])) echo 'value="'.$_POST['isn'].'"'; ?> name="isn" placeholder="ISBN"/></td>
				<td><input type="text" <?php if (isset($_POST['edition'])) echo 'value="'.$_POST['edition'].'"'; ?> name="edition" placeholder="Edition"></td>
            </tr>
			<tr class="form-field">
                <td><input type="text" <?php if (isset($_POST['author'])) echo 'value="'.$_POST['author'].'"'; ?> name="author" placeholder="Author"></td>
				<td><input type="text" <?php if (isset($_POST['course_code'])) echo 'value="'.$_POST['course_code'].'"'; ?> name="course_code" placeholder="Course Code"></td>
            </tr>
			<input type="hidden" name="frm_search" value="ad_frm" />
		</table>
		<p style="margin:0 auto; width:20%;">
           	<input id="buysearch" class="button button-primary cs-button normal yellow" type="submit" value="Advanced Search" name="buysearch">
		</p>

	</form>
</div>
<?php
}



add_shortcode( 'advancedsearch', 'advanced_search' );


	function advanced_search()
	{

		$url = site_url();

		$sellbook = $url.'/sell-books';

		//echo '<h2>Advanced Search</h2>';

		if($_POST['adtpsearch-option'] == 'sell'){
			wp_redirect( $sellbook , 301 );
			exit;

		}


		if(!isset($_POST['adsearch']) and !isset($_POST['adtpsearch']) and !isset($_POST['buysearch'])){
			//echo '<h4 class="adtitle">Refine your search by completing one or more of the fields below:</h4>';


		?>
		<script type="text/javascript">
				function adsearch_validation()
				{
					var x1=document.forms["adsearchform"]["isn"];
					var x2=document.forms["adsearchform"]["book_title"];
					var x3=document.forms["adsearchform"]["edition"];
					var x4=document.forms["adsearchform"]["author"];
					var x5=document.forms["adsearchform"]["course_code"];

					if (x1.value==null || x1.value=="")
					{
					  alert("ISBN must be filled out");
					  x1.focus(); // set the focus to this input
					  return false;
					}

					if (x2.value==null || x2.value=="")
					{
					  alert("Book Title must be filled out");
					  x2.focus(); // set the focus to this input
					  return false;
					}

					if (x3.value==null || x3.value=="")
					{
					  alert("Edition must be filled out");
					  x3.focus(); // set the focus to this input
					  return false;
					}

					if (x4.value==null || x4.value=="")
					{
					  alert("Author must be filled out");
					  x4.focus(); // set the focus to this input
					  return false;
					}

					if (x5.value==null || x5.value=="")
					{
					  alert("Course Code must be filled out");
					  x5.focus(); // set the focus to this input
					  return false;
					}

					//alert('Thank you for Submit Details!');

				}


        </script>

	<?php
		}
		else{
		global $wpdb,$woocommerce, $product,$post;

		$optsearch = $_POST['adtpsearch-option'];
		$search = $_POST['search'];
		$isbn = $_POST['isn'];
		$btitle = $_POST['book_title'];
		$edition = $_POST['edition'];
		$author = $_POST['author'];
		$ccode = $_POST['course_code'];
	    $frm_search = $_POST['frm_search'];


		if($isbn != NULL or $search != NULL){

			$where = " WHERE meta_key='_sku' and meta_value LIKE '%".$isbn.$search."%' ORDER BY post_id ASC";
			$all_rec_q = "SELECT post_id FROM ".$wpdb->prefix."postmeta".$where ;
			$hswp_tables = $wpdb->get_results($all_rec_q);

			$i=0;
			foreach ( $hswp_tables as $allpid )
			{
				$pid = $allpid->post_id;
				$p_arry[$i] = $pid;
				$i++;
			}

			$f1 = $p_arry;

			$new = implode(",",$p_arry);
			//print '$new: '.$new.'<br/>';
		}

	if($btitle != NULL or $search != NULL){

		if($isbn != NULL){ $isbn_value = "ID IN(".$new.") and"; }

		$results_products = $wpdb->get_results("SELECT ID FROM ".$wpdb->prefix."posts WHERE  ".$isbn_value." post_title LIKE '%".$btitle.$search."%' AND post_type='product' AND post_status='publish' ORDER BY post_title ASC");
		//$total = count($results_products);
		$i=0;
		if ($results_products) {

			foreach($results_products as $product_data) {
				$pid = $product_data->ID;
				$post_arry[$i] = $pid;
				$i++;
			}

			$f2 = $post_arry;

			$new2 = implode(",",$post_arry);
			//print 'Book Title $new2: '.$new2.'<br/>';
		}

	}


			$where4 = " WHERE taxonomy IN(('pa_edition'),('pa_author-name'),('pa_course-code'),('pa_isbn-10'),('pa_isbn-13')) ORDER BY term_id ASC";
			//$where = " WHERE taxonomy IN(".$edition_atr.$author_atr.$ccode_atr.$search_atr.") ORDER BY term_id ASC";
			$all_rec_q = "SELECT term_taxonomy_id FROM ".$wpdb->prefix."term_taxonomy".$where4 ;
			$hswp_tables = $wpdb->get_results($all_rec_q);

			$i=0;
			foreach ( $hswp_tables as $allpid )
			{
				$tid = $allpid->term_taxonomy_id;
				$t_arry[$i] = $tid;
				$i++;
			}
			$new3 = implode(",",$t_arry);
			//print '$new3: '.$new3.'<br/>';



	if($isbn!= NULL or $edition != NULL or $author != NULL or $ccode != NULL or $search != NULL){


			//print $words = $author.' '.$edition.' '.$ccode.' '.$search;
			//$parts = explode(" ",trim($words));

			/*$clauses=array();
			foreach ($parts as $part){
				//function_description in my case ,  replace it with whatever u want in ur table
				$clauses[]="name LIKE '%" . mysql_real_escape_string($part) . "%'";
			}*/


			if($isbn != Null){
				$clauses1=array();
				$clauses1[]="name LIKE '%" . mysql_real_escape_string($isbn) . "%'";
				$clause=implode(' OR ' ,$clauses1);

				/*First Step*/
				/*$where5 = " WHERE term_id IN(".$new3.") AND ($clause)  ORDER BY term_id ASC";*/
				$where5 = " WHERE $clause ORDER BY term_id ASC";
				$all_rec_q = "SELECT term_id FROM ".$wpdb->prefix."terms".$where5 ;
				$hswp_tables5 = $wpdb->get_results($all_rec_q);
				$i=0;
				foreach ( $hswp_tables5 as $allpid )
				{
					$tid = $allpid->term_id;
					$t_arry5[$i] = $tid;
					$i++;
				}
				$new4 = implode(",",$t_arry5);
				//print 'Attribute $new4: '.$new4.'<br/>';

				/*First Step*/

				/*Second Step*/
				$where7 = " WHERE term_id IN(".$new4.") ORDER BY term_id ASC";
				$all_rec_q = "SELECT term_taxonomy_id FROM ".$wpdb->prefix."term_taxonomy".$where7 ;
				$hswp_tables7 = $wpdb->get_results($all_rec_q);
				$i=0;
				foreach ( $hswp_tables7 as $allpid )
				{
					$tid = $allpid->term_taxonomy_id;
					$t_arry7[$i] = $tid;
					$i++;
				}
				$taxo = implode(",",$t_arry7);
				//print '$taxo: '.$taxo.'<br/>';
				/*Second Step*/

				/*Third Step*/
				//if($isbn != NULL or $search != NULL and $new != NULL){ $isbn_value2 = "and object_id IN('".$new."')"; }
				$where6 = " WHERE term_taxonomy_id IN(".$taxo.") ".$isbn_value2."  ORDER BY object_id ASC";
				$all_rec_q = "SELECT DISTINCT object_id  FROM ".$wpdb->prefix."term_relationships".$where6 ;
				$hswp_tables6 = $wpdb->get_results($all_rec_q);

				$i=0;
				foreach ( $hswp_tables6 as $allpid )
				{
					$product_id = $allpid->object_id;
					$t_arry6[$i] = $product_id;
					$i++;
				}
				$f7 = $t_arry6;
				$new5 = implode(",",$t_arry6);
			}


			if($edition != Null){
				$clauses1=array();
				$clauses1[]="name LIKE '%" . mysql_real_escape_string($edition) . "%'";
				$clause=implode(' OR ' ,$clauses1);

				/*First Step*/
				/*$where5 = " WHERE term_id IN(".$new3.") AND ($clause)  ORDER BY term_id ASC";*/
				$where5 = " WHERE $clause ORDER BY term_id ASC";
				$all_rec_q = "SELECT term_id FROM ".$wpdb->prefix."terms".$where5 ;
				$hswp_tables5 = $wpdb->get_results($all_rec_q);
				$i=0;
				foreach ( $hswp_tables5 as $allpid )
				{
					$tid = $allpid->term_id;
					$t_arry5[$i] = $tid;
					$i++;
				}
				$new4 = implode(",",$t_arry5);
				//print 'Attribute $new4: '.$new4.'<br/>';

				/*First Step*/

				/*Second Step*/
				$where7 = " WHERE term_id IN(".$new4.") ORDER BY term_id ASC";
				$all_rec_q = "SELECT term_taxonomy_id FROM ".$wpdb->prefix."term_taxonomy".$where7 ;
				$hswp_tables7 = $wpdb->get_results($all_rec_q);
				$i=0;
				foreach ( $hswp_tables7 as $allpid )
				{
					$tid = $allpid->term_taxonomy_id;
					$t_arry7[$i] = $tid;
					$i++;
				}
				$taxo = implode(",",$t_arry7);
				//print '$taxo: '.$taxo.'<br/>';
				/*Second Step*/

				/*Third Step*/
				if($isbn != NULL or $search != NULL and $new != NULL){ $isbn_value2 = "and object_id IN('".$new."')"; }
				$where6 = " WHERE term_taxonomy_id IN(".$taxo.") ".$isbn_value2."  ORDER BY object_id ASC";
				$all_rec_q = "SELECT DISTINCT object_id  FROM ".$wpdb->prefix."term_relationships".$where6 ;
				$hswp_tables6 = $wpdb->get_results($all_rec_q);

				$i=0;
				foreach ( $hswp_tables6 as $allpid )
				{
					$product_id = $allpid->object_id;
					$t_arry6[$i] = $product_id;
					$i++;
				}
				$f3 = $t_arry6;
				$new5 = implode(",",$t_arry6);
			}


			if($author != Null){
				$clauses2=array();
				$clauses2[]="name LIKE '%" . mysql_real_escape_string($author) . "%'";
				$clause=implode(' OR ' ,$clauses2);

				/*First Step*/
				/*$where5 = " WHERE term_id IN(".$new3.") AND ($clause)  ORDER BY term_id ASC";*/
				$where5 = " WHERE $clause ORDER BY term_id ASC";
				$all_rec_q = "SELECT term_id FROM ".$wpdb->prefix."terms".$where5 ;
				$hswp_tables5 = $wpdb->get_results($all_rec_q);
				$i=0;
				foreach ( $hswp_tables5 as $allpid )
				{
					$tid = $allpid->term_id;
					$t_arry5[$i] = $tid;
					$i++;
				}
				$new4 = implode(",",$t_arry5);
				//print 'Attribute $new4: '.$new4.'<br/>';

				/*First Step*/

				/*Second Step*/
				$where7 = " WHERE term_id IN(".$new4.") ORDER BY term_id ASC";
				$all_rec_q = "SELECT term_taxonomy_id FROM ".$wpdb->prefix."term_taxonomy".$where7 ;
				$hswp_tables7 = $wpdb->get_results($all_rec_q);
				$i=0;
				foreach ( $hswp_tables7 as $allpid )
				{
					$tid = $allpid->term_taxonomy_id;
					$t_arry7[$i] = $tid;
					$i++;
				}
				$taxo = implode(",",$t_arry7);
				//print '$taxo: '.$taxo.'<br/>';
				/*Second Step*/

				/*Third Step*/
				if($isbn != NULL or $search != NULL and $new != NULL){ $isbn_value2 = "and object_id IN('".$new."')"; }
				$where6 = " WHERE term_taxonomy_id IN(".$taxo.") ".$isbn_value2."  ORDER BY object_id ASC";
				$all_rec_q = "SELECT DISTINCT object_id  FROM ".$wpdb->prefix."term_relationships".$where6 ;
				$hswp_tables6 = $wpdb->get_results($all_rec_q);

				$i=0;
				foreach ( $hswp_tables6 as $allpid )
				{
					$product_id = $allpid->object_id;
					$t_arry6[$i] = $product_id;
					$i++;
				}
				$f4 = $t_arry6;
				$new5 = implode(",",$t_arry6);
			}




			if($ccode != Null){
				$clauses3=array();
				$clauses3[]="name LIKE '%" . mysql_real_escape_string($ccode) . "%'";
				$clause=implode(' OR ' ,$clauses3);

				/*First Step*/
				/*$where5 = " WHERE term_id IN(".$new3.") AND ($clause)  ORDER BY term_id ASC";*/
				$where5 = " WHERE $clause ORDER BY term_id ASC";
				$all_rec_q = "SELECT term_id FROM ".$wpdb->prefix."terms".$where5 ;
				$hswp_tables5 = $wpdb->get_results($all_rec_q);
				$i=0;
				foreach ( $hswp_tables5 as $allpid )
				{
					$tid = $allpid->term_id;
					$t_arry5[$i] = $tid;
					$i++;
				}
				$new4 = implode(",",$t_arry5);
				//print 'Attribute $new4: '.$new4.'<br/>';

				/*First Step*/

				/*Second Step*/
				$where7 = " WHERE term_id IN(".$new4.") ORDER BY term_id ASC";
				$all_rec_q = "SELECT term_taxonomy_id FROM ".$wpdb->prefix."term_taxonomy".$where7 ;
				$hswp_tables7 = $wpdb->get_results($all_rec_q);
				$i=0;
				foreach ( $hswp_tables7 as $allpid )
				{
					$tid = $allpid->term_taxonomy_id;
					$t_arry7[$i] = $tid;
					$i++;
				}
				$taxo = implode(",",$t_arry7);
				//print '$taxo: '.$taxo.'<br/>';
				/*Second Step*/

				/*Third Step*/
				if($isbn != NULL or $search != NULL and $new != NULL){ $isbn_value2 = "and object_id IN('".$new."')"; }
				$where6 = " WHERE term_taxonomy_id IN(".$taxo.") ".$isbn_value2."  ORDER BY object_id ASC";
				$all_rec_q = "SELECT DISTINCT object_id  FROM ".$wpdb->prefix."term_relationships".$where6 ;
				$hswp_tables6 = $wpdb->get_results($all_rec_q);

				$i=0;
				foreach ( $hswp_tables6 as $allpid )
				{
					$product_id = $allpid->object_id;
					$t_arry6[$i] = $product_id;
					$i++;
				}
				$f5 = $t_arry6;
				$new5 = implode(",",$t_arry6);
			}



			if($search != Null){
				$clauses4=array();
				$clauses4[]="name LIKE '%" . mysql_real_escape_string($search) . "%'";
				$clause=implode(' OR ' ,$clauses4);

				/*First Step*/
				/*$where5 = " WHERE term_id IN(".$new3.") AND ($clause)  ORDER BY term_id ASC";*/
				$where5 = " WHERE $clause ORDER BY term_id ASC";
				$all_rec_q = "SELECT term_id FROM ".$wpdb->prefix."terms".$where5 ;
				$hswp_tables5 = $wpdb->get_results($all_rec_q);
				$i=0;
				foreach ( $hswp_tables5 as $allpid )
				{
					$tid = $allpid->term_id;
					$t_arry5[$i] = $tid;
					$i++;
				}
				$new4 = implode(",",$t_arry5);
				//print 'Attribute $new4: '.$new4.'<br/>';

				/*First Step*/

				/*Second Step*/
				$where7 = " WHERE term_id IN(".$new4.") ORDER BY term_id ASC";
				$all_rec_q = "SELECT term_taxonomy_id FROM ".$wpdb->prefix."term_taxonomy".$where7 ;
				$hswp_tables7 = $wpdb->get_results($all_rec_q);
				$i=0;
				foreach ( $hswp_tables7 as $allpid )
				{
					$tid = $allpid->term_taxonomy_id;
					$t_arry7[$i] = $tid;
					$i++;
				}
				$taxo = implode(",",$t_arry7);
				//print '$taxo: '.$taxo.'<br/>';
				/*Second Step*/

				/*Third Step*/
				if($isbn != NULL or $search != NULL and $new != NULL){ $isbn_value2 = "and object_id IN('".$new."')"; }
				$where6 = " WHERE term_taxonomy_id IN(".$taxo.") ".$isbn_value2."  ORDER BY object_id ASC";
				$all_rec_q = "SELECT DISTINCT object_id  FROM ".$wpdb->prefix."term_relationships".$where6 ;
				$hswp_tables6 = $wpdb->get_results($all_rec_q);

				$i=0;
				foreach ( $hswp_tables6 as $allpid )
				{
					$product_id = $allpid->object_id;
					$t_arry6[$i] = $product_id;
					$i++;
				}
				$f6 = $t_arry6;
				$new5 = implode(",",$t_arry6);
			}




			//print 'object_id $new5: '.$new5.'<br/>';

			/*Third Step*/
	}

		$arrs = array();
		if($f1 != NULL){ $arrs[] = $f1; }
		if($f2 != NULL){ $arrs[] = $f2; }
		if($f3 != NULL){ $arrs[] = $f3; }
		if($f4 != NULL){ $arrs[] = $f4; }
		if($f5 != NULL){ $arrs[] = $f5; }
		if($f6 != NULL){ $arrs[] = $f6; }
		if($f7 != NULL){ $arrs[] = $f7; }

		$list = array();
		foreach($arrs as $arr) {
				if(is_array($arr)) {
					$list = array_merge($list, $arr);
				}
			}

		//echo $numarrs = count($arrs);

		if($frm_search == 'top_frm'){
			foreach($arrs as $arr) {
				if(is_array($arr)) {
					$list = array_merge($list, $arr);
				}
			}
		}
		else{

			if($numarrs > 1){
				$list = call_user_func_array('array_intersect',$arrs);
			}
			else{
				foreach($arrs as $arr) {
					if(is_array($arr)) {
						$list = array_merge($list, $arr);
					}
				}
			}
		}


		$fresult = implode(",",$list);

		//print '$fresult: '.$fresult.'<br/>';

		$fwhere = " WHERE ID IN(".$fresult.") and post_type='product' AND post_status='publish' ORDER BY ID ASC";
		$fall_rec_q = "SELECT DISTINCT ID  FROM ".$wpdb->prefix."posts".$fwhere ;
		$fhswp_tables = $wpdb->get_results($fall_rec_q);

		$total = count($fhswp_tables);

		if($total==0){
			print do_shortcode('[gravityform id=1 title=false description=false ajax=true tabindex=49]');
		}
		else{
			echo '<div class="total-records"><p>';

			//$searchwords = $isbn.$btitle.$edition.$author.$ccode.$search;
			//$fsearch = implode(",",$searchwords);
			//echo 'Showing all results for your search: '.'<span>'.$fsearch.'</span>'.'<br/><br/>';
			echo 'Showing all results for your search: '.'<span>'.$isbn.' '.$btitle.' '.$edition.' '.$author.' '.$ccode.' '.$search.'</span>'.'<br/><br/>';
			echo '</p></div>';
		}



						if($hswp_tables6[$j]->object_id != null){
							$final_id = $hswp_tables6[$j]->object_id;
						}
						elseif($new2 != null){
							$final_id = $hswp_tables6[$j]->object_id.$new2;
						}
						else{
							$final_id = $hswp_tables6[$j]->object_id.$new;
						}


					$arr_ids = explode(",",trim($final_id));






		$c=0;

		for($j=0; $j <$total; $j++)

		{ $c++;

		//$product = get_product( $post->ID );
		$product = get_product( $fhswp_tables[$j]->ID );
		$avatar = WC_Predictive_Search::woops_get_product_thumbnail($fhswp_tables[$j]->ID,'shop_catalog',64,64);

		/*echo '<pre>';
		print_r($product);
		echo '</pre>';*/

		?>

<!------  my  custom--------->



   <div  class="search_container">
     	<div class="search_content" >
	        <div class="book_pic" >
	      	    <a href="<?php print $product->post->guid; ?>"><?php echo $avatar; ?></a>
			</div>

			<div class="book_information" >
			    <div  class="book_title">
				    <a href="<?php print $product->post->guid; ?>"><?php print $product->post->post_title; ?></a><br/>
					<?php

					if($product->post->post_excerpt){ ?><p class="short_description"><?php print $product->post->post_excerpt; ?></p><?php } ?>
				</div>

				<div  class="book_metadata">
				    <?php
					$attribute_names = array( 'pa_author-name', 'pa_course-code','pa_edition','pa_isbn-10','pa_isbn-13' ); // Insert attribute names here

					if($product->get_sku() != null){
						echo '<ul>
							<li>
								<span class="heading">ISBN</span>
								<span class="content">'; print $product->get_sku(); echo '</span>';
						echo '</li>';
					}

					foreach ( $attribute_names as $attribute_name ) {
						$taxonomy = get_taxonomy( $attribute_name );

						/*
						if($hswp_tables6[$j]->object_id != null){
							$final_id = $hswp_tables6[$j]->object_id;
						}
						elseif($new2 != null){
							$final_id = $hswp_tables6[$j]->object_id.$new2;
						}
						else{
							$final_id = $hswp_tables6[$j]->object_id.$new;
						}
						*/

						//Basic example of for loop
						/*$fruits = array('apples', 'figs', 'bananas');
						for( $i = 0; $i < count($fruits); $i++ ){
							$fruit = $fruits[$i];
							echo $fruit . "\n";
						}*/






							if ( $taxonomy && ! is_wp_error( $taxonomy ) ) {
								//$terms = wp_get_post_terms( $post->ID, $attribute_name );
								//$terms = wp_get_post_terms( $final_id, $attribute_name );
								$terms = wp_get_post_terms( $fhswp_tables[$j]->ID, $attribute_name );
								$terms_array = array();

								/*echo "<pre>";
								print_r($terms);
								echo "</pre>";*/


								if ( ! empty( $terms ) ) {
									foreach ( $terms as $term ) {
									$archive_link = get_term_link( $term->slug, $attribute_name );
									//$full_line = '<a href="' . $archive_link . '">'. $term->name . '</a>';
									$full_line = $term->name;
									array_push( $terms_array, $full_line );
									}

									echo  "<li>";

									echo  "<span class='heading'>";
									 echo $taxonomy->labels->name ;
									echo "</span>" ;
									echo "<span class='content'>";
								  echo  $c=implode( $terms_array, ', ' );

								 echo "</span>";
									echo "</li>";
								}


							}
					}
					echo '</ul>';

					?>
		        </div>

			</div>

			<div class="book_addtocart" >
			    <div class="book_price">
					<?php if ( $price_html = $product->get_price_html() ) : ?>
					<?php echo '<span>'.$price_html.'</span>'; ?>
					<?php endif; ?>
			    </div>
				<div class="cart_btn">
				    <a href="<?php print $product->post->guid; ?>">Buy Now</a>
				</div>
				<?php $string = $product->post->post_excerpt; ?>
  				<?php preg_match('/us:(.*)/',$string, $matches); ?>


				<div class="book_price">
					<?php
						if (!$matches[1]) {
							echo '<span>N/A</span>';
						} else {
							echo '<span>'.$matches[1].'</span>';
						}
					?>
			    </div>


				<div class="cart_btn sell_btn">

				    <a href="www.tebmart.com/quote">Sell Now</a>
				</div>
			</div>
		</div>
	</div>	<!---  end  search container--->

<?php

		}

	}
}

ob_clean(); ?>
