<?
widget_css();
$_bo_table = $widget_config['forum1'];
if ( empty($_bo_table) ) $_bo_table = $widget_config['default_forum_id'];

$list = g::posts( array(
			"bo_table" 	=>	$_bo_table,
			"limit"		=>	$limit,
			"select"	=>	"idx,domain,bo_table,wr_id,wr_parent,wr_is_comment,wr_comment,ca_name,wr_datetime,wr_hit,wr_good,wr_nogood,wr_name,mb_id,wr_subject,wr_content"
				)
		);	
?>

<div class='latest-left-gallery'>
	<?for ( $i=0; $i<=1; $i++ ) { 
		if ( $list ) {
			$_wr_id = $list[$i]['wr_id'];
			$imgsrc = x::post_thumbnail($_bo_table, $_wr_id, 233, 229);
			$img = $imgsrc['src'];
			if ( empty($img) ) {
				$_wr_content = db::result("SELECT wr_content FROM $g5[write_prefix]$_bo_table WHERE wr_id='$_wr_id'");
				$image_from_tag = g::thumbnail_from_image_tag( $_wr_content, $_bo_table, 233, 229 );
				$img = $image_from_tag;
				if ( empty($img ) ) $img = x::url()."widget/$widget_config[name]/img/no_image.png";
			}

			$url = $list[$i]['url'];
			$subject = $list[$i]['wr_subject'];
			$content = cut_str($list[$i]['wr_content'], 100, '...');
		} 
		else {
			if ( $i == 0 ) $img = x::url()."widget/$widget_config[name]/img/default_banner1.png";
			else if ( $i == 1 ) $img = x::url()."widget/$widget_config[name]/img/default_banner2.png";
			
			$url = "javascript:void(0);";
			$subject = "회원님께서는 현재";
			$content = "갤러리 테마 No.2를 사용하고 계십니다.";
			
		}
	?>
		<div class="top-posts <? if ($i==1) echo 'last-post'?>" style="background: url('<?=$img?>')">
			<div class='top-posts-container'>
				<div class='top-posts-subject'><a href="<?=$url?>"><?=$subject?></a></div>
				<div class='top-posts-content'><a href="<?=$url?>"><?=$content?></a></div>
				<? if ( $list ) {?>자세히<a href="<?=$url?>" class='read_more'></a>
				<? } else {?> 사이트 설정<a href='<?=url_site_config()?>' class='read_more'></a> <?}?>
			</div>
		</div>
	<?}?>
	
	<?
		if ( $list ) {
			$_wr_id = $list[$i]['wr_id'];
			$imgsrc = x::post_thumbnail($_bo_table, $_wr_id, 478, 128);
			$img = $imgsrc['src'];
			if ( empty($img) ) {
				$_wr_content = db::result("SELECT wr_content FROM $g5[write_prefix]$_bo_table WHERE wr_id='$_wr_id'");
				$image_from_tag = g::thumbnail_from_image_tag( $_wr_content, $_bo_table, 478, 128 );
				$img = $image_from_tag;
				if ( empty($img ) ) $img = x::url()."widget/$widget_config[name]/img/no_image.png";
			}
		
			$url = $list[$i]['url'];
			$subject = $list[$i]['wr_subject'];
			$content = cut_str($list[$i]['wr_content'], 80, '...');
			
		}
		else {
			$img = x::url()."widget/$widget_config[name]/img/default_banner3.png";
			$url = "javascript:void(0);";
			$subject = "회원님께서는 현재";
			$content = "갤러리 테마 No.2를 사용하고 계십니다.";
		}
	?>
	
	<div class='bottom-post' style="background: url('<?=$img?>')">
		<div class='bottom-posts-container'>
			<div class='bottom-posts-subject'><a href="<?=$url?>"><?=$subject?></a></div>
			<div class='bottom-posts-content'><a href="<?=$url?>"><?=$content?></a></div>
			<? if ( $list ) {?>자세히 <a href="<?=$url?>" class='read_more'></a>
			<? } else {?>사이트 설정 <a href="<?=url_site_config()?>" class='read_more'></a> <?}?>
		</div>		
	</div>
</div>