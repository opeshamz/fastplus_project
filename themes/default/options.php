<?php 
// prevent direct access
if (!isset($options)) {
die('You Can not Access Directly');	
}
?>
		<div class="page-header page-heading">
            <h1><i class="fa fa-paint-brush"></i> Default Theme Options</h1>
        </div>
		  <ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#basic" aria-controls="basic" role="tab" data-toggle="tab">Basic Options</a></li>
			<li role="presentation"><a href="#fonts" aria-controls="fonts" role="tab" data-toggle="tab">Style Options</a></li>
			<li role="presentation"><a href="#blocks" aria-controls="blocks" role="tab" data-toggle="tab">Extra Options</a></li>
			<li role="presentation"><a href="#mobile" aria-controls="mobile" role="tab" data-toggle="tab">Mobile View Options</a></li>
			<li role="presentation"><a href="#pad" aria-controls="pad" role="tab" data-toggle="tab">Tab View Options</a></li>
		  </ul>

  
  <form role="form" method="POST" action="">
  
  <div class="tab-content">
  <?php if (isset($message)) {echo $message;} ?>
  <div role="tabpanel" class="tab-pane active" id="basic">
		  <div class="form-group">
			<label for="category_news_number">Number Of News In Each Category Page</label>
			<input type="number" name="category_news_number" id="category_news_number" class="form-control" value="<?php echo $options['category_news_number']; ?>" placeholder="12" />
		  </div>
		  <div class="form-group">
			<label for="search_news_number">Number Of News In Each Search results Page</label>
			<input type="number" name="search_news_number" id="search_news_number" class="form-control" value="<?php echo $options['search_news_number']; ?>" placeholder="12" />
		  </div>
		  <div class="form-group">
			<label for="related_news_number">Number Of Related News In Single Article Page</label>
			<select name="related_news_number" id="related_news_number" class="form-control">
			<?php for ($r=1;$r<11;$r++) { ?>
			<option value="<?php echo $r; ?>" <?php if ($options['related_news_number'] == $r) {echo 'SELECTED';} ?>><?php echo $r; ?></option>
			<?php } ?>
			</select>
		  </div>
		  <div class="form-group">
			<label>
			<input type="hidden" name="allow_lazyload" value="0" />
			<input data-toggle="toggle" data-size="mini"  type="checkbox" name="allow_lazyload" id="allow_lazyload" value="1" <?php if (isset($options['allow_lazyload']) AND $options['allow_lazyload'] == 1) {echo 'CHECKED';} ?> /> Allow Image Loading using LazyLoad ?
		    </label>
		  </div>
		  <div class="form-group">
			<label>
			<input type="hidden" name="display_breadcrumb" value="0" />
			<input data-toggle="toggle" data-size="mini"  type="checkbox" name="display_breadcrumb" id="display_breadcrumb" value="1" <?php if (isset($options['display_breadcrumb']) AND $options['display_breadcrumb'] == 1) {echo 'CHECKED';} ?> /> Display BreadCrumbs ?
		    </label>
		  </div>
	</div>
	<div role="tabpanel" class="tab-pane" id="fonts">	
		<div class="form-group">
			<div class="row">
			<div class="col-md-6">
			<label for="heading_font">Heading Font</label>
			<select name="heading_font" id="heading_font" class="form-control">
				<?php 
				$fonts = google_fonts();
				foreach ($fonts AS $key=>$value) {
				?>
					<option value="<?php echo $key; ?>" <?php if (isset($options['heading_font']) AND $options['heading_font'] == $key) {echo 'SELECTED';} ?>><?php echo $value; ?></option>
				<?php				
				}
				?>
			</select>
			</div>
			<div class="col-md-3">
			<label for="heading_font_size">Font Size</label>
			<select name="heading_font_size" id="heading_font_size" class="form-control">
				<?php 
				for ($s=11;$s<41;$s++) {
				?>
					<option value="<?php echo $s; ?>" <?php if (isset($options['heading_font_size']) AND $options['heading_font_size'] == $s) {echo 'SELECTED';} ?>><?php echo $s; ?></option>
				<?php				
				}
				?>
			</select>
			</div>
			<div class="col-md-3">
			<label for="heading_font_weight">Font Weight</label>
			<select name="heading_font_weight" id="heading_font_weight" class="form-control">
					<option value="normal" <?php if (isset($options['heading_font_weight']) AND $options['heading_font_weight'] == 'normal') {echo 'SELECTED';} ?>>Normal</option>
					<option value="bold" <?php if (isset($options['heading_font_weight']) AND $options['heading_font_weight'] == 'bold') {echo 'SELECTED';} ?>>Bold</option>				
			</select>
			</div>
			</div>
			<p class="help">Preview</p>
			<p class="example-header"></p>
			
		  </div>
		  <div class="form-group">
			<div class="row">
			<div class="col-md-6">
			<label for="paragraph_font">Paragraph Font</label>
			<select name="paragraph_font" id="paragraph_font" class="form-control">
				<?php 
				$fonts = google_fonts();
				foreach ($fonts AS $key=>$value) {
				?>
					<option value="<?php echo $key; ?>" <?php if (isset($options['paragraph_font']) AND $options['paragraph_font'] == $key) {echo 'SELECTED';} ?>><?php echo $value; ?></option>
				<?php				
				}
				?>
			</select>
			</div>
			<div class="col-md-3">
			<label for="paragraph_font_size">Font Size</label>
			<select name="paragraph_font_size" id="paragraph_font_size" class="form-control">
				<?php 
				for ($s=11;$s<41;$s++) {
				?>
					<option value="<?php echo $s; ?>" <?php if (isset($options['paragraph_font_size']) AND $options['paragraph_font_size'] == $s) {echo 'SELECTED';} ?>><?php echo $s; ?></option>
				<?php				
				}
				?>
			</select>
			</div>
			<div class="col-md-3">
			<label for="paragraph_font_weight">Font Weight</label>
			<select name="paragraph_font_weight" id="paragraph_font_weight" class="form-control">
					<option value="normal" <?php if (isset($options['paragraph_font_weight']) AND $options['paragraph_font_weight'] == 'normal') {echo 'SELECTED';} ?>>Normal</option>
					<option value="bold" <?php if (isset($options['paragraph_font_weight']) AND $options['paragraph_font_weight'] == 'bold') {echo 'SELECTED';} ?>>Bold</option>				
			</select>
			</div>
			</div>
			<p class="help">Preview</p>
			<p class="example-paragraph"></p>
		  </div>
		</div> 
		<div role="tabpanel" class="tab-pane" id="blocks">
		  <div class="form-group">
			<label>
			<input type="hidden" name="display_featured_image" value="0" />
			<input data-toggle="toggle" data-size="mini" type="checkbox" name="display_featured_image" id="display_featured_image" value="1" <?php if (isset($options['display_featured_image']) AND $options['display_featured_image'] == 1) {echo 'CHECKED';} ?> /> Display Featured Image in Article Page ?
		    </label>
		  </div>
		  <div class="form-group">
			<label>
			<input type="hidden" name="display_megamenu" value="0" />
			<input data-toggle="toggle" data-size="mini" type="checkbox" name="display_megamenu" id="display_megamenu" value="1" <?php if (isset($options['display_megamenu']) AND $options['display_megamenu'] == 1) {echo 'CHECKED';} ?> /> Display Mega Menu ?
		    </label>
		  </div>
		  
		  <div id="display_megamenu_div">
		  <div class="form-group">
			<label for="megamenu_news_number">News Number In Menu</label>
			<select name="megamenu_news_number" id="megamenu_news_number" class="form-control">
				<?php 
				for($t=3;$t<13;$t=$t+3) {
				?>
				<option value="<?php echo $t; ?>" <?php if ($options['megamenu_news_number'] == $t) {echo 'SELECTED';} ?>><?php echo $t; ?></option>
				<?php	
				}
				?>
			</select>
		  </div>
		</div>
		  
		  <div class="form-group">
			<label>
			<input type="hidden" name="display_archive_widget" value="0" />
			<input data-toggle="toggle" data-size="mini" type="checkbox" name="display_archive_widget" id="display_archive_widget" value="1" <?php if (isset($options['display_archive_widget']) AND $options['display_archive_widget'] == 1) {echo 'CHECKED';} ?> /> Display Archive Widget ?
			</label>
		  </div>
		  
		  <div class="form-group">
			<label>
			<input type="hidden" name="display_social_widget" value="0" />
			<input data-toggle="toggle" data-size="mini" type="checkbox" name="display_social_widget" id="display_social_widget" value="1" <?php if (isset($options['display_social_widget']) AND $options['display_social_widget'] == 1) {echo 'CHECKED';} ?> /> Display Social Widget ?
			</label>
		  </div>
		  
		  <div class="form-group">
			<label>
			<input type="hidden" name="display_top_news_widget" value="0" />
			<input data-toggle="toggle" data-size="mini" type="checkbox" name="display_top_news_widget" id="display_top_news_widget" value="1" <?php if (isset($options['display_top_news_widget']) AND $options['display_top_news_widget'] == 1) {echo 'CHECKED';} ?> /> Display Trending News Widget ?
			</label>
		  </div>
		  
		  <div id="display_top_news_div">
		  <div class="form-group">
			<label for="featured_news_content">Trending News Content Type</label>
			<input type="hidden" name="top_news_content_type_rss" value="0" />
			<input type="hidden" name="top_news_content_type_video" value="0" />
			<div>
			<label>
			<input data-toggle="toggle" data-size="mini" type="checkbox" name="top_news_content_type_rss" value="1" <?php if ($options['top_news_content_type_rss'] == 1) {echo 'CHECKED';} ?> /> News
			</label>
			</div>
			<div>
			<label>
			<input data-toggle="toggle" data-size="mini" type="checkbox" name="top_news_content_type_video" value="1" <?php if ($options['top_news_content_type_video'] == 1) {echo 'CHECKED';} ?> /> Video
			</label>
			</div>
			</div>
			<div class="form-group">
			<label for="top_news_days">Trending News (Days Since Publishing)</label>
			<input type="number" name="top_news_days" id="top_news_days" class="form-control" value="<?php echo $options['top_news_days']; ?>"  />
			</div>
			<div class="form-group">
			<label for="top_news_number">Trending News Number</label>
			<select name="top_news_number" id="top_news_number" class="form-control">
				<?php 
					for ($tr=3;$tr<11;$tr++) {
						?>
							<option value="<?php echo $tr; ?>" <?php if ($tr == $options['top_news_number']) {echo 'SELECTED';} ?>><?php echo $tr; ?></option>
						<?php
					}
				?>
			</select>
			</div>
		</div>
		  
		
		<div class="form-group">
			<input type="hidden" name="display_sections_categories" value="0" />
			<div><input type="checkbox" name="display_sections_categories" id="display_sections_categories" value="1" <?php if (isset($options['display_sections_categories']) AND $options['display_sections_categories'] == 1) {echo 'CHECKED';} ?> /> <span class="checkbox-label">Display Categories (Sections)</span></div>
		</div>
		  
		  <div id="display_sections_categories_div">
		<div class="form-group">
			<label for="sections_categories">Selected Categories</label>
			<div class="row">
			<?php 
			$categories = $general->main_categories('category_order ASC');
			foreach ($categories AS $category) {
			?>
			<div class="col-md-3 col-sm-6"><input type="checkbox" name="sections_categories[]" value="<?php echo $category['id'];?>" <?php if (in_array($category['id'],explode(',',$options['sections_categories']))) {echo 'CHECKED';} ?> /> <?php echo $category['category']; ?></div>
			<?php		
			}
			?>
			</div>
		</div>
		<div class="form-group">
			<label for="tabs_content_type">Category Content Type</label>
			<input type="hidden" name="sections_content_type_rss" value="0" />
			<input type="hidden" name="sections_content_type_video" value="0" />
			<div>
			<label>
			<input data-toggle="toggle" data-size="mini" type="checkbox" name="sections_content_type_rss" value="1" <?php if ($options['sections_content_type_rss'] == 1) {echo 'CHECKED';} ?> /> News
			</label>
			</div>
			<div>
			<label>
			<input data-toggle="toggle" data-size="mini" type="checkbox" name="sections_content_type_video" value="1" <?php if ($options['sections_content_type_video'] == 1) {echo 'CHECKED';} ?> /> Video
			</label>
			</div>
		</div>
		<div class="form-group">
			<label>Sections Content Style</label>
			<div class="radios">
				<input type="radio" name="sections_content_style" value="1" id="sections-style-1" <?php if ($options['sections_content_style'] == 1) {echo 'CHECKED';} ?> />
					<label class="radio" for="sections-style-1">
						<img src="assets/images/news-section-1.png" />
					</label>
				<input type="radio" name="sections_content_style" value="2" id="sections-style-2" <?php if ($options['sections_content_style'] == 2) {echo 'CHECKED';} ?> />
					<label class="radio" for="sections-style-2">
						<img src="assets/images/news-section-2.png" />
					</label>
				<input type="radio" name="sections_content_style" value="3" id="sections-style-3" <?php if ($options['sections_content_style'] == 3) {echo 'CHECKED';} ?> />
					<label class="radio" for="sections-style-3">
						<img src="assets/images/news-section-3.png" />
					</label>
			</div>
		</div>	
		</div>	
		</div>	
		<div role="tabpanel" class="tab-pane" id="mobile">
			<div class="form-group">
			<label>
				<input type="hidden" name="mobile_weather_widget" value="0" />
				<input data-toggle="toggle" data-size="mini" type="checkbox" name="mobile_weather_widget" value="1" <?php if ($options['mobile_weather_widget'] == 1) {echo 'checked';} ?> /> Display Weather Widget in Mobile
			</label>
			</div>
			<div class="form-group">
			<label>
				<input type="hidden" name="mobile_poll_widget" value="0" />
				<input data-toggle="toggle" data-size="mini" type="checkbox" name="mobile_poll_widget" value="1" <?php if ($options['mobile_poll_widget'] == 1) {echo 'checked';} ?> /> Display Poll Widget in Mobile
			</label>
			</div>
			<div class="form-group">
			<label>
				<input type="hidden" name="mobile_topnews_widget" value="0" />
				<input data-toggle="toggle" data-size="mini" type="checkbox" name="mobile_topnews_widget" value="1" <?php if ($options['mobile_topnews_widget'] == 1) {echo 'checked';} ?> /> Display Trending News Widget in Mobile
			</label>
			</div>
			<div class="form-group">
			<label>
				<input type="hidden" name="mobile_archive_widget" value="0" />
				<input data-toggle="toggle" data-size="mini" type="checkbox" name="mobile_archive_widget" value="1" <?php if ($options['mobile_archive_widget'] == 1) {echo 'checked';} ?> /> Display Archive Widget in Mobile
			</label>
			</div>
			<div class="form-group">
			<label>
				<input type="hidden" name="mobile_social_widget" value="0" />
				<input data-toggle="toggle" data-size="mini" type="checkbox" name="mobile_social_widget" value="1" <?php if ($options['mobile_social_widget'] == 1) {echo 'checked';} ?> /> Display Social Widget in Mobile
			</label>
			</div>
		</div>	
		<div role="tabpanel" class="tab-pane" id="pad">
			<div class="form-group">
			<label>
				<input type="hidden" name="tab_weather_widget" value="0" />
				<input data-toggle="toggle" data-size="mini" type="checkbox" name="tab_weather_widget" value="1" <?php if ($options['tab_weather_widget'] == 1) {echo 'checked';} ?> /> Display Weather Widget in Tabs
			</label>
			</div>
			<div class="form-group">
			<label>
				<input type="hidden" name="tab_poll_widget" value="0" />
				<input data-toggle="toggle" data-size="mini" type="checkbox" name="tab_poll_widget" value="1" <?php if ($options['tab_poll_widget'] == 1) {echo 'checked';} ?> /> Display Poll Widget in Tabs
			</label>
			</div>
			<div class="form-group">
			<label>
				<input type="hidden" name="tab_topnews_widget" value="0" />
				<input data-toggle="toggle" data-size="mini" type="checkbox" name="tab_topnews_widget" value="1" <?php if ($options['tab_topnews_widget'] == 1) {echo 'checked';} ?> /> Display Trending News Widget in Tabs
			</label>
			</div>
			<div class="form-group">
			<label>
				<input type="hidden" name="tab_archive_widget" value="0" />
				<input data-toggle="toggle" data-size="mini" type="checkbox" name="tab_archive_widget" value="1" <?php if ($options['tab_archive_widget'] == 1) {echo 'checked';} ?> /> Display Archive Widget in Tabs
			</label>
			</div>
			<div class="form-group">
			<label>
				<input type="hidden" name="tab_social_widget" value="0" />
				<input data-toggle="toggle" data-size="mini" type="checkbox" name="tab_social_widget" value="1" <?php if ($options['tab_social_widget'] == 1) {echo 'checked';} ?> /> Display Social Widget in Tabs
			</label>
			</div>
		</div>		
		</div>
		  <button type="submit" name="save" class="btn btn-primary">Save</button>
		</form>
		  